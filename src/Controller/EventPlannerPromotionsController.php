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
    public function index()
    {
        $this->paginate = [
            'contain' => ['Counties', 'PriceMasters', 'Users']
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
        $eventPlannerPromotion = $this->EventPlannerPromotions->newEntity();
        if ($this->request->is('post')) {
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
}
