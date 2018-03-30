<?php
namespace Cake\Routing;
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use App\Controller\AppController;
//use Cake\Mailer\Email;
use Cake\Utility\Hash;
use Cake\Core\Configure;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Email\Email;
/**
* Users Controller
*
* @property \App\Model\Table\UsersTable $Users 
*/
	
class UsersController extends AppController {
	var $helpers = array('Html', 'Form', 'Response');
	public function beforeFilter(\Cake\Event\Event $event) {
		parent::beforeFilter($event);
		$this->Auth->allow(['register', 'login','getcitylist', 'userVerification', 'forgotPassword', 'activatePassword', 'cakeVersion', 'deleteAllCache', 'addNewsLatter']);
	}
	
	public function beforeRender(\Cake\Event\Event $event) {
		parent::beforeRender($event);
		if($this->Auth->user()) {
			$this->set("respondToRequestCount", $this->__getRespondToRequestCount());
			$this->loadModel('UserChats');
			$unreadChats = $this->UserChats->find()
			->contain(["Users"/*, "Requests"*/])
			->where(['UserChats.send_to_user_id' => $this->Auth->user('id'), "UserChats.is_read"=>0])->order(["UserChats.id" => "DESC"])->all()->toArray();
			$unreadChatCount  = count($unreadChats);
			$this->set('unreadChatCount', $unreadChatCount);
			$this->set('UnreadUserChats', $unreadChats);
		}
	}
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		$first_name=$this->Auth->User('first_name');
		$last_name=$this->Auth->User('last_name');
		$profile_pic=$this->Auth->User('profile_pic');    
		$loginId=$this->Auth->User('id');
		$role_id=$this->Auth->User('role_id');
		$authUserName=$first_name.' '.$last_name;
		$this->set('MemberName',$authUserName);
		$this->set('profile_pic', $profile_pic);
		$this->set('loginId',$loginId);
		$this->set('roleId',$role_id);
		
		//----	 FInalized
		$this->loadModel('Requests');
		$finalreq["Requests.user_id"] = $this->Auth->user('id');
		$finalreq["Requests.status"] = 2;
		$finalreq["Requests.is_deleted "] = 0;
		$finalizeRequest = $this->Requests->find()->where($finalreq)->count();
		$this->set('finalizeRequest', $finalizeRequest);
		//--- Removed Request
		$remoev["Requests.user_id"] = $this->Auth->user('id');
		$remoev["Requests.is_deleted "] = 1;
		$RemovedReqest = $this->Requests->find()->where($remoev)->count();
		$this->set('RemovedReqest', $RemovedReqest);
		//--- Blocked User
		$this->loadModel('blocked_users');
		$blk["blocked_users.blocked_by"] = $this->Auth->user('id');
		$blockedUserscount = $this->blocked_users->find()->where($blk)->count();
		$this->set('blockedUserscount', $blockedUserscount);
		//--- Finalize Response;
		$this->loadModel('Responses');
		$FInalResponseCount = $this->Responses->find('all', ['conditions' => ['Responses.status' =>1,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id')]])->count();
		$this->set('FInalResponseCount', $FInalResponseCount);
		//*--- UserChats
		$this->loadModel('UserChats');
		$csort['created'] = "DESC";
		$allUnreadChat = $this->UserChats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->order($csort)->all();
		$chatCount = $allUnreadChat->count();
		$this->set('chatCount',$chatCount); 
		$this->set('allunreadchat',$allUnreadChat);
		//---
		
	}
	
	
	public function loginNew()
	{
		$this->viewBuilder()->layout('');
	}
	
	public function index() {
		
		$this->redirect('/users/dashboard');
	}
	
	
	public function promotions(){
		$this->viewBuilder()->layout('user_layout');
		$this->loadModel('Users');
		$this->loadModel('States');
		$this->loadModel('Cities');
		$cities = $this->Cities->getAllCities();
		$states = $this->States->getAllStates();
		$allstates = array();
		$allstatesList = array();
		$allStates = json_encode($allstates);
		$allCities = array();
		$allCityList = array();
		if(!empty($cities)) {
			foreach($cities as $city) {
				if($this->checkcityslot($city['id']) < 50){
					$usercount = $this->Users->getAllUserCount($city['id']);
					$allCities[] = array("label"=>str_replace("'", "", $city['name']),"usercount" => $usercount, "value"=>$city['id'],"price"=>$city['price'], "state_id"=>$city['state_id'], "state_name"=>$city['state']->state_name, "country_id"=>101, "country_name"=>"India");
					$allCityList[$city['id']] = $city['name'];
				}
			}
		}
		//$allCities = json_encode($allCities);
		$userId = $this->Auth->user('id');
		$userDetails = '';
		if($userId!=""){
			$userDetails = $this->Users->get($userId);
			$this->set("hotelCategories", $this->_getHotelCategoriesArray1());
		}
		$this->set(compact('cities', 'states', 'countries',  'allStates','allstatesList','allCityList','allCities','userId','userDetails'));
    }

	 public function promotionthanks(){
		$this->viewBuilder()->layout('user_layout');
		$thankscontent = "Thankyou! Your hotel's promotion has been successfully submitted.";
        $this->set(compact("thankscontent"));  
    }
	
	 function checkcityslot($city_id){
    	 $this->loadModel('Promotion');
		 $advertisementcount = $this->Promotion->find()->where(['status' => 1,'FIND_IN_SET(\''.  $city_id .'\',cities)'])->all();
		 $advertisementcount = $advertisementcount->count();
		 return $advertisementcount;
    }
	
	public function report() {
		$this->viewBuilder()->layout('admin_layout');
		$this->paginate = [
		'contain' => ['Cities','States']
		];
		$users = $this->paginate($this->Users);
		//pr($users->toArray()); exit;
		$this->set(compact('users'));
		$this->set('_serialize', ['users']);
		
	}
	
	
public function reportEdit($id = null)
    {
		$this->viewBuilder()->layout('admin_layout');
        $users = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $users = $this->Users->patchEntity($users, $this->request->data);
            if ($this->Users->save($users)) {
                $this->Flash->success(__('The Users has been saved.'));

                return $this->redirect(['action' => 'report']);
            } else {
                $this->Flash->error(__('The Users could not be saved. Please, try again.'));
            }
        } 
        $cities = $this->Users->Cities->find('list');
        $states = $this->Users->States->find('list');
        $countries = $this->Users->Countries->find('list');
		 
		$category[]=['text'=>'Travel Agent', 'value'=>'1'];
		$category[]=['text'=>'Event Planner', 'value'=>'2'];
		$category[]=['text'=>'Hotelier', 'value'=>'3'];
        $this->set(compact('Users', 'users', 'cities', 'states', 'countries', 'category'));
        $this->set('_serialize', ['Users']);
    }

	public function ajaxState()
    {
		$city_id=$this->request->data['id'];
		$cities=$this->Users->Cities->find()->where(['id'=>$city_id]);
		foreach($cities as $city){
			$state_id=$city->state_id;
		}
		$states=$this->Users->States->find('list')->where(['id'=>$state_id]);
		$state=$this->Users->States->find()->where(['id'=>$state_id]);
		 
		foreach($state as $stat){
			$country_id=$stat->country_id;
		}
		$countries=$this->Users->Countries->find('list')->where(['id'=>$country_id]);
        
        $this->set(compact('states', 'countries'));
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
$this->viewBuilder()->layout('');	
if ($this->Auth->user('id')) 
{
return $this->redirect('/users/dashboard');
}
date_default_timezone_set('Asia/Kolkata');
$this->loadModel('Credits');
$this->loadModel('Countries');
$this->loadModel('States');
$this->loadModel('Cities');
$this->loadModel('Membership');
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
$d['create_at'] = date("Y-m-d H:i:s");
/*$file = $d['image'];
$path = WWW_ROOT . "userimages" . DS . $file['name'];
move_uploaded_file($file['tmp_name'], $path);
$d['image'] = $file['name'];*/
if(isset($this->request->data["preference"]) && !empty($this->request->data["preference"])) {
	$d["preference"] = implode(",", $this->request->data["preference"]);
}
$d['country_id'] = 101;
$d['state_id'] = 877;
$d['city_id'] = 33;

$user = $this->Users->newEntity($d);
	if ($res = $this->Users->save($user)) {
		$subject="TravelB2Bhub registration";
		$to=$d['email'];
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: TravelB2Bhub <contactus@travelb2bhub.com>' . "\r\n";
		//$headers .= "Bcc: business.leadindia@gmail.com"; // BCC mail
		$message='<p>Dear '.$d['first_name'].',</p>';
		$message.='<p>Thank you for registering with TravelB2Bhub.com, the  COMMISSION FREE, Business to Business, tourism trading network. </p>';
		//$message.='<p>Update profile by <a href="https://www.travelb2bhub.com">click here</a> to login from Homepage.</p>';
		$message.='<p>Please verify your email address by <a href="https://www.travelb2bhub.com">click here</a> to login from Homepage.</p>';
		$message.='<p style="color:#000;">Note: You will receive a notification when there are enough registered members for you to begin trading. Please encourage your contacts to enroll.</p>';
		$message.='<p style="color:#000;">We are committed to enhance your trading experience!</p>';
		$message.='<p style="color:#000;">Sincerely,<br>The TravelB2Bhub Team</p>';
		$userId = $res->id;
		$subject= $d['first_name'].": TravelB2Bhub Account Activation";
		$to=$d['email'];


		$headers  = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= 'From: TravelB2Bhub <contactus@travelb2bhub.com>' . "\r\n";
		$theKey = $this->getActivationKey($d["mobile_number"]);

		$message='<p>Dear '.$d['first_name'].',</p>';
		$message.='<p>Thank you for registering with TravelB2Bhub.com, the  COMMISSION FREE, Business to Business, tourism trading network. </p>';
		$message.='<p>Please verify your email address by <span style="color:1E707E;"><a href="https://www.travelb2bhub.com/users/userVerification?ident='.$userId.'&activate='.$theKey.'">clicking here</a></span>. </p>';
		$message.='<p>We are committed to enhance your trading experience!</p>';
		$message.='<p>Sincerely,<br>The TravelB2Bhub Team</p>';
		// Mail it
		$email = new Email();    
			   $email->transport('gmail')
					->from(['webmaster@travelb2bhub.com'=>'TravelB2Bhub'])
					->to($to)
					->subject($subject)
					 ->emailFormat('html')
					->viewVars(array('msg' => $message))
					->send($message);


		//mail($to, $subject, $message, $headers);
		$uid = $res->id;
		$c['credit'] = 60;
		$c['user_Id'] = $uid;
		$creditd = $this->Credits->newEntity($c);
		$this->Credits->save($creditd);
		$this->Flash->success(__('Thank you for registering with Travelb2bhub.com! Please activate your account by clicking on the link sent to your e-mail address. If you do not receive an e-mail in your inbox, please check SPAM or JUNK folder.'));
		$this->redirect('/users/dashboard/');
	} 
	else {
	$this->Flash->error(__('The user could not be saved. Please, try again.'));
	}
} else {
$this->Flash->error(__('Email ID already exists. Please enter another Email ID to register.'));
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
$allCities[] = array("label"=>str_replace("'", "", $city['name'].' ('.$city['state']->state_name. ')'), "value"=>$city['id'], "state_id"=>$city['state_id'], "state_name"=>$city['state']->state_name, "country_id"=>101, "country_name"=>"India");
$allCityList[$city['id']] = $city['name'];

}
}
$allCities = json_encode($allCities);
$memberships = $this->Membership->find()->where(['status' => 1])->all();
$this->set(compact('cities', 'states', 'countries', 'allCities', 'allStates','memberships'));
}
/**
* Edit method
*
* @param string|null $id User id.
* @return void Redirects on successful edit, renders view otherwise.
* @throws \Cake\Network\Exception\NotFoundException When record not found.
*/
	public function edit($id) {
		$this->loadModel("TravelCertificates");
		$userDetails = $this->Users->get($id);
		if($this->request->is(['post', 'put'])) {
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
			else 
			{
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
			else 
			{
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
			else 
			{
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
			if($userDetails["role_id"] == 1) {
				if(is_uploaded_file($this->request->data['iata_pic']['tmp_name']) && !empty($this->request->data['iata_pic']['tmp_name']))
				{
					$path_info = pathinfo($this->request->data['iata_pic']['name']);
					chmod ($this->request->data['iata_pic']['tmp_name'], 0644);
					$photo=time().mt_rand().".".$path_info['extension'];
					$fullpath= WWW_ROOT."img".DS."user_travel_certificates".DS.$id;
					$res1 = is_dir($fullpath);
					if($res1 != 1) {
						$res2= mkdir($fullpath, 0777, true);
					}
					move_uploaded_file($this->request->data['iata_pic']['tmp_name'],$fullpath.DS.$photo);
					$this->request->data['iata_pic'] = $photo;
					/*if(!empty($user['iata_pic']) && file_exists($fullpath.DS.$user['iata_pic'])) {
					unlink($fullpath.DS.$user['iata_pic']);
					}*/
				}
				else {
					unset($this->request->data['iata_pic']);
				}
				if(is_uploaded_file($this->request->data['tafi_pic']['tmp_name']) && !empty($this->request->data['tafi_pic']['tmp_name']))
				{
					$path_info = pathinfo($this->request->data['tafi_pic']['name']);
					chmod ($this->request->data['tafi_pic']['tmp_name'], 0644);
					$photo=time().mt_rand().".".$path_info['extension'];
					$fullpath= WWW_ROOT."img".DS."user_travel_certificates".DS.$id;
					$res1 = is_dir($fullpath);
					if($res1 != 1) {
					$res2= mkdir($fullpath, 0777, true);
				}
				move_uploaded_file($this->request->data['tafi_pic']['tmp_name'],$fullpath.DS.$photo);
				$this->request->data['tafi_pic'] = $photo;
				}
				else {
					unset($this->request->data['tafi_pic']);
				}					
				if(is_uploaded_file($this->request->data['taai_pic']['tmp_name']) && !empty($this->request->data['taai_pic']['tmp_name']))
				{
					$path_info = pathinfo($this->request->data['taai_pic']['name']);
					chmod ($this->request->data['taai_pic']['tmp_name'], 0644);
					$photo=time().mt_rand().".".$path_info['extension'];
					$fullpath= WWW_ROOT."img".DS."user_travel_certificates".DS.$id;
					$res1 = is_dir($fullpath);
					if($res1 != 1) {
						$res2= mkdir($fullpath, 0777, true);
					}
					move_uploaded_file($this->request->data['taai_pic']['tmp_name'],$fullpath.DS.$photo);
					$this->request->data['taai_pic'] = $photo;
					/*if(!empty($user['taai_pic']) && file_exists($fullpath.DS.$user['taai_pic'])) {
					unlink($fullpath.DS.$user['taai_pic']);
					}*/
				}
				else {
					unset($this->request->data['taai_pic']);
				}
				if(is_uploaded_file($this->request->data['iato_pic']['tmp_name']) && !empty($this->request->data['iato_pic']['tmp_name']))
				{
					$path_info = pathinfo($this->request->data['iato_pic']['name']);
					chmod ($this->request->data['iato_pic']['tmp_name'], 0644);
					$photo=time().mt_rand().".".$path_info['extension'];
					$fullpath= WWW_ROOT."img".DS."user_travel_certificates".DS.$id;
					$res1 = is_dir($fullpath);
					if($res1 != 1) {
						$res2= mkdir($fullpath, 0777, true);
					}
					move_uploaded_file($this->request->data['iato_pic']['tmp_name'],$fullpath.DS.$photo);
					$this->request->data['iato_pic'] = $photo;
					/*if(!empty($user['iato_pic']) && file_exists($fullpath.DS.$user['iato_pic'])) {
					unlink($fullpath.DS.$user['iato_pic']);
					}*/
				}
				else {
					unset($this->request->data['iato_pic']);
				}
				if(is_uploaded_file($this->request->data['iso9001_pic']['tmp_name']) && !empty($this->request->data['iso9001_pic']['tmp_name']))
				{
					$path_info = pathinfo($this->request->data['iso9001_pic']['name']);
					chmod ($this->request->data['iso9001_pic']['tmp_name'], 0644);
					$photo=time().mt_rand().".".$path_info['extension'];
					$fullpath= WWW_ROOT."img".DS."user_travel_certificates".DS.$id;
					$res1 = is_dir($fullpath);
					if($res1 != 1) {
						$res2= mkdir($fullpath, 0777, true);
					}
					move_uploaded_file($this->request->data['iso9001_pic']['tmp_name'],$fullpath.DS.$photo);
					$this->request->data['iso9001_pic'] = $photo;
					/*if(!empty($user['iso9001_pic']) && file_exists($fullpath.DS.$user['iso9001_pic'])) {
					unlink($fullpath.DS.$user['iso9001_pic']);
					}*/
				}
				else {
					unset($this->request->data['iso9001_pic']);
				}
				if(is_uploaded_file($this->request->data['uftaa_pic']['tmp_name']) && !empty($this->request->data['uftaa_pic']['tmp_name']))
				{
					$path_info = pathinfo($this->request->data['uftaa_pic']['name']);
					chmod ($this->request->data['uftaa_pic']['tmp_name'], 0644);
					$photo=time().mt_rand().".".$path_info['extension'];
					$fullpath= WWW_ROOT."img".DS."user_travel_certificates".DS.$id;
					$res1 = is_dir($fullpath);
					if($res1 != 1) {
						$res2= mkdir($fullpath, 0777, true);
					}
					move_uploaded_file($this->request->data['uftaa_pic']['tmp_name'],$fullpath.DS.$photo);
					$this->request->data['uftaa_pic'] = $photo;
					/*if(!empty($user['uftaa_pic']) && file_exists($fullpath.DS.$user['uftaa_pic'])) {
					unlink($fullpath.DS.$user['uftaa_pic']);
					}*/
				}
				else {
					unset($this->request->data['uftaa_pic']);
				}
				if(is_uploaded_file($this->request->data['adtoi_pic']['tmp_name']) && !empty($this->request->data['adtoi_pic']['tmp_name']))
				{
					$path_info = pathinfo($this->request->data['adtoi_pic']['name']);
					chmod ($this->request->data['adtoi_pic']['tmp_name'], 0644);
					$photo=time().mt_rand().".".$path_info['extension'];
					$fullpath= WWW_ROOT."img".DS."user_travel_certificates".DS.$id;
					$res1 = is_dir($fullpath);
					if($res1 != 1) {
						$res2= mkdir($fullpath, 0777, true);
					}
					move_uploaded_file($this->request->data['adtoi_pic']['tmp_name'],$fullpath.DS.$photo);
					$this->request->data['adtoi_pic'] = $photo;
					/*if(!empty($user['adtoi_pic']) && file_exists($fullpath.DS.$user['adtoi_pic'])) {
					unlink($fullpath.DS.$user['adtoi_pic']);
					}*/
				}
				else {
					unset($this->request->data['adtoi_pic']);
				}
				if(is_uploaded_file($this->request->data['adyoi_pic']['tmp_name']) && !empty($this->request->data['adyoi_pic']['tmp_name']))
				{
					$path_info = pathinfo($this->request->data['adyoi_pic']['name']);
					chmod ($this->request->data['adyoi_pic']['tmp_name'], 0644);
					$photo=time().mt_rand().".".$path_info['extension'];
					$fullpath= WWW_ROOT."img".DS."user_travel_certificates".DS.$id;
					$res1 = is_dir($fullpath);
					if($res1 != 1) {
						$res2= mkdir($fullpath, 0777, true);
					}
					move_uploaded_file($this->request->data['adyoi_pic']['tmp_name'],$fullpath.DS.$photo);
					$this->request->data['adyoi_pic'] = $photo;
				}
				else {
					unset($this->request->data['adyoi_pic']);
				}
			}
			$user = $this->Users->patchEntity($userDetails, $this->request->data);
			//pr($user); exit;
			if ($this->Users->save($user)) {
				$this->Flash->error(__('User has been updated successfully.'));
				$result['msg'] = "User has been updated successfully";
				$this->redirect('/users/profileedit');
			} else {
				$this->Flash->error(__('Something went wrong please try again.'));
				$this->redirect('/users/profileedit');
			}
		}
		else 
		{
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
	$this->viewBuilder()->layout('');
if ($this->Auth->user('id')) {
return $this->redirect('/users/dashboard');
}
if ($this->request->is('post') || $this->request->query('provider')) {
$redirect_page = $this->request->data['redirect_page'];
if(!empty($redirect_page)){
$redirect_page = $redirect_page;
}else{
$redirect_page = '/users/dashboard';
}
$user = $this->Auth->identify();
if ($user) {
$this->Auth->setUser($user);
date_default_timezone_set('Asia/Kolkata');
$loggedinid = $this->Auth->user('id');
$logintime = date("Y-m-d h:i:s");
$current_date = date("Y-m-d");
$conn = ConnectionManager::get('default');
	
$sql = "UPDATE users SET last_login='".$logintime."' WHERE id='".$loggedinid."'";
$stmt = $conn->execute($sql);	
// set rating
$this->loadModel("Testimonial");
$testimonials = $this->Testimonial->find()->where(['user_id'=> $this->Auth->user('id')])->all();
$testimonialcount = $testimonials->count();
$this->request->session()->write('Auth.User.testimonialcount', (int)$testimonialcount);
$query = $this->Testimonial->find();
$userRating = $query->select(["average_rating" => $query->func()->avg("rating")])
->where(['user_id' => $this->Auth->user('id')])
->order(["id" => "DESC"])
->first();
$this->request->session()->write('Auth.User.avrage_rating', $userRating->average_rating);
return $this->redirect($redirect_page);
} else {
$this->Flash->error(__('Invalid username or password, or your account is not active, please try again.'));
return $this->redirect('/users/login');
}
}
$redirect_page = "";
if(isset($this->request->query['redirect'])){
$redirect_page = $this->request->query['redirect'];
}
$this->set('redirect_page', $redirect_page);
}
	
public function dashboard() {
date_default_timezone_set('Asia/Kolkata');
$current_date = date("Y-m-d");
//Configure::write('debug',2);
$this->loadModel('Requests');
$this->loadModel('Responses');
$this->loadModel('Promotion');
$this->loadModel('Testimonial');
$this->loadModel('User_Chats');
$this->viewBuilder()->layout('user_layout');
$user = $this->Users->find()
->contain(["Credits"])
->where(['Users.id' => $this->Auth->user('id')])->first();
$this->request->session()->write('Auth.User.profile_pic', $user->profile_pic);
$this->set('users', $user);
$this->set('userProfile', $user);
$myRequestCount = $myReponseCount = 0;
$myfinalCount  = 0;
$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status "=>2]]);
$myfinalCount = $query3 ->count();
$this->set('myfinalCount', $myfinalCount );
$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
$myRequestCount = $query->count();
$myRequestCount1 = $query->count(); 
$delcount=0;
$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1]]);
	foreach($requests as $req){
		$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
		if($rqueryr->count()!=0){
			$delcount++;
		}
	}
if($myRequestCount > $delcount) {
$myRequestCount = $myRequestCount-$delcount;
}
	//----	 FInalized
	$finalreq["Requests.user_id"] = $this->Auth->user('id');
	$finalreq["Requests.status"] = 2;
	$finalreq["Requests.is_deleted "] = 0;
	$finalizeRequest = $this->Requests->find()->where($finalreq)->count();
	$this->set('finalizeRequest', $finalizeRequest);
	//--- Removed Request
	$remoev["Requests.user_id"] = $this->Auth->user('id');
	$remoev["Requests.is_deleted "] = 1;
	$RemovedReqest = $this->Requests->find()->where($remoev)->count();
	$this->set('RemovedReqest', $RemovedReqest);
	//--- Blocked User
	$this->loadModel('blocked_users');
	$blk["blocked_users.blocked_by"] = $this->Auth->user('id');
	$blockedUserscount = $this->blocked_users->find()->where($blk)->count();
	$this->set('blockedUserscount', $blockedUserscount);
	//--- Finalize Response;
	$FInalResponseCount = $this->Responses->find('all', ['conditions' => ['Responses.status' =>1,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id')]])->count();
	$this->set('FInalResponseCount', $FInalResponseCount);
	//*---
$this->set('myRequestCountdel', $delcount);
$this->set('myRequestCount', $myRequestCount1);
$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id')]]);
$myReponseCount = $queryr->count(); 
$this->set('myReponseCount', $myReponseCount);
$usercity = $this->Users->find()->select(['city_id'])->where(['id' => $this->Auth->user('id')])->first();
$cityid =  $usercity['city_id'];
$advertisement1 = $this->Promotion->find()->where(['expiry_date >' => $current_date])->all();
$this->set('advertisement1',$advertisement1);
$this->set("hotelCategories", $this->_getHotelCategoriesArray1());
$testimonials = $this->Testimonial->find()->where(['user_id'=> $this->Auth->user('id')])->all();
$testimoniallist = array();
$alltestimonials = array();
if(!empty($testimonials)) {
foreach($testimonials as $testimonial) {
//$users = $this->Users->find()->where(['id'=> $this->Auth->user('id')])->first();
$users = $this->Users->find()->where(['id'=> $testimonial['author_id']])->first();				
$name = $users['first_name']." ".$users['last_name'];
$alltestimonials[] = array( "name"=>$name, "rating1"=>$testimonial['rating'], "description"=>$users['description'], "profile_pic"=>$users['profile_pic'], "comment"=>$testimonial['comment'],"user_id"=>$testimonial['user_id'],"author_id"=>$testimonial['author_id']);
}
}
$this->set('testimonial',$alltestimonials);
$csort['created'] = "DESC";
$allUnreadChat = $this->User_Chats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->order($csort)->limit(10)->all();
$chatCount = $allUnreadChat->count();
$this->set('chatCount',$chatCount); 
$this->set('allunreadchat',$allUnreadChat);
}
public function _getHotelCategoriesArray1() {
return array("1"=>"Corporate Hotel", "2"=>"Boutique Hotel", "3"=>"Heritage Hotel", "4"=>"House Boat", "5"=>"Resort", "6"=>"Eco Resort", "7"=>"Farm-stay", "8"=>"Homestay", "9"=>"Heritage Homestay", "10"=>"Camping", "11"=>"Glamping","12"=>"Dormitory");
}
public function viewuserprofile(){
}
	public function profileedit() {
		$this->loadModel("UserRatings");
		$this->loadModel("TravelCertificates");
		$this->loadModel('States');
		$this->loadModel('Cities');
		$this->loadModel('Requests');
		$this->loadModel('Responses');
		$this->viewBuilder()->layout('user_layout');
		$user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
		$this->set('users', $user);
		if(!empty($user)) {
			$userTravelCertificates = $this->TravelCertificates->find('list',['keyField' => 'certificate_name', 'valueField' => 'certificate_pic'])
				->hydrate(false)
				->where(['user_id' => $this->Auth->user('id')])
				->toArray();
			$myRequestCount = $myReponseCount = 0;
			$myfinalCount  = 0;
			$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status "=>2]]);
			$myfinalCount = $query3 ->count();
			$this->set('myfinalCount', $myfinalCount );
			$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
			$myRequestCount = $query->count();
			$myRequestCount1 = $query->count(); 
			$delcount=0;
			$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1]]);
			foreach($requests as $req){
				$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
				if($rqueryr->count()!=0){
					$delcount++;
				}
			}
			if($myRequestCount > $delcount) {
				$myRequestCount = $myRequestCount-$delcount;
			}
			$this->set('myRequestCountdel', $delcount);
			$this->set('myRequestCount', $myRequestCount1);
			$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.user_id' => $this->Auth->user('id')]]);
			$myReponseCount = $queryr->count();
			$this->set('myReponseCount', $myReponseCount);
			$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.user_id' => $this->Auth->user('id'),"Responses.is_deleted"=>0]]);
			$myReponseCount = $queryr->count();
			$this->set('myReponseCount', $myReponseCount);
			$cities = $this->Cities->getAllCities();
			$states = $this->States->find()->where(['country_id' => '101'])->all();
			$states_show=$this->Users->States->find('list');
			$country_show=$this->Users->Countries->find('list');
			$allStates = array();
			foreach($states as $state){
				$allStates[$state["id"]] = $state['state_name'];
			}
			$allCities = array();
			$allCityList = array();
			if(!empty($cities)) {
				foreach($cities as $city) {
					/*$allCities[] = array("label"=>str_replace("'", "", $city['name']), "value"=>$city['id'], "state_id"=>$city['state_id'], "state_name"=>$city['state']->state_name, "country_id"=>101, "country_name"=>"India");*/
					$allCities[] = array("label"=>str_replace("'", "", $city['name'].' ('.$city['state']->state_name. ')'), "value"=>$city['id'], "state_id"=>$city['state_id'], "state_name"=>$city['state']->state_name, "country_id"=>101, "country_name"=>"India");
					$allCityList[$city['id']] = str_replace("'", "", $city['name'].' ('.$city['state']->state_name. ')');
				}
			}
			$allCities = json_encode($allCities);
			$this->set(compact('states_show','country_show','cities', 'states', 'countries', 'allCities', 'allStates', 'allCityList', 'userTravelCertificates'));
		} 
		else {
			$this->Flash->error(__('Please login to acces this location.'));
			$this->redirect('/pages/home');
		}
		$this->set("travelCertificates", $this->_getCertificatesArray());
		$this->set("hotelCategories", $this->_getHotelCategoriesArray());
		$this->loadModel('User_Chats');
		$csort['created'] = "DESC";
		$allUnreadChat = $this->User_Chats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->order($csort)->limit(10)->all();
		$chatCount = $allUnreadChat->count();
		$this->set('chatCount',$chatCount); 
		$this->set('allunreadchat',$allUnreadChat);
	}


	public function ajaxCity()
    {
		
		$name=$this->request->data['input'];
		$noofrows=$this->request->data['noofrows'];
		$taxboxname=$this->request->data['taxboxname'];
		$cities=$this->Users->Cities->find()
		->contain(['States'])
		->where(['Cities.name Like'=>'%'.$name.'%']);
		?>
		<ul id="country-list">
			<?php foreach($cities as $show){ ?>
				<li onClick="selectCountry('<?php echo $show->name .' ('. $show->state->state_name .')'; ?>','<?php echo $show->id; ?>','<?php echo $show->state_id; ?>','<?php echo $noofrows; ?>');"  class="selectCountry" cty_nm="<?php echo $show->name .' ('. $show->state->state_name .')'; ?>" cty_id="<?php echo $show->id; ?>" stat_id="<?php echo $show->state_id; ?>" noofrows="<?php echo $noofrows; ?>" taxboxname="<?php echo $taxboxname; ?>">
					<?php echo $show->name .' ('. $show->state->state_name .')';  ?>
				</li>
			<?php } ?>
		</ul>
		<?php
		 exit;  
    }

	public function ajaxStateShow()
    {
		$state_id=$this->request->data['state_id'];
		$states=$this->Users->States->find('list')->where(['States.id'=>$state_id]);
		$statess=$this->Users->States->find()->where(['States.id'=>$state_id]);
		foreach($statess as $st_show){
			$country_id=$st_show->country_id;
		}
		$countries=$this->Users->Countries->find('list')->where(['Countries.id'=>$country_id]);
		$this->set(compact('states','countries'));
    }
	public function ajaxStateShowNew()
    {
		$state_id=$this->request->data['state_id'];
		$noofrows=$this->request->data['noofrows'];
		$taxboxname=$this->request->data['taxboxname'];
		$states=$this->Users->States->find('list')->where(['States.id'=>$state_id]);
		$statess=$this->Users->States->find()->where(['States.id'=>$state_id]);
		//pr($statess);
		foreach($statess as $st_show){
			$country_id=$st_show->country_id;
		}
		$countries=$this->Users->Countries->find('list')->where(['Countries.id'=>$country_id]);
		$this->set(compact('states','countries','noofrows','taxboxname'));
    }


	 public function ajaxDestStateShow()
    {
		$state_id=$this->request->data['state_id'];
		$states=$this->Users->States->find('list')->where(['States.id'=>$state_id]);
		$statess=$this->Users->States->find()->where(['States.id'=>$state_id]);
		foreach($statess as $st_show){
			$country_id=$st_show->country_id;
		}
		$countries=$this->Users->Countries->find('list')->where(['Countries.id'=>$country_id]);
		$this->set(compact('states','countries'));
     }

public function changePassword() {
	$this->viewBuilder()->layout('user_layout');
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
$this->Flash->successnew(__('Your password has been changed successfully.'));
//$this->redirect('/users/dashboard');
}
} else {
//echo "not mached"; exit;
$this->Flash->error(__('Current Password does not matched.'));
}
}
$myRequestCount = $myReponseCount = 0;
$myfinalCount  = 0;
$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status "=>2]]);
$myfinalCount = $query3 ->count();
$this->set('myfinalCount', $myfinalCount );
$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
$myRequestCount = $query->count();
$myRequestCount1 = $query->count(); 
$delcount=0;
$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1]]);
foreach($requests as $req){
$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
if($rqueryr->count()!=0){
$delcount++;
}
}
if($myRequestCount > $delcount) {
$myRequestCount = $myRequestCount-$delcount;
}	
$this->set('myRequestCountdel', $delcount);
$this->set('myRequestCount', $myRequestCount1);
$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'Responses.status' =>0,'conditions' => ['Responses.user_id' => $this->Auth->user('id')]]);
$myReponseCount = $queryr->count();
$this->set('myReponseCount', $myReponseCount);

		$this->loadModel('User_Chats');
		$csort['created'] = "DESC";
		$allUnreadChat = $this->User_Chats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->order($csort)->limit(10)->all();
		$chatCount = $allUnreadChat->count();
		$this->set('chatCount',$chatCount); 
		$this->set('allunreadchat',$allUnreadChat);

} else {
$this->Flash->error(__('Please login to access this location.'));
$this->redirect('/pages/home');
}
}

