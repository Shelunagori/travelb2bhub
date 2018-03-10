<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HotelPromotionCities Controller
 *
 * @property \App\Model\Table\HotelPromotionCitiesTable $HotelPromotionCities
 */
class HotelPromotionCitiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['HotelPromotions', 'Cities']
        ];
        $hotelPromotionCities = $this->paginate($this->HotelPromotionCities);

        $this->set(compact('hotelPromotionCities'));
        $this->set('_serialize', ['hotelPromotionCities']);
    }

    /**
     * View method
     *
     * @param string|null $id Hotel Promotion City id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hotelPromotionCity = $this->HotelPromotionCities->get($id, [
            'contain' => ['HotelPromotions', 'Cities']
        ]);

        $this->set('hotelPromotionCity', $hotelPromotionCity);
        $this->set('_serialize', ['hotelPromotionCity']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $hotelPromotionCity = $this->HotelPromotionCities->newEntity();
        if ($this->request->is('post')) {
            $hotelPromotionCity = $this->HotelPromotionCities->patchEntity($hotelPromotionCity, $this->request->data);
            if ($this->HotelPromotionCities->save($hotelPromotionCity)) {
                $this->Flash->success(__('The hotel promotion city has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The hotel promotion city could not be saved. Please, try again.'));
            }
        }
        $hotelPromotions = $this->HotelPromotionCities->HotelPromotions->find('list', ['limit' => 200]);
        $cities = $this->HotelPromotionCities->Cities->find('list', ['limit' => 200]);
        $this->set(compact('hotelPromotionCity', 'hotelPromotions', 'cities'));
        $this->set('_serialize', ['hotelPromotionCity']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Hotel Promotion City id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hotelPromotionCity = $this->HotelPromotionCities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hotelPromotionCity = $this->HotelPromotionCities->patchEntity($hotelPromotionCity, $this->request->data);
            if ($this->HotelPromotionCities->save($hotelPromotionCity)) {
                $this->Flash->success(__('The hotel promotion city has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The hotel promotion city could not be saved. Please, try again.'));
            }
        }
        $hotelPromotions = $this->HotelPromotionCities->HotelPromotions->find('list', ['limit' => 200]);
        $cities = $this->HotelPromotionCities->Cities->find('list', ['limit' => 200]);
        $this->set(compact('hotelPromotionCity', 'hotelPromotions', 'cities'));
        $this->set('_serialize', ['hotelPromotionCity']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Hotel Promotion City id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hotelPromotionCity = $this->HotelPromotionCities->get($id);
        if ($this->HotelPromotionCities->delete($hotelPromotionCity)) {
            $this->Flash->success(__('The hotel promotion city has been deleted.'));
        } else {
            $this->Flash->error(__('The hotel promotion city could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
