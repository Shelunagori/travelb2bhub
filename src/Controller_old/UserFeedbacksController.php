<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserFeedbacks Controller
 *
 * @property \App\Model\Table\UserFeedbacksTable $UserFeedbacks
 */
class UserFeedbacksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $userFeedbacks = $this->paginate($this->UserFeedbacks);

        $this->set(compact('userFeedbacks'));
        $this->set('_serialize', ['userFeedbacks']);
    }

    /**
     * View method
     *
     * @param string|null $id User Feedback id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userFeedback = $this->UserFeedbacks->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('userFeedback', $userFeedback);
        $this->set('_serialize', ['userFeedback']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userFeedback = $this->UserFeedbacks->newEntity();
        if ($this->request->is('post')) {
            $userFeedback = $this->UserFeedbacks->patchEntity($userFeedback, $this->request->data);
            if ($this->UserFeedbacks->save($userFeedback)) {
                $this->Flash->success(__('The user feedback has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user feedback could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserFeedbacks->Users->find('list', ['limit' => 200]);
        $this->set(compact('userFeedback', 'users'));
        $this->set('_serialize', ['userFeedback']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Feedback id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userFeedback = $this->UserFeedbacks->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userFeedback = $this->UserFeedbacks->patchEntity($userFeedback, $this->request->data);
            if ($this->UserFeedbacks->save($userFeedback)) {
                $this->Flash->success(__('The user feedback has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user feedback could not be saved. Please, try again.'));
            }
        }
        $users = $this->UserFeedbacks->Users->find('list', ['limit' => 200]);
        $this->set(compact('userFeedback', 'users'));
        $this->set('_serialize', ['userFeedback']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Feedback id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userFeedback = $this->UserFeedbacks->get($id);
        if ($this->UserFeedbacks->delete($userFeedback)) {
            $this->Flash->success(__('The user feedback has been deleted.'));
        } else {
            $this->Flash->error(__('The user feedback could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