public function sendrequest() {
	$this->viewBuilder()->layout('user_layout');	
	date_default_timezone_set('Asia/Kolkata');
	//Configure::write('debug',2);
	$this->loadModel('Requests');
	$this->loadModel('Responses');
	$this->loadModel('RequestStops');
	$this->loadModel('Hotels');
	$this->loadModel('User_Chats');
	$this->viewBuilder()->layout('user_layout');
	$user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
	//print_r($user);
	$this->set('users', $user);
	$myRequestCount = $myReponseCount =  0;
	$myfinalCount  = 0;
	$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status "=>2]]);
	$myfinalCount = $query3 ->count();
	$this->set('myfinalCount', $myfinalCount );
	$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
	$myRequestCount = $query->count();
	$myRequestCount1 = $query->count(); 
	$delcount=0;
	$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1]]);
	foreach($requests as $req){
		$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
		if($rqueryr->count()!=0){
			$delcount++;
		}
	}
	if($myRequestCount > $delcount) {
		$myRequestCount = $myRequestCount-$delcount;
	}	
	$this->set('myRequestCountdel', $delcount);
	$this->set('myRequestCount', $myRequestCount1);
	$reqcount = $this->getSettings('requestcount');
	$this->set('delcount', $delcount);
	$plcreqcount = (($reqcount['value']-$myRequestCount1)-($delcount+ $myfinalCount));
	//echo $myRequestCount1; die();
	if($myRequestCount1 >=10){
		$msg = "You have exceeded the count of permissible open requests. You must Finalize a Request or Remove a Request in order to proceed with placing another request.";
		$this->Flash->error(__($msg));
		return $this->redirect('/users/requestlist');
	}
	elseif($plcreqcount<=0){
		$this->Flash->error(__('Sorry, You cannot add more than '.$reqcount["value"] .' request.'));
		return $this->redirect('/users/dashboard');
	}
	elseif($myRequestCount < $reqcount['value']) {
	
if($this->request->is('post')){
$d = $this->request->data;

//Change input date format to mysql date format
if(isset($d['check_in']) && !empty($d['check_in']))
{
$d['check_in']=date('Y-m-d',strtotime($d['check_in']));
}
else{
$d['check_in']	='0000-00-00';
}
if(isset($d['check_out']) && !empty($d['check_out']))
{
$d['check_out']=date('Y-m-d',strtotime($d['check_out']));
}
else{
$d['check_out']	='0000-00-00';
}
if(isset($d['start_date']) && !empty($d['start_date']))
{
$d['start_date']=date('Y-m-d',strtotime($d['start_date']));
}
else{
$d['start_date']	='0000-00-00';
}
if(isset($d['end_date']) && !empty($d['end_date']))
{
$d['end_date']=date('Y-m-d',strtotime($d['end_date']));
}
else{
$d['end_date']	='0000-00-00';
}
/* 
$d['check_in'] = (isset($d['check_in']) && !empty($d['check_in']))?$this->ymdFormatByDateFormat($d['check_in'], "d-m-Y", $dateSeparator="/"):null;
$d['check_out'] = (isset($d['check_out']) && !empty($d['check_out']))?$this->ymdFormatByDateFormat($d['check_out'], "d-m-Y", $dateSeparator="/"):null;
$d['start_date'] = (isset($d['start_date']) && !empty($d['start_date']))?$this->ymdFormatByDateFormat($d['start_date'], "d-m-Y", $dateSeparator="/"):null;
$d['end_date'] = (isset($d['end_date']) && !empty($d['start_date']))?$this->ymdFormatByDateFormat($d['end_date'], "d-m-Y", $dateSeparator="/"):null; */

	if($this->request->data['category_id'] == 2 ){
		$p['transport_requirement'] = $d['transport_requirement'];
		$p['pickup_city'] = $d['t_pickup_city_id'];
		$p['pickup_state'] = $d['t_pickup_state_id'];
		$p['pickup_country'] = $d['t_pickup_country_id'];
		$p['final_city'] = $d['t_final_city_id'];
		$p['final_state'] = $d['t_final_state_id'];
		$p['final_country'] = $d['t_final_country_id'];
		$p['pickup_locality'] = $d['pickup_locality'];
		$p['final_locality'] = $d['finalLocality'];
		$p['start_date'] = $d['start_date'];
		$p['end_date'] = $d['end_date'];
		$p['comment'] = $d['comment'];
		$p['category_id'] = $d['category_id'];
		$p['reference_id'] = $d['reference_id'];
		$p['user_id'] = $this->Auth->user('id');
		$p['total_budget'] = $d['total_budget'];
		$p['adult'] = $d['transportAdult'];
		$p['children'] = $d['transportChildren'];
		$stopes = "";
		if(isset($d['stops'])) {
			foreach($d['stops'] as $key=>$row) {
				$stopes .=  $row.",";
			}
		}
		$p['stops'] = $stopes;
		//pr($p); exit;
		$contact = $this->Requests->newEntity($p);
		if ($re = $this->Requests->save($contact)) {
		$ui = $re->id;
		if(isset($d['stops'])) {
		foreach($d['stops'] as $key=>$row) {
		$stopData['request_id'] = $ui;
		$stopData['locality'] =  $row;
		$stopData['city_id'] =  $d['id_trasport_stop_city'][$key];
		$stopData['state_id'] =  $d['state_id_trasport_stop_city'][$key];
		$result = $this->RequestStops->newEntity($stopData);
		$this->RequestStops->save($result);
		}
		}
		/*Users List */
		$userchatTable = TableRegistry::get('User_Chats');
		$conn = ConnectionManager::get('default');
		$sql = "SELECT * FROM users WHERE id !='".$this->Auth->user('id')."' AND role_id in ('1') AND FIND_IN_SET ('".$p['pickup_state']."', preference) > 0";
		$stmt = $conn->execute($sql);
		$Userlist = $stmt ->fetchAll('assoc');
			foreach($Userlist as $usr)
			{
				$sql1="Select count(*) as block_count from blocked_users where blocked_user_id='".$usr['id']."' AND blocked_by='".$this->Auth->user('id')."'";
					$stmt = $conn->execute($sql1);
					$bresult = $stmt ->fetch('assoc');
				if($bresult['block_count']==0){
					$userchats = $userchatTable->newEntity();
					$userchats->request_id = $ui;
					$userchats->user_id = $this->Auth->user('id');
					$userchats->send_to_user_id = $usr["id"];
					$userchats->message = "You have received a Request! Click here to go RESPOND TO REQUEST tab to view it.";
					$userchats->created = date("Y-m-d h:i:s");
					$userchats->notification = 1;;
					if ($userchatTable->save($userchats)) {
						$id = $userchats->id;
					}
				}
			}		
			
                        
			$this->Flash->success(__('Congratulations! Your Request has been submitted!'));
				return $this->redirect('/users/requestlist');
			} 
			else {
				$this->Flash->error(__('Sorry.'));
				return $this->redirect('/users/sendrequest');
			}
		} 
else if($this->request->data['category_id'] == 1 ){
	
	$p['transport_requirement'] = $d['transport_requirement'];
	$p['pickup_city'] = $d['pickup_city_id'];
	$p['pickup_state'] = $d['pickup_state_id'];
	$p['pickup_country'] = $d['pickup_country_id'];
	$p['pickup_locality'] = $d['pickup_locality'];
	$p['final_locality'] = $d['finalLocality'];
	$p['final_city'] = $d['p_final_city_id'];
	$p['final_state'] = $d['p_final_state_id'];
	$p['final_state'] = $d['p_final_state_id'];
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
	//$p['stops'] =  $d['stops'];
	$p['room1'] =  $d['room1'];
	$p['room2'] =  $d['room2'];
	$p['room3'] =  $d['room3'];
	$p['child_with_bed'] =  $d['child_with_bed'];
	$p['child_without_bed'] =  $d['child_without_bed'];
	$p['hotel_rating'] = $d['hotel_rating'];
	$p['hotel_category'] = $d['hotel_category'] = (isset($d['hotel_category']) && !empty($d['hotel_category']))?implode(",", $d['hotel_category']):"";
	//$p['meal_plan'] = $d['meal_plan'] = (isset($d['meal_plan']) && !empty($d['meal_plan']))?implode(",", $d['meal_plan']):"";
	$p['meal_plan'] = $d['meal_plan'];
	//$p['stops'] = $d['stops'] = (isset($d['stops']) && !empty($d['stops']))?implode(",", $d['stops']):"";
	$stopes = "";
	if(isset($d['stops'])) {
		foreach($d['stops'] as $key=>$row) {
			$stopes .=  $row.",";
		}
	}
$p['stops'] = $stopes;
$p['check_in'] =  $d['check_in'];
$p['check_out'] =  $d['check_out'];
//pr($d); exit;
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

if(isset($d['hh_check_in'][$key]) && !empty($d['hh_check_in'][$key]))
{
$hotalExtraData['check_in']=date('Y-m-d',strtotime($d['hh_check_in'][$key]));
}
else{
$hotalExtraData['check_in']	='0000-00-00';
}

if(isset($d['hh_check_out'][$key]) && !empty($d['hh_check_out'][$key]))
{
$hotalExtraData['check_out']=date('Y-m-d',strtotime($d['hh_check_out'][$key]));
}
else{
$hotalExtraData['check_out']	='0000-00-00';
}

/* $hotalExtraData['check_in'] =  ($d['hh_check_in'][$key])?$this->ymdFormatByDateFormat($d['hh_check_in'][$key], "d-m-Y", $dateSeparator="/"):null;
$hotalExtraData['check_out'] =  ($d['hh_check_out'][$key])?$this->ymdFormatByDateFormat($d['hh_check_out'][$key], "d-m-Y", $dateSeparator="/"):null; */
$result = $this->Hotels->newEntity($hotalExtraData);
//pr($result->toArray());exit;
$this->Hotels->save($result);
}
}
if(isset($d['stops'])) {
foreach($d['stops'] as $key=>$row) {
$stopData['request_id'] = $ui;
$stopData['locality'] =  $row;
$stopData['city_id'] =  $d['id_package_stop_city'][$key];
$stopData['state_id'] =  $d['state_id_package_stop_city'][$key];
$result = $this->RequestStops->newEntity($stopData);
$this->RequestStops->save($result);
}
}			
/*Users List */
$userchatTable = TableRegistry::get('User_Chats');
$conn = ConnectionManager::get('default');
$sql = "SELECT * FROM users WHERE id !='".$this->Auth->user('id')."' AND role_id in ('1') AND FIND_IN_SET ('".$p['state_id']."', preference) > 0 ";
$stmt = $conn->execute($sql);
$Userlist = $stmt ->fetchAll('assoc');            
			foreach($Userlist as $usr)
			{
				$sql1="Select count(*) as block_count from blocked_users where blocked_user_id='".$usr['id']."' AND blocked_by='".$this->Auth->user('id')."'";
				$stmt = $conn->execute($sql1);
				$bresult = $stmt ->fetch('assoc');
				if($bresult['block_count']==0){
					$userchats = $userchatTable->newEntity();
					$userchats->request_id = $ui;
					$userchats->user_id = $this->Auth->user('id');
					$userchats->send_to_user_id = $usr["id"];
					$userchats->message = "You have received a Request! Click here to go RESPOND TO REQUEST tab to view it.";
					$userchats->created = date("Y-m-d h:i:s");
					$userchats->notification = 1;;
					if ($userchatTable->save($userchats)) {
						$id = $userchats->id;
					}
				}
			}
	
$this->Flash->success(__('Congratulations! Your Request has been submitted!'));
return $this->redirect('/users/requestlist');
} else {
$this->Flash->error(__('Sorry.'));
return $this->redirect('/users/sendrequest');
}
} 
elseif($this->request->data['category_id'] == 3 ){
	$p['category_id'] = $d['category_id'];
	$p['reference_id'] = $d['reference_id'];
	$p['user_id'] = $this->Auth->user('id');
	$p['total_budget'] = $d['total_budget'];
	$p['adult'] = $d['hotelAdult'];
	$p['children'] = $d['hotelChildren'];
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
	//print_r($p); exit;
	$contact = $this->Requests->newEntity($p);
	if ($re = $this->Requests->save($contact)) {
	$ui = $re->id;
	$d['req_id'] = $ui;
	$d['user_id'] = $this->Auth->user('id');
	$rest = $this->Hotels->newEntity($d);
	$this->Hotels->save($rest);//exit;
	/*Users List */
		/*For Travel Agent*/
	$userchatTable = TableRegistry::get('User_Chats');
	$conn = ConnectionManager::get('default');
	$sql = "SELECT * FROM users WHERE id !='".$this->Auth->user('id')."' AND role_id in ('1') AND FIND_IN_SET ('".$p['state_id']."', preference) > 0 ";
	$stmt = $conn->execute($sql);
	$Userlist = $stmt ->fetchAll('assoc');            
			foreach($Userlist as $usr)
			{
				$sql1="Select count(*) as block_count from blocked_users where blocked_user_id='".$usr['id']."' AND blocked_by='".$this->Auth->user('id')."'";
					$stmt = $conn->execute($sql1);
					$bresult = $stmt ->fetch('assoc');
						if($bresult['block_count']==0){
				$userchats = $userchatTable->newEntity();
				$userchats->request_id = $ui;
				$userchats->user_id = $this->Auth->user('id');
				$userchats->send_to_user_id = $usr["id"];
				$userchats->message = "You have received a Request! Click here to go RESPOND TO REQUEST tab to view it.";
				$userchats->created = date("Y-m-d h:i:s");
				$userchats->notification = 1;
				if ($userchatTable->save($userchats)) {
				$id = $userchats->id;
				}
							
					}
			}
/*For Travel Agent*/
	
	/*For Hotelier*/
	$sqlh = "SELECT * FROM users WHERE id !='".$this->Auth->user('id')."' AND role_id in ('3') AND city_id='".$p['city_id']."'";
$stmth = $conn->execute($sqlh);
$Userlisth = $stmth->fetchAll('assoc');            
			foreach($Userlisth as $usrh)
			{
				$sql1="Select count(*) as block_count from blocked_users where blocked_user_id='".$usrh['id']."' AND blocked_by='".$this->Auth->user('id')."'";
					$stmt = $conn->execute($sql1);
					$bresult = $stmt->fetch('assoc');
						if($bresult['block_count']==0){	
							$userchats = $userchatTable->newEntity();
				$userchats->request_id = $ui;
				$userchats->user_id = $this->Auth->user('id');
				$userchats->send_to_user_id = $usrh["id"];
				$userchats->message = "You have received a Request! Click here to go RESPOND TO REQUEST tab to view it.";
				$userchats->created = date("Y-m-d h:i:s");
				$userchats->notification = 1;
				if ($userchatTable->save($userchats)) {
				$id = $userchats->id;
				}	
					}
			}
	/*For Hotelier*/	
$this->Flash->success(__('Congratulations! Your Request has been submitted!'));
return $this->redirect('/users/requestlist');
} else {
$this->Flash->error(__('Sorry.'));
return $this->redirect('/users/sendrequest');
}
}
/*Users List */				
$Userlist = $this->Users->find()
->where(['id !=' => $this->Auth->user('id'),'role_id IN'=>1,3])->all()->toArray();	
$userchatTable = TableRegistry::get('User_Chats');
$userchats = $userchatTable->newEntity();
foreach($Userlist as $usr){
$userchats->request_id = $d['req_id'];
$userchats->user_id = $this->Auth->user('id');
$userchats->send_to_user_id = $usr["id"];
$userchats->message = "You have received a Request! Click here to go RESPOND TO REQUEST tab to view it.";
$userchats->created = date("Y-m-d h:i:s");
$userchats->notification = 1;;
if ($userchatTable->save($userchats)) {
$id = $userchats->id;
}
}
}
} else {
$this->Flash->error(__('Sorry, You cannot add more than '.$reqcount["value"] .' request.'));
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
$cit = $city['name'].' ('.$city['state']->state_name.')';
$allCities[] = array("label"=>str_replace("'", "", $cit), "value"=>$city['id'], "state_id"=>$city['state_id'], "state_name"=>$city['state']->state_name, "country_id"=>101, "country_name"=>"India");
$allCityList[$city['id']] = $city['name'];
}
}
$allCities = json_encode($allCities);
$this->set(compact('cities', 'states', 'countries', 'allCities', 'allStates', 'allCityList'));
$this->set("hotelCategories", $this->_getHotelCategoriesArray());
$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.user_id' => $this->Auth->user('id')]]);
$myReponseCount = $queryr->count();
$this->set('myReponseCount', $myReponseCount);
$this->loadModel('User_Chats');
$csort['created'] = "DESC";
$allUnreadChat = $this->User_Chats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->order($csort)->limit(10)->all();
$chatCount = $allUnreadChat->count();
$this->set('chatCount',$chatCount); 
$this->set('allunreadchat',$allUnreadChat);
}
public function hotelrequest() {
$this->loadModel('Hotels');
$user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
//print_r($user);register

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
$this->loadModel('Responses');
$user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
$this->set('users', $user);
$details = $this->Requests->find()
->contain(["Users", "UserRatings", "Hotels", "RequestStops"])
->where(['Requests.id' => $id])->first();
$allCities = $this->Cities->find('list',['keyField' => 'id', 'valueField' => 'name'])
->hydrate(false)
->toArray();
$allStates = $this->States->find('list',['keyField' => 'id', 'valueField' => 'state_name'])
->hydrate(false)
->toArray();
$transpoartRequirmentArray = $this->_getTranspoartRequirmentsArray();
$mealPlanArray = $this->_getMealPlansArray();
$this->set("hotelCategories", $this->_getHotelCategoriesArray());
$this->set(compact('details', "allCities", "allStates", "allCountries", "transpoartRequirmentArray", "mealPlanArray"));
}
	public function requestlist() {
		$this->loadModel('Responses');
		$this->loadModel('Hotels');
		$this->loadModel('Requests');
		$this->loadModel('Cities');
		$this->loadModel('States');
		$this->loadModel('User_Chats');
		$this->viewBuilder()->layout('user_layout');	
		$user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
		$this->set('users', $user);
		if(!empty($this->request->query("keyword"))) {
			$conditions["Requests.reference_id LIKE "] = "%".$this->request->query("keyword")."%";
		}
		if(!empty($this->request->query("budgetsearch"))) {
		$QPriceRange = $this->request->query("budgetsearch");
		$result = explode("-", $QPriceRange);
		$MinQuotePrice = $result[0];
		$MaxQuotePrice = $result[1];
		$conditions["Requests.total_budget >="] = $MinQuotePrice;
		$conditions["Requests.total_budget <="] = $MaxQuotePrice;
		}
		if(!empty($this->request->query("req_typesearch"))) {
		$conditions["Requests.category_id"] =  $this->request->query("req_typesearch");
		}
		if(!empty($this->request->query("refidsearch"))) {
		$conditions["Requests.reference_id"] =  $this->request->query("refidsearch");
		}
		if(!empty($this->request->query("destination_city"))) {
		$conditions["Requests.city_id"] =  $this->request->query("destination_city");
		}
		if(!empty($this->request->query("pickup_city"))) {
		$conditions["Requests.pickup_city"] =  $this->request->query("pickup_city");
		}
		$sdate = $this->request->query("startdatesearch");
		$sdate = (isset($sdate) && !empty($sdate))?$this->ymdFormatByDateFormat($sdate, "m-d-Y", $dateSeparator="/"):null;
		if(!empty($this->request->query("startdatesearch"))) {
			$da["Requests.start_date"] =  $sdate;
			$da["Requests.check_in"] =  $sdate;
			$conditions["OR"] =  $da;
		}
		$edate = $this->request->query("enddatesearch");
		$edate = (isset($edate) && !empty($edate))?$this->ymdFormatByDateFormat($edate, "m-d-Y", $dateSeparator="/"):null;
		if(!empty($this->request->query("enddatesearch"))) {
			$da1["Requests.end_date"] =  $edate;
			$da1["Requests.check_out"] =  $edate;
			$conditions["OR"] =  $da1;
		}
		$conditions["Requests.user_id"] = $this->Auth->user('id');
		$conditions["Requests.status !="] = 2;
		$conditions["Requests.is_deleted "] = 0;
		$sort='';
		if(empty($this->request->query("sort"))) {
		$sort['Requests.id'] = "DESC";
		}
		if(!empty($this->request->query("sort")) && $this->request->query("sort")=="requesttype") {
		$sort['Requests.category_id'] = "ASC";
		}
		if(!empty($this->request->query("sort")) && $this->request->query("sort")=="totalbudgetlh") {
		$sort['Requests.total_budget'] = "ASC";
		}
		if(!empty($this->request->query("sort")) && $this->request->query("sort")=="totalbudgethl") {
		$sort['Requests.total_budget'] = "DESC";
		}
		//--
		if(!empty($this->request->query("sort")) && $this->request->query("sort")=="resposesnolh") {
			$sortq['COUNT(Responses.request_id)'] = "ASC";
		}
		if(!empty($this->request->query("sort")) && $this->request->query("sort")=="resposesnohl") {
			$sortq['COUNT(Responses.request_id)'] = "DESC";
		}
		//--
		if ($this->Auth->user('role_id') == 1) {
		$requests = $this->Requests->find()
		->contain(["Users","Hotels"])
		->where($conditions)->order($sort)->all();
		}
		if ($this->Auth->user('role_id') == 2) {
			$requests = $this->Requests->find()
				->contain(["Users","Hotels","Responses"=>function($q){
					return $q->order($sortq);
				}])
				->where($conditions)->order($sort)->all();
		}
		if ($this->Auth->user('role_id') == 3) {
			$conditions["Requests.category_id "] = 3;
			$requests = $this->Requests->find()
				->contain(["Users","Hotels","Responses"=>function($q){
					return $q->order($sortq);
				}])
				->where($conditions)->order($sort)->all();
		}
		$data = array();
		foreach($requests as $req){
		$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.request_id' =>$req['id']]])->contain(['Users']);
		$data['responsecount'][$req['id']]  = $queryr->count();
		}
		$this->set('data', $data);
		$this->set('requests', $requests);
		$myRequestCount = $myReponseCount = 0;
		$myfinalCount  = 0;
		$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status "=>2]]);
		$myfinalCount = $query3 ->count();
		$this->set('myfinalCount', $myfinalCount );
		$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
		$myRequestCount = $query->count();
		$myRequestCount1 = $query->count(); 
		$delcount=0;
		$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1]]);
		foreach($requests as $req){
		$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
		if($rqueryr->count()!=0){
		$delcount++;
		}
		}
		if($myRequestCount > $delcount) {
		$myRequestCount = $myRequestCount-$delcount;
		}	
		$this->set('myRequestCountdel', $delcount);
		$this->set('myRequestCount', $myRequestCount1);
		$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id'),"Responses.is_deleted"=>0]]);
		$myReponseCount = $queryr->count();
		$this->set('myReponseCount', $myReponseCount);
		$csort['created'] = "DESC";
		$allUnreadChat = $this->User_Chats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->order($csort)->limit(10)->all();
		$chatCount = $allUnreadChat->count();
		$this->set('chatCount',$chatCount); 
		$this->set('allunreadchat',$allUnreadChat);
		$allCities = $this->Cities->find('list',['keyField' => 'id', 'valueField' => 'name'])
		->hydrate(false)
		->toArray();
		$cities = $this->Cities->getAllCities();
		$this->set('allCities', $allCities);
		$allCities1 = array();
		$allCities2 = array();
		$allCityList = array();
		if(!empty($cities)) {
		foreach($cities as $city) {
		$cit = $city['name'].' ('.$city['state']->state_name.')';
		$cit1 = $city['name'];
		$allCities1[] = array("label"=>str_replace("'", "", $cit), "value"=>$city['id'], "state_id"=>$city['state_id'], "state_name"=>$city['state']->state_name, "country_id"=>101, "country_name"=>"India");
		$allCities2[] = array("label"=>str_replace("'", "", $cit1), "value"=>$city['id'] );
		$allCityList[$city['id']] = $city['name'];
		}
		}
		//$allCities2 = $allCities1;
		// $allCities1 = json_encode($allCities1);
		$this->set('allCities1', $allCities1);
		$this->set('allCities2', $cities);
		$allStates = $this->States->find('list',['keyField' => 'id', 'valueField' => 'state_name'])
		->hydrate(false)
		->toArray();
		$this->set('allStates', $allStates);
	}
