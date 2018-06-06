<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
date_default_timezone_set('Asia/Kolkata');
/**
 * TaxiFleetPromotions Controller
 *
 * @property \App\Model\Table\TaxiFleetPromotionsTable $TaxiFleetPromotions
 */	
class TaxiFleetPromotionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null*/
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		$loginId=$this->Auth->User('id');  
		if(!empty($loginId)){
			//--- Blocked
			$this->loadModel('Users');
			$UsersData=$this->Users->find()->where(['id'=>$loginId])->first();
			$blocked=$UsersData['blocked'];
			if($blocked==1){
				$this->redirect($this->Auth->logout());
				$this->Flash->error(__('You are blocked by Administrator.'));	
			}
			//--Blocked
			$first_name=$this->Auth->User('first_name');
			$last_name=$this->Auth->User('last_name');
			$profile_pic=$this->Auth->User('profile_pic');    
			
			$role_id=$this->Auth->User('role_id');
			$authUserName=$first_name.' '.$last_name;
			$this->set('MemberName',$authUserName);
			$this->set('profile_pic', $profile_pic);
			$this->set('loginId',$loginId);
			$this->set('roleId',$role_id);
			//--
			$this->loadModel('Requests');
			$this->loadModel('Responses');
			$current_date=date('Y-m-d');
			
			$conditions[]= array (
				'OR' => array(
					array("Requests.start_date >=" =>  $current_date,'Requests.category_id'=> 2),
					array("Requests.check_in >=" =>  $current_date,'Requests.category_id !='=> 2),
					array("Requests.start_date <=" =>  $current_date,'Requests.category_id'=> 2,'Requests.total_response >' =>0),
					array("Requests.check_in <=" =>  $current_date,'Requests.category_id !='=> 2,'Requests.total_response >' =>0),
				)
			);
			 
			$this->set("respondToRequestCountNew", $this->__getRespondToRequestCount());
			//-- Block USER
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
			//---
			$reqcountNew = $this->getSettings('requestcount');
			$this->set('reqcountNew', $reqcountNew);

			$myRequestCount = 0;
			$myRequestCount = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2, $conditions]])->count();
			$this->set('myRequestCountNew', $myRequestCount);

			$RequestCount1 = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.total_response"=>0,"Requests.status !="=>2,'is_deleted'=>0, $conditions]])->count();
			
			$RequestCount = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.total_response >"=>0,"Requests.status !="=>2,'is_deleted'=>1, $conditions]])->count();
			$PlaceReqCount=$reqcountNew['value']-($RequestCount+$RequestCount1);
			$this->set('PlaceReqCount', $PlaceReqCount);
			
			$queryr = $this->Responses->find('all', ['contain' => ["Requests.Users", "UserChats","Requests.Hotels"],'conditions' => ['Requests.status' =>0,'Requests.is_deleted' =>0,'Responses.status' =>0,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id')]])->where(["Requests.user_id NOT IN"=>$BlockedUsers]);
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
			$unreadnotification = $this->UserChats->find()->contain(['Users'])->where(['UserChats.send_to_user_id'=> $this->Auth->user('id'),'read_date_time >='=>$new_time,'is_read'=>1])->order($csort)->all();
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
			$this->set('chatCountNew',$chatCount); 
			$this->set('NewNotifications',$NewNotifications);
		}
		 
		//---
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
    public function index()
    {
		$this->viewBuilder()->layout('user_layout');
        $this->paginate = [
            'contain' => ['Countries', 'PriceMasters', 'Users','TaxiFleetPromotionRows','TaxiFleetPromotionCities','TaxiFleetPromotionStates']
        ];
        $taxiFleetPromotions = $this->paginate($this->TaxiFleetPromotions);
		//pr($taxiFleetPromotions->toArray());exit;
        $this->set(compact('taxiFleetPromotions'));
        $this->set('_serialize', ['taxiFleetPromotions']);
    }

    /**
     * View method
     *
     * @param string|null $id Taxi Fleet Promotion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('user_layout');	
		$user_id=$this->Auth->User('id');
			if ($this->request->is(['patch', 'post', 'put'])) 
		{
			//-- Like EVENT
			if(isset($this->request->data['LikeEvent']))
			{
 				$taxifleet_id=$this->request->data('taxifleet_id');
				$post =[
						'taxi_fleet_promotion_id' => $taxifleet_id,
						'user_id' =>$user_id						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/TaxiFleetPromotions/likeTaxiFleetPromotions.json",
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
				return $this->redirect(['action' => 'view/'.$taxifleet_id]);
			}
		
			
		//---Save cart TaxiFleet Promotion
			if(isset($this->request->data['savetaxifleet']))
			{
				$user_id=$this->Auth->User('id');
				$taxifleet_id=$this->request->data('taxifleet_id');
				$post =[
						'taxi_fleet_promotion_id' => $taxifleet_id,
						'user_id' =>$user_id						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/TaxiFleetPromotionCarts/TaxiFleetPromotionsCartAdd.json",
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
				return $this->redirect(['action' => 'view/'.$taxifleet_id]);
			} 
			//Report Modal
			if(isset($this->request->data['report_submit']))
			{
				$user_id=$this->Auth->User('id');
				$taxifleet_id=$this->request->data('taxifleet_id');
				$report_reason_id=$this->request->data('report_reason_id');
				$comment=$this->request->data('comment');
				$post =[
						'taxi_fleet_promotion_id' => $taxifleet_id,
						'report_reason_id' => $report_reason_id,
						'user_id' =>$user_id,						 							
						'comment' =>$comment						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/TaxiFleetPromotionReports/TaxiFleetPromotionReportAdd.json",
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
				return $this->redirect(['action' => 'view/'.$taxifleet_id]);
			}
			
		}
		$this->set(compact('user_id','id'));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('user_layout');	
		$user_id=$this->Auth->User('id');
		$this->set(compact('user_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Taxi Fleet Promotion id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('admin_layout');	
		$user_id=$this->Auth->User('id');
		$this->set(compact('user_id'));
        $taxiFleetPromotion = $this->TaxiFleetPromotions->get($id, [
            'contain' => ['Users','TaxiFleetPromotionCities','TaxiFleetPromotionStates','TaxiFleetPromotionRows']
        ]);
		//pr($taxiFleetPromotion);exit;
        if ($this->request->is(['patch', 'post', 'put'])) {
			
			$ids = $taxiFleetPromotion->user_id;
			$title = $taxiFleetPromotion->title;
			$image = $this->request->data('image');
			$tmp_name = $this->request->data['image']['tmp_name'];
			$taxiFleetPromotion = $this->TaxiFleetPromotions->patchEntity($taxiFleetPromotion, $this->request->data);
			if(!empty($tmp_name))
			{	
				$dir = new Folder(WWW_ROOT . 'images/taxiFleetPromotion/'.$ids.'/'.$title.'/image', true, 0755);
				$ext = substr(strtolower(strrchr($image['name'], '.')), 1); 
				$arr_ext = array('jpg', 'jpeg','png'); 				
				
				if(!empty($ext))
				{
					if(in_array($ext, $arr_ext)) { 
						 
						if (!file_exists('path/to/directory')) {
							mkdir('path/to/directory', 0777, true);
						}
						$percentageTOReduse=100;
						if(@$submitted_from=='web')
						{
							if(($image['size']>3000000) &&($image['size']<=4000000)){
								$percentageTOReduse=50;
							}
							elseif(($image['size']>4000000) &&($image['size']<=6000000)){ 
								$percentageTOReduse=20;
							}
							elseif($image['size']>6000000){
								$percentageTOReduse=10;
							}
						}
						/* Resize Image */
						$destination_url = WWW_ROOT . '/images/taxiFleetPromotion/'.$ids.'/'.$title.'/image/'.$ids.'.'.$ext;
						if($ext=='png'){
							$image = imagecreatefrompng($image['tmp_name']);
						}else{
							$image = imagecreatefromjpeg($image['tmp_name']); 
						}
						imagejpeg($image, $destination_url, $percentageTOReduse);
						$taxiFleetPromotion->image='images/taxiFleetPromotion/'.$ids.'/'.$title.'/image/'.$ids.'.'.$ext;
						if(file_exists(WWW_ROOT . '/images/taxiFleetPromotion/'.$ids.'/'.$title.'/image/'.$ids.'.'.$ext)>0) {
						}
						else
						{
							$message = 'Image not uploaded';
							$this->Flash->error(__($message));
							 
						} 
					} 
					else 
					{ 
						$message = 'Invalid image extension';
						$this->Flash->error(__($message)); 
						 
						
					}					
				}
				else 
				{ 	
					$message = 'Invalid image extension';
					$this->Flash->error(__($message)); 
				}				
			} 
			else
			{
			    unset($taxiFleetPromotion->image);
			}
			$submitted_from = @$this->request->data('submitted_from');
			if(@$submitted_from=='web')
			{
				$state_id=$this->request->data['state_id'];
				$x=0; 
				$taxiFleetPromotion->taxi_fleet_promotion_states = [];
				$taxiFleetPromotion->taxi_fleet_promotion_cities = [];
				$taxiFleetPromotion->taxi_fleet_promotion_rows = [];
				foreach($state_id as $state)
				{
                    $taxiFleetPromotion_state = $this->TaxiFleetPromotions->TaxiFleetPromotionStates->newEntity();
					
					$taxiFleetPromotion_state->state_id = $state;
					
					$taxiFleetPromotion->taxi_fleet_promotion_states[$x]=$taxiFleetPromotion_state;
					$x++;	
 
				} 
				$city_id=$this->request->data['city_id'];
				 
				$y=0; 
				foreach($city_id as $city)
				{
					$taxiFleetPromotion_cities = $this->TaxiFleetPromotions->TaxiFleetPromotionCities->newEntity();
					$taxiFleetPromotion_cities->city_id = $city;
					$taxiFleetPromotion->taxi_fleet_promotion_cities[$y]=$taxiFleetPromotion_cities;
					$y++;	
				}
				 
				$vehicle_type=$this->request->data['vehicle_type'];
				$z=0; 
				foreach($vehicle_type as $vehicle)
				{
					$taxiFleetPromotion_row = $this->TaxiFleetPromotions->TaxiFleetPromotionRows->newEntity();$taxiFleetPromotion_row->taxi_fleet_car_bus_id = $vehicle;
					$taxiFleetPromotion->taxi_fleet_promotion_rows[$z]=$taxiFleetPromotion_row;					
					$z++;	
				}
			}
			if(!empty($this->request->data('visible_date')))
			{
				$taxiFleetPromotion->visible_date = date('Y-m-d',strtotime($this->request->data('visible_date')));
			}
			$taxiFleetPromotion->price=$this->request->data('payment_amount');
		 
			 
			if ($this->TaxiFleetPromotions->save($taxiFleetPromotion)) {
				$message = 'The Taxi/Fleet promotions has been saved';
				$this->Flash->success(__($message)); 
				$response_code = 200;
			}else{
				$message = 'The Taxi/Fleet promotions has not been saved';
				$this->Flash->error(__($message)); 
				$response_code = 204; 
			}
 			return $this->redirect(['action' => 'edit/'.$id]);
         }
        $countries = $this->TaxiFleetPromotions->Countries->find('list', ['limit' => 200]);
		$this->set(compact('taxiFleetPromotion', 'countries'));
        $this->set('_serialize', ['taxiFleetPromotion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Taxi Fleet Promotion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $taxiFleetPromotion = $this->TaxiFleetPromotions->get($id);
        if ($this->TaxiFleetPromotions->delete($taxiFleetPromotion)) {
            $this->Flash->success(__('The taxi fleet promotion has been deleted.'));
        } else {
            $this->Flash->error(__('The taxi fleet promotion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

	public function report($higestSort = null,$search = null,$country_id = null,$state_id = null,$city_id = null,$car_bus_id = null,$taxifleet_id= null,$removetaxifleet=null)
    {
        $higestSort=$this->request->query('higestSort'); 
		$city_ids=$this->request->query('city_id'); 
		if(!empty($city_ids)) {$city_id=implode(',',$city_ids);}

		$car_bus_id=$this->request->query('car_bus_id');
		if(!empty($car_bus_id)) {$car_bus_id=implode(',',$car_bus_id);}
		$state_id=$this->request->query('state_id');
		if(!empty($state_id)) {$state_id=implode(',',$state_id);}
		$search=$this->request->query('search');
		$user_id=$this->Auth->User('id');
		if ($this->request->is(['patch', 'post', 'put'])) 
		{
			//-- Like EVENT
			if (isset($this->request->data['rate_user']))
			{
				$this->loadModel('TempRatings');
				$this->loadModel('UserChats');
				$this->loadModel('Testimonial');
				$this->loadModel('Users');
				$tempRatings = $this->TempRatings->newEntity();
				
 				$promotion_id=$this->request->data('taxifleet_id');
				$this->request->data['promotion_id']=$promotion_id;
 				$author_id=$this->request->data('author_id');
 				$user_id=$this->request->data('user_id');
 				$promotion_type_id=$this->request->data('promotion_type_id');
 				$rating=$this->request->data('rating');
				$Testimonialcount = $this->Testimonial->find()->where(['promotion_id'=>$promotion_id,'author_id'=>$author_id,'user_id'=>$user_id,'promotion_type_id'=>$promotion_type_id])->count(); 
				if($Testimonialcount==0){
					$TempRatingscount = $this->TempRatings->find()->where(['promotion_id'=>$promotion_id,'author_id'=>$author_id,'user_id'=>$user_id,'promotion_type_id'=>$promotion_type_id])->count(); 
					if($TempRatingscount==0){
						$tempRatings = $this->TempRatings->patchEntity($tempRatings, $this->request->data);
						if ($datasss=$this->TempRatings->save($tempRatings)) {
							$Users=$this->Users->find()->where(['id'=>$author_id])->first();
							$Name=ucwords($Users['first_name'].' '.$Users['last_name']);  
							$userChatsS= $this->UserChats->newEntity();
							$userchats = $this->UserChats->patchEntity($userChatsS, $this->request->data);
							$userchats->user_id = $author_id;
							$userchats->request_id = 0; 
							$userchats->send_to_user_id = $user_id;
							$userchats->screen_id = $datasss->id;
							$userchats->message = $Name.' wants to give you a Review. Would you like to accept Review?';
							$userchats->type = 'Review';
							$userchats->created = date("Y-m-d H:i:s");
							$userchats->notification = 0;
							$this->UserChats->save($userchats) ; 
							$this->Flash->success(__('The user Rating/Review has been submitted.'));
						}
						else{
							$this->Flash->error(__('Something went wrong. Please, try again.'));
						}
					}
					else{$this->Flash->error(__('You have already submitted your Rating/Review'));
					}
				}
				else{$this->Flash->error(__('You have already submitted your Rating/Review'));
				}
				return $this->redirect(['action' => 'report']);
 			}
			//-- Like EVENT
			if(isset($this->request->data['LikeEvent']))
			{
 				$taxifleet_id=$this->request->data('taxifleet_id');
				$post =[
						'taxi_fleet_promotion_id' => $taxifleet_id,
						'user_id' =>$user_id						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/TaxiFleetPromotions/likeTaxiFleetPromotions.json",
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
			//---Remove TaxiFleet Promotion
			if(isset($this->request->data['removetaxifleet']))
			{
				$taxifleet_id=$this->request->data('taxifleet_id');
				//pr($taxifleet_id);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/TaxiFleetPromotions/removeTaxFlletPromotions.json?taxi_id=".$taxifleet_id,
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
			
		//---Save cart TaxiFleet Promotion
			if(isset($this->request->data['savetaxifleet']))
			{
				$user_id=$this->Auth->User('id');
				$taxifleet_id=$this->request->data('taxifleet_id');
				$post =[
						'taxi_fleet_promotion_id' => $taxifleet_id,
						'user_id' =>$user_id						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/TaxiFleetPromotionCarts/TaxiFleetPromotionsCartAdd.json",
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
				$taxifleet_id=$this->request->data('taxifleet_id');
				$report_reason_id=$this->request->data('report_reason_id');
				$comment=$this->request->data('comment');
				$post =[
						'taxi_fleet_promotion_id' => $taxifleet_id,
						'report_reason_id' => $report_reason_id,
						'user_id' =>$user_id,						 							
						'comment' =>$comment						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/TaxiFleetPromotionReports/TaxiFleetPromotionReportAdd.json",
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
		$this->set(compact('user_id','higestSort','country_id','city_id','state_id','car_bus_id','search'));
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
 				$texifleet_id=$this->request->data('texifleet_id');
 				$price_master_id=$this->request->data('price_master_id');
 				$visible_date=$this->request->data('visible_date');
 				$payment_amount=$this->request->data('payment_amount');
				$curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => $this->coreVariable['SiteUrl']."api/TaxiFleetPromotions/renewTaxiFleet.json?taxifleet_id=".$texifleet_id."&price_master_id=".$price_master_id."&price=".$payment_amount."&visible_date=".$visible_date,
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
			if(isset($this->request->data['remove_promotion']))
			{
 				$texifleet_id=$this->request->data('remove_package_id');
				$curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => $this->coreVariable['SiteUrl']."api/TaxiFleetPromotions/removeTaxFlletPromotions.json?taxi_id=".$texifleet_id,
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
	public function likersList($taxifleet_id = null)
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
				return $this->redirect(['action' => 'likersList/'.$taxifleet_id]);
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
				return $this->redirect(['action' => 'likersList/'.$taxifleet_id]);
			}
		}
		$this->set(compact('user_id','taxifleet_id'));
    }
	public function viewersList($taxifleet_id = null)
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
				return $this->redirect(['action' => 'viewersList/'.$taxifleet_id]);
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
				return $this->redirect(['action' => 'viewersList/'.$taxifleet_id]);
			}
		}
		$this->set(compact('user_id','taxifleet_id'));
    }
	public function savedList($user_id = null)
    {

		$user_id=$this->Auth->User('id');
		if ($this->request->is(['patch', 'post', 'put'])) 
		{
			//-- Like EVENT
			if(isset($this->request->data['LikeEvent']))
			{
 				$taxifleet_id=$this->request->data('taxifleet_id');
				$post =[
						'taxi_fleet_promotion_id' => $taxifleet_id,
						'user_id' =>$user_id						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/TaxiFleetPromotions/likeTaxiFleetPromotions.json",
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
			//---Remove TaxiFleet Promotion
			if(isset($this->request->data['removetaxifleet']))
			{
				$taxifleet_id=$this->request->data('taxifleet_id');
				//pr($taxifleet_id);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/TaxiFleetPromotions/removeTaxFlletPromotions.json?taxi_id=".$taxifleet_id,
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
			
		//---Save cart TaxiFleet Promotion
			if(isset($this->request->data['savetaxifleet']))
			{
				$user_id=$this->Auth->User('id');
				$taxifleet_id=$this->request->data('taxifleet_id');
				$post =[
						'taxi_fleet_promotion_id' => $taxifleet_id,
						'user_id' =>$user_id						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/TaxiFleetPromotionCarts/TaxiFleetPromotionsCartAdd.json",
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
				$taxifleet_id=$this->request->data('taxifleet_id');
				$report_reason_id=$this->request->data('report_reason_id');
				$comment=$this->request->data('comment');
				$post =[
						'taxi_fleet_promotion_id' => $taxifleet_id,
						'report_reason_id' => $report_reason_id,
						'user_id' =>$user_id,						 							
						'comment' =>$comment						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/TaxiFleetPromotionReports/TaxiFleetPromotionReportAdd.json",
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
		$this->viewBuilder()->layout('user_layout');
		$this->set(compact('user_id'));
    }
	public function cityStateList()
	{
		$this->loadModel('Cities');
		$state_id=$this->request->data['state_id'];
		$data = explode(",", $state_id);
		$CityList = $this->Cities->find()->where(['Cities.state_id IN' =>$data]);
		$options=array();
		
		//pr($options);
		
		echo "
			<select name='city_id[]' size='3' class=' form-control requiredfield city_id' required multiple='multiple' tabindex='1'>";
			foreach($CityList as $cty)
			{
				echo "<option value='".$cty->id."' > ".$cty->name."</option>";
			}
			echo "</select><label style='display:none' id='city_id[]-error' for='city_id[]' class='helpblock error' > This field is required.</label>";
		exit;
		
	}
	public function cityStateListEdit()
	{
		$this->loadModel('Cities');
		$state_id=$this->request->data['state_id'];
		$Cty_id=$this->request->data['Cty_id'];
		$Cty_idArray = explode(",", $Cty_id);
		$data = explode(",", $state_id);
		$CityList = $this->Cities->find()->where(['Cities.state_id IN' =>$data]);
		$options=array();
		
		//pr($options);
		
		echo "
			<select name='city_id[]' size='3' class=' form-control requiredfield city_id' required  multiple='multiple' tabindex='1'>";
			foreach($CityList as $cty)
			{
				if(in_array($cty->id, $Cty_idArray)){
				echo "<option selected value='".$cty->id."' > ".$cty->name."</option>";
				}
				else{
					echo "<option value='".$cty->id."' > ".$cty->name."</option>";
				}
			}
			echo "</select><label style='display:none' id='city_id[]-error' for='city_id[]' class='helpblock error' > This field is required.</label>";
		exit;
		
	}
	
	public function PackageReport($higestSort = null,$search = null,$country_id = null,$state_id = null,$city_id = null,$car_bus_id = null,$taxifleet_id= null,$removetaxifleet=null)
    {
        $higestSort=$this->request->query('higestSort'); 
		$city_ids=$this->request->query('city_id'); 
		if(!empty($city_ids)) {$city_id=implode(',',$city_ids);}

		$car_bus_id=$this->request->query('car_bus_id');
		if(!empty($car_bus_id)) {$car_bus_id=implode(',',$car_bus_id);}
		$state_id=$this->request->query('state_id');
		if(!empty($state_id)) {$state_id=implode(',',$state_id);}
		$search=$this->request->query('search');
		$user_id=$this->Auth->User('id');
		$this->viewBuilder()->layout('admin_layout');
		if ($this->request->is(['patch', 'post', 'put'])) 
		{
				//-- Renew promotion
			if(isset($this->request->data['setpriority'])){
				
				$position=$this->request->data['position'];
				
				$oldUpdate = $this->TaxiFleetPromotions->query();
				$oldUpdate->update()->set(['position' => 11])->where(['position' => $position])->execute();
				
				$texifleet_id=$this->request->data['texifleet_id'];  
				$query = $this->TaxiFleetPromotions->query();
				$query->update()->set(['position' => $position])->where(['id' => $texifleet_id])->execute();			
				$message = 'Update Successfully';
				$this->Flash->success(__($message));
				return $this->redirect(['action' => 'PackageReport']);
				
			}
			if(isset($this->request->data['pay_now']))
			{
 				$texifleet_id=$this->request->data('texifleet_id');
 				$price_master_id=$this->request->data('price_master_id');
 				$visible_date=$this->request->data('visible_date');
 				$payment_amount=$this->request->data('payment_amount');
				$curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => $this->coreVariable['SiteUrl']."api/TaxiFleetPromotions/renewTaxiFleet.json?taxifleet_id=".$texifleet_id."&price_master_id=".$price_master_id."&price=".$payment_amount."&visible_date=".$visible_date,
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
				return $this->redirect(['action' => 'PackageReport']);
			}
				//-- Remove promotion
			if(isset($this->request->data['remove_promotion']))
			{
 				$texifleet_id=$this->request->data('remove_package_id');
				$curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => $this->coreVariable['SiteUrl']."api/TaxiFleetPromotions/removeTaxFlletPromotions.json?taxi_id=".$texifleet_id,
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
				return $this->redirect(['action' => 'PackageReport']);
			}
		}
		$this->set(compact('user_id','higestSort','country_id','city_id','state_id','car_bus_id','search'));
    }
	public function adminview($id = null)
    {
        $this->viewBuilder()->layout('admin_layout');
		$user_id=$this->Auth->User('id');
		if ($this->request->is(['patch', 'post', 'put'])) 
		{
				//-- Renew promotion
			if(isset($this->request->data['pay_now']))
			{
 				$texifleet_id=$this->request->data('texifleet_id');
 				$price_master_id=$this->request->data('price_master_id');
 				$visible_date=$this->request->data('visible_date');
 				$payment_amount=$this->request->data('payment_amount');
				$curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => $this->coreVariable['SiteUrl']."api/TaxiFleetPromotions/renewTaxiFleet.json?taxifleet_id=".$texifleet_id."&price_master_id=".$price_master_id."&price=".$payment_amount."&visible_date=".$visible_date,
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
				return $this->redirect(['action' => 'adminview/'.$texifleet_id]);
			}
				//-- Remove promotion
			if(isset($this->request->data['remove_promotion']))
			{
 				$texifleet_id=$this->request->data('remove_package_id');
				$curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => $this->coreVariable['SiteUrl']."api/TaxiFleetPromotions/removeTaxFlletPromotions.json?taxi_id=".$texifleet_id,
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
				return $this->redirect(['action' => 'PackageReport']);
			}
		}
		$this->set(compact('user_id','id'));
    }
	   public function flagreport($promotion_type_id=null)
    {
        $this->viewBuilder()->layout('admin_layout');
		$promotion_id=$this->request->query('promotion_type_id');
		//pr($promotion_id);exit;
		/* $texifleetpromotionreport=$this->paginate($this->TaxiFleetPromotions->TaxiFleetPromotionReports->find()->contain(['TaxiFleetPromotions'=>['Users'],'Users','ReportReasons'])->where(['TaxiFleetPromotionReports.taxi_fleet_promotion_id'=>$promotion_id])); */
		
		//pr($texifleetpromotionreport);exit;
		
		if(isset($this->request->query['Search'])){
			$report_reason_id = $this->request->query['report_reason_id'];
			$start_date = $this->request->query['start_date'];
			$end_date = $this->request->query['end_date'];
			if(!empty($report_reason_id)){
				$conditions['TaxiFleetPromotionReports.report_reason_id']=$report_reason_id;
			}
			if(!empty($start_date)){
				$conditions['TaxiFleetPromotionReports.created_on >=']=date('Y-m-d',strtotime($start_date));
			}
			if(!empty($end_date)){
				$conditions['TaxiFleetPromotionReports.created_on <=']=date('Y-m-d',strtotime($end_date));
			}
			$texifleetpromotionreport=$this->paginate($this->TaxiFleetPromotions->TaxiFleetPromotionReports->find()->contain(['TaxiFleetPromotions'=>['Users'],'Users','ReportReasons'])->where($conditions));
			//pr($TaxiFleetPromotionReports);exit;
  		}
		else{
			$texifleetpromotionreport=$this->paginate($this->TaxiFleetPromotions->TaxiFleetPromotionReports->find()->contain(['TaxiFleetPromotions'=>['Users'],'Users','ReportReasons'])->where(['TaxiFleetPromotionReports.taxi_fleet_promotion_id'=>$promotion_id]));
		}
		
		$report_reason=$this->TaxiFleetPromotions->TaxiFleetPromotionReports->ReportReasons->find('list', ['limit' => 200]);
		$this->set(compact('texifleetpromotionreport','report_reason'));
	}
}
