<?php
namespace App\Controller;

use App\Controller\AppController;

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
		//--

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
        $hotelPromotion = $this->HotelPromotions->get($id, [
            'contain' => ['Users', 'HotelCategories', 'PriceMasters', 'HotelPromotionCities', 'HotelPromotionLikes', 'HotelPromotionPriceBeforeRenews', 'HotelPromotionReports', 'HotelPromotionViews']
        ]);

        $this->set('hotelPromotion', $hotelPromotion);
        $this->set('_serialize', ['hotelPromotion']);
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
		$this->set(compact('user_id'));
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
	   public function report()
    {
		 $this->viewBuilder()->layout('user_layout');
		$user_id=$this->Auth->User('id');
        $this->set(compact('user_id'));
	}
}