public function finalizedRequestList() {
$this->loadModel('Responses');
$this->loadModel('Hotels');
$this->loadModel('Requests');
$this->loadModel('Cities');
$this->viewBuilder()->layout('user_layout');
$user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
$this->set('users', $user);
$sort='';
if(empty($this->request->query("sort"))) {
//$sort['Requests.accept_date'] = "DESC";
	$sort['Requests.id'] = "DESC";
}
if(!empty($this->request->query("sort")) && $this->request->query("sort")=="requesttype") {
$sort['Requests.category_id'] = "ASC";
}
if(!empty($this->request->query("sort")) && $this->request->query("sort")=="totalbudgetlh") {
$sort['Requests.total_budget'] = "ASC";
}
if(!empty($this->request->query("sort")) && $this->request->query("sort")=="totalbudgethl") {
$sort['Requests.total_budget'] = "DESC";
}
if(!empty($this->request->query("budgetsearch"))) {
	$QPriceRange = $this->request->query("budgetsearch");
	$result = explode("-", $QPriceRange);
	$MinQuotePrice = $result[0];
	$MaxQuotePrice = $result[1];
	$conditions["Requests.total_budget >="] = $MinQuotePrice;
	$conditions["Requests.total_budget <="] = $MaxQuotePrice;
}
if(!empty($this->request->query("req_typesearch"))) {
	$conditions["Requests.category_id"] =  $this->request->query("req_typesearch");
}
if(!empty($this->request->query("refidsearch"))) {
	$conditions["Requests.reference_id"] =  $this->request->query("refidsearch");
}
	$sdate = $this->request->query("startdatesearch");
	$sdate = (isset($sdate) && !empty($sdate))?$this->ymdFormatByDateFormat($sdate, "m-d-Y", $dateSeparator="/"):null;
if(!empty($this->request->query("startdatesearch"))) {
	$da["Requests.start_date"] =  $sdate;
	$da["Requests.check_in"] =  $sdate;
	$conditions["OR"] =  $da;
}
	$edate = $this->request->query("enddatesearch");
	$edate = (isset($edate) && !empty($edate))?$this->ymdFormatByDateFormat($edate, "m-d-Y", $dateSeparator="/"):null;
if(!empty($this->request->query("enddatesearch"))) {
	$da["Requests.end_date"] =  $edate;
	$da["Requests.check_out"] =  $edate;
	$conditions["OR"] =  $da;
}
if(!empty($this->request->query("keyword"))) {
	$conditions["Requests.reference_id LIKE "] = "%".$this->request->query("keyword")."%";
}
$conditions["Requests.user_id"] = $this->Auth->user('id');
$conditions["Requests.status"] = 2;
$conditions["Requests.is_deleted "] = 0;

if ($this->Auth->user('role_id') == 1) {
	$requests = $this->Requests->find()
		->contain(["Users","Responses"])
		->where($conditions)->order($sort)->all();
}
if ($this->Auth->user('role_id') == 2) {
	$requests = $this->Requests->find()
		->contain(["Users","Responses"])
		->where($conditions)->order($sort)->all();
}
if ($this->Auth->user('role_id') == 3) {
	$conditions["Requests.category_id "] = 3;
	$requests = $this->Requests->find()
		->contain(["Users","Requests","Responses"])
		->where($conditions)->order($sort)->all();
}
 
	$final_res_array = array();
	 $conn = ConnectionManager::get('default');
foreach($requests as $row){
	$sql = "SELECT r.*,u.first_name,u.last_name FROM responses as r
inner JOIN users u on u.id=r.user_id
WHERE r.request_id='".$row['id']."' AND r.id='".$row['final_id']."'"; 
$stmt = $conn->execute($sql);
$resultt = $stmt ->fetch('assoc');
	$final_res_array[$row['id']]  = $resultt;
}
	$this->set('finalresponse', $final_res_array);
//pr($requests);die();
$this->set('requests', $requests);
$myRequestCount = $myReponseCount = 0;
$myfinalCount  = 0;
$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status "=>2]]);
$myfinalCount = $query3 ->count();
$this->set('myfinalCount', $myfinalCount );
$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
$myRequestCount = $query->count();
$myRequestCount1 = $query->count(); 
$delcount=0;
$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1]]);
foreach($requests as $req){
$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
if($rqueryr->count()!=0){
$delcount++;
}
}
if($myRequestCount > $delcount) {
$myRequestCount = $myRequestCount-$delcount;
}	
$this->set('myRequestCountdel', $delcount);
$this->set('myRequestCount', $myRequestCount1);
$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id')]]);
$myReponseCount = $queryr->count();
$this->set('myReponseCount', $myReponseCount);
$allUsers = $this->Users->find('list',['keyField' => 'id', 'valueField' => 'first_name'])
->hydrate(false)
->toArray();
$this->set('allUsers', $allUsers);
$this->loadModel('User_Chats');
$csort['created'] = "DESC";
$allUnreadChat = $this->User_Chats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->order($csort)->limit(10)->all();
$chatCount = $allUnreadChat->count();
$this->set('chatCount',$chatCount); 
$this->set('allunreadchat',$allUnreadChat);
}
public function removedRequestList() {
$this->loadModel('Responses');
$this->loadModel('Hotels');
$this->loadModel('Requests');
$this->loadModel('Cities');
$this->loadModel('States');
$this->viewBuilder()->layout('user_layout');
$user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
$this->set('users', $user);
$conditions["Requests.user_id"] = $this->Auth->user('id');
$conditions["Requests.is_deleted "] = 1;
if(!empty($this->request->query("budgetsearch"))) {
$QPriceRange = $this->request->query("budgetsearch");
$result = explode("-", $QPriceRange);
$MinQuotePrice = $result[0];
$MaxQuotePrice = $result[1];
$conditions["Requests.total_budget >="] = $MinQuotePrice;
$conditions["Requests.total_budget <="] = $MaxQuotePrice;
}
if(!empty($this->request->query("req_typesearch"))) {
$conditions["Requests.category_id"] =  $this->request->query("req_typesearch");
}
if(!empty($this->request->query("refidsearch"))) {
$conditions["Requests.reference_id"] =  $this->request->query("refidsearch");
}
$sdate = $this->request->query("startdatesearch");
$sdate = (isset($sdate) && !empty($sdate))?$this->ymdFormatByDateFormat($sdate, "m-d-Y", $dateSeparator="/"):null;
echo $sdate;
if(!empty($this->request->query("startdatesearch"))) {
$da["Requests.start_date"] =  $sdate;
$da["Requests.check_in"] =  $sdate;
$conditions["OR"] =  $da;
}
$edate = $this->request->query("enddatesearch");
$edate = (isset($edate) && !empty($edate))?$this->ymdFormatByDateFormat($edate, "m-d-Y", $dateSeparator="/"):null;
if(!empty($this->request->query("enddatesearch"))) {
$da1["Requests.end_date"] =  $edate;
$da1["Requests.check_out"] =  $edate;
$conditions["OR"] =  $da1;
}
if ($this->Auth->user('role_id') == 1) {
$requests = $this->Requests->find()
->contain(["Users","Hotels"])
->where($conditions)->order(["Requests.id" => "DESC"])->all();
}
if ($this->Auth->user('role_id') == 2) {
$requests = $this->Requests->find()
->contain(["Users","Hotels"])
->where($conditions)->order(["Requests.id" => "DESC"])->all();
}
if ($this->Auth->user('role_id') == 3) {
$conditions["Requests.category_id "] = 3;
$requests = $this->Requests->find()
->contain(["Users","Hotels"])
->where($conditions)->order(["Requests.id" => "DESC"])->all();
}
$this->set('requests', $requests);
$myRequestCount = $myReponseCount = 0;
$myfinalCount  = 0;
$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status "=>2]]);
$myfinalCount = $query3 ->count();
$this->set('myfinalCount', $myfinalCount );
$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
$myRequestCount = $query->count();
$myRequestCount1 = $query->count(); 
$delcount=0;
$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1]]);
foreach($requests as $req){
$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
if($rqueryr->count()!=0){
$delcount++;
}
}
if($myRequestCount > $delcount) {
$myRequestCount = $myRequestCount-$delcount;
}	
$this->set('myRequestCountdel', $delcount);
$this->set('myRequestCount', $myRequestCount1);
$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id')]]);
$myReponseCount = $queryr->count();
$this->set('myReponseCount', $myReponseCount);
$this->loadModel('User_Chats');
$csort['created'] = "DESC";
$allUnreadChat = $this->User_Chats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->order($csort)->limit(10)->all();
$chatCount = $allUnreadChat->count();
$this->set('chatCount',$chatCount); 
$this->set('allunreadchat',$allUnreadChat);
$allCities = $this->Cities->find('list',['keyField' => 'id', 'valueField' => 'name'])
->hydrate(false)
->toArray();
$cities = $this->Cities->getAllCities();
$this->set('allCities', $allCities);
$allStates = $this->States->find('list',['keyField' => 'id', 'valueField' => 'state_name'])
->hydrate(false)
->toArray();
$this->set('allStates', $allStates);
}
public function respondtorequest() {
	
$this->viewBuilder()->layout('user_layout');
date_default_timezone_set('Asia/Kolkata');
$current_time = date("Y-m-d");
Configure::write('debug',2);
$conditions ='';
$this->loadModel('Testimonial');
$this->loadModel('Transports');
$this->loadModel('Hotels');
$this->loadModel('Responses');
$this->loadModel('Requests');
$this->loadModel('Cities');
$this->loadModel('States');
$this->loadModel('User_Chats');
$this->loadModel('BusinessBuddies');
$this->loadModel('BlockedUsers');
$sort='';
if(empty($this->request->query("sort"))) {
$sort['Requests.id'] = "DESC";
}
if(!empty($this->request->query("sort")) && $this->request->query("sort")=="requesttype") {
$sort['Requests.category_id'] = "ASC";
}
if(!empty($this->request->query("sort")) && $this->request->query("sort")=="totalbudgetlh") {
$sort['Requests.total_budget'] = "ASC";
}
if(!empty($this->request->query("sort")) && $this->request->query("sort")=="totalbudgethl") {
$sort['Requests.total_budget'] = "DESC";
}
if(!empty($this->request->query("sort")) && $this->request->query("sort")=="agentaz") {
$sort['Users.first_name'] = "ASC";
$sort['Users.last_name'] = "ASC";
}
if(!empty($this->request->query("sort")) && $this->request->query("sort")=="agentza") {
$sort['Users.first_name'] = "DESC";
$sort['Users.last_name'] = "DESC";
}
$conditions["OR"] = array("Requests.check_in >="=> $current_time, "Requests.start_date >="=> $current_time);
if(!empty($this->request->query("agentnamesearch"))) {
	$keyword1 = '';
	$keyword2 = '';
	$keyword = trim($this->request->query("agentnamesearch"));
	$keyword = explode(' ',$keyword);
	if(isset($keyword[1])) {
		$keyword2 = $keyword[1];
	}
	$conditions["AND"] = array("Users.first_name LIKE "=>"%". $keyword[0]."%", "Users.last_name LIKE" => "%".$keyword2."%",);
}
if(!empty($this->request->query("destination_city"))) {
	$conditions["Requests.city_id"] =  $this->request->query("destination_city");
}
if(!empty($this->request->query("pickup_city"))) {
	$conditions["Requests.pickup_city"] =  $this->request->query("pickup_city");
}
if(!empty($this->request->query("req_typesearch"))) {
	$conditions["Requests.category_id"] =  $this->request->query("req_typesearch");
}
if(!empty($this->request->query("budgetsearch"))) {
	$QPriceRange = $this->request->query("budgetsearch");
	$result = explode("-", $QPriceRange);
	$MinQuotePrice = $result[0];
	$MaxQuotePrice = $result[1];
	$conditions["Requests.total_budget >="] = $MinQuotePrice;
	$conditions["Requests.total_budget <="] = $MaxQuotePrice;
}
if(!empty($this->request->query("refidsearch"))) {
	$conditions["Requests.reference_id"] =  $this->request->query("refidsearch");
}
$sdate = $this->request->query("startdatesearch");
$sdate = (isset($sdate) && !empty($sdate))?$this->ymdFormatByDateFormat($sdate, "m-d-Y", $dateSeparator="/"):null;
if(!empty($this->request->query("startdatesearch"))) {
	$da["Requests.start_date"] =  $sdate;
	$da["Requests.check_in"] =  $sdate;
	$conditions["OR"] =  $da;
}
$edate = $this->request->query("enddatesearch");
if(isset($edate) AND !empty($edate)){
	$date = str_replace('/', '-', $edate);
	$edate = date('Y-m-d', strtotime($date));
}else{
	$edate = null;		
}
//echo  $edate = (isset($edate) && !empty($edate))?$this->ymdFormatByDateFormat($edate, "m-d-Y", $dateSeparator="/"):null;
if(!empty($this->request->query("enddatesearch"))) {
	$da1["Requests.end_date"] =  $edate;
	$da1["Requests.check_out"] = $edate;
	$conditions["OR"] =  $da1;
}
$allStates = $this->States->find('list',['keyField' => 'id', 'valueField' => 'state_name'])
->hydrate(false)
->toArray();
$this->set('allStates', $allStates);
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
$userid=$this->Auth->user('id');
$BlockedUsers = array_unique($BlockedUsers);
	if ($this->Auth->user('role_id') == 1) { // Travel Agent
		if(!empty($user["preference"])) {
			$conditionalStates = array_unique(explode(",", $user["preference"]));
		} else {
			$conditionalStates =  $user["state_id"];
		}
		$conditions["OR"] = array("Requests.check_in >="=> $current_time, "Requests.start_date >="=> $current_time);
		$requests = $this->Requests->find()
		->contain(["Users", "Responses"])
		->notMatching('Responses', function ($q)use($userid) {
			return $q->where(['Responses.user_id' => $userid]);
		})
		->where(["OR"=>['Requests.state_id IN' => $conditionalStates, 'Requests.pickup_state IN' => $conditionalStates],$conditions, 'Requests.user_id NOT IN' => $BlockedUsers, "Requests.status !="=>2, "Requests.is_deleted"=>0])
		->order($sort);
	} 
	else if ($this->Auth->user('role_id') == 2) { /// Event Planner
		$requests = $this->Requests->find()
			->contain(["Users","Hotels"])
			->where(['Requests.pickup_state' => $user["state_id"], 'Requests.category_id' => 2, "Requests.status !="=>2, "Requests.is_deleted"=>0])
			->order($sort);
	}
	else if ($this->Auth->user('role_id') == 3) {
		$conditions["OR"] = array("Requests.check_in >="=> $current_time, "Requests.start_date >="=> $current_time);
		$requests = $this->Requests->find()
		->contain(["Users", "Responses","Hotels"])
		->notMatching('Responses', function ($q)use($userid) {
			return $q->where(['Responses.user_id' => $userid]);
		})
		->where(['Requests.city_id' => $user['city_id'],'Requests.user_id NOT IN' => $BlockedUsers, "Requests.status !="=>2, "Requests.is_deleted"=>0,$conditions])
		->order($sort);
	}
	 
$loggedinid = $this->Auth->user('id');
$data = array();
foreach($requests as $req){
$checkblockedUsers = $this->BlockedUsers->find()->where(['blocked_by' => $req['user_id'],'blocked_user_id'=>$loggedinid])->count();        
if($checkblockedUsers==1){
$data['blockedUser'][$req['id']] =1;
}else{$data['blockedUser'][$req['id']]=0;}        
}
$this->set('data', $data);
$resdata = array();
foreach($requests as $req){
$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.request_id' =>$req['id']]])->contain(['Users']);
$resdata['responsecount'][$req['id']]  = $queryr->count();
}
//print_r($data);
$this->set('resdata', $resdata);
$this->set('requests', $requests);
$myRequestCount = $myReponseCount = 0;
$myfinalCount  = 0;
$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status "=>2]]);
$myfinalCount = $query3 ->count();
$this->set('myfinalCount', $myfinalCount );
$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
$myRequestCount = $query->count();
$myRequestCount1 = $query->count(); 
$delcount=0;
$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1]]);
foreach($requests as $req){
$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
if($rqueryr->count()!=0){
$delcount++;
}
}
if($myRequestCount > $delcount) {
$myRequestCount = $myRequestCount-$delcount;
}	
$this->set('myRequestCountdel', $delcount);
$this->set('myRequestCount', $myRequestCount1);
$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id')]]);
$myReponseCount = $queryr->count();
$this->set('myReponseCount', $myReponseCount);
$allCities = $this->Cities->find('list',['keyField' => 'id', 'valueField' => 'name'])
->hydrate(false)
->toArray();
$this->set('allCities', $allCities);
$csort['created'] = "DESC";
$allUnreadChat = $this->User_Chats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->order($csort)->limit(10)->all();
$chatCount = $allUnreadChat->count();
$this->set('chatCount',$chatCount); 
$this->set('allunreadchat',$allUnreadChat);
$BusinessBuddies = $this->BusinessBuddies->find('list',['keyField' => "bb_user_id",'valueField' => 'bb_user_id'])
->hydrate(false)
->where(['user_id' => $this->Auth->user('id')])
->toArray();
$this->set('BusinessBuddies', $BusinessBuddies);
$cities = $this->Cities->getAllCities();
$this->set('allCities', $allCities);
$allCities1 = array();
$allCities2 = array();
$allCityList = array();
if(!empty($cities)) {
foreach($cities as $city) {
$cit = $city['name'].' ('.$city['state']->state_name.')';
$cit1 = $city['name'];
$allCities1[] = array("label"=>str_replace("'", "", $cit), "value"=>$city['id'], "state_id"=>$city['state_id'], "state_name"=>$city['state']->state_name, "country_id"=>101, "country_name"=>"India");
$allCities2[] = array("label"=>str_replace("'", "", $cit1), "value"=>$city['id'] );
$allCityList[$city['id']] = $city['name'];
}
}
//$allCities2 = $allCities1;
//  $allCities1 = json_encode($allCities1);
$this->set('allCities1', $allCities1);
$this->set('allCities2', $cities);		 
}
public function getrating($userid){
$query = $this->Testimonial->find();
$userRating = $query->select(["average_rating" => $query->func()->avg("rating")])
->where(['author_id' => $userid])
->order(["id" => "DESC"]);
return $userRating;
}
	public function __getRespondToRequestCount() {
		$requests ='';
		date_default_timezone_set('Asia/Kolkata');
		$current_time = date("Y-m-d");
		$this->loadModel('BlockedUsers');
		$this->loadModel('Requests');
		$this->loadModel('Responses');
		$this->loadModel('Hotels');
		$this->loadModel('User_Chats');
		$user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
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
				$conditionalStates =  $user["state_id"];
			}
			$conditions["OR"] = array("Requests.check_in >="=> $current_time, "Requests.start_date >="=> $current_time);
			$requests = $this->Requests->find()
			->contain(["Users", "Responses"])
			->notMatching('Responses', function(\Cake\ORM\Query $q) {
			return $q->where(['Responses.user_id' => $this->Auth->user('id')]);
			})
			->where(["OR"=>['Requests.state_id IN' => $conditionalStates, 'Requests.pickup_state IN' => $conditionalStates],$conditions, 'Requests.user_id NOT IN' => $BlockedUsers, "Requests.status !="=>2, "Requests.is_deleted"=>0])
			//->group('Requests.id')
			->order(["Requests.id" => "DESC"]);
		} 
		else if ($this->Auth->user('role_id') == 3) { /// Hotel d
			$conditions["OR"] = array("Requests.check_in >="=> $current_time, "Requests.start_date >="=> $current_time);
			$requests = $this->Requests->find()
			->contain(["Users", "Responses"])
			->notMatching('Responses', function(\Cake\ORM\Query $q) {
			return $q->where(['Responses.user_id' => $this->Auth->user('id')]);
			})
			->where(['Requests.city_id' => $user['city_id'], 'Requests.category_id' => 3, "Requests.status !="=>2, "Requests.is_deleted"=>0,$conditions])
			//->group('Requests.id')
			->order(["Requests.id" => "DESC"]);
		}
		else
		{
			return  $requests;
		}
		$res_request_count = $requests->count();	 
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
		if($res_request_count>0){	
			$loggedinid = $this->Auth->user('id');
			foreach($requests as $req){
				$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.request_id' =>$req['id']]])->contain(['Users']);	
				$total_responses = $queryr->count();
				$checkblockedUsers = $this->BlockedUsers->find()->where(['blocked_by' => $req['user_id'],'blocked_user_id'=>$loggedinid])->count();        
				if($checkblockedUsers==1 OR $total_responses>=20){
					$res_request_count--;
				}      
			}
			return $res_request_count;
		}
		
	return  $res_request_count;
	}
