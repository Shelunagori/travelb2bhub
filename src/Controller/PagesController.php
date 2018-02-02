<?php 
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Email\Email;
/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{
    public function beforeFilter(Event $event) {
		//$this->viewBuilder()->layout('home_layout');
		$this->loadModel('Users');
		$this->loadModel('Contacts');
      parent::beforeFilter($event);
      $this->Auth->allow();
    }

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function display()
    {
        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }
    public function sliderautocount($countfor){
		$this->loadModel('Requests');
		$this->loadModel('Slider');
		$travelAgentCount = $this->Users->find()->where(['role_id' => 1])->count();
		$eventPlannerCount = $this->Users->find()->where(['role_id' => 2])->count();
		$hotelierCount = $this->Users->find()->where(['role_id' => 3])->count();
		if($countfor=="ta"){
		echo '('.$travelAgentCount .')';
	   } 
	   if($countfor=="ep"){
		echo '('.$eventPlannerCount.')';
	   } 
	   if($countfor=="hot"){
		echo '('.$hotelierCount.')';
	   } 
		exit;
    }    
    public function home(){
		$this->loadModel('Requests');
		$this->loadModel('Slider');
		$travelAgentCount = $this->Users->find()->where(['role_id' => 1])->count();
		$eventPlannerCount = $this->Users->find()->where(['role_id' => 2])->count();
		$hotelierCount = $this->Users->find()->where(['role_id' => 3])->count();
		$overview = $this->Pages->find()->where(['id' => 1])->first();
		$benifits1 = $this->Pages->find()->where(['id' => 2])->first();
		$benifits2 = $this->Pages->find()->where(['id' => 3])->first();
		$benifits3 = $this->Pages->find()->where(['id' => 4])->first();
		$benifits4 = $this->Pages->find()->where(['id' => 5])->first();
		$benifits5 = $this->Pages->find()->where(['id' => 6])->first();
		$benifits6 = $this->Pages->find()->where(['id' => 7])->first();
		$sliders = $this->Slider->find()->where(['status' => 1])->all();
		$requests = $this->Requests->find()
                            ->contain(["Users", "Cities"])
                            ->where(["Requests.status !="=>2, "Requests.is_deleted"=>0])->all();
		$userId = $this->Auth->user('id');
		$this->set(compact("travelAgentCount", "eventPlannerCount", "hotelierCount", "userId", "requests","overview","benifits1","benifits2","benifits3","benifits4","benifits5","benifits6","sliders"));
    }
    public function aboutus(){	


        $aboutcontent = $this->Pages->find()->where(['id' => 9])->first();
        $this->set(compact("aboutcontent"));
    }
	 public function faq(){		
        $faqcontent = $this->Pages->find()->where(['id' => 12])->first();
        $this->set(compact("faqcontent"));
    }
 public function faqapi(){		
        $faqcontentapi = $this->Pages->find()->where(['id' => 12])->first();
        $this->set(compact("faqcontentapi"));
    }
    public function privacypolicy(){
        $privacypolicycontent = $this->Pages->find()->where(['id' => 10])->first();
        $this->set(compact("privacypolicycontent"));
    } 
	public function termsandconditions(){
        $termsandconditionscontent = $this->Pages->find()->where(['id' => 11])->first();
        $this->set(compact("termsandconditionscontent"));
    }
    public function memberships(){
    if($this->Auth->user('id')!="") {
 	$this->redirect('/users/dashboard');
    }
    	$this->loadModel('Membership');
		$membership_text = $this->Pages->find()->where(['id' => 8])->first();
		$memberships = $this->Membership->find()->where(['status' => 1])->all();
		$this->set(compact("membership_text","memberships"));
    }
	/**
	public function settings(){
		$this->loadModel('Setting');
		$settings = $this->Setting->find('all');
		$this->set('settings', $settings); 
    }
	**/
	public function feedback(){
		if($this->request->is('post')) {
			$subject="TravelB2Bhub Feedback";
					$to= "harshbula@travelb2bhub.com";
//$to= "pradysingh@gmail.com";
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: '.$this->request->data['name1'].' <noreply@travelb2bhub.com>' . "\r\n";
			$message='<p>Dear Admin,</p>';
			$message.='<p>Below are the feedback</p>';
			$message.='<p><span style="font-weight:bold;">Name : </span><span>'.$this->request->data['name1'].'</span></p>';
			$message.='<p><span style="font-weight:bold;">Phone : </span><span>'.$this->request->data['phone1'].'</span></p>';
			$message.='<p><span style="font-weight:bold;">Email : </span><span>'.$this->request->data['email1'].'</span></p>';
			
			$message.='<p><span style="font-weight:bold;">Comment : </span><span>'.$this->request->data['body1'].'</span></p>';
			// Mail it
			@mail($to, $subject, $message, $headers);
			//$this->Flash->success(__('We have received your query.'));
			unset($this->request->data);
exit;
		}else {
			$user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
			$this->set('user', $user);
exit;
		}
		
	}
	public function contactus(){
		
		if ($this->request->is('post')) {
			//pr($this->request->data); exit;
			$subject="TravelB2Bhub Contact Us";
			$to= "harshbula@travelb2bhub.com";
//$to= "pradysingh@gmail.com";
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: '.$this->request->data['first_name'].' '.$this->request->data['last_name'].' <noreply@travelb2bhub.com>' . "\r\n";
			
			$message='<p>Dear Admin,</p>';
			$message.='<p> Below are the contact details.</p>';
			$message.='<p><span style="font-weight:bold;">Name : </span><span>'.$this->request->data['first_name'].' '.$this->request->data['last_name'].'</span></p>';
			$message.='<p><span style="font-weight:bold;">Phone : </span><span>'.$this->request->data['phone'].'</span></p>';
			$message.='<p><span style="font-weight:bold;">Email : </span><span>'.$this->request->data['email'].'</span></p>';
			$message.='<p><span style="font-weight:bold;">Subject : </span><span>'.$this->request->data['subject'].'</span></p>';
			$message.='<p><span style="font-weight:bold;">Comment : </span><span>'.$this->request->data['comment'].'</span></p>';
			// Mail it
			@mail($to, $subject, $message, $headers);
			$d = $this->request->data;
            $d['status'] = 0;
            $contact = $this->Contacts->newEntity($d);
            $this->Contacts->save($contact);
			$this->Flash->success(__('We have received your query.'));
			unset($this->request->data);
		} else {
			$user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
			$this->set('user', $user);
		}
    }
    public function services(){
		
        
    }
    public function promotionthanks(){
		$thankscontent = "Thankyou! Your hotel's promotion has been successfully submitted.";
        $this->set(compact("thankscontent"));  
    }
	
	
	
	public function _getHotelCategoriesArray() {
        return array("1"=>"Corporate Hotel", "2"=>"Boutique Hotel", "3"=>"Heritage Hotel", "4"=>"House Boat", "5"=>"Resort", "6"=>"Eco Resort", "7"=>"Farm-stay", "8"=>"Homestay", "9"=>"Heritage Homestay", "10"=>"Camping", "11"=>"Glamping","12"=>"Dormitory");
    }
    public function _getTranspoartRequirmentsArray() {
	return array("1"=>"Luxury Car", "2"=>"Sedan", "3"=>"Innova/ Tavera", "4"=>"Tempo Traveller", "5"=>"AC Coach", "6"=>"Non AC Bus");
	}
	public function _getMealPlansArray() {
	return array("0"=>"Select Meal Plan","1"=>"EP - European Plan", "2"=>"CP - Contenental Plan", "3"=>"MAP - Modified American Plan", "4"=>"AP - American Plan");
	}
    public function _getHotelCategoriesArray1() {
        return array("1"=>"Corporate Hotel", "2"=>"Boutique Hotel", "3"=>"Heritage Hotel", "4"=>"House Boat", "5"=>"Resort", "6"=>"Eco Resort", "7"=>"Farm-stay", "8"=>"Homestay", "9"=>"Heritage Homestay", "10"=>"Camping", "11"=>"Glamping","12"=>"Dormitory");
    }
    public function promotions(){
    	$this->loadModel('Countries');
    	$this->loadModel('Users');
		$this->loadModel('States');
      $this->loadModel('Cities');
      $cities = $this->Cities->getAllCities();
		$states = $this->States->getAllStates();
		$allstates = array();
		$allstatesList = array();
		/* if(!empty($states)) {
			foreach($states as $state) {
				$allstates[] = array("label"=>str_replace("'", "", $state['state_name']), "value"=>$state['id']);
				$allstatesList[$state['id']] = $state['state_name'];
			}
		}*/
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

    function checkcityslot($city_id){
    	 $this->loadModel('Promotion');
		 $advertisementcount = $this->Promotion->find()->where(['status' => 1,'FIND_IN_SET(\''.  $city_id .'\',cities)'])->all();
		 $advertisementcount = $advertisementcount->count();
		 return $advertisementcount;
    }
  
    public function pagesapi($id){
     $pagedata = $this->Pages->find()->where(['id' => $id,'is_mobile'=>1])->first();
     $data = array();
     $data['id'] = $pagedata['id'];
     $data['title'] = $pagedata['title'];
     $data['description'] = $pagedata['description'];
     $pagedatajson = json_encode($data);
     echo $pagedatajson;
     exit;
    }
	public function promotepageapi($id){
     $pagedata = $this->Pages->find()->where(['category_id' => $id])->all();
    /* $data = array();
     $data['id'] = $pagedata['id'];
     $data['title'] = $pagedata['title'];
     $data['description'] = $pagedata['description'];*/
     $pagedatajson = json_encode($pagedata);
     echo $pagedatajson;
     exit;
    }
	public function benifitsapi()
    {
    	if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
    	$conn = ConnectionManager::get('default');
		$sql = "SELECT * FROM pages WHERE id in ('2','3','4','5','6','7') ";
		$stmt = $conn->execute($sql);
		$benifits = $stmt ->fetchAll('assoc');
		$benifitsdatajson = json_encode($benifits);
    	echo $benifitsdatajson;    	
    	}else{
    	$benifits['response_code']= 403;
    	echo json_encode($benifits);
    	}
     	exit;   
    }
	
    public function settingapi(){
	  $settingdata = $this->Setting->find()->all();
     $settingdatajson = json_encode($settingdata);
     echo $settingdatajson;
     exit;
    }
	
	public function masterCountry()
	{
		//--- LOAD TABLE
		$this->loadModel('Countries');
		$this->loadModel('States');
		$this->loadModel('Cities');
		//-- Array
		$result  = array();
		$response  = array();
		//-- Country DATA
		$countryapi = $this->Countries->find()->all();
		//-- State DATA
		$statesapi = $this->States->find()->where(['country_id' => '101'])->all();
		//-- City DATA
		$citiesapi = $this->Cities->find()->all();
		$totcount = count($citiesapi);
		$i =1;
		foreach($citiesapi as $cityapi){
			$statename = $this->statename($cityapi->state_id);
			$data['name'] = $cityapi->name.' ('.$statename . ')' ;
			$data['stateid'] =   $cityapi->state_id;
			$data['cityid'] =  $cityapi->id;
			
			$datacitystate['citystatefi'][$i] =  $data;
			$i++; 
		}
 		$result['response_code']=200;
		$response['countryData'] = $countryapi;
		$response['stateData'] = $statesapi;
 		$response['cityData'] = $datacitystate;
		$result['TotalRecord']=$totcount;
		$result['response']=$response;
		$result = json_encode($result);
		echo $result;
		exit;
	}
	
    public function countryapi(){
      $this->loadModel('Countries');
      $countryapi = $this->Countries->find()->all();
    	$result  = array();
    	if($countryapi){
    	$result['response_code']=200;
    	}
    	$i=0;
      $result['ResponseObject'] = $countryapi;
      $result = json_encode($result);
      echo $result;
      exit;
    }
    public function stateapi(){
      $this->loadModel('States');
      $statesapi = $this->States->find()->where(['country_id' => '101'])->all();
    	$result  = array();
    	if($statesapi){
    	$result['response_code']=200;
    	}
      $result['ResponseObject'] = $statesapi;
      $result = json_encode($result);
      echo $result;
      exit;
    }
    public function citiesapi(){
		$this->loadModel('Cities');
		$citiesapi = $this->Cities->find()->all();
		$totcount = count($citiesapi);
		$i =1;
		foreach($citiesapi as $cityapi){
		$statename = $this->statename($cityapi->state_id);
		$data['name'] = $cityapi->name.' ('.$statename . ')' ;
		$data['stateid'] =   $cityapi->state_id;
		$data['cityid'] =  $cityapi->id;
		$datacitystate['citystatefi'][$i] =  $data;
		$i++; }
		$result  = array();

		$result['response_code']=200;
		$result['TotalRecord'] = $totcount;
		$result['ResponseObject'] = $datacitystate;

		$result = json_encode($result);
		echo $result;
		exit;
    }
	 

  public function promotionscityapi(){
    	$this->loadModel('Countries');
    	$this->loadModel('Users');
		$this->loadModel('States');
      $this->loadModel('Cities');
      $cities = $this->Cities->getAllCities();
		$states = $this->States->getAllStates();
		$allstates = array();
		$allstatesList = array();
		if(!empty($states)) {
			foreach($states as $state) {
				$allstates[] = array("label"=>str_replace("'", "", $state['state_name']), "value"=>$state['id']);
				$allstatesList[$state['id']] = $state['state_name'];
			}
		}
		$allStates = json_encode($allstates);
		$allCities = array();
		$allCityList = array();
		if(!empty($cities)) {
			foreach($cities as $city) {
				if($this->checkcityslot($city['id']) < 50 && $city['state_id']==$_POST['state_id']){
				$usercount = $this->Users->getAllUserCount($city['id']);
				if($usercount > 0) {
				$allCities[] = array("label"=>str_replace("'", "", $city['name']),"usercount" => $usercount, "value"=>$city['id'],"price"=>$city['price'], "state_id"=>$city['state_id'], "state_name"=>$city['state']->state_name, "country_id"=>101, "country_name"=>"India");
			}
			$allCityList[$city['id']] = $city['name'];
			}
			}
		}
		$result['response_code']=200;
    	$i=0;
      $result['ResponseObject'] = $allCities;
      $result = json_encode($result);
      echo $result;
      exit;
    }
	
public function getActivationKey($mobileNo) {
		if(empty($mobileNo)) {
			$mobileNo = 1234567890;
		}
		return md5(md5($mobileNo));
	}
public function registerapi(){
 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
$result  = array();

$this->loadModel('Credits');
$this->loadModel('Countries');
$this->loadModel('States');
$this->loadModel('Cities');
$this->loadModel('Membership');
if($_POST) {
$d = $_POST;
$checkUsers = $this->Users->find()->where(['email' => $d['email']])->count();
if ($checkUsers < 1) {
if(isset($_POST['device_id'])){
	$d['device_id'] = $_POST['device_id'];
}
$d['email_verified'] = 0;
$d['mobile_verified'] = 0;
$d['reset_password_token'] = 0;
$d['verification_token'] = 0;
$d['mobile_otp'] = rand('1010', '9999');
$d['status'] = 0;
$d['create_at'] = date("Y-m-d H:i:s");
if(isset($_POST['image'])){
$d['image']=$_POST['image'];
$file = $d['image'];
$path = WWW_ROOT . "userimages" . DS . $file['name'];
move_uploaded_file($file['tmp_name'], $path);
$d['image'] = $file['name'];
}

if(isset($_POST["preference"]) && !empty($_POST["preference"])) {
$d["preference"] = $this->request->data["preference"];
}
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
$subject="TravelB2Bhub Email Verification";
$to=$d['email'];
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: TravelB2Bhub <contactus@travelb2bhub.com>' . "\r\n";
$theKey = $this->getActivationKey($d["mobile_number"]);
$message='<p>Dear '.$d['first_name'].', </p>';
$message.='<p>Thank you for registering with TravelB2Bhub.com, the  COMMISSION FREE, Business to Business, tourism trading network. </p>';
$message.='<p>Please verify your email address by <span style="color:1E707E;"><a href="http://www.konciergesolutions.com/users/userVerification?ident='.$userId.'&activate='.$theKey.'">clicking here</a></span>. </p>';
$message.='<p>We are committed to enhance your trading experience!</p>';
$message.='<p>Sincerely,<br>The TravelB2Bhub Team</p>';
// Mail it
	$email = new Email();    
    $email->transport('gmail')
            ->from(['contactus@travelb2bhub.com'=>'TravelB2Bhub'])
            ->to($to)
            ->subject($subject)
             ->emailFormat('html')
            ->viewVars(array('msg' => $message))
            ->send($message);
//@mail($to, $subject, $message, $headers);
$uid = $res->id;
$c['credit'] = 60;
$c['user_Id'] = $uid;
$creditd = $this->Credits->newEntity($c);
$this->Credits->save($creditd);
                   $result['response_code'] = 200;
                          $result['msg'] = 'Thank you for registering with Travelb2bhub.com! Please activate your account by clicking on the link sent to your e-mail address.';
                } else {
                    $result['response_code'] = 406;
                    $result['msg'] = 'The user could not be saved. Please, try again.';
                }
            } else {
               $result['response_code'] =  501;
               $result['msg'] = 'Email ID already exists. Please enter another Email ID to register.';
            }
        }
      $data =  json_encode($result);
      echo $data;
    exit;
} else {
    echo "Invalid Access";   
exit;
    }
    }
    
	public function forgotPasswordapi() {
		//Configure::write('debug',2);
		 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
		if ($this->request->is('post')) {
			$d = $this->request->data;
			$user = $this->Users
				->find()
				->where(['email' =>$d['email']])
				->first();
					$result = array();
			if (!empty($user)) {
					$usernumber = $user["mobile_number"].''.$user["id"];
					$theKey = sha1($usernumber);
					//$theKey = $this->getActivationKey($user["mobile_number"]);
					$userId = $user["id"];
					$tablename = TableRegistry::get("Users");
					$query = $tablename->query();
					$res = $query->update()
					->set(['activation' => $theKey])
					->where(['id' => $userId])
					->execute();
					$subject="TravelB2Bhub Reset Password";
					$to = $user["email"];
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= 'From: TravelB2Bhub <contactus@travelb2bhub.com>' . "\r\n";

					$message='<p>Dear '.$user['first_name'].'</p>';
					$message.="<p>Reset your password, and we'll get you on your way.</p>";
					$message.='<p>To change your TravelB2Bhub password, click the following link into your browser:
					<a href="https://www.travelb2bhub.com/users/activatePassword?ident='.$userId.'&activate='.$theKey.'">click here</a></p>';
					$message.='<p>Sincerely,<br>The TravelB2Bhub Team</p>';
					// Mail it
					$email = new Email();    
    $email->transport('gmail')
            ->from(['contactus@travelb2bhub.com'=>'TravelB2Bhub'])
            ->to($to)
            ->subject($subject)
             ->emailFormat('html')
            ->viewVars(array('msg' => $message))
            ->send($message);
				//	@mail($to, $subject, $message, $headers);
					$result = array();
					$result['response_code'] = 200;
					$result['msg'] = "Please check your email to reset your password";
					$data =  json_encode($result);
      			echo $data;
					exit;
			} else {
				$result['msg'] = "Incorrect Email.";
				$result['response_code'] = 501;
				$data =  json_encode($result);
      		echo $data;
				exit;
			}
		}
		}else{
		$result['response_code']= 403;
     	echo json_encode($result);
     	exit;
		}
	}
	
    public function changepasswordapi() {
		 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
		  $this->loadModel('Requests');
        $this->loadModel('Responses');
       	$user = $this->Users->find()->where(['id' => $this->request->data['user_id']])->first();
			$this->set('users', $user);
			$result1 = array();
        if(!empty($user)) {
			if ($this->request->is('post')) {
				$verify = (new \Cake\Auth\DefaultPasswordHasher)->check($this->request->data['old_password'], $user->password);
				if($verify) {
					$result = $this->Users->patchEntity($user, ['password' => $this->request->data['password']]);
					if ($this->Users->save($result)) {
						$result1['msg'] = 'Your password has been changed successfully.';
						$result1['response_code'] = 200;
					//	$data =  json_encode($result1);
      				//echo $data;
					//	exit;		
					}
				} else {
					//echo "not mached"; exit;
					$result1['response_code'] = 501;
					$result1['msg'] = 'Current Password does not matched.';
					//	$data =  json_encode($result1);
      			//	echo $data;
					//	exit;
				}
			}

			$myRequestCount = $myReponseCount = 0;
			$myfinalCount  = 0;
			$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $user['id'], "Requests.is_deleted"=>0,"Requests.status "=>2]]);
			$myfinalCount = $query3 ->count();
			$this->set('myfinalCount', $myfinalCount );
			$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $user['id'], "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
			$myRequestCount = $query->count();
			$myRequestCount1 = $query->count(); 
			$delcount=0;
			$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $user['id'], "Requests.is_deleted"=>1]]);
			foreach($requests as $req){
			$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
			if($rqueryr->count()!=0){
			$delcount++;
			}
			}
			if($myRequestCount > $delcount) {
			$myRequestCount = $myRequestCount-$delcount;
			}	
			$result1['myRequestCountdel'] = $delcount;
			$result1['myRequestCount'] = $myRequestCount1;
			$queryr = $this->Responses->find('all', ['Responses.status' =>0,'Responses.is_deleted' =>0,'conditions' => ['Responses.user_id' => $user['id']]]);
			$myReponseCount = $queryr->count();
			$result1['myReponseCount'] = $myReponseCount;
			$data =  json_encode($result1);
      	echo $data;
			exit;
		} else {
			$result['response_code'] = 501;
			$result['msg'] = 'Please login to access this location.';
			$result['response_code']= 403;
     echo json_encode($result);
     exit;
		}
		}else{
		$result['response_code']= 403;
     	echo json_encode($result);
     	exit;
		}
    }
	
     public function loginapi() {
     	if ($this->Auth->user('id')) {
   		$result['response_code']= 403;
    	 }
		 
    	 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
    	 	
        if ($this->request->is('post') || $this->request->query('provider')) {
           $user = $this->Auth->identify();
           $result = array();
           if ($user) {
           $conn = ConnectionManager::get('default');
           
           $_SESSION['token']=sha1($user['email']);
           $result['response_code'] = 200;
			  $result['msg'] = 'success';
			  $user['access_token'] = $_SESSION['token'];
           $result['response_object'] = $user;
           date_default_timezone_set('Asia/Kolkata');
			$logintime = date("Y-m-d h:i:s");   
           if(isset($_POST['device_id'])){
           $upsql = "UPDATE users set device_id='".$_POST['device_id']."',last_login='".$logintime."' where id='".$user['id']."'";
           $stmt = $conn->execute($upsql);
           }
                   
			  $sql = "SELECT u.profile_pic as author_profile_pic,t.* FROM testimonial as t INNER JOIN users as u on u.id=t.author_id	WHERE t.user_id='".$user['id']."' ";
			  $stmt = $conn->execute($sql);
			  $testimonials = $stmt ->fetchAll('assoc');
			  $testimonialcount = count($testimonials);
		     $result['testimonialcount'] = $testimonialcount;
		    if($testimonialcount>=1)
				{
		 		$result['testimonials']=$testimonials;
		 		$query ="SELECT AVG(rating) AS average_rating FROM testimonial WHERE user_id='".$user['id']."'";
		 		$stmt = $conn->execute($query);
			  	$average_rating = $stmt ->fetch('assoc');
			  	$result['average_rating']=$average_rating['average_rating'];
				}else{
				$result['testimonials']=[];
				$result['average_rating']=0;
				}
				
           $data =  json_encode($result);
           echo $data;
           exit;
            } else {
           $result['response_code'] = 501;
			  $result['msg'] = 'failed';
			  $data =  json_encode($result);
           echo $data;
           exit;
            }
        }
     }else{
     $result['response_code']= 403;
     echo json_encode($result);
     exit;
     }   
    }
	public function logoutapi() {
		if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
			$this->loadModel('Users');
			$userid = $_POST['user_id'];
			$this->Users->updateAll(array('device_id'=>0), array('id'=>$userid));
			/* $conn = ConnectionManager::get('default');
			$upsql = "UPDATE users set device_id='' where id='".$userid."'";
			$stmt = $conn->execute($upsql); */
			$result = array();
			$result['response_code'] = 200;
			$result['msg'] = 'success';
			$data =  json_encode($result);
			echo $data;
			exit;
		}
		else
		{
			$result = array();
			$result['response_code']= 403;
			echo json_encode($result);
			exit;
		}
	}
	
    public function blockeduserlistapi() {
    	 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
    		$result = array();
        $this->loadModel('Responses');
        $this->loadModel('Hotels');
        $this->loadModel('Requests');
        $this->loadModel('Cities');
		  $this->loadModel('BlockedUsers');
        $user = $this->Users->find()->where(['id' => $_POST['user_id']])->first();
        $this->set('users', $user);
		  $blockedUsers = $this->BlockedUsers->find()
						->contain(["Users"])
						->where(['BlockedUsers.blocked_by' => $_POST['user_id']])->order(["BlockedUsers.id" => "DESC"])->all();
						if($blockedUsers){
		$result['response_code'] = 200;
     	$result['response_object'] = $blockedUsers;
     }
     else {
     $result['response_code'] = 501;
     }
      $data =  json_encode($result);
           echo $data;
           exit;
      }else{
      $result = array();
      $result['response_code']= 403;
    	echo json_encode($result);
     	exit;
        }
    }
	
    public function profileeditapi() {
    	 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
    	$result = array();
		$this->loadModel("UserRatings");
		$this->loadModel("TravelCertificates");
		$this->loadModel('States');
		$this->loadModel('Cities');
		$this->loadModel('Requests');
      $this->loadModel('Responses');
      	$result['response_code'] = 200;
      $user = $this->Users->find()->where(['id' => $_POST['user_id']])->first();
		$result['user'] = $user;
        if(!empty($user)) {
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
//$allCities[] = array("label"=>str_replace("'", "", $city['name']), "value"=>$city['id'], "state_id"=>$city['state_id'], "state_name"=>$city['state']->state_name, "country_id"=>101, "country_name"=>"India");
$allCities[] = array("label"=>str_replace("'", "", $city['name'].' ('.$city['state']->state_name. ')'), "value"=>$city['id'], "state_id"=>$city['state_id'], "state_name"=>$city['state']->state_name, "country_id"=>101, "country_name"=>"India");
	$allCityList[$city['id']] = str_replace("'", "", $city['name'].' ('.$city['state']->state_name. ')');
}
}
			$result['states'] = $states;
			$result['cities'] = $allCities;
			$data =  json_encode($result);
            echo $data;
           exit;
			
		} else {
			$result['response_code'] = 500;
			 echo $result;
           exit;
		}
			}else{
			$result = array();
      	$result['response_code']= 403;
    		echo json_encode($result);
     		exit;
			}
    }
		public function myresponselistapi() {
		 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
		$result = array();
		$this->loadModel('BusinessBuddies');
      $this->loadModel('Responses');
      $this->loadModel('Requests');
      $this->loadModel('Cities');
       $this->loadModel('Testimonial');
       
			$sort='';
			if(!isset($_POST["sort"])) {
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
			if(!empty($_POST["sort"]) && $_POST["sort"]=="agentaz") {
			$sort['Users.first_name'] = "ASC";
			$sort['Users.last_name'] = "ASC";
			}
			if(!empty($_POST["sort"]) && $_POST["sort"]=="agentza") {
			$sort['Users.first_name'] = "DESC";
			$sort['Users.last_name'] = "DESC";
			}       
       
        $conditions ='';
   if(!empty($_POST["budgetsearch"])) {
			$QPriceRange = $_POST["budgetsearch"];
			$result = explode("-", $QPriceRange);
			$MinQuotePrice = $result[0];
			$MaxQuotePrice = $result[1];
			$conditions["Requests.total_budget >="] = $MinQuotePrice;
			$conditions["Requests.total_budget <="] = $MaxQuotePrice;
		}

if(!empty($_POST["agentnamesearch"])){
$keyword1 = '';
$keyword2 = '';
$keyword = trim($_POST["agentnamesearch"]);
$keyword = explode(' ',$keyword);
if(isset($keyword[1])) {
$keyword2 = $keyword[1];
}
$conditions["OR"] = array("Users.first_name LIKE "=>"%". $keyword[0]."%", "Users.last_name LIKE" => "%".$keyword[0]."%",);
}			


	if(!empty($_POST["req_typesearch"])) {
		$conditions["Requests.category_id"] =  $_POST["req_typesearch"];
		}
	
	if(!empty( $_POST["refidsearch"])) {
		$conditions["Requests.reference_id"] =  $_POST["refidsearch"]; 
}

if(!empty($_POST["destination_city"])) {
$conditions["Requests.city_id"] =  $_POST["destination_city"];
}
if(!empty($_POST["pickup_city"])) {
$conditions["Requests.pickup_city"] =  $_POST["pickup_city"];
}

if(!empty($_POST["chatwith"])){
$chatuserid = $_POST["chatwith"];
$conditions["Requests.user_id"] = $chatuserid;
}
if(!empty($_POST["shared_details"])) {
$conditions["Responses.is_details_shared"] =  $_POST["shared_details"];
}
if(isset($_POST["members"]) && !empty($_POST["members"])) {
		$conditions["Requests.children+Requests.adult"] =  $_POST["members"];
		}

		if(isset($_POST["startdatesearch"])) {
			$sdate = $_POST["startdatesearch"];
			}
		if(isset($sdate) && !empty($sdate)){
		$date = str_replace('/', '-', $sdate);
		$sdate = date('Y-m-d', strtotime($date));
		}
		
		if(!empty($_POST["startdatesearch"])) {	
         $da["Requests.start_date"] =  $sdate;
         $da["Requests.check_in"] =  $sdate;
			$conditions["OR"] =  $da;
		}
		
		if(isset($_POST["enddatesearch"])) {
			$edate = $_POST["enddatesearch"];
			}
			if(isset($edate) && !empty($edate)){
		$date = str_replace('/', '-', $edate);
		$edate = date('Y-m-d', strtotime($date));
		}
		 
			
		if(!empty($_POST["enddatesearch"])) {
			$da1["Requests.end_date"] =  $edate;
            	$da1["Requests.check_out"] =  $edate;
			if(!empty($sdate)){
				$da1["Requests.start_date"] =  $sdate;
            	$da1["Requests.check_in"] =  $sdate;
				}
			$conditions["OR"] =  $da1;
		}

$conditions["Responses.is_deleted"] = 0;
$conditions["Responses.status"] = 0;
$conditions["Requests.status"] = 0;
      $responses = $this->Responses->find()
                     ->contain(["Requests.Users", "UserChats","Requests.Hotels"])
                     ->where(['Responses.user_id' => $_POST['user_id'],$conditions])->order($sort)->all();
                     $citystate = array();
	$conn = ConnectionManager::get('default');
	$enddatearray=array();
	$chatcount_data = array();
 if(count($responses) >0) {		 
                     foreach($responses as $cit)
                     {
						 $loggedinid = $cit['user_id'];
						$user_id = $cit['request']['user_id'];
$request_id = $cit['request_id'];
						$sqlc = "SELECT *,COUNT(*) as ch_count FROM user_chats 
	WHERE request_id='".$request_id."' AND (user_id in ('".$loggedinid."','".$user_id."') 
	AND notification='0' AND send_to_user_id in ('".$loggedinid."','".$user_id."')) ";
						 $stmtc = $conn->execute($sqlc);
	$resultsc = $stmtc->fetch('assoc');
	$chatcount_data[$cit['id']] =$resultsc['ch_count'];
                     
						 if($cit['request']['category_id']==2)
						 {
						 $cityname = $this->cityname($cit['request']['pickup_city']);
						 }else{
						 $cityname = $this->cityname($cit['request']['city_id']);
						 }	 
                     
						 if($cit['request']['category_id']==2)
						 {
						 $statename = $this->statename($cit['request']['pickup_state']);
						 }else{
						$statename = $this->statename($cit['request']['state_id']);
						 }
                     $comma = '';
                     if($statename!=""){
                     $comma = ',';
                     }
                     $citystatefull = $cityname.' ('. $statename.')';
							
							$city_state_name = "";
							if(count($cit['request']['hotels']) >0) {
								unset($cit['request']['hotels'][0]);
                    foreach($cit['request']['hotels'] as $row) { 
                     $city_state_name.=', '.$this->cityname($row['city_id']).' ('.$this->statename($row['state_id']).')'; 
                  	 }  }                       
                   
                     $citystate[$cit['id']]  = $citystatefull.''.$city_state_name;
                     $citystate[$cit['id']]  = $citystatefull.''.$city_state_name;
						 
						 
						if($cit['request']['category_id']==1){
			$sql = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$cit['request']['id']."'";
                                 $stmt = $conn->execute($sql);
                                 $resulth = $stmt->fetch('assoc');
					$end_data =  date('Y-m-d', strtotime($cit['request']['end_date']));
				if(!empty($resulth['TopDate'])){
					if($result['TopDate']>$end_data){
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($resulth['TopDate']));
		}else{
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($cit['request']['end_date']));	
		}
					}else{
					if($cit['check_out']>$end_data){
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($cit['request']['check_out']));
		}else{
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($cit['request']['end_date']));	
		}
					}
				}elseif($cit['request']['category_id'] == 2 ) {
			$enddatearray[$cit['id']] = date('Y-m-d', strtotime($cit['request']['end_date']));
				}elseif($cit['request']['category_id'] == 3 ) {
			$enddatearray[$cit['id']] = date('Y-m-d', strtotime($cit['request']['check_out']));
					} 
						 
                     }
}
			 
        $rating = array();
			 $blockeddata = array();
			 $reqidarray = array();
