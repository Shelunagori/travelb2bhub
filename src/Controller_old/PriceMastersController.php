<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PriceMasters Controller
 *
 * @property \App\Model\Table\PriceMastersTable $PriceMasters
 */
class PriceMastersController extends AppController
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
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PromotionTypes']
        ];
        $priceMasters = $this->paginate($this->PriceMasters);

        $this->set(compact('priceMasters'));
        $this->set('_serialize', ['priceMasters']);
    }

    /**
     * View method
     *
     * @param string|null $id Price Master id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('admin_layout');
        $priceMaster = $this->PriceMasters->get($id, [
            'contain' => ['PromotionTypes', 'EventPlannerPromotions', 'PostTravlePackages', 'TaxiFleetPromotions']
        ]);

        $this->set('priceMaster', $priceMaster);
        $this->set('_serialize', ['priceMaster']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id= null)
    {
		$this->viewBuilder()->layout('admin_layout');
		if(!$id)
		{	
			$priceMaster = $this->PriceMasters->newEntity();
		}
		else{
			$priceMaster = $this->PriceMasters->get($id, [
            'contain' => []
			]);
		}
        if ($this->request->is(['patch','post','put'])) {
            $priceMaster = $this->PriceMasters->patchEntity($priceMaster, $this->request->data);
            if ($this->PriceMasters->save($priceMaster)) {
                $this->Flash->success(__('The price master has been saved.'));

                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The price master could not be saved. Please, try again.'));
            }
        }
        $promotionTypes = $this->PriceMasters->PromotionTypes->find('list', ['limit' => 200]);
		$priceMasters = $this->paginate($this->PriceMasters->find()->where(['PriceMasters.is_deleted'=>0])->contain(['PromotionTypes'])); 
		//pr($priceMasters);exit;
        $this->set(compact('priceMaster', 'promotionTypes','priceMasters'));
        $this->set('_serialize', ['priceMaster','priceMasters','promotionTypes','id']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Price Master id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $priceMaster = $this->PriceMasters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $priceMaster = $this->PriceMasters->patchEntity($priceMaster, $this->request->data);
            if ($this->PriceMasters->save($priceMaster)) {
                $this->Flash->success(__('The price master has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The price master could not be saved. Please, try again.'));
            }
        }
        $promotionTypes = $this->PriceMasters->PromotionTypes->find('list', ['limit' => 200]);
        $this->set(compact('priceMaster', 'promotionTypes'));
        $this->set('_serialize', ['priceMaster']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Price Master id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['patch','post', 'put']);
        $priceMaster = $this->PriceMasters->get($id);
		$this->request->data['is_deleted']=1;
		$priceMaster = $this->PriceMasters->patchEntity($priceMaster, $this->request->data);
        if ($this->PriceMasters->save($priceMaster)) {
            $this->Flash->success(__('The price master has been deleted.'));
        } else {
            $this->Flash->error(__('The price master could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'add']);
    }
}
