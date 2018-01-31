<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Core\Configure;
use Cake\Utility\Hash;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

/**
 * Tests Controller
 *
 * @property \App\Model\Table\TestsTable $Tests
 */
class TestsController extends AppController {

    var $helpers = array('Html', 'Form', 'Response');

	public function beforeFilter(\Cake\Event\Event $event) {

        parent::beforeFilter($event);
        $this->Auth->allow(['register', 'login','getcitylist', 'userVerification', 'forgotPassword', 'activatePassword', 'cakeVersion', 'deleteAllCache', 'testMail']);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {

        /*$this->paginate = [
            'contain' => ['Users']
        ];
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);*/
		$this->redirect('/users/dashboard');
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($slug = null) {
        
    }
	function cakeVersion() {
		echo Configure::version(); exit;
	}

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $d = $this->request->data;
        $adduser = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($adduser, $d);
            if ($this->Users->save($user)) {
                $result['error'] = 0;
                $result['msg'] = "User has been added successfully";
            } else {
                $result['error'] = 1;
                $result['msg'] = "Something went wrong please try again";
            }
            $this->set([
                'message' => $result,
                'result' => $adduser,
                '_serialize' => ['message', 'result']
            ]);
        }
    }

    public function contactus() {
        $this->loadModel('Contacts');
        if ($this->request->is('post')) {
            $d = $this->request->data;
            $d['status'] = 0;
            $contact = $this->Contacts->newEntity($d);
            if ($this->Contacts->save($contact)) {
                $this->Flash->success(__('Your contact detals has been saved.'));
                return $this->redirect('/pages/contactus');
            } else {
                $this->Flash->error(__('Sorry.'));
                return $this->redirect('/pages/contactus');
            }
        }
    }

