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
    public function add()
    {
        $taxiFleetCarBus = $this->TaxiFleetCarBuses->newEntity();
        if ($this->request->is('post')) {
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
        $this->request->allowMethod(['post', 'delete']);
        $taxiFleetCarBus = $this->TaxiFleetCarBuses->get($id);
        if ($this->TaxiFleetCarBuses->delete($taxiFleetCarBus)) {
            $this->Flash->success(__('The taxi fleet car bus has been deleted.'));
        } else {
            $this->Flash->error(__('The taxi fleet car bus could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