$chatusers = array();
 if(count($responses) >0) {
        foreach($responses as $req){
        		$query = $this->Testimonial->find();
				$userRating = $query->select(["average_rating" => $query->func()->avg("rating")])
				->where(['author_id' => $req['request']['user_id']])
				->order(["id" => "DESC"]);
				  $rating['rating'][$req['id']]  = $userRating;
			$sql1="Select count(*) as block_count from blocked_users where blocked_user_id='".$req['user_id']."' AND blocked_by='".$req['request']['user_id']."'";
$stmt = $conn->execute($sql1);
$bresult = $stmt ->fetch('assoc');
if($bresult['block_count']>0){
$blockeddata['blockedUser'][$req['id']] =1;
}else{
$blockeddata['blockedUser'][$req['id']] =0;
}
	$reqidarray[] =$req['request']['user_id'];		
        }
			
		$un_req_array = array_unique($reqidarray);
		$str_reqid =  implode(",",$un_req_array);
		
		$sql = "SELECT u.id,u.first_name,u.last_name FROM users as u 
		INNER JOIN requests as rs on rs.user_id=u.id
		WHERE rs.user_id !='".$_POST['user_id']."' and u.id in($str_reqid) GROUP BY rs.user_id ";
		$stmt = $conn->execute($sql);
		$chatusers = $stmt->fetchAll('assoc');
}
		
		$sql = "select s.state_name,c.id as city_id,c.name as city_name from cities as c 
					INNER JOIN states as s on s.id=c.state_id
					INNER JOIN requests as r on r.city_id=c.id
					INNER JOIN requests as re on re.pickup_city=c.id
					group by c.id order by c.name asc ";
		$stmt = $conn->execute($sql);
		$allCities = $stmt->fetchAll('assoc');
		$BusinessBuddies = $this->BusinessBuddies->find('list',['keyField' => "bb_user_id",'valueField' => 'bb_user_id'])
		->hydrate(false)
		->where(['user_id' => $_POST['user_id']])
		->toArray();
        
        if($responses){
        $result['response_code'] = 200;
        $result['response_object'] = $responses;
        $result['BusinessBuddies'] = $BusinessBuddies;
         $result['rating'] = $rating;
			$result['chat_count'] = $chatcount_data;
			$result['end_date'] = $enddatearray;
         $result['citystate'] = $citystate;
			$result['blockedata'] = $blockeddata;
			
         $result['cities_list'] = $allCities;
        $result['user_chats'] = $chatusers;
        $data = json_encode($result);
        echo $data;
        exit;
     } else {
      $result['response_code'] = 501;
      $data = json_encode($result);
        echo $data;
        exit;
     }
  }else{
  			$result = array();
      	$result['response_code']= 403;
    		echo json_encode($result);
     		exit;
  		}
		}
		
	public function cityname($id){
	$this->loadModel('Cities');
	$city = $this->Cities->find()->where(['id' => $id])->first();
	return  $city['name'];
	}
	public function statename($id){
	$this->loadModel('States');
	$state = $this->States->find()->where(['id' => $id])->first();
	return  $state['state_name'];
	}
	 
   public function viewdetailsapi() {
    		 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
    		$result = array();
        	$this->loadModel('Requests');
        	$this->loadModel('Cities');
			$this->loadModel('States');
			$this->loadModel('Countries');
			$this->loadModel('Responses');
      	$details = $this->Requests->find()
                        ->contain(["Users", "UserRatings", "Hotels", "RequestStops"])
                        ->where(['Requests.id' => $_POST['request_id']])->first();
						
							$citystate = array();
							$mealPlans = $this->_getMealPlansArray(); 
							$hotelCategories = $this->_getHotelCategoriesArray();
				 			$transpoartRequirments = $this->_getTranspoartRequirmentsArray();
							$hotelcitystate = array();
							$mealPlanArray = array();
							$hotelcategoryArray = array();
				 $transport_name =  "-- --";
				 			$transportArray = array();
							if($details['category_id']==2){
								if(!empty($details['transport_requirement'])) {
              	$transport_name = $transpoartRequirments[$details['transport_requirement']];
						}else {
				$transport_name  = "-- --";	
						}
							
							$cityname = $this->cityname($details['pickup_city']);
							$statename = $this->statename($details['pickup_state']);
							}else{
							$cityname = $this->cityname($details['city_id']);
							$statename = $this->statename($details['state_id']);
							}
							
                     
                     $comma = '';
                     if($statename!=""){
                     $comma = ',';
                     }
                     $citystatefull = $cityname.$comma.' '.$statename;
                     
                     $city_state_name = "";
                     $mealPlanname = '';
							if(count($details['hotels']) >0) {
							//	unset($details['hotels'][0]);
							
                    foreach($details['hotels'] as $row) { 
                     $city_state_name = $this->cityname($row['city_id']).' ('.$this->statename($row['state_id']).')'; 
$hotelcitystate[$row['id']]  = $city_state_name;
						if(!empty($row['meal_plan'])) {
              	$mealPlanname = $mealPlans[$row['meal_plan']];
						}else {
				$mealPlanname  = "-- --";	
						}
              	$mealPlanArray[$row['id']]  = $mealPlanname;
              	if(!empty($row['hotel_category'])) {
					$resulth = explode(",", $row['hotel_category']);
					$count = 1;
					$hotel_category = "";
					foreach($resulth as $row1) {
					$hotel_category .= "".$hotelCategories[$row1]." or ";
					$count++;
					}
				$hotelcategoryArray[$row['id']]  = substr($hotel_category, 0, -3);
					} else {
				$hotelcategoryArray[$row['id']]  = "-- --";	
						}
                  	 }  
                  	 }
                  	               
                     
               $citystate['citystate'][$details['id']]  = $citystatefull;
				 $transportArray[$details['id']]  = $transport_name;
              $allStates = $this->States->find('list',['keyField' => 'id', 'valueField' => 'state_name'])->where(['country_id' => 101])
->hydrate(false)
->toArray();        
                      $conn = ConnectionManager::get('default');
			$sql = "select s.state_name,c.id as city_id,c.name as city_name from cities as c 
					INNER JOIN states as s on s.id=c.state_id
					INNER JOIN requests as r on r.city_id=c.id
					INNER JOIN requests as re on re.pickup_city=c.id
					group by c.id order by c.name asc ";
		$stmt = $conn->execute($sql);
		$allCities = $stmt ->fetchAll('assoc');
                     			
			
			$result['response_code'] = 200;
			$result['response_object'] = $details;
			$result['cities_list'] = $allCities;
			$result['states_list'] = $allStates;
        $result['citystate'] = $citystate;
				 $result['transport'] = $transportArray;
         $result['hotelcitystate'] = $hotelcitystate;
         $result['mealPlans'] = $mealPlanArray;
         $result['hotelcategory'] = $hotelcategoryArray;
         
    		$data =   json_encode($result);
         echo $data;
         exit;
         }else{
			$result = array();
      	$result['response_code']= 403;
    		echo json_encode($result);
     		exit;
			}
    }

	 public function removerequestapi(){
	 	 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
	   $this->loadModel('Requests');
		$this->loadModel('Responses');
		$res = 1;
		if(isset($_POST["request_id"]) && !empty($_POST["request_id"]) && !empty($_POST['user_id'])) {
			$TableRequest = TableRegistry::get('Requests');
			$request = $TableRequest->get($_POST["request_id"]);
			$request->is_deleted = 1;
			if($TableRequest->save($request)) {
				$res = 1;
				$TableResponse = TableRegistry::get("Responses");
				$query = $TableResponse->query();
			$results = $query->update()
			->set(['is_deleted' => '1'])
			->where(['request_id' => $_POST["request_id"]])
			->execute();
			}
		}
		   $result['response_code'] = 200;
			$result['response_object'] = $res;
    		$data = json_encode($result);
         echo $data;
         exit;
      }else{
		$result = array();
      $result['response_code']= 403;
    	echo json_encode($result);
     	exit;
		}
	 }
	public function userchatapi() {
	 	 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
			 $conn = ConnectionManager::get('default');
	 	date_default_timezone_set('Asia/Kolkata');
		$this->loadModel('UserChats');
		$this->UserChats->updateAll(['is_read' => 1, "read_date_time"=>date("Y-m-d h:i:s")], ['request_id ' => $_POST['request_id']]);
     
			 $sql= "SELECT first_name,last_name FROM users where id='".$_POST['chatuserid']."'";
			 $stmt1 = $conn->execute($sql);
			 $results1 = $stmt1->fetch('assoc');
			 $UserChats = $this->UserChats->find()
                        ->contain(["Users"])
                        ->where(["UserChats.request_id"=>$_POST['request_id'],"UserChats.notification"=>0, 'UserChats.user_id IN' => array($_POST['user_id'], $_POST['chatuserid']),'UserChats.send_to_user_id IN' => array($_POST['user_id'], $_POST['chatuserid'])])->order(["UserChats.id" => "ASC"])->all()->toArray();
			$result['response_code'] = 200;
			$result['response_object'] = $UserChats;
			$result['chat_user_name'] = $results1['first_name'].' '.$results1['last_name'];
    		$data =   json_encode($result);
         echo $data;
         exit;
         }else{
		$result = array();
      $result['response_code']= 403;
    	echo json_encode($result);
     	exit;
		}
    }

    public function blockuserapi() {
    	 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
      $this->loadModel('BlockedUsers');
		$res = 0;
		if(isset($_POST["blockuser_id"]) && !empty($_POST["blockuser_id"]) && !empty($_POST['user_id'])) {
			$d["blocked_user_id"] = $_POST["blockuser_id"];
			$d["blocked_by"] = $_POST['user_id'];
			$d["created"] = date("Y-m-d G:i:s");
			$checkBlockedUsers = $this->BlockedUsers->find()->where(['blocked_user_id' => $d['blocked_user_id'],'blocked_by' => $d['blocked_by']])->count();			
			if($checkBlockedUsers >=1) {
			$res = 2;
			}else{
			$BlockUser = $this->BlockedUsers->newEntity($d);
			if($this->BlockedUsers->save($BlockUser)){
				$res = 1;
			}else{
				$res = 0;
			}
				}
			}
			$result['response_code'] = 200;
			$result['response_object'] = $res;
         $data = json_encode($result);
         echo $data;
         exit;
      }else{
		$result = array();
      $result['response_code']= 403;
    	echo json_encode($result);
     	exit;
		}
    }

    
    public function myfinalresponsesapi() {
    	if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
        $this->loadModel('Responses');
        $this->loadModel('Requests');
        $this->loadModel('Cities');
		  $this->loadModel('States');
		 
		 /**Sorting ---------**/
			
			$sort='';
if(empty($_POST["sort"])) {
	$sort['Responses.id'] = "DESC";
}
if(!empty($_POST["sort"]) && $_POST["sort"]=="totalbudgetlh") {
$sort['Requests.total_budget'] = "ASC";
}
if(!empty($_POST["sort"]) && $_POST["sort"]=="totalbudgethl") {
$sort['Requests.total_budget'] = "DESC";
}
if(!empty($_POST["sort"]) && $_POST["sort"]=="quotationlh") {
$sort['Responses.quotation_price'] = "ASC";
}
if(!empty($_POST["sort"]) && $_POST["sort"]=="quotationhl") {
$sort['Responses.quotation_price'] = "DESC";
}
if(!empty($_POST["sort"]) && $_POST["sort"]=="agentaz") {
$sort['Users.first_name'] = "ASC";
$sort['Users.last_name'] = "ASC";
}
if(!empty($_POST["sort"]) && $_POST["sort"]=="agentza") {
$sort['Users.first_name'] = "DESC";
$sort['Users.last_name'] = "DESC";
}
 
		 /***Sorting --------**/ 
		  
		  
		  $conditions["Responses.user_id"] = $_POST['user_id'];
		  $conditions["Responses.status"] = 1;
if(!empty($_POST["agentnamesearch"])) {
		$keyword1 = '';
		$keyword2 = '';
			$keyword = trim($_POST["agentnamesearch"]);
			$keyword = explode(' ',$keyword);
			if(isset($keyword[1])) {
			$keryword2 = $keyword[1];
			}
			$conditions["OR"] = array("Users.first_name LIKE "=>"%".$keyword[0]."%", "Users.last_name LIKE" => "%$keyword[0]%",);
		}
		
		if(!empty($_POST["quotesearch"])) {
			$QPriceRange = $_POST["quotesearch"];
			$result = explode("-", $QPriceRange);
			$MinQuotePrice = $result[0];
			$MaxQuotePrice = $result[1];
			$conditions["Responses.quotation_price >="] = $MinQuotePrice;
			$conditions["Responses.quotation_price <="] = $MaxQuotePrice;
		}
		//print_r($conditions); die();
		if(!empty($_POST["budgetsearch"])) {
			$QPriceRange = $_POST["budgetsearch"];
			$result = explode("-", $QPriceRange);
			$MinbudgetPrice = $result[0];
			$MaxbudgetPrice = $result[1];
			$conditions["Requests.total_budget >="] = $MinbudgetPrice;
			$conditions["Requests.total_budget <="] = $MaxbudgetPrice;
		}
		//print_r($conditions);	  die();
		if(!empty($_POST["refidsearch"])) {
		$conditions["Requests.reference_id"] =  $_POST["refidsearch"];
		}
		//print_r($conditions);	  die();
        $responses = $this->Responses->find()
                        ->contain(["Requests.Users", "Requests","Requests.Hotels"])
                        ->where($conditions)->order($sort)->all();
                       
        $citystate = array();
			$review_array = array();
			$enddatearray=array();
			 $conn = ConnectionManager::get('default');     
        if($responses->count()>0){
                     foreach($responses as $cit)
                     {
						 $sql = "SELECT * FROM testimonial WHERE request_id='".$cit['request']['id']."' AND author_id='".$_POST['user_id']."' order by created_at DESC";
						$stmt = $conn->execute($sql);
						$reviews = $stmt ->fetch('assoc');
						$review_array[]=$reviews;
                     
						 if($cit['request']['category_id']==2)
						 {
						 $cityname = $this->cityname($cit['request']['pickup_city']);
						 }else{
						 $cityname = $this->cityname($cit['request']['city_id']);
						 }	 
                     
						 if($cit['request']['category_id']==2)
						 {
						 $statename = $this->statename($cit['request']['pickup_state']);
						 }else{
						$statename = $this->statename($cit['request']['state_id']);
						 }
                     $comma = '';
                     if($statename!=""){
                     $comma = ',';
                     }
                     //$citystatefull = $cityname.$comma.' '. $statename;
                     $citystatefull = $cityname.' ('. $statename.')';
							
							$city_state_name = "";
							if(count($cit['request']['hotels']) >0) {
								unset($cit['request']['hotels'][0]);
                    foreach($cit['request']['hotels'] as $row) { 
                     $city_state_name.=', '.$this->cityname($row['city_id']).' ('.$this->statename($row['state_id']).')'; 
                  	 }  } 
                     $citystate[$cit['id']]  = $citystatefull.''.$city_state_name;;
                     $citystate[$cit['id']]  = $citystatefull.''.$city_state_name;;
                     
					 if($cit['request']['category_id']==1){
			$sqlh = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$cit['request']['id']."'";
                                 $stmth = $conn->execute($sqlh);
                                 $resulth = $stmth->fetch('assoc');
				$end_data =  date('Y-m-d', strtotime($cit['request']['end_date']));		 
				if(!empty($resulth['TopDate'])){
					if($resulth['TopDate']>$end_data){
					$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($resulth['TopDate']));
					}else{
					$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($cit['request']['end_date']));	
						}
					}else{
					if($cit['request']['check_out']>$end_data){
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($cit['request']['check_out']));
		}else{
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($cit['request']['end_date']));	
		}
					}
				}elseif($cit['request']['category_id'] == 2 ) {
			$enddatearray[$cit['id']] = date('Y-m-d', strtotime($cit['request']['end_date']));
				}elseif($cit['request']['category_id'] == 3 ) {
			$enddatearray[$cit['id']] = date('Y-m-d', strtotime($cit['request']['check_out']));
					}
					 }
                  }
		
       $allCities = array();              
                     $sql = "select s.state_name,c.id as city_id,c.name as city_name from cities as c 
					INNER JOIN states as s on s.id=c.state_id
					INNER JOIN requests as r on r.city_id=c.id
					INNER JOIN requests as re on re.pickup_city=c.id
					group by c.id order by c.name asc ";
		$stmt = $conn->execute($sql);
		$allCities = $stmt ->fetchAll('assoc');       
        
       $result['response_code'] = 200;
		 $result['response_object'] = $responses;
		 $result['citystate'] = $citystate;
			$result['end_date'] = $enddatearray;
			$result['reviews'] = $review_array;
		 $result['cities_list'] = $allCities;
		 $data =   json_encode($result);
       echo $data;
      exit;
   }else{
  	 $result = array();
      $result['response_code']= 403;
    	echo json_encode($result);
     	exit;
   	}
    }
    
    public function removedrequestlistapi() {
    	if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
        $this->loadModel('Responses');
        $this->loadModel('Hotels');
        $this->loadModel('Requests');
        $this->loadModel('Cities');
		$conditions["Requests.user_id"] = $_POST['user_id'];
		$conditions["Requests.is_deleted "] = 1;
		if(isset($_POST["budgetsearch"]) && !empty($_POST["budgetsearch"])) {
			$QPriceRange = $_POST["budgetsearch"];
			$result = explode("-", $QPriceRange);
			 $MinQuotePrice = $result[0];
			 $MaxQuotePrice = $result[1];
			$conditions["Requests.total_budget >="] = $MinQuotePrice;
			$conditions["Requests.total_budget <="] = $MaxQuotePrice;
		}
		if(isset($_POST["req_typesearch"]) && !empty($_POST["req_typesearch"])) {
		$conditions["Requests.category_id"] =  $_POST["req_typesearch"];
		}
		if(isset($_POST["refidsearch"]) && !empty($_POST["refidsearch"])) {
		$conditions["Requests.reference_id"] =  $_POST["refidsearch"];
		}
		
		
		if(isset($_POST["startdatesearch"])) {
			$sdate = $_POST["startdatesearch"];
			}
			if(isset($sdate) && !empty($sdate)){
		$date = str_replace('/', '-', $sdate);
		$sdate = date('Y-m-d', strtotime($date));
		}
		
		if(!empty($_POST["startdatesearch"])) {
			
            	$da["Requests.start_date"] =  $sdate;
            	$da["Requests.check_in"] =  $sdate;
					$conditions["OR"] =  $da;
		}
		
		if(isset($_POST["enddatesearch"])) {
			$edate = $_POST["enddatesearch"];
			}
		if(isset($edate) && !empty($edate)){
		$date = str_replace('/', '-', $edate);
		$edate = date('Y-m-d', strtotime($date));
		}
		 
			
		if(!empty($_POST["enddatesearch"])) {
			$da1["Requests.end_date"] =  $edate;
            	$da1["Requests.check_out"] =  $edate;
			$conditions["OR"] =  $da1;
		}
        if ($_POST['role_id'] == 1) {
            $requests = $this->Requests->find()
                            ->contain(["Users","Hotels"])
                            ->where($conditions)->order(["Requests.id" => "DESC"])->all();
        }
        if ($_POST['role_id'] == 2) {
            $requests = $this->Requests->find()
                            ->contain(["Users","Hotels"])
                            ->where($conditions)->order(["Requests.id" => "DESC"])->all();
        }
        if ($_POST['role_id'] == 3) {
			$conditions["Requests.category_id "] = 3;
         $requests = $this->Requests->find()
                            ->contain(["Users","Hotels"])
                            ->where($conditions)->order(["Requests.id" => "DESC"])->all();
        }
			$conn = ConnectionManager::get('default');
        $citystate = array();
			$enddatearray=array();
                     foreach($requests as $cit)
                     {
						 if($cit['category_id']==2)
						 {
						 $cityname = $this->cityname($cit['pickup_city']);
						 }else{
						 $cityname = $this->cityname($cit['city_id']);
						 }	 
                     
						 if($cit['category_id']==2)
						 {
						 $statename = $this->statename($cit['pickup_state']);
						 }else{
						$statename = $this->statename($cit['state_id']);
						 }
                     
                     $comma = '';
                     if($statename!=""){
                     $comma = ',';
                     }
                     $citystatefull = $cityname.' ('. $statename.')';
							
							$city_state_name = "";
							if(count($cit['hotels']) >0) {
								unset($cit['hotels'][0]);
                    foreach($cit['hotels'] as $row) { 
                     $city_state_name.=', '.$this->cityname($row['city_id']).' ('.$this->statename($row['state_id']).')'; 
                  	 }  } 
                      $citystate['citystate'][$cit['id']]  = $citystatefull.''.$city_state_name;
						 
						if($cit['category_id']==1){
			$sql = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$cit['id']."'";
                                 $stmt = $conn->execute($sql);
                                 $resulth = $stmt->fetch('assoc');
				$end_data =  date('Y-m-d', strtotime($cit['end_date']));
				if(!empty($resulth['TopDate'])){
					if($resulth['TopDate']>$end_data){
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($resulth['TopDate']));
		}else{
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($cit['end_date']));	
		}
					}else{
					if($cit['check_out']>$end_data){
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($cit['check_out']));
		}else{
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($cit['end_date']));	
		}
					}
				}elseif($cit['category_id'] == 2 ) {
			$enddatearray[$cit['id']] = date('Y-m-d', strtotime($cit['end_date']));
				}elseif($cit['category_id'] == 3 ) {
			$enddatearray[$cit['id']] = date('Y-m-d', strtotime($cit['check_out']));
					} 
						 
                     }
           
			$sql = "select s.state_name,c.id as city_id,c.name as city_name from cities as c 
					INNER JOIN states as s on s.id=c.state_id
					INNER JOIN requests as r on r.city_id=c.id
					INNER JOIN requests as re on re.pickup_city=c.id
					group by c.id order by c.name asc ";
		$stmt = $conn->execute($sql);
		$allCities = $stmt ->fetchAll('assoc');
		
		 $result['response_code'] = 200;
		 $result['response_object'] = $requests;
			$result['end_date'] = $enddatearray;
		 $result['citystate'] = $citystate;
		  $result['cities_list'] = $allCities;
    	 $data =   json_encode($result);
      echo $data;
      exit;
   }else{
  	 $result = array();
      $result['response_code']= 403;
    	echo json_encode($result);
     	exit;
   	}
    }
    public function businessbuddieslistapi() {
    	if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
        $this->loadModel('Responses');
        $this->loadModel('Hotels');
        $this->loadModel('Requests');
        $this->loadModel('Cities');
		  $this->loadModel('BusinessBuddies');
		  $BusinessBuddies = $this->BusinessBuddies->find()
						->contain(["Users"])
						->where(['BusinessBuddies.user_id' => $_POST['user_id']])->group(['BusinessBuddies.bb_user_id'])->order(["BusinessBuddies.id" => "DESC"])->all();
			$result['response_code'] = 200;
		  $result['response_object'] = $BusinessBuddies;
    		$data =   json_encode($result);
      echo $data;
      exit;
   }else{
   $result = array();
      $result['response_code']= 403;
    	echo json_encode($result);
     	exit;
   }
    }
   public function addbusinessbuddyapi() {
   	 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
        $this->loadModel('BusinessBuddies');
			$res = 0;
		if(isset($_POST["follow_id"]) && !empty($_POST["follow_id"]) && !empty($_POST["user_id"])) {
			$d["bb_user_id"] = $_POST["follow_id"];
			$d["user_id"] = $_POST["user_id"];
			$d["created"] = date("Y-m-d h:i:s");
			$BusinessBuddy = $this->BusinessBuddies->newEntity($d);
			if($this->BusinessBuddies->save($BusinessBuddy)) {
			$result['response_code'] = 200;
			$result['response_object'] = 1;
    		$data =   json_encode($result);
     		echo $data;
      	exit;
			} else {
		$result['response_code'] = 500;
		$result['response_object'] = 0;
    	$data =   json_encode($result);
      echo $data;
      exit;
			}
		}
		}else{
   	$result = array();
      $result['response_code']= 403;
    	echo json_encode($result);
     	exit;
   	}
    }
