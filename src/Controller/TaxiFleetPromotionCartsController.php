<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TaxiFleetPromotionCarts Controller
 *
 * @property \App\Model\Table\TaxiFleetPromotionCartsTable $TaxiFleetPromotionCarts
 */
class TaxiFleetPromotionCartsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['TaxiFleetPromotions', 'Users']
        ];
        $taxiFleetPromotionCarts = $this->paginate($this->TaxiFleetPromotionCarts);

        $this->set(compact('taxiFleetPromotionCarts'));
        $this->set('_serialize', ['taxiFleetPromotionCarts']);
    }

    /**
     * View method
     *
     * @param string|null $id Taxi Fleet Promotion Cart id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $taxiFleetPromotionCart = $this->TaxiFleetPromotionCarts->get($id, [
            'contain' => ['TaxiFleetPromotions', 'Users']
        ]);

        $this->set('taxiFleetPromotionCart', $taxiFleetPromotionCart);
        $this->set('_serialize', ['taxiFleetPromotionCart']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $taxiFleetPromotionCart = $this->TaxiFleetPromotionCarts->newEntity();
        if ($this->request->is('post')) {
            $taxiFleetPromotionCart = $this->TaxiFleetPromotionCarts->patchEntity($taxiFleetPromotionCart, $this->request->data);
            if ($this->TaxiFleetPromotionCarts->save($taxiFleetPromotionCart)) {
                $this->Flash->success(__('The taxi fleet promotion cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The taxi fleet promotion cart could not be saved. Please, try again.'));
        }
        $taxiFleetPromotions = $this->TaxiFleetPromotionCarts->TaxiFleetPromotions->find('list', ['limit' => 200]);
        $users = $this->TaxiFleetPromotionCarts->Users->find('list', ['limit' => 200]);
        $this->set(compact('taxiFleetPromotionCart', 'taxiFleetPromotions', 'users'));
        $this->set('_serialize', ['taxiFleetPromotionCart']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Taxi Fleet Promotion Cart id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $taxiFleetPromotionCart = $this->TaxiFleetPromotionCarts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $taxiFleetPromotionCart = $this->TaxiFleetPromotionCarts->patchEntity($taxiFleetPromotionCart, $this->request->data);
            if ($this->TaxiFleetPromotionCarts->save($taxiFleetPromotionCart)) {
                $this->Flash->success(__('The taxi fleet promotion cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The taxi fleet promotion cart could not be saved. Please, try again.'));
        }
        $taxiFleetPromotions = $this->TaxiFleetPromotionCarts->TaxiFleetPromotions->find('list', ['limit' => 200]);
        $users = $this->TaxiFleetPromotionCarts->Users->find('list', ['limit' => 200]);
        $this->set(compact('taxiFleetPromotionCart', 'taxiFleetPromotions', 'users'));
        $this->set('_serialize', ['taxiFleetPromotionCart']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Taxi Fleet Promotion Cart id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $taxiFleetPromotionCart = $this->TaxiFleetPromotionCarts->get($id);
        if ($this->TaxiFleetPromotionCarts->delete($taxiFleetPromotionCart)) {
            $this->Flash->success(__('The taxi fleet promotion cart has been deleted.'));
        } else {
            $this->Flash->error(__('The taxi fleet promotion cart could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
