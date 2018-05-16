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
public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		 
		$loginId=$this->Auth->User('id');  
		if(!empty($loginId)){
			$first_name=$this->Auth->User('first_name');
			$last_name=$this->Auth->User('last_name');
			$profile_pic=$this->Auth->User('profile_pic');  
			$authUserName=$first_name.' '.$last_name;
			$this->set('MemberName',$authUserName);
			$this->set('profile_pic', $profile_pic);
			$this->set('loginId',$loginId); 
		}
	} 
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		
        $postTravlePackageCategories = $this->paginate($this->PostTravlePackageCategories);
		//pr($postTravlePackageCategories->toarray());exit;
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
    public function add($id = null)
    {
		
		$this->viewBuilder()->layout('admin_layout');
		if(!$id)
		{				
			$postTravlePackageCategory = $this->PostTravlePackageCategories->newEntity();
		}
		else
		{
			$postTravlePackageCategory = $this->PostTravlePackageCategories->get($id, [
            'contain' => []
        ]);
		}
        if ($this->request->is(['patch','post','put'])) {
            $postTravlePackageCategory = $this->PostTravlePackageCategories->patchEntity($postTravlePackageCategory, $this->request->data);
			//pr($postTravlePackageCategory);exit;
            if ($this->PostTravlePackageCategories->save($postTravlePackageCategory)) {
                $this->Flash->success(__('The post travle package category has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The post travle package category could not be saved. Please, try again.'));
        }
		
		$postTravlePackageCategoryss = $this->paginate($this->PostTravlePackageCategories->find()->where(['PostTravlePackageCategories.is_deleted'=>0])->contain(['PostTravlePackageRows'])); 
		
        $this->set(compact('postTravlePackageCategory','id','postTravlePackageCategoryss'));
        $this->set('_serialize', ['postTravlePackageCategory','postTravlePackageCategoryss','id']);
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
       $this->request->allowMethod(['patch','post', 'put']);
        $postTravlePackageCategory = $this->PostTravlePackageCategories->get($id);
		$this->request->data['is_deleted']=1;
		$postTravlePackageCategory = $this->PostTravlePackageCategories->patchEntity($postTravlePackageCategory, $this->request->data);
     if ($this->PostTravlePackageCategories->save($postTravlePackageCategory)) {
            $this->Flash->success(__('The post travle package category has been deleted.'));
        } else {
            $this->Flash->error(__('The post travle package category could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }
}
