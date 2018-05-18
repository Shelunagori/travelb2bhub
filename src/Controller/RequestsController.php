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
		$this->viewBuilder()->layout('admin_layout');	
        $this->paginate = [
            'contain' => ['Users','Cities','States','Categories']
        ];
		if(isset($this->request->query['search_report'])){
 			$RefID = $this->request->query['RefID'];
			$status = $this->request->query['status'];
			$removed = $this->request->query['removed'];
			$category = $this->request->query['category'];
			 
			if(!empty($RefID)){
				$conditions['Requests.reference_id LIKE']='%'.$RefID.'%';
			}
			if($status==1){
				$conditions['Requests.status']=0;	
			}
			if($status==2){
				$conditions['Requests.status']=2;	
			}
			if($removed==2){
				$conditions['Requests.is_deleted']=0;	
			}
			if($removed==1){
				$conditions['Requests.is_deleted']=1;	
			}
			if(!empty($category)){
				$conditions['Requests.category_id']=$category;	
			}
 			$requests = $this->paginate($this->Requests->find()->where($conditions));
  		}
		else {
			$requests = $this->paginate($this->Requests);
		}
 		$CategoriesList = $this->Requests->Categories->find('list', ['limit' => 200]);
         $this->set(compact('requests','CategoriesList'));
        $this->set('_serialize', ['requests','CategoriesList']);
		
    }

	
	public function report($RefID= null,$status= null,$removed= null,$category= null)
    {
		$this->viewBuilder()->layout('admin_layout');	
        $this->paginate = [
            'contain' => ['Users','Cities','States','Categories']
        ];
		if(isset($this->request->query['search_report'])){
 			$RefID = $this->request->query['RefID'];
			$status = $this->request->query['status'];
			$removed = $this->request->query['removed'];
			$category = $this->request->query['category'];
			 
			if(!empty($RefID)){
				$conditions['Requests.reference_id LIKE']='%'.$RefID.'%';
			}
			if($status==1){
				$conditions['Requests.status']=0;	
			}
			if($status==2){
				$conditions['Requests.status']=2;	
			}
			if($removed==2){
				$conditions['Requests.is_deleted']=0;	
			}
			if($removed==1){
				$conditions['Requests.is_deleted']=1;	
			}
			if(!empty($category)){
				$conditions['Requests.category_id']=$category;	
			}
 			$requests = $this->paginate($this->Requests->find()->where($conditions));
  		}
		else {
			$requests = $this->paginate($this->Requests);
		}
		$this->set('RefID',$RefID);
		$this->set('status',$status);
		$this->set('removed',$removed);
		$this->set('category',$category);
 		$CategoriesList = $this->Requests->Categories->find('list', ['limit' => 200]);
         $this->set(compact('requests','CategoriesList'));
        $this->set('_serialize', ['requests','CategoriesList']);
		
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

        return $this->redirect(['action' => 'report']);
    }
	public function excelDownload()
	{
		$this->viewBuilder()->layout('');	
        $this->paginate = [
            'contain' => ['Users','Cities','States','Categories']
        ];
		if(isset($this->request->query['search_report'])){
 			$RefID = $this->request->query['RefID'];
			$status = $this->request->query['status'];
			$removed = $this->request->query['removed'];
			$category = $this->request->query['category'];
			 
			if(!empty($RefID)){
				$conditions['Requests.reference_id LIKE']='%'.$RefID.'%';
			}
			if($status==1){
				$conditions['Requests.status']=0;	
			}
			if($status==2){
				$conditions['Requests.status']=2;	
			}
			if($removed==2){
				$conditions['Requests.is_deleted']=0;	
			}
			if($removed==1){
				$conditions['Requests.is_deleted']=1;	
			}
			if(!empty($category)){
				$conditions['Requests.category_id']=$category;	
			}
 			$requests = $this->paginate($this->Requests->find()->where($conditions));
  		}
		else {
			$requests = $this->paginate($this->Requests);
		}
 		$CategoriesList = $this->Requests->Categories->find('list', ['limit' => 200]);
         $this->set(compact('requests','CategoriesList'));
        $this->set('_serialize', ['requests','CategoriesList']);
	
	}
}