public function removebusinessbuddyapi() {
	 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
      $this->loadModel('BusinessBuddies');
		$res = 0;
		if(isset($_POST["follow_id"]) && !empty($_POST["follow_id"]) && !empty($_POST["user_id"])) {
		$conn = ConnectionManager::get('default');
		$sql = "Delete FROM business_buddies WHERE user_id ='".$_POST['user_id']."' AND bb_user_id ='".$_POST['follow_id']."'";
		if($stmt = $conn->execute($sql)) {
		$result['response_code'] = 200;
		$result['response_object'] = 1;
    	$data =   json_encode($result);
      echo $data;
      exit;
		}else{
		$result['response_code'] = 500;
		$result['response_object'] = 0;
    	$data =  json_encode($result);
      echo $data;
      exit;
			}
		}
		}else{
   	$result = array();
      $result['response_code']= 403;
    	echo json_encode($result);
     	exit;
   	}
    }
	public function checkresponsesapi() {
	if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
	$this->loadModel('Responses');
	$this->loadModel('Requests');
	$this->loadModel('BusinessBuddies');
	$this->loadModel('User_Chats');
	$conditions["Responses.request_id"] = $_POST['request_id'];
	if(!empty($_POST['agentnamesearch'])) {
	$keyword1 = '';
	$keyword2 = '';
	$keyword = trim($_POST['agentnamesearch']);
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
	if(!empty($_POST['quotesearch'])) {
	$QPriceRange = $_POST['quotesearch'];
	$result = explode("-", $QPriceRange);
	$MinQuotePrice = $result[0];
	$MaxQuotePrice = $result[1];
	$conditions["Responses.quotation_price >="] = $MinQuotePrice;
	$conditions["Responses.quotation_price <="] = $MaxQuotePrice;
	}

	if(!empty($_POST['budgetsearch'])) {
	$QPriceRange = $_POST['budgetsearch'];
	$result = explode("-", $QPriceRange);
	$MinBudgetPrice = $result[0];
	$MaxBudgetPrice = $result[1];
	$conditions["Requests.total_budget >="] = $MinBudgetPrice;
	$conditions["Requests.total_budget <="] = $MaxBudgetPrice;
	}
	if(!empty($_POST["chatwith"])) {
	$chatuserid = $_POST["chatwith"];
	$conditions["Responses.user_id"] = $chatuserid;
	}
	if(!empty($_POST["shared_details"])) {
	$conditions["Responses.is_details_shared"] =  $_POST["shared_details"];
	}
	if(!empty($_POST['refidsearch'])) {
	$conditions["Requests.reference_id"] =  $_POST['refidsearch'];
	}
	$sortorder ='';
	if(!empty($_POST['sort'])) {
	$sortfield = $_POST['sort'];
	if($sortfield =="quotedpricelh"){
	$sortorder["Responses.quotation_price"] = "ASC";
	}
	if($sortfield =="quotedpricehl"){
	$sortorder["Responses.quotation_price"] = "DESC";
	}

	if($sortfield =="totalbudgetlh"){
	$sortorder["Requests.total_budget"] = "ASC";
	}
	if($sortfield =="totalbudgethl"){
	$sortorder["Requests.total_budget"] = "DESC";
	}	

	if($sortfield =="agentaz"){
	$sortorder['Users.first_name'] = "ASC";
	$sortorder['Users.last_name'] = "ASC";
	}
	if($sortfield =="agentza"){
	$sortorder['Users.first_name'] = "DESC";
	$sortorder['Users.last_name'] = "DESC";
	}		

	}
	$responses = $this->Responses->find()
	->contain(["Users", "Requests","Requests.Hotels", "UserChats","Testimonial"])
	->where($conditions)
	->order($sortorder)
	->all();

	$chatusers = array();
	$conn = ConnectionManager::get('default');
	$sql = "SELECT u.id,u.first_name,u.last_name FROM users as u 
	INNER JOIN responses as rs on rs.user_id=u.id
	WHERE rs.request_id ='".$_POST['request_id']."' ";
	$stmt = $conn->execute($sql);
	$chatusers = $stmt ->fetchAll('assoc');
	$data = array();
	$BusinessBuddies = array();
	$blockeddata = array();
	if(count($responses)>0) {
	foreach($responses as $row){ 
	$request_id = $row['request']['id'];
	$loggedinid = $row['request']['user_id'];
	$user_id = $row['user']['id'];
	$sql = "SELECT *,COUNT(*) as ch_count FROM user_chats 
	WHERE request_id='".$request_id."' AND (user_id in ('".$loggedinid."','".$user_id."') 
	AND notification='0'
	ANd send_to_user_id in ('".$loggedinid."','".$user_id."')) ";
	$stmt1 = $conn->execute($sql);
	$results1 = $stmt1->fetch('assoc');			
	//$row["request"]["chat_count"]=$results1['ch_count'];
	$data[$row['id']] =$results1['ch_count'];

	$sql1="Select count(*) as block_count from blocked_users where blocked_user_id='".$row['user']['id']."' AND blocked_by='".$row['request']['user_id']."'";
	$stmt = $conn->execute($sql1);
	$bresult = $stmt->fetch('assoc');
	if($bresult['block_count']>0){
	$blockeddata['blockedUser'][$row['id']] =1;
	}else{
	$blockeddata['blockedUser'][$row['id']] =0;
	}
	}

	$BusinessBuddies = $this->BusinessBuddies->find('list',['keyField' => "bb_user_id",'valueField' => 'bb_user_id'])
	->hydrate(false)
	->where(['user_id' => $loggedinid])
	->toArray();

	}

	$citystate = array();
	$enddatearray=array();
	foreach($responses as $cit)
	{
	if($cit['category_id']==2)
	{
	$cityname = $this->cityname($cit['request']['pickup_city']);
	}else{
	$cityname = $this->cityname($cit['request']['city_id']);
	}	 

	if($cit['category_id']==2)
	{
	$statename = $this->statename($cit['request']['pickup_state']);
	}else{
	$statename = $this->statename($cit['request']['state_id']);
	}

	$comma = '';
	if($statename!=""){
	$comma = ',';
	}
	// $citystatefull = $cityname.$comma.' '. $statename;

	$citystatefull = $cityname.' ('. $statename.')';

	$city_state_name = "";
	if(count($cit['request']['hotels']) >0) {
	unset($cit['request']['hotels'][0]);
	foreach($cit['request']['hotels'] as $row) { 
	$city_state_name.=', '.$this->cityname($row['city_id']).' ('.$this->statename($row['state_id']).')'; 
	}  }  

	$citystate['citystate'][$cit['id']]  = $citystatefull.''.$city_state_name;
	// $citystate['citystate'][$cit['id']]  = $citystatefull;
	if($cit['request']['category_id']==1){
	$sqlh = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$cit['request']['id']."'";
	$stmth = $conn->execute($sqlh);
	$resulth = $stmth->fetch('assoc');
		$end_data =  date('Y-m-d', strtotime($cit['request']['end_date']));
	if(!empty($resulth['TopDate'])){
		if($resulth['TopDate']>$end_data){
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($resulth['TopDate']));
		}else{
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($cit['request']['end_date']));	
		}
	}else{
		if($req['check_out']>$end_data){
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($cit['request']['check_out']));
		}else{
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($cit['request']['end_date']));	
		}
	}
	}elseif($cit['request']['category_id'] == 2 ) {
	$enddatearray[$cit['id']] = date('Y-m-d', strtotime($cit['request']['end_date']));
	}elseif($cit['request']['category_id'] == 3 ) {
	$enddatearray[$cit['id']] = date('Y-m-d', strtotime($cit['request']['check_out']));
	} 

	}

	$result['response_code'] = 200;
	$result['response_object'] = $responses;
	$result['citystate'] = $citystate;
	$result['end_date'] = $enddatearray;
	$result['BusinessBuddies'] = $BusinessBuddies;
	$result['chat_count'] = $data;
	$result['blockeddata'] = $blockeddata;
	$result['chat_users'] = $chatusers;
	$data =   json_encode($result);
	echo $data;
	exit;
	}else{
	$result = array();
	$result['response_code']= 403;
	echo json_encode($result);
	exit;
	}
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
	
