<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PostTravlePackageCategories Controller
 *
 * @property \App\Model\Table\PostTravlePackageCategoriesTable $PostTravlePackageCategories
 */
class PostTravlePackageCategoriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $postTravlePackageCategories = $this->paginate($this->PostTravlePackageCategories);

        $this->set(compact('postTravlePackageCategories'));
        $this->set('_serialize', ['postTravlePackageCategories']);
    }

    /**
     * View method
     *
     * @param string|null $id Post Travle Package Category id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $postTravlePackageCategory = $this->PostTravlePackageCategories->get($id, [
            'contain' => ['PostTravlePackageRows']
        ]);

        $this->set('postTravlePackageCategory', $postTravlePackageCategory);
        $this->set('_serialize', ['postTravlePackageCategory']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $postTravlePackageCategory = $this->PostTravlePackageCategories->newEntity();
        if ($this->request->is('post')) {
            $postTravlePackageCategory = $this->PostTravlePackageCategories->patchEntity($postTravlePackageCategory, $this->request->data);
            if ($this->PostTravlePackageCategories->save($postTravlePackageCategory)) {
                $this->Flash->success(__('The post travle package category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post travle package category could not be saved. Please, try again.'));
        }
        $this->set(compact('postTravlePackageCategory'));
        $this->set('_serialize', ['postTravlePackageCategory']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Post Travle Package Category id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $postTravlePackageCategory = $this->PostTravlePackageCategories->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postTravlePackageCategory = $this->PostTravlePackageCategories->patchEntity($postTravlePackageCategory, $this->request->data);
            if ($this->PostTravlePackageCategories->save($postTravlePackageCategory)) {
                $this->Flash->success(__('The post travle package category has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post travle package category could not be saved. Please, try again.'));
        }
        $this->set(compact('postTravlePackageCategory'));
        $this->set('_serialize', ['postTravlePackageCategory']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Post Travle Package Category id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $postTravlePackageCategory = $this->PostTravlePackageCategories->get($id);
        if ($this->PostTravlePackageCategories->delete($postTravlePackageCategory)) {
            $this->Flash->success(__('The post travle package category has been deleted.'));
        } else {
            $this->Flash->error(__('The post travle package category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
