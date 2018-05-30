<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UserRatings Controller
 *
 * @property \App\Model\Table\UserRatingsTable $UserRatings
 */
class UserRatingsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Authors', 'Promotions']
        ];
        $userRatings = $this->paginate($this->UserRatings);

        $this->set(compact('userRatings'));
        $this->set('_serialize', ['userRatings']);
    }

    /**
     * View method
     *
     * @param string|null $id User Rating id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userRating = $this->UserRatings->get($id, [
            'contain' => ['Users', 'Authors', 'Promotions']
        ]);

        $this->set('userRating', $userRating);
        $this->set('_serialize', ['userRating']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userRating = $this->UserRatings->newEntity();
        if ($this->request->is('post')) {
            $userRating = $this->UserRatings->patchEntity($userRating, $this->request->data);
            if ($this->UserRatings->save($userRating)) {
                $this->Flash->success(__('The user rating has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user rating could not be saved. Please, try again.'));
        }
        $users = $this->UserRatings->Users->find('list', ['limit' => 200]);
        $authors = $this->UserRatings->Authors->find('list', ['limit' => 200]);
        $promotions = $this->UserRatings->Promotions->find('list', ['limit' => 200]);
        $this->set(compact('userRating', 'users', 'authors', 'promotions'));
        $this->set('_serialize', ['userRating']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User Rating id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userRating = $this->UserRatings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userRating = $this->UserRatings->patchEntity($userRating, $this->request->data);
            if ($this->UserRatings->save($userRating)) {
                $this->Flash->success(__('The user rating has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user rating could not be saved. Please, try again.'));
        }
        $users = $this->UserRatings->Users->find('list', ['limit' => 200]);
        $authors = $this->UserRatings->Authors->find('list', ['limit' => 200]);
        $promotions = $this->UserRatings->Promotions->find('list', ['limit' => 200]);
        $this->set(compact('userRating', 'users', 'authors', 'promotions'));
        $this->set('_serialize', ['userRating']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User Rating id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userRating = $this->UserRatings->get($id);
        if ($this->UserRatings->delete($userRating)) {
            $this->Flash->success(__('The user rating has been deleted.'));
        } else {
            $this->Flash->error(__('The user rating could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