public function userprofileapi() 
{
	if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
		$id =  $_POST['user_id'];
		$this->loadModel('Cities');
		$this->loadModel('Testimonial');
		$this->loadModel('Users');
		$this->loadModel('Requests');
		$this->loadModel('Responses');
		$this->loadModel('Membership');
		$userRequestCount = $userReponseCount = 0;
		$userrespondToRequestCount = 0;
		$rconditions["Responses.user_id"] = $id;
		$rconditions["Responses.status"] = 1;
		$rconditions["Responses.is_deleted"] = 0;

		$responses = $this->Responses->find()
			->contain(["Users", "Requests"])
			->where($rconditions)->all();
			$userReponseCount = $responses->count();
			$result['userReponseCount'] = $userReponseCount;


		$user = $this->Users->find()->where(['id' => $id])->first();
		if(empty($user)){
			$finalresult['response_code'] = 200;
			$finalresult['response_object'] = "No User Found";
			$data = json_encode($finalresult);
			echo $data;
			exit;
		}
		else
		{
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
			$result['userRequestCount'] = $userRequestCount;

			$TableMembership = TableRegistry::get('Membership');
			$membership = $TableMembership->get($user["role_id"]);
			$membership_name = $membership["membership_name"];
			$result['membership_name'] = $membership_name;

			$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.is_deleted' =>0,'Responses.user_id' => $id]]);
			$myReponseCount = $queryr->count();
			$result['userrespondToRequestCount'] = $myReponseCount;
			//$this->set('userrespondToRequestCount', $myReponseCount);

			//$userrespondToRequestCount = $this->__getUserRespondToRequestCount($user);
			//$result['userrespondToRequestCount'] = $userrespondToRequestCount;

			$alltestimonials ='';
			$result['users'] = $user;
			$average_rating = 0;
			$query = $this->Testimonial->find();
			$userRating = $query->select(["average_rating" => $query->func()->avg("rating")])
			->where(['status' => 0,'user_id' => $id])
			->order(["id" => "DESC"])
			->first();
			$average_rating = $userRating['average_rating'];
			$result['average_rating'] = $average_rating;
			$testimonialcount= 0;
			$utestimonials = $this->Testimonial->find()->where(['user_id'=> $id])->all();
			$testimonialcount = $utestimonials->count();       
			$result['testimonialcount'] = $testimonialcount;

			$testimonials = $this->Testimonial->find()->where(['user_id'=> $id])->all();
			$testimoniallist = array();
			$allpercentage =array();
			if(!empty($testimonials)) {
				foreach($testimonials as $testimonial) {
					$users = $this->Users->find()->where(['status' => 1,'id'=> $testimonial['author_id']])->first();
					$name = $users['first_name']." ".$users['last_name'];
					$alltestimonials[] = array( "name"=>$name,"rating1"=>$testimonial['rating'], "description"=>$users['description'], "profile_pic"=>$users['profile_pic'], "comment"=>$testimonial['comment'],"user_id"=>$testimonial['user_id'],"author_id"=>$testimonial['author_id']);
				}
				$result['testimonial'] = $alltestimonials;

				$star1 = $this->Testimonial->find()->where(['user_id'=> $id,'rating'=>1])->all();
				$star1count = $star1->count();
				$star2 = $this->Testimonial->find()->where(['user_id'=> $id,'rating'=>2])->all();
				$star2count = $star2->count();
				$star3 = $this->Testimonial->find()->where(['user_id'=> $id,'rating'=>3])->all();
				$star3count = $star3->count();
				$star4 = $this->Testimonial->find()->where(['user_id'=> $id,'rating'=>4])->all();
				$star4count = $star4->count();
				$star5 = $this->Testimonial->find()->where(['user_id'=> $id,'rating'=>5])->all();
				$star5count = $star5->count();
				$star1 = $star1count;
				$star2 = $star2count;
				$star3 = $star3count;
				$star4 = $star4count;
				$star5 = $star5count;
				$tot_stars = $star1count + $star2count + $star3count + $star4count + $star5count;
				$allpercentage =array();
				for ($i=5;$i >=1; --$i) {
					$var = "star$i";
					$count = $$var;
					$percent = $count * 100 / $tot_stars;
					$percentage = round($percent,2);
					$allpercentage[] = array("rating"=>$i,"percentage"=>$percentage);
					$percentage = '';
				}

			}
			$finalresult['response_code'] = 200;
			$finalresult['response_object'] = $result;
			$finalresult['Percentage'] = $allpercentage;
			 echo"<pre>"; print_r($allpercentage); echo"</pre>"; exit;
			$data = json_encode($finalresult);
			echo $data;
			exit;
		}
	}
	else
	{
		$result = array();
		$result['response_code']= 403;
		echo json_encode($result);
		exit;
	}
}



