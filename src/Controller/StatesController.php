<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * States Controller
 *
 * @property \App\Model\Table\StatesTable $States
 */
class StatesController extends AppController
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
		 $this->paginate = ['contain' => ['Countries'] ];
        $states = $this->paginate($this->States);
		//pr($states->toArray('state_name'))->first;exit;
        $this->set(compact('states'));
        $this->set('_serialize', ['states']);
    }

    /**
     * View method
     *
     * @param string|null $id State id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $state = $this->States->get($id, [
            'contain' => ['Countries']
        ]);
        $this->set('state', $state);
        $this->set('_serialize', ['state']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
		$this->viewBuilder()->layout('admin_layout');
		if(!$id){
			$state = $this->States->newEntity();
		}
		else{
			$state = $this->States->get($id, [
				'contain' => []
			]);
		}
		if ($this->request->is(['patch', 'post', 'put']))
		{
			$state = $this->States->patchEntity($state, $this->request->data);
			if ($this->States->save($state)) {
				$this->Flash->success(__('The state has been saved.'));

				return $this->redirect(['action' => 'add']);
			} else {
				$this->Flash->error(__('The state could not be saved. Please, try again.'));
			}
		}
		$country = $this->States->Countries->find('list', ['limit' => 200]);
		//-- View List
		$this->paginate = [
            'contain' => ['Countries']
        ];
		if(isset($this->request->query['search_report'])){
			$StateId = $this->request->query['StateId'];
			$CountryName = $this->request->query['CountryName'];
			 
			if(!empty($StateId)){
				$conditions['States.state_name LIKE']=$StateId.'%';
			}
			if(!empty($CountryName)){
				$conditions['States.country_id']=$CountryName;	
			}
			$conditions['States.is_deleted']=0;
 			$states = $this->paginate($this->States->find()->where($conditions));
  		}
		else {
			$states = $this->paginate($this->States->find()->where(['States.is_deleted'=>0]));
		}
        $this->set(compact('state','country','states','id'));
        $this->set('_serialize', ['state','country','states','id']);
    }

    /**
     * Edit method
     *
     * @param string|null $id State id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $state = $this->States->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $state = $this->States->patchEntity($state, $this->request->data);
            if ($this->States->save($state)) {
                $this->Flash->success(__('The state has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The state could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('state'));
        $this->set('_serialize', ['state']);
    }

    /**
     * Delete method
     *
     * @param string|null $id State id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['patch','post', 'put']);
        $state = $this->States->get($id);
		$this->request->data['is_deleted']=1;
		$state = $this->States->patchEntity($state, $this->request->data());
        if ($this->States->save($state)) {
            $this->Flash->success(__('The state has been deleted.'));
        } else {
            $this->Flash->error(__('The state could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }
}
