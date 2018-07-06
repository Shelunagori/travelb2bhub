<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HotelPromotionCarts Controller
 *
 * @property \App\Model\Table\HotelPromotionCartsTable $HotelPromotionCarts
 */
class HotelPromotionCartsController extends AppController
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
        $hotelPromotionCarts = $this->paginate($this->HotelPromotionCarts);

        $this->set(compact('hotelPromotionCarts'));
        $this->set('_serialize', ['hotelPromotionCarts']);
    }

    /**
     * View method
     *
     * @param string|null $id Hotel Promotion Cart id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hotelPromotionCart = $this->HotelPromotionCarts->get($id, [
            'contain' => ['HotelPromotions', 'Users']
        ]);

        $this->set('hotelPromotionCart', $hotelPromotionCart);
        $this->set('_serialize', ['hotelPromotionCart']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $hotelPromotionCart = $this->HotelPromotionCarts->newEntity();
        if ($this->request->is('post')) {
            $hotelPromotionCart = $this->HotelPromotionCarts->patchEntity($hotelPromotionCart, $this->request->data);
            if ($this->HotelPromotionCarts->save($hotelPromotionCart)) {
                $this->Flash->success(__('The hotel promotion cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hotel promotion cart could not be saved. Please, try again.'));
        }
        $hotelPromotions = $this->HotelPromotionCarts->HotelPromotions->find('list', ['limit' => 200]);
        $users = $this->HotelPromotionCarts->Users->find('list', ['limit' => 200]);
        $this->set(compact('hotelPromotionCart', 'hotelPromotions', 'users'));
        $this->set('_serialize', ['hotelPromotionCart']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Hotel Promotion Cart id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hotelPromotionCart = $this->HotelPromotionCarts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hotelPromotionCart = $this->HotelPromotionCarts->patchEntity($hotelPromotionCart, $this->request->data);
            if ($this->HotelPromotionCarts->save($hotelPromotionCart)) {
                $this->Flash->success(__('The hotel promotion cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hotel promotion cart could not be saved. Please, try again.'));
        }
        $hotelPromotions = $this->HotelPromotionCarts->HotelPromotions->find('list', ['limit' => 200]);
        $users = $this->HotelPromotionCarts->Users->find('list', ['limit' => 200]);
        $this->set(compact('hotelPromotionCart', 'hotelPromotions', 'users'));
        $this->set('_serialize', ['hotelPromotionCart']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Hotel Promotion Cart id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hotelPromotionCart = $this->HotelPromotionCarts->get($id);
        if ($this->HotelPromotionCarts->delete($hotelPromotionCart)) {
            $this->Flash->success(__('The hotel promotion cart has been deleted.'));
        } else {
            $this->Flash->error(__('The hotel promotion cart could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