public function userrating() {
	if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
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
if(!empty($testimonials)) {
foreach($testimonials as $testimonial) {
$users = $this->Users->find()->where(['status' => 1,'id'=> $testimonial['author_id']])->first();
$name = $users['first_name']." ".$users['last_name'];
$alltestimonials[] = array( "name"=>$name,"rating1"=>$testimonial['rating'], "description"=>$users['description'], "profile_pic"=>$users['profile_pic'], "comment"=>$testimonial['comment'],"user_id"=>$testimonial['user_id'],"author_id"=>$testimonial['author_id']);
}
$result['testimonial'] = $alltestimonials;
}
        $finalresult['response_code'] = 200;
        $finalresult['response_object'] = $result;
        $data = json_encode($finalresult);
      echo $data;
      exit;
      }else{
		$result = array();
      $result['response_code']= 403;
    	echo json_encode($result);
     	exit;
		}
}
	public function unblockUserapi() {
    	 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
      $this->loadModel('BlockedUsers');
		$res = 0;
		
		if(isset($_POST["blockuser_id"]) && !empty($_POST["blockuser_id"]) && !empty($_POST["user_id"])){		
		$conn = ConnectionManager::get('default');
		$sql = "Delete FROM blocked_users WHERE blocked_by ='".$_POST['user_id']."' AND blocked_user_id ='".$_POST['blockuser_id']."'";
		if($stmt = $conn->execute($sql)){
				$res = 1;
			} else {
				$res = 0;
			}
		}
		
		$result['response_code'] = 200;
		$result['response_object'] = $res;
    	$data =   json_encode($result);
      echo $data;
      exit;
  		}else{
		$result = array();
      $result['response_code']= 403;
    	echo json_encode($result);
     	exit;
		}
    }
	
 public function counterapi(){
$travelAgentCount = $this->Users->find()->where(['role_id' => 1])->count();
$eventPlannerCount = $this->Users->find()->where(['role_id' => 2])->count();
$hotelierCount = $this->Users->find()->where(['role_id' => 3])->count(); 
$countarr = array();
$coountarr['travelAgentCount'] = $travelAgentCount;
$coountarr['eventPlannerCount'] = $eventPlannerCount;
$coountarr['hotelierCount'] = $hotelierCount;
$result = array();
$result['response_code'] = 200;
$result['response_object'] = $coountarr;
$data =   json_encode($result);
      echo $data;
      exit;
 }
 public function getrequestcount() {
 $requestcount = $this->Setting->find()->where(['field' => 'requestcount'])->first();
 $requestcountval =  $requestcount['value'];
 return $requestcountval;
 }
	public function requestlistapi() {
	$this->loadModel('Responses');
	$this->loadModel('Hotels');
	$this->loadModel('Requests');
	$this->loadModel('Cities');
	if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
	$conditions["Requests.user_id"] = $_POST['user_id'];
	$conditions["Requests.status !="] = 2;
	$conditions["Requests.is_deleted "] = 0;
	if(isset($_POST["budgetsearch"]) && !empty($_POST["budgetsearch"])) {
	$QPriceRange = $_POST["budgetsearch"];
	$result = explode("-", $QPriceRange);
	$MinQuotePrice = $result[0];
	$MaxQuotePrice = $result[1];
	$conditions["Requests.total_budget >="] = $MinQuotePrice;
	$conditions["Requests.total_budget <="] = $MaxQuotePrice;
	}
	if(isset($_POST["req_typesearch"]) && !empty($_POST["req_typesearch"])) {
	$conditions["Requests.category_id"] =  $_POST["req_typesearch"];
	}
	if(isset($_POST["refidsearch"]) && !empty($_POST["refidsearch"])) {
	$conditions["Requests.reference_id"] =  $_POST["refidsearch"];
	}

	if(isset($_POST["destination_city"]) && !empty($_POST["destination_city"])) {
	$conditions["Requests.city_id"] =  $_POST["destination_city"];
	}
	if(isset($_POST["pickup_city"]) && !empty($_POST["pickup_city"])) {
	$conditions["Requests.pickup_city"] =  $_POST["pickup_city"];
	}

	if(isset($_POST["members"]) && !empty($_POST["members"])) {
	$conditions["Requests.children+Requests.adult"] =  $_POST["members"];
	}


	if(isset($_POST["startdatesearch"]) && !empty($_POST["startdatesearch"])) {
	$sdate = $_POST["startdatesearch"];
	$date = str_replace('/', '-', $sdate);
	$sdate = date('Y-m-d', strtotime($date));
	//$sdate = (isset($sdate) && !empty($sdate))?$this->ymdFormatByDateFormat($sdate, "m-d-Y", $dateSeparator="/"):null;
	}
	if(!empty($_POST["startdatesearch"])) {

	$da["Requests.start_date"] =  $sdate;
	$da["Requests.check_in"] =  $sdate;
	$conditions["OR"] =  $da;
	}
	if(isset($_POST["enddatesearch"]) && !empty($_POST["enddatesearch"])) {
	$edate =  $_POST["enddatesearch"]; 
	$date = str_replace('/', '-', $edate);
	$edate = date('Y-m-d', strtotime($date));
	// $edate = (isset($edate) && !empty($edate))?$this->ymdFormatByDateFormat($edate, "m-d-Y", $dateSeparator="/"):null;
	}

	if(!empty($_POST["enddatesearch"])) {
	$da1["Requests.end_date"] =  $edate;
	$da1["Requests.check_out"] =  $edate;
	if(!empty($sdate)){
	$da1["Requests.start_date"] =  $sdate;
	$da1["Requests.check_in"] =  $sdate;
	}
	$conditions["OR"] =  $da1;
	}
	//print_r($conditions); die();
	$sort='';
	if(! isset($_POST["sort"])) {
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
	/*if(!empty($_POST["sort"]) && $_POST["sort"]=="resposesnolh") {
	$sort['COUNT(Responses.request_id)'] = "ASC";
	}
	if(!empty($_POST["sort"]) && $_POST["sort"]=="resposesnohl") {
	$sort['COUNT(Responses.request_id)'] = "DESC";
	}*/
	if (isset($_POST['role_id']) AND $_POST['role_id'] == 1) {
	$requests = $this->Requests->find()
		->contain(["Users","Hotels"])
		->where($conditions)->group('Requests.id')->order($sort)->all();
	}
	if (isset($_POST['role_id']) AND $_POST['role_id']== 2) {
	$requests = $this->Requests->find()
		->contain(["Users","Hotels"])
		->where($conditions)->order($sort)->all();
	}
	if (isset($_POST['role_id']) AND $_POST['role_id']== 3) {
	$conditions["Requests.category_id "] = 3;
	$requests = $this->Requests->find()
		->contain(["Users","Hotels"])
		->where($conditions)->order($sort)->all();
	}
	$conn = ConnectionManager::get('default');

	$citystate = array();
	foreach($requests as $cit)
	{
	 if($cit['category_id']==2)
	 {
	 $cityname = $this->cityname($cit['pickup_city']);
	 }else{
	 $cityname = $this->cityname($cit['city_id']);
	 }	 

	 if($cit['category_id']==2)
	 {
	 $statename = $this->statename($cit['pickup_state']);
	 }else{
	$statename = $this->statename($cit['state_id']);
	 }

	$comma = '';
	if($statename!=""){
	$comma = ',';
	}
	$citystatefull = $cityname.' ('. $statename.')';

		$city_state_name = "";
		if(count($cit['hotels']) >0) {
			unset($cit['hotels'][0]);
	foreach($cit['hotels'] as $row) { 
	$city_state_name.=', '.$this->cityname($row['city_id']).' ('.$this->statename($row['state_id']).')'; 
	}  }   

	$citystate['citystate'][$cit['id']]  = $citystatefull.''.$city_state_name;
	}
	$countarr = array();
	$enddatearray=array();
	foreach($requests as $req){
	if($req['category_id']==1){
	$sql = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$req['id']."'";
			 $stmt = $conn->execute($sql);
			 $result = $stmt->fetch('assoc');
		$end_data =  date('Y-m-d', strtotime($req['end_date']));
	if(!empty($result['TopDate'])){
		if($result['TopDate']>$end_data){
	$enddatearray[$req['id']]  = date('Y-m-d', strtotime($result['TopDate']));
		}else{
	$enddatearray[$req['id']]  = date('Y-m-d', strtotime($req['end_date']));	
		}
	}else{
		if($req['check_out']>$end_data){
	$enddatearray[$req['id']]  = date('Y-m-d', strtotime($req['check_out']));
		}else{
	$enddatearray[$req['id']]  = date('Y-m-d', strtotime($req['end_date']));	
		}
	}
	}elseif($req['category_id'] == 2 ) {
	$enddatearray[$req['id']] = date('Y-m-d', strtotime($req['end_date']));
	}elseif($req['category_id'] == 3 ) {
	$enddatearray[$req['id']] = date('Y-m-d', strtotime($req['check_out']));
	}
	$queryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]])->contain(['Users']);
	$countarr['responsecount'][$req['id']]  = $queryr->count();
	}


	if($requests){	
	$sql = "select s.state_name,c.id as city_id,c.name as city_name from cities as c 
	INNER JOIN states as s on s.id=c.state_id
	INNER JOIN requests as r on r.city_id=c.id
	INNER JOIN requests as re on re.pickup_city=c.id
	group by c.id order by c.name asc ";
	$stmt = $conn->execute($sql);
	$allCities = $stmt ->fetchAll('assoc');
	$result['response_code'] = 200;
	$result['response_object'] = $requests;
	$result['end_date'] = $enddatearray;

	$result['cities_list'] = $allCities;
	$result['citystate'] = $citystate;
	$result['countarr'] = $countarr;
	$data = json_encode($result);
	echo $data;
	exit;
	}else {
	$result['response_code'] = 501;
	$data = json_encode($result);
	echo $data;
	exit;
	}
	}else{
	$result = array();
	$result['response_code']= 403;
	echo json_encode($result);
	exit;
	}
	}
	public function respondtorequestapi() {
	$headers =  getallheaders();
	date_default_timezone_set('Asia/Kolkata');
	$current_time = date("Y-m-d");
	$this->loadModel('Transports');
	$this->loadModel('Testimonial');
	$this->loadModel('Hotels');
	$this->loadModel('Responses');
	$this->loadModel('Requests');
	$this->loadModel('Cities');
	$this->loadModel('States');
	$this->loadModel('BusinessBuddies');
	if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {

	$sort='';
	if(!isset($_POST["sort"]) OR empty($_POST["sort"]))  {
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
	if(!empty($_POST["sort"]) && $_POST["sort"]=="agentaz") {
	$sort['Users.first_name'] = "ASC";
	$sort['Users.last_name'] = "ASC";
	}
	if(!empty($_POST["sort"]) && $_POST["sort"]=="agentza") {
	$sort['Users.first_name'] = "DESC";
	$sort['Users.last_name'] = "DESC";
	}


	$conditions ='';
	$conditions["OR"] = array("Requests.check_in >="=> $current_time, "Requests.start_date >="=> $current_time);
	if(!empty($_POST["agentnamesearch"])) {
	$keyword1 = '';
	$keyword2 = '';
	$keyword = trim($_POST["agentnamesearch"]);
	$keyword = explode(' ',$keyword);
	if(isset($keyword[1])) {
	$keyword2 = $keyword[1];
	}
	$conditions["AND"] = array("Users.first_name LIKE "=>"%". $keyword[0]."%", "Users.last_name LIKE" => "%".$keyword2."%",);
	}
	if(!empty($_POST["destination_city"])){
	$conditions["Requests.city_id"] =  $_POST["destination_city"];
	}
	if(!empty($_POST["pickup_city"])) {
	$conditions["Requests.pickup_city"] =  $_POST["pickup_city"];
	}		
	if($_POST['role_id']==3){
	$conditions["Requests.category_id"] =  3;
	}else{	
	if(!empty($_POST["req_typesearch"])) {
	$conditions["Requests.category_id"] =  $_POST["req_typesearch"];
	}
	}
	if(!empty($_POST["budgetsearch"])) {
	$QPriceRange = $_POST["budgetsearch"];
	$result = explode("-", $QPriceRange);
	$MinQuotePrice = $result[0];
	$MaxQuotePrice = $result[1];
	$conditions["Requests.total_budget >="] = $MinQuotePrice;
	$conditions["Requests.total_budget <="] = $MaxQuotePrice;
	}
	if(!empty($_POST["refidsearch"])) {
	$conditions["Requests.reference_id"] =  $_POST["refidsearch"];
	}
	if(isset($_POST["members"]) && !empty($_POST["members"])) {
	$conditions["Requests.children+Requests.adult"] =  $_POST["members"];
	}

	if(isset($_POST['startdatesearch']) AND !empty($_POST['startdatesearch'])){
	$sdate = $_POST["startdatesearch"];
	$date = str_replace('/', '-', $sdate);
	$sdate = date('Y-m-d', strtotime($date));
	}else{
	$sdate = '';
	}

	if(!empty($sdate)) {
	$da["Requests.start_date"] =  $sdate;
	$da["Requests.check_in"] =  $sdate;
	$conditions["OR"] =  $da;
	}

	if(isset($_POST['enddatesearch']) AND !empty($_POST['enddatesearch'])){
	$edate = $_POST["enddatesearch"];
	$date = str_replace('/', '-', $edate);
	$edate = date('Y-m-d', strtotime($date));
	}else{
	$edate = '';
	}

	if(!empty($edate)) {
	$da1["Requests.end_date"] =  $edate;
	$da1["Requests.check_out"] =  $edate;
	if(!empty($sdate)){
	$da1["Requests.start_date"] =  $sdate;
	$da1["Requests.check_in"] =  $sdate;
	}
	$conditions["OR"] =  $da1;	
	}

	$allStates = $this->States->find('list',['keyField' => 'id', 'valueField' => 'state_name'])
	->hydrate(false)
	->toArray();

	$user = $this->Users->find()->where(['id' => $_POST['user_id']])->first();
	//$this->set('users', $user);
	$this->loadModel('BlockedUsers');
	$BlockedUsers = $this->BlockedUsers->find('list',['keyField' => "id",'valueField' => 'blocked_user_id'])
	->hydrate(false)
	->where(['blocked_by' => $_POST['user_id']])
	->toArray();
	if(!empty($BlockedUsers)) {
	$BlockedUsers = array_values($BlockedUsers);
	}
	array_push($BlockedUsers,$_POST['user_id']);
	$BlockedUsers = array_unique($BlockedUsers);

	if ($_POST['role_id'] == 1) { // Travel Agent
	if(!empty($user["preference"])) {
	$conditionalStates = array_unique(array_merge(explode(",", $user["preference"]), array($user["state_id"])));
	} else {
	$conditionalStates = $user["state_id"];
	}

	$requests = $this->Requests->find()
	->contain(["Users", "Responses","Hotels"])
	->notMatching('Responses', function(\Cake\ORM\Query $q) {
	return $q->where(['Responses.user_id' =>  $_POST['user_id']]);
	})

	->where(["OR"=>['Requests.state_id IN' => $conditionalStates, 'Requests.pickup_state IN' => $conditionalStates], 'Requests.user_id NOT IN' => $BlockedUsers, "Requests.status !="=>2, "Requests.is_deleted"=>0,$conditions])
	->group('Requests.id')
	->order($sort)->all();

	} else if ($_POST['role_id'] == 2) { /// Event Planner
	$requests = $this->Requests->find()
	->contain(["Users","Hotels"])
	->where(['Requests.pickup_state' => $user["state_id"], 'Requests.category_id' => 2, "Requests.status !="=>2, "Requests.is_deleted"=>0])->order($sort)->all();
	}else if ($_POST['role_id'] == 3) { /// Hotel
	$requests = $this->Requests->find()
	->contain(["Users", "Responses","Hotels"])
	->notMatching('Responses', function(\Cake\ORM\Query $q) {
	return $q->where(['Responses.user_id' => $_POST['user_id']]);
	})
	->where(['Requests.city_id' => $user['city_id'],'Requests.user_id NOT IN' => $BlockedUsers, "Requests.status !="=>2, "Requests.is_deleted"=>0,$conditions])
	//->where(['Requests.category_id' => 3, "Requests.status !="=>2, "Requests.is_deleted"=>0])
	->group('Requests.id')
	->order($sort)->all();
	}
	$data = array();
	$blockeddata = array();
	foreach($requests as $req){

	$query = $this->Testimonial->find();
	$userRating = $query->select(["average_rating" => $query->func()->avg("rating")])
	->where(['author_id' => $req['user_id']])
	->order(["id" => "DESC"]);
	$data['rating'][$req['id']]  = $userRating;

	$checkblockedUsers = $this->BlockedUsers->find()->where(['blocked_by' => $req['user_id'],'blocked_user_id'=>$_POST['user_id']])->count();        
	if($checkblockedUsers==1){
	$blockeddata['blockedUser'][$req['id']] =1;
	}else{$blockeddata['blockedUser'][$req['id']]=0;} 


	}
	$citystate = array();
	$resdata = array();
	$enddatearray=array();
	$conn = ConnectionManager::get('default');
	foreach($requests as $cit)
	{
	if($cit['category_id']==2)
	{
	$cityname = $this->cityname($cit['pickup_city']);
	}else{
	$cityname = $this->cityname($cit['city_id']);
	}	 

	if($cit['category_id']==2)
	{
	$statename = $this->statename($cit['pickup_state']);
	}else{
	$statename = $this->statename($cit['state_id']);
	}
	$comma = '';
	if($statename!=""){
	$comma = ',';
	}
	$citystatefull = $cityname.' ('. $statename.')';

	$city_state_name = "";
	if(count($cit['hotels']) >0) {
	unset($cit['hotels'][0]);
	foreach($cit['hotels'] as $row) { 
	$city_state_name.=', '.$this->cityname($row['city_id']).' ('.$this->statename($row['state_id']).')'; 
	}  }   

	$citystate['citystate'][$cit['id']]  = $citystatefull.''.$city_state_name;

	// $citystate['citystate'][$cit['id']]  = $citystatefull;
	$queryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$cit['id']]])->contain(['Users']);
	$resdata[$cit['id']]  = $queryr->count();

	if($cit['category_id']==1){
	$sql = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$cit['id']."'";
	$stmt = $conn->execute($sql);
	$resulth = $stmt->fetch('assoc');
		$end_data =  date('Y-m-d', strtotime($cit['end_date']));
	if(!empty($resulth['TopDate'])){
		if($resulth['TopDate']>$end_data){
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($resulth['TopDate']));
		}else{
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($cit['end_date']));	
		}
	}else{
		if($cit['check_out']>$end_data){
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($cit['check_out']));
		}else{
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($cit['end_date']));	
		}
	}
	}elseif($cit['category_id'] == 2 ) {
	$enddatearray[$cit['id']] = date('Y-m-d', strtotime($cit['end_date']));
	}elseif($cit['category_id'] == 3 ) {
	$enddatearray[$cit['id']] = date('Y-m-d', strtotime($cit['check_out']));
	}

	}


	$sql = "select s.state_name,c.id as city_id,c.name as city_name from cities as c 
	INNER JOIN states as s on s.id=c.state_id
	INNER JOIN requests as r on r.city_id=c.id
	INNER JOIN requests as re on re.pickup_city=c.id
	group by c.id order by c.name asc ";
	$stmt = $conn->execute($sql);
	$allCities = $stmt ->fetchAll('assoc');

	$BusinessBuddies = $this->BusinessBuddies->find('list',['keyField' => "bb_user_id",'valueField' => 'bb_user_id'])
	->hydrate(false)
	->where(['user_id' => $_POST['user_id']])
	->toArray();

	$result['response_code'] = 200;
	$result['response_object'] = $requests;
	$result['BusinessBuddies'] = $BusinessBuddies;
	$result['responsecount'] = $resdata;
	$result['end_date'] = $enddatearray;
	$result['blockeduser'] = $blockeddata;
	$result['cities_list'] = $allCities;
	$result['rating'] = $data;
	$result['citystate'] = $citystate;
	$data =   json_encode($result);
	echo $data;
	exit;
	}else{
	$result = array();
	$result['response_code']= 403;
	echo json_encode($result);
	exit;
	}
	}
	public function finalizedrequestlistapi() {
	$this->loadModel('Responses');
	$this->loadModel('Hotels');
	$this->loadModel('Requests');
	$this->loadModel('Cities');
	$headers =  getallheaders();
	if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {

	$sort='';

	if(!isset($_POST["sort"])) {
	//$sort['Requests.accept_date'] = "DESC";
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

	$conditions["Requests.user_id"] = $_POST['user_id'];

	$conditions["Requests.status"] = 2;
	$conditions["Requests.is_deleted "] = 0;
	//$conditions["Requests.status"] = 1;
	if(isset($_POST["budgetsearch"]) && !empty($_POST["budgetsearch"])) {
	$QPriceRange = $_POST["budgetsearch"];
	$result = explode("-", $QPriceRange);
	$MinQuotePrice = $result[0];
	$MaxQuotePrice = $result[1];
	$conditions["Requests.total_budget >="] = $MinQuotePrice;
	$conditions["Requests.total_budget <="] = $MaxQuotePrice;
	}
	if(isset($_POST["req_typesearch"]) && !empty($_POST["req_typesearch"])) {
	$conditions["Requests.category_id"] =  $_POST["req_typesearch"];
	}
	if(isset($_POST["refidsearch"]) && !empty($_POST["refidsearch"])) {
	$conditions["Requests.reference_id"] =  $_POST["refidsearch"];
	}
	if(isset($_POST["members"]) && !empty($_POST["members"])) {
	$conditions["Requests.children+Requests.adult"] =  $_POST["members"];
	}
	if(isset($_POST["startdatesearch"])){
	$sdate = $_POST["startdatesearch"];
	}
	if(isset($sdate) && !empty($sdate)){
	$date = str_replace('/', '-', $sdate);
	$sdate = date('Y-m-d', strtotime($date));
	}

	if(!empty($_POST["startdatesearch"])) {
	$da["Requests.start_date"] =  $sdate;
	$da["Requests.check_in"] =  $sdate;
	$conditions["OR"] =  $da;
	}

	if(isset($_POST["enddatesearch"])){
	$edate = $_POST["enddatesearch"];
	}
	if(isset($edate) && !empty($edate)){
	$date = str_replace('/', '-', $edate);
	$edate = date('Y-m-d', strtotime($date));
	}

	if(!empty($_POST["enddatesearch"])) {
	$da1["Requests.end_date"] =  $edate;
	$da1["Requests.check_out"] =  $edate;
	if(!empty($sdate)){
	$da1["Requests.start_date"] =  $sdate;
	$da1["Requests.check_in"] =  $sdate;
	}
	$conditions["OR"] =  $da1;
	}

	if ($_POST['role_id'] == 1) {
	$requests = $this->Requests->find()
	->contain(["Users","Responses","Hotels","Responses.Users"])
	->where($conditions)->order($sort)->all();
	}
	if ($_POST['role_id'] == 2) {
	$requests = $this->Requests->find()
	->contain(["Users","Responses","Hotels","Responses.Users"])
	->where($conditions)->order($sort)->all();
	}
	if ($_POST['role_id'] == 3) {
	$requests = $this->Requests->find()
	->contain(["Users","Responses","Hotels","Responses.Users"])
	->where($conditions)->order($sort)->all();
	}

	$citystate = array();
	$review_array = array();
	$enddatearray=array();
	$final_res_array = array();
	$conn = ConnectionManager::get('default');
	if($requests->count()>0)
	{
	foreach($requests as $cit)
	{
	$sql = "SELECT * FROM testimonial WHERE request_id='".$cit['id']."' AND author_id='".$_POST['user_id']."' order by created_at DESC";
	$stmt = $conn->execute($sql);
	$reviews = $stmt ->fetch('assoc');
	$review_array[]=$reviews;
	if($cit['category_id']==2)
	{
	$cityname = $this->cityname($cit['pickup_city']);
	}else{
	$cityname = $this->cityname($cit['city_id']);
	}	 

	if($cit['category_id']==2)
	{
	$statename = $this->statename($cit['pickup_state']);
	}else{
	$statename = $this->statename($cit['state_id']);
	}

	$comma = '';
	if($statename!=""){
	$comma = ',';
	}

	$citystatefull = $cityname.' ('. $statename.')';

	$city_state_name = "";
	if(count($cit['hotels']) >0) {
	unset($cit['hotels'][0]);
	foreach($cit['hotels'] as $row) { 
	$city_state_name.=', '.$this->cityname($row['city_id']).' ('.$this->statename($row['state_id']).')'; 
	}  } 
	$citystate['citystate'][$cit['id']]  = $citystatefull.''.$city_state_name;

	if($cit['category_id']==1){
	$sqlh = "SELECT id,req_id,MAX(check_out) as TopDate FROM `hotels` where req_id='".$cit['id']."'";
	$stmth = $conn->execute($sqlh);
	$resulth = $stmth->fetch('assoc');
	$end_data =  date('Y-m-d', strtotime($cit['end_date']));
	if(!empty($resulth['TopDate'])){
		if($resulth['TopDate']>$end_data){
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($resulth['TopDate']));
		}else{
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($cit['end_date']));	
		}
	}else{
		if($cit['check_out']>$end_data){
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($cit['check_out']));
		}else{
	$enddatearray[$cit['id']]  = date('Y-m-d', strtotime($cit['end_date']));	
		}
	}
	}elseif($cit['category_id'] == 2 ) {
	$enddatearray[$cit['id']] = date('Y-m-d', strtotime($cit['end_date']));
	}elseif($cit['category_id'] == 3 ) {
	$enddatearray[$cit['id']] = date('Y-m-d', strtotime($cit['check_out']));
	}		 

	$sqlf = "SELECT r.*,u.first_name,u.last_name FROM responses as r
	inner JOIN users u on u.id=r.user_id
	WHERE r.request_id='".$cit['id']."' AND r.id='".$cit['final_id']."'"; 
	$stmtd = $conn->execute($sqlf);
	$resultd = $stmtd ->fetch('assoc');
	$final_res_array[$cit['id']]  = $resultd;	 


	}
	}


	$sql = "select s.state_name,c.id as city_id,c.name as city_name from cities as c 
	INNER JOIN states as s on s.id=c.state_id
	INNER JOIN requests as r on r.city_id=c.id
	INNER JOIN requests as re on re.pickup_city=c.id
	group by c.id order by c.name asc ";
	$stmt = $conn->execute($sql);
	$allCities = $stmt ->fetchAll('assoc');


	$result['response_code'] = 200;
	$result['response_object'] = $requests;
	$result['end_date'] = $enddatearray;
	$result['finalresponse'] = $final_res_array;
	$result['citystate'] = $citystate;
	$result['reviews'] = $review_array;	
	$result['cities_list'] = $allCities;
	$data =   json_encode($result);
	echo $data;
	exit;
	}else{
	$result = array();
	$result['response_code']= 403;
	echo json_encode($result);
	exit;
	}
	}
	public function dashboardapi() {
date_default_timezone_set('Asia/Kolkata');
$current_date = date("Y-m-d");
	$result = array();
	$this->loadModel('Testimonial');
	$this->loadModel('Promotion');
	$this->loadModel('Users');
	$usercity = $this->Users->find()->select(['city_id'])->where(['id' => $_POST['user_id']])->first();
	$cityid =  $usercity['city_id'];
	$csort['created_at'] = "DESC";
	$advertisement1 = $this->Promotion->find()->where(['expiry_date >' => $current_date,'FIND_IN_SET(\''.  $cityid .'\',cities)'])->order($csort)->all();
	$result['advertisement'] = $advertisement1 ;
	$user = $this->Users->find()
	->contain(["Credits"])
	->where(['Users.id' => $_POST['user_id']])->first();
	$testimonials = $this->Testimonial->find()->where(['user_id'=> $_POST['user_id']])->all();
	$testimoniallist = array();
	$alltestimonials = array();
	if(!empty($testimonials)) {
	foreach($testimonials as $testimonial) {
	$users = $this->Users->find()->where(['status' => 1,'id'=> $testimonial['author_id']])->first();
	$name = $users['first_name']." ".$users['last_name'];
	$alltestimonials[] = array( "name"=>$name, "rating1"=>$testimonial['rating'],"description"=>$users['description'], "profile_pic"=>$users['profile_pic'], "comment"=>$testimonial['comment']);
	}
	$result['response_code'] = 200;
	$result['testimonial'] = $alltestimonials;
	$result['description1'] = $user['description'] ;
	$data =   json_encode($result);
	echo $data;
	exit;
	}
	$result['response_code'] = 500;
	echo $result;
	exit;
	}
 public function dashboardcounterapi()
 {
 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
        $this->loadModel('Requests');
        $this->loadModel('Responses');
	 $this->loadModel('Hotels');
	 $this->loadModel('BlockedUsers');
        $myRequestCount = $myReponseCount = 0;
$myfinalCount  = 0;
$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $_POST['user_id'], "Requests.is_deleted"=>0,"Requests.status "=>2]]);
$myfinalCount = $query3 ->count();

$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $_POST['user_id'], "Requests.is_deleted"=>0,"Requests.status !="=>2]]);
 $myRequestCount = $query->count();

$myRequestCount1 = $query->count();
$delcount=0;
$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $_POST['user_id'], "Requests.is_deleted"=>1]]);
foreach($requests as $req){
$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
if($rqueryr->count()!=0){
$delcount++;
}
}
if($myRequestCount > $delcount) {
$myRequestCount = $myRequestCount-$delcount;
}   

$reqcount = $this->getSettings('requestcount');
$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.is_deleted' =>0,'Responses.user_id' => $_POST['user_id']]]);
$myReponseCount = $queryr->count();
	 if($myReponseCount>0){
		foreach($queryr as $req){
	 $checkblockedUsers = $this->BlockedUsers->find()->where(['blocked_by' => $req['request']['user_id'],'blocked_user_id'=>$_POST['user_id']])->count();        
		if($checkblockedUsers>0){
		$myReponseCount--;
		}
		}
		}
$this->set('myReponseCount', $myReponseCount);

//$myReponseCount = $queryr->count();
$reqcount = (($reqcount['value']-$myRequestCount1)-($delcount+ $myfinalCount));
$countarr = array();
        $coountarr['myRequestCount'] = $myRequestCount1 ;
        $coountarr['myReponseCount'] = $myReponseCount;
        $coountarr['placereq'] = $reqcount;
        $coountarr['respondToRequestCount'] = $this->__getRespondToRequestCountapi($_POST['user_id']);
        $result = array();
        $result['response_code'] = 200;
        $result['response_object'] = $coountarr;
        $data =   json_encode($result);
        echo $data;
        exit;
    } else {
echo "Invalid Access";   
exit;
    }
 }
	
	public function __getRespondToRequestCountapi($userid) {
	$requests ='';
	$this->loadModel('BlockedUsers');
	$this->loadModel('Requests');
	date_default_timezone_set('Asia/Kolkata');
	$current_time = date("Y-m-d");
	$user = $this->Users->find()->where(['id' => $userid])->first();
	$BlockedUsers = $this->BlockedUsers->find('list',['keyField' => "id",'valueField' => 'blocked_user_id'])
	->hydrate(false)
	->where(['blocked_by' => $userid])
	->toArray();
	if(!empty($BlockedUsers)) {
	$BlockedUsers = array_values($BlockedUsers);
	}
	array_push($BlockedUsers,$userid);
	$BlockedUsers = array_unique($BlockedUsers);
	if ($_POST['role_id'] == 1) { // Travel Agent
	if(!empty($user["preference"])) {
	$conditionalStates = array_unique(array_merge(explode(",", $user["preference"]), array($user["state_id"])));
	} else {
	$conditionalStates =  $user["state_id"];
	}
	$conditions["OR"] = array("Requests.check_in >="=> $current_time, "Requests.start_date >="=> $current_time);
	$requests = $this->Requests->find()
	->contain(["Users", "Responses"])
	->notMatching('Responses', function(\Cake\ORM\Query $q) {
	return $q->where(['Responses.user_id' => $userid]);
	})
	->where(["OR"=>['Requests.state_id IN' => $conditionalStates, 'Requests.pickup_state IN' => $conditionalStates],$conditions, 'Requests.user_id NOT IN' => $BlockedUsers, "Requests.status !="=>2, "Requests.is_deleted"=>0])
	//->group('Requests.id')
	->order(["Requests.id" => "DESC"])->count();
	} else if ($_POST['role_id'] == 3) { /// Hotel
	$conditions["OR"] = array("Requests.check_in >="=> $current_time, "Requests.start_date >="=> $current_time);
	$requests = $this->Requests->find()
	->contain(["Users", "Responses"])
	->notMatching('Responses', function(\Cake\ORM\Query $q) {
	return $q->where(['Responses.user_id' => $userid]);
	})
	->where(['Requests.city_id' => $user['city_id'], 'Requests.category_id' => 3, "Requests.status !="=>2, "Requests.is_deleted"=>0,$conditions])
	//->group('Requests.id')
	->order(["Requests.id" => "DESC"])->count();
	}
	return $requests;
	}
	
	public function citynameapi(){
	$this->loadModel('Cities');
	$city = $this->Cities->find()->where(['id' => $_POST['city_id']])->first();
	$result['response_code'] = 200;
	$result['response_object'] = $city;
   $data =   json_encode($result);
   echo $data;
   exit;
	}
	public function statenameapi(){
	$this->loadModel('States');
	$state = $this->States->find()->where(['id' => $_POST['state_id']])->first();
	$result['response_code'] = 200;
	$result['response_object'] = $state;
   $data =   json_encode($result);
   echo $data;
   exit;
	}

      
	public function editapi(){
	$id = $_POST['user_id'];
	$userDetails = $this->Users->get($id);
	if (isset($_POST)) {
	if($userDetails["role_id"] == 3) {
	if(isset($_POST["hotel_categories"]) && !empty($_POST["hotel_categories"])) {
	$_POST["hotel_categories"] = $_POST["hotel_categories"];
	}
	if(isset($_POST["hotel_rating"]) && !empty($_POST["hotel_rating"])) {
	$_POST["hotel_rating"] = $_POST["hotel_rating"];
	}
	}

	if(!empty($_POST['adyoi_pic']))
	{
	$adyoi_pic = $_POST['adyoi_pic'];
	$id=time().mt_rand().".png";
	$fullpath  =  WWW_ROOT."img".DS."user_travel_certificates".DS.$_POST['user_id'];
	$res1 = is_dir($fullpath);
	if($res1 != 1) {
	$res2= mkdir($fullpath, 0777, true);
	}
	$path = WWW_ROOT."img".DS."user_travel_certificates".DS.$_POST['user_id'].DS.$id;
	file_put_contents($path,base64_decode($adyoi_pic));
	$_POST['adyoi_pic'] = $id;
	}
	else {
	unset($_POST['adyoi_pic']);
	}

	if(!empty($_POST['iata_pic']))
	{
	$iata_pic = $_POST['iata_pic'];
	$id=time().mt_rand().".png";
	$fullpath  =  WWW_ROOT."img".DS."user_travel_certificates".DS.$_POST['user_id'];
	$res1 = is_dir($fullpath);
	if($res1 != 1) {
	$res2= mkdir($fullpath, 0777, true);
	}
	$path = WWW_ROOT."img".DS."user_travel_certificates".DS.$_POST['user_id'].DS.$id;
	file_put_contents($path,base64_decode($iata_pic));
	$_POST['iata_pic'] = $id;
	}
	else {
	unset($_POST['iata_pic']);
	}
	if(!empty($_POST['taai_pic']))
	{
	$taai_pic = $_POST['taai_pic'];
	$id=time().mt_rand().".png";
	$fullpath  =  WWW_ROOT."img".DS."user_travel_certificates".DS.$_POST['user_id'];
	$res1 = is_dir($fullpath);
	if($res1 != 1) {
	$res2= mkdir($fullpath, 0777, true);
	}
	$path = WWW_ROOT."img".DS."user_travel_certificates".DS.$_POST['user_id'].DS.$id;
	file_put_contents($path,base64_decode($taai_pic));
	$_POST['taai_pic'] = $id;
	}
	else {
	unset($_POST['taai_pic']);
	}

	if(!empty($_POST['iato_pic']))
	{
	$iato_pic = $_POST['iato_pic'];
	$id=time().mt_rand().".png";
	$fullpath  =  WWW_ROOT."img".DS."user_travel_certificates".DS.$_POST['user_id'];
	$res1 = is_dir($fullpath);
	if($res1 != 1) {
	$res2= mkdir($fullpath, 0777, true);
	}
	$path = WWW_ROOT."img".DS."user_travel_certificates".DS.$_POST['user_id'].DS.$id;
	file_put_contents($path,base64_decode($iato_pic));
	$_POST['iato_pic'] = $id;
	}
	else {
	unset($_POST['iato_pic']);
	}

	if(!empty($_POST['iso9001_pic']))
	{
	$iso9001_pic = $_POST['iso9001_pic'];
	$id=time().mt_rand().".png";
	$fullpath  =  WWW_ROOT."img".DS."user_travel_certificates".DS.$_POST['user_id'];
	$res1 = is_dir($fullpath);
	if($res1 != 1) {
	$res2= mkdir($fullpath, 0777, true);
	}
	$path = WWW_ROOT."img".DS."user_travel_certificates".DS.$_POST['user_id'].DS.$id;
	file_put_contents($path,base64_decode($iso9001_pic));
	$_POST['iso9001_pic'] = $id;
	}
	else {
	unset($_POST['iso9001_pic']);
	}

	if(!empty($_POST['uftaa_pic']))
	{
	$uftaa_pic = $_POST['uftaa_pic'];
	$id=time().mt_rand().".png";
	$fullpath  =  WWW_ROOT."img".DS."user_travel_certificates".DS.$_POST['user_id'];
	$res1 = is_dir($fullpath);
	if($res1 != 1) {
	$res2= mkdir($fullpath, 0777, true);
	}
	$path = WWW_ROOT."img".DS."user_travel_certificates".DS.$_POST['user_id'].DS.$id;
	file_put_contents($path,base64_decode($uftaa_pic));
	$_POST['uftaa_pic'] = $id;
	}
	else {
	unset($_POST['uftaa_pic']);
	}


	if(!empty($_POST['adtoi_pic']))
	{
	$adtoi_pic = $_POST['adtoi_pic'];
	$id=time().mt_rand().".png";
	$fullpath  =  WWW_ROOT."img".DS."user_travel_certificates".DS.$_POST['user_id'];
	$res1 = is_dir($fullpath);
	if($res1 != 1) {
	$res2= mkdir($fullpath, 0777, true);
	}
	$path = WWW_ROOT."img".DS."user_travel_certificates".DS.$_POST['user_id'].DS.$id;
	file_put_contents($path,base64_decode($adtoi_pic));
	$_POST['adtoi_pic'] = $id;
	}
	else {
	unset($_POST['adtoi_pic']);
	}

	if(!empty($_POST['tafi_pic']))
	{
	$tafi_pic = $_POST['tafi_pic'];
	$id=time().mt_rand().".png";
	$fullpath  =  WWW_ROOT."img".DS."user_travel_certificates".DS.$_POST['user_id'];
	$res1 = is_dir($fullpath);
	if($res1 != 1) {
	$res2= mkdir($fullpath, 0777, true);
	}
	$path = WWW_ROOT."img".DS."user_travel_certificates".DS.$_POST['user_id'].DS.$id;
	file_put_contents($path,base64_decode($tafi_pic));
	$_POST['tafi_pic'] = $id;
	}
	else {
	unset($_POST['tafi_pic']);
	}

	if(!empty($_POST['company_shop_registration_pic']))
	{
	$company_shop_registration = $_POST['company_shop_registration_pic'];
	$id=time().mt_rand().".png";
	$fullpath  =  WWW_ROOT."img".DS."user_docs".DS.$_POST['user_id'];
	$res1 = is_dir($fullpath);
	if($res1 != 1) {
	$res2= mkdir($fullpath, 0777, true);
	}
	$path =  WWW_ROOT."img".DS."user_docs".DS.$_POST['user_id'].DS.$id;
	file_put_contents($path,base64_decode($company_shop_registration));
	$_POST['company_shop_registration_pic'] = $id;
	}
	else {
	unset($_POST['company_shop_registration_pic']);
	}
	if(!empty($_POST['id_card_pic']))
	{
	$id_card = $_POST['id_card_pic'];
	$id=time().mt_rand().".png";
	$fullpath  =  WWW_ROOT."img".DS."user_docs".DS.$_POST['user_id'];
	$res1 = is_dir($fullpath);
	if($res1 != 1) {
	$res2= mkdir($fullpath, 0777, true);
	}
	$path =  WWW_ROOT."img".DS."user_docs".DS.$_POST['user_id'].DS.$id;
	file_put_contents($path,base64_decode($id_card));
	$_POST['id_card_pic'] = $id;
	}
	else {
	unset($_POST['id_card_pic']);
	}


	if(!empty($_POST['company_img_2_pic']))
	{
	$company_img_2 = $_POST['company_img_2_pic'];
	$id=time().mt_rand().".png";
	$fullpath  =  WWW_ROOT."img".DS."user_docs".DS.$_POST['user_id'];
	$res1 = is_dir($fullpath);
	if($res1 != 1) {
	$res2= mkdir($fullpath, 0777, true);
	}
	$path =  WWW_ROOT."img".DS."user_docs".DS.$_POST['user_id'].DS.$id;
	file_put_contents($path,base64_decode($company_img_2));
	$_POST['company_img_2_pic'] = $id;
	}
	else {
	unset($_POST['company_img_2_pic']);
	}



	if(!empty($_POST['company_img_1_pic']))
	{
	$company_img_1 = $_POST['company_img_1_pic'];
	$id=time().mt_rand().".png";
	$fullpath  =  WWW_ROOT."img".DS."user_docs".DS.$_POST['user_id'];
	$res1 = is_dir($fullpath);
	if($res1 != 1) {
	$res2= mkdir($fullpath, 0777, true);
	}
	$path =  WWW_ROOT."img".DS."user_docs".DS.$_POST['user_id'].DS.$id;
	file_put_contents($path,base64_decode($company_img_1));
	$_POST['company_img_1_pic'] = $id;
	}
	else {
	unset($_POST['company_img_1_pic']);
	}

	if(!empty($_POST['pancard_pic']))
	{
	$pancard = $_POST['pancard_pic'];
	$id=time().mt_rand().".png";
	$fullpath  =  WWW_ROOT."img".DS."user_docs".DS.$_POST['user_id'];
	$res1 = is_dir($fullpath);
	if($res1 != 1) {
	$res2= mkdir($fullpath, 0777, true);
	}						
	$path =  WWW_ROOT."img".DS."user_docs".DS.$_POST['user_id'].DS.$id;
	file_put_contents($path,base64_decode($pancard));
	$_POST['pancard_pic'] = $id;
	}
	else {
	unset($_POST['pancard_pic']);
	}

	if(!empty($_POST['profile_pic']))
	{
	$profile_pic = $_POST['profile_pic'];
	$id=time().mt_rand().".png";
	$fullpath  =  WWW_ROOT."img".DS."user_docs".DS.$_POST['user_id'];
	$path =  WWW_ROOT."img".DS."user_docs".DS.$_POST['user_id'].DS.$id;
	$res1 = is_dir($fullpath);
	if($res1 != 1) {
	$res2= mkdir($fullpath, 0777, true);
	}
	file_put_contents($path,base64_decode($profile_pic));
	$_POST['profile_pic'] = $id;
	}
	else {
	unset($_POST['profile_pic']);
	}
	$user = $this->Users->patchEntity($userDetails, $_POST);
	if ($this->Users->save($user)) {
	$result['response_code'] = 200;
	$result['response_object'] = "User has been updated successfully.";
	$data =   json_encode($result);
	echo $data;
	exit;
	} else {
	$result['response_code'] = 200;
	$result['response_object'] = "'Something went wrong please try again.";
	$data =   json_encode($result);
	echo $data;
	exit;
	}
	}
	}

    
	public function addchatapi() {
	if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
	date_default_timezone_set('Asia/Kolkata');
	$this->loadModel('UserChats');
	if($_POST){
	$d = $_POST;
	if(isset($_POST['screen_id'])){
	$d["screen_id"] = $_POST['screen_id'];
	if($d["screen_id"]==1){$res_text = "Please go to MY RESPONSES to view it.";
	}elseif($d["screen_id"]==2)
	{
	$res_text = "Please go to CHECK RESPONSES to view it.";
	}else{
	$res_text = "";
	}
	}else{
	$res_text = "";
	}
	$d["user_id"] = $_POST['user_id'];
	$d["send_to_user_id"] = $d['chat_user_id'];
	$d["created"] = date("Y-m-d h:i:s");
	$UserChat = $this->UserChats->newEntity($d);
	if ($re = $this->UserChats->save($UserChat)) {
	$conn = ConnectionManager::get('default');
	$sql = "SELECT first_name,last_name FROM users	where id='".$_POST['user_id']."'";
	$stmt = $conn->execute($sql);
	$res = $stmt ->fetch('assoc');   
	$name = $res['first_name'].' '.$res['last_name'];
	$push_message = "You have received a CHAT MESSAGE from $name. $res_text";
	$this->sendpushnotification($d['chat_user_id'],$push_message);

	$result['response_code'] = 200;
	$result['response_object'] = "Message sent successfully";
	$data =   json_encode($result);
	echo $data;
	exit;
	} else {
	$result['response_code'] = 500;
	$result['response_object'] = "Message send failed";
	$data =   json_encode($result);
	echo $data;
	exit;
	}
	}
	}else{
	$result = array();
	$result['response_code']= 403;
	echo json_encode($result);
	exit;
	}
	}

	public function acceptofferapi() {
	date_default_timezone_set('Asia/Kolkata');
	$this->loadModel('Requests');
	$this->loadModel('Responses');
	$this->loadModel('User_Chats');
	if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
	$res = 0;
	if(isset($_POST["request_id"]) && !empty($_POST["request_id"]) && !empty($_POST["user_id"])) {
	$TableRequest = TableRegistry::get('Requests');
	$user_from_id = $_POST["user_id"];
	$request = $TableRequest->get($_POST["request_id"]);
	$request->status = 2;
	$request->final_id = $_POST["response_id"];
	$request->response_id = $_POST["response_id"];
	if ($TableRequest->save($request)) {
	$TableResponse = TableRegistry::get('Responses');
	$response = $TableResponse->get($_POST["response_id"]);
	$send_to_user_id = $response['user_id'];
	$response->status = 1;
	$TableResponse->save($response);
	$res = 1;
	if($res==1)
	{
	$request_id = $_POST["request_id"];
	$TableUser = TableRegistry::get('Users');
	$user = $TableUser->get($user_from_id);
	$name = $user['first_name'].' '.$user['last_name'];
	$message = "<span class='rec_name'>$name</span> has accepted your offer. Please CLICK HERE to add a Review for $name";
	$msg = "$name has accepted your offer. Please CLICK HERE to add a Review for $name.";
	$userchatTable = TableRegistry::get('User_Chats');
	$userchats = $userchatTable->newEntity();
	$userchats->request_id = $request_id;
	$userchats->user_id = $user_from_id;
	$userchats->send_to_user_id = $send_to_user_id;
	$userchats->message = $message;
	$userchats->created = date("Y-m-d h:i:s");
	$userchats->notification = 1;
	if ($userchatTable->save($userchats)) {
	$this->sendpushnotification($send_to_user_id,$msg);
	}
	}
	$result['response_code'] = 200;
	$result['response_object'] =$res;
	$data =   json_encode($result);
	echo $data;
	exit;
	}
	}
	}else{
	$result = array();
	$result['response_code']= 403;
	echo json_encode($result);
	exit;
	}
	}
	public function sharedetailsapi() {  
	if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
	date_default_timezone_set('Asia/Kolkata');
	$this->loadModel('Responses');
	$this->loadModel('UserChats');
	$res = 0;
	if(isset($_POST["response_id"]) && !empty($_POST["response_id"])  && !empty($_POST["login_user_id"]) ) { 
	$TableResponse = TableRegistry::get('Responses');
	 
	$response = $TableResponse->get($_POST ["response_id"]);
	 
	$response->is_details_shared = 1;
	
	if ($TableResponse->save($response)) { 
		$user_from_id = $_POST['login_user_id'];
		$TableUser = TableRegistry::get('Users');
		$user = $TableUser->get($user_from_id);
		$name = $user['first_name'].' '.$user['last_name'];
		$message = "<span class='rec_name'>".$name."</span> has shared his Contact Info. Please go to MY RESPONSES tab to view it.";
		$msg = "$name has shared his Contact Info. Please go to MY RESPONSES tab to view it.";
		$send_to_user_id = $_POST['sharewith_user_id'];
		$userchatTable = TableRegistry::get('User_Chats');
		$userchats = $userchatTable->newEntity();
		$userchats->request_id = $_POST["request_id"];
		$userchats->user_id = $user_from_id;
		$userchats->send_to_user_id = $send_to_user_id;
		$userchats->message = $message;
		$userchats->created = date("Y-m-d h:i:s");
		$userchats->notification = 1;
		if ($userchatTable->save($userchats)) {
		$this->sendpushnotification($send_to_user_id,$msg);
		$id = $userchats->id;
		$res = 1;
		}
		$res = 1;
	}
	}
	$result['response_code'] = 200;
	$result['response_object'] = $res;
	$data = json_encode($result);
	echo $data;
	exit;
	}else {
	echo "Invalid Access";   
	exit;
	}
	}
	public function membershipsapi(){
     	 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
        $this->loadModel('Membership');
        $memberships = $this->Membership->find()->where(['status' => 1])->all();
        $membershipsjson = json_encode($memberships);
      echo $membershipsjson;
      exit;
      } 	 else {
      echo "Invalid Access";   
      exit;
    }
     }
	
    public function addtestimonialapi() {
  if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
 	date_default_timezone_set('Asia/Kolkata');
        $this->loadModel('Testimonial');
	     if ($this->request->is(['post', 'put'])) {
			 $conn = ConnectionManager::get('default');
	      $authoruserId = $_POST['user_id'];
	      $reviewuserId =  $_POST['profileuser_id'];
			$request_id= $_POST['request_id'];
			 $sql = "SELECT *,COUNT(*) as ts_count FROM testimonial 
WHERE request_id='".$request_id."' AND author_id='".$authoruserId."'
ANd user_id = '".$reviewuserId."' "; 
$stmt = $conn->execute($sql);
$resultt = $stmt ->fetch('assoc');
	if($resultt['ts_count']==0){		 
			 
			 
			$testimonialTable = TableRegistry::get('Testimonial');
			$testimonial = $testimonialTable->newEntity();
			$testimonial->author_id = $authoruserId;
			$testimonial->user_id = $reviewuserId;
			$testimonial->rating = $_POST['rating'];
			 if(isset( $_POST['request_id'])){
			$testimonial->request_id = $_POST['request_id'];
			 }
			$testimonial->comment = $_POST['comment'];
			$testimonial->status =  '0';
			$testimonial->created_at = date("Y-m-d H:i:s");
			if ($testimonialTable->save($testimonial)) {
    		$res =1;
    		$result['response_code'] = 200;
			$result['response_object'] =$res;
    		$data =   json_encode($result);
      	echo $data;
      	exit;
			}
		}else{
	$sql = "UPDATE testimonial SET rating='".$_POST['rating']."',
	updated_at='".date("Y-m-d H:i:s")."',comment='".$_POST['comment']."'
	WHERE id='".$resultt['id']."'";
	$stmt = $conn->execute($sql);
		$res =1;
    		$result['response_code'] = 200;
			$result['response_object'] =$res;
    		$data =   json_encode($result);
      	echo $data;
      	exit;
	}
		}
	}else {
      echo "Invalid Access";   
      exit;
    }
    }
    
    public function addresponseapi() {
    		 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
    		date_default_timezone_set('Asia/Kolkata');
        	$this->loadModel('Responses');
        	$this->loadModel('Requests');
			$this->loadModel('User_Chats');
			$this->loadModel('BlockedUsers');
        if($_POST){
			$d = $_POST;
			$d["user_id"] = $_POST["user_id"];
			$d["status"] = 0;
			$TableRequest = TableRegistry::get('Requests');
			$request = $TableRequest->get($d["request_id"]);
			
			$user = $this->Users->find()->where(['id' => $_POST["user_id"]])->first();
			//print_r($d); die();
			$response = $this->Responses->newEntity($d);
			if ($re = $this->Responses->save($response)) {
			
			$name = $user['first_name'].' '.$user['last_name'];
			$ref_id = $request['reference_id'];
			$message = "You have received a Response for Reference ID: $ref_id. Please go to MY REQUESTS tab to view it.";	
			$userchatTable = TableRegistry::get('User_Chats');
			$userchats = $userchatTable->newEntity();
			$userchats->request_id = $request["id"];
			$userchats->user_id = $d["user_id"];
			$userchats->send_to_user_id = $request["user_id"];
			$userchats->message = $message;
			$userchats->created = date("Y-m-d h:i:s");
			$userchats->notification = 1;
			if ($userchatTable->save($userchats)) {
			$this->sendpushnotification($request["user_id"],$message);
			}
				
			$res =1;
    		$result['response_code'] = 200;
			$result['response_object'] =$res;
    		$data =   json_encode($result);
      	echo $data;
      	exit;
			} else {
			$res =0;
    		$result['response_code'] = 200;
			$result['response_object'] =$res;
    		$data =   json_encode($result);
      	echo $data;
      	exit;
			}
		}else{
		$result = array();
      $result['response_code']= 501;
    	echo json_encode($result);
     	exit;
    	 }
		}else{
		$result = array();
      $result['response_code']= 403;
    	echo json_encode($result);
     	exit;
		}
    }
	
	public function getHotelCategories() {
   	 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
        $categories = array("1"=>"Corporate Hotel", "2"=>"Boutique Hotel", "3"=>"Heritage Hotel", "4"=>"House Boat", "5"=>"Resort", "6"=>"Eco Resort", "7"=>"Farm-stay", "8"=>"Homestay", "9"=>"Heritage Homestay", "10"=>"Camping", "11"=>"Glamping", "12"=>"Dormitory");
			$result['response_code'] = 200;
			$result['response_object'] =$categories;
    		$data =   json_encode($result);
      	echo $data;
      	exit;
      	}else{
		$result = array();
      $result['response_code']= 403;
    	echo json_encode($result);
     	exit;
		}
    }
	public function getHotelMealplans() {
   	 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
        $categories = array("1"=>"Select Meal Plan", "2"=>"EP - European Plan", "3"=>"CP - Contenental Plan", "4"=>"MAP - Modified American Plan", "5"=>"AP - American Plan");
			$result['response_code'] = 200;
			$result['response_object'] =$categories;
    		$data =   json_encode($result,true);
      	echo $data;
      	exit;
      	}else{
		$result = array();
      $result['response_code']= 403;
    	echo json_encode($result);
     	exit;
		}
    }
	public function getHotelCities()
    {
    	 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
    		$this->loadModel('Cities');
    		$cities = $this->Cities->getAllCities();
    		$allCityList = array();
    		$allCities = array();
		if(!empty($cities)){
			foreach($cities as $city) {
				if($this->checkcityslot($city['id']) < 50){
				$usercount = $this->Users->getAllUserCount($city['id']);
				if($usercount>0){
				$allCities[] = array("label"=>str_replace("'", "", $city['name']),"usercount" => $usercount, "value"=>$city['id'],"price"=>$city['price'], "state_id"=>$city['state_id'], "state_name"=>$city['state']->state_name, "country_id"=>101, "country_name"=>"India");
				}				
				$allCityList[$city['id']] = $city['name'];
				}
			}
			$result['response_code'] = 200;
			$result['response_object'] =$allCities;
    		$data =   json_encode($result);
      	echo $data;
      	exit;
				}
    	}else{
		$result = array();
      $result['response_code']= 403;
    	echo json_encode($result);
     	exit;
		}
    }
    
		public function addpromotionapi(){
		if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
		date_default_timezone_set('Asia/Kolkata');
		if ($_POST) {
		$PromotionsTable = TableRegistry::get('Promotion');
		$Promotion = $PromotionsTable->newEntity();
		//print_r($this->request->data);
		if(!empty($_POST['hotel_pic']))
		{
		$hotel_pic = $_POST['hotel_pic'];
		$id=time().mt_rand().".png";

		$decoded=base64_decode($hotel_pic);

		$path =  WWW_ROOT."img".DS."hotels/".$id;
		file_put_contents($path,$decoded);
		$hotel_image = $id;
		}
		else {
		$hotel_image = "";
		}
		$Promotion->user_id = $_POST['user_id'];
		$Promotion->hotel_name =  $_POST['hotel_name'];
		$Promotion->hotel_type =  $_POST['hotel_categories'];
		$Promotion->cheap_tariff =  $_POST['cheap_tariff'];
		$Promotion->expensive_tariff =  $_POST['expensive_tariff'];
		$Promotion->website =  $_POST['website'];
		$Promotion->hotel_location =  $_POST['hotel_location'];
$cities = explode(",",$_POST['cityid']);
			$citiesarray = array();
			$promoted_cities = array();
			foreach($cities as $city)
			{
			$citystatus = $this->getcitystatus($_POST['user_id'],$city,$_POST['duration']);
				if($citystatus==1){
				$citiesarray[] = $city;
				}else{
				$promoted_cities[] = $city;
				}
			}
if(empty($promoted_cities)){
		$Promotion->cities =   $_POST['cityid'];
		$Promotion->citycharge =   $_POST['citycharge'];
		$Promotion->duration =  $_POST['duration'];
$total_days = 30*$_POST['duration'];
		$Promotion->hotel_pic =  $hotel_image;
		$Promotion->expiry_date = date('Y-m-d H:i:s', strtotime('+'.$total_days.' days'));
		$Promotion->charges =  $_POST['charges'];
		//$Promotion->hotel_name = $_POST['hotel_name'];
		$Promotion->payment_status =  'pending';
		$Promotion->status =  '0';
		$Promotion->created_at = date("Y-m-d H:i:s");
		if ($PromotionsTable->save($Promotion)) {
		$result['response_code'] = 200;
		$result['response_object'] = "Hotel Promotion Successful.";
		$data =   json_encode($result);
		echo $data;
		exit;
		}
                }else{
		$result = array();
		$result['response_code']= 501;
$result['response_object'] = "Hotel Promotion Unsuccessful.";
		echo json_encode($result);
		exit;
		}
		}else{
		$result = array();
		$result['response_code']= 501;
$result['response_object'] = "Hotel Promotion Unsuccessful.";
		echo json_encode($result);
		exit;
		}
		}else{
		$result = array();
		$result['response_code']= 403;
		echo json_encode($result);
		exit;
		}
		}

