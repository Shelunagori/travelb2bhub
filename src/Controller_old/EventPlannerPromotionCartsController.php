<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EventPlannerPromotionCarts Controller
 *
 * @property \App\Model\Table\EventPlannerPromotionCartsTable $EventPlannerPromotionCarts
 */
class EventPlannerPromotionCartsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['EventPlannerPromotions', 'Users']
        ];
        $eventPlannerPromotionCarts = $this->paginate($this->EventPlannerPromotionCarts);

        $this->set(compact('eventPlannerPromotionCarts'));
        $this->set('_serialize', ['eventPlannerPromotionCarts']);
    }

    /**
     * View method
     *
     * @param string|null $id Event Planner Promotion Cart id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eventPlannerPromotionCart = $this->EventPlannerPromotionCarts->get($id, [
            'contain' => ['EventPlannerPromotions', 'Users']
        ]);

        $this->set('eventPlannerPromotionCart', $eventPlannerPromotionCart);
        $this->set('_serialize', ['eventPlannerPromotionCart']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $eventPlannerPromotionCart = $this->EventPlannerPromotionCarts->newEntity();
        if ($this->request->is('post')) {
            $eventPlannerPromotionCart = $this->EventPlannerPromotionCarts->patchEntity($eventPlannerPromotionCart, $this->request->data);
            if ($this->EventPlannerPromotionCarts->save($eventPlannerPromotionCart)) {
                $this->Flash->success(__('The event planner promotion cart has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event planner promotion cart could not be saved. Please, try again.'));
        }
        $eventPlannerPromotions = $this->EventPlannerPromotionCarts->EventPlannerPromotions->find('list', ['limit' => 200]);
        $users = $this->EventPlannerPromotionCarts->Users->find('list', ['limit' => 200]);
        $this->set(compact('eventPlannerPromotionCart', 'eventPlannerPromotions', 'users'));
        $this->set('_serialize', ['eventPlannerPromotionCart']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event Planner Promotion Cart id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eventPlannerPromotionCart = $this->EventPlannerPromotionCarts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eventPlannerPromotionCart = $this->EventPlannerPromotionCarts->patchEntity($eventPlannerPromotionCart, $this->request->data);
            if ($this->EventPlannerPromotionCarts->save($eventPlannerPromotionCart)) {
                $this->Flash->success(__('The event planner promotion cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event planner promotion cart could not be saved. Please, try again.'));
        }
        $eventPlannerPromotions = $this->EventPlannerPromotionCarts->EventPlannerPromotions->find('list', ['limit' => 200]);
        $users = $this->EventPlannerPromotionCarts->Users->find('list', ['limit' => 200]);
        $this->set(compact('eventPlannerPromotionCart', 'eventPlannerPromotions', 'users'));
        $this->set('_serialize', ['eventPlannerPromotionCart']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event Planner Promotion Cart id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eventPlannerPromotionCart = $this->EventPlannerPromotionCarts->get($id);
        if ($this->EventPlannerPromotionCarts->delete($eventPlannerPromotionCart)) {
            $this->Flash->success(__('The event planner promotion cart has been deleted.'));
        } else {
            $this->Flash->error(__('The event planner promotion cart could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