public function __getUserRespondToRequestCount($userdetail) {
error_reporting(0);
$requests ='';
$this->loadModel('BlockedUsers');
$this->loadModel('Requests');
$BlockedUsers = $this->BlockedUsers->find('list',['keyField' => "id",'valueField' => 'blocked_user_id'])
->hydrate(false)
->where(['blocked_by' => $userdetail['id']])
->toArray();
if(!empty($BlockedUsers)) {
$BlockedUsers = array_values($BlockedUsers);
}
array_push($BlockedUsers,$userdetail['id']);
$BlockedUsers = array_unique($BlockedUsers);
if ($userdetail['role_id'] == 1) { // Travel Agent
if(!empty($user["preference"])) {
$conditionalStates = array_unique(array_merge(explode(",", $userdetail["preference"]), array($userdetail["state_id"])));
} else {
$conditionalStates = $userdetail["state_id"];
}
$requests = $this->Requests->find()
->contain(["Users", "Responses"])
->notMatching('Responses', function(\Cake\ORM\Query $q) {
return $q->where(['Responses.user_id' => $userdetail['id']]);
})
->where(["OR"=>['Requests.state_id IN' => $conditionalStates, 'Requests.pickup_state IN' => $conditionalStates], 'Requests.user_id NOT IN' => $BlockedUsers, "Requests.status !="=>2, "Requests.is_deleted"=>0])
//->group('Requests.id')
->order(["Requests.id" => "DESC"])->count();
} else if ($userdetail['role_id'] == 3) { /// Hotel
$requests = $this->Requests->find()
->contain(["Users", "Responses"])
->notMatching('Responses', function(\Cake\ORM\Query $q) {
return $q->where(['Responses.user_id' => $userdetail['id']]);
})
->where(['Requests.city_id' => $userdetail['city_id'], 'Requests.category_id' => 3, "Requests.status !="=>2, "Requests.is_deleted"=>0])
//->group('Requests.id')
->order(["Requests.id" => "DESC"])->count();
}
return $requests;
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
	$this->viewBuilder()->layout('user_layout');
	$this->loadModel('Responses');
	$this->loadModel('Requests');
	$this->loadModel('Cities');
	$this->loadModel('States');
	$this->loadModel('User_Chats');
	$this->loadModel('Testimonial');
	$loggedinid= $this->Auth->user('id');
	$user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
	$this->set('users', $user);
	$this->set('responseid', $id);
	$keyword = "";
	$acceptDeals = "";
	$conditions["Responses.request_id"] = $id;
	if(!empty($this->request->query("agentname"))) {
		$keyword1 = '';
		$keyword2 = '';
		$keyword = trim($this->request->query("agentname"));
		$keyword = explode(' ',$keyword);
		if(isset($keyword[0]) && !isset($keyword[1])) {
			$keyword1 = $keyword[0];
			$conditions["Users.first_name"] =$keyword1;
		}
		if(isset($keyword[1])) {
			$keyword1 = trim($keyword[0]);
			$keyword2 = trim($keyword[1]);
			$da["Users.first_name"] =  $keyword1;
			$da["Users.last_name"] =  $keyword2;
			$conditions["AND"] =  $da;
		}
	}
	if(!empty($this->request->query("acceptdeals"))) {
		$conditions["Responses.status"] = 1;
		$acceptDeals = 1;
	}
	if(!empty($this->request->query("quotesearch"))) {
		$QPriceRange = $this->request->query("quotesearch");
		$result = explode("-", $QPriceRange);
		$MinQuotePrice = $result[0];
		$MaxQuotePrice = $result[1];
		$conditions["Responses.quotation_price >="] = $MinQuotePrice;
		$conditions["Responses.quotation_price <="] = $MaxQuotePrice;
	}
	if(!empty($this->request->query("chatwith"))) {
		$chatuserid = $this->request->query("chatwith");
		$conditions["Responses.user_id"] = $chatuserid;
	}
	if(!empty($this->request->query("budgetsearch"))) {
		$QPriceRange = $this->request->query("budgetsearch");
		$result = explode("-", $QPriceRange);
		$MinQuotePrice = $result[0];
		$MaxQuotePrice = $result[1];
		$conditions["Requests.total_budget >="] = $MinQuotePrice;
		$conditions["Requests.total_budget <="] = $MaxQuotePrice;
	}
	if(!empty($this->request->query("refidsearch"))) {
		$conditions["Requests.reference_id"] =  $this->request->query("refidsearch");
	}
	if(!empty($this->request->query("shared_details"))) {
		$conditions["Responses.is_details_shared"] =  $this->request->query("shared_details");
	}
	$sortorder ='';
	$chat_sort = 0;
	if(!empty($this->request->query("sort"))) {
		if(!empty($this->request->query("sort")) && $this->request->query("sort")=="totalbudgethl") {
			$sortorder['Requests.total_budget'] = "DESC";
		}
		if(!empty($this->request->query("sort")) && $this->request->query("sort")=="totalbudgetlh") {
			$sortorder['Requests.total_budget'] = "ASC";
		}
		if(!empty($this->request->query("sort")) && $this->request->query("sort")=="quotedpricehl") {
			$sortorder['Responses.quotation_price'] = "DESC";
		}
		if(!empty($this->request->query("sort")) && $this->request->query("sort")=="quotedpricelh") {
			$sortorder['Responses.quotation_price'] = "ASC";
		}
		if(!empty($this->request->query("sort")) && $this->request->query("sort")=="agentaz") {
			$sortorder['Users.first_name'] = "ASC";
			$sortorder['Users.last_name'] = "ASC";
		}
		if(!empty($this->request->query("sort")) && $this->request->query("sort")=="agentza") {	
			$sortorder['Users.first_name'] = "DESC";
			$sortorder['Users.last_name'] = "DESC";
		}
	}
	
	$responses = $this->Responses->find()
		->contain(["Users", "Requests", "UserChats","Testimonial"])
		->where($conditions)
		->order($sortorder)
		->all();
	$this->loadModel('BusinessBuddies');
	$BusinessBuddies = $this->BusinessBuddies->find('list',['keyField' => "bb_user_id",'valueField' => 'bb_user_id'])
		->hydrate(false)
		->where(['user_id' => $this->Auth->user('id')])
		->toArray();
	$this->set('BusinessBuddies', $BusinessBuddies);	
		 
	$userchatTable = TableRegistry::get('User_Chats');
	$conn = ConnectionManager::get('default');
	$data = array();
	foreach($responses as $row){ 
		$request_id = $row['request']['id'];
		$user_id = $row['user']['id'];
		$sql = "SELECT *,COUNT(*) as ch_count FROM user_chats 
		WHERE request_id='".$request_id."' AND (user_id in ('".$loggedinid."','".$user_id."') 
		AND notification='0'
		ANd send_to_user_id in ('".$loggedinid."','".$user_id."')) ";
		$stmt = $conn->execute($sql);
		$results = $stmt ->fetch('assoc');			
		//$row["request"]["chat_count"]=$results['ch_count'];
		$data['chat_count'][$row['id']] =$results['ch_count'];
	}
	$this->set('data', $data);
//pr($conditions); exit;	
	$this->set('responses', $responses);
	$this->set('requestidval', $id);
	$requestDetails = $this->Requests->find()
		->contain(["Users", "UserRatings", "Hotels", "RequestStops"])
		->where(['Requests.id' => $id])->first();
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
	$myfinalCount  = 0;
	$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status "=>2]]);
	$myfinalCount = $query3 ->count();
	$this->set('myfinalCount', $myfinalCount );
	$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
	$myRequestCount = $query->count();
	$myRequestCount1 = $query->count(); 
	$delcount=0;
	$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1]]);
	foreach($requests as $req){
		$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
		if($rqueryr->count()!=0){
			$delcount++;
		}
	}
	if($myRequestCount > $delcount) {
		$myRequestCount = $myRequestCount-$delcount;
	}	
	$this->set('myRequestCountdel', $delcount);
	$this->set('myRequestCount', $myRequestCount1);
	$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id')]]);
	$myReponseCount = $queryr->count();
	$this->set('myReponseCount', $myReponseCount);
	$this->set("hotelCategories", $this->_getHotelCategoriesArray());
	$requestId = $id;
	$this->set(compact("allCities", "allStates", "allCountries", "transpoartRequirmentArray", "mealPlanArray", "allUsers",  "myReponseCount", "QPriceRange", "requestId", "starRange", "ratingRange", "keyword", "acceptDeals"));
	$csort['created'] = "DESC";
	$allUnreadChat = $this->User_Chats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->order($csort)->limit(10)->all();
	$chatCount = $allUnreadChat->count();
	$this->set('chatCount',$chatCount); 
	$this->set('allunreadchat',$allUnreadChat);
	$UserResponse = $this->Responses->find()
	->contain(["Users"])
	->where(['Responses.request_id' => $id])->all()->toArray();
	$this->set('UserResponse',$UserResponse);
}
public function acceptOffer() {
	date_default_timezone_set('Asia/Kolkata');
$this->loadModel('Requests');
$this->loadModel('Responses');
$this->loadModel('User_Chats');
$res = 0;
if(isset($_POST["request_id"]) && !empty($_POST["request_id"]) && !empty($this->Auth->user('id'))) {
$TableRequest = TableRegistry::get('Requests');
$request = $TableRequest->get($_POST["request_id"]);
$user_from_id = $request['user_id'];
$request_id = $_POST["request_id"];
$request->status = 2;
$request->final_id = $_POST["response_id"];
$request->accept_date =  date("Y-m-d H:i:s");
$request->response_id = $_POST["response_id"];
if ($TableRequest->save($request)){
$TableResponse = TableRegistry::get('Responses');
$response = $TableResponse->get($_POST["response_id"]);
$send_to_user_id = $response['user_id'];
$response->status = 1;
$TableResponse->save($response);
$res = 1;
}
if($res==1)
{
$TableUser = TableRegistry::get('Users');
$user = $TableUser->get($user_from_id);
$name = $user['first_name'].' '.$user['last_name'];
$message = "<span class='rec_name'>$name</span> has accepted your offer. Please CLICK HERE to add a Review for $name";
$userchatTable = TableRegistry::get('User_Chats');
$userchats = $userchatTable->newEntity();
$userchats->request_id = $request_id;
$userchats->user_id = $user_from_id;
$userchats->send_to_user_id = $send_to_user_id;
$userchats->message = $message;
$userchats->created = date("Y-m-d h:i:s");
$userchats->notification = 1;;
if ($userchatTable->save($userchats)) {
$id = $userchats->id;
$res = 1;
}
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
public function viewprofile($id,$is_share=null) {
$this->loadModel('Cities');
$this->loadModel('Testimonial');
$this->loadModel('Users');
$this->loadModel('Requests');
$this->loadModel('Responses');
$this->loadModel('Membership');
$this->viewBuilder()->layout('user_layout');
$userRequestCount = $userReponseCount = 0;
$userrespondToRequestCount = 0;
/*$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $id, 
"Requests.status !="=>2, "Requests.is_deleted"=>0]]);
$userRequestCount = $query->count();*/
$rconditions["Responses.user_id"] = $id;
$rconditions["Responses.status"] = 1;
$this->set('is_share',$is_share);
$responses = $this->Responses->find()
->contain(["Users", "Requests"])
->where($rconditions)->all();
$userReponseCount = $responses->count();
/*$queryr = $this->Responses->find('all', ['conditions' => ['Responses.user_id' => $id]]);
$userReponseCount = $queryr->count();*/
$this->set('userReponseCount', $userReponseCount);
$user = $this->Users->find()->where(['id' => $id])->first();
$conditions["Requests.user_id"] = $id;
$conditions["Requests.status"] = 2;
$conditions["Requests.is_deleted "] = 0;
if ($user['role_id'] == 1) {
$requests = $this->Requests->find()
->contain(["Users","Responses"])
->where($conditions)->order(["Requests.id" => "DESC"])->all();
}
if ($user['role_id'] == 2) {
$requests = $this->Requests->find()
->contain(["Users","Responses"])
->where($conditions)->order(["Requests.id" => "DESC"])->all();
}
if ($user['role_id'] == 3) {
$conditions["Requests.category_id "] = 3;
$requests = $this->Requests->find()
->contain(["Users","Responses"])
->where($conditions)->order(["Requests.id" => "DESC"])->all();
}
$userRequestCount = $requests->count();
$this->set('userRequestCount', $userRequestCount);
$TableMembership = TableRegistry::get('Membership');
$membership = $TableMembership->get($user["role_id"]);
$membership_name = $membership["membership_name"];
$this->set('membership_name', $membership_name);

$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.is_deleted' =>0,'Responses.user_id' => $id]]);
$myReponseCount = $queryr->count();
$this->set('userrespondToRequestCount', $myReponseCount);

$userrespondToRequestCount = $this->__getUserRespondToRequestCount($user);
//$this->set("userrespondToRequestCount", $userrespondToRequestCount);
//$this->set('respondToRequestCount', $respondToRequestCount);
$alltestimonials ='';
$this->set('users', $user);

$star1 = $this->Testimonial->find()->where(['user_id'=> $id,'rating'=>1])->all();
$star1count = $star1->count();
$this->set('star1count', $star1count);
$star2 = $this->Testimonial->find()->where(['user_id'=> $id,'rating'=>2])->all();
$star2count = $star2->count();
$this->set('star2count', $star2count);
$star3 = $this->Testimonial->find()->where(['user_id'=> $id,'rating'=>3])->all();
$star3count = $star3->count();
$this->set('star3count', $star3count);

$star4 = $this->Testimonial->find()->where(['user_id'=> $id,'rating'=>4])->all();
$star4count = $star4->count();
$this->set('star4count', $star4count);
$star5 = $this->Testimonial->find()->where(['user_id'=> $id,'rating'=>5])->all();
$star5count = $star5->count();
$this->set('star5count', $star5count);

$average_rating = 0;
$query = $this->Testimonial->find();
$userRating = $query->select(["average_rating" => $query->func()->avg("rating")])
->where(['user_id' => $id])
->order(["id" => "DESC"])
->first();
$average_rating = $userRating['average_rating'];
$this->set('average_rating', $average_rating);
$testimonialcount= 0;
$utestimonials = $this->Testimonial->find()->where(['user_id'=> $id])->all();
$testimonialcount = $utestimonials->count();		
$this->set('testimonialcount',$testimonialcount);
$testimonials = $this->Testimonial->find()->where(['user_id'=> $id])->all();
$testimoniallist = array();
if(!empty($testimonials)) {
foreach($testimonials as $testimonial) {
$users = $this->Users->find()->where(['id'=> $testimonial['author_id']])->first();
$name = $users['first_name']." ".$users['last_name'];
$alltestimonials[] = array( "name"=>$name,"rating1"=>$testimonial['rating'], "description"=>$users['description'], "profile_pic"=>$users['profile_pic'], "comment"=>$testimonial['comment'],"user_id"=>$testimonial['user_id'],"author_id"=>$testimonial['author_id']);
} 
$this->set('testimonial',$alltestimonials);
}
}
public function myresponselist() {
	$this->loadModel('BusinessBuddies');
	$this->loadModel('Responses');
	$this->loadModel('Requests');
	$this->loadModel('Cities');
	$this->loadModel('States');
	$this->loadModel('Hotels'); 
	$this->viewBuilder()->layout('user_layout');
	$user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
	$this->set('users', $user);
	$conditions ='';
	if(!empty($this->request->query("budgetsearch"))) {
		$QPriceRange = $this->request->query("budgetsearch");
		$result = explode("-", $QPriceRange);
		$MinQuotePrice = $result[0];
		$MaxQuotePrice = $result[1];
		$conditions["Requests.total_budget >="] = $MinQuotePrice;
		$conditions["Requests.total_budget <="] = $MaxQuotePrice;
	}
	$sort='';
	if(empty($this->request->query("sort"))) {
		$sort['Requests.id'] = "DESC";
	}
	if(!empty($this->request->query("sort")) && $this->request->query("sort")=="requesttype") {
		$sort['Requests.category_id'] = "ASC";
	}
	if(!empty($this->request->query("sort")) && $this->request->query("sort")=="totalbudgetlh") {
		$sort['Requests.total_budget'] = "ASC";
	}
	if(!empty($this->request->query("sort")) && $this->request->query("sort")=="totalbudgethl") {
		$sort['Requests.total_budget'] = "DESC";
	}
	if(!empty($this->request->query("sort")) && $this->request->query("sort")=="agentaz") {
		$sort['Users.first_name'] = "ASC";
		$sort['Users.last_name'] = "ASC";
	}
	if(!empty($this->request->query("sort")) && $this->request->query("sort")=="agentza") {
		$sort['Users.first_name'] = "DESC";
		$sort['Users.last_name'] = "DESC";
	}
	if(!empty($this->request->query("agentnamesearch"))) {
		$keyword1 = '';
		$keyword2 = '';
		$keyword = trim($this->request->query("agentnamesearch"));
		$keyword = explode(' ',$keyword);
		if(isset($keyword[1])) {
			$keyword2 = $keyword[1];
		}
		$conditions["AND"] = array("Users.first_name LIKE "=>"%". $keyword[0]."%", "Users.last_name LIKE" => "%".$keyword2."%",);
	}
	if(!empty($this->request->query("req_typesearch"))) {
		$conditions["Requests.category_id"] =  $this->request->query("req_typesearch");
	}
	if(!empty($this->request->query("refidsearch"))) {
		$conditions["Requests.reference_id"] =  $this->request->query("refidsearch");
	}
	if(!empty($this->request->query("destination_city"))) {
		$conditions["Requests.city_id"] =  $this->request->query("destination_city");
	}
	if(!empty($this->request->query("pickup_city"))) {
		$conditions["Requests.pickup_city"] =  $this->request->query("pickup_city");
	}
	if(!empty($this->request->query("chatwith"))) {
		$chatuserid = $this->request->query("chatwith");
		$conditions["Requests.user_id"] = $chatuserid;
	}		
	if(!empty($this->request->query("shared_details"))) {
		$conditions["Responses.is_details_shared"] =  $this->request->query("shared_details");
	}
	$sdate = $this->request->query("startdatesearch");
	$sdate = (isset($sdate) && !empty($sdate))?$this->ymdFormatByDateFormat($sdate, "m-d-Y", $dateSeparator="/"):null;
	if(!empty($this->request->query("startdatesearch"))) {
		$da["Requests.start_date"] =  $sdate;
		$da["Requests.check_in"] =  $sdate;
		$conditions["OR"] =  $da;
	}
	$edate = $this->request->query("enddatesearch");
	if(isset($edate) AND !empty($edate)){
		$date = str_replace('/', '-', $edate);
		$edate = date('Y-m-d', strtotime($date));
	}
	else{
		$edate = null;		
	}
//$edate = (isset($edate) && !empty($edate))?$this->ymdFormatByDateFormat($edate, "m-d-Y", $dateSeparator="/"):null;
	if(!empty($this->request->query("enddatesearch"))) {
		$da1["Requests.end_date"] =  $edate;
		$da1["Requests.check_out"] =  $edate;
		$conditions["OR"] =  $da1;
	}
	$conditions["Responses.is_deleted "] = 0;
	$conditions["Responses.status "] = 0;
	$responses = $this->Responses->find()
		->contain([ "Requests.Users", "UserChats","Requests.Hotels"])
		->where(['Responses.user_id' => $this->Auth->user('id'),$conditions])->order($sort)->all();
	$this->set('responses', $responses);
	$conn = ConnectionManager::get('default');
	$blockeddata = array();
	$reqidarray = array();
	$chatdata = array();
	$loggedinid = $this->Auth->user('id');
	if(count($responses)>0){
		foreach($responses as $req){
			$sql1="Select count(*) as block_count from blocked_users where blocked_user_id='".$req['user_id']."' AND blocked_by='".$req['request']['user_id']."'";
			$stmt = $conn->execute($sql1);
			$bresult = $stmt ->fetch('assoc');
			if($bresult['block_count']>0){
				$blockeddata['blockedUser'][$req['id']] =1;
			}
			else{
				$blockeddata['blockedUser'][$req['id']] =0;
			}
			$reqidarray[] = $req['request']['user_id'];
			$request_id = $req['request_id'];	
				$user_id = $req['request']['user_id'];
				$sqlc = "SELECT *,COUNT(*) as ch_count FROM user_chats 
			WHERE request_id='".$request_id."' AND (user_id in ('".$loggedinid."','".$user_id."') 
			AND notification='0'
			ANd send_to_user_id in ('".$loggedinid."','".$user_id."')) ";
			$stmtc = $conn->execute($sqlc);
			$resultsch = $stmtc ->fetch('assoc');		
			$chatdata['chat_count'][$req['id']] =$resultsch['ch_count'];
		}
	}
	$this->set('chatdata', $chatdata);
	$this->set('blockedUser', $blockeddata);
	//debug($responses);
	//	die();
	$allUsers = $this->Users->find('list',['keyField' => 'id', 'valueField' => 'first_name'])
		->hydrate(false)
		->toArray();
	$this->set('allUsers', $allUsers);
	$myRequestCount = $myReponseCount = 0;
	$myfinalCount  = 0;
	$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status "=>2]]);
	$myfinalCount = $query3 ->count();
	$this->set('myfinalCount', $myfinalCount );
	$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
	$myRequestCount = $query->count();
	$myRequestCount1 = $query->count(); 
	$delcount=0;

	$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1]]);
	foreach($requests as $req){
		$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
		if($rqueryr->count()!=0){
			$delcount++;
		}
	}
	if($myRequestCount > $delcount) {
		$myRequestCount = $myRequestCount-$delcount;
	}	
	$this->set('myRequestCountdel', $delcount);
	$this->set('myRequestCount', $myRequestCount1);
	$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id')]]);
	$myReponseCount = $queryr->count();
	$this->set('myReponseCount', $myReponseCount);
	$BusinessBuddies = $this->BusinessBuddies->find('list',['keyField' => "bb_user_id",'valueField' => 'bb_user_id'])
		->hydrate(false)
		->where(['user_id' => $this->Auth->user('id')])
		->toArray();
	$this->set('BusinessBuddies', $BusinessBuddies);
	$this->loadModel('User_Chats');
	$allCities = $this->Cities->find('list',['keyField' => 'id', 'valueField' => 'name'])
		->hydrate(false)
		->toArray();
	$allStates = $this->States->find('list',['keyField' => 'id', 'valueField' => 'state_name'])
		->hydrate(false)
		->toArray();
	$this->set('allCities',$allCities);
	$this->set('allStates',$allStates);
	$csort['created'] = "DESC";
	$allUnreadChat = $this->User_Chats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->order($csort)->limit(10)->all();
	$chatCount = $allUnreadChat->count();
	$this->set('chatCount',$chatCount); 
	$this->set('allunreadchat',$allUnreadChat);
	$cities = $this->Cities->getAllCities();
	$this->set('allCities', $allCities);
	$allCities1 = array();
	$allCities2 = array();
	$allCityList = array();
	if(!empty($cities)) {
		foreach($cities as $city) {
			$cit = $city['name'].' ('.$city['state']->state_name.')';
			$cit1 = $city['name'];
			$allCities1[] = array("label"=>str_replace("'", "", $cit), "value"=>$city['id'], "state_id"=>$city['state_id'], "state_name"=>$city['state']->state_name, "country_id"=>101, "country_name"=>"India");
			$allCities2[] = array("label"=>str_replace("'", "", $cit1), "value"=>$city['id'] );
			$allCityList[$city['id']] = $city['name'];
		}
	}
	//$allCities2 = $allCities1;
	//  $allCities1 = json_encode($allCities1);
	$this->set('allCities1', $allCities1);
	$this->set('allCities2', $cities);	
		$chatusers = array();
		$conn = ConnectionManager::get('default');
		if(count($responses)>0){
		$un_req_array = array_unique($reqidarray);
			$str_reqid =  implode(",",$un_req_array);
			$chatusers = array();
			$sql = "SELECT u.id,u.first_name,u.last_name FROM users as u 
			INNER JOIN requests as rs on rs.user_id=u.id
			WHERE rs.user_id !='".$this->Auth->user('id')."' and u.id in($str_reqid) GROUP BY rs.user_id ";
			$stmt = $conn->execute($sql);
			$chatusers = $stmt->fetchAll('assoc');
			$this->set('UserResponse',$chatusers); 
		}
		else
		{
			$this->set('UserResponse',$chatusers); 
		}
		
	$UserResponse = $this->Requests->find()
		->contain(["Users"])
		->where(['Requests.user_id !=' => $this->Auth->user('id')])->group(['Requests.user_id'])->all()->toArray();
	//$this->set('UserResponse',$UserResponse); 
	//$this->set("respondToRequestCount", $this->__getRespondToRequestCount());
}
	public function myFinalResponses() {
		$this->loadModel('Responses');
		$this->loadModel('Requests');
		$this->loadModel('Cities');
		$this->loadModel('States');
		$this->loadModel('User_Chats');
		$this->viewBuilder()->layout('user_layout');
		$user = $this->Users->find()
			->contain(["Credits"])
			->where(['Users.id' => $this->Auth->user('id')])->first();
		$this->set('users', $user);
		$this->set('userProfile', $user);
		$sort='';
		if(!empty($this->request->query("sort")) && $this->request->query("sort")=="totalbudgetlh") {
			$sort['Requests.total_budget'] = "ASC";
		}
		if(!empty($this->request->query("sort")) && $this->request->query("sort")=="totalbudgethl") {
			$sort['Requests.total_budget'] = "DESC";
		}
		if(!empty($this->request->query("sort")) && $this->request->query("sort")=="quotationlh") {
			$sort['Responses.quotation_price'] = "ASC";
		}
		if(!empty($this->request->query("sort")) && $this->request->query("sort")=="quotationhl") {
			$sort['Responses.quotation_price'] = "DESC";
		}
		if(!empty($this->request->query("sort")) && $this->request->query("sort")=="agentaz") {
			$sort['Users.first_name'] = "ASC";
			$sort['Users.last_name'] = "ASC";
		}
		if(!empty($this->request->query("sort")) && $this->request->query("sort")=="agentza") {
			$sort['Users.first_name'] = "DESC";
			$sort['Users.last_name'] = "DESC";
		}
		if(!empty($this->request->query("keyword"))) {
			$conditions["Requests.reference_id LIKE "] = "%".$this->request->query("keyword")."%";
		}
		if(!empty($this->request->query("agentname"))) {
			$keyword1 = '';
			$keyword2 = '';
			$keyword = trim($this->request->query("agentname"));
			$keyword = explode(' ',$keyword);
			if(isset($keyword[1])) {
				$keryword2 = $keyword[1];
			}
			$conditions["OR"] = array("Users.first_name LIKE "=>"%".$keyword1."%", "Users.last_name LIKE" => "%$keyword2%",);
		}
		if(!empty($this->request->query("acceptdeals"))) {
			$conditions["Responses.status"] = 1;
			$acceptDeals = 1;
		}
		if(!empty($this->request->query("quotesearch"))) {
			$QPriceRange = $this->request->query("quotesearch");
			$result = explode("-", $QPriceRange);
			$MinQuotePrice = $result[0];
			$MaxQuotePrice = $result[1];
			$conditions["Responses.quotation_price >="] = $MinQuotePrice;
			$conditions["Responses.quotation_price <="] = $MaxQuotePrice;
		}
		if(!empty($this->request->query("budgetsearch"))) {
			$QPriceRange = $this->request->query("budgetsearch");
			$result = explode("-", $QPriceRange);
			$MinQuotePrice = $result[0];
			$MaxQuotePrice = $result[1];
			$conditions["Requests.total_budget >="] = $MinQuotePrice;
			$conditions["Requests.total_budget <="] = $MaxQuotePrice;
		}
		if(!empty($this->request->query("refidsearch"))) {
			$conditions["Requests.reference_id"] =  $this->request->query("refidsearch");
		}
		$conditions["Responses.user_id"] = $this->Auth->user('id');
		$conditions["Responses.status"] = 1;
		$responses = $this->Responses->find()
			->contain(["Requests.Users", "Requests"])
			->where($conditions)->order($sort)->all();
		//pr($responses); EXIT;
		$this->set('responses', $responses);
		//pr($responses);exit;
		$allCities = $this->Cities->find('list',['keyField' => 'id', 'valueField' => 'name'])
			->hydrate(false)
			->toArray();
		$allStates = $this->States->find('list',['keyField' => 'id', 'valueField' => 'state_name'])
			->hydrate(false)
			->toArray();
		$allUsers = $this->Users->find('list',['keyField' => 'id', 'valueField' =>  array('first_name', 'last_name')])
			->hydrate(false)
			->toArray();
		$this->set('allUsers', $allUsers);
		$transpoartRequirmentArray = $this->_getTranspoartRequirmentsArray();
		$mealPlanArray = $this->_getMealPlansArray();
		$myRequestCount = $myReponseCount = 0;
		$myfinalCount  = 0;
		$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status "=>2]]);
		$myfinalCount = $query3 ->count();
		$this->set('myfinalCount', $myfinalCount );
		$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
		$myRequestCount = $query->count();
		$myRequestCount1 = $query->count(); 
		$delcount=0;
		$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1]]);
		foreach($requests as $req){
		$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
		if($rqueryr->count()!=0){
		$delcount++;
		}
		}
		if($myRequestCount > $delcount) {
		$myRequestCount = $myRequestCount-$delcount;
		}	
		$this->set('myRequestCountdel', $delcount);
		$this->set('myRequestCount', $myRequestCount1);
		$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id')]]);
		$myReponseCount = $queryr->count();
		$this->set('myReponseCount', $myReponseCount);
		$this->set(compact("allCities", "allStates", "allCountries", "transpoartRequirmentArray", "mealPlanArray", "allUsers",  "myReponseCount"));
		$csort['created'] = "DESC";
		$allUnreadChat = $this->User_Chats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->order($csort)->limit(10)->all();
		$chatCount = $allUnreadChat->count();
		$this->set('chatCount',$chatCount);
		$this->set('allunreadchat',$allUnreadChat);
		//----	 FInalized
		$finalreq["Requests.user_id"] = $this->Auth->user('id');
		$finalreq["Requests.status"] = 2;
		$finalreq["Requests.is_deleted "] = 0;
		$finalizeRequest = $this->Requests->find()->where($finalreq)->count();
		$this->set('finalizeRequest', $finalizeRequest);
		//--- Removed Request
		$remoev["Requests.user_id"] = $this->Auth->user('id');
		$remoev["Requests.is_deleted "] = 1;
		$RemovedReqest = $this->Requests->find()->where($remoev)->count();
		$this->set('RemovedReqest', $RemovedReqest);
		//--- Blocked User
		$this->loadModel('blocked_users');
		$blk["blocked_users.blocked_by"] = $this->Auth->user('id');
		$blockedUserscount = $this->blocked_users->find()->where($blk)->count();
		$this->set('blockedUserscount', $blockedUserscount);
		//--- Finalize Response;
		$FInalResponseCount = $this->Responses->find('all', ['conditions' => ['Responses.status' =>1,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id')]])->count();
		$this->set('FInalResponseCount', $FInalResponseCount);
		//*---
}
public function unreadChats() {
Configure::write('debug',2);
$this->loadModel('UserChats');
$this->loadModel('Responses');
$this->loadModel('Requests');
$UserChats = $this->UserChats->find()
->contain(["Users"/*, "Requests"*/])
->where(['UserChats.send_to_user_id' => $this->Auth->user('id'), "UserChats.is_read"=>0])->order(["UserChats.id" => "DESC"])->all()->toArray();
/// update reading status true
$results = Hash::extract($UserChats, '{n}.id');
if(!empty($results)) {
$this->UserChats->updateAll(['UserChats.is_read' => 1, "UserChats.read_date_time"=>date("Y-m-d h:i:s")], ['UserChats.id IN' => $results]);
}
$this->set('UserChats', $UserChats);
$myRequestCount = $myReponseCount = 0;
$myfinalCount  = 0;
$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status "=>2]]);
$myfinalCount = $query3 ->count();
$this->set('myfinalCount', $myfinalCount );
$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
$myRequestCount = $query->count();
$myRequestCount1 = $query->count(); 
$delcount=0;
$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1]]);
foreach($requests as $req){
$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
if($rqueryr->count()!=0){
$delcount++;
}
}
if($myRequestCount > $delcount) {
$myRequestCount = $myRequestCount-$delcount;
}	
$this->set('myRequestCountdel', $delcount);
$this->set('myRequestCount', $myRequestCount1);
$queryr = $this->Responses->find('all', ['conditions' => ['Responses.status' =>0,'Responses.user_id' => $this->Auth->user('id')]]);
$myReponseCount = $queryr->count();
$this->set('myReponseCount', $myReponseCount);
}
public function clearreadChats() {
	$this->loadModel('UserChats');
	date_default_timezone_set('Asia/Kolkata');
	$loggedinid = $this->Auth->user('id');
	$conn = ConnectionManager::get('default');
	 
	$sql = "UPDATE user_chats SET `is_read` = '1',`read_date_time`='".date("Y-m-d h:i:s")."'
		 WHERE id IN (
			 SELECT id FROM (
				 SELECT id FROM user_chats WHERE send_to_user_id = '".$loggedinid."' AND is_read='0' ORDER BY created DESC  
				 LIMIT 0, 10
			 ) tmp
		 );"; 
	 $upsql = "UPDATE `user_chats` SET `is_read` = '1',`read_date_time`='".date("Y-m-d h:i:s")."' 
	 WHERE send_to_user_id = '".$loggedinid."' AND is_read='0' order by created DESC LIMIT 10";
	 $stmt = $conn->execute($sql);
	echo $res=1;
exit;
}

