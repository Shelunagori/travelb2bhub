<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TaxiFleetCarBuses Controller
 *
 * @property \App\Model\Table\TaxiFleetCarBusesTable $TaxiFleetCarBuses
 */
class TaxiFleetCarBusesController extends AppController
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
        $taxiFleetCarBuses = $this->paginate($this->TaxiFleetCarBuses);

        $this->set(compact('taxiFleetCarBuses'));
        $this->set('_serialize', ['taxiFleetCarBuses']);
    }

    /**
     * View method
     *
     * @param string|null $id Taxi Fleet Car Bus id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $taxiFleetCarBus = $this->TaxiFleetCarBuses->get($id, [
            'contain' => ['TaxiFleetPromotionRows']
        ]);

        $this->set('taxiFleetCarBus', $taxiFleetCarBus);
        $this->set('_serialize', ['taxiFleetCarBus']);
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
			$taxiFleetCarBus = $this->TaxiFleetCarBuses->newEntity();
        }
		else{
			$taxiFleetCarBus = $this->TaxiFleetCarBuses->get($id, [
            'contain' => []
			]);
		}
		if ($this->request->is(['patch','post','put'])) {
            $taxiFleetCarBus = $this->TaxiFleetCarBuses->patchEntity($taxiFleetCarBus, $this->request->data);
            if ($this->TaxiFleetCarBuses->save($taxiFleetCarBus)) {
                $this->Flash->success(__('The taxi fleet car bus has been saved.'));

                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The taxi fleet car bus could not be saved. Please, try again.'));
            }
        }
		$taxiFleetCarBuses = $this->paginate($this->TaxiFleetCarBuses->find()->where(['TaxiFleetCarBuses.is_deleted'=>0]));
        $this->set(compact('taxiFleetCarBus','taxiFleetCarBuses','id'));
        $this->set('_serialize', ['taxiFleetCarBus','taxiFleetCarBuses','id']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Taxi Fleet Car Bus id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $taxiFleetCarBus = $this->TaxiFleetCarBuses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $taxiFleetCarBus = $this->TaxiFleetCarBuses->patchEntity($taxiFleetCarBus, $this->request->data);
            if ($this->TaxiFleetCarBuses->save($taxiFleetCarBus)) {
                $this->Flash->success(__('The taxi fleet car bus has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The taxi fleet car bus could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('taxiFleetCarBus'));
        $this->set('_serialize', ['taxiFleetCarBus']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Taxi Fleet Car Bus id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
       $this->request->allowMethod(['patch','post', 'put']);
        $taxiFleetCarBus = $this->TaxiFleetCarBuses->get($id);
		$this->request->data['is_deleted']=1;
		$taxiFleetCarBus = $this->TaxiFleetCarBuses->patchEntity($taxiFleetCarBus, $this->request->data);
        if ($this->TaxiFleetCarBuses->save($taxiFleetCarBus)) {
            $this->Flash->success(__('The taxi fleet car bus has been deleted.'));
        } else {
            $this->Flash->error(__('The taxi fleet car bus could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }
}
