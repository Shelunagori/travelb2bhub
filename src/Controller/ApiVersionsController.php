<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ApiVersions Controller
 *
 * @property \App\Model\Table\ApiVersionsTable $ApiVersions
 */
class ApiVersionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $apiVersions = $this->paginate($this->ApiVersions);

        $this->set(compact('apiVersions'));
        $this->set('_serialize', ['apiVersions']);
    }

    /**
     * View method
     *
     * @param string|null $id Api Version id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $apiVersion = $this->ApiVersions->get($id, [
            'contain' => []
        ]);

        $this->set('apiVersion', $apiVersion);
        $this->set('_serialize', ['apiVersion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $apiVersion = $this->ApiVersions->newEntity();
        if ($this->request->is('post')) {
            $apiVersion = $this->ApiVersions->patchEntity($apiVersion, $this->request->data);
            if ($this->ApiVersions->save($apiVersion)) {
                $this->Flash->success(__('The api version has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The api version could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('apiVersion'));
        $this->set('_serialize', ['apiVersion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Api Version id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $apiVersion = $this->ApiVersions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $apiVersion = $this->ApiVersions->patchEntity($apiVersion, $this->request->data);
            if ($this->ApiVersions->save($apiVersion)) {
                $this->Flash->success(__('The api version has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The api version could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('apiVersion'));
        $this->set('_serialize', ['apiVersion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Api Version id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $apiVersion = $this->ApiVersions->get($id);
        if ($this->ApiVersions->delete($apiVersion)) {
            $this->Flash->success(__('The api version has been deleted.'));
        } else {
            $this->Flash->error(__('The api version could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	public function apiVersion()
    {
		$this->loadModel('ApiVersions');
        $apiVersions = $this->ApiVersions->find()->first();

        $data =   json_encode($apiVersions);
		echo  $data;
		exit;
    }
}
