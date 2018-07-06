<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HotelPromotionPriceBeforeRenews Controller
 *
 * @property \App\Model\Table\HotelPromotionPriceBeforeRenewsTable $HotelPromotionPriceBeforeRenews
 */
class HotelPromotionPriceBeforeRenewsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['HotelPromotions', 'PriceMasters']
        ];
        $hotelPromotionPriceBeforeRenews = $this->paginate($this->HotelPromotionPriceBeforeRenews);

        $this->set(compact('hotelPromotionPriceBeforeRenews'));
        $this->set('_serialize', ['hotelPromotionPriceBeforeRenews']);
    }

    /**
     * View method
     *
     * @param string|null $id Hotel Promotion Price Before Renews id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hotelPromotionPriceBeforeRenews = $this->HotelPromotionPriceBeforeRenews->get($id, [
            'contain' => ['HotelPromotions', 'PriceMasters']
        ]);

        $this->set('hotelPromotionPriceBeforeRenews', $hotelPromotionPriceBeforeRenews);
        $this->set('_serialize', ['hotelPromotionPriceBeforeRenews']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $hotelPromotionPriceBeforeRenews = $this->HotelPromotionPriceBeforeRenews->newEntity();
        if ($this->request->is('post')) {
            $hotelPromotionPriceBeforeRenews = $this->HotelPromotionPriceBeforeRenews->patchEntity($hotelPromotionPriceBeforeRenews, $this->request->data);
            if ($this->HotelPromotionPriceBeforeRenews->save($hotelPromotionPriceBeforeRenews)) {
                $this->Flash->success(__('The hotel promotion price before renews has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The hotel promotion price before renews could not be saved. Please, try again.'));
            }
        }
        $hotelPromotions = $this->HotelPromotionPriceBeforeRenews->HotelPromotions->find('list', ['limit' => 200]);
        $priceMasters = $this->HotelPromotionPriceBeforeRenews->PriceMasters->find('list', ['limit' => 200]);
        $this->set(compact('hotelPromotionPriceBeforeRenews', 'hotelPromotions', 'priceMasters'));
        $this->set('_serialize', ['hotelPromotionPriceBeforeRenews']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Hotel Promotion Price Before Renews id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hotelPromotionPriceBeforeRenews = $this->HotelPromotionPriceBeforeRenews->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hotelPromotionPriceBeforeRenews = $this->HotelPromotionPriceBeforeRenews->patchEntity($hotelPromotionPriceBeforeRenews, $this->request->data);
            if ($this->HotelPromotionPriceBeforeRenews->save($hotelPromotionPriceBeforeRenews)) {
                $this->Flash->success(__('The hotel promotion price before renews has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The hotel promotion price before renews could not be saved. Please, try again.'));
            }
        }
        $hotelPromotions = $this->HotelPromotionPriceBeforeRenews->HotelPromotions->find('list', ['limit' => 200]);
        $priceMasters = $this->HotelPromotionPriceBeforeRenews->PriceMasters->find('list', ['limit' => 200]);
        $this->set(compact('hotelPromotionPriceBeforeRenews', 'hotelPromotions', 'priceMasters'));
        $this->set('_serialize', ['hotelPromotionPriceBeforeRenews']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Hotel Promotion Price Before Renews id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hotelPromotionPriceBeforeRenews = $this->HotelPromotionPriceBeforeRenews->get($id);
        if ($this->HotelPromotionPriceBeforeRenews->delete($hotelPromotionPriceBeforeRenews)) {
            $this->Flash->success(__('The hotel promotion price before renews has been deleted.'));
        } else {
            $this->Flash->error(__('The hotel promotion price before renews could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
