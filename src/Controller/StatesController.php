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
		$states = $this->paginate($this->States->find()->where(['States.is_deleted'=>0]));
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
