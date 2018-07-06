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
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		 
		$loginId=$this->Auth->User('id');  
		if(!empty($loginId)){
			$first_name=$this->Auth->User('first_name');
			$last_name=$this->Auth->User('last_name');
			$profile_pic=$this->Auth->User('profile_pic');  
			$authUserName=$first_name.' '.$last_name;
			$this->set('MemberName',$authUserName);
			$this->set('profile_pic', $profile_pic);
			$this->set('loginId',$loginId); 
		}
	} 
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
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
		$this->viewBuilder()->layout('admin_layout');	
 		if(!$id)
		{				
			$hotelCategory = $this->HotelCategories->newEntity();
		}
		else
		{
			$hotelCategory = $this->HotelCategories->get($id, [
				'contain' => []
			]);
		}
        if ($this->request->is(['patch','post','put'])) {
            $hotelCategory = $this->HotelCategories->patchEntity($hotelCategory, $this->request->data);
			 
            if ($this->HotelCategories->save($hotelCategory)) {
                $this->Flash->success(__('The hotel category has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The hotel category could not be saved. Please, try again.'));
        }
		$hotelCategories = $this->paginate($this->HotelCategories->find()->where(['is_deleted'=>0]));

        $this->set(compact('hotelCategory','hotelCategories'));
        $this->set('_serialize', ['hotelCategory','hotelCategories']);
    }
 
    public function delete($id = null)
    {
        $this->request->allowMethod(['patch','post', 'put']);
        $hotelCategory = $this->HotelCategories->get($id);
        $this->request->data['is_deleted']=1;
		$hotelCategory = $this->HotelCategories->patchEntity($hotelCategory, $this->request->data());
        if ($this->HotelCategories->save($hotelCategory)) {
            $this->Flash->success(__('The hotel category has been deleted.'));
        } else {
            $this->Flash->error(__('The hotel category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }
}
