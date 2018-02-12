<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Cities Controller
 *
 * @property \App\Model\Table\CitiesTable $Cities
 */
class CitiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['States']
        ];
        $cities = $this->paginate($this->Cities);
        $this->set(compact('cities'));
        $this->set('_serialize', ['cities']);
    }

    /**
     * View method
     *
     * @param string|null $id City id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $city = $this->Cities->get($id, [
            'contain' => ['States', 'Requests', 'Hotels', 'Transports', 'Users']
        ]);

        $this->set('city', $city);
        $this->set('_serialize', ['city']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id=null)
    {
		$this->viewBuilder()->layout('admin_layout');
		if(!$id){
			$city = $this->Cities->newEntity();
		}
		else{
			$city = $this->Cities->get($id, [
				'contain' => []
			]);
		}
        if ($this->request->is(['patch', 'post', 'put']))
		{
            $city = $this->Cities->patchEntity($city, $this->request->data);
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('The city has been saved.'));

                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The city could not be saved. Please, try again.'));
            }
        }
        $states = $this->Cities->States->find('list', ['limit' => 200]);
		//-- View List
		
		$this->paginate = [
            'contain' => ['States']
        ];
        
		
		if(isset($this->request->query['search_report'])){
			$city = $this->request->query['cityid'];
			$stateid = $this->request->query['stateid'];
			 
			if(!empty($city)){
				$conditions['Cities.name LIKE']='%'.$city.'%';
			}
			if(!empty($stateid)){
				$conditions['Cities.state_id']=$stateid;	
			}
			$conditions['Cities.is_deleted']=0;
 			 
			$cities = $this->paginate($this->Cities->find()->where($conditions));
  		}
		else {
			$cities = $this->paginate($this->Cities->find()->where(['Cities.is_deleted'=>0]));
		}
		
        $this->set(compact('city', 'states','cities', 'id'));
        $this->set('_serialize', ['city','cities', 'id']);
    }

    /**
     * Edit method
     *
     * @param string|null $id City id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $city = $this->Cities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $city = $this->Cities->patchEntity($city, $this->request->data);
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('The city has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The city could not be saved. Please, try again.'));
            }
        }
        $states = $this->Cities->States->find('list', ['limit' => 200]);
        $this->set(compact('city', 'states'));
        $this->set('_serialize', ['city']);
    }

    /**
     * Delete method
     *
     * @param string|null $id City id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['patch','post', 'put']);
		$city = $this->Cities->get($id);
		$this->request->data['is_deleted']=1;
		$city = $this->Cities->patchEntity($city, $this->request->data());
	    if ($this->Cities->save($city)) {
            $this->Flash->success(__('The city has been deleted.'));
        } else {
            $this->Flash->error(__('The city could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'add']);
    }
}
