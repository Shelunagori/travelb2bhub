<?php

namespace App\Controller\Api;

use Cake\ORM\TableRegistry;
use App\Controller\Api\AppController;
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
        $this->Auth->allow(['index','register','login','requestlist','respondtorequest','myresponselist','checkresponses','countrylist','statelist','citylist']);
    }

    /**
     * Index method
     *
     * @return void
     */
    public function index() {

        $users = $this->Users->find('all')->all();
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

    public function contactus() {
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
        if ($this->request->is('post')) {
            
            $d = $this->getarray($this->request->data);
           
            $checkUsers = $this->Users->find()->where(['email' => $d['email']])->count();
            if ($checkUsers < 1) {
                $d['status'] = 0;
                $d['create_at'] = 0;
                $path = WWW_ROOT . "userimages" . DS . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $path);
                $d['image'] = $_FILES['image']['name'];
                $user = $this->Users->newEntity($d);
                if ($this->Users->save($user)) {
                    $result['error'] = 0;
                     $result['msg'] = "The user has been saved";
                    
                } else {
                     $result['error'] = 1;
                     $result['msg'] = "The user could not be saved. Please, try again";
                   
                }
            } else {
                $result['error'] = 1;
                $result['msg'] = "Email id already exist. Please, try another one";
            }
        }
          $this->set(compact('result'));
        $this->set('_serialize', 'result');

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
                $this->redirect('/users/profileedit/' . $id);
            } else {
                $this->Flash->error(__('Something went wrong please try again.'));
                $this->redirect('/users/profileedit/' . $id);
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
                $result['error'] = 0;
                     $result['msg'] = "success";
            } else {
                $result['error'] = 1;
                 $result['msg'] = "Invalid username or password, try again";
            }
        }
        $this->set(compact('result'));
        $this->set('_serialize', 'result');
    }

    /**
     * Logout method
     */
    public function logout() {
        
    }

    public function dashboard() {
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
        //print_r($user);
        $this->set('users', $user);
    }

    public function profileedit() {
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
        //print_r($user);
        $this->set('users', $user);
    }

    public function sendrequest() {
        $this->loadModel('Requests');
        $user = $this->Users->find()->where(['id' => $this->Auth->user('id')])->first();
        //print_r($user);
        $this->set('users', $user);


        if ($this->request->is('post')) {
            $d = $this->request->data;
            $d['destination_city'] = implode(",", $d['destination_city']);
            $d['stops'] = implode(",", $d['stops']);
            $d['room1'] = implode(",", $d['room1']);
            $d['room2'] = implode(",", $d['room2']);
            $d['room3'] = implode(",", $d['room3']);
            $d['child_with_bed'] = implode(",", $d['child_with_bed']);
            $d['child_without_bed'] = implode(",", $d['child_without_bed']);
            $d['hotel_category'] = implode(",", $d['hotel_category']);
            $d['meal_plan'] = implode(",", $d['meal_plan']);
            $d['destination_city'] = implode(",", $d['destination_city']);
            $d['check_in'] = implode(",", $d['check_in']);
            $d['check_out'] = implode(",", $d['check_out']);
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
    
     public function respondtorequest() {
        $this->loadModel('Transports');
        $this->loadModel('Hotels');
        $this->loadModel('Requests');
        $this->loadModel('Cities');
        
        $d = $this->getarray($this->request->data);
        if ($d['role_id'] == 1) {
            $requests = $this->Requests->find()
                            ->contain(["Users", "Cities"])
                            ->where(['Requests.city_id' => $d['city_id']])->all();
        }
        if ($d['role_id'] == 3) {
            $requests = $this->Requests->find()
                            ->contain(["Users", "Cities"])
                            ->where(['Requests.city_id' => $d['city_id'], 'Requests.category_id' => 3])->all();
            
        }
        $this->set(compact('requests'));
        $this->set('_serialize', ['requests']);
        
    }
    
    
     public function requestlist() {
        // print_r($id);
        $this->loadModel('Responses');
        $this->loadModel('Hotels');
        $this->loadModel('Requests');
        $this->loadModel('Cities');
          $d = $this->getarray($this->request->data);
        if ($d['role_id'] == 1) {
            $requests = $this->Requests->find()
                            ->contain(["Users", "Cities"])
                            ->where(['Requests.user_id' => $d['id']])->all();
        }
        if ($d['role_id'] == 3) {
            $requests = $this->Requests->find()
                            ->contain(["Users", "Cities"])
                            ->where(['Requests.user_id' => $d['id'], 'Requests.category_id' => 3])->all();
          //  print_r($requests);
        }
        $this->set(compact('requests'));
        $this->set('_serialize', ['requests']);

        
    }
    
     public function myresponselist() {
        $this->loadModel('Responses');
        $this->loadModel('Requests');
        $this->loadModel('Cities');
        $d = $this->getarray($this->request->data);
      
        $responses = $this->Responses->find()
                        ->contain(["Users", "Requests"])
                        ->where(['Responses.user_id' => $d['user_id']])->all();
        //print_r($responses);
        $this->set(compact('responses'));
        $this->set('_serialize', ['responses']);

     
    }
    
    
    public function checkresponses($id) {
        $this->loadModel('Responses');
        $this->loadModel('Requests');
        $this->loadModel('Cities');
        
        $responses = $this->Responses->find()
                        ->contain(["Users", "Requests"])
                        ->where(['Responses.request_id' => $id])->all();
        // print_r($responses);
        $this->set('responses', $responses);
        $responsess = $this->Requests->find()
                        ->contain(["Users", "Cities"])
                        ->where(['Requests.id' => $id])->first();
        //print_r($responsess);
        $this->set(compact('responsess'));
        $this->set('_serialize', ['responsess']);
         $this->set(compact('responses'));
        $this->set('_serialize', ['responses']);
    }
    
    public function countrylist(){
        $this->loadModel('Countries');
        $countries = $this->Countries->find('all')->all();
         $this->set(compact('countries'));
        $this->set('_serialize', ['countries']);
    }
     public function citylist($id){
        $this->loadModel('Cities');
        $cities = $this->Cities->find()->where(['Cities.state_id' => $id])->all();
         $this->set(compact('cities'));
        $this->set('_serialize', ['cities']);
    }
    public function statelist($id){
        $this->loadModel('States');
        $states = $this->States->find()->where(['States.country_id' => $id])->all();
         $this->set(compact('states'));
        $this->set('_serialize', ['states']);
    }


}
