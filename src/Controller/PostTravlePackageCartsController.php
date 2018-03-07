<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PostTravlePackageCarts Controller
 *
 * @property \App\Model\Table\PostTravlePackageCartsTable $PostTravlePackageCarts
 */
class PostTravlePackageCartsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PostTravlePackages', 'Users']
        ];
        $postTravlePackageCarts = $this->paginate($this->PostTravlePackageCarts);

        $this->set(compact('postTravlePackageCarts'));
        $this->set('_serialize', ['postTravlePackageCarts']);
    }

    /**
     * View method
     *
     * @param string|null $id Post Travle Package Cart id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $postTravlePackageCart = $this->PostTravlePackageCarts->get($id, [
            'contain' => ['PostTravlePackages', 'Users']
        ]);

        $this->set('postTravlePackageCart', $postTravlePackageCart);
        $this->set('_serialize', ['postTravlePackageCart']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $postTravlePackageCart = $this->PostTravlePackageCarts->newEntity();
        if ($this->request->is('post')) {
            $postTravlePackageCart = $this->PostTravlePackageCarts->patchEntity($postTravlePackageCart, $this->request->data);
            if ($this->PostTravlePackageCarts->save($postTravlePackageCart)) {
                $this->Flash->success(__('The post travle package cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post travle package cart could not be saved. Please, try again.'));
        }
        $postTravlePackages = $this->PostTravlePackageCarts->PostTravlePackages->find('list', ['limit' => 200]);
        $users = $this->PostTravlePackageCarts->Users->find('list', ['limit' => 200]);
        $this->set(compact('postTravlePackageCart', 'postTravlePackages', 'users'));
        $this->set('_serialize', ['postTravlePackageCart']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Post Travle Package Cart id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $postTravlePackageCart = $this->PostTravlePackageCarts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postTravlePackageCart = $this->PostTravlePackageCarts->patchEntity($postTravlePackageCart, $this->request->data);
            if ($this->PostTravlePackageCarts->save($postTravlePackageCart)) {
                $this->Flash->success(__('The post travle package cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post travle package cart could not be saved. Please, try again.'));
        }
        $postTravlePackages = $this->PostTravlePackageCarts->PostTravlePackages->find('list', ['limit' => 200]);
        $users = $this->PostTravlePackageCarts->Users->find('list', ['limit' => 200]);
        $this->set(compact('postTravlePackageCart', 'postTravlePackages', 'users'));
        $this->set('_serialize', ['postTravlePackageCart']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Post Travle Package Cart id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $postTravlePackageCart = $this->PostTravlePackageCarts->get($id);
        if ($this->PostTravlePackageCarts->delete($postTravlePackageCart)) {
            $this->Flash->success(__('The post travle package cart has been deleted.'));
        } else {
            $this->Flash->error(__('The post travle package cart could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
