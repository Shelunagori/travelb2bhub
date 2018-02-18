<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PostTravlePackages Controller
 *
 * @property \App\Model\Table\PostTravlePackagesTable $PostTravlePackages
 */
class PostTravlePackagesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Currencies', 'Countries', 'PriceMasters', 'Users']
        ];
        $postTravlePackages = $this->paginate($this->PostTravlePackages);

        $this->set(compact('postTravlePackages'));
        $this->set('_serialize', ['postTravlePackages']);
    }

    /**
     * View method
     *
     * @param string|null $id Post Travle Package id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $postTravlePackage = $this->PostTravlePackages->get($id, [
            'contain' => ['Currencies', 'Countries', 'PriceMasters', 'Users', 'PostTravlePackageCities', 'PostTravlePackageRows', 'PostTravlePackageStates']
        ]);

        $this->set('postTravlePackage', $postTravlePackage);
        $this->set('_serialize', ['postTravlePackage']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $postTravlePackage = $this->PostTravlePackages->newEntity();
        if ($this->request->is('post')) {
            $postTravlePackage = $this->PostTravlePackages->patchEntity($postTravlePackage, $this->request->data);
            if ($this->PostTravlePackages->save($postTravlePackage)) {
                $this->Flash->success(__('The post travle package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post travle package could not be saved. Please, try again.'));
        }
        $currencies = $this->PostTravlePackages->Currencies->find('list', ['limit' => 200]);
        $countries = $this->PostTravlePackages->Countries->find('list', ['limit' => 200]);
        $priceMasters = $this->PostTravlePackages->PriceMasters->find('list', ['limit' => 200]);
        $users = $this->PostTravlePackages->Users->find('list', ['limit' => 200]);
        $this->set(compact('postTravlePackage', 'currencies', 'countries', 'priceMasters', 'users'));
        $this->set('_serialize', ['postTravlePackage']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Post Travle Package id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $postTravlePackage = $this->PostTravlePackages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postTravlePackage = $this->PostTravlePackages->patchEntity($postTravlePackage, $this->request->data);
            if ($this->PostTravlePackages->save($postTravlePackage)) {
                $this->Flash->success(__('The post travle package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post travle package could not be saved. Please, try again.'));
        }
        $currencies = $this->PostTravlePackages->Currencies->find('list', ['limit' => 200]);
        $countries = $this->PostTravlePackages->Countries->find('list', ['limit' => 200]);
        $priceMasters = $this->PostTravlePackages->PriceMasters->find('list', ['limit' => 200]);
        $users = $this->PostTravlePackages->Users->find('list', ['limit' => 200]);
        $this->set(compact('postTravlePackage', 'currencies', 'countries', 'priceMasters', 'users'));
        $this->set('_serialize', ['postTravlePackage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Post Travle Package id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $postTravlePackage = $this->PostTravlePackages->get($id);
        if ($this->PostTravlePackages->delete($postTravlePackage)) {
            $this->Flash->success(__('The post travle package has been deleted.'));
        } else {
            $this->Flash->error(__('The post travle package could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
