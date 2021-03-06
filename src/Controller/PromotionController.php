<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Promotion Controller
 *
 * @property \App\Model\Table\PromotionTable $Promotion
 */
class PromotionController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$this->viewBuilder()->layout('admin_layout');
        $this->paginate = [
            'contain' => ['Users']
        ];
		if(isset($this->request->query['search_report'])){
			$statusWise = @$this->request->query['statusWise'];
			$hotelNM = $this->request->query['hotelNM'];
			if(!empty($hotelNM)){
				$conditions['Promotion.hotel_name LIKE']='%'.$hotelNM.'%';
			}
			if($statusWise==2 ||$statusWise==1){
				if($statusWise==2){
					$conditions['Promotion.status']=0;
				}
				if($statusWise==1){
					$conditions['Promotion.status']=1;
				}
			}
  			$promotion = $this->paginate($this->Promotion->find()->where($conditions));
  		}
		else {
			$promotion = $this->paginate($this->Promotion);
		}
        
        $this->set(compact('promotion'));
        $this->set('_serialize', ['promotion']);
    }

	public function report()
    {
		$this->viewBuilder()->layout('admin_layout');
        $this->paginate = [
            'contain' => ['Users']
        ];
		if(isset($this->request->query['search_report'])){
			$statusWise = @$this->request->query['statusWise'];
			$hotelNM = $this->request->query['hotelNM'];
			if(!empty($hotelNM)){
				$conditions['Promotion.hotel_name LIKE']='%'.$hotelNM.'%';
			}
			if($statusWise==2 ||$statusWise==1){
				if($statusWise==2){
					$conditions['Promotion.status']=0;
				}
				if($statusWise==1){
					$conditions['Promotion.status']=1;
				}
			}
  			$promotion = $this->paginate($this->Promotion->find()->where($conditions));
  		}
		else {
			$promotion = $this->paginate($this->Promotion);
		}
        
        $this->set(compact('promotion'));
        $this->set('_serialize', ['promotion']);
    }
    /**
     * View method
     *
     * @param string|null $id Promotion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $promotion = $this->Promotion->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('promotion', $promotion);
        $this->set('_serialize', ['promotion']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $promotion = $this->Promotion->newEntity();
        if ($this->request->is('post')) {
            $promotion = $this->Promotion->patchEntity($promotion, $this->request->data);
            if ($this->Promotion->save($promotion)) {
                $this->Flash->success(__('The promotion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The promotion could not be saved. Please, try again.'));
            }
        }
        $users = $this->Promotion->Users->find('list', ['limit' => 200]);
        $this->set(compact('promotion', 'users'));
        $this->set('_serialize', ['promotion']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Promotion id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $promotion = $this->Promotion->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $promotion = $this->Promotion->patchEntity($promotion, $this->request->data);
            if ($this->Promotion->save($promotion)) {
                $this->Flash->success(__('The promotion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The promotion could not be saved. Please, try again.'));
            }
        }
        $users = $this->Promotion->Users->find('list', ['limit' => 200]);
        $this->set(compact('promotion', 'users'));
        $this->set('_serialize', ['promotion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Promotion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $promotion = $this->Promotion->get($id);
        if ($this->Promotion->delete($promotion)) {
            $this->Flash->success(__('The promotion has been deleted.'));
        } else {
            $this->Flash->error(__('The promotion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
