<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Admins Controller
 *
 * @property \App\Model\Table\AdminsTable $Admins
 */
class AdminsController extends AppController
{

   
    public function login()
    {
       $this->viewBuilder()->layout('home_layout'); 
	   if ($this->request->is('post')) {			
			$user = $this->Auth->identify();			
			if ($user) {
				$this->Auth->setUser($user);
				return $this->redirect(['action' => 'add']);
			}		
			$this->Flash->error('Either Password or username is not correct!!');
		}
	}
	 
	public function logout()
	{
		$this->Flash->success('You are now logged out.');
		return $this->redirect($this->Auth->logout());
	}

    /**
     * View method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $admin = $this->Admins->get($id, [
            'contain' => ['AdminRole']
        ]);

        $this->set('admin', $admin);
        $this->set('_serialize', ['admin']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('admin_layout');
        $admin = $this->Admins->newEntity();
        $AdminRole = $this->Admins->AdminRole->newEntity();
        if ($this->request->is('post')) {
            $admin = $this->Admins->patchEntity($admin, $this->request->data);
 			$admin_role=$this->request->data['role_id'];
             if ($insert=$this->Admins->save($admin)) {
				//- Admin Role Insert
				$X=0;
				foreach($admin_role as $roledata){
 					$this->request->data['record']['AdminRole'][$X]['admin_id']=$insert->id;
					$this->request->data['record']['AdminRole'][$X]['role_id']=$roledata;
 					$X++;	
				}
				$AdminRoleData=$this->request->data['record'];
				$AdminRole = $this->Admins->AdminRole->newEntities($AdminRoleData);
				$this->Admins->AdminRole->saveMany($AdminRole);
                $this->Flash->success(__('The admin has been saved.'));

                //return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The admin could not be saved. Please, try again.'));
            }
        }
		$Admins = $this->Admins->AdminRole->Roles->find('list', ['limit' => 200]);
		//-- VIew List 
		$this->paginate = [
            'contain' => ['AdminRole']
        ];
        $AdminsRecord = $this->paginate($this->Admins);
		
        $this->set(compact('admin','Admins','AdminsRecord'));
        $this->set('_serialize', ['admin','Admins','AdminsRecord']);
    }
	
	public function menu()
	{
		$user_id=$this->Auth->User('id');
		$fetch_menu = $this->Admins->Modules->find()->order(['preferance'=>'ASC'])->toArray();
		$this->response->body($fetch_menu);
		return $this->response;
	}
	
	public function MenuSubmenu($main_menu)
	{
		$user_id=$this->Auth->User('id');
		$conditions=array("main_menu" => $main_menu);
		$fetch_menu_submenu = $this->Users->Modules->find()->where($conditions)->toArray();
		$this->response->body($fetch_menu_submenu);
		return $this->response;
	}
	public function submenu($sub_menu)
	{
		$user_id=$this->Auth->User('id');
		$conditions=array("sub_menu" => $sub_menu);
		$fetch_submenu = $this->Users->Modules->find()->where($conditions)->toArray();
		$this->response->body($fetch_submenu);
		return $this->response;
	}
	

    /**
     * Edit method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $admin = $this->Admins->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $admin = $this->Admins->patchEntity($admin, $this->request->data);
            if ($this->Admins->save($admin)) {
                $this->Flash->success(__('The admin has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The admin could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('admin'));
        $this->set('_serialize', ['admin']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Admin id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $admin = $this->Admins->get($id);
        if ($this->Admins->delete($admin)) {
            $this->Flash->success(__('The admin has been deleted.'));
        } else {
            $this->Flash->error(__('The admin could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