public function getnotifications()
{
	$servername = $_SERVER['HTTP_HOST'];
	if($servername =='localhost' OR $servername=='192.168.2.52'){
	$serverurl = 'http://'.$servername.'/travelb2bhub/';
	}else{
	$serverurl = 'https://'.$servername.'/';
	}
	$clearurl = $serverurl."users/clearread-chats";
	date_default_timezone_set('Asia/Kolkata');
	$conn = ConnectionManager::get('default');
	$loggenin_id = $this->Auth->user('id');
	$sql = "Select CONCAT(u.`first_name`,' ',u.`last_name` ) as sender_name,c.* FROM user_chats as c 
			INNER JOIN users as u on u.id=c.user_id
			where c.is_read='0' AND c.send_to_user_id='".$loggenin_id."'
			order by c.created DESC LIMIT 0, 10";
	$stmt = $conn->execute($sql);
	$allunreadchat = $stmt ->fetchAll('assoc');
	
	$countchat = count($allunreadchat);
	if($countchat>0){?>
<a href="javascript:void(0);" id="chat_icon" class="link-icon"><span class="chat_count"><?php echo $countchat;?></span><img src="/img/notify.png" alt=""></a>
 <div class="ap-subs"> <ul class="list-unstyled msg_list" role="menu">	
	<?php foreach($allunreadchat as $allchat) {
		if($allchat['notification']==1) {
		if(strpos($allchat['message'],"accepted")){
			$req_id = $allchat['request_id'];
		$sql = "SELECT re.id,rs.id as responseid FROM requests as re inner join `responses` as rs on rs.request_id=re.id 
		where re.id='".$req_id."' and re.status=2";
		$stmt = $conn->execute($sql);
			$results = $stmt ->fetch('assoc');
$res_userid = 	$allchat['user_id'].'-'.$req_id;		
			?>
	<li>
<a data-target="#myModal1review<?php echo $allchat['id']; ?>" 
href="<?php echo $serverurl;?>users/addtestimonial/<?php echo $res_userid; ?>"
                       data-toggle="modal"
                        class="chat_notification chat_message" ><strong><?php echo $allchat['message']; ?></strong></a>
                                        </li> 
<div class="modal fade" id="myModal1review<?php echo $allchat['id']; ?>" role="dialog">
		<div class="modal-dialog">
		  <!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Review</h4>
			</div>
			<div class="modal-body">
			</div>
		  </div>
		</div>
	</div>				
<?php }else{?>
			<li><a class="chat_notification" href="#"><strong><?php echo $allchat['message']; ?></strong></a></li>	
			<?php } }else{
	 if($allchat['screen_id']==1)
											  {
												  $c=2;
											 $res_text = "Click here to go MY RESPONSES to view it.";
											  }elseif($allchat['screen_id']==2)
											  {
												  $c=1;
											  $res_text = "Click here to go CHECK RESPONSES to view it.";
											  }else{
												  $c=0;
											  $res_text = "";
											  }
	 			?>
			<li><a data-toggle="modal" class="chat_message" data-target="#myModal<?php echo $allchat['request_id']; ?>" href="<?php echo $serverurl;?>users/user-chat/<?php echo $allchat['request_id']; ?>/<?php echo $allchat['user_id']; ?>/<?php echo $c; ?>">
                       <?php $name = $allchat['sender_name'];   
						 				
                        echo "<strong>You have received a CHAT MESSAGE from: <span class='rec_name'>$name</span>. $res_text</strong>"; ?></a>
                                        </li>
                                        <div class="modal fade" id="myModal<?php echo $allchat['request_id']; ?>" role="dialog">
		<div class="modal-dialog">
		<!-- Modal content-->
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Chat</h4>
			</div>
			<div class="modal-body">
			</div>
		  </div>
		  </div>
	</div>
			<?php }
		}	
	?>
	</ul></div>
	<script>
	$("#chat_icon").mouseover(function (e) {
		e.preventDefault();
		var url = '<?php echo $clearurl; ?>';
			$.ajax({
				url:url,
				type: 'POST',
				data: {clearchat:'1'}
			}).done(function(result){
				if(result == 1) {
					var a= 1;
					//$(".chat_count").css("display", "none");
					$(".chat_count").html('0');
				}
			});
	});</script>
	<?php }else{
		echo 0;
		exit;
	}
 exit;
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
if ($user['email_verified'] != 1) {
$mobile_number = $user['mobile_number'];
$theKey = $this->getActivationKey($mobile_number);
if ($activateKey==$theKey) {
$userObj= TableRegistry::get('Users');
$userObj->updateAll(['email_verified' => 1,'status' => 1], ['id' => $userId]);
$this->Flash->success(__('Thank you! Your account is activated now. Please login through Website/App.'));
}
} else {
$this->Flash->success(__('Your account is already active. Please proceed with login through Website/App.'));
}
$this->redirect('/users/login');
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
$message.='<p>Please verify your email address by clicking on the link below <a href="https://www.travelb2bhub.com/users/userVerification?ident=130&activate=ecc572011e9fcf2449f30655b276c723">click here<a></p>';
$message.='<p>Note: You will receive a notification when there are enough registered members for you to begin trading. Please encourage your contacts to enroll.</p>';
$message.='<p>We are committed to enhance your trading experience!</p>';
$message.='<p>Sincerely,<br>The TravelB2Bhub Team</p>';
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
	$this->viewBuilder()->layout('');
Configure::write('debug',2);
if ($this->request->is('post')) {
$this->loadModel('Users');
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
$usernumber = $user["mobile_number"].''.$user["id"];
$theKey = sha1($usernumber);
//die();
//	$theKey = $this->getActivationKey($user["mobile_number"]);
$userId = $user["id"];
$tablename = TableRegistry::get("Users");
$query = $tablename->query();
$result = $query->update()
->set(['activation' => $theKey])
->where(['id' => $userId])
->execute();
$subject="TravelB2Bhub Reset Password";
$to = $user["email"];
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: TravelB2Bhub <contactus@travelb2bhub.com>' . "\r\n";
$message='<p>Dear '.$user['first_name'].',</p>';
$message.="<p>Reset your password, and we'll get you on your way.</p>";
$message.='<p>To change your TravelB2Bhub password, click the following link into your browser:
<a href="https://www.travelb2bhub.com/users/activatePassword?ident='.$userId.'&activate='.$theKey.'">click here</a></p>';
$message.='<p>Sincerely,<br>The TravelB2Bhub Team</p>';
// Mail it
	$email = new Email();    
    $email->transport('gmail')
            ->from(['webmaster@travelb2bhub.com'=>'TravelB2Bhub'])
            ->to($to)
            ->subject($subject)
             ->emailFormat('html')
            ->viewVars(array('msg' => $message))
            ->send($message);
//@mail($to, $subject, $message, $headers);
$this->Flash->success(__('Please check your email to reset your password.'));
$this->redirect('/users/forgot-password');
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
	$this->viewBuilder()->layout('');
	
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
$usernumber = $user["mobile_number"].''.$userId;
$theKey = sha1($usernumber);
//	$theKey = $this->getActivationKey($mobile_number);
if ($activateKey==$theKey) {
$user = $this->Users->patchEntity($user, ['password' => $this->request->data['password'],'activation'=>'']);
if ($this->Users->save($user)) {
$this->Flash->success(__('Your password has been reset successfully.'));
/*$subject="TravelB2Bhub Changed Password";
$to = $user["email"];
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: TravelB2Bhub <contactus@travelb2bhub.com>' . "\r\n";
$message='<p>Dear '.$user['first_name'].'</p>';
$message.="<p>Your Password has been reset successfully.</p>";
$message.='<p><a href="https://www.travelb2bhub.com">Click here<a>, to login to your account.</p>';
$message.='<p>Sincerely,<br>The TravelB2Bhub Team</p>';
// Mail it
@mail($to, $subject, $message, $headers);*/
$this->redirect('/users/login');
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
$user = $this->Users
->find()
->where(['id' =>$_GET['ident'],'activation'=>$_GET['activate']])
->first();
if (!empty($user)) {
$this->set('ident',$_GET['ident']);
$this->set('activate',$_GET['activate']);
}else{
$this->Flash->error(__('Something went wrong, please click again on the link in email.'));
}
//$this->redirect('/users/activate_password');
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
return array("1"=>"Corporate Hotel", "2"=>"Boutique Hotel", "3"=>"Heritage Hotel", "4"=>"House Boat", "5"=>"Resort", "6"=>"Eco Resort", "7"=>"Farm-stay", "8"=>"Homestay", "9"=>"Heritage Homestay", "10"=>"Camping", "11"=>"Glamping","12"=>"Dormitory");
}
public function _getTranspoartRequirmentsArray() {
return array("1"=>"Luxury Car", "2"=>"Sedan", "3"=>"Innova/ Tavera", "4"=>"Tempo Traveller", "5"=>"AC Coach", "6"=>"Non AC Bus");
}
public function _getMealPlansArray() {
return array("1"=>"EP - European Plan", "2"=>"CP - Contenental Plan", "3"=>"MAP - Modified American Plan", "4"=>"AP - American Plan");
}
function addNewDestinationRow() {
	$this->set("hotelCategories", $this->_getHotelCategoriesArray());
	$this->set("randomNumber", $_POST["number"]);
	$this->render('/Element/new_destination');
}
public function addresponse() {
	date_default_timezone_set('Asia/Kolkata');
$this->loadModel('Responses');
$this->loadModel('Requests');
$this->loadModel('User_Chats');
$this->loadModel('BlockedUsers');
$user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
$this->set('users', $user);
if($this->request->is('post')){
$d = $this->request->data;
$TableRequest = TableRegistry::get('Requests');
$request = $TableRequest->get($_POST["request_id"]);
$d["user_id"] = $this->Auth->user('id');
//$checkblockedUsers = $this->BlockedUsers->find()->where(['blocked_by' => $request['user_id'],'blocked_user_id'=>$d["user_id"]])->count();
$d["status"] = 0;
$response = $this->Responses->newEntity($d);
if ($re = $this->Responses->save($response)) {
$name = $user['first_name'].' '.$user['last_name'];
//$message = "$name has responded to your request";
$ref_id = $request['reference_id'];
$message = "You have received a Response for Reference ID: $ref_id. Click here to go MY REQUESTS tab to view it.";
$userchatTable = TableRegistry::get('User_Chats');
$userchats = $userchatTable->newEntity();
$userchats->request_id = $request["id"];
$userchats->user_id = $this->Auth->user('id');
$userchats->send_to_user_id = $request["user_id"];
$userchats->message = $message;
$userchats->created = date("Y-m-d h:i:s");
$userchats->notification = 1;;
if ($userchatTable->save($userchats)) {
$id = $userchats->id;
}
$this->Flash->success(__('Your response has bee submitted successfully.'));
} else {
$this->Flash->error(__('Sorry.'));
}
}
return $this->redirect('/users/respondtorequest?success');
}
public function addNewsLatter() {
$this->loadModel('NewsLatters');
$res = 0;
if(isset($_POST["news_latter_email"]) && !empty($_POST["news_latter_email"])) {
$d["email"] = $_POST["news_latter_email"];
$d["created"] = date("Y-m-d H:i:s");
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
$d["created"] = date("Y-m-d H:i:s");
$checkBlockedUsers = $this->BlockedUsers->find()->where(['blocked_user_id' => $d['blocked_user_id'],'blocked_by' => $d['blocked_by']])->count();			
if($checkBlockedUsers >=1) {
$res = 2;
}else {
$BlockUser = $this->BlockedUsers->newEntity($d);
if($this->BlockedUsers->save($BlockUser)) {
$res = 1;
} else {
$res = 0;
}
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
$d["created"] = date("Y-m-d H:i:s");
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
public function removeBusinessBuddy() {
$this->loadModel('BusinessBuddies');
$res = 0;
if(isset($_POST["follow_id"]) && !empty($_POST["follow_id"]) && !empty($this->Auth->user('id'))) {
if($this->BusinessBuddies->deleteAll(["id"=>$_POST["follow_id"]])) {
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
	$this->viewBuilder()->layout('user_layout');	
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
	 
		$this->set('blockedUsers', $blockedUsers);
		$myRequestCount = $myReponseCount = 0;
		$myfinalCount  = 0;
		$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status "=>2]]);
		$myfinalCount = $query3 ->count();
		$this->set('myfinalCount', $myfinalCount );
		
		$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
		$myRequestCount = $query->count();
		$myRequestCount1 = $query->count(); 
		$delcount=0;
		$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1]]);
		
		foreach($requests as $req){
			$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
			if($rqueryr->count()!=0){
				$delcount++;
			}
		}
		
		if($myRequestCount > $delcount) {
			$myRequestCount = $myRequestCount-$delcount;
		}	
	$this->set('myRequestCountdel', $delcount);
	$this->set('myRequestCount', $myRequestCount1);
	
	$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id')]]);
	$myReponseCount = $queryr->count();
	
	$this->set('myReponseCount', $myReponseCount);
	$this->loadModel('User_Chats');
	$csort['created'] = "DESC";
	
	$allUnreadChat = $this->User_Chats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->order($csort)->limit(10)->all();
	$chatCount = $allUnreadChat->count();
	
	$this->set('chatCount',$chatCount);
	$this->set('allunreadchat',$allUnreadChat);
}
public function businessBuddiesList() {
$this->loadModel('Responses');
$this->loadModel('Hotels');
$this->loadModel('Requests');
$this->loadModel('Cities');
$this->loadModel('BusinessBuddies');

	$this->viewBuilder()->layout('user_layout');
$BusinessBuddies = $this->BusinessBuddies->find()
->contain(["Users"])
->where(['BusinessBuddies.user_id' => $this->Auth->user('id')])->group(['BusinessBuddies.bb_user_id'])->order(["BusinessBuddies.id" => "DESC"])->all();
$user = $this->Users->find()
->contain(["Credits"])
->where(['Users.id' => $this->Auth->user('id')])->first();
$this->set('users', $user);
//pr($BusinessBuddies); exit;
$this->set('BusinessBuddies', $BusinessBuddies);
$myRequestCount = $myReponseCount = 0;
$myfinalCount  = 0;
$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status "=>2]]);
$myfinalCount = $query3 ->count();
$this->set('myfinalCount', $myfinalCount );
$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
$myRequestCount = $query->count();
$myRequestCount1 = $query->count(); 
$delcount=0;
$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1]]);
foreach($requests as $req){
$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
if($rqueryr->count()!=0){
$delcount++;
}
}
if($myRequestCount > $delcount) {
$myRequestCount = $myRequestCount-$delcount;
}	
$this->set('myRequestCountdel', $delcount);
$this->set('myRequestCount', $myRequestCount1);
$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id')]]);
$myReponseCount = $queryr->count();
$this->set('myReponseCount', $myReponseCount);
$this->loadModel('User_Chats');
$csort['created'] = "DESC";
$allUnreadChat = $this->User_Chats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->order($csort)->limit(10)->all();
$chatCount = $allUnreadChat->count();
$this->set('chatCount',$chatCount); 
$this->set('allunreadchat',$allUnreadChat);
}
public function removeRequest() {
$this->loadModel('Requests');
$this->loadModel('Responses');
$res = 1;
if(isset($_POST["request_id"]) && !empty($_POST["request_id"]) && !empty($this->Auth->user('id'))) {
$TableRequest = TableRegistry::get('Requests');
$request = $TableRequest->get($_POST["request_id"]);
$request->is_deleted = 1;
if ($TableRequest->save($request)) {
$res = 1;
$TableResponse = TableRegistry::get("Responses");
$query = $TableResponse->query();
$result = $query->update()
->set(['is_deleted' => '1'])
->where(['request_id' => $_POST["request_id"]])
->execute();
}
}
echo $res;
exit;
}
public function addChat() {
date_default_timezone_set('Asia/Kolkata');
$this->loadModel('UserChats');
if($this->request->is('post')){
$d = $this->request->data;
	$sd = array();
$TableUser = TableRegistry::get('Users');
	$conn = ConnectionManager::get('default');
$user = $TableUser->get($this->Auth->user('id'));
$name = $user['first_name'].' '.$user['last_name'];
//$d["message"] = "You have received a chat message from $name";	
$d["user_id"] = $this->Auth->user('id');
$d["send_to_user_id"] = $d['chat_user_id'];
$d["created"] = date("Y-m-d H:i:s");
	
$sql = "Insert into user_chats SET user_id='".$this->Auth->user('id')."',send_to_user_id='".$d['chat_user_id']."',
	created='".date("Y-m-d H:i:s")."',request_id='".$d['request_id']."',screen_id='".$d['screen_id']."',
	message='".$_POST['message']."'";
$stmt = $conn->execute($sql);
/*if(isset($d['screen_id']))
	{
	$d["screen_id"] = $d['screen_id'];
	}*/
/*$UserChat = $this->UserChats->newEntity($d);
if ($re = $this->UserChats->save($UserChat)) {
$this->Flash->success(__('Your message has been sent to user.'));
} else {
$this->Flash->error(__('Sorry, message could not send, please try again.'));
}*/
}
return $this->redirect($this->referer());
}
public function rateUser() {
	date_default_timezone_set('Asia/Kolkata');
$this->loadModel('UserRatings');
$res = 0;
if(isset($_POST["request_id"]) && !empty($_POST["request_id"]) && !empty($this->Auth->user('id'))) {
$d["request_id"] = $_POST["request_id"];
$d["rating"] = $_POST["rating"];
$d["user_id"] = $_POST["user_id"];
$d["created"] = date("Y-m-d H:i:s");
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
	date_default_timezone_set('Asia/Kolkata');
$this->loadModel('Responses');
$this->loadModel('UserChats');
$res = 0;
if(isset($_POST["response_id"]) && !empty($_POST["response_id"]) && !empty($this->Auth->user('id'))) {
$TableResponse = TableRegistry::get('Responses');
$response = $TableResponse->get($_POST["response_id"]);
$response->is_details_shared = 1;
$TableResponse->save($response);
if ($TableResponse->save($response)) {
$user_from_id = $this->Auth->user('id');
$TableUser = TableRegistry::get('Users');
$user = $TableUser->get($user_from_id);
$name = $user['first_name'].' '.$user['last_name'];
$message = "<span class='rec_name'>".$name."</span> has shared his Contact Info. Click here to go MY RESPONSES tab to view it.";
$send_to_user_id = $_POST["user_id"];
$userchatTable = TableRegistry::get('User_Chats');
$userchats = $userchatTable->newEntity();
$userchats->request_id = $_POST["request_id"];
$userchats->user_id = $user_from_id;
$userchats->send_to_user_id = $send_to_user_id;
$userchats->message = $message;
$userchats->created = date("Y-m-d h:i:s");
$userchats->notification = 1;
if ($userchatTable->save($userchats)) {
$id = $userchats->id;
$res = 1;
}
$res = 1;
}
}
echo $res;
exit;
}
public function userChat($requestId, $chatUserId,$screenid=null) {
	Configure::write('debug',2);
	date_default_timezone_set('Asia/Kolkata');
	$this->loadModel('UserChats');
	$readtime = date("Y-m-d h:i:s");
	$loggedinid = $this->Auth->user('id');
		
	$conn = ConnectionManager::get('default');
	$sql = "UPDATE user_chats SET is_read='1',read_date_time='".$readtime."' WHERE request_id='".$requestId."' AND send_to_user_id='".$loggedinid."'";
	$stmt = $conn->execute($sql);
		
	//$this->UserChats->updateAll(['is_read' => 1, "read_date_time"=>date("Y-m-d h:i:s")], ['request_id ' => $requestId]);
	$UserChats = $this->UserChats->find()
	->contain(["Users"/*, "Requests"*/])
	->where(["UserChats.request_id"=>$requestId,"UserChats.notification"=>0, 'UserChats.user_id IN' => array($this->Auth->user('id'), $chatUserId),'UserChats.send_to_user_id IN' => array($this->Auth->user('id'), $chatUserId)])->order(["UserChats.id" => "ASC"])->all()->toArray();
	$this->set('UserChats', $UserChats);
	$this->set("requestId", $requestId);
	$this->set("chatUserId", $chatUserId);
	$this->set("screen_id", $screenid);
	$this->render('/Element/user_chat');
}

public function addtestimonial($userId) {
	date_default_timezone_set('Asia/Kolkata');
	error_reporting(0);
	$this->loadModel('Requests');
	$this->loadModel('Responses');
	$this->loadModel('Promotion');
	$this->loadModel('Testimonial');
	$this->loadModel('User_Chats');
	$explodeuserandreqid = explode('-',$userId);
	$reviewuserId = $explodeuserandreqid[0];
	$reqid = $explodeuserandreqid[1];
	$authoruserId = $this->Auth->user('id');
	$testimonialedit = $this->Testimonial->find()->where(['request_id' => $reqid, 'author_id'=>  $authoruserId,'user_id'=>$reviewuserId])->first();
	$allUnreadChat = $this->User_Chats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->all();
	$this->set('allunreadchat',$allUnreadChat);
	$user = $this->Users->find()
		->contain(["Credits"])
		->where(['Users.id' => $this->Auth->user('id')])->first();
	$this->set('users', $user);
	$this->set('userProfile', $user);
	$myRequestCount = $myReponseCount = 0;
	$myfinalCount  = 0;
	$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status "=>2]]);
	$myfinalCount = $query3 ->count();
	$this->set('myfinalCount', $myfinalCount );
	$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
	$myRequestCount = $query->count();
	$myRequestCount1 = $query->count(); 
	$delcount=0;
	$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1]]);
	foreach($requests as $req){
		$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
		if($rqueryr->count()!=0){
			$delcount++;
		}
	}
	if($myRequestCount > $delcount) {
		$myRequestCount = $myRequestCount-$delcount;
	}	
	$this->set('myRequestCountdel', $delcount);
	$this->set('myRequestCount', $myRequestCount1);
	$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.user_id' => $this->Auth->user('id')]]);
	$myReponseCount = $queryr->count();
	$this->set('myReponseCount', $myReponseCount);
	$userDetails = $this->Users->get($authoruserId);
	if ($this->request->is(['post', 'put'])) {
		if($this->request->data['testimonialid']!="0"){
			$tablename = TableRegistry::get("testimonial");
			$query = $tablename->query();
			$result = $query->update()
				->set(['author_id' => $this->request->data['author_id'],'request_id'=>$this->request->data['request_id'],'user_id'=>$this->request->data['user_id'],'rating'=>$this->request->data['rating'],'comment'=>$this->request->data['comment']])
				->where(['id' => $this->request->data['testimonialid']])
				->execute();
			return $this->redirect('/users/testimonialthanks');
		} 
		else
		{
			$testimonialTable = TableRegistry::get('testimonial');
			$testimonial = $testimonialTable->newEntity();
			$testimonial->author_id = $this->request->data['author_id'];
			$testimonial->request_id = $this->request->data['request_id'];
			$testimonial->user_id = $this->request->data['user_id'];
			$testimonial->rating = $this->request->data['rating'];
			$testimonial->comment = $this->request->data['comment'];
			$testimonial->status =  '0';
			$testimonial->created_at = date("Y-m-d H:i:s");
			 
			if ($testimonialTable->save($testimonial)) {
				$id = $testimonial->id;
				return $this->redirect('/users/testimonialthanks');
			}
		}
	}
	$this->set(compact("authoruserId","reviewuserId","reqid","userDetails","testimonialedit"));
	$this->render('/Users/add-testimonial');
}
public function promotioncounts($id) {
	$this->loadModel('Promotion');
	$query =  $this->Promotion->find()->where(['id' => $id])->first();
	$nextcount =  $query['count'] + 1;
	$this->Promotion->updateAll(
		array('count' => $nextcount),
		array('id' => $id)
	);
	exit;
}
	public function testimonialthanks(){
		$this->loadModel('Responses');
		$this->loadModel('Hotels');
		$this->loadModel('Requests');
		$this->loadModel('Cities');
		$this->viewBuilder()->layout('user_layout');
		$user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
		$this->set('users', $user);
		$myRequestCount = $myReponseCount = 0;
		$myfinalCount  = 0;
		$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status "=>2]]);
		$myfinalCount = $query3 ->count();
		$this->set('myfinalCount', $myfinalCount );
		$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
		$myRequestCount = $query->count();
		$myRequestCount1 = $query->count(); 
		$delcount=0;
		$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1]]);
		foreach($requests as $req){
			$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
			if($rqueryr->count()!=0){
				$delcount++;
			}
		}
		if($myRequestCount > $delcount) {
			$myRequestCount = $myRequestCount-$delcount;
		}	
		$this->set('myRequestCountdel', $delcount);
		$this->set('myRequestCount', $myRequestCount1);
	
		$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.user_id' => $this->Auth->user('id')]]);
		$myReponseCount = $queryr->count();
		$this->set('myReponseCount', $myReponseCount);
		$this->loadModel('User_Chats');
		$csort['created'] = "DESC";
		$allUnreadChat = $this->User_Chats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->order($csort)->limit(10)->all();
		$chatCount = $allUnreadChat->count();
		$this->set('chatCount',$chatCount);
		$this->set('allunreadchat',$allUnreadChat);
		$thankscontent = "Thank you! Your Review has been successfully submitted.";
		$this->set(compact("thankscontent"));  
	}
	
