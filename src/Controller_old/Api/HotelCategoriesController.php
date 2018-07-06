<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
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
    public function HotelCategoriesList()
    {
        $hotelCategories = $this->paginate($this->HotelCategories->find()->where(['is_deleted'=>0]));
        $this->set(compact('hotelCategories'));
        $this->set('_serialize', ['hotelCategories']);
		if(!empty($hotelCategories->toArray()))
		{
			$message = 'List Found Successfully';
			$response_code = 200;
		}
		else
		{
			$message = 'No Content Found';
			$hotelCategories = [];
			$response_code = 204;			
		}
		
		$this->set(compact('hotelCategories','message','response_code'));
        $this->set('_serialize', ['hotelCategories','message','response_code']);
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
