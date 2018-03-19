<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EventPlannerPromotions Controller
 *
 * @property \App\Model\Table\EventPlannerPromotionsTable $EventPlannerPromotions
 */
class EventPlannerPromotionsController extends AppController
{
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
		//*---
		$this->loadModel('UserChats');
		$csort['created'] = "DESC";
		$allUnreadChat = $this->UserChats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->order($csort)->limit(10)->all();
		$chatCount = $allUnreadChat->count();
		$this->set('chatCount',$chatCount); 
		$this->set('allunreadchat',$allUnreadChat);
		//--
		
	}
	
    public function index()
    {
		$this->viewBuilder()->layout('user_layout');
        $this->paginate = [
            'contain' => ['Countries', 'PriceMasters', 'Users']
        ];
        $eventPlannerPromotions = $this->paginate($this->EventPlannerPromotions);

        $this->set(compact('eventPlannerPromotions'));
        $this->set('_serialize', ['eventPlannerPromotions']);
    }

    /**
     * View method
     *
     * @param string|null $id Event Planner Promotion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eventPlannerPromotion = $this->EventPlannerPromotions->get($id, [
            'contain' => ['Counties', 'PriceMasters', 'Users', 'EventPlannerPromotionCities', 'EventPlannerPromotionStates']
        ]);

        $this->set('eventPlannerPromotion', $eventPlannerPromotion);
        $this->set('_serialize', ['eventPlannerPromotion']);
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
     * @param string|null $id Event Planner Promotion id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eventPlannerPromotion = $this->EventPlannerPromotions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eventPlannerPromotion = $this->EventPlannerPromotions->patchEntity($eventPlannerPromotion, $this->request->data);
            if ($this->EventPlannerPromotions->save($eventPlannerPromotion)) {
                $this->Flash->success(__('The event planner promotion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event planner promotion could not be saved. Please, try again.'));
        }
        $counties = $this->EventPlannerPromotions->Counties->find('list', ['limit' => 200]);
        $priceMasters = $this->EventPlannerPromotions->PriceMasters->find('list', ['limit' => 200]);
        $users = $this->EventPlannerPromotions->Users->find('list', ['limit' => 200]);
        $this->set(compact('eventPlannerPromotion', 'counties', 'priceMasters', 'users'));
        $this->set('_serialize', ['eventPlannerPromotion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event Planner Promotion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eventPlannerPromotion = $this->EventPlannerPromotions->get($id);
        if ($this->EventPlannerPromotions->delete($eventPlannerPromotion)) {
            $this->Flash->success(__('The event planner promotion has been deleted.'));
        } else {
            $this->Flash->error(__('The event planner promotion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

	public function report($higestSort = null,$country_id = null,$state_id = null,$city_id = null,$removeEvent=null,$event_id=null)
    {
		$higestSort=$this->request->query('higestSort'); 
		$country_id=$this->request->query('country_id'); 
		$city_id=$this->request->query('city_id'); 
		$state_id=$this->request->query('state_id');
		//-- REMOVE PARAMETER
		$user_id=$this->Auth->User('id');
		if ($this->request->is(['patch', 'post', 'put'])) 
		{
			//pr($this->request->data); exit;
			//-- REMOVE EVENT
			if (isset($this->request->data['removeEvent']))
			{
 				$event_id=$this->request->data('event_id');
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/EventPlannerPromotions/removeEvent.json?event_id=".$event_id,
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
 				$event_id=$this->request->data('event_id');
				$post =[
						'event_planner_promotion_id' => $event_id,
						'user_id' =>$user_id						 							
					];
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/EventPlannerPromotions/likeEventPlannerPromotions.json",
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
		$this->set(compact('user_id','higestSort','country_id','city_id','state_id'));
    }
}
