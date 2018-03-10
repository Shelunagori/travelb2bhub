<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HotelPromotionLikes Controller
 *
 * @property \App\Model\Table\HotelPromotionLikesTable $HotelPromotionLikes
 */
class HotelPromotionLikesController extends AppController
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
        $hotelPromotionLikes = $this->paginate($this->HotelPromotionLikes);

        $this->set(compact('hotelPromotionLikes'));
        $this->set('_serialize', ['hotelPromotionLikes']);
    }

    /**
     * View method
     *
     * @param string|null $id Hotel Promotion Like id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hotelPromotionLike = $this->HotelPromotionLikes->get($id, [
            'contain' => ['HotelPromotions', 'Users']
        ]);

        $this->set('hotelPromotionLike', $hotelPromotionLike);
        $this->set('_serialize', ['hotelPromotionLike']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $hotelPromotionLike = $this->HotelPromotionLikes->newEntity();
        if ($this->request->is('post')) {
            $hotelPromotionLike = $this->HotelPromotionLikes->patchEntity($hotelPromotionLike, $this->request->data);
            if ($this->HotelPromotionLikes->save($hotelPromotionLike)) {
                $this->Flash->success(__('The hotel promotion like has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The hotel promotion like could not be saved. Please, try again.'));
            }
        }
        $hotelPromotions = $this->HotelPromotionLikes->HotelPromotions->find('list', ['limit' => 200]);
        $users = $this->HotelPromotionLikes->Users->find('list', ['limit' => 200]);
        $this->set(compact('hotelPromotionLike', 'hotelPromotions', 'users'));
        $this->set('_serialize', ['hotelPromotionLike']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Hotel Promotion Like id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hotelPromotionLike = $this->HotelPromotionLikes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hotelPromotionLike = $this->HotelPromotionLikes->patchEntity($hotelPromotionLike, $this->request->data);
            if ($this->HotelPromotionLikes->save($hotelPromotionLike)) {
                $this->Flash->success(__('The hotel promotion like has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The hotel promotion like could not be saved. Please, try again.'));
            }
        }
        $hotelPromotions = $this->HotelPromotionLikes->HotelPromotions->find('list', ['limit' => 200]);
        $users = $this->HotelPromotionLikes->Users->find('list', ['limit' => 200]);
        $this->set(compact('hotelPromotionLike', 'hotelPromotions', 'users'));
        $this->set('_serialize', ['hotelPromotionLike']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Hotel Promotion Like id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hotelPromotionLike = $this->HotelPromotionLikes->get($id);
        if ($this->HotelPromotionLikes->delete($hotelPromotionLike)) {
            $this->Flash->success(__('The hotel promotion like has been deleted.'));
        } else {
            $this->Flash->error(__('The hotel promotion like could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
