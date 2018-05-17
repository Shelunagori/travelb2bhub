<?php
namespace App\Controller;
use App\Controller\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
/**
 * HotelPromotions Controller
 *
 * @property \App\Model\Table\HotelPromotionsTable $HotelPromotions
 */
class HotelPromotionsController extends AppController
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
			$myRequestCount = $this->Requests->find('all', ['conditions' => ['Requests.user_id' => $this->Auth->user('id'), "Requests.is_deleted"=>0,"Requests.status !="=>2,$conditions]])->count();
			
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
			//pr($totalIds); exit;
			$chatCount = $this->UserChats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->count(); 
			$this->set('chatCount',$chatCount); 
			$this->set('NewNotifications',$NewNotifications);
		}
		//pr($totalIds); exit;
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
            'contain' => ['Users', 'HotelCategories', 'PriceMasters']
        ];
        $hotelPromotions = $this->paginate($this->HotelPromotions);

        $this->set(compact('hotelPromotions'));
        $this->set('_serialize', ['hotelPromotions']);
    }

    /**
     * View method
     *
     * @param string|null $id Hotel Promotion id.
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
 				$hotel_id=$this->request->data('hotel_id');
				$post =[
						'hotel_promotion_id' => $hotel_id,
						'user_id' =>$user_id						 							
					];
				
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/hotel_promotions/likeHotelPromotions.json",
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
				 //pr($LikeResponse);exit;
				$displayMessage=$LikeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'view/'.$hotel_id]);
			}
		
							//-- Save Unsave
			if(isset($this->request->data['savehotelpromotion']))
			{
 				$hotel_id=$this->request->data('hotel_id');
				$post =[
						'hotel_promotion_id' => $hotel_id,
						'user_id' =>$user_id						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/HotelPromotionCarts/HotelPromotionCartAdd.json",
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
				return $this->redirect(['action' => 'view/'.$hotel_id]);
			}
								//Report Modal//
			if(isset($this->request->data['report_submit']))
			{
				$user_id=$this->Auth->User('id');
				$hotel_id=$this->request->data('hotel_id');
				$report_reason_id=$this->request->data('report_reason_id');
				$comment=$this->request->data('comment');
				$post =[
						'hotel_promotion_id' => $hotel_id,
						'report_reason_id' => $report_reason_id,
						'user_id' =>$user_id,						 							
						'comment' =>$comment						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/HotelPromotionReports/HotelPromotionReportAdd.json",
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
				return $this->redirect(['action' => 'view/'.$hotel_id]);
			}			
			
		}
		
		$this->set(compact('user_id','id'));
        /* $hotelPromotion = $this->HotelPromotions->get($id, [
            'contain' => ['Users', 'HotelCategories', 'PriceMasters', 'HotelPromotionCities', 'HotelPromotionLikes', 'HotelPromotionPriceBeforeRenews', 'HotelPromotionReports', 'HotelPromotionViews']
        ]); */
		
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		
		$this->viewBuilder()->layout('user_layout');
		$user_id=$this->Auth->User('id');
		$userss=$this->Users->find()->contain(['Cities','States'])->where(['Users.id'=>$user_id])->first();
		 
		$this->set(compact('user_id','userss'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Hotel Promotion id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('user_layout');
		$user_id=$this->Auth->User('id');
		$this->set(compact('user_id'));
        $hotelPromotion = $this->HotelPromotions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hotelPromotion = $this->HotelPromotions->patchEntity($hotelPromotion, $this->request->data);
            if ($this->HotelPromotions->save($hotelPromotion)) {
                $this->Flash->success(__('The hotel promotion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The hotel promotion could not be saved. Please, try again.'));
            }
        }
        $users = $this->HotelPromotions->Users->find('list', ['limit' => 200]);
        $hotelCategories = $this->HotelPromotions->HotelCategories->find('list', ['limit' => 200]);
        $priceMasters = $this->HotelPromotions->PriceMasters->find('list', ['limit' => 200]);
        $this->set(compact('hotelPromotion', 'users', 'hotelCategories', 'priceMasters'));
        $this->set('_serialize', ['hotelPromotion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Hotel Promotion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hotelPromotion = $this->HotelPromotions->get($id);
        if ($this->HotelPromotions->delete($hotelPromotion)) {
            $this->Flash->success(__('The hotel promotion has been deleted.'));
        } else {
            $this->Flash->error(__('The hotel promotion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function report($starting_price = null,$higestSort = null,$search = null,$category_id = null,$rating_filter = null,$hotelpromotion_id= null,$savehotelpromotion= null)
    {
		$higestSort=$this->request->query('higestSort');
		$category_id=$this->request->query('category_id');
		if(!empty($category_id)) {$category_id=implode(',',$category_id);}
		$rating_filter=$this->request->query('rating_filter');
		$search=$this->request->query('search');
		$starting_price=$this->request->query('starting_price');
		$user_id=$this->Auth->User('id');
		if ($this->request->is(['patch', 'post', 'put'])) 
		{
			//-- Like EVENT
			if(isset($this->request->data['LikeEvent']))
			{
 				$hotelpromotion_id=$this->request->data('hotelpromotion_id');
				$post =[
						'hotel_promotion_id' => $hotelpromotion_id,
						'user_id' =>$user_id						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/hotel_promotions/likeHotelPromotions.json",
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
			//---Remove Hotel  Promotion
			if(isset($this->request->data['removehotelpromtion']))
			{
				$hotelpromotion_id=$this->request->data('hotelpromotion_id');
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/hotel_promotions/removePromotion.json?promotion_id=".$hotelpromotion_id,
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
							//-- Save Unsave
			if(isset($this->request->data['savehotelpromotion']))
			{
 				$hotelpromotion_id=$this->request->data('hotelpromotion_id');
				$post =[
						'hotel_promotion_id' => $hotelpromotion_id,
						'user_id' =>$user_id						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/HotelPromotionCarts/HotelPromotionCartAdd.json",
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
								//Report Modal//
			if(isset($this->request->data['report_submit']))
			{
				$user_id=$this->Auth->User('id');
				$hotelpromotion_id=$this->request->data('hotelpromotion_id');
				$report_reason_id=$this->request->data('report_reason_id');
				$comment=$this->request->data('comment');
				$post =[
						'hotel_promotion_id' => $hotelpromotion_id,
						'report_reason_id' => $report_reason_id,
						'user_id' =>$user_id,						 							
						'comment' =>$comment						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/HotelPromotionReports/HotelPromotionReportAdd.json",
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
        $this->set(compact('user_id','search','starting_price','higestSort','category_id','rating_filter'));
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
 				$hotel_id=$this->request->data('hotel_id');
 				$price_master_id=$this->request->data('price_master_id');
 				$visible_date=$this->request->data('visible_date');
 				$payment_amount=$this->request->data('payment_amount');
				$curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => $this->coreVariable['SiteUrl']."api/hotel_promotions/renewHotelpromotion.json?promotion_id=".$hotel_id."&price_master_id=".$price_master_id."&price=".$payment_amount."&visible_date=".$visible_date,
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
 				$hotel_id=$this->request->data('hotel_id');
				$curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => $this->coreVariable['SiteUrl']."api/hotel_promotions/removePromotion.json?promotion_id=".$hotel_id,
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
	public function likersList($hotelpromotion_id = null)
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
				return $this->redirect(['action' => 'likersList/'.$hotelpromotion_id]);
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
				return $this->redirect(['action' => 'likersList/'.$hotelpromotion_id]);
			}
		}
		$this->set(compact('user_id','hotelpromotion_id'));
    }
	public function viewersList($hotelpromotion_id = null)
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
				return $this->redirect(['action' => 'viewersList/'.$hotelpromotion_id]);
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
				return $this->redirect(['action' => 'viewersList/'.$hotelpromotion_id]);
			}
		}
		$this->set(compact('user_id','hotelpromotion_id'));
    }
	public function savedList($user_id = null)
    {
		$this->viewBuilder()->layout('user_layout');
		$user_id=$this->Auth->User('id');
			if ($this->request->is(['patch', 'post', 'put'])) 
		{
			//-- Like EVENT
			if(isset($this->request->data['LikeEvent']))
			{
 				$hotelpromotion_id=$this->request->data('hotelpromotion_id');
				$post =[
						'hotel_promotion_id' => $hotelpromotion_id,
						'user_id' =>$user_id						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/hotel_promotions/likeHotelPromotions.json",
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
			//---Remove Hotel  Promotion
			if(isset($this->request->data['removehotelpromtion']))
			{
				$hotelpromotion_id=$this->request->data('hotelpromotion_id');
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/hotel_promotions/removePromotion.json?promotion_id=".$hotelpromotion_id,
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
			//-- Save Unsave
			if(isset($this->request->data['savehotelpromotion']))
			{
 				$hotelpromotion_id=$this->request->data('hotelpromotion_id');
				$post =[
						'hotel_promotion_id' => $hotelpromotion_id,
						'user_id' =>$user_id						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/HotelPromotionCarts/HotelPromotionCartAdd.json",
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
				//pr($LikeResponse);exit;				
				$displayMessage=$LikeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'savedList/'.$user_id]);
			}
								//Report Modal//
			if(isset($this->request->data['report_submit']))
			{
				$user_id=$this->Auth->User('id');
				$hotelpromotion_id=$this->request->data('hotelpromotion_id');
				$report_reason_id=$this->request->data('report_reason_id');
				$comment=$this->request->data('comment');
				$post =[
						'hotel_promotion_id' => $hotelpromotion_id,
						'report_reason_id' => $report_reason_id,
						'user_id' =>$user_id,						 							
						'comment' =>$comment						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/HotelPromotionReports/HotelPromotionReportAdd.json",
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
	
	public function PackageReport($starting_price = null,$higestSort = null,$search = null,$category_id = null,$rating_filter = null,$hotelpromotion_id= null,$savehotelpromotion= null)
    {
		$higestSort=$this->request->query('higestSort');
		$category_id=$this->request->query('category_id');
		if(!empty($category_id)) {$category_id=implode(',',$category_id);}
		$rating_filter=$this->request->query('rating_filter');
		$search=$this->request->query('search');
		$starting_price=$this->request->query('starting_price');
		$user_id=$this->Auth->User('id');
		$this->viewBuilder()->layout('admin_layout');
		$user_id=$this->Auth->User('id');
		if ($this->request->is(['patch', 'post', 'put'])) 
		{
				//-- Renew promotion
			if(isset($this->request->data['pay_now']))
			{
 				$hotel_id=$this->request->data('hotel_id');
 				$price_master_id=$this->request->data('price_master_id');
 				$visible_date=$this->request->data('visible_date');
 				$payment_amount=$this->request->data('payment_amount');
				$curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => $this->coreVariable['SiteUrl']."api/hotel_promotions/renewHotelpromotion.json?promotion_id=".$hotel_id."&price_master_id=".$price_master_id."&price=".$payment_amount."&visible_date=".$visible_date,
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
			if(isset($this->request->data['removepackage']))
			{
 				$hotel_id=$this->request->data('hotel_id');
				$curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => $this->coreVariable['SiteUrl']."api/hotel_promotions/removePromotion.json?promotion_id=".$hotel_id,
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
        $this->set(compact('user_id','search','starting_price','higestSort','category_id','rating_filter'));
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
 				$hotel_id=$this->request->data('hotel_id');
 				$price_master_id=$this->request->data('price_master_id');
 				$visible_date=$this->request->data('visible_date');
 				$payment_amount=$this->request->data('payment_amount');
				$curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => $this->coreVariable['SiteUrl']."api/hotel_promotions/renewHotelpromotion.json?promotion_id=".$hotel_id."&price_master_id=".$price_master_id."&price=".$payment_amount."&visible_date=".$visible_date,
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
				return $this->redirect(['action' => 'adminview/'.$hotel_id]);
			}
			//-- Remove promotion
			if(isset($this->request->data['removepackage']))
			{
 				$hotel_id=$this->request->data('hotel_id');
				$curl = curl_init();
				curl_setopt_array($curl, array(
				 CURLOPT_URL => $this->coreVariable['SiteUrl']."api/hotel_promotions/removePromotion.json?promotion_id=".$hotel_id,
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
	
	public function adminedit($id=null)
    {
		$this->viewBuilder()->layout('admin_layout');
		$hotelPromotion = $this->HotelPromotions->get($id, [
            'contain' => ['Users']
        ]);
		
		if ($this->request->is(['patch', 'post', 'put'])) 
		{
			$ids=$hotelPromotion->user_id;
			$title = $ids.'hotel_'.rand();
			$image = $this->request->data('hotel_pic');
			$tmp_name = $this->request->data['hotel_pic']['tmp_name'];
			if(!empty($tmp_name))
			{	
				$dir = new Folder(WWW_ROOT . 'img/hotels/', true, 0755);
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
						$destination_url = WWW_ROOT . '/img/hotels/'.$title.'.'.$ext;
						if($ext=='png'){
							$image = imagecreatefrompng($image['tmp_name']);
						}else{
							$image = imagecreatefromjpeg($image['tmp_name']); 
						}
						imagejpeg($image, $destination_url, $percentageTOReduse);
						$hotelPromotion->hotel_pic='img/hotels/'.$title.'.'.$ext;
						if(file_exists(WWW_ROOT . '/img/hotels/'.$title.'.'.$ext)>0) {
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
			 
			if(!empty($this->request->data('visible_date')))
			{
				$hotelPromotion->visible_date = date('Y-m-d',strtotime($this->request->data('visible_date')));
			}
			$hotelPromotion = $this->HotelPromotions->patchEntity($hotelPromotion, $this->request->data);
///pr($hotelPromotion); exit;			
			if ($this->HotelPromotions->save($hotelPromotion)) {
				$message = 'The hotel promotions has been saved';
				$this->Flash->success(__($message)); 
			}else{
				$message = 'The hotel promotions has not been saved';
				$this->Flash->error(__($message)); 
			}
			return $this->redirect(['action' => 'package-report']);
			 
		}
		
		$user_id=$this->Auth->User('id');
		$this->set(compact('user_id','hotelPromotion'));
    }
}
