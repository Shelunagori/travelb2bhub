<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Responses Controller
 *
 * @property \App\Model\Table\ResponsesTable $Responses
 */
class ResponsesController extends AppController
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
            'contain' => ['Users', 'Requests', 'Testimonial']
        ];
		
		if(isset($this->request->query['search_report'])){
			
 			$RefID = $this->request->query['ReqID'];
			$status = $this->request->query['status'];
			$removed = $this->request->query['removed'];
			$Quotation = $this->request->query['Quotation'];
			 
			if(!empty($RefID)){
				$conditions['Responses.request_id']=$RefID;
			}
			if($status==1){
				$conditions['Responses.status']=0;	
			}
			if($status==2){
				$conditions['Responses.status']=1;	
			}
			if($removed==2){
				$conditions['Responses.is_deleted']=0;	
			}
			if($removed==1){
				$conditions['Responses.is_deleted']=1;	
			}
			if(!empty($Quotation)){
				$conditions['Responses.quotation_price']=$Quotation;
			}
			 
			$responses = $this->paginate($this->Responses->find()->where($conditions));
  		}
		else {
			$responses = $this->paginate($this->Responses);
		}
		 
	//pr($responses); exit;
        $this->set(compact('responses'));
        $this->set('_serialize', ['responses']);
    }
	
	public function report()
    {
		$this->viewBuilder()->layout('admin_layout');	
        $this->paginate = [
            'contain' => ['Users', 'Requests', 'Testimonial']
        ];
		
		if(isset($this->request->query['search_report'])){
			
 			$RefID = $this->request->query['ReqID'];
			$status = $this->request->query['status'];
			$removed = $this->request->query['removed'];
			$Quotation = $this->request->query['Quotation'];
			 
			if(!empty($RefID)){
				$conditions['Responses.request_id']=$RefID;
			}
			if($status==1){
				$conditions['Responses.status']=0;	
			}
			if($status==2){
				$conditions['Responses.status']=1;	
			}
			if($removed==2){
				$conditions['Responses.is_deleted']=0;	
			}
			if($removed==1){
				$conditions['Responses.is_deleted']=1;	
			}
			if(!empty($Quotation)){
				$conditions['Responses.quotation_price']=$Quotation;
			}
			 
			$responses = $this->paginate($this->Responses->find()->where($conditions));
  		}
		else {
			$responses = $this->paginate($this->Responses);
		}
		 
	//pr($responses); exit;
        $this->set(compact('responses'));
        $this->set('_serialize', ['responses']);
    }


    /**
     * View method
     *
     * @param string|null $id Response id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $response = $this->Responses->get($id, [
            'contain' => ['Users', 'Requests', 'Testimonial', 'UserChats']
        ]);

        $this->set('response', $response);
        $this->set('_serialize', ['response']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $response = $this->Responses->newEntity();
        if ($this->request->is('post')) {
            $response = $this->Responses->patchEntity($response, $this->request->data);
            if ($this->Responses->save($response)) {
                $this->Flash->success(__('The response has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The response could not be saved. Please, try again.'));
            }
        }
        $users = $this->Responses->Users->find('list', ['limit' => 200]);
        $requests = $this->Responses->Requests->find('list', ['limit' => 200]);
        $testimonial = $this->Responses->Testimonial->find('list', ['limit' => 200]);
        $this->set(compact('response', 'users', 'requests', 'testimonial'));
        $this->set('_serialize', ['response']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Response id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $response = $this->Responses->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $response = $this->Responses->patchEntity($response, $this->request->data);
            if ($this->Responses->save($response)) {
                $this->Flash->success(__('The response has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The response could not be saved. Please, try again.'));
            }
        }
        $users = $this->Responses->Users->find('list', ['limit' => 200]);
        $requests = $this->Responses->Requests->find('list', ['limit' => 200]);
        $testimonial = $this->Responses->Testimonial->find('list', ['limit' => 200]);
        $this->set(compact('response', 'users', 'requests', 'testimonial'));
        $this->set('_serialize', ['response']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Response id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $response = $this->Responses->get($id);
        if ($this->Responses->delete($response)) {
            $this->Flash->success(__('The response has been deleted.'));
        } else {
            $this->Flash->error(__('The response could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
