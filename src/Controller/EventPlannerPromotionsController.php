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
		$UserId=$this->Auth->User('id');
        $eventPlannerPromotion = $this->EventPlannerPromotions->newEntity();
        if ($this->request->is('post')) {
            $eventPlannerPromotion = $this->EventPlannerPromotions->patchEntity($eventPlannerPromotion, $this->request->data);
			
			// Call Curl FOR FB DETAILS
				
				$state_id=$this->request->data['state_id'];
				$x=0;
				$array_of_state=array();
				foreach($state_id as $state)
				{
					$array_of_state['event_planner_promotion_states['.$x.']["state_id"]']=$state_id[$x];
					$x++;	
				}
				
				$city_id=$this->request->data['city_id'];
				$y=0;
				$array_of_cities=array();
				foreach($city_id as $city)
				{
					$array_of_cities['event_planner_promotion_cities['.$y.']["city_id"]']=$city_id[$y];
					$y++;	
				}
				

							$post =[
								'company_name' => $this->request->data['company_name'],
								'UserId' => $UserId,
								'title' =>$this->request->data['title'],
								'image' =>'',//$this->request->data['image'],
								'document' =>'',//$this->request->data['document'],
								'event_detail' =>$this->request->data['event_detail'],
								'country_id' =>$this->request->data['country_id'],									
								'price_master_id' =>$this->request->data['price_master_id'],
								'visible_date' =>$this->request->data['visible_date']									
								//'payment_amount' =>$this->request->data['payment_amount'],									
							];
							$post=array_merge($post,$array_of_cities);
							$post=array_merge($post,$array_of_state);
							//pr($post);exit;
							$ch = curl_init('http://konciergesolutions.com/travelb2bhub/api/event_planner_promotions/add.json');
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
							$response = curl_exec($ch);
							$result = json_encode($response, true);
							curl_close($ch);
							pr($result);exit;
			/*	if ($this->EventPlannerPromotions->save($eventPlannerPromotion)) {
                $this->Flash->success(__('The event planner promotion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event planner promotion could not be saved. Please, try again.')); */
        }
		$countries = $this->EventPlannerPromotions->Countries->find('list', ['limit' => 200]);
 	    $States = $this->EventPlannerPromotions->States->find('list', ['limit' => 200])->where(['country_id'=>'101']);
 	    $Cities = $this->EventPlannerPromotions->Cities->find('list');
        $priceMasters = $this->EventPlannerPromotions->PriceMasters->find('all', ['limit' => 200])->where(['promotion_type_id'=>3]);
        $users = $this->EventPlannerPromotions->Users->find()->where(['id'=>$UserId])->first();
        $this->set(compact('eventPlannerPromotion', 'States', 'priceMasters', 'users','Cities','countries'));
        $this->set('_serialize', ['eventPlannerPromotion']);
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
	 public function report()
    {
		$this->viewBuilder()->layout('user_layout');
        $this->paginate = [
            'contain' => ['Countries', 'PriceMasters', 'Users']
        ];
        $eventPlannerPromotions = $this->paginate($this->EventPlannerPromotions);

        $this->set(compact('eventPlannerPromotions'));
        $this->set('_serialize', ['eventPlannerPromotions']);
    }
}