public function promotionreports($id) {
	
	$this->viewBuilder()->layout('user_layout');
	$this->loadModel('Promotion');
	$this->loadModel('Requests');
	$this->loadModel('Responses');
	$this->loadModel('User_Chats');
	$this->loadModel('Cities');
	$this->loadModel('States');
	
	$promotion =  $this->Promotion->find()->where(['user_id' => $id])->all();
	$this->set("promotionreport", $promotion);
	$allCities = $this->Cities->find('list',['keyField' => 'id', 'valueField' => 'name'])
	->hydrate(false)
	->toArray();

	$this->set("allCities", $allCities);

	$allCities1 = $this->Cities->find('list',['keyField' => 'id', 'valueField' => 'state_id'])
	->hydrate(false)
	->toArray();

	$this->set("allCities1", $allCities1);
	$allStates = $this->States->find('list',['keyField' => 'id', 'valueField' => 'state_name'])
	->hydrate(false)
	->toArray();

	$this->set("allStates", $allStates);
	$user = $this->Users->find()
	->contain(["Credits"])
	->where(['Users.id' => $this->Auth->user('id')])->first();
	$this->set('users', $user);
	
	$myRequestCount = $myReponseCount = 0;
	$myfinalCount  = 0;
	$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status "=>2]]);
	$myfinalCount = $query3 ->count();
	$this->set('myfinalCount', $myfinalCount );
	
	$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
	$myRequestCount = $query->count();
	$myRequestCount1 = $query->count(); 
	$delcount=0;
	$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>1]]);
		foreach($requests as $req){
			$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
			if($rqueryr->count()!=0){
				$delcount++;
			}
		}
		if($myRequestCount > $delcount) {
			$myRequestCount = $myRequestCount-$delcount;
		}	
	$this->set('myRequestCountdel', $delcount);
	$this->set('myRequestCount', $myRequestCount1);
	
	$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id')]]);
	$myReponseCount = $queryr->count();
	$this->set('myReponseCount', $myReponseCount);
	
	$this->render('/Users/promotionreport');
	$allUnreadChat = $this->User_Chats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->all();
	 
	$this->set('allunreadchat',$allUnreadChat);
}

