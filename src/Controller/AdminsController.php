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

	public function index()
    {
		$this->viewBuilder()->layout('admin_layout');
    }
	
    public function login()
    {
       $this->viewBuilder()->layout(''); 
	   if ($this->request->is('post')) {			
			$user = $this->Auth->identify();			
			if ($user) {
				$this->Auth->setUser($user);
				return $this->redirect(['action' => 'add']);
			}		
			$this->Flash->error('Either Password or username is not correct!');
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
        
        if ($this->request->is('post')) {
            $admin = $this->Admins->patchEntity($admin, $this->request->data);
 			$admin_role=$this->request->data['role_id'];
             if ($insert=$this->Admins->save($admin)) {
				//- Admin Role Insert
				$AdminRole = $this->Admins->AdminRole->newEntity();
				$AdminRole = $this->Admins->AdminRole->patchEntity($AdminRole, $this->request->data);
				$AdminRole->admin_id=$insert->id;
				$AdminRole->role_id=$admin_role;
				$this->Admins->AdminRole->save($AdminRole);
				 
                $this->Flash->success(__('The admin has been saved.'));
                return $this->redirect(['action' => 'add']);
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
	
	public function UserRights()
	{
		$user_id=$this->Auth->User('id');
		$role_id=$this->Auth->User('role_id');
 		$conditions=array("user_id" => $user_id);
		$fetch_user_right1='';
		$fetch_user_right2='';
		
		$fetch_user_rights = $this->Admins->UserRights->find()->where($conditions)->toArray();
		
		foreach($fetch_user_rights as $data){
			$fetch_user_right1 = $data->module_id;
		}
		$conditions=array("role_id" => $role_id);
				
		$fetch_user_roles = $this->Admins->UserRights->find()->where($conditions)->toArray();
		
		foreach($fetch_user_roles as $data2){
			$fetch_user_right2 = $data2->module_id;
		}
		$fetch_user_right1_array = explode(',',$fetch_user_right1);
		$fetch_user_right2_array = explode(',',$fetch_user_right2);
		$fetch_user_right_array = array_merge($fetch_user_right1_array,$fetch_user_right2_array);
		$fetch_user_right_array = array_unique($fetch_user_right_array);
		$fetch_user_right = implode(',',$fetch_user_right_array);
		$this->response->body($fetch_user_right);
		return $this->response;
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
		
		$fetch_menu_submenu = $this->Admins->Modules->find()->where($conditions)->toArray();
		
		$this->response->body($fetch_menu_submenu);
		return $this->response;
	}
	public function submenu($sub_menu)
	{ 
		$user_id=$this->Auth->User('id');
		$conditions=array("sub_menu" => $sub_menu);
		$fetch_submenu = $this->Admins->Modules->find()->where($conditions)->toArray();
		
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

                return $this->redirect(['action' => 'add']);
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

        return $this->redirect(['action' => 'add']);
    }
	public function broadcast()
    {
		$this->viewBuilder()->layout('admin_layout');
		$admin = $this->Admins->UserChats->newEntity();
		if ($this->request->is('post')) {
			
			$broadcast_msg=$this->request->data['broadcast_msg'];
			$Users=$this->Users->find()->where(['device_id !='=>'0'])->toArray();
 			foreach($Users as $user){
				$admin = $this->Admins->UserChats->newEntity();
 				$admin->request_id = '0';
				$admin->user_id = 1;
				$admin->send_to_user_id = $user["id"];
				$admin['type'] = 'Announcement';
				$admin->message = $broadcast_msg;
				$admin->created = date("Y-m-d h:i:s");
				$admin->notification = 1;

				if ($this->Admins->UserChats->save($admin)) {
					$id = $admin->id;
					$message_data='';
					$this->Admins->UserChats->updateAll(['type' => 'Announcement'], ['id' => $id]);
					$this->sendpushnotification($user["id"],$admin->message,$message_data);
				}
			}
			return $this->redirect(['action' => 'broadcast']);
		}
		
		$this->set(compact('admin'));
        $this->set('_serialize', ['admin']);
	}
	public function sendpushnotification($userid,$message,$message_data)
	{
		$Users=$this->Users->find()->where(['id'=>$userid])->toArray();
		 
		$deviceid=$Users[0]['device_id'];
 		if(!empty($deviceid)){

		/* $sql1 = "Select count(*) as countchat FROM user_chats as c 
		INNER JOIN users as u on u.id=c.user_id
		where c.is_read='0' AND c.send_to_user_id='".$userid."'
		order by c.created DESC ";
		$stmt1 = $conn->execute($sql1);
		$countchat = $stmt1 ->fetch('assoc');
		 */
		$API_ACCESS_KEY='AIzaSyA5mzBqngPlq220FYB8Cr2O4y79RH4i9s4';

		$registrationIds =  $deviceid;
		$msg = array
		(
		'body' 	=> $message,
		'title'	=> 'Travelb2bhub Notification',
		'icon'	=> 'myicon',/*Default Icon*/
		'sound' => 'mySound',/*Default sound*/
		'unread_count' => 0,
		'message' => $message,
		'type'=>"Announcement"
		);
		$data = array
		(

		"unread_count" => 0
		);
		$fields = array('to'=> $registrationIds,
		'notification'=> $msg,
		'data' => $msg
		);
		$headers = array(
		'Authorization: key='.$API_ACCESS_KEY,
		'Content-Type: application/json'
		);

		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
		//print_r($result); die();
		return $result;
		}
	}	
	
}
