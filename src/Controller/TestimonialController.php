<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Testimonial Controller
 *
 * @property \App\Model\Table\TestimonialTable $Testimonial
 */
class TestimonialController extends AppController
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
            'contain' => ['Users','Authors']
        ];
        $testimonial = $this->paginate($this->Testimonial);
		//pr($testimonial->toArray());exit;
        $this->set(compact('testimonial'));
        $this->set('_serialize', ['testimonial']);
    }

    /**
     * View method
     *
     * @param string|null $id Testimonial id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('admin_layout');	
        $testimonial = $this->Testimonial->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('testimonial', $testimonial);
        $this->set('_serialize', ['testimonial']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $testimonial = $this->Testimonial->newEntity();
        if ($this->request->is('post')) {
            $testimonial = $this->Testimonial->patchEntity($testimonial, $this->request->data);
            if ($this->Testimonial->save($testimonial)) {
                $this->Flash->success(__('The testimonial has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The testimonial could not be saved. Please, try again.'));
            }
        }
        $users = $this->Testimonial->Users->find('list', ['limit' => 200]);
        $authors = $this->Testimonial->Authors->find('list', ['limit' => 200]);
        $requests = $this->Testimonial->Requests->find('list', ['limit' => 200]);
        $responses = $this->Testimonial->Responses->find('list', ['limit' => 200]);
        $this->set(compact('testimonial', 'users', 'authors', 'requests', 'responses'));
        $this->set('_serialize', ['testimonial']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Testimonial id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $testimonial = $this->Testimonial->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $testimonial = $this->Testimonial->patchEntity($testimonial, $this->request->data);
            if ($this->Testimonial->save($testimonial)) {
                $this->Flash->success(__('The testimonial has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The testimonial could not be saved. Please, try again.'));
            }
        }
        $users = $this->Testimonial->Users->find('list', ['limit' => 200]);
        $authors = $this->Testimonial->Authors->find('list', ['limit' => 200]);
        $requests = $this->Testimonial->Requests->find('list', ['limit' => 200]);
        $responses = $this->Testimonial->Responses->find('list', ['limit' => 200]);
        $this->set(compact('testimonial', 'users', 'authors', 'requests', 'responses'));
        $this->set('_serialize', ['testimonial']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Testimonial id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $testimonial = $this->Testimonial->get($id);
        if ($this->Testimonial->delete($testimonial)) {
            $this->Flash->success(__('The testimonial has been deleted.'));
        } else {
            $this->Flash->error(__('The testimonial could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
