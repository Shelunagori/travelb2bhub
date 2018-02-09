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
        $states = $this->paginate($this->States);

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
            'contain' => ['Users']
        ]);

        $this->set('state', $state);
        $this->set('_serialize', ['state']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $state = $this->States->newEntity();
        if ($this->request->is('post')) {
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
        $this->request->allowMethod(['post', 'delete']);
        $state = $this->States->get($id);
        if ($this->States->delete($state)) {
            $this->Flash->success(__('The state has been deleted.'));
        } else {
            $this->Flash->error(__('The state could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
