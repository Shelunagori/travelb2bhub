<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PostTravlePackages Controller
 *
 * @property \App\Model\Table\PostTravlePackagesTable $PostTravlePackages
 */
class PostTravlePackagesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
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
		$this->loadModel('Requests');
		$this->loadModel('Responses');
		$current_date=date('Y-m-d');
		
		$conditions[]= array (
			'OR' => array(
				array("Requests.start_date >=" =>  $current_date,'Requests.category_id'=> 2),
				array("Requests.check_in >=" =>  $current_date,'Requests.category_id !='=> 2),
				
				array("Requests.check_in <=" =>  $current_date,'Requests.category_id !='=> 2,'Requests.total_response >' =>0),
				array("Requests.check_in <=" =>  $current_date,'Requests.category_id !='=> 2,'Requests.total_response >' =>0),
			)
		);
		//,'Requests.total_response >' =>0
		$conditionsss[]= array (
			'OR' => array(
				array("Requests.start_date >=" =>  $current_date,'Requests.category_id'=> 2),
				array("Requests.check_in >=" =>  $current_date,'Requests.category_id !='=> 2),
			)
		);
		
		$this->set("respondToRequestCountNew", $this->__getRespondToRequestCount());
		$this->loadModel('BlockedUsers');
		$BlockedUsers = $this->BlockedUsers->find('list',['keyField' => "id",'valueField' => 'blocked_user_id'])
			->hydrate(false)
			->where(['blocked_by' => $loginId])
			->toArray();
		$myBlockedUsers = $this->BlockedUsers->find('list',['keyField' => "id",'valueField' => 'blocked_by'])
			->hydrate(false)
			->where(['blocked_user_id' => $loginId])
			->toArray();
		if(!empty($BlockedUsers)) {
			$BlockedUsers = array_values($BlockedUsers);
		}
		if(!empty($myBlockedUsers)) {
			$myBlockedUsers = array_values($myBlockedUsers);
		}
		$BlockedUsers=array_merge($BlockedUsers,$myBlockedUsers);
		$BlockedUsers = array_unique($BlockedUsers);
		array_push($BlockedUsers,$loginId);
		if(sizeof($BlockedUsers)>0){
			$conditionssd["Requests.user_id NOT IN"] =  $BlockedUsers; 
		}
		
		$myRequestCount = 0;
 		$query = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2,$conditions]]);
		$myRequestCount = $query->count(); 
		$reqcountNew = $this->getSettings('requestcount');
 		$this->set('reqcountNew', $reqcountNew);
 		$this->set('myRequestCountNew', $myRequestCount);
 		$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Responses.status' =>0,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id')]])->where(["Requests.user_id NOT IN"=>$BlockedUsers]);
		$myReponseCount = $queryr->count(); 
		
		$this->set('myReponseCountNew', $myReponseCount);
 		//----	 FInalized
 		$finalreq["Requests.user_id"] = $this->Auth->user('id');
		$finalreq["Requests.status"] = 2;
		$finalreq["Requests.is_deleted "] = 0;
		$finalizeRequest = $this->Requests->find()->where($finalreq)->count();
		$this->set('finalizeRequestNew', $finalizeRequest);
		//--- Removed Request
		$remoev["Requests.user_id"] = $this->Auth->user('id');
		$remoev["Requests.is_deleted "] = 1;
		$RemovedReqest = $this->Requests->find()->where($remoev)->count();
		$this->set('RemovedReqestNew', $RemovedReqest);
		//--- Blocked User
		$this->loadModel('blocked_users');
		$blk["blocked_users.blocked_by"] = $this->Auth->user('id');
		$blockedUserscount = $this->blocked_users->find()->where($blk)->count();
		$this->set('blockedUserscountnew', $blockedUserscount);
		//--- Finalize Response;
		
		$FInalResponseCount = $this->Responses->find('all', ['conditions' => ['Responses.status' =>1,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id')]])->count();
		$this->set('FInalResponseCountNew', $FInalResponseCount);
		//*--- UserChats
		$this->loadModel('UserChats');
		$csort['created'] = "DESC";
		$new_time = date("Y-m-d H:i:s", strtotime('-24 hours'));
		$totalIds=array();
		$NewNotifications=array();
		$unreadnotification = $this->UserChats->find()->contain(['Users'])->where(['UserChats.send_to_user_id'=> $this->Auth->user('id'),'created >='=>$new_time,'is_read'=>1])->order($csort)->all();
		foreach($unreadnotification as $data){
 				$totalIds[]=$data['id'];
		}
		
		$unreadnotification2 = $this->UserChats->find()->contain(['Users'])->where(['UserChats.send_to_user_id'=> $this->Auth->user('id'),'is_read'=>0])->order($csort)->all();
		foreach($unreadnotification2 as $datas){
			$totalIds[]=$datas['id'];
		}
		//pr($unreadnotification2); exit;
		if(!empty($totalIds)){
			$NewNotifications = $this->UserChats->find()->contain(['Users'])->where(['UserChats.id IN'=> $totalIds])->order($csort)->all();
		}
		$chatCount = $this->UserChats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->count(); 
 		$this->set('chatCount',$chatCount); 
		$this->set('NewNotifications',$NewNotifications);
		//pr($totalIds); exit;
		//---
 	}
	
	public function ajaxCity($country_id = null)
	{
		$this->loadModel('Cities');
		 $country_id=$this->request->data('country_id');
	  $countryArray=explode(',',$country_id);
 	$citiesapi = $this->Cities->find()->contain(['States'])->where(['Cities.is_deleted'=>0,'Cities.country_id IN'=>$countryArray]);
 	foreach($citiesapi as $citiesa){
		
		$city_id=$citiesa->id;
		$city_name=$citiesa->name;
		$state_name=$citiesa->state->state_name;
		
		echo '<option value="'.$city_id.'">'.$city_name.' ('.$state_name.')</option>';
	}
		exit; 
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
		$this->loadModel('Users');
		$current_date=date('Y-m-d');
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
		$conditions[]= array (
			'OR' => array(
				array("Requests.start_date >=" =>  $current_date,'Requests.category_id'=> 2),
				array("Requests.check_in >=" =>  $current_date,'Requests.category_id !='=> 2),
			)
		);
		if ($this->Auth->user('role_id') == 1) { // Travel Agent
			if(!empty($user["preference"])) {
				$conditionalStates = array_unique(explode(",", $user["preference"]));
			} else {
				$conditionalStates =  $user["state_id"];
			}
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
    
    public function view($id = null)
    {
		$this->viewBuilder()->layout('user_layout');
		$user_id=$this->Auth->User('id');
		$this->set(compact('user_id','id'));
		$user_id=$this->Auth->User('id');
		if ($this->request->is(['patch', 'post', 'put'])) 
		{
			//pr($this->request->data); exit;
			//-- REMOVE EVENT
		 	if (isset($this->request->data['removeposttravle']))
			{
 				$posttravle_id=$this->request->data('posttravle_id');
				//pr($posttravle_id);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/PostTravlePackages/removePostTravelPackages.json?post_travel_id=".$posttravle_id,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 899aa26c-f697-c513-89c1-b6bba1e1fbdf"
				  ),
				));

				$removeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				  $removeResult=json_decode($removeResponse);
				}
				$displayMessage=$removeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'view/'.$posttravle_id]);
			} 
			//-- Like EVENT
			if(isset($this->request->data['LikeEvent']))
			{
 				$posttravle_id=$this->request->data('posttravle_id');
				$post =[
						'post_travle_package_id' => $posttravle_id,
						'user_id' =>$user_id						 							
					];
					//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/PostTravlePackages/likePostTravelPackages.json",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>$post,
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 7e320187-3288-d2ad-e6f3-890260c02fc7"
				  ),
				));
				$LikeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				 $LikeResult=json_decode($LikeResponse);
				} 
				$displayMessage=$LikeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'view/'.$posttravle_id]);
			}
			//---Save cart TaxiFleet Promotion
			if(isset($this->request->data['saveposttravle']))
			{
				$user_id=$this->Auth->User('id');
				$posttravle_id=$this->request->data('posttravle_id');
				$post =[
						'post_travle_package_id' => $posttravle_id,
						'user_id' =>$user_id						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/PostTravlePackageCarts/postTravlePackageCartAdd.json",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>$post,
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 7e320187-3288-d2ad-e6f3-890260c02fc7"
				  ),
				));
				$LikeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				 $LikeResult=json_decode($LikeResponse);
				} 
				$displayMessage=$LikeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'view/'.$posttravle_id]);
			} 
			//Report Modal
			if(isset($this->request->data['report_submit']))
			{
				$user_id=$this->Auth->User('id');
				$posttravle_id=$this->request->data('posttravle_id');
				$report_reason_id=$this->request->data('report_reason_id');
				$comment=$this->request->data('comment');
				$post =[
						'post_travle_package_id' => $posttravle_id,
						'report_reason_id' => $report_reason_id,
						'user_id' =>$user_id,						 							
						'comment' =>$comment						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/PostTravlePackageReports/PostTravlePackageReportAdd.json",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>$post,
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 7e320187-3288-d2ad-e6f3-890260c02fc7"
				  ),
				));
				$LikeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				 $LikeResult=json_decode($LikeResponse);
				} 
				$displayMessage=$LikeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'view/'.$posttravle_id]);
			}
		}
    }
 
    public function add()
    {
		$this->viewBuilder()->layout('user_layout');
		$user_id=$this->Auth->User('id');
		$this->set(compact('user_id'));
    }

    public function edit($id = null)
    {
        $postTravlePackage = $this->PostTravlePackages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postTravlePackage = $this->PostTravlePackages->patchEntity($postTravlePackage, $this->request->data);
            if ($this->PostTravlePackages->save($postTravlePackage)) {
                $this->Flash->success(__('The post travle package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post travle package could not be saved. Please, try again.'));
        }
        $currencies = $this->PostTravlePackages->Currencies->find('list', ['limit' => 200]);
        $countries = $this->PostTravlePackages->Countries->find('list', ['limit' => 200]);
        $priceMasters = $this->PostTravlePackages->PriceMasters->find('list', ['limit' => 200]);
        $users = $this->PostTravlePackages->Users->find('list', ['limit' => 200]);
        $this->set(compact('postTravlePackage', 'currencies', 'countries', 'priceMasters', 'users'));
        $this->set('_serialize', ['postTravlePackage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Post Travle Package id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $postTravlePackage = $this->PostTravlePackages->get($id);
        if ($this->PostTravlePackages->delete($postTravlePackage)) {
            $this->Flash->success(__('The post travle package has been deleted.'));
        } else {
            $this->Flash->error(__('The post travle package could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	public function report($higestSort = null,$country_id = null,$category_id = null,$duration_day_night = null,$starting_price = null,$posttravle_id= null,$removeposttravle= null,$saveposttravle= null)
    {
		$higestSort=$this->request->query('higestSort'); 
		$country_id=$this->request->query('country_id'); 
		$category_id=$this->request->query('category_id'); 
		$duration_day_night=$this->request->query('duration_day_night'); 
		$starting_price=$this->request->query('starting_price'); 
		 //-- REMOVE PARAMETER
		$user_id=$this->Auth->User('id');
		if ($this->request->is(['patch', 'post', 'put'])) 
		{
			//pr($this->request->data); exit;
			//-- REMOVE EVENT
		 	if (isset($this->request->data['removeposttravle']))
			{
 				$posttravle_id=$this->request->data('posttravle_id');
				//pr($posttravle_id);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/PostTravlePackages/removePostTravelPackages.json?post_travel_id=".$posttravle_id,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 899aa26c-f697-c513-89c1-b6bba1e1fbdf"
				  ),
				));

				$removeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				  $removeResult=json_decode($removeResponse);
				}
				$displayMessage=$removeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'report']);
			} 
			//-- Like EVENT
			if(isset($this->request->data['LikeEvent']))
			{
 				$posttravle_id=$this->request->data('posttravle_id');
				$post =[
						'post_travle_package_id' => $posttravle_id,
						'user_id' =>$user_id						 							
					];
					//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/PostTravlePackages/likePostTravelPackages.json",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>$post,
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 7e320187-3288-d2ad-e6f3-890260c02fc7"
				  ),
				));
				$LikeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				 $LikeResult=json_decode($LikeResponse);
				} 
				$displayMessage=$LikeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'report']);
			}
			//---Save cart TaxiFleet Promotion
			if(isset($this->request->data['saveposttravle']))
			{
				$user_id=$this->Auth->User('id');
				$posttravle_id=$this->request->data('posttravle_id');
				$post =[
						'post_travle_package_id' => $posttravle_id,
						'user_id' =>$user_id						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/PostTravlePackageCarts/postTravlePackageCartAdd.json",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>$post,
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 7e320187-3288-d2ad-e6f3-890260c02fc7"
				  ),
				));
				$LikeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				 $LikeResult=json_decode($LikeResponse);
				} 
				$displayMessage=$LikeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'report']);
			} 
			//Report Modal
			if(isset($this->request->data['report_submit']))
			{
				$user_id=$this->Auth->User('id');
				$posttravle_id=$this->request->data('posttravle_id');
				$report_reason_id=$this->request->data('report_reason_id');
				$comment=$this->request->data('comment');
				$post =[
						'post_travle_package_id' => $posttravle_id,
						'report_reason_id' => $report_reason_id,
						'user_id' =>$user_id,						 							
						'comment' =>$comment						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/PostTravlePackageReports/PostTravlePackageReportAdd.json",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>$post,
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 7e320187-3288-d2ad-e6f3-890260c02fc7"
				  ),
				));
				$LikeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				 $LikeResult=json_decode($LikeResponse);
				} 
				$displayMessage=$LikeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'report']);
			}
		}
		
		$this->viewBuilder()->layout('user_layout');
        $user_id=$this->Auth->User('id');
		$this->set(compact('user_id','higestSort','country_id','category_id','duration_day_night','starting_price'));
    }
	
	public function moredata()
	{
		$page=$this->request->data['page'];
		$user_id=$this->request->data['user_id'];
		$higestSort=$this->request->data['higestSort'];
		$country_id=$this->request->data['country_id'];
		$category_id=$this->request->data['category_id'];
		$duration_day_night=$this->request->data['duration_day_night'];
		$starting_price=$this->request->data['starting_price'];
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => $this->coreVariable['SiteUrl']."api/PostTravlePackages/getTravelPackages.json?isLikedUserId=".$user_id."&higestSort=".$higestSort."&country_id=".$country_id."&category_id=".$category_id."&duration_day_night=".$duration_day_night."&starting_price=".$starting_price."&page=".$page,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"postman-token: 4f8087cd-6560-4ca6-5539-9499d3c5b967"
		  ),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$postTravlePackages=array();
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$response;
			$List=json_decode($response);
			  
			$postTravlePackages=$List->getTravelPackages;
		}
		$this->set(compact('postTravlePackages'));
		
	}
	 public function promotionreports()
    {
		$this->viewBuilder()->layout('user_layout');
		$user_id=$this->Auth->User('id');
		if ($this->request->is(['patch', 'post', 'put'])) 
		{
				//-- Renew promotion
			if(isset($this->request->data['pay_now']))
			{
 				$post_travel_id=$this->request->data('post_travel_id');
 				$price_master_id=$this->request->data('price_master_id');
 				$visible_date=$this->request->data('visible_date');
 				$payment_amount=$this->request->data('payment_amount');
				$curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => $this->coreVariable['SiteUrl']."api/PostTravlePackages/renewPostTravelPackage.json?post_travel_id=".$post_travel_id."&price_master_id=".$price_master_id."&price=".$payment_amount."&visible_date=".$visible_date,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 7e320187-3288-d2ad-e6f3-890260c02fc7"
				  ),
				));
				$LikeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				 $LikeResult=json_decode($LikeResponse);
				} 
				//pr($LikeResult);exit;
				$displayMessage=$LikeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'promotionreports']);
			}
				//-- Remove promotion
			if(isset($this->request->data['removepackage']))
			{
 				$remove_package_id=$this->request->data('remove_package_id');
				$curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => $this->coreVariable['SiteUrl']."api/PostTravlePackages/removePostTravelPackages.json?post_travel_id=".$remove_package_id,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 7e320187-3288-d2ad-e6f3-890260c02fc7"
				  ),
				));
				$LikeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				 $LikeResult=json_decode($LikeResponse);
				} 
				//pr($LikeResult);exit;
				$displayMessage=$LikeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'promotionreports']);
			}
		}
		
		$this->set(compact('user_id'));
    } 
	public function likersList($post_travel_id = null)
    {
		$this->viewBuilder()->layout('user_layout');
		$user_id=$this->Auth->User('id');
		if ($this->request->is(['patch', 'post', 'put'])) 
		{
				//-- Follow User
			if(isset($this->request->data['follow_user']))
			{
 				$follow_id=$this->request->data('follow_id');
				$post =[
						'follow_id' => $follow_id,
						'user_id' =>$user_id						 							
					];
					//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => $this->coreVariable['SiteUrl']."pages/addbusinessbuddyapi?token=MzIxNDU2NjU0NTY0cGhmZmpoZGZqaA==",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>$post,
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 7e320187-3288-d2ad-e6f3-890260c02fc7"
				  ),
				));
				$LikeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				 $LikeResult=json_decode($LikeResponse);
				} 
				$displayMessage="You have been successfully followed this user  ";
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'likersList/'.$post_travel_id]);
			}
			//-- UnFollow User
			if(isset($this->request->data['unfollow_user']))
			{
 				$follow_id=$this->request->data('follow_id');
				$post =[
						'follow_id' => $follow_id,
						'user_id' =>$user_id						 							
					];
					//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => $this->coreVariable['SiteUrl']."pages/removebusinessbuddyapi?token=MzIxNDU2NjU0NTY0cGhmZmpoZGZqaA==",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>$post,
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 7e320187-3288-d2ad-e6f3-890260c02fc7"
				  ),
				));
				$LikeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				 $LikeResult=json_decode($LikeResponse);
				} 
				$displayMessage="You have been successfully unfollowed this user  ";
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'likersList/'.$post_travel_id]);
			}
		}
		$this->set(compact('user_id','post_travel_id'));
    }
	public function viewersList($post_travel_id = null)
    {
		$this->viewBuilder()->layout('user_layout');
		$user_id=$this->Auth->User('id');
		if ($this->request->is(['patch', 'post', 'put'])) 
		{
				//-- Follow User
			if(isset($this->request->data['follow_user']))
			{
 				$follow_id=$this->request->data('follow_id');
				$post =[
						'follow_id' => $follow_id,
						'user_id' =>$user_id						 							
					];
					//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => $this->coreVariable['SiteUrl']."pages/addbusinessbuddyapi?token=MzIxNDU2NjU0NTY0cGhmZmpoZGZqaA==",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>$post,
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 7e320187-3288-d2ad-e6f3-890260c02fc7"
				  ),
				));
				$LikeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				 $LikeResult=json_decode($LikeResponse);
				} 
				$displayMessage="You have been successfully followed this user  ";
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'viewersList/'.$post_travel_id]);
			}
			//-- UnFollow User
			if(isset($this->request->data['unfollow_user']))
			{
 				$follow_id=$this->request->data('follow_id');
				$post =[
						'follow_id' => $follow_id,
						'user_id' =>$user_id						 							
					];
					//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => $this->coreVariable['SiteUrl']."pages/removebusinessbuddyapi?token=MzIxNDU2NjU0NTY0cGhmZmpoZGZqaA==",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>$post,
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 7e320187-3288-d2ad-e6f3-890260c02fc7"
				  ),
				));
				$LikeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				 $LikeResult=json_decode($LikeResponse);
				} 
				$displayMessage="You have been successfully unfollowed this user  ";
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'viewersList/'.$post_travel_id]);
			}
		}
		$this->set(compact('user_id','post_travel_id'));
    }
	 public function savedList($user_id = null)
    {
		$this->viewBuilder()->layout('user_layout');
		$user_id=$this->Auth->User('id');
		if ($this->request->is(['patch', 'post', 'put'])) 
		{
			//-- REMOVE EVENT
		 	if (isset($this->request->data['removeposttravle']))
			{
 				$posttravle_id=$this->request->data('posttravle_id');
				//pr($posttravle_id);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/PostTravlePackages/removePostTravelPackages.json?post_travel_id=".$posttravle_id,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 899aa26c-f697-c513-89c1-b6bba1e1fbdf"
				  ),
				));

				$removeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				  $removeResult=json_decode($removeResponse);
				}
				$displayMessage=$removeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'savedList/'.$user_id]);
			} 
			//-- Like EVENT
			if(isset($this->request->data['LikeEvent']))
			{
 				$posttravle_id=$this->request->data('posttravle_id');
				$post =[
						'post_travle_package_id' => $posttravle_id,
						'user_id' =>$user_id						 							
					];
					//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/PostTravlePackages/likePostTravelPackages.json",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>$post,
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 7e320187-3288-d2ad-e6f3-890260c02fc7"
				  ),
				));
				$LikeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				 $LikeResult=json_decode($LikeResponse);
				} 
				$displayMessage=$LikeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'savedList/'.$user_id]);
			}
			//---Save cart TaxiFleet Promotion
			if(isset($this->request->data['saveposttravle']))
			{
				$user_id=$this->Auth->User('id');
				$posttravle_id=$this->request->data('posttravle_id');
				$post =[
						'post_travle_package_id' => $posttravle_id,
						'user_id' =>$user_id						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/PostTravlePackageCarts/postTravlePackageCartAdd.json",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>$post,
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 7e320187-3288-d2ad-e6f3-890260c02fc7"
				  ),
				));
				$LikeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				 $LikeResult=json_decode($LikeResponse);
				} 
				$displayMessage=$LikeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'savedList/'.$user_id]);
			} 
			//Report Modal
			if(isset($this->request->data['report_submit']))
			{
				$user_id=$this->Auth->User('id');
				$posttravle_id=$this->request->data('posttravle_id');
				$report_reason_id=$this->request->data('report_reason_id');
				$comment=$this->request->data('comment');
				$post =[
						'post_travle_package_id' => $posttravle_id,
						'report_reason_id' => $report_reason_id,
						'user_id' =>$user_id,						 							
						'comment' =>$comment						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/PostTravlePackageReports/PostTravlePackageReportAdd.json",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>$post,
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 7e320187-3288-d2ad-e6f3-890260c02fc7"
				  ),
				));
				$LikeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				 $LikeResult=json_decode($LikeResponse);
				} 
				$displayMessage=$LikeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'savedList/'.$user_id]);
			}
		}
		$this->set(compact('user_id'));
    }
    
	
	
	
}