    public function register() {
        $this->loadModel('Credits');
        $this->loadModel('Countries');
        $this->loadModel('States');
        $this->loadModel('Cities');
      
        if ($this->request->is('post')) {
            $d = $this->request->data;
            $checkUsers = $this->Users->find()->where(['email' => $d['email']])->count();
            if ($checkUsers < 1) {
                $d['email_verified'] = 0;
                $d['mobile_verified'] = 0;
                $d['reset_password_token'] = 0;
                $d['verification_token'] = 0;
                $d['mobile_otp'] = rand('1010', '9999');
                $d['status'] = 0;
                $d['create_at'] = 0;
                $file = $d['image'];
                $path = WWW_ROOT . "userimages" . DS . $file['name'];
                move_uploaded_file($file['tmp_name'], $path);
                $d['image'] = $file['name'];

				if(isset($this->request->data["preference"]) && !empty($this->request->data["preference"])) {
					$d["preference"] = implode(",", $this->request->data["preference"]);
				}
                $user = $this->Users->newEntity($d);
				//pr($d); exit;
                if ($res = $this->Users->save($user)) {
					$subject="TravelB2Bhub registration";
					 $to=$d['email'];
					 $headers  = 'MIME-Version: 1.0' . "\r\n";
					 $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					 $headers .= 'From: TravelB2Bhub <contactus@travelb2bhub.com>' . "\r\n";
					 //$headers .= "Bcc: business.leadindia@gmail.com"; // BCC mail

					 $message='<p>Dear '.$d['first_name'].'</p>';
					 $message.='<p>Thank you for registering with TravelB2Bhub.com, the  COMMISSION FREE, Business to Business, tourism trading network. </p>';
					 //$message.='<p>Update profile by <a href="http://www.travelb2bhub.com">click here</a> to login from Homepage.</p>';
					 $message.='<p>Please verify your email address by <a href="http://www.travelb2bhub.com">click here</a> to login from Homepage.</p>';
					 $message.='<p>Note: You will receive a notification when there are enough registered members for you to begin trading. Please encourage your contacts to enroll.</p>';
					 $message.='<p>We are committed to enhance your trading experience!</p>';
					 $message.='<p>Sincerely,\nThe TravelB2Bhub Team</p>';
					 // Mail it
					 //@mail($to, $subject, $message, $headers);
					 //// Send email verification email
					 $userId = $res->id;
					 $subject="TravelB2Bhub Email Verification";
					 $to=$d['email'];
					 $headers  = 'MIME-Version: 1.0' . "\r\n";
					 $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					 $headers .= 'From: TravelB2Bhub <contactus@travelb2bhub.com>' . "\r\n";
					 //$headers .= "Bcc: business.leadindia@gmail.com"; // BCC mail
					$theKey = $this->getActivationKey($d["mobile_number"]);
					$message='<p>Dear '.$d['first_name'].'</p>';
					$message.='<p>Thank you for registering with TravelB2Bhub.com, the  COMMISSION FREE, Business to Business, tourism trading network. </p>';
					$message.='<p>Please verify your email address by clicking on the link below <a href="http://www.travelb2bhub.com/users/userVerification?ident='.$userId.'&activate='.$theKey.'">click here<a></p>';
					$message.='<p>Note: You will receive a notification when there are enough registered members for you to begin trading. Please encourage your contacts to enroll.</p>';
					$message.='<p>We are committed to enhance your trading experience!</p>';
					$message.='<p>Sincerely,\nThe TravelB2Bhub Team</p>';
					 // Mail it
					 @mail($to, $subject, $message, $headers);
                    $uid = $res->id;
                    $c['credit'] = 60;
                    $c['user_Id'] = $uid;
                    $creditd = $this->Credits->newEntity($c);
                    $this->Credits->save($creditd);

                    $this->Flash->success(__('Thank you for registration.'));
                    $this->redirect('/users/dashboard/');
                } else {
                    $this->Flash->error(__('The user could not be saved. Please, try again.'));
                }
            } else {
                $this->Flash->error(__('Email id already exist. Please, try another one.'));
            }
        }
		$cities = $this->Cities->getAllCities();
		$states = $this->States->find()->where(['country_id' => '101'])->all();
		$allStates = array();
		foreach($states as $state){
			$allStates[$state["id"]] = $state['state_name'];
		}
		$allCities = array();
		$allCityList = array();
		if(!empty($cities)) {
			foreach($cities as $city) {
				$allCities[] = array("label"=>str_replace("'", "", $city['name']), "value"=>$city['id'], "state_id"=>$city['state_id'], "state_name"=>$city['state']->state_name, "country_id"=>101, "country_name"=>"India");
				$allCityList[$city['id']] = $city['name'];
			}
		}
		$allCities = json_encode($allCities);
		$this->set(compact('cities', 'states', 'countries', 'allCities', 'allStates'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id) {
		Configure::write('debug',2);
		$this->loadModel("TravelCertificates");
        $userDetails = $this->Users->get($id);
        if ($this->request->is(['post', 'put'])) {
			//pr($userDetails);
			if($userDetails["role_id"] == 3) {
				if(isset($this->request->data["hotel_categories"]) && !empty($this->request->data["hotel_categories"])) {
					$this->request->data["hotel_categories"] = $this->request->data["hotel_categories"];
				}
				if(isset($this->request->data["hotel_rating"]) && !empty($this->request->data["hotel_rating"])) {
					$this->request->data["hotel_rating"] = $this->request->data["hotel_rating"];
				}
			}
			if(isset($this->request->data["preference"]) && !empty($this->request->data["preference"])) {
				$this->request->data["preference"] = implode(",", $this->request->data["preference"]);
			}
			//pr($this->request->data); 
			
			//exit;
			if(is_uploaded_file($this->request->data['profile_pic']['tmp_name']) && !empty($this->request->data['profile_pic']['tmp_name']))
			{
				$path_info = pathinfo($this->request->data['profile_pic']['name']);
				chmod ($this->request->data['profile_pic']['tmp_name'], 0644);
				$photo=time().mt_rand().".".$path_info['extension'];
				$fullpath= WWW_ROOT."img".DS."user_docs".DS.$id;
				$res1 = is_dir($fullpath);
				if($res1 != 1) {
					$res2= mkdir($fullpath, 0777, true);
				}
				move_uploaded_file($this->request->data['profile_pic']['tmp_name'],$fullpath.DS.$photo);
				$this->request->data['profile_pic'] = $photo;
				/*if(!empty($user['profile_pic']) && file_exists($fullpath.DS.$user['profile_pic'])) {
					unlink($fullpath.DS.$user['profile_pic']);
				}*/
			}
			else {
				unset($this->request->data['profile_pic']);
			}
			if(is_uploaded_file($this->request->data['pancard']['tmp_name']) && !empty($this->request->data['pancard']['tmp_name']))
			{
				$path_info = pathinfo($this->request->data['pancard']['name']);
				chmod ($this->request->data['pancard']['tmp_name'], 0644);
				$photo=time().mt_rand().".".$path_info['extension'];
				$fullpath= WWW_ROOT."img".DS."user_docs".DS.$id;
				$res1 = is_dir($fullpath);
				if($res1 != 1) {
					$res2= mkdir($fullpath, 0777, true);
				}
				move_uploaded_file($this->request->data['pancard']['tmp_name'],$fullpath.DS.$photo);
				$this->request->data['pancard_pic'] = $photo;
				/*if(!empty($user['pancard_pic']) && file_exists($fullpath.DS.$user['pancard_pic'])) {
					unlink($fullpath.DS.$user['pancard_pic']);
				}*/
			}
			else {
				unset($this->request->data['pancard']);
			}
			if(is_uploaded_file($this->request->data['company_img_1']['tmp_name']) && !empty($this->request->data['company_img_1']['tmp_name']))
			{
				$path_info = pathinfo($this->request->data['company_img_1']['name']);
				chmod ($this->request->data['company_img_1']['tmp_name'], 0644);
				$photo=time().mt_rand().".".$path_info['extension'];
				$fullpath= WWW_ROOT."img".DS."user_docs".DS.$id;
				$res1 = is_dir($fullpath);
				if($res1 != 1) {
					$res2= mkdir($fullpath, 0777, true);
				}
				move_uploaded_file($this->request->data['company_img_1']['tmp_name'],$fullpath.DS.$photo);
				$this->request->data['company_img_1_pic'] = $photo;
				/*if(!empty($user['company_img_1_pic']) && file_exists($fullpath.DS.$user['company_img_1_pic'])) {
					unlink($fullpath.DS.$user['company_img_1_pic']);
				}*/
			}
			else {
				unset($this->request->data['company_img_1']);
			}
			if(is_uploaded_file($this->request->data['company_img_2']['tmp_name']) && !empty($this->request->data['company_img_2']['tmp_name']))
			{
				$path_info = pathinfo($this->request->data['company_img_2']['name']);
				chmod ($this->request->data['company_img_2']['tmp_name'], 0644);
				$photo=time().mt_rand().".".$path_info['extension'];
				$fullpath= WWW_ROOT."img".DS."user_docs".DS.$id;
				$res1 = is_dir($fullpath);
				if($res1 != 1) {
					$res2= mkdir($fullpath, 0777, true);
				}
				move_uploaded_file($this->request->data['company_img_2']['tmp_name'],$fullpath.DS.$photo);
				$this->request->data['company_img_2_pic'] = $photo;
				/*if(!empty($user['company_img_2_pic']) && file_exists($fullpath.DS.$user['company_img_2_pic'])) {
					unlink($fullpath.DS.$user['company_img_2_pic']);
				}*/
			}
			else {
				unset($this->request->data['company_img_2']);
			}
			if(is_uploaded_file($this->request->data['id_card']['tmp_name']) && !empty($this->request->data['id_card']['tmp_name']))
			{
				$path_info = pathinfo($this->request->data['id_card']['name']);
				chmod ($this->request->data['id_card']['tmp_name'], 0644);
				$photo=time().mt_rand().".".$path_info['extension'];
				$fullpath= WWW_ROOT."img".DS."user_docs".DS.$id;
				$res1 = is_dir($fullpath);
				if($res1 != 1) {
					$res2= mkdir($fullpath, 0777, true);
				}
				move_uploaded_file($this->request->data['id_card']['tmp_name'],$fullpath.DS.$photo);
				$this->request->data['id_card_pic'] = $photo;
				/*if(!empty($user['id_card_pic']) && file_exists($fullpath.DS.$user['id_card_pic'])) {
					unlink($fullpath.DS.$user['id_card_pic']);
				}*/
			}
			else {
				unset($this->request->data['id_card']);
			}
			if(is_uploaded_file($this->request->data['company_shop_registration']['tmp_name']) && !empty($this->request->data['company_shop_registration']['tmp_name']))
			{
				$path_info = pathinfo($this->request->data['company_shop_registration']['name']);
				chmod ($this->request->data['company_shop_registration']['tmp_name'], 0644);
				$photo=time().mt_rand().".".$path_info['extension'];
				$fullpath= WWW_ROOT."img".DS."user_docs".DS.$id;
				$res1 = is_dir($fullpath);
				if($res1 != 1) {
					$res2= mkdir($fullpath, 0777, true);
				}
				move_uploaded_file($this->request->data['company_shop_registration']['tmp_name'],$fullpath.DS.$photo);
				$this->request->data['company_shop_registration_pic'] = $photo;
				/*if(!empty($user['company_shop_registration_pic']) && file_exists($fullpath.DS.$user['company_shop_registration_pic'])) {
					unlink($fullpath.DS.$user['company_shop_registration_pic']);
				}*/
			}
			else {
				unset($this->request->data['company_shop_registration']);
			}
            $user = $this->Users->patchEntity($userDetails, $this->request->data);
            if ($this->Users->save($user)) {
				if($userDetails["role_id"] == 1) {
					$travelCertificates= $this->_getCertificatesArray();
					foreach($travelCertificates as $key=>$row) {
						$keyName = strtolower(str_replace(" ", "", $row)."_pic");
						if(is_uploaded_file($this->request->data[$keyName]['tmp_name']) && !empty($this->request->data[$keyName]['tmp_name']))
						{
							$path_info = pathinfo($this->request->data[$keyName]['name']);
							chmod ($this->request->data[$keyName]['tmp_name'], 0644);
							$photo=time().mt_rand().".".$path_info['extension'];
							$fullpath= WWW_ROOT."img".DS."user_travel_certificates".DS.$id;
							$res1 = is_dir($fullpath);
							if($res1 != 1) {
								$res2= mkdir($fullpath, 0777, true);
							}
							move_uploaded_file($this->request->data[$keyName]['tmp_name'],$fullpath.DS.$photo);
							$travelCertificateData["user_id"] = $userDetails["id"];
							$travelCertificateData["certificate_name"] = $row;
							$travelCertificateData["certificate_pic"] = $photo;

							// Check for existing record
							$userTravelCertificate = $this->TravelCertificates->find()->where(['user_id' => $this->Auth->user('id'), "certificate_name"=>$row])->first();
							if(!empty($userTravelCertificate)) {
								$travelCertificate = $this->TravelCertificates->patchEntity($userTravelCertificate, $travelCertificateData);
							} else {
								$travelCertificate = $this->TravelCertificates->newEntity($travelCertificateData);
							}
							
							$this->TravelCertificates->save($travelCertificate);
						}
						else {
							unset($this->request->data[$keyName]);
						}
					}
				}
                $this->Flash->error(__('User has been updated successfully.'));
                $result['msg'] = "User has been updated successfully";
                $this->redirect('/users/dashboard');
            } else {
                $this->Flash->error(__('Something went wrong please try again.'));
                $this->redirect('/users/profileedit');
            }
        } else {
			$this->redirect('/users/profileedit');
		}
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        
    }

    /**
     * Login method
     */
    public function login() {

        if ($this->request->is('post') || $this->request->query('provider')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
				// set rating
				$this->loadModel("UserRatings");
				$query = $this->UserRatings->find();
				$userRating = $query->select(["average_rating" => $query->func()->avg("rating")])
				->where(['user_id' => $this->Auth->user('id')])
				->order(["id" => "DESC"])
				->first();
				$this->request->session()->write('Auth.User.avrage_rating', (int)$userRating->average_rating);
                //return $this->redirect('/users/profileedit');
                return $this->redirect('/users/dashboard');
            } else {
                return $this->redirect('/pages/home');
                $this->Flash->error(__('Invalid username or password, try again'));
            }
        }
    }

    public function dashboard() {
		//Configure::write('debug',2);
        $this->loadModel('Requests');
		$this->loadModel("TravelCertificates");
        $this->loadModel('Responses');
        $user = $this->Users->find()
                        ->contain(["Credits"])
                        ->where(['Users.id' => $this->Auth->user('id')])->first();
        $this->set('users', $user);
		$userTravelCertificates = $this->TravelCertificates->find('list',['keyField' => 'certificate_name', 'valueField' => 'certificate_pic'])
				->hydrate(false)
				->where(['user_id' => $this->Auth->user('id')])
				->toArray();
		$this->set('userTravelCertificates', $userTravelCertificates);
		$this->set("travelCertificates", $this->_getCertificatesArray());
		$this->set('userProfile', $user);
		$myRequestCount = $myReponseCount = 0;
		$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.status !="=>2, "Requests.is_deleted"=>0]]);
		$myRequestCount = $query->count();
    
        $this->set('myRequestCount', $myRequestCount);

        $queryr = $this->Responses->find('all', ['conditions' => ['Responses.user_id' => $this->Auth->user('id')]]);
        $myReponseCount = $queryr->count();
        $this->set('myReponseCount', $myReponseCount);
		$this->loadModel('UserChats');
		$unreadChatCount = $this->UserChats
								->find()
								->where(['UserChats.send_to_user_id' => $this->Auth->user('id'), "UserChats.is_read"=>0])
								->count();
		$this->set('unreadChatCount', $unreadChatCount);
    }

    public function profileedit() {
		$this->loadModel("UserRatings");
		$this->loadModel("TravelCertificates");
		$this->loadModel('States');
		$this->loadModel('Cities');
		$this->loadModel('Requests');
        $this->loadModel('Responses');
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
		$this->set('users', $user);
        if(!empty($user)) {
			$userTravelCertificates = $this->TravelCertificates->find('list',['keyField' => 'certificate_name', 'valueField' => 'certificate_pic'])
				->hydrate(false)
				->where(['user_id' => $this->Auth->user('id')])
				->toArray();
			$myRequestCount = 0;
			$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id')]]);
			$myRequestCount = $query->count();
		
			$this->set('myRequestCount', $myRequestCount);

			$queryr = $this->Responses->find('all', ['conditions' => ['Responses.user_id' => $this->Auth->user('id')]]);
			$myReponseCount = $queryr->count();
			$this->set('myReponseCount', $myReponseCount);

			$querys = $this->Requests->find('all');
			$totalNumberRequest = $querys->count();
			$this->set('totalNumberRequest', $totalNumberRequest);
			
			$querys =  $this->Requests->find('all', [
			'conditions' => ['Requests.category_id' => 3]]);
			$totalNumberResponse = $querys->count();
			$this->set('totalNumberResponse', $totalNumberResponse);

			$cities = $this->Cities->getAllCities();
			$states = $this->States->find()->where(['country_id' => '101'])->all();
			$allStates = array();
			foreach($states as $state){
				$allStates[$state["id"]] = $state['state_name'];
			}
			$allCities = array();
			$allCityList = array();
			if(!empty($cities)) {
				foreach($cities as $city) {
					$allCities[] = array("label"=>str_replace("'", "", $city['name']), "value"=>$city['id'], "state_id"=>$city['state_id'], "state_name"=>$city['state']->state_name, "country_id"=>101, "country_name"=>"India");
					$allCityList[$city['id']] = $city['name'];
				}
			}
			$allCities = json_encode($allCities);
			$this->loadModel('UserChats');
			$unreadChatCount = $this->UserChats
								->find()
								->where(['UserChats.send_to_user_id' => $this->Auth->user('id'), "UserChats.is_read"=>0])
								->count();
			$this->set(compact('cities', 'states', 'countries', 'allCities', 'allStates', 'allCityList', 'userTravelCertificates', 'unreadChatCount'));
		} else {
			$this->Flash->error(__('Please login to acces this location.'));
			$this->redirect('/pages/home');
		}
		$this->set("travelCertificates", $this->_getCertificatesArray());
		$this->set("hotelCategories", $this->_getHotelCategoriesArray());
    }

	public function changePassword() {
		$this->loadModel('Requests');
        $this->loadModel('Responses');
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
		$this->set('users', $user);
        if(!empty($user)) {
			if ($this->request->is('post')) {
				//pr($this->request->data); exit;
				$verify = (new \Cake\Auth\DefaultPasswordHasher)->check($this->request->data['old_password'], $user->password);
				if($verify) {
					$result = $this->Users->patchEntity($user, ['password' => $this->request->data['password']]);
					if ($this->Users->save($result)) {
						$this->Flash->success(__('Your password has been changed successfully.'));
						$this->redirect('/users/dashboard');
					}
				} else {
					//echo "not mached"; exit;
					$this->Flash->success(__('Current Password does not matched.'));
				}
			}

			$myRequestCount = $myReponseCount = 0;
			$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.status !="=>2, "Requests.is_deleted"=>0]]);
			$myRequestCount = $query->count();
		
			$this->set('myRequestCount', $myRequestCount);

			$queryr = $this->Responses->find('all', ['conditions' => ['Responses.user_id' => $this->Auth->user('id')]]);
			$myReponseCount = $queryr->count();
			$this->set('myReponseCount', $myReponseCount);

			$this->loadModel('UserChats');
			$unreadChatCount = $this->UserChats
									->find()
									->where(['UserChats.send_to_user_id' => $this->Auth->user('id'), "UserChats.is_read"=>0])
									->count();
			$this->set('unreadChatCount', $unreadChatCount);
		} else {
			$this->Flash->error(__('Please login to acces this location.'));
			$this->redirect('/pages/home');
		}
    }

    public function sendrequest() {
		//Configure::write('debug',2);
        $this->loadModel('Requests');
		$this->loadModel('Responses');
        $this->loadModel('Hotels');
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
        //print_r($user);
        $this->set('users', $user);
		$myRequestCount = $myReponseCount = 0;
		$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.status !="=>2, "Requests.is_deleted"=>0]]);
		$myRequestCount = $query->count();
		if($myRequestCount < 50) {
			if($this->request->is('post')){
				
				$d = $this->request->data;
				//Change input date format to mysql date format
				$d['check_in'] = (isset($d['check_in']) && !empty($d['check_in']))?$this->ymdFormatByDateFormat($d['check_in'], "d-m-Y", $dateSeparator="/"):null;
				$d['check_out'] = (isset($d['check_out']) && !empty($d['check_out']))?$this->ymdFormatByDateFormat($d['check_out'], "d-m-Y", $dateSeparator="/"):null;

				$d['start_date'] = (isset($d['start_date']) && !empty($d['start_date']))?$this->ymdFormatByDateFormat($d['start_date'], "d-m-Y", $dateSeparator="/"):null;
				$d['end_date'] = (isset($d['end_date']) && !empty($d['start_date']))?$this->ymdFormatByDateFormat($d['end_date'], "d-m-Y", $dateSeparator="/"):null;
				// Category id 
				// 1 For Package
				// 2 For Transport
				// 3 For Hotel
				if($this->request->data['category_id'] == 2 ){
					$p['transport_requirement'] = $d['transport_requirement'];
					$p['pickup_city'] = $d['t_pickup_city_id'];
					$p['pickup_state'] = $d['t_pickup_state_id'];
					$p['pickup_country'] = $d['t_pickup_country_id'];
					$p['final_city'] = $d['t_final_city_id'];
					$p['final_state'] = $d['t_final_state_id'];
					$p['final_country'] = $d['t_final_country_id'];
					$p['pickup_locality'] = $d['pickup_locality'];
					$p['start_date'] = $d['start_date'];
					$p['end_date'] = $d['end_date'];
					$p['comment'] = $d['comment'];
					$p['category_id'] = $d['category_id'];
					$p['reference_id'] = $d['reference_id'];
					$p['user_id'] = $this->Auth->user('id');
					$p['total_budget'] = $d['total_budget'];
					$p['adult'] = $d['adult'];
					$p['children'] = $d['children'];

					$p['stops'] = (isset($d['stops']) && !empty($d['stops']))?implode(",", $d['stops']):"";
					//pr($p); exit;
					$contact = $this->Requests->newEntity($p);
					if ($re = $this->Requests->save($contact)) {
					   $this->Flash->success(__('Your request details has been saved.'));
						return $this->redirect('/users/requestlist');
					} else {
						$this->Flash->error(__('Sorry.'));
						return $this->redirect('/users/sendrequest');
					}
				} elseif($this->request->data['category_id'] == 1 ){
					$p['transport_requirement'] = $d['transport_requirement'];
					$p['pickup_city'] = $d['pickup_city_id'];
					$p['pickup_state'] = $d['pickup_state_id'];
					$p['pickup_country'] = $d['pickup_country_id'];
					$p['pickup_locality'] = $d['pickup_locality'];
					$p['start_date'] = $d['start_date'];
					$p['end_date'] = $d['end_date'];
					$p['comment'] = $d['comment'];
					$p['category_id'] = $d['category_id'];
					
					
					$p['reference_id'] = $d['reference_id'];
					$p['user_id'] = $this->Auth->user('id');
					$p['total_budget'] = $d['total_budget'];
					$p['adult'] = $d['adult'];
					$p['children'] = $d['children'];
					$p['city_id'] = $d['city_id'];
					$p['state_id'] = $d['state_id'];
					$p['country_id'] = $d['country_id'];
					$p['locality'] = $d['locality'];
					$p['stops'] =  $d['stops'];
					$p['room1'] =  $d['room1'];
					$p['room2'] =  $d['room2'];
					$p['room3'] =  $d['room3'];
					$p['child_with_bed'] =  $d['child_with_bed'];
					$p['child_without_bed'] =  $d['child_without_bed'];
					$p['hotel_rating'] = $d['hotel_rating'];
					$p['hotel_category'] = $d['hotel_category'] = (isset($d['hotel_category']) && !empty($d['hotel_category']))?implode(",", $d['hotel_category']):"";
					//$p['meal_plan'] = $d['meal_plan'] = (isset($d['meal_plan']) && !empty($d['meal_plan']))?implode(",", $d['meal_plan']):"";
					$p['meal_plan'] = $d['meal_plan'];
					$p['stops'] = $d['stops'] = (isset($d['stops']) && !empty($d['stops']))?implode(",", $d['stops']):"";

					$p['check_in'] =  $d['check_in'];
					$p['check_out'] =  $d['check_out'];
					//pr($p);pr($d); exit;
					$contact = $this->Requests->newEntity($p);
					if ($re = $this->Requests->save($contact)) {
						$ui = $re->id;
						$d['req_id'] = $ui;
						$d['user_id'] = $this->Auth->user('id');
						$rest = $this->Hotels->newEntity($d);
						$this->Hotels->save($rest);//exit;
						if(isset($d['hh_room1'])) {
							foreach($d['hh_room1'] as $key=>$row) {
								$hotalExtraData['req_id'] = $ui;
								$hotalExtraData['user_id'] = $this->Auth->user('id');

								$hotalExtraData['room1'] =  $row;
								$hotalExtraData['room2'] =  $d['hh_room2'][$key];
								$hotalExtraData['room3'] =  $d['hh_room3'][$key];
								$hotalExtraData['child_with_bed'] =  $d['hh_child_with_bed'][$key];
								$hotalExtraData['child_without_bed'] =  $d['hh_child_without_bed'][$key];
								$hotalExtraData['hotel_rating'] = $d['hh_hotel_rating'][$key];
								$hotalExtraData['hotel_category'] = (isset($d['hh_hotel_category'][$key]) && !empty($d['hh_hotel_category'][$key]))?implode(",", $d['hh_hotel_category'][$key]):"";
								//$hotalExtraData['meal_plan'] = (isset($d['hh_meal_plan'][$key]) && !empty($d['hh_meal_plan'][$key]))?implode(",", $d['hh_meal_plan'][$key]):"";
								$hotalExtraData['meal_plan'] = $d['hh_meal_plan'][$key];
								$hotalExtraData['city_id'] = $d['hh_city_id'][$key];
								$hotalExtraData['state_id'] = $d['hh_state_id'][$key];
								$hotalExtraData['country_id'] = $d['hh_country_id'][$key];
								$hotalExtraData['locality'] = $d['hh_locality'][$key];

								$hotalExtraData['check_in'] =  ($d['hh_check_in'][$key])?$this->ymdFormatByDateFormat($d['hh_check_in'][$key], "d-m-Y", $dateSeparator="/"):null;
								$hotalExtraData['check_out'] =  ($d['hh_check_out'][$key])?$this->ymdFormatByDateFormat($d['hh_check_out'][$key], "d-m-Y", $dateSeparator="/"):null;

								$result = $this->Hotels->newEntity($hotalExtraData);
								$this->Hotels->save($result);
							}

						}
						$this->Flash->success(__('Your request details has been saved.'));
						return $this->redirect('/users/requestlist');
					} else {
						$this->Flash->error(__('Sorry.'));
						return $this->redirect('/users/sendrequest');
					}
				} elseif($this->request->data['category_id'] == 3 ){
					$p['category_id'] = $d['category_id'];
					
					$p['reference_id'] = $d['reference_id'];
					$p['user_id'] = $this->Auth->user('id');
					$p['total_budget'] = $d['total_budget'];
					$p['adult'] = $d['adult'];
					$p['children'] = $d['children'];
					$p['city_id'] = $d['h_city_id'];
					$p['state_id'] = $d['h_state_id'];
					$p['country_id'] = $d['h_country_id'];
					$p['locality'] = $d['locality'];
					$p['room1'] =  $d['room1'];
					$p['room2'] =  $d['room2'];
					$p['room3'] =  $d['room3'];
					$p['child_with_bed'] =  $d['child_with_bed'];
					$p['child_without_bed'] =  $d['child_without_bed'];
					$p['hotel_category'] = $d['hotel_category'] = (isset($d['hotel_category']) && !empty($d['hotel_category']))?implode(",", $d['hotel_category']):"";
					//$p['meal_plan'] = $d['meal_plan'] = (isset($d['meal_plan']) && !empty($d['meal_plan']))?implode(",", $d['meal_plan']):"";
					$p['meal_plan'] = $d['meal_plan'];

					$p['check_in'] =  $d['check_in'];
					$p['check_out'] =  $d['check_out'];
					$p['hotel_rating'] = $d['hotel_rating'];

					$p['comment'] = $d['comment'];
					//pr($p);pr($d); exit;
					$contact = $this->Requests->newEntity($p);
					if ($re = $this->Requests->save($contact)) {
						$ui = $re->id;
							$d['req_id'] = $ui;
							$d['user_id'] = $this->Auth->user('id');
							$rest = $this->Hotels->newEntity($d);
							$this->Hotels->save($rest);//exit;
						$this->Flash->success(__('Your request details has been saved.'));
						return $this->redirect('/users/requestlist');
					} else {
						$this->Flash->error(__('Sorry.'));
						return $this->redirect('/users/sendrequest');
					}
				}
			}
		} else {
			$this->Flash->error(__('Sorry, You cannot add more than 50 request.'));
			return $this->redirect('/users/dashboard');
		}
		$this->loadModel('States');
		$this->loadModel('Cities');
		$cities = $this->Cities->getAllCities();
		$states = $this->States->find()->where(['country_id' => '101'])->all();
		$allStates = array();
		foreach($states as $state){
			$allStates[$state["id"]] = $state['state_name'];
		}
		$allCities = array();
		$allCityList = array();
		if(!empty($cities)) {
			foreach($cities as $city) {
				$allCities[] = array("label"=>str_replace("'", "", $city['name']), "value"=>$city['id'], "state_id"=>$city['state_id'], "state_name"=>$city['state']->state_name, "country_id"=>101, "country_name"=>"India");
				$allCityList[$city['id']] = $city['name'];
			}
		}
		$allCities = json_encode($allCities);
		$this->set(compact('cities', 'states', 'countries', 'allCities', 'allStates', 'allCityList'));
		$this->set("hotelCategories", $this->_getHotelCategoriesArray());
        $this->set('myRequestCount', $myRequestCount);

        $queryr = $this->Responses->find('all', ['conditions' => ['Responses.user_id' => $this->Auth->user('id')]]);
        $myReponseCount = $queryr->count();
        $this->set('myReponseCount', $myReponseCount);
    }

    public function hotelrequest() {
        $this->loadModel('Hotels');
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
        //print_r($user);
        $this->set('users', $user);

        // print_r($this->request->data);
        if ($this->request->is('post')) {
            $d = $this->request->data;
            $d['destination_city'] = implode(",", $d['destination_city']);
            $d['room1'] = implode(",", $d['room1']);
            $d['room2'] = implode(",", $d['room2']);
            $d['room3'] = implode(",", $d['room3']);
            $d['child_with_bed'] = implode(",", $d['child_with_bed']);
            $d['child_without_bed'] = implode(",", $d['child_without_bed']);
            $d['hotel_category'] = implode(",", $d['hotel_category']);
            $d['meal_plan'] = implode(",", $d['meal_plan']);
            $d['check_in'] = implode(",", $d['check_in']);
            $d['check_out'] = implode(",", $d['check_out']);


            $contact = $this->Hotels->newEntity($d);
            if ($this->Hotels->save($contact)) {
                $this->Flash->success(__('Your request details has been saved.'));
                return $this->redirect('/users/myrequestlist');
            } else {
                $this->Flash->error(__('Sorry.'));
                return $this->redirect('/users/sendrequest');
            }
        }
    }

    public function transportrequest() {
        $this->loadModel('Transports');
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
        //print_r($user);
        $this->set('users', $user);

        // print_r($this->request->data);
        if ($this->request->is('post')) {
            $d = $this->request->data;
            $d['stops'] = implode(",", $d['stops']);



            $contact = $this->Transports->newEntity($d);
            if ($this->Transports->save($contact)) {
                $this->Flash->success(__('Your request details has been saved.'));
                return $this->redirect('/users/myrequestlist');
            } else {
                $this->Flash->error(__('Sorry.'));
                return $this->redirect('/users/sendrequest');
            }
        }
    }

    public function viewdetails($id) {
        $this->loadModel('Requests');
        $this->loadModel('Cities');
		$this->loadModel('States');
		$this->loadModel('Countries');
		$this->loadModel('Responses');
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
        $this->set('users', $user);
        $details = $this->Requests->find()
                        ->contain(["Users", "UserRatings", "Hotels"])
                        ->where(['Requests.id' => $id])->first();
        //pr($details); exit;
        
		$allCities = $this->Cities->find('list',['keyField' => 'id', 'valueField' => 'name'])
				->hydrate(false)
				->toArray();
		$allStates = $this->States->find('list',['keyField' => 'id', 'valueField' => 'state_name'])
				->hydrate(false)
				->toArray();
		/*$allCountries = $this->Countries->find('list',['keyField' => 'id', 'valueField' => 'country_name'])
				->hydrate(false)
				->toArray();*/
		$transpoartRequirmentArray = $this->_getTranspoartRequirmentsArray();
		$mealPlanArray = $this->_getMealPlansArray();

		$myRequestCount = $myReponseCount = 0;
		$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.status !="=>2, "Requests.is_deleted"=>0]]);
		$myRequestCount = $query->count();
    
        $this->set('myRequestCount', $myRequestCount);

        $queryr = $this->Responses->find('all', ['conditions' => ['Responses.user_id' => $this->Auth->user('id')]]);
        $myReponseCount = $queryr->count();
        $this->set('myReponseCount', $myReponseCount);
		$this->set("hotelCategories", $this->_getHotelCategoriesArray());
		$this->set(compact('details', "allCities", "allStates", "allCountries", "transpoartRequirmentArray", "mealPlanArray"));
		$this->loadModel('UserChats');
		$unreadChatCount = $this->UserChats
								->find()
								->where(['UserChats.send_to_user_id' => $this->Auth->user('id'), "UserChats.is_read"=>0])
								->count();
		$this->set('unreadChatCount', $unreadChatCount);
    }

    public function requestlist() {
        $this->loadModel('Responses');
        $this->loadModel('Hotels');
        $this->loadModel('Requests');
        $this->loadModel('Cities');
		
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
        $this->set('users', $user);
		
        if ($this->Auth->user('role_id') == 1) {
            $requests = $this->Requests->find()
                            ->contain(["Users"])
                            ->where(['Requests.user_id' => $this->Auth->user('id'), "Requests.status !="=>2, "Requests.is_deleted"=>0])->order(["Requests.id" => "DESC"])->all();
        }
        if ($this->Auth->user('role_id') == 2) {
            $requests = $this->Requests->find()
                            ->contain(["Users"])
                            ->where(['Requests.user_id' => $this->Auth->user('id'), "Requests.status !="=>2, "Requests.is_deleted"=>0])->order(["Requests.id" => "DESC"])->all();
        }
        if ($this->Auth->user('role_id') == 3) {
            $requests = $this->Requests->find()
                            ->contain(["Users"])
                            ->where(['Requests.user_id' => $this->Auth->user('id'), 'Requests.category_id' => 3, "Requests.status !="=>2, "Requests.is_deleted"=>0])->order(["Requests.id" => "DESC"])->all();
          //  print_r($requests);
        }
        $this->set('requests', $requests);
		$myRequestCount = $myReponseCount = 0;
		$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.status !="=>2, "Requests.is_deleted"=>0]]);
		$myRequestCount = $query->count();
    
        $this->set('myRequestCount', $myRequestCount);

        $queryr = $this->Responses->find('all', ['conditions' => ['Responses.user_id' => $this->Auth->user('id')]]);
        $myReponseCount = $queryr->count();
        $this->set('myReponseCount', $myReponseCount);

		$this->loadModel('UserChats');
		$unreadChatCount = $this->UserChats
								->find()
								->where(['UserChats.send_to_user_id' => $this->Auth->user('id'), "UserChats.is_read"=>0])
								->count();
		$this->set('unreadChatCount', $unreadChatCount);
    }

	public function finalizedRequestList() {
        $this->loadModel('Responses');
        $this->loadModel('Hotels');
        $this->loadModel('Requests');
        $this->loadModel('Cities');
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
        $this->set('users', $user);
        $ids = [1, 2];
        if ($this->Auth->user('role_id') == 1) {
            $requests = $this->Requests->find()
                            ->contain(["Users"])
                            ->where(['Requests.user_id' => $this->Auth->user('id'), "Requests.status"=>2])->order(["Requests.id" => "DESC"])->all();
        }
        if ($this->Auth->user('role_id') == 2) {
            $requests = $this->Requests->find()
                            ->contain(["Users"])
                            ->where(['Requests.user_id' => $this->Auth->user('id'), "Requests.status"=>2])->order(["Requests.id" => "DESC"])->all();
        }
        if ($this->Auth->user('role_id') == 3) {
            $requests = $this->Requests->find()
                            ->contain(["Users"])
                            ->where(['Requests.user_id' => $this->Auth->user('id'), 'Requests.category_id' => 3, "Requests.status"=>2])->order(["Requests.id" => "DESC"])->all();
        }
        $this->set('requests', $requests);
		$myRequestCount = $myReponseCount = 0;
		$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.status !="=>2, "Requests.is_deleted"=>0]]);
		$myRequestCount = $query->count();
    
        $this->set('myRequestCount', $myRequestCount);

        $queryr = $this->Responses->find('all', ['conditions' => ['Responses.user_id' => $this->Auth->user('id')]]);
        $myReponseCount = $queryr->count();
        $this->set('myReponseCount', $myReponseCount);

		$allUsers = $this->Users->find('list',['keyField' => 'id', 'valueField' => 'first_name'])
				->hydrate(false)
				->toArray();
		$this->set('allUsers', $allUsers);

		$this->loadModel('UserChats');
		$unreadChatCount = $this->UserChats
								->find()
								->where(['UserChats.send_to_user_id' => $this->Auth->user('id'), "UserChats.is_read"=>0])
								->count();
		$this->set('unreadChatCount', $unreadChatCount);
    }

	public function removedRequestList() {
        $this->loadModel('Responses');
        $this->loadModel('Hotels');
        $this->loadModel('Requests');
        $this->loadModel('Cities');
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
        $this->set('users', $user);
        $ids = [1, 2];
        if ($this->Auth->user('role_id') == 1) {
            $requests = $this->Requests->find()
                            ->contain(["Users"])
                            ->where(['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1])->order(["Requests.id" => "DESC"])->all();
        }
        if ($this->Auth->user('role_id') == 2) {
            $requests = $this->Requests->find()
                            ->contain(["Users"])
                            ->where(['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1])->order(["Requests.id" => "DESC"])->all();
        }
        if ($this->Auth->user('role_id') == 3) {
            $requests = $this->Requests->find()
                            ->contain(["Users"])
                            ->where(['Requests.user_id' => $this->Auth->user('id'), 'Requests.category_id' => 3, "Requests.is_deleted"=>1])->order(["Requests.id" => "DESC"])->all();
        }
        $this->set('requests', $requests);
		$myRequestCount = $myReponseCount = 0;
		$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.status !="=>2, "Requests.is_deleted"=>0]]);
		$myRequestCount = $query->count();
    
        $this->set('myRequestCount', $myRequestCount);

        $queryr = $this->Responses->find('all', ['conditions' => ['Responses.user_id' => $this->Auth->user('id')]]);
        $myReponseCount = $queryr->count();
        $this->set('myReponseCount', $myReponseCount);

		$this->loadModel('UserChats');
		$unreadChatCount = $this->UserChats
								->find()
								->where(['UserChats.send_to_user_id' => $this->Auth->user('id'), "UserChats.is_read"=>0])
								->count();
		$this->set('unreadChatCount', $unreadChatCount);
    }

	

    public function respondtorequest() {
		Configure::write('debug',2);
        $this->loadModel('Transports');
        $this->loadModel('Hotels');
        $this->loadModel('Responses');
        $this->loadModel('Requests');
        $this->loadModel('Cities');
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
        $this->set('users', $user);
        $this->loadModel('BlockedUsers');
        $BlockedUsers = $this->BlockedUsers->find('list',['keyField' => "id",'valueField' => 'blocked_user_id'])
				->hydrate(false)
				->where(['blocked_by' => $this->Auth->user('id')])
				->toArray();
		if(!empty($BlockedUsers)) {
			$BlockedUsers = array_values($BlockedUsers);
		}
		array_push($BlockedUsers,$this->Auth->user('id'));
		$BlockedUsers = array_unique($BlockedUsers);
        if ($this->Auth->user('role_id') == 1) { // Travel Agent
			if(!empty($user["preference"])) {
				$conditionalStates = array_unique(array_merge(explode(",", $user["preference"]), array($user["state_id"])));
			} else {
				$conditionalStates = $user["state_id"];
			}
            $requests = $this->Requests->find()
                            ->contain(["Users", "Responses"])
							/*->matching('Responses', function(\Cake\ORM\Query $q) {
								return $q->where(['Responses.user_id !=' => $this->Auth->user('id')]);
							})*/
                            ->where(["OR"=>['Requests.state_id IN' => $conditionalStates, 'Requests.pickup_state IN' => $conditionalStates], 'Requests.user_id NOT IN' => $BlockedUsers, "Requests.status !="=>2, "Requests.is_deleted"=>0])
							->group('Requests.id')
							->order(["Requests.id" => "DESC"])->all();
        } else if ($this->Auth->user('role_id') == 2) { /// Event Planner
			$requests = $this->Requests->find()
                            ->contain(["Users"])
                            ->where(['Requests.pickup_state' => $user["state_id"], 'Requests.category_id' => 2, "Requests.status !="=>2, "Requests.is_deleted"=>0])->order(["Requests.id" => "DESC"])->all();
        }else if ($this->Auth->user('role_id') == 3) { /// Hotel
            $requests = $this->Requests->find()
                            ->contain(["Users", "Responses"])
							/*->matching('Responses', function(\Cake\ORM\Query $q) {
								return $q->select(['response_count' => $q->func()->count('*')])->where(['Responses.user_id !=' => $this->Auth->user('id')]);
							})*/
                            ->where(['Requests.city_id' => $this->Auth->user('city_id'), 'Requests.category_id' => 3, "Requests.status !="=>2, "Requests.is_deleted"=>0])
							->group('Requests.id')
							->order(["Requests.id" => "DESC"])->all();
        }
		//pr($requests); exit;
        $this->set('requests', $requests);
		//$this->set('responseToRequestCount', $requests->count($requests));

        $myRequestCount = $myReponseCount = 0;
		$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.status !="=>2, "Requests.is_deleted"=>0]]);
		$myRequestCount = $query->count();
    
        $this->set('myRequestCount', $myRequestCount);

        $queryr = $this->Responses->find('all', ['conditions' => ['Responses.user_id' => $this->Auth->user('id')]]);
        $myReponseCount = $queryr->count();
        $this->set('myReponseCount', $myReponseCount);

		$this->loadModel('UserChats');
		$unreadChatCount = $this->UserChats
								->find()
								->where(['UserChats.send_to_user_id' => $this->Auth->user('id'), "UserChats.is_read"=>0])
								->count();
		$this->set('unreadChatCount', $unreadChatCount);
    }

    public function myrequestlist() {
        $this->loadModel('Requests');
        $this->loadModel('Cities');
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
        $this->set('users', $user);
        $requests = $this->Requests->find()
                        ->contain(["Users"])
                        ->where(['Requests.user_id' => $this->Auth->user('id')])->all();
        //  print_r($requests);
        $this->set('requests', $requests);
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function finalrequest() {
        $this->loadModel('Requests');
        $this->loadModel('Cities');
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
        $this->set('users', $user);
        $finals = $this->Requests->find()
                        ->contain(["Users"])
                        ->where(['Requests.final_id' => $this->Auth->user('id'), 'Requests.status' => 2])->all();
        //print_r($finals);
        $this->set('finals', $finals);
        //print_r($finals);
    }

    public function checkresponses($id) {
        $this->loadModel('Responses');
        $this->loadModel('Requests');
        $this->loadModel('Cities');
		$this->loadModel('States');
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
        $this->set('users', $user);
        $responses = $this->Responses->find()
                        ->contain(["Users", "Requests", "UserChats"])
                        ->where(['Responses.request_id' => $id])->all();
        $this->set('responses', $responses);
        $requestDetails = $this->Requests->find()
                        ->contain(["Users", "UserRatings"])
                        ->where(['Requests.id' => $id])->first();
        //pr($requestDetails);exit;
        $this->set('requestDetails', $requestDetails);

		$allCities = $this->Cities->find('list',['keyField' => 'id', 'valueField' => 'name'])
				->hydrate(false)
				->toArray();
		$allStates = $this->States->find('list',['keyField' => 'id', 'valueField' => 'state_name'])
				->hydrate(false)
				->toArray();
		/*$allCountries = $this->Countries->find('list',['keyField' => 'id', 'valueField' => 'country_name'])
				->hydrate(false)
				->toArray();*/
		$allUsers = $this->Users->find('list',['keyField' => 'id', 'valueField' => 'first_name'])
				->hydrate(false)
				->toArray();
		$this->set('allUsers', $allUsers);
		$transpoartRequirmentArray = $this->_getTranspoartRequirmentsArray();
		$mealPlanArray = $this->_getMealPlansArray();

		$myRequestCount = $myReponseCount = 0;
		$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.status !="=>2, "Requests.is_deleted"=>0]]);
		$myRequestCount = $query->count();
    
        $this->set('myRequestCount', $myRequestCount);

        $queryr = $this->Responses->find('all', ['conditions' => ['Responses.user_id' => $this->Auth->user('id')]]);
        $myReponseCount = $queryr->count();
        $this->set('myReponseCount', $myReponseCount);

		$this->loadModel('UserChats');
		$unreadChatCount = $this->UserChats
								->find()
								->where(['UserChats.send_to_user_id' => $this->Auth->user('id'), "UserChats.is_read"=>0])
								->count();
		$this->set(compact("allCities", "allStates", "allCountries", "transpoartRequirmentArray", "mealPlanArray", "allUsers", "myRequestCount", "myReponseCount", 'unreadChatCount'));
    }

	public function acceptOffer() {
        $this->loadModel('Requests');
        $this->loadModel('Responses');
		$res = 0;
		if(isset($_POST["request_id"]) && !empty($_POST["request_id"]) && !empty($this->Auth->user('id'))) {
			$TableRequest = TableRegistry::get('Requests');
			$request = $TableRequest->get($_POST["request_id"]);
			$request->status = 2;
			$request->final_id = $_POST["response_id"];
			$request->response_id = $_POST["response_id"];
			if ($TableRequest->save($request)) {
				$TableResponse = TableRegistry::get('Responses');
				$response = $TableResponse->get($_POST["response_id"]);
				$response->status = 1;
				$TableResponse->save($response);
				$res = 1;
				//$this->Flash->success(__('Offer has been accepted successfully.'));
				//$this->redirect($this->referer());
			}
		}
		echo $res;
		exit;
    }
    public function myresponse($id) {
        $this->loadModel('Requests');
        $users = TableRegistry::get('Requests');
        $user = $users->get($id);
        $user->status = 3;
        $user->response_id = $this->Auth->user('id');

        if ($users->save($user)) {
            $this->redirect('/users/finalrequest/');
        } else {
            $this->redirect('/users/finalrequest/');
        }
    }

    public function viewprofile($id) {
        $this->loadModel('Cities');
        $user = $this->Users->find()->where(['id' => $id])->first();
        $this->set('users', $user);
    }

    public function myresponselist() {
		$this->loadModel('BusinessBuddies');
        $this->loadModel('Responses');
        $this->loadModel('Requests');
        $this->loadModel('Cities');
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
        $this->set('users', $user);
        $responses = $this->Responses->find()
                        ->contain(["Users", "Requests.Users", "UserChats"])
                        ->where(['Responses.user_id' => $this->Auth->user('id')])->order(["Responses.id" => "DESC"])->all();
        //echo "<pre>";print_r($responses); exit;
        $this->set('responses', $responses);
		
		$allUsers = $this->Users->find('list',['keyField' => 'id', 'valueField' => 'first_name'])
				->hydrate(false)
				->toArray();
		$this->set('allUsers', $allUsers);
        $myRequestCount = $myReponseCount = 0;
		$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.status !="=>2, "Requests.is_deleted"=>0]]);
		$myRequestCount = $query->count();
    
        $this->set('myRequestCount', $myRequestCount);

        $queryr = $this->Responses->find('all', ['conditions' => ['Responses.user_id' => $this->Auth->user('id')]]);
        $myReponseCount = $queryr->count();
        $this->set('myReponseCount', $myReponseCount);

		$BusinessBuddies = $this->BusinessBuddies->find('list',['keyField' => "bb_user_id",'valueField' => 'bb_user_id'])
				->hydrate(false)
				->where(['user_id' => $this->Auth->user('id')])
				->toArray();
		$this->set('BusinessBuddies', $BusinessBuddies);
		$this->loadModel('UserChats');
		$unreadChatCount = $this->UserChats
								->find()
								->where(['UserChats.send_to_user_id' => $this->Auth->user('id'), "UserChats.is_read"=>0])
								->count();
		$this->set('unreadChatCount', $unreadChatCount);
    }

	public function testMail() {
		Configure::write('debug',2);
	
		$from_email         = 'Dimension India Networks (P) Limited<32hr@dimensionindia.com>'; //from mail, it is mandatory with some hosts
		$recipient_email    = 'varshneymohit1@gmail.com';

		$textMessage = "Dear <b>Mohit Varshney</b>,
		\nWe’re delighted to extend this offer of employment for the position of Senior Software Engineer with <b>Dimension India Networks (P) Limited.</b> Please review this summary of terms and conditions for your anticipated employment with us.
		\nIf you accept this offer, your start date will be 15/05/2017 (Monday) or another mutually agreed upon date and you would report to Priyanka. 
		\nPlease find below the terms and conditions of your employment, should you accept this offer letter:
		\n<b>Position:</b>
		\nYour title will be Senior Software Engineer(CakePHP), and you will report to the Company’s Team Lead. This is a full-time position. While you are employed at this Company, you will not engage in any other employment, consulting or other business activity (whether full-time or part-time) that would create a conflict of interest with the Company. By signing this letter of agreement, you confirm that you have no contractual commitments or other legal obligations that would prohibit you from performing your duties for the Company.
		\n<b>Cash Compensation:</b>
		\nThe Company will pay you a starting salary at the rate of<b>INR 6.5 Lac</b> per year, payable in accordance with the Company’s standard payroll schedule, beginning 15/05/2017. This salary will be subject to adjustment pursuant to the Company’s employee compensation policies in effect from time to time.
		\n<b>Bonus (or Commission) Potential:</b>
		\nIn addition, you will be eligible to be considered for an incentive bonus for each fiscal year of the Company. The bonus (if any) will be awarded based on objective or subjective criteria established by the Company’s Chief Executive Officer and approved by the Company’s Board of Directors. Your target bonus will be equal to 10% of your annual base salary. Any bonus for the fiscal year in which your employment begins will be prorated, based on the number of days you are employed by the Company during that fiscal year. Any bonus for a fiscal year will be paid within 3 months after the close of that fiscal year, but only if you are still employed by the Company at the time of payment. The determinations of the Company’s Board of Directors with respect to your bonus will be final and binding.
		\n<b>Employee Benefits:</b>
		\nAs a regular employee of the Company, you will be eligible to participate in a number of Company-sponsored benefits. In addition, you will be entitled to paid vacation in accordance with the Company’s vacation policy.
		\n<b>Employment Relationship:</b>
		\nEmployment with the Company is for no specific period of time. Your employment with the Company will be “at will,” meaning that either you or the Company may terminate your employment at any time and for any reason, with or without cause. Any contrary representations that may have been made to you are superseded by this letter agreement. This is the full and complete agreement between you and the Company on this term. Although your job duties, title, compensation and benefits, as well as the Company’s personnel policies and procedures, may change from time to time, the “at will” nature of your employment may only be changed in an express written agreement signed by you and a duly authorized officer of the Company (other than you).
		\n<b>Termination:</b>
		\nThe Company reserves the right to terminate employment of any employee for just cause at any time without notice and without payment in lieu of notice. The Company will be entitled to terminate your employment for any reason other than for just cause, upon providing to you such minimum notice as required by law.
		\n<b>Privacy:</b>
		\nYou are required to observe and uphold all of the Company’s privacy policies and procedures as implemented or varied from time to time. Collection, storage, access to and dissemination of employee personal information will be in accordance with privacy legislation.
		\nWe at <b>Dimension India Networks (P) Limited</b> hope that you’ll accept to work with us and look forward to welcoming you aboard. Feel free to call Priyanka, if you have any questions or concerns.
		\n\nBest Regards,
		\nPriyanka
		\nHR Executive
		\n32hr@dimensionindia.com
		\nDimension India Networks (P) Limited.
		\nE-32, Sector-8, Noida 201301, INDIA
		";
		
		//Capture POST data from HTML form and Sanitize them, 
		//$sender_name    = filter_var("DD", FILTER_SANITIZE_STRING); //sender name
		//$reply_to_email = filter_var($_POST["sender_email"], FILTER_SANITIZE_STRING); //sender email used in "reply-to" header
		$subject        = filter_var("Offer Letter : DIMENSION INDIA NETWORKS (P) LTD.", FILTER_SANITIZE_STRING); //get subject from HTML form
		$message        = str_replace("&nbsp;", '', filter_var($textMessage, FILTER_SANITIZE_STRING)); //message
		
		/* //don't forget to validate empty fields 
		if(strlen($sender_name)<1){
			die('Name is too short or empty!');
		} 
		*/
		$fullpath = WWW_ROOT."files".DS."dimension.pdf";

		
		$info = pathinfo($fullpath);
		
		//Get uploaded file data
		$file_name =  "Dimension-Offer-Letter.pdf";
		$file_size        = filesize($fullpath);
		$file_type        = filetype($fullpath);

		//read from the uploaded file & base64_encode content for the mail
		$handle = fopen($fullpath, "r");
		$content = fread($handle, $file_size);
		fclose($handle);
		$encoded_content = chunk_split(base64_encode($content));

		$boundary = md5("sanwebe");
		//header
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "From:".$from_email."\r\n"; 
		//$headers .= "Reply-To: ".$reply_to_email."" . "\r\n";
		$headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n"; 
		
		//plain text 
		$body = "--$boundary\r\n";
		$body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
		$body .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
		$body .= chunk_split(base64_encode($message)); 
		
		//attachment
		$body .= "--$boundary\r\n";
		$body .="Content-Type: $file_type; name=".$file_name."\r\n";
		$body .="Content-Disposition: attachment; filename=".$file_name."\r\n";
		$body .="Content-Transfer-Encoding: base64\r\n";
		$body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n"; 
		$body .= $encoded_content; 
	
		$sentMail = @mail($recipient_email, $subject, $body, $headers);
		echo "done"; exit;
	}

	public function unreadChats() {
		Configure::write('debug',2);
		$this->loadModel('UserChats');
        $this->loadModel('Responses');
        $this->loadModel('Requests');
        $UserChats = $this->UserChats->find()
                        ->contain(["Users"/*, "Requests"*/])
                        ->where(['UserChats.send_to_user_id' => $this->Auth->user('id'), "is_read"=>0])->order(["UserChats.id" => "DESC"])->all()->toArray();
		
		//$unreadChatCount  = count($UserChats);
		//$this->set('unreadChatCount', $unreadChatCount);
		/// update reading status true
		$results = Hash::extract($UserChats, '{n}.id');
		if(!empty($results)) {
			$this->UserChats->updateAll(['is_read' => 1, "read_date_time"=>date("Y-m-d h:i:s")], ['id IN' => $results]);
		}
        $this->set('UserChats', $UserChats);

        $myRequestCount = $myReponseCount = 0;

		$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.status !="=>2, "Requests.is_deleted"=>0]]);
		$myRequestCount = $query->count();
        $this->set('myRequestCount', $myRequestCount);

        $queryr = $this->Responses->find('all', ['conditions' => ['Responses.user_id' => $this->Auth->user('id')]]);
        $myReponseCount = $queryr->count();
        $this->set('myReponseCount', $myReponseCount);
    }

    
    public function getcitylist() {
		$this->loadModel('Cities');
		$cities = $this->Cities->find()->all();
		$this->set(compact('cities'));
		$this->set('_serialize', ['cities']);

       
         
     }
	public function userVerification() {
		if (isset($_GET['ident']) && isset($_GET['activate'])) {
			$userId= $_GET['ident'];
			$activateKey = $_GET['activate'];
			$user = $this->Users
				->find()
				->where(['id' =>$userId])
				->first();
			if (!empty($user)) {
				if ($user['email_verified'] == 1) {
					$mobile_number = $user['mobile_number'];
					$theKey = $this->getActivationKey($mobile_number);
					if ($activateKey==$theKey) {
						$userObj= TableRegistry::get('Users');
						$userObj->updateAll(['email_verified' => 1], ['id' => $userId]);
						
						$this->Flash->success(__('Thank you, your account is activated now.'));
					}
				} else {
					$this->Flash->success(__('Thank you, your account is already activated.'));
				}
				$this->Auth->setUser($user);
				$this->redirect('/users/profileedit');
			} else {
				$this->Flash->error(__('Sorry something went wrong, please click on the link again'));
			}
		} else {
			$this->Flash->error(__('Sorry something went wrong, please click on the link again'));
		}
		$this->redirect('/');
	}
	public function getActivationKey($mobileNo) {
		if(empty($mobileNo)) {
			$mobileNo = 1234567890;
		}
		return md5(md5($mobileNo));
	}

	public function sendMail() {
		$subject="TravelB2Bhub Email Verification";
		 //$to=$d['email'];
		 $to="varshneymohit1@gmail.com";
		 $headers  = 'MIME-Version: 1.0' . "\r\n";
		 $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 $headers .= 'From: TravelB2Bhub <contactus@travelb2bhub.com>' . "\r\n";
		// $headers .= "Bcc: business.leadindia@gmail.com"; // BCC mail

		 //$message='<p>Dear '.$d['first_name'].'</p>';
		 $message='<p>Dear Mohit</p>';
		$message.='<p>Thank you for registering with TravelB2Bhub.com, the  COMMISSION FREE, Business to Business, tourism trading network. </p>';
		$message.='<p>Please verify your email address by clicking on the link below <a href="http://www.travelb2bhub.com/users/userVerification?ident=130&activate=ecc572011e9fcf2449f30655b276c723">click here<a></p>';
		$message.='<p>Note: You will receive a notification when there are enough registered members for you to begin trading. Please encourage your contacts to enroll.</p>';
		$message.='<p>We are committed to enhance your trading experience!</p>';
		$message.='<p>Sincerely,\nThe TravelB2Bhub Team</p>';
		 // Mail it
		 @mail($to, $subject, $message, $headers);
		echo "Mail sent";
		exit;
	}

	/**
	 * It is used to reset password of user itself, this function sends email with link to reset the password
	 *
	 * @access public
	 * @return void
	 */
	public function forgotPassword() {
		Configure::write('debug',2);
		if ($this->request->is('post')) {
			$d = $this->request->data;
			$user = $this->Users
				->find()
				->where(['email' =>$d['email']])
				->first();
			if (!empty($user)) {
				// check for unverified account
				/*if ($user['email_verified']==0) {
					$this->Flash->error(__('Your registration has not been confirmed yet please verify your email before reset password'));
					$this->redirect('/users/forgotPassword');
				} else {*/
					$theKey = $this->getActivationKey($user["mobile_number"]);
					$userId = $user["id"];
					$subject="TravelB2Bhub Reset Password";
					$to = $user["email"];
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= 'From: TravelB2Bhub <contactus@travelb2bhub.com>' . "\r\n";

					 $message='<p>Dear '.$user['first_name'].'</p>';
					$message.="<p>Reset your password, and we'll get you on your way.</p>";
					$message.='<p>To change your TravelB2Bhub password, click the following link into your browser:
					<a href="http://www.travelb2bhub.com/users/activatePassword?ident='.$userId.'&activate='.$theKey.'">click here</a></p>';
					$message.='<p>Sincerely,\nThe TravelB2Bhub Team</p>';

					// Mail it
					@mail($to, $subject, $message, $headers);
					$this->Flash->success(__('Please check your email for reset your password.'));
					$this->redirect('/pages/home');
				//}
			} else {
				$this->Flash->error(__('Incorrect Email.'));
			}
		}
	}
    
    /**
	 *  It is used to reset password when users click the link in their email
	 *
	 * @access public
	 * @return void
	 */
	public function activatePassword() {
		if ($this->request->is('post')) {
			if (!empty($this->request->data['ident']) && !empty($this->request->data['activate'])) {
				$this->set('ident',$this->request->data['ident']);
				$this->set('activate',$this->request->data['activate']);
				$userId= $this->request->data['ident'];
				$activateKey= $this->request->data['activate'];
				
				$user = $this->Users
				->find()
				->where(['id' =>$userId])
				->first();
				if (!empty($user)) {
					$mobile_number = $user['mobile_number'];
					$theKey = $this->getActivationKey($mobile_number);
					if ($activateKey==$theKey) {
						$user = $this->Users->patchEntity($user, ['password' => $this->request->data['password']]);
						if ($this->Users->save($user)) {
							$this->Flash->success(__('Your password has been reset successfully.'));

							/*$subject="TravelB2Bhub Changed Password";
							$to = $user["email"];
							$headers  = 'MIME-Version: 1.0' . "\r\n";
							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
							$headers .= 'From: TravelB2Bhub <contactus@travelb2bhub.com>' . "\r\n";

							 $message='<p>Dear '.$user['first_name'].'</p>';
							$message.="<p>Your Password has been reset successfully.</p>";
							$message.='<p><a href="http://www.travelb2bhub.com">Click here<a>, to login to your account.</p>';
							$message.='<p>Sincerely,\nThe TravelB2Bhub Team</p>';

							// Mail it
							@mail($to, $subject, $message, $headers);*/
							$this->redirect('/pages/home');
						} else {
							$this->Flash->error(__('Something went wrong, please send password reset link again'));
						}
					} else {
						$this->Flash->error(__('Something went wrong, please send password reset link again.'));
					}
				} else {
					$this->Flash->error(__('Something went wrong, please click again on the link in email.'));
				}
			} else {
				$this->Flash->error(__('Something went wrong, please click again on the link in email.'));
			}
		} else {
			if (isset($_GET['ident']) && isset($_GET['activate'])) {
				$this->set('ident',$_GET['ident']);
				$this->set('activate',$_GET['activate']);
			}
		}
	}

	public function deleteAllCache() {
        $iterator = new RecursiveDirectoryIterator(CACHE);
        foreach (new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::CHILD_FIRST) as $file) {
            $path_info = pathinfo($file);
            if($path_info['dirname']==CACHE."models") {
                @unlink($file->getPathname());
            }
            if($path_info['dirname']==CACHE."persistent") {
                @unlink($file->getPathname());
            }
            if($path_info['dirname']==CACHE."views") {
                @unlink($file->getPathname());
            }
            if($path_info['dirname']==TMP."cache") {
                if(!is_dir($file->getPathname())) {
                    @unlink($file->getPathname());
                }
            }
        }
        echo "Cache Deleted Successfully.";
		exit;
    }
	public function _getCertificatesArray() {
        return array("1"=>"IATA", "2"=>"TAFI", "3"=>"TAAI", "4"=>"IATO", "5"=>"ADYOI", "6"=>"ISO 9001", "7"=>"UFTAA", "8"=>"ADTOI");
    }
	public function _getHotelCategoriesArray() {
        return array("1"=>"Corporate Hotel", "2"=>"Boutique Hotel", "3"=>"Heritage Hotel", "4"=>"House Boat", "5"=>"Resort", "6"=>"Eco Resort", "7"=>"Farm-stay", "8"=>"Homestay", "9"=>"Heritage Homestay", "10"=>"Camping", "11"=>"Glamping");
    }

	public function _getTranspoartRequirmentsArray() {
        return array("1"=>"Luxury Car", "2"=>"Sedan", "3"=>"Innova/ Tavera", "4"=>"Tempo Traveller", "5"=>"AC Coach", "6"=>"Non AC Bus");
    }

	public function _getMealPlansArray() {
        return array("1"=>"EP - European Plan", "2"=>"CP - Contenental Plan", "3"=>"Modified American Plan", "4"=>"AP - American Plan");
    }

	

	function addNewDestinationRow() {
		$this->set("hotelCategories", $this->_getHotelCategoriesArray());

		$this->set("randomNumber", $_POST["number"]);

		$this->render('/Element/new_destination');
	}

	public function addresponse() {
        $this->loadModel('Responses');
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
        //print_r($user);
        $this->set('users', $user);
        if($this->request->is('post')){
			$d = $this->request->data;
			$d["user_id"] = $this->Auth->user('id');
			$d["status"] = 0;
			$response = $this->Responses->newEntity($d);
			if ($re = $this->Responses->save($response)) {
			   $this->Flash->success(__('Your response has bee submitted successfully.'));
				
			} else {
				$this->Flash->error(__('Sorry.'));
			}
		}
		return $this->redirect('/users/respondtorequest');
    }

	public function addNewsLatter() {
        $this->loadModel('NewsLatters');
		$res = 0;
		if(isset($_POST["news_latter_email"]) && !empty($_POST["news_latter_email"])) {
			$d["email"] = $_POST["news_latter_email"];
			$d["created"] = date("Y-m-d G:i:s");
			$checkUsers = $this->NewsLatters->find()->where(['email' => $d['email']])->count();
			if ($checkUsers < 1) {
				$addNewsLatter = $this->NewsLatters->newEntity($d);
				if($this->NewsLatters->save($addNewsLatter)) {
					$res = 1;
				} else {
					$res = 0;
				}
			} else {
				$res = 2;
			}
		}
		echo $res;
		exit;
    }

	public function blockUser() {
        $this->loadModel('BlockedUsers');
		$res = 0;
		if(isset($_POST["user_id"]) && !empty($_POST["user_id"]) && !empty($this->Auth->user('id'))) {
			$d["blocked_user_id"] = $_POST["user_id"];
			$d["blocked_by"] = $this->Auth->user('id');
			$d["created"] = date("Y-m-d G:i:s");
			$BlockUser = $this->BlockedUsers->newEntity($d);
			if($this->BlockedUsers->save($BlockUser)) {
				$res = 1;
			} else {
				$res = 0;
			}
		}
		echo $res;
		exit;
    }
	public function addBusinessBuddy() {
        $this->loadModel('BusinessBuddies');
		$res = 0;
		if(isset($_POST["user_id"]) && !empty($_POST["user_id"]) && !empty($this->Auth->user('id'))) {
			$d["bb_user_id"] = $_POST["user_id"];
			$d["user_id"] = $this->Auth->user('id');
			$d["created"] = date("Y-m-d h:i:s");
			$BusinessBuddy = $this->BusinessBuddies->newEntity($d);
			if($this->BusinessBuddies->save($BusinessBuddy)) {
				$res = 1;
			} else {
				$res = 0;
			}
		}
		echo $res;
		exit;
    }
	public function unblockUser() {
        $this->loadModel('BlockedUsers');
		$res = 0;
		if(isset($_POST["user_id"]) && !empty($_POST["user_id"]) && !empty($this->Auth->user('id'))) {
			if($this->BlockedUsers->deleteAll(["blocked_user_id"=>$_POST["user_id"]])) {
				$res = 1;
			} else {
				$res = 0;
			}
		}
		echo $res;
		exit;
    }
	public function blockedUserList() {
        $this->loadModel('Responses');
        $this->loadModel('Hotels');
        $this->loadModel('Requests');
        $this->loadModel('Cities');
		$this->loadModel('BlockedUsers');
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
        $this->set('users', $user);
		$blockedUsers = $this->BlockedUsers->find()
						->contain(["Users"])
						->where(['BlockedUsers.blocked_by' => $this->Auth->user('id')])->order(["BlockedUsers.id" => "DESC"])->all();
		//pr($blockedUsers); exit;
        $this->set('blockedUsers', $blockedUsers);
		$myRequestCount = $myReponseCount = 0;
		$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.status !="=>2, "Requests.is_deleted"=>0]]);
		$myRequestCount = $query->count();
    
        $this->set('myRequestCount', $myRequestCount);

        $queryr = $this->Responses->find('all', ['conditions' => ['Responses.user_id' => $this->Auth->user('id')]]);
        $myReponseCount = $queryr->count();
        $this->set('myReponseCount', $myReponseCount);

		$this->loadModel('UserChats');
		$unreadChatCount = $this->UserChats
								->find()
								->where(['UserChats.send_to_user_id' => $this->Auth->user('id'), "UserChats.is_read"=>0])
								->count();
		$this->set('unreadChatCount', $unreadChatCount);
    }

	public function businessBuddiesList() {
        $this->loadModel('Responses');
        $this->loadModel('Hotels');
        $this->loadModel('Requests');
        $this->loadModel('Cities');
		$this->loadModel('BusinessBuddies');
		$BusinessBuddies = $this->BusinessBuddies->find()
						->contain(["Users"])
						->where(['BusinessBuddies.user_id' => $this->Auth->user('id')])->order(["BusinessBuddies.id" => "DESC"])->all();
		//pr($BusinessBuddies); exit;
        $this->set('BusinessBuddies', $BusinessBuddies);
		$myRequestCount = $myReponseCount = 0;
		$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.status !="=>2, "Requests.is_deleted"=>0]]);
		$myRequestCount = $query->count();
    
        $this->set('myRequestCount', $myRequestCount);

        $queryr = $this->Responses->find('all', ['conditions' => ['Responses.user_id' => $this->Auth->user('id')]]);
        $myReponseCount = $queryr->count();
        $this->set('myReponseCount', $myReponseCount);

		$this->loadModel('UserChats');
		$unreadChatCount = $this->UserChats
								->find()
								->where(['UserChats.send_to_user_id' => $this->Auth->user('id'), "UserChats.is_read"=>0])
								->count();
		$this->set('unreadChatCount', $unreadChatCount);
    }

	public function removeRequest() {
        $this->loadModel('Requests');
		$res = 1;
		if(isset($_POST["request_id"]) && !empty($_POST["request_id"]) && !empty($this->Auth->user('id'))) {
			$TableRequest = TableRegistry::get('Requests');
			$request = $TableRequest->get($_POST["request_id"]);
			$request->is_deleted = 1;
			if ($TableRequest->save($request)) {
				$res = 1;
			}
		}
		echo $res;
		exit;
    }

	public function addChat() {
        $this->loadModel('UserChats');
        if($this->request->is('post')){
			
			$d = $this->request->data;
			$d["user_id"] = $this->Auth->user('id');
			$d["send_to_user_id"] = $d['chat_user_id'];
			$d["created"] = date("Y-m-d h:i:s");
			$UserChat = $this->UserChats->newEntity($d);
			if ($re = $this->UserChats->save($UserChat)) {
			   $this->Flash->success(__('Your message has been sent to user.'));
				
			} else {
				$this->Flash->error(__('Sorry, message could not send, please try again.'));
			}
		}
		return $this->redirect($this->referer());
    }
	public function rateUser() {
        $this->loadModel('UserRatings');
        /*if($this->request->is('post')){
			
			$d = $this->request->data;
			$d["request_id"] = $this->request->data["rating_request_id"];
			$d["user_id"] = $this->Auth->user('id');
			$d["created"] = date("Y-m-d G:i:s");
			$UserRating = $this->UserRatings->newEntity($d);
			if ($re = $this->UserRatings->save($UserRating)) {
			   $this->Flash->success(__('Thank you for rating.'));
				
			} else {
				$this->Flash->error(__('Sorry, rating could not added, please try again.'));
			}
		}
		return $this->redirect($this->referer());*/
		$res = 0;
		if(isset($_POST["request_id"]) && !empty($_POST["request_id"]) && !empty($this->Auth->user('id'))) {
			$d["request_id"] = $_POST["request_id"];
			$d["rating"] = $_POST["rating"];
			$d["user_id"] = $_POST["user_id"];
			$d["created"] = date("Y-m-d G:i:s");
			$UserRating = $this->UserRatings->newEntity($d);
			if ($re = $this->UserRatings->save($UserRating)) {
			   $res = 1;
				
			} else {
				$res = 0;
			}
		}
		echo $res;
		exit;
    }
	public function shareDetails() {
        $this->loadModel('Responses');
		$res = 0;
		if(isset($_POST["response_id"]) && !empty($_POST["response_id"]) && !empty($this->Auth->user('id'))) {
			$TableResponse = TableRegistry::get('Responses');
			$response = $TableResponse->get($_POST["response_id"]);
			$response->is_details_shared = 1;
			$TableResponse->save($response);
			if ($TableResponse->save($response)) {
				$res = 1;
			}
		}
		echo $res;
		exit;
    }
}

