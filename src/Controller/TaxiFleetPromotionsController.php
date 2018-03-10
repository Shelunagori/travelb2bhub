<?php
namespace App\Controller;

use App\Controller\AppController;

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
        $taxiFleetPromotion = $this->TaxiFleetPromotions->get($id, [
            'contain' => ['Countries', 'PriceMasters', 'Users', 'TaxiFleetPromotionCities'=>['Cities'], 'TaxiFleetPromotionRows', 'TaxiFleetPromotionStates'=>['States']]
        ]);
        $this->set('taxiFleetPromotion', $taxiFleetPromotion);
        $this->set('_serialize', ['taxiFleetPromotion']);
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
        $taxiFleetPromotion = $this->TaxiFleetPromotions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $taxiFleetPromotion = $this->TaxiFleetPromotions->patchEntity($taxiFleetPromotion, $this->request->data);
            if ($this->TaxiFleetPromotions->save($taxiFleetPromotion)) {
                $this->Flash->success(__('The taxi fleet promotion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The taxi fleet promotion could not be saved. Please, try again.'));
        }
        $countries = $this->TaxiFleetPromotions->Countries->find('list', ['limit' => 200]);
        $priceMasters = $this->TaxiFleetPromotions->PriceMasters->find('list', ['limit' => 200]);
        $users = $this->TaxiFleetPromotions->Users->find('list', ['limit' => 200]);
        $this->set(compact('taxiFleetPromotion', 'countries', 'priceMasters', 'users'));
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

	public function report()
    {
        $this->viewBuilder()->layout('user_layout');
		$user_id=$this->Auth->User('id');
        $this->set(compact('user_id'));
    }
	
}
