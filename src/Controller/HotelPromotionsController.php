<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HotelPromotions Controller
 *
 * @property \App\Model\Table\HotelPromotionsTable $HotelPromotions
 */
class HotelPromotionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'HotelCategories', 'PriceMasters']
        ];
        $hotelPromotions = $this->paginate($this->HotelPromotions);

        $this->set(compact('hotelPromotions'));
        $this->set('_serialize', ['hotelPromotions']);
    }

    /**
     * View method
     *
     * @param string|null $id Hotel Promotion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hotelPromotion = $this->HotelPromotions->get($id, [
            'contain' => ['Users', 'HotelCategories', 'PriceMasters', 'HotelPromotionCities', 'HotelPromotionLikes', 'HotelPromotionPriceBeforeRenews', 'HotelPromotionReports', 'HotelPromotionViews']
        ]);

        $this->set('hotelPromotion', $hotelPromotion);
        $this->set('_serialize', ['hotelPromotion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $hotelPromotion = $this->HotelPromotions->newEntity();
        if ($this->request->is('post')) {
            $hotelPromotion = $this->HotelPromotions->patchEntity($hotelPromotion, $this->request->data);
            if ($this->HotelPromotions->save($hotelPromotion)) {
                $this->Flash->success(__('The hotel promotion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The hotel promotion could not be saved. Please, try again.'));
            }
        }
        $users = $this->HotelPromotions->Users->find('list', ['limit' => 200]);
        $hotelCategories = $this->HotelPromotions->HotelCategories->find('list', ['limit' => 200]);
        $priceMasters = $this->HotelPromotions->PriceMasters->find('list', ['limit' => 200]);
        $this->set(compact('hotelPromotion', 'users', 'hotelCategories', 'priceMasters'));
        $this->set('_serialize', ['hotelPromotion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Hotel Promotion id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hotelPromotion = $this->HotelPromotions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hotelPromotion = $this->HotelPromotions->patchEntity($hotelPromotion, $this->request->data);
            if ($this->HotelPromotions->save($hotelPromotion)) {
                $this->Flash->success(__('The hotel promotion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The hotel promotion could not be saved. Please, try again.'));
            }
        }
        $users = $this->HotelPromotions->Users->find('list', ['limit' => 200]);
        $hotelCategories = $this->HotelPromotions->HotelCategories->find('list', ['limit' => 200]);
        $priceMasters = $this->HotelPromotions->PriceMasters->find('list', ['limit' => 200]);
        $this->set(compact('hotelPromotion', 'users', 'hotelCategories', 'priceMasters'));
        $this->set('_serialize', ['hotelPromotion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Hotel Promotion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hotelPromotion = $this->HotelPromotions->get($id);
        if ($this->HotelPromotions->delete($hotelPromotion)) {
            $this->Flash->success(__('The hotel promotion has been deleted.'));
        } else {
            $this->Flash->error(__('The hotel promotion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