public function getuserrating() {
	$servername = $_SERVER['HTTP_HOST'];
	if($servername =='192.168.3.82' OR $servername=='192.168.3.52'){
	$serverurl = 'http://'.$servername.'/b2b/';
	}else{
	$serverurl = 'https://'.$servername.'/';
	}
$this->loadModel('Testimonial');
$this->loadModel('Users');
$id = $_POST['user_id'];
$rating = $_POST['rating'];
if($rating==0){
$testimonials = $this->Testimonial->find()->where(['user_id'=> $id])->all();
}else{
$testimonials = $this->Testimonial->find()->where(['user_id'=> $id,'rating'=>$rating])->all();
}
$alltestimonials = array();
if(count($testimonials)>0) {
foreach($testimonials as $testimonial) {
$users = $this->Users->find()->where(['status' => 1,'id'=> $testimonial['author_id']])->first();
$name = $users['first_name']." ".$users['last_name'];
$alltestimonials[] = array( "name"=>$name,"rating1"=>$testimonial['rating'], "description"=>$users['description'], "profile_pic"=>$users['profile_pic'], "comment"=>$testimonial['comment'],"user_id"=>$testimonial['user_id'],"author_id"=>$testimonial['author_id']);
}?>
<div class="carousel-reviews broun-block">
<div id="carousel-reviews" class="carousel slide" data-ride="carousel">
<div class="carousel-inner">
<?php $testi = $alltestimonials;
      $x=1;
      foreach($alltestimonials  as $testimo){
?>
<div class="item <?php if($x==1){ echo 'active'; } ?>">
<?php $k =1; ?>
<div class="rating_<?php echo $testimo['rating1'];?> ratingno col-lg-6 col-md-6 col-sm-6 col-xs-12 padding0_on767">
<div class="review-block">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 padding0">
<div class="block-text">
<p><?php echo $testimo['comment']; ?></p>
</div>
<img src="/img/review_bottom_border.png" class="img-responsive">
</div>
<div class="col-lg-3 col-md-3 col-sm-5 col-xs-4 person-img">
<?php
if($testimo["profile_pic"]==""){?>
<img src="<?php echo $serverurl;?>img/no-profile-image.jpg" class="img-responsive center_img" alt="Profile Pic" height="150"/>
<?php }else{ ?>
<img src="<?php echo $serverurl;?>img/user_docs/<?php echo $testimo["author_id"].'/'.$testimo["profile_pic"];?>" class="img-responsive center_img" alt="Profile Pic" height="150">
<?php } ?>
</div>
<div class="col-lg-9 col-md-9 col-sm-7 col-xs-8 person-info">
<h4><?php echo $testimo['name']; ?></h4>
<div class="rating">
<?php
$userRating =  $testimo['rating1'];
if($userRating>0){
for($i=$userRating; $i>0; $i--){
echo '<i class="fa fa-star"></i>';
}
}else{
echo '<i class="fa fa-star"></i>';
}
?>
</div>
 </div>
 </div>
</div>
</div>
<?php $x++; } ?>
</div>
                                                    <?php if(count($alltestimonials)>2){?>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center padding0">
                                                        <a class="left view_profile_left carousel-control" href="#carousel-reviews" role="button" data-slide="prev">
                                                            <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                                                        </a>
                                                        <a class="right view_profile_right carousel-control" href="#carousel-reviews" role="button" data-slide="next">
                                                            <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                    <?php }?>
</div>
</div>
<script>
$('#carousel-reviews .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));
  
  
});
</script>
<?php }else { echo "No reviews";}
  echo exit;    
}

	public function __getMyRequestCount()
	{
	$this->loadModel('Requests');
	$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
	return $myRequestCount = $query->count();
	}
	
	public function __getMyResponseCount()
	{ 
	$this->loadModel('Requests');
	$this->loadModel('Responses');
	$this->loadModel('Hotels');
	$this->loadModel('User_Chats');
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
	$loggedinid =	$this->Auth->user('id');
	$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id')]]);
	
		$myReponseCount = $queryr->count();
		if($myReponseCount>0){
		foreach($queryr as $req){
	$checkblockedUsers = $this->BlockedUsers->find()->where(['blocked_by' => $req['request']['user_id'],'blocked_user_id'=>$loggedinid])->count();        
		if($checkblockedUsers>0){
		$myReponseCount--;
		}
		}
		}
	return $myReponseCount;
	}	
	
