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
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Countries', 'PriceMasters', 'Users']
        ];
        $taxiFleetPromotions = $this->paginate($this->TaxiFleetPromotions);

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
        $taxiFleetPromotion = $this->TaxiFleetPromotions->get($id, [
            'contain' => ['Countries', 'PriceMasters', 'Users', 'TaxiFleetPromotionCities', 'TaxiFleetPromotionRows', 'TaxiFleetPromotionStates']
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
        $taxiFleetPromotion = $this->TaxiFleetPromotions->newEntity();
        if ($this->request->is('post')) {
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
}
