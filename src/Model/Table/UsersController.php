<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Mailer\Email;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController {
var $helpers = array('Html', 'Form');
    public function beforeFilter(\Cake\Event\Event $event) {
        
        parent::beforeFilter($event);
        $this->Auth->allow(['index','register','login','dashboard','sendrequest']);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {
        
        $this->paginate = [
            'contain' => ['Users']
        ];
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($slug = null) {
        
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $d = $this->request->data;
        $adduser = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($adduser, $d);
            if ($this->Users->save($user)) {
                $result['error'] = 0;
                $result['msg'] = "User has been added successfully";
            } else {
                $result['error'] = 1;
                $result['msg'] = "Something went wrong please try again";
            }
            $this->set([
                'message' => $result,
                'result' => $adduser,
                '_serialize' => ['message', 'result']
            ]);
        }
    }

    
     public function contactus(){
        $this->loadModel('Contacts');
          if ($this->request->is('post')) {
              $d = $this->request->data;
               $d['status'] = 0;
             $contact = $this->Contacts->newEntity($d);
                if ($this->Contacts->save($contact)) {
            $this->Flash->success(__('Your contact detals has been saved.'));
                return $this->redirect('/pages/contactus');
            } else {
                $this->Flash->error(__('Sorry.'));
                 return $this->redirect('/pages/contactus');
            }
        }
    }
    public function register() {
        $this->loadModel('Countries');
        $this->loadModel('States');
        $this->loadModel('Cities');
        if ($this->request->is('post')) {
            $d = $this->request->data;
             $checkUsers = $this->Users->find()->where(['email' => $d['email']])->count();
            if($checkUsers < 1){
                $d['email_verified'] = 0;
                $d['mobile_verified'] = 0;
                $d['reset_password_token'] = 0;
                $d['verification_token'] = 0;
                $d['mobile_otp'] = rand('1010', '9999');
                $d['status'] = 0;
                $d['create_at'] = 0;
                $file = $d['image'];
               $path = WWW_ROOT . "userimages" . DS . $file['name'];
            move_uploaded_file($file['tmp_name'], $path);
            $d['image'] = $file['name'];
             $user = $this->Users->newEntity($d);
                if ($this->Users->save($user)) {
            $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'register']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }else{
             $this->Flash->error(__('Email id already exist. Please, try another one.'));
        }
        
            }
             $cities = $this->Cities->find('all')->all();
             $states = $this->States->find('all')->all();
             $countries = $this->Countries->find('all')->all();
           
             $this->set(compact('cities','states','countries'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id) {
        $userid = $this->Users->get($id);
        if ($this->request->is(['post', 'put'])) {
            $user = $this->Users->patchEntity($userid, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->error(__('User has been updated successfully.'));
                $result['msg'] = "User has been updated successfully";
                $this->redirect('/users/profileedit/'.$id);
            } else {
                $this->Flash->error(__('Something went wrong please try again.'));
               $this->redirect('/users/profileedit/'.$id);
            }
        }
       
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null) {
        
    }

    /**
     * Login method
     */
    public function login() {

         if ($this->request->is('post') || $this->request->query('provider')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect('/users/dashboard');
            }else{
                return $this->redirect('/pages/home');
                 $this->Flash->error(__('Invalid username or password, try again'));
            }
           
        }
    }

    /**
     * Logout method
     */
    public function logout() {
        
    }
    
    public function dashboard(){
         $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
         //print_r($user);
         $this->set('users', $user);
    }
public function profileedit (){
    $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
         //print_r($user);
         $this->set('users', $user);
}

public function sendrequest(){
     $this->loadModel('Requests');
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
         //print_r($user);
         $this->set('users', $user);
         
         
          if ($this->request->is('post')) {
              $d = $this->request->data;
               $d['destination_city'] = implode(",",$d['destination_city']);
               $d['stops'] = implode(",",$d['stops']);
			    $d['room1'] = implode(",",$d['room1']);
				 $d['room2'] = implode(",",$d['room2']);
				  $d['room3'] = implode(",",$d['room3']);
				   $d['child_with_bed'] = implode(",",$d['child_with_bed']);
				    $d['child_without_bed'] = implode(",",$d['child_without_bed']);
					 $d['hotel_category'] = implode(",",$d['hotel_category']);
				   $d['meal_plan'] = implode(",",$d['meal_plan']);
				    $d['destination_city'] = implode(",",$d['destination_city']);
					 $d['check_in'] = implode(",",$d['check_in']);
				    $d['check_out'] = implode(",",$d['check_out']);
             $contact = $this->Requests->newEntity($d);
                if ($this->Requests->save($contact)) {
            $this->Flash->success(__('Your request details has been saved.'));
                return $this->redirect('/users/sendrequest');
            } else {
                $this->Flash->error(__('Sorry.'));
                 return $this->redirect('/users/sendrequest');
            }
        }
         
         
         
}

}
