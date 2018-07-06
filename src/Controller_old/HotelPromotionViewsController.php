<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HotelPromotionViews Controller
 *
 * @property \App\Model\Table\HotelPromotionViewsTable $HotelPromotionViews
 */
class HotelPromotionViewsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['HotelPromotions', 'Users']
        ];
        $hotelPromotionViews = $this->paginate($this->HotelPromotionViews);

        $this->set(compact('hotelPromotionViews'));
        $this->set('_serialize', ['hotelPromotionViews']);
    }

    /**
     * View method
     *
     * @param string|null $id Hotel Promotion View id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hotelPromotionView = $this->HotelPromotionViews->get($id, [
            'contain' => ['HotelPromotions', 'Users']
        ]);

        $this->set('hotelPromotionView', $hotelPromotionView);
        $this->set('_serialize', ['hotelPromotionView']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $hotelPromotionView = $this->HotelPromotionViews->newEntity();
        if ($this->request->is('post')) {
            $hotelPromotionView = $this->HotelPromotionViews->patchEntity($hotelPromotionView, $this->request->data);
            if ($this->HotelPromotionViews->save($hotelPromotionView)) {
                $this->Flash->success(__('The hotel promotion view has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The hotel promotion view could not be saved. Please, try again.'));
            }
        }
        $hotelPromotions = $this->HotelPromotionViews->HotelPromotions->find('list', ['limit' => 200]);
        $users = $this->HotelPromotionViews->Users->find('list', ['limit' => 200]);
        $this->set(compact('hotelPromotionView', 'hotelPromotions', 'users'));
        $this->set('_serialize', ['hotelPromotionView']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Hotel Promotion View id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hotelPromotionView = $this->HotelPromotionViews->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hotelPromotionView = $this->HotelPromotionViews->patchEntity($hotelPromotionView, $this->request->data);
            if ($this->HotelPromotionViews->save($hotelPromotionView)) {
                $this->Flash->success(__('The hotel promotion view has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The hotel promotion view could not be saved. Please, try again.'));
            }
        }
        $hotelPromotions = $this->HotelPromotionViews->HotelPromotions->find('list', ['limit' => 200]);
        $users = $this->HotelPromotionViews->Users->find('list', ['limit' => 200]);
        $this->set(compact('hotelPromotionView', 'hotelPromotions', 'users'));
        $this->set('_serialize', ['hotelPromotionView']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Hotel Promotion View id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hotelPromotionView = $this->HotelPromotionViews->get($id);
        if ($this->HotelPromotionViews->delete($hotelPromotionView)) {
            $this->Flash->success(__('The hotel promotion view has been deleted.'));
        } else {
            $this->Flash->error(__('The hotel promotion view could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