public function getRespondrequestCounts() {
echo $this->__getRespondToRequestCount();
	die();
}
	
public function getMyrequestCounts() {
echo $this->__getMyRequestCount();
	die();
}
	public function getMyresponseCounts() {
echo $this->__getMyResponseCount();
	die();
}
	
public function getmyrequestlistsapi()
{
$this->loadModel('Responses');
$this->loadModel('Hotels');
$this->loadModel('Requests');
$this->loadModel('Cities');
$this->loadModel('States');
$this->loadModel('User_Chats');
	$user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
	if(!empty($_POST["keyword"])) {
	$conditions["Requests.reference_id LIKE "] = "%".$_POST["keyword"]."%";
	}
if(!empty($_POST["budgetsearch"])) {
$QPriceRange = $_POST["budgetsearch"];
$result = explode("-", $QPriceRange);
$MinQuotePrice = $result[0];
$MaxQuotePrice = $result[1];
$conditions["Requests.total_budget >="] = $MinQuotePrice;
$conditions["Requests.total_budget <="] = $MaxQuotePrice;
}
	if(!empty($_POST["req_typesearch"])) {
$conditions["Requests.category_id"] =  $_POST["req_typesearch"];
}
if(!empty($_POST["refidsearch"])) {
$conditions["Requests.reference_id"] =  $_POST["refidsearch"];
}
if(!empty($_POST["destination_city"])) {
$conditions["Requests.city_id"] =  $_POST["destination_city"];
}
if(!empty($_POST["pickup_city"])) {
$conditions["Requests.pickup_city"] =  $_POST["pickup_city"];
}
$sdate = $_POST["startdatesearch"];
$sdate = (isset($sdate) && !empty($sdate))?$this->ymdFormatByDateFormat($sdate, "m-d-Y", $dateSeparator="/"):null;
if(!empty($_POST["startdatesearch"])) {
$da["Requests.start_date"] =  $sdate;
$da["Requests.check_in"] =  $sdate;
$conditions["OR"] =  $da;
}
$edate = $_POST["enddatesearch"];
$edate = (isset($edate) && !empty($edate))?$this->ymdFormatByDateFormat($edate, "m-d-Y", $dateSeparator="/"):null;
if(!empty($_POST["enddatesearch"])) {
$da1["Requests.end_date"] =  $edate;
$da1["Requests.check_out"] =  $edate;
$conditions["OR"] =  $da1;
}
$conditions["Requests.user_id"] = $this->Auth->user('id');
$conditions["Requests.status !="] = 2;
$conditions["Requests.is_deleted "] = 0;
$sort='';
if(empty($_POST["sort"])) {
$sort['Requests.id'] = "DESC";
}
if(!empty($_POST["sort"]) && $_POST["sort"]=="requesttype") {
$sort['Requests.category_id'] = "ASC";
}
if(!empty($_POST["sort"]) && $_POST["sort"]=="totalbudgetlh") {
$sort['Requests.total_budget'] = "ASC";
}
if(!empty($_POST["sort"]) && $_POST["sort"]=="totalbudgethl") {
$sort['Requests.total_budget'] = "DESC";
}
if($this->Auth->user('role_id') == 1) {
$requests = $this->Requests->find()
->contain(["Users","Hotels"])
->where($conditions)->order($sort)->all();
}
if($this->Auth->user('role_id') == 2) {
$requests = $this->Requests->find()
->contain(["Users","Hotels"])
->where($conditions)->order($sort)->all();
}
if($this->Auth->user('role_id') == 3) {
$conditions["Requests.category_id "] = 3;
$requests = $this->Requests->find()
->contain(["Users","Hotels"])
->where($conditions)->order($sort)->all();
}
	$data = array();
foreach($requests as $req){
$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.request_id' =>$req['id']]])->contain(['Users']);
$data[$req['id']]  = $queryr->count();
	}
	
	echo json_encode($data);
	die();
//$this->set(compact('requests', "allCities", "allStates","requests", "data","user"));
}
	
public function getcheckresponselists()
{
$this->loadModel('Responses');
$this->loadModel('Requests');
$this->loadModel('Cities');
$this->loadModel('States');
$this->loadModel('User_Chats');
$this->loadModel('Testimonial');
$loggedinid= $this->Auth->user('id');
$user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
$this->set('users', $user);
$id = $_POST['request_id'];
$keyword = "";
$acceptDeals = "";
	$conditions["Responses.request_id"] = $id;
	if(!empty($_POST["agentname"])) {
$keyword1 = '';
$keyword2 = '';
$keyword = trim($_POST["agentname"]);
$keyword = explode(' ',$keyword);
if(isset($keyword[0]) && !isset($keyword[1])) {
$keyword1 = $keyword[0];
$conditions["Users.first_name"] =$keyword1;
}
if(isset($keyword[1])) {
$keyword1 = trim($keyword[0]);
$keyword2 = trim($keyword[1]);
$da["Users.first_name"] =  $keyword1;
$da["Users.last_name"] =  $keyword2;
$conditions["AND"] =  $da;
}
	}
if(!empty($_POST["acceptdeals"])) {
$conditions["Responses.status"] = 1;
$acceptDeals = 1;
}
$sortorder ='';
$chat_sort = 0;
$responses = $this->Responses->find()
->contain(["Users", "Requests", "UserChats","Testimonial"])
->where($conditions)
->order($sortorder)
->all();	
$userchatTable = TableRegistry::get('User_Chats');
$conn = ConnectionManager::get('default');
$data = array();
foreach($responses as $row){ 
$request_id = $row['request']['id'];
$user_id = $row['user']['id'];
$sql = "SELECT *,COUNT(*) as ch_count FROM user_chats 
WHERE request_id='".$request_id."' AND (user_id in ('".$loggedinid."','".$user_id."') 
AND notification='0'
ANd send_to_user_id in ('".$loggedinid."','".$user_id."')) ";
$stmt = $conn->execute($sql);
$results = $stmt ->fetch('assoc');			
//$row["request"]["chat_count"]=$results['ch_count'];
$data[$row['id']] =$results['ch_count'];
	echo json_encode($data);
	die();
}	
	
}

}