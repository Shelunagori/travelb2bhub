<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Admins Controller
 *
 * @property \App\Model\Table\AdminsTable $Admins
 */
class AdminsController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		 
		$loginId=$this->Auth->User('id');  
		if(!empty($loginId)){
			$first_name=$this->Auth->User('first_name');
			$last_name=$this->Auth->User('last_name');
			$profile_pic=$this->Auth->User('profile_pic');  
			$authUserName=$first_name.' '.$last_name;
			$this->set('MemberName',$authUserName);
			$this->set('profile_pic', $profile_pic);
			$this->set('loginId',$loginId); 
		}
	} 
	public function dashboard()
    {
		$this->viewBuilder()->layout('admin_layout');
		$loginId=$this->Auth->User('id');
		//-- counts
		$valid_date=date('Y-m-d');
		$PackagePromotionCount = $this->Admins->PostTravlePackages->find()
			->where(['valid_date >=' => $valid_date,'is_deleted'=>0])->count();
		$this->set('PackagePromotionCount', $PackagePromotionCount);	
		
		$TaxiPromotionCount = $this->Admins->TaxiFleetPromotions->find()
			->where(['TaxiFleetPromotions.visible_date >=' => $valid_date,'is_deleted'=>0])->count();
		$this->set('TaxiPromotionCount', $TaxiPromotionCount);
		
		$EventPromotionCount = $this->Admins->EventPlannerPromotions->find()
			->where(['EventPlannerPromotions.visible_date >=' => $valid_date,'is_deleted'=>0])->count();
		$this->set('EventPromotionCount', $EventPromotionCount);
		
		$HotelPromotionCount = $this->Admins->HotelPromotions->find()
			->where(['HotelPromotions.visible_date >=' => $valid_date,'is_deleted'=>0])->count();
		$this->set('HotelPromotionCount', $HotelPromotionCount);
		//---
		$this->loadModel('Testimonial'); 
		$TestimonialCount=$this->Testimonial->find()->count();
		$this->set('TestimonialCount', $TestimonialCount);
		
		$this->loadModel('Requests'); 
		$RequestsCount=$this->Requests->find()->contain(['Users','Cities','States','Categories'])->count();
		$this->set('RequestsCount', $RequestsCount);
		
		$this->loadModel('Responses');
		$ResponsesCount=$this->Responses->find()->where(['is_deleted'=>0])->count();
		$this->set('ResponsesCount', $ResponsesCount);
		
		$UsersCount=$this->Users->find()->where(['is_deleted'=>0])->count();
		$this->set('UsersCount', $UsersCount);
		
		
    }
 	public function changePassword()
    {
		$this->viewBuilder()->layout('admin_layout');
		$loginId=$this->Auth->User('id');
		if ($this->request->is('post')) {
			if(isset($this->request->data['own_password'])){
				$Admins = $this->Admins->find()->where(['id' => $loginId])->first();
				$verify = (new \Cake\Auth\DefaultPasswordHasher)->check($this->request->data['old_password'], $Admins->password);
				if($verify) {
					$result = $this->Admins->patchEntity($Admins, ['password' => $this->request->data['password']]);
					if ($this->Admins->save($result)) {
						$this->Flash->success(__('Your password has been changed successfully.'));
						return $this->redirect(['action' => 'changePassword']);
					}
				} else {
					$this->Flash->error(__('Current Password does not matched.'));
					return $this->redirect(['action' => 'changePassword']);
				}
			}
			if(isset($this->request->data['other_password'])){
 				$userid=$this->request->data['userid'];
				$Users = $this->Users->find()->where(['id' => $userid])->first();
				$result = $this->Users->patchEntity($Users, ['password' => $this->request->data['new']]);
				if ($this->Users->save($result)) {
					$this->Flash->success(__('Password has been changed successfully.'));
					return $this->redirect(['action' => 'changePassword']);
				}
			}
		} 
		$Users=$this->Users->find()->where(['is_deleted'=>0])->order(['Users.id' => 'DESC']);
		$this->set('Users', $Users);
    }
 	public function profileedit()
    {
		$this->viewBuilder()->layout('admin_layout');
		$loginId=$this->Auth->User('id');
		$admins = $this->Admins->find()->where(['id' => $loginId])->first();
		$this->set('admins',$admins); 
		if ($this->request->is('post')) {
			
			if(!empty($this->request->data['profile_pic']['tmp_name']))
			{
				$path_info = pathinfo($this->request->data['profile_pic']['name']);
				chmod ($this->request->data['profile_pic']['tmp_name'], 0644);
				$photo=time()."admin.".$path_info['extension'];
				$fullpath= WWW_ROOT."img".DS."admin_profile";
				$res1 = is_dir($fullpath);
				if($res1 != 1) {
					$res2= mkdir($fullpath, 0777, true);
				}
				move_uploaded_file($this->request->data['profile_pic']['tmp_name'],$fullpath.DS.$photo);
				$this->request->data['profile_pic'] = $photo; 
 				$this->request->session()->write('Auth.User.profile_pic', $photo);
 			}
			$this->request->session()->write('Auth.User.first_name', $this->request->data['first_name']);
			$this->request->session()->write('Auth.User.last_name', $this->request->data['last_name']);
			
			$result = $this->Admins->patchEntity($admins, $this->request->data);
			//print_r($result); exit;
 			if ($this->Admins->save($result)) {
				$this->Flash->success(__('Profile has been changed successfully.'));
				return $this->redirect(['action' => 'profileedit']);
			}
			else{
				$this->Flash->error(__('Something went wrong please try again.'));
				return $this->redirect(['action' => 'profileedit']);
			}
			 
		}		
    }
    public function login()
    {
       $this->viewBuilder()->layout(''); 
	   if ($this->request->is('post')) {			
			$user = $this->Auth->identify();			
			if ($user) {
				$this->Auth->setUser($user);
				return $this->redirect(['action' => 'dashboard']);
			}		
			$this->Flash->error('Either Password or username is not correct!');
		}
	}
	 
	public function logout()
	{
		$this->Flash->success('You are now logged out.');
		return $this->redirect($this->Auth->logout());
	}

    public function view($id = null)
    {
        $admin = $this->Admins->get($id, [
            'contain' => ['AdminRole']
        ]);
        $this->set('admin', $admin);
        $this->set('_serialize', ['admin']);
    }

    public function add()
    {
		$this->viewBuilder()->layout('admin_layout');
        $admin = $this->Admins->newEntity();
        
        if ($this->request->is('post')) {
            $admin = $this->Admins->patchEntity($admin, $this->request->data);
 			$admin_role=$this->request->data['role_id'];
             if ($insert=$this->Admins->save($admin)) {
				//- Admin Role Insert
				$AdminRole = $this->Admins->AdminRole->newEntity();
				$AdminRole = $this->Admins->AdminRole->patchEntity($AdminRole, $this->request->data);
				$AdminRole->admin_id=$insert->id;
				$AdminRole->role_id=$admin_role;
				$this->Admins->AdminRole->save($AdminRole);
				 
                $this->Flash->success(__('The admin has been saved.'));
                return $this->redirect(['action' => 'add']);
            } else { 
                $this->Flash->error(__('The admin could not be saved. Please, try again.'));
            }
        }
		$Admins = $this->Admins->AdminRole->Roles->find('list', ['limit' => 200]);
		//-- VIew List 
		$this->paginate = [
            'contain' => ['AdminRole']
        ];
        $AdminsRecord = $this->paginate($this->Admins);
		
        $this->set(compact('admin','Admins','AdminsRecord'));
        $this->set('_serialize', ['admin','Admins','AdminsRecord']);
    }
	
	public function UserRights()
	{
		$user_id=$this->Auth->User('id');
		$role_id=$this->Auth->User('role_id');
 		$conditions=array("user_id" => $user_id);
		$fetch_user_right1='';
		$fetch_user_right2='';
		
		$fetch_user_rights = $this->Admins->UserRights->find()->where($conditions)->toArray();
		
		foreach($fetch_user_rights as $data){
			$fetch_user_right1 = $data->module_id;
		}
		$conditions=array("role_id" => $role_id);
				
		$fetch_user_roles = $this->Admins->UserRights->find()->where($conditions)->toArray();
		
		foreach($fetch_user_roles as $data2){
			$fetch_user_right2 = $data2->module_id;
		}
		$fetch_user_right1_array = explode(',',$fetch_user_right1);
		$fetch_user_right2_array = explode(',',$fetch_user_right2);
		$fetch_user_right_array = array_merge($fetch_user_right1_array,$fetch_user_right2_array);
		$fetch_user_right_array = array_unique($fetch_user_right_array);
		$fetch_user_right = implode(',',$fetch_user_right_array);
		$this->response->body($fetch_user_right);
		return $this->response;
	}
	public function menu()
	{
		$user_id=$this->Auth->User('id');
		$fetch_menu = $this->Admins->Modules->find()->order(['preferance'=>'ASC'])->toArray();
		$this->response->body($fetch_menu);
		return $this->response;
	}
	
	public function MenuSubmenu($main_menu)
	{
		$user_id=$this->Auth->User('id');
		$conditions=array("main_menu" => $main_menu);
		
		$fetch_menu_submenu = $this->Admins->Modules->find()->where($conditions)->toArray();
		
		$this->response->body($fetch_menu_submenu);
		return $this->response;
	}
	public function submenu($sub_menu)
	{ 
		$user_id=$this->Auth->User('id');
		$conditions=array("sub_menu" => $sub_menu);
		$fetch_submenu = $this->Admins->Modules->find()->where($conditions)->toArray();
		
		$this->response->body($fetch_submenu);
		return $this->response;
	}
	

    /**
     * Edit method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $admin = $this->Admins->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $admin = $this->Admins->patchEntity($admin, $this->request->data);
            if ($this->Admins->save($admin)) {
                $this->Flash->success(__('The admin has been saved.'));

                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The admin could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('admin'));
        $this->set('_serialize', ['admin']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $admin = $this->Admins->get($id);
        if ($this->Admins->delete($admin)) {
            $this->Flash->success(__('The admin has been deleted.'));
        } else {
            $this->Flash->error(__('The admin could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }
	public function broadcast()
    {
		$this->viewBuilder()->layout('admin_layout');
		$admin = $this->Admins->UserChats->newEntity();
		if ($this->request->is('post')) {
			
			$broadcast_msg=$this->request->data['broadcast_msg'];
			$Users=$this->Users->find()->where(['device_id !='=>'0'])->toArray();
 			foreach($Users as $user){
				$admin = $this->Admins->UserChats->newEntity();
 				$admin->request_id = '0';
				$admin->user_id = 1;
				$admin->send_to_user_id = $user["id"];
				$admin['type'] = 'Announcement';
				$admin->message = $broadcast_msg;
				$admin->created = date("Y-m-d h:i:s");
				$admin->notification = 1;

				if ($this->Admins->UserChats->save($admin)) {
					$id = $admin->id;
					$message_data='';
					$this->Admins->UserChats->updateAll(['type' => 'Announcement'], ['id' => $id]);
					$this->sendpushnotification($user["id"],$admin->message,$message_data);
				}
			}
			return $this->redirect(['action' => 'broadcast']);
		}
		
		$this->set(compact('admin'));
        $this->set('_serialize', ['admin']);
	}
	public function sendpushnotification($userid,$message,$message_data)
	{
		$Users=$this->Users->find()->where(['id'=>$userid])->toArray();
		 
		$deviceid=$Users[0]['device_id'];
 		if(!empty($deviceid)){

		/* $sql1 = "Select count(*) as countchat FROM user_chats as c 
		INNER JOIN users as u on u.id=c.user_id
		where c.is_read='0' AND c.send_to_user_id='".$userid."'
		order by c.created DESC ";
		$stmt1 = $conn->execute($sql1);
		$countchat = $stmt1 ->fetch('assoc');
		 */
		$API_ACCESS_KEY='AIzaSyBMQtE5umATnqJkV4edMYQ_fR8263Zm21E';

		$registrationIds =  $deviceid;
		$msg = array
		(
		'body' 	=> $message,
		'title'	=> 'Travelb2bhub Notification',
		'icon'	=> 'myicon',/*Default Icon*/
		'sound' => 'mySound',/*Default sound*/
		'unread_count' => 0,
		'message' => $message,
		'type'=>"Announcement"
		);
		$data = array
		(

		"unread_count" => 0
		);
		$fields = array('to'=> $registrationIds,
		'notification'=> $msg,
		'data' => $msg
		);
		$headers = array(
		'Authorization: key='.$API_ACCESS_KEY,
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
	
	public function statistics($month_from=null,$month_to=null)
    {
		$this->viewBuilder()->layout('admin_layout');
		/* // set current date
		$date = '02/01/2018';
		// parse about any English textual datetime description into a Unix timestamp 
		$ts = strtotime($date);
		// calculate the number of days since Monday
		$dow = date('w', $ts);
		$offset = $dow - 1;
		if ($offset < 0) {
			$offset = 6;
		}
		// calculate timestamp for the Monday
		$ts = $ts - $offset*86400;
		// loop from Monday till Sunday 
		for ($i = 0; $i < 7; $i++, $ts += 86400){
			print date("d/M/Y l", $ts) . "\n";
		}
		exit;*/
		$month_from=$this->request->query('month_from');
		$month_to=$this->request->query('month_to'); 
		$type=$this->request->query('type'); 
		$year_from=$this->request->query('year_from'); 
		$year_to=$this->request->query('year_to'); 
		if(!empty($month_from) && !empty($month_to)){
			$month_from='01-'.$month_from;
			$month_to='01-'.$month_to;
			if($type==2){
				$start = strtotime($month_from);
				$end = strtotime($month_to);
				while($start < $end)
				{
					//date('F Y', $start), PHP_EOL;
					$MH = date('m', $start);
					$YR = date('Y', $start);
					$month_from='01-'.$MH.'-'.$YR; 
					$first_date=date('Y-m-d',strtotime($month_from));
					$last_date=date('Y-m-t',strtotime($month_from));
					$Month_name=date('M',strtotime($first_date));  
					
					$TA=$this->Users->find()->where(['Users.role_id'=>1,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
					$TravelAgentCount[]=$TA;
					
					$EP=$this->Users->find()->where(['Users.role_id'=>2,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
					$EventPlannerCount[]=$EP;
					
					$H=$this->Users->find()->where(['Users.role_id'=>3,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
					$HotelierCount[]=$H;
					
					$MonthName[]=$Month_name;
					
					$TotalRegistration[]=$TA+$EP+$H;
					 
					$start = strtotime("+1 month", $start);
				}
			}
			else{
				$start_date=date('Y-m-d',strtotime($month_from));
				$end_date=date('Y-m-t',strtotime($month_to));
				$x=0;
				while (strtotime($start_date) <= strtotime($end_date)) {
					 
					$CompairDate = date ("Y-m-d", strtotime("+7 day", strtotime($start_date)));
					$firstdate = date ("Y-m-d", strtotime("-7 day", strtotime($CompairDate)));
					if(strtotime($end_date) > strtotime($CompairDate)){
						$start_date = date ("Y-m-d", strtotime("+7 day", strtotime($start_date)));
					}
					else{
						$x=1;
						$start_date = date ("Y-m-t", strtotime($start_date));
					}
					
					
					$TA=$this->Users->find()->where(['Users.role_id'=>1,'create_at >='=>$firstdate,'create_at <='=>$start_date])->count();
					$TravelAgentCount[]=$TA;
					
					$EP=$this->Users->find()->where(['Users.role_id'=>2,'create_at >='=>$firstdate,'create_at <='=>$start_date])->count();
					$EventPlannerCount[]=$EP;
					
					$H=$this->Users->find()->where(['Users.role_id'=>3,'create_at >='=>$firstdate,'create_at <='=>$start_date])->count();
					$HotelierCount[]=$H;
					
					$MonthName[]=date('d-M',strtotime($firstdate)).' - '.date('d-M',strtotime($start_date));
					
					$TotalRegistration[]=$TA+$EP+$H;
					 
					if($x==1){break;}
				}
			}
  		}
		else if(!empty($year_from) && !empty($year_to)){
			$years = range ($year_from,$year_to);
			foreach($years as $year)
			{
 				$first_date='01-01-'.$year;
				$first_date=date('Y-m-d',strtotime($first_date));

				$last_date='31-12-'.$year;
				$last_date=date('Y-m-t',strtotime($last_date));
				
				$Month_name=$year;
				//-- COUNTRING
				
				$TA=$this->Users->find()->where(['Users.role_id'=>1,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$TravelAgentCount[]=$TA;
				
				$EP=$this->Users->find()->where(['Users.role_id'=>2,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$EventPlannerCount[]=$EP;
				
				$H=$this->Users->find()->where(['Users.role_id'=>3,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$HotelierCount[]=$H;
				
				$MonthName[]=$Month_name;
				
				$TotalRegistration[]=$TA+$EP+$H;
			}
		}
		else
		{
			for($x=1;$x<=12;$x++)
			{
				$month=$x;
				$current_year=date('Y');
				$first_date='01-'.$month.'-'.$current_year;
				$first_date=date('Y-m-d',strtotime($first_date));
				$last_date=date('Y-m-t',strtotime($first_date));
				$Month_name=date('M',strtotime($first_date));
				//-- COUNTRING
				
				$TA=$this->Users->find()->where(['Users.role_id'=>1,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$TravelAgentCount[]=$TA;
				
				$EP=$this->Users->find()->where(['Users.role_id'=>2,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$EventPlannerCount[]=$EP;
				
				$H=$this->Users->find()->where(['Users.role_id'=>3,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$HotelierCount[]=$H;
				
				$MonthName[]=$Month_name;
				
				$TotalRegistration[]=$TA+$EP+$H;
			}
		}
		//-- For Excel
		$this->set('TArray',$TotalRegistration);
		$this->set('TAArray',$TravelAgentCount);
		$this->set('EPArray',$EventPlannerCount);
		$this->set('HArray',$HotelierCount);
		$this->set('MonthArray',$MonthName);
		//-- For Graph
		$TotalRegistration=implode(',', $TotalRegistration);
		$TravelAgentCount=implode(',', $TravelAgentCount);
		$EventPlannerCount=implode(',', $EventPlannerCount);
		$HotelierCount=implode(',', $HotelierCount); 
		
		$MonthName=implode("','", $MonthName); 
		$MonthName="'".$MonthName."'";
		$this->set(compact('TravelAgentCount','EventPlannerCount','HotelierCount','TotalRegistration','MonthName'));
    }
	
	public function RequestStatistics($month_from=null,$month_to=null,$year_from=null,$year_to=null)
    {
		$this->viewBuilder()->layout('admin_layout');
		$month_from=$this->request->query('month_from');
		$month_to=$this->request->query('month_to'); 
		$type=$this->request->query('type');  
		$year_from=$this->request->query('year_from'); 
		$year_to=$this->request->query('year_to'); 
		$this->loadModel('Requests');
		if(!empty($month_from) && !empty($month_to)){
			$month_from='01-'.$month_from;
			$month_to='01-'.$month_to; 
			if($type==2){
				$start = strtotime($month_from);
				$end = strtotime($month_to);
 
				while($start <= $end)
				{
					//date('F Y', $start), PHP_EOL;
					$MH = date('m', $start);
					$YR = date('Y', $start);
					$month_from='01-'.$MH.'-'.$YR; 
					$first_date=date('Y-m-d',strtotime($month_from));
					$last_date=date('Y-m-t',strtotime($month_from));
					$Month_name=date('M',strtotime($first_date));  
					
					$TA=$this->Users->find()->where(['Users.role_id'=>1]);
					$TAIDs=array();
					foreach($TA as $datas){
						$TAIDs[]=$datas['id']; 
					}
					//-- GET COUNT OF REQ
					$TAS=0;
					if(!empty($TAIDs)){
						$TAS=$this->Requests->find()->where(['Requests.user_id IN'=>$TAIDs,'created >='=>$first_date,'created <='=>$last_date])->count();
					}
					$TravelAgentCount[]=$TAS;
					
					//-- EVENT PLANNER
					$EP=$this->Users->find()->where(['Users.role_id'=>2]);
					$EPIDs=array();
					foreach($EP as $datass){
						$EPIDs[]=$datass['id']; 
					}
					//-- GET COUNT OF REQ
					$EPS=0;
					if(!empty($EPIDs)){
						$EPS=$this->Requests->find()->where(['Requests.user_id IN'=>$EPIDs,'created >='=>$first_date,'created <='=>$last_date])->count();
					}
					$EventPlannerCount[]=$EPS;
					
					$MonthName[]=$Month_name;
					
					$TotalRegistration[]=$TAS+$EPS;
					 
					$start = strtotime("+1 month", $start);
				}
			}
			else{
				$start_date=date('Y-m-d',strtotime($month_from));
				$end_date=date('Y-m-t',strtotime($month_to));
				$x=0;
				while (strtotime($start_date) <= strtotime($end_date)) {
					 
					$CompairDate = date ("Y-m-d", strtotime("+7 day", strtotime($start_date)));
					$firstdate = date ("Y-m-d", strtotime("-7 day", strtotime($CompairDate)));
					if(strtotime($end_date) > strtotime($CompairDate)){
						$start_date = date ("Y-m-d", strtotime("+7 day", strtotime($start_date)));
					}
					else{
						$x=1;
						$start_date = date ("Y-m-t", strtotime($start_date));
					}
					
					
					$TA=$this->Users->find()->where(['Users.role_id'=>1]);
					$TAIDs=array();
					foreach($TA as $datas){
						$TAIDs[]=$datas['id']; 
					}
					//-- GET COUNT OF REQ
					$TAS=0;
					if(!empty($TAIDs)){
						$TAS=$this->Requests->find()->where(['Requests.user_id IN'=>$TAIDs,'created >='=>$firstdate,'created <='=>$start_date])->count();
					}
					$TravelAgentCount[]=$TAS;
					
					//-- EVENT PLANNER
					$EP=$this->Users->find()->where(['Users.role_id'=>2]);
					$EPIDs=array();
					foreach($EP as $datass){
						$EPIDs[]=$datass['id']; 
					}
					//-- GET COUNT OF REQ
					$EPS=0;
					if(!empty($EPIDs)){
						$EPS=$this->Requests->find()->where(['Requests.user_id IN'=>$EPIDs,'created >='=>$firstdate,'created <='=>$start_date])->count();
					}
					$EventPlannerCount[]=$EPS; 
					
					$TotalRegistration[]=$TAS+$EPS;
					
					$MonthName[]=date('d-M',strtotime($firstdate)).' - '.date('d-M',strtotime($start_date));
					 
					if($x==1){break;}
				}
			}
  		}
		
		else if(!empty($year_from) && !empty($year_to)){
			$years = range ($year_from,$year_to);
			foreach($years as $year)
			{
 				$first_date='01-01-'.$year;
				$first_date=date('Y-m-d',strtotime($first_date));

				$last_date='31-12-'.$year;
				$last_date=date('Y-m-t',strtotime($last_date));
				
				$Month_name=$year;
				//-- COUNTRING
				
				$TA=$this->Users->find()->where(['Users.role_id'=>1,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$TravelAgentCount[]=$TA;
				
				$EP=$this->Users->find()->where(['Users.role_id'=>2,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$EventPlannerCount[]=$EP;
				
				$H=$this->Users->find()->where(['Users.role_id'=>3,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$HotelierCount[]=$H;
				
				$MonthName[]=$Month_name;
				
				$TotalRegistration[]=$TA+$EP+$H;
			}
		}
		else
		{
			for($x=1;$x<=12;$x++)
			{
				$month=$x;
				$current_year=date('Y');
				$first_date='01-'.$month.'-'.$current_year;
				$first_date=date('Y-m-d',strtotime($first_date));
				$last_date=date('Y-m-t',strtotime($first_date));
				$Month_name=date('M',strtotime($first_date));
				//-- Get All TA Id
				$TA=$this->Users->find()->where(['Users.role_id'=>1]);
				$TAIDs=array();
				foreach($TA as $datas){
					$TAIDs[]=$datas['id']; 
				}
 				//-- GET COUNT OF REQ
				$TAS=0;
 				if(!empty($TAIDs)){
					$TAS=$this->Requests->find()->where(['Requests.user_id IN'=>$TAIDs,'created >='=>$first_date,'created <='=>$last_date])->count();
				}
				$TravelAgentCount[]=$TAS;
				
				//-- EVENT PLANNER
				$EP=$this->Users->find()->where(['Users.role_id'=>2]);
				$EPIDs=array();
				foreach($EP as $datass){
					$EPIDs[]=$datass['id']; 
				}
				//-- GET COUNT OF REQ
 				$EPS=0;
 				if(!empty($EPIDs)){
					$EPS=$this->Requests->find()->where(['Requests.user_id IN'=>$EPIDs,'created >='=>$first_date,'created <='=>$last_date])->count();
				}
				$EventPlannerCount[]=$EPS;
				
				$MonthName[]=$Month_name;
				
				$TotalRegistration[]=$TAS+$EPS;
			}
		}
		//-- For Excel
		$this->set('TArray',$TotalRegistration);
		$this->set('TAArray',$TravelAgentCount);
		$this->set('EPArray',$EventPlannerCount); 
		$this->set('MonthArray',$MonthName);
		//-- For Graph
		$TotalRegistration=implode(',', $TotalRegistration);
		$TravelAgentCount=implode(',', $TravelAgentCount);
		$EventPlannerCount=implode(',', $EventPlannerCount);  
		
		$MonthName=implode("','", $MonthName); 
		$MonthName="'".$MonthName."'";
		$this->set(compact('TravelAgentCount','EventPlannerCount','TotalRegistration','MonthName'));
    }
	
	public function finalizeRequests($month_from=null,$month_to=null,$year_from=null,$year_to=null)
    {
		$this->viewBuilder()->layout('admin_layout');
		$month_from=$this->request->query('month_from');
		$month_to=$this->request->query('month_to'); 
		$year_from=$this->request->query('year_from'); 
		$year_to=$this->request->query('year_to'); 
		$type=$this->request->query('type'); 
		$this->loadModel('Requests');
		if(!empty($month_from) && !empty($month_to)){
			$month_from='01-'.$month_from;
			$month_to='01-'.$month_to;
			if($type==2){
				$start = strtotime($month_from);
				$end = strtotime($month_to);
				while($start <= $end)
				{
					//date('F Y', $start), PHP_EOL;
					$MH = date('m', $start);
					$YR = date('Y', $start);
					$month_from='01-'.$MH.'-'.$YR; 
					$first_date=date('Y-m-d',strtotime($month_from));
					$last_date=date('Y-m-t',strtotime($month_from));
					$Month_name=date('M',strtotime($first_date));  
					
					$TA=$this->Users->find()->where(['Users.role_id'=>1]);
					$TAIDs=array();
					foreach($TA as $datas){
						$TAIDs[]=$datas['id']; 
					}
					//-- GET COUNT OF REQ
					$TAS=0;
					if(!empty($TAIDs)){
						$TAS=$this->Requests->find()->where(['Requests.user_id IN'=>$TAIDs,'Requests.created >='=>$first_date,'Requests.created <='=>$last_date,'status'=>2])->count();
					}
					$TravelAgentCount[]=$TAS;
					
					//-- EVENT PLANNER
					$EP=$this->Users->find()->where(['Users.role_id'=>2]);
					$EPIDs=array();
					foreach($EP as $datass){
						$EPIDs[]=$datass['id']; 
					}
					//-- GET COUNT OF REQ
					$EPS=0;
					if(!empty($EPIDs)){
						$EPS=$this->Requests->find()->where(['Requests.user_id IN'=>$EPIDs,'created >='=>$first_date,'created <='=>$last_date,'status'=>2])->count();
					}
					$EventPlannerCount[]=$EPS;
					
					$MonthName[]=$Month_name;
					
					$TotalRegistration[]=$TAS+$EPS;
					 
					$start = strtotime("+1 month", $start);
				}
			}
			else{
				$start_date=date('Y-m-d',strtotime($month_from));
				$end_date=date('Y-m-t',strtotime($month_to));
				$x=0;
				while (strtotime($start_date) <= strtotime($end_date)) {
					 
					$CompairDate = date ("Y-m-d", strtotime("+7 day", strtotime($start_date)));
					$firstdate = date ("Y-m-d", strtotime("-7 day", strtotime($CompairDate)));
					if(strtotime($end_date) > strtotime($CompairDate)){
						$start_date = date ("Y-m-d", strtotime("+7 day", strtotime($start_date)));
					}
					else{
						$x=1;
						$start_date = date ("Y-m-t", strtotime($start_date));
					}
					
					
					$TA=$this->Users->find()->where(['Users.role_id'=>1]);
					$TAIDs=array();
					foreach($TA as $datas){
						$TAIDs[]=$datas['id']; 
					}
					//-- GET COUNT OF REQ
					$TAS=0;
					if(!empty($TAIDs)){
						$TAS=$this->Requests->find()->where(['Requests.user_id IN'=>$TAIDs,'created >='=>$firstdate,'created <='=>$start_date,'status'=>2])->count();
					}
					$TravelAgentCount[]=$TAS;
					
					//-- EVENT PLANNER
					$EP=$this->Users->find()->where(['Users.role_id'=>2]);
					$EPIDs=array();
					foreach($EP as $datass){
						$EPIDs[]=$datass['id']; 
					}
					//-- GET COUNT OF REQ
					$EPS=0;
					if(!empty($EPIDs)){
						$EPS=$this->Requests->find()->where(['Requests.user_id IN'=>$EPIDs,'created >='=>$firstdate,'created <='=>$start_date,'status'=>2])->count();
					}
					$EventPlannerCount[]=$EPS; 
					
					$TotalRegistration[]=$TAS+$EPS;
					
					$MonthName[]=date('d-M',strtotime($firstdate)).' - '.date('d-M',strtotime($start_date));
					 
					if($x==1){break;}
				}
			}
  		}
		else if(!empty($year_from) && !empty($year_to)){
			$years = range ($year_from,$year_to);
			foreach($years as $year)
			{
 				$first_date='01-01-'.$year;
				$first_date=date('Y-m-d',strtotime($first_date));

				$last_date='31-12-'.$year;
				$last_date=date('Y-m-t',strtotime($last_date));
				
				$Month_name=$year;
				//-- COUNTRING
				
				$TA=$this->Users->find()->where(['Users.role_id'=>1,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$TravelAgentCount[]=$TA;
				
				$EP=$this->Users->find()->where(['Users.role_id'=>2,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$EventPlannerCount[]=$EP;
				
				$H=$this->Users->find()->where(['Users.role_id'=>3,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$HotelierCount[]=$H;
				
				$MonthName[]=$Month_name;
				
				$TotalRegistration[]=$TA+$EP+$H;
			}
		}
		else
		{
			for($x=1;$x<=12;$x++)
			{
				$month=$x;
				$current_year=date('Y');
				$first_date='01-'.$month.'-'.$current_year;
				$first_date=date('Y-m-d',strtotime($first_date));
				$last_date=date('Y-m-t',strtotime($first_date));
				$Month_name=date('M',strtotime($first_date));
				//-- Get All TA Id
				$TA=$this->Users->find()->where(['Users.role_id'=>1]);
				$TAIDs=array();
				foreach($TA as $datas){
					$TAIDs[]=$datas['id']; 
				}
 				//-- GET COUNT OF REQ
				$TAS=0;
 				if(!empty($TAIDs)){
					$TAS=$this->Requests->find()->where(['Requests.user_id IN'=>$TAIDs,'created >='=>$first_date,'created <='=>$last_date,'status'=>2])->count();
				}
				$TravelAgentCount[]=$TAS;
				
				//-- EVENT PLANNER
				$EP=$this->Users->find()->where(['Users.role_id'=>2]);
				$EPIDs=array();
				foreach($EP as $datass){
					$EPIDs[]=$datass['id']; 
				}
				//-- GET COUNT OF REQ
 				$EPS=0;
 				if(!empty($EPIDs)){
					$EPS=$this->Requests->find()->where(['Requests.user_id IN'=>$EPIDs,'created >='=>$first_date,'created <='=>$last_date,'status'=>2])->count();
				}
				$EventPlannerCount[]=$EPS;
				
				$MonthName[]=$Month_name;
				
				$TotalRegistration[]=$TAS+$EPS;
			}
		}
		//-- For Excel
		$this->set('TArray',$TotalRegistration);
		$this->set('TAArray',$TravelAgentCount);
		$this->set('EPArray',$EventPlannerCount); 
		$this->set('MonthArray',$MonthName);
		//-- For Graph
		$TotalRegistration=implode(',', $TotalRegistration);
		$TravelAgentCount=implode(',', $TravelAgentCount);
		$EventPlannerCount=implode(',', $EventPlannerCount);  
		
		$MonthName=implode("','", $MonthName); 
		$MonthName="'".$MonthName."'";
		$this->set(compact('TravelAgentCount','EventPlannerCount','TotalRegistration','MonthName'));
    }
	
	public function removedRequests($month_from=null,$month_to=null,$year_from=null,$year_to=null)
    {
		$this->viewBuilder()->layout('admin_layout');
		$month_from=$this->request->query('month_from');
		$month_to=$this->request->query('month_to');
		$year_from=$this->request->query('year_from'); 
		$year_to=$this->request->query('year_to');  
		$type=$this->request->query('type'); 
		$this->loadModel('Requests');
		if(!empty($month_from) && !empty($month_to)){
			$month_from='01-'.$month_from;
			$month_to='01-'.$month_to;
			if($type==2){
				$start = strtotime($month_from);
				$end = strtotime($month_to);
				while($start <= $end)
				{
					//date('F Y', $start), PHP_EOL;
					$MH = date('m', $start);
					$YR = date('Y', $start);
					$month_from='01-'.$MH.'-'.$YR; 
					$first_date=date('Y-m-d',strtotime($month_from));
					$last_date=date('Y-m-t',strtotime($month_from));
					$Month_name=date('M',strtotime($first_date));  
					
					$TA=$this->Users->find()->where(['Users.role_id'=>1]);
					$TAIDs=array();
					foreach($TA as $datas){
						$TAIDs[]=$datas['id']; 
					}
					//-- GET COUNT OF REQ
					$TAS=0;
					if(!empty($TAIDs)){
						$TAS=$this->Requests->find()->where(['Requests.user_id IN'=>$TAIDs,'Requests.created >='=>$first_date,'Requests.created <='=>$last_date,'is_deleted'=>1])->count();
					}
					$TravelAgentCount[]=$TAS;
					
					//-- EVENT PLANNER
					$EP=$this->Users->find()->where(['Users.role_id'=>2]);
					$EPIDs=array();
					foreach($EP as $datass){
						$EPIDs[]=$datass['id']; 
					}
					//-- GET COUNT OF REQ
					$EPS=0;
					if(!empty($EPIDs)){
						$EPS=$this->Requests->find()->where(['Requests.user_id IN'=>$EPIDs,'created >='=>$first_date,'created <='=>$last_date,'is_deleted'=>1])->count();
					}
					$EventPlannerCount[]=$EPS;
					
					$MonthName[]=$Month_name;
					
					$TotalRegistration[]=$TAS+$EPS;
					 
					$start = strtotime("+1 month", $start);
				}
			}
			else{
				$start_date=date('Y-m-d',strtotime($month_from));
				$end_date=date('Y-m-t',strtotime($month_to));
				$x=0;
				while (strtotime($start_date) <= strtotime($end_date)) {
					 
					$CompairDate = date ("Y-m-d", strtotime("+7 day", strtotime($start_date)));
					$firstdate = date ("Y-m-d", strtotime("-7 day", strtotime($CompairDate)));
					if(strtotime($end_date) > strtotime($CompairDate)){
						$start_date = date ("Y-m-d", strtotime("+7 day", strtotime($start_date)));
					}
					else{
						$x=1;
						$start_date = date ("Y-m-t", strtotime($start_date));
					}
					
					
					$TA=$this->Users->find()->where(['Users.role_id'=>1]);
					$TAIDs=array();
					foreach($TA as $datas){
						$TAIDs[]=$datas['id']; 
					}
					//-- GET COUNT OF REQ
					$TAS=0;
					if(!empty($TAIDs)){
						$TAS=$this->Requests->find()->where(['Requests.user_id IN'=>$TAIDs,'created >='=>$firstdate,'created <='=>$start_date,'is_deleted'=>1])->count();
					}
					$TravelAgentCount[]=$TAS;
					
					//-- EVENT PLANNER
					$EP=$this->Users->find()->where(['Users.role_id'=>2]);
					$EPIDs=array();
					foreach($EP as $datass){
						$EPIDs[]=$datass['id']; 
					}
					//-- GET COUNT OF REQ
					$EPS=0;
					if(!empty($EPIDs)){
						$EPS=$this->Requests->find()->where(['Requests.user_id IN'=>$EPIDs,'created >='=>$firstdate,'created <='=>$start_date,'is_deleted'=>1])->count();
					}
					$EventPlannerCount[]=$EPS; 
					
					$TotalRegistration[]=$TAS+$EPS;
					
					$MonthName[]=date('d-M',strtotime($firstdate)).' - '.date('d-M',strtotime($start_date));
					 
					if($x==1){break;}
				}
			}
  		}
		else if(!empty($year_from) && !empty($year_to)){
			$years = range ($year_from,$year_to);
			foreach($years as $year)
			{
 				$first_date='01-01-'.$year;
				$first_date=date('Y-m-d',strtotime($first_date));

				$last_date='31-12-'.$year;
				$last_date=date('Y-m-t',strtotime($last_date));
				
				$Month_name=$year;
				//-- COUNTRING
				
				$TA=$this->Users->find()->where(['Users.role_id'=>1,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$TravelAgentCount[]=$TA;
				
				$EP=$this->Users->find()->where(['Users.role_id'=>2,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$EventPlannerCount[]=$EP;
				
				$H=$this->Users->find()->where(['Users.role_id'=>3,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$HotelierCount[]=$H;
				
				$MonthName[]=$Month_name;
				
				$TotalRegistration[]=$TA+$EP+$H;
			}
		}
		else
		{
			for($x=1;$x<=12;$x++)
			{
				$month=$x;
				$current_year=date('Y');
				$first_date='01-'.$month.'-'.$current_year;
				$first_date=date('Y-m-d',strtotime($first_date));
				$last_date=date('Y-m-t',strtotime($first_date));
				$Month_name=date('M',strtotime($first_date));
				//-- Get All TA Id
				$TA=$this->Users->find()->where(['Users.role_id'=>1]);
				$TAIDs=array();
				foreach($TA as $datas){
					$TAIDs[]=$datas['id']; 
				}
 				//-- GET COUNT OF REQ
				$TAS=0;
 				if(!empty($TAIDs)){
					$TAS=$this->Requests->find()->where(['Requests.user_id IN'=>$TAIDs,'created >='=>$first_date,'created <='=>$last_date,'is_deleted'=>1])->count();
				}
				$TravelAgentCount[]=$TAS;
				
				//-- EVENT PLANNER
				$EP=$this->Users->find()->where(['Users.role_id'=>2]);
				$EPIDs=array();
				foreach($EP as $datass){
					$EPIDs[]=$datass['id']; 
				}
				//-- GET COUNT OF REQ
 				$EPS=0;
 				if(!empty($EPIDs)){
					$EPS=$this->Requests->find()->where(['Requests.user_id IN'=>$EPIDs,'created >='=>$first_date,'created <='=>$last_date,'is_deleted'=>1])->count();
				}
				$EventPlannerCount[]=$EPS;
				
				$MonthName[]=$Month_name;
				
				$TotalRegistration[]=$TAS+$EPS;
			}
		}
		//-- For Excel
		$this->set('TArray',$TotalRegistration);
		$this->set('TAArray',$TravelAgentCount);
		$this->set('EPArray',$EventPlannerCount); 
		$this->set('MonthArray',$MonthName);
		//-- For Graph
		$TotalRegistration=implode(',', $TotalRegistration);
		$TravelAgentCount=implode(',', $TravelAgentCount);
		$EventPlannerCount=implode(',', $EventPlannerCount);  
		
		$MonthName=implode("','", $MonthName); 
		$MonthName="'".$MonthName."'";
		$this->set(compact('TravelAgentCount','EventPlannerCount','TotalRegistration','MonthName'));
    }
	
	public function registeredPercentage($month_from=null,$month_to=null,$year_from=null,$year_to=null)
    {
		$this->viewBuilder()->layout('admin_layout');
		$month_from=$this->request->query('month_from');
		$month_to=$this->request->query('month_to');
		$year_from=$this->request->query('year_from'); 
		$year_to=$this->request->query('year_to'); 
		$type=$this->request->query('type'); 
		$this->loadModel('Requests');
		$TAPER=0;
		$EPPER=0;
		$HPER=0; 		
		//-- Get All
		$TotalRegistration=$this->Users->find()->count();
		//-- SEPRATE
		$TotalTA=$this->Users->find()->where(['Users.role_id'=>1])->count();
		$TotalEP=$this->Users->find()->where(['Users.role_id'=>2])->count();
		$TotalH=$this->Users->find()->where(['Users.role_id'=>3])->count();
		//-- PERCENTAGE
		if($TotalTA>0){
			$TAPER=number_format($TotalTA*100/$TotalRegistration, 2); 
		}
		if($TotalEP>0){
			$EPPER=number_format($TotalEP*100/$TotalRegistration, 2);
		}
		if($TotalH>0){
			$HPER=number_format($TotalH*100/$TotalRegistration, 2);
		}
  		//-- For Graph
 		$this->set(compact('TAPER','EPPER','HPER'));
    }
	
	public function StatewiseStatistics($month_from=null,$month_to=null,$year_from=null,$year_to=null)
    {
		$this->viewBuilder()->layout('admin_layout');
		$month_from=$this->request->query('month_from');
		$month_to=$this->request->query('month_to'); 
		$year_from=$this->request->query('year_from'); 
		$year_to=$this->request->query('year_to'); 
		$type=$this->request->query('type');
		$this->loadModel('States');
		$States=$this->States->find()->where(['is_deleted'=>0,'country_id'=>101]);
		//pr($States->toArray()); exit;
		if(!empty($month_from) && !empty($month_to)){
			$month_from='01-'.$month_from;
			$month_to='01-'.$month_to;
			if($type==2){
				$first_date=date('Y-m-d',strtotime($month_from));
				$last_date=date('Y-m-t',strtotime($month_to));
				foreach($States as $state)
				{
					$state_id=$state['id'];
					$state_name=$state['state_name'];
					
 					$Categories=$state_name;
					//-- COUNTRING
					$TA=$this->Users->find()->where(['state_id'=>$state_id,'Users.role_id'=>1,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
					$TravelAgentCount[]=$TA;
					
					$EP=$this->Users->find()->where(['state_id'=>$state_id,'Users.role_id'=>2,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
					$EventPlannerCount[]=$EP;
					
					$H=$this->Users->find()->where(['state_id'=>$state_id,'Users.role_id'=>3,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
					$HotelierCount[]=$H;
					
					$MonthName[]=$Categories;
					
					$TotalRegistration[]=$TA+$EP+$H;
				}	 
				 
			}
			else{
				$start_date=date('Y-m-d',strtotime($month_from));
				$end_date=date('Y-m-t',strtotime($month_to));
				$x=0;
				while (strtotime($start_date) <= strtotime($end_date)) {
					 
					$CompairDate = date ("Y-m-d", strtotime("+7 day", strtotime($start_date)));
					$firstdate = date ("Y-m-d", strtotime("-7 day", strtotime($CompairDate)));
					if(strtotime($end_date) > strtotime($CompairDate)){
						$start_date = date ("Y-m-d", strtotime("+7 day", strtotime($start_date)));
					}
					else{
						$x=1;
						$start_date = date ("Y-m-t", strtotime($start_date));
					}
					
					
					$TA=$this->Users->find()->where(['Users.role_id'=>1,'create_at >='=>$firstdate,'create_at <='=>$start_date])->count();
					$TravelAgentCount[]=$TA;
					
					$EP=$this->Users->find()->where(['Users.role_id'=>2,'create_at >='=>$firstdate,'create_at <='=>$start_date])->count();
					$EventPlannerCount[]=$EP;
					
					$H=$this->Users->find()->where(['Users.role_id'=>3,'create_at >='=>$firstdate,'create_at <='=>$start_date])->count();
					$HotelierCount[]=$H;
					
					$MonthName[]=date('d-M',strtotime($firstdate)).' - '.date('d-M',strtotime($start_date));
					
					$TotalRegistration[]=$TA+$EP+$H;
					 
					if($x==1){break;}
				}
			}
  		}
		else if(!empty($year_from) && !empty($year_to)){
			$years = range ($year_from,$year_to);
			foreach($years as $year)
			{
 				$first_date='01-01-'.$year;
				$first_date=date('Y-m-d',strtotime($first_date));

				$last_date='31-12-'.$year;
				$last_date=date('Y-m-t',strtotime($last_date));
				
				$Month_name=$year;
				//-- COUNTRING
				
				$TA=$this->Users->find()->where(['Users.role_id'=>1,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$TravelAgentCount[]=$TA;
				
				$EP=$this->Users->find()->where(['Users.role_id'=>2,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$EventPlannerCount[]=$EP;
				
				$H=$this->Users->find()->where(['Users.role_id'=>3,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$HotelierCount[]=$H;
				
				$MonthName[]=$Month_name;
				
				$TotalRegistration[]=$TA+$EP+$H;
			}
		}
		else
		{
			
			foreach($States as $state)
			{
				$state_id=$state['id'];
				$state_name=$state['state_name'];
				$current_year=date('Y');
				$first_date='01-01-'.$current_year;
				$last_date='31-12-'.$current_year;
				$first_date=date('Y-m-d',strtotime($first_date));
				$last_date=date('Y-m-d',strtotime($last_date));
				
				$Categories=$state_name;
				//-- COUNTRING
				$TA=$this->Users->find()->where(['state_id'=>$state_id,'Users.role_id'=>1,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$TravelAgentCount[]=$TA;
				
				$EP=$this->Users->find()->where(['state_id'=>$state_id,'Users.role_id'=>2,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$EventPlannerCount[]=$EP;
				
				$H=$this->Users->find()->where(['state_id'=>$state_id,'Users.role_id'=>3,'create_at >='=>$first_date,'create_at <='=>$last_date])->count();
				$HotelierCount[]=$H;
				
				$MonthName[]=$Categories;
				
				$TotalRegistration[]=$TA+$EP+$H;
			}
		}
		//-- For Excel
		$this->set('TArray',$TotalRegistration);
		$this->set('TAArray',$TravelAgentCount);
		$this->set('EPArray',$EventPlannerCount);
		$this->set('HArray',$HotelierCount);
		$this->set('MonthArray',$MonthName);
		//-- For Graph
		$TotalRegistration=implode(',', $TotalRegistration);
		$TravelAgentCount=implode(',', $TravelAgentCount);
		$EventPlannerCount=implode(',', $EventPlannerCount);
		$HotelierCount=implode(',', $HotelierCount); 
		
		$MonthName=implode("','", $MonthName); 
		$MonthName="'".$MonthName."'";
		$this->set(compact('TravelAgentCount','EventPlannerCount','HotelierCount','TotalRegistration','MonthName'));
    }
	
	
	public function pdfExcel() 
    {
		$this->viewBuilder()->layout('');
        if(isset($this->request->data['excel']))
        {	
			$this->set('export_data', $this->request->data['export_data']);
			$this->set('file_name', $this->request->data['file_name']);
			$this->set('export_in', 'excel');
 		 
        }
        if(isset($this->request->data['pdf']))
        {
			$this->set('export_data', $this->request->data['data_export']);
			$this->set('application_no', $this->request->data['pdf_name']);
			$this->set('export_in', 'pdf');
			
            $this->layout='pdf';
            $this->set('file_name', $this->request->data['pdf']);
        }
    }
	
}