public function getcitystatus($userid,$cityid,$duration) {
	date_default_timezone_set('Asia/Kolkata');
	$customduration = 12;
	$total_days = 30*$customduration;
	$conn = ConnectionManager::get('default');
	$start_date = date('Y-m-d H:i:s');
	$expiry_date = date('Y-m-d H:i:s', strtotime('+'.$total_days.' days'));
	$sql = "SELECT * FROM promotion WHERE 
	(expiry_date BETWEEN '".$start_date."' AND '".$expiry_date."')	AND
	user_id='".$userid."' AND FIND_IN_SET ('".$cityid."', cities) > 0 ";
	$stmt = $conn->execute($sql);
	$result = $stmt ->fetchAll('assoc');
	if(count($result)==0){
		return 1;
	}else{
	return 0;
	}
}

public function checkcitystatusapi () {
date_default_timezone_set('Asia/Kolkata');
if ($_POST) {
$customduration = 12;
	$user_id = $_POST['user_id'];
	$city_id = $_POST['city_id'];
	$duration = $_POST['duration'];
$total_days = 30*$customduration;
	$conn = ConnectionManager::get('default');
	$start_date = date('Y-m-d H:i:s');
$expiry_date = date('Y-m-d H:i:s', strtotime('+'.$total_days.' days'));
	$sql = "SELECT * FROM promotion WHERE 
	(expiry_date BETWEEN '".$start_date."' AND '".$expiry_date."')	AND
	user_id='".$user_id."' AND FIND_IN_SET ('".$city_id."', cities) > 0 ";
	$stmt = $conn->execute($sql);
	$result = $stmt ->fetchAll('assoc');
	if(count($result)==0){
		$res = array();
		$res['response_code'] = 200;
		$res['response_object'] = "Success";
		echo json_encode($res);
     	exit;
	}else{
		$query ="Select name FROM cities where id='".$city_id."'";
		$stmt = $conn->execute($query);
		$result = $stmt ->fetch('assoc');
		$city_name = $result['name'];
		$res = array();
		$res['response_code'] = 200;
		$res['response_object'] = "Promotion is already running for $city_name, please choose another city.";
		echo json_encode($res);
     	exit;
	}
	die();
	}
}    

		public function promotionreportsapi() {
		if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
		$user_id = $_POST['user_id'];
		$this->loadModel('Promotion');
		$this->loadModel('Requests');
		$this->loadModel('Responses');
		$this->loadModel('Cities');
		$this->loadModel('States');
		$this->loadModel('User_Chats');
		$promotion =  $this->Promotion->find()->where(['user_id' => $user_id])->all();

		$allCities = $this->Cities->find('list',['keyField' => 'id', 'valueField' => 'name'])
		->hydrate(false)
		->toArray();

		$allCities1 = $this->Cities->find('list',['keyField' => 'id', 'valueField' => 'state_id'])
		->hydrate(false)
		->toArray();

		$allStates = $this->States->find('list',['keyField' => 'id', 'valueField' => 'state_name'])
		->hydrate(false)
		->toArray();	
		$resdata = array();	  
		foreach($promotion as $pr)
		{
		if($pr['cities']!==""){
		$cityarray = explode(',',$pr['cities']);
		foreach($cityarray as $cityid){
		$state_id = $allStates[$allCities1[$cityid]];
		$resultstr[] = $allCities[$cityid].' ('.$state_id.')';
		}

		//echo implode(", ",$resultstr);
		$resdata[$pr['id']]  = implode(", ",$resultstr);
		}else{
		$resdata[$pr['id']]  = "";
		}
		$resultstr ='';
		}
		// print_r($resdata); die();
		$result['response_code'] = 200;
		$result['response_object'] = $promotion;
		$result['citystate'] = $resdata;
		$data =   json_encode($result);
		echo $data;
		exit;
		}else{
		$result = array();
		$result['response_code']= 403;
		echo json_encode($result);
		exit;
		}
		}

		public function sendreqapi(){
		date_default_timezone_set('Asia/Kolkata');
		$this->loadModel('Requests');
		$this->loadModel('Responses');
		$this->loadModel('RequestStops');
		$this->loadModel('Hotels');
		$this->loadModel('User_Chats');
		$user = $this->Users->find()->where(['id' => $_POST['user_id']])->first();
		$myRequestCount = $myReponseCount = 0;
		$myfinalCount  = 0;

		$query3 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $_POST['user_id'], "Requests.is_deleted"=>0,"Requests.status "=>2]]);
		$myfinalCount = $query3 ->count();
		$this->set('myfinalCount', $myfinalCount );		

		$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $_POST['user_id'], "Requests.status !="=>2, "Requests.is_deleted"=>0]]);
		$myRequestCount = $query->count();
		$myRequestCount1 = $query->count(); 

		$delcount=0;
		$requests = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $_POST['user_id'], "Requests.is_deleted"=>1]]);
		foreach($requests as $req){
		$rqueryr = $this->Responses->find('all', ['conditions' => ['Responses.request_id' =>$req['id']]]);
		if($rqueryr->count()!=0){
		$delcount++;
		}
		}
		$reqcount = $this->getSettings('requestcount');
		$plcreqcount = (($reqcount['value']-$myRequestCount1)-($delcount+ $myfinalCount));
		if($myRequestCount1 >=50){
		$result = array();
		$result['response_code'] = 500;
		$result['response_object'] = "Alert! You have exceeded the count of 50 permissible open requests. You must Finalize a Request or Remove a Request, in the My Requests section, in order to proceed with placing a request.";
		$data = json_encode($result);
		echo $data;
		exit;
		}elseif($plcreqcount<=0){
		$result = array();
		$result['response_code'] = 500;
		$result['response_object'] = 'You have used up the '.$reqcount["value"] .' requests for the trial period, please contact us to increase your quota.';
		$data = json_encode($result);
		echo $data;
		exit;
		}elseif($myRequestCount < 100) {
		if($_POST){
		$d = $_POST;
		$d['check_in'] = (isset($d['check_in']) && !empty($d['check_in']))?$this->ymdFormatByDateFormat($d['check_in'], "d-m-Y", $dateSeparator="/"):null;
		$d['check_out'] = (isset($d['check_out']) && !empty($d['check_out']))?$this->ymdFormatByDateFormat($d['check_out'], "d-m-Y", $dateSeparator="/"):null;

		$d['start_date'] = (isset($d['start_date']) && !empty($d['start_date']))?$this->ymdFormatByDateFormat($d['start_date'], "d-m-Y", $dateSeparator="/"):null;
		$d['end_date'] = (isset($d['end_date']) && !empty($d['start_date']))?$this->ymdFormatByDateFormat($d['end_date'], "d-m-Y", $dateSeparator="/"):null;

		if($_POST['category_id'] == 2 ){
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
		$p['user_id'] = $_POST['user_id'];
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
		ksort($d['stops']);
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
		$sql = "SELECT * FROM users WHERE id !='".$_POST['user_id']."' AND role_id in ('1')  AND FIND_IN_SET ('".$p['pickup_state']."', preference) > 0 ";
		$stmt = $conn->execute($sql);
		$Userlist = $stmt ->fetchAll('assoc');
		foreach($Userlist as $usr)
		{
		$sql1="Select count(*) as block_count from blocked_users where blocked_user_id='".$usr['id']."' AND blocked_by='".$_POST['user_id']."'";
		$stmt = $conn->execute($sql1);
		$bresult = $stmt ->fetch('assoc');
		if($bresult['block_count']==0){
		$userchats = $userchatTable->newEntity();
		$userchats->request_id = $ui;
		$userchats->user_id = $_POST['user_id'];
		$userchats->send_to_user_id = $usr["id"];
		$userchats->message = "You have received a Request! Please go to RESPOND TO REQUEST tab to view it.";
		$userchats->created = date("Y-m-d h:i:s");
		$userchats->notification = 1;;
		if ($userchatTable->save($userchats)) {
		$this->sendpushnotification($usr["id"],$userchats->message);
		$id = $userchats->id;
		}
		}
		}						

		$result['response_code'] = 200;
		$result['response_object'] = "Congratulations! Your request has been submitted successfully.";
		$data = json_encode($result);
		echo $data;
		exit;

		} else {
		$result['response_code'] = 500;
		$result['response_object'] = "Sorry.";
		$data = json_encode($result);
		echo $data;
		exit;
		}
		} elseif($_POST['category_id'] == 1 ){

		$p['transport_requirement'] = $d['transport_requirement'];


		if($d['pickup_city_id']==""){ 

		$p['pickup_city'] = 0;

		} else {

		$p['pickup_city'] = $d['pickup_city_id'];

		}


		$p['pickup_state'] = $d['pickup_state_id'];
		$p['pickup_country'] = $d['pickup_country_id'];
		$p['pickup_locality'] = $d['pickup_locality'];
		$p['final_locality'] = $d['finalLocality'];
		if($d['p_final_city_id']==""){ 

		$p['final_city'] = 0;

		} else {

		$p['final_city'] = $d['p_final_city_id'];

		}

		if($d['p_final_state_id']==""){ 

		$p['final_state'] = 0;

		} else {

		$p['final_state'] = $d['p_final_state_id'];

		}



		$p['start_date'] = $d['start_date'];
		$p['end_date'] = $d['end_date'];
		$p['comment'] = $d['comment'];
		$p['category_id'] = $d['category_id'];
		$p['reference_id'] = $d['reference_id'];
		$p['user_id'] = $_POST['user_id'];
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
		$p['hotel_category'] = $d['hotel_category'];
		//$p['meal_plan'] = $d['meal_plan'] = (isset($d['meal_plan']) && !empty($d['meal_plan']))?implode(",", $d['meal_plan']):"";
		$p['meal_plan'] = $d['meal_plan'];
		//$p['stops'] = $d['stops'] = (isset($d['stops']) && !empty($d['stops']))?implode(",", $d['stops']):"";
		$stopes = "";
		if(isset($d['stops'])) {
		ksort($d['stops']);
		foreach($d['stops'] as $key=>$row) {
		$stopes .=  $row.",";
		}
		}

		$p['stops'] = $stopes;
		$p['check_in'] =  $d['check_in'];
		$p['check_out'] =  $d['check_out'];
		//pr($p);pr($d); exit;
		$contact = $this->Requests->newEntity($p);
		if ($re = $this->Requests->save($contact)) {
		$ui = $re->id;
		$d['req_id'] = $ui;
		$d['user_id'] = $_POST['user_id'];
		$rest = $this->Hotels->newEntity($d);
		$this->Hotels->save($rest);//exit;
		if(isset($d['hh_room1'])) {
		ksort($d['hh_room1']);
		foreach($d['hh_room1'] as $key=>$row) {
		$hotalExtraData['req_id'] = $ui;
		$hotalExtraData['user_id'] = $_POST['user_id'];

		$hotalExtraData['room1'] = $d['hh_room1'][$key];
		$hotalExtraData['room2'] =  $d['hh_room2'][$key];
		$hotalExtraData['room3'] =  $d['hh_room3'][$key];
		$hotalExtraData['child_with_bed'] =  $d['hh_child_with_bed'][$key];
		$hotalExtraData['child_without_bed'] =  $d['hh_child_without_bed'][$key];
		$hotalExtraData['hotel_rating'] = $d['hh_hotel_rating'][$key];
		$hotalExtraData['hotel_category'] = $d['hh_hotel_category'][$key];
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
		if(isset($d['stops'])) {
		ksort($d['stops']);
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
		$sql = "SELECT * FROM users WHERE id !='".$_POST['user_id']."' AND role_id in ('1') AND FIND_IN_SET ('".$p['state_id']."', preference) > 0 ";
		$stmt = $conn->execute($sql);
		$Userlist = $stmt ->fetchAll('assoc');
		foreach($Userlist as $usr)
		{
		$sql1="Select count(*) as block_count from blocked_users where blocked_user_id='".$usr['id']."' AND blocked_by='".$_POST['user_id']."'";
		$stmt = $conn->execute($sql1);
		$bresult = $stmt ->fetch('assoc');
		if($bresult['block_count']==0){
		$userchats = $userchatTable->newEntity();
		$userchats->request_id = $ui;
		$userchats->user_id = $_POST['user_id'];
		$userchats->send_to_user_id = $usr["id"];
		$userchats->message = "You have received a Request! Please go to RESPOND TO REQUEST tab to view it.";
		$userchats->created = date("Y-m-d h:i:s");
		$userchats->notification = 1;;
		if ($userchatTable->save($userchats)) {
		$id = $userchats->id;
		$this->sendpushnotification($usr["id"],$userchats->message);
		}
		}
		}


		$result['response_code'] = 200;
		$result['response_object'] = "Congratulations! Your request has been submitted successfully.";
		$data = json_encode($result);
		echo $data;
		exit;
		} else {
		$result['response_code'] = 500;
		$result['response_object'] = "Sorry.";
		$data = json_encode($result);
		echo $data;
		exit;
		}
		} elseif($_POST['category_id'] == 3 ){
		$p['category_id'] = $d['category_id'];
		$p['reference_id'] = $d['reference_id'];
		$p['user_id'] = $_POST['user_id'];
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
		$p['hotel_category'] = $d['hotel_category'] ;

		$p['meal_plan'] = $d['meal_plan'];
		$p['check_in'] =  $d['check_in'];
		$p['check_out'] =  $d['check_out'];
		$p['hotel_rating'] = $d['hotel_rating'];
		$p['comment'] = $d['comment'];


		$contact = $this->Requests->newEntity($p);
		if ($re = $this->Requests->save($contact)) {
		$ui = $re->id;
		$d['req_id'] = $ui;
		$d['user_id'] = $_POST['user_id'];
		$rest = $this->Hotels->newEntity($d);
		$this->Hotels->save($rest);//exit;

		/*Users List */
		$userchatTable = TableRegistry::get('User_Chats');
		$conn = ConnectionManager::get('default');
		/*For Travel Agent*/	
		$sql = "SELECT * FROM users WHERE id !='".$_POST['user_id']."' AND role_id in ('1') AND FIND_IN_SET ('".$p['state_id']."', preference) > 0 ";
		$stmt = $conn->execute($sql);
		$Userlist = $stmt ->fetchAll('assoc');
		foreach($Userlist as $usr)
		{
		$sql1="Select count(*) as block_count from blocked_users where blocked_user_id='".$usr['id']."' AND blocked_by='".$_POST['user_id']."'";
		$stmt = $conn->execute($sql1);
		$bresult = $stmt ->fetch('assoc');
		if($bresult['block_count']==0){	
		$userchats = $userchatTable->newEntity();
		$userchats->request_id = $ui;
		$userchats->user_id = $_POST['user_id'];
		$userchats->send_to_user_id = $usr["id"];
		$userchats->message = "You have received a Request! Please go to RESPOND TO REQUEST tab to view it.";
		$userchats->created = date("Y-m-d h:i:s");
		$userchats->notification = 1;;
		if ($userchatTable->save($userchats)) {
		$id = $userchats->id;
		$this->sendpushnotification($usr["id"],$userchats->message);
		}
		}
		}
		/*For Travel Agent*/
			
		/*For Hotelier*/
		$sqlh = "SELECT * FROM users WHERE id !='".$_POST['user_id']."' AND role_id in ('3') AND city_id='".$p['city_id']."'";
		$stmth = $conn->execute($sqlh);
		$Userlisth = $stmth->fetchAll('assoc');
		foreach($Userlisth as $usrh)
		{
		$sql1="Select count(*) as block_count from blocked_users where blocked_user_id='".$usrh['id']."' AND blocked_by='".$_POST['user_id']."'";
		$stmt = $conn->execute($sql1);
		$bresult = $stmt ->fetch('assoc');
		if($bresult['block_count']==0){
			$userchats = $userchatTable->newEntity();
		$userchats->request_id = $ui;
		$userchats->user_id = $_POST['user_id'];
		$userchats->send_to_user_id = $usrh["id"];
		$userchats->message = "You have received a Request! Please go to RESPOND TO REQUEST tab to view it.";
		$userchats->created = date("Y-m-d h:i:s");
		$userchats->notification = 1;;
		if ($userchatTable->save($userchats)) {
		$id = $userchats->id;
		$this->sendpushnotification($usrh["id"],$userchats->message);
		}
			}
		}
		/*For Hotelier*/


		$result['response_code'] = 200;
		$result['response_object'] = "Congratulations! Your request has been submitted successfully.";
		$data = json_encode($result);
		echo $data;
		exit;

		} else {
		$result = array();
		$result['response_code'] = 500;
		$result['response_object'] = "Sorry.";
		$data = json_encode($result);
		echo $data;
		exit;
		}
		}
		}
		} else {
		$result['response_code'] = 500;
		$result['response_object'] = "Sorry you can not add more then 100.";
		$data = json_encode($result);
		echo $data;
		exit;
		}
		}
	public function getchatNotification()
	{
	if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
	$user_id = $_POST['user_id'];
	$unreadnotification = array();
	$conn = ConnectionManager::get('default');
	$sql = "Select CONCAT(u.`first_name`,' ',u.`last_name` ) as sender_name,c.* FROM user_chats as c 
			INNER JOIN users as u on u.id=c.user_id
			where c.is_read='0' AND c.send_to_user_id='".$user_id."'
			order by c.created DESC ";
	$stmt = $conn->execute($sql);
	$unreadnotification = $stmt ->fetchAll('assoc');
	$countchat = count($unreadnotification);
	
	
		 $result['response_code'] = 200;
		  $result['response_object'] = $unreadnotification;
		   $result['unread_count'] = $countchat;
    	  $data =   json_encode($result);
        echo $data;
        exit;
		}else{
		$result = array();
     	$result['response_code']= 403;
    	echo json_encode($result);
     	exit;
		}
	}
	
	public function clearreadChatsapi(){
		 if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
		$conn = ConnectionManager::get('default');
		date_default_timezone_set('Asia/Kolkata');
		$user_id = $_POST['user_id'];
		$sql="UPDATE user_chats SET is_read='1',read_date_time='".date("Y-m-d h:i:s")."' 
		where send_to_user_id='".$user_id."' AND is_read=0";
		$stmt = $conn->execute($sql);
		$result = array();
		$result['response_code'] = 200;
		$result['response_object'] = 'Success';
    	$data =   json_encode($result);
        echo $data;
        exit;
		}else{
		$result = array();
     	$result['response_code']= 403;
    	echo json_encode($result);
     	exit;
		}
	}
		public function promotioncountsapi() {
		if(isset($_GET['token']) AND base64_decode($_GET['token'])=='321456654564phffjhdfjh') {
		$id = $_POST['promotion_id'];
		$this->loadModel('Promotion');
		$query =  $this->Promotion->find()->where(['id' => $id])->first();
		$nextcount =  $query['count'] + 1;
		$this->Promotion->updateAll(
		array('count' => $nextcount),
		array('id' => $id)
		);
		$result = array();
		$result['response_code'] = 200;
		$result['response_object'] = 'Success';
		$data =   json_encode($result);
		echo $data;
		exit;
		}else{
		$result = array();
		$result['response_code']= 403;
		echo json_encode($result);
		exit;
		}
		}
		public function sendpushnotification($userid,$message)
		{
		$conn = ConnectionManager::get('default');
		$sql = "Select device_id FROM users where id='".$userid."'";
		$stmt = $conn->execute($sql);
		$user = $stmt ->fetch('assoc');
		$deviceid = $user['device_id'];
		if(!empty($deviceid)){

		$sql1 = "Select count(*) as countchat FROM user_chats as c 
		INNER JOIN users as u on u.id=c.user_id
		where c.is_read='0' AND c.send_to_user_id='".$userid."'
		order by c.created DESC ";
		$stmt1 = $conn->execute($sql1);
		$countchat = $stmt1 ->fetch('assoc');
		if(!defined('API_ACCESS_KEY')){
		define('API_ACCESS_KEY', 'AIzaSyA5mzBqngPlq220FYB8Cr2O4y79RH4i9s4');
		}

		$registrationIds =  $deviceid;
		$msg = array
		(
		'body' 	=> $message,
		'title'	=> 'Travelb2bhub Notification',
		'icon'	=> 'myicon',/*Default Icon*/
		'sound' => 'mySound',/*Default sound*/
                "unread_count" => $countchat 
		);
		$data = array
		(

		"unread_count" => $countchat
		);
		$fields = array('to'=> $registrationIds,
		'notification'=> $msg,
		'data' => $msg
		);
		$headers = array(
		'Authorization: key=' . API_ACCESS_KEY,
		'Content-Type: application/json'
		);

		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		//print_r($result); die();
		return $result;
		}
		}
	
		public function testimonialapi() {
		$result = array();
		$this->loadModel('Testimonial');
		$this->loadModel('Promotion');
		$this->loadModel('Users');
		$usercity = $this->Users->find()->select(['city_id'])->where(['id' => $_POST['user_id']])->first();
		$cityid =  $usercity['city_id'];
		$advertisement1 = $this->Promotion->find()->where(['status' => 1,'FIND_IN_SET(\''.  $cityid .'\',cities)'])->all();
		$result['advertisement'] = $advertisement1 ;
		$user = $this->Users->find()
		->contain(["Credits"])
		->where(['Users.id' => $_POST['user_id']])->first();
		$testimonials = $this->Testimonial->find()->where(['status' => 1,'user_id'=> $_POST['user_id']])->all();
		$testimoniallist = array();
		$alltestimonials = array();
		if(!empty($testimonials)) {
		foreach($testimonials as $testimonial) {
		$users = $this->Users->find()->where(['status' => 1,'id'=> $testimonial['author_id']])->first();
		$name = $users['first_name']." ".$users['last_name'];
		$alltestimonials[] = array( "name"=>$name, "description"=>$users['description'], "profile_pic"=>$users['profile_pic'], "comment"=>$testimonial['comment'],"user_id"=>$testimonial['user_id'],"author_id"=>$testimonial['author_id']);
		}
		$result['response_code'] = 200;
		$result['response_object'] = $alltestimonials;
		$result['description1'] = $user['description'] ;

		$result['userprofile'] = $user;

		$data =   json_encode($result);
		echo $data;
		exit;
		}
		$result['response_code'] = 500;
		echo $result;
		exit;
		}

}