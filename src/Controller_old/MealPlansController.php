<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * MealPlans Controller
 *
 * @property \App\Model\Table\MealPlansTable $MealPlans
 */
class MealPlansController extends AppController
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
     * View method
     *
     * @param string|null $id Meal Plan id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $mealPlan = $this->MealPlans->get($id, [
            'contain' => []
        ]);

        $this->set('mealPlan', $mealPlan);
        $this->set('_serialize', ['mealPlan']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    /* public function add()
    {
        $mealPlan = $this->MealPlans->newEntity();
        if ($this->request->is('post')) {
            $mealPlan = $this->MealPlans->patchEntity($mealPlan, $this->request->data);
            if ($this->MealPlans->save($mealPlan)) {
                $this->Flash->success(__('The meal plan has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The meal plan could not be saved. Please, try again.'));
        }
        $this->set(compact('mealPlan'));
        $this->set('_serialize', ['mealPlan']);
    } */
	public function add($id = null)
    {
		$this->viewBuilder()->layout('admin_layout');	
		if(!$id)
		{				
			$mealPlan = $this->MealPlans->newEntity();
		}
		else
		{
			$mealPlan = $this->MealPlans->get($id, [
				'contain' => []
			]);
		}
        if ($this->request->is(['patch','post','put'])) 
		{	
            $mealPlan = $this->MealPlans->patchEntity($mealPlan, $this->request->data);
            if ($this->MealPlans->save($mealPlan)) {
                $this->Flash->success(__('The meal plan has been saved.'));
                return $this->redirect(['action' => 'add']);
            }
			else {
                $this->Flash->error(__('The meal plan could not be saved. Please, try again.'));
            }
        }
		//-- View 
		if(isset($this->request->query['search_report'])){
			$mealPlanName = $this->request->query['mealPlanName'];
			if(!empty($mealPlanName)){
				$conditions['MealPlans.mealPlan_name LIKE']=$mealPlanName.'%';
			}
			$conditions['MealPlans.is_deleted']=0;
 			$MealPlans = $this->paginate($this->MealPlans->find()->where($conditions));
  		}
		else {
			$MealPlans = $this->paginate($this->MealPlans->find()->where(['MealPlans.is_deleted'=>0]));
		}
		 
        $this->set(compact('mealPlan','MealPlans','id'));
        $this->set('_serialize', ['mealPlan','MealPlans','id']);
    }
    /**
     * Edit method
     *
     * @param string|null $id Meal Plan id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $mealPlan = $this->MealPlans->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $mealPlan = $this->MealPlans->patchEntity($mealPlan, $this->request->data);
            if ($this->MealPlans->save($mealPlan)) {
                $this->Flash->success(__('The meal plan has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The meal plan could not be saved. Please, try again.'));
        }
        $this->set(compact('mealPlan'));
        $this->set('_serialize', ['mealPlan']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Meal Plan id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $mealPlan = $this->MealPlans->get($id);
        if ($this->MealPlans->delete($mealPlan)) {
            $this->Flash->success(__('The meal plan has been deleted.'));
        } else {
            $this->Flash->error(__('The meal plan could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
