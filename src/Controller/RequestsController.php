<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Requests Controller
 *
 * @property \App\Model\Table\RequestsTable $Requests
 */
class RequestsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('admin_layout');	
        $this->paginate = [
            'contain' => ['Users', 'Cities']
        ];
        $requests = $this->paginate($this->Requests);

        $this->set(compact('requests'));
        $this->set('_serialize', ['requests']);
    }

    /**
     * View method
     *
     * @param string|null $id Request id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $request = $this->Requests->get($id, [
            'contain' => ['Users', 'Cities', 'UserRatings', 'Responses', 'Hotels', 'RequestStops']
        ]);

        $this->set('request', $request);
        $this->set('_serialize', ['request']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $request = $this->Requests->newEntity();
        if ($this->request->is('post')) {
            $request = $this->Requests->patchEntity($request, $this->request->data);
            if ($this->Requests->save($request)) {
                $this->Flash->success(__('The request has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The request could not be saved. Please, try again.'));
            }
        }
        $users = $this->Requests->Users->find('list', ['limit' => 200]);
        $cities = $this->Requests->Cities->find('list', ['limit' => 200]);
        $this->set(compact('request', 'users', 'cities'));
        $this->set('_serialize', ['request']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Request id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $request = $this->Requests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $request = $this->Requests->patchEntity($request, $this->request->data);
            if ($this->Requests->save($request)) {
                $this->Flash->success(__('The request has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The request could not be saved. Please, try again.'));
            }
        }
        $users = $this->Requests->Users->find('list', ['limit' => 200]);
        $cities = $this->Requests->Cities->find('list', ['limit' => 200]);
        $this->set(compact('request', 'users', 'cities'));
        $this->set('_serialize', ['request']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Request id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $request = $this->Requests->get($id);
        if ($this->Requests->delete($request)) {
            $this->Flash->success(__('The request has been deleted.'));
        } else {
            $this->Flash->error(__('The request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
