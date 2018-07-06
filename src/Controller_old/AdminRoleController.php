<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * AdminRole Controller
 *
 * @property \App\Model\Table\AdminRoleTable $AdminRole
 */
class AdminRoleController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Roles', 'Admins']
        ];
        $adminRole = $this->paginate($this->AdminRole);

        $this->set(compact('adminRole'));
        $this->set('_serialize', ['adminRole']);
    }

    /**
     * View method
     *
     * @param string|null $id Admin Role id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $adminRole = $this->AdminRole->get($id, [
            'contain' => ['Roles', 'Admins']
        ]);

        $this->set('adminRole', $adminRole);
        $this->set('_serialize', ['adminRole']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $adminRole = $this->AdminRole->newEntity();
        if ($this->request->is('post')) {
            $adminRole = $this->AdminRole->patchEntity($adminRole, $this->request->data);
            if ($this->AdminRole->save($adminRole)) {
                $this->Flash->success(__('The admin role has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The admin role could not be saved. Please, try again.'));
            }
        }
        $roles = $this->AdminRole->Roles->find('list', ['limit' => 200]);
        $admins = $this->AdminRole->Admins->find('list', ['limit' => 200]);
        $this->set(compact('adminRole', 'roles', 'admins'));
        $this->set('_serialize', ['adminRole']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Admin Role id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $adminRole = $this->AdminRole->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $adminRole = $this->AdminRole->patchEntity($adminRole, $this->request->data);
            if ($this->AdminRole->save($adminRole)) {
                $this->Flash->success(__('The admin role has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The admin role could not be saved. Please, try again.'));
            }
        }
        $roles = $this->AdminRole->Roles->find('list', ['limit' => 200]);
        $admins = $this->AdminRole->Admins->find('list', ['limit' => 200]);
        $this->set(compact('adminRole', 'roles', 'admins'));
        $this->set('_serialize', ['adminRole']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin Role id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $adminRole = $this->AdminRole->get($id);
        if ($this->AdminRole->delete($adminRole)) {
            $this->Flash->success(__('The admin role has been deleted.'));
        } else {
            $this->Flash->error(__('The admin role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
