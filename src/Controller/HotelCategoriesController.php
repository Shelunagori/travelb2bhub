<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HotelCategories Controller
 *
 * @property \App\Model\Table\HotelCategoriesTable $HotelCategories
 */
class HotelCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $hotelCategories = $this->paginate($this->HotelCategories);

        $this->set(compact('hotelCategories'));
        $this->set('_serialize', ['hotelCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Hotel Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hotelCategory = $this->HotelCategories->get($id, [
            'contain' => []
        ]);

        $this->set('hotelCategory', $hotelCategory);
        $this->set('_serialize', ['hotelCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $hotelCategory = $this->HotelCategories->newEntity();
        if ($this->request->is('post')) {
            $hotelCategory = $this->HotelCategories->patchEntity($hotelCategory, $this->request->data);
            if ($this->HotelCategories->save($hotelCategory)) {
                $this->Flash->success(__('The hotel category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The hotel category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('hotelCategory'));
        $this->set('_serialize', ['hotelCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Hotel Category id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hotelCategory = $this->HotelCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hotelCategory = $this->HotelCategories->patchEntity($hotelCategory, $this->request->data);
            if ($this->HotelCategories->save($hotelCategory)) {
                $this->Flash->success(__('The hotel category has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The hotel category could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('hotelCategory'));
        $this->set('_serialize', ['hotelCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Hotel Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hotelCategory = $this->HotelCategories->get($id);
        if ($this->HotelCategories->delete($hotelCategory)) {
            $this->Flash->success(__('The hotel category has been deleted.'));
        } else {
            $this->Flash->error(__('The hotel category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
