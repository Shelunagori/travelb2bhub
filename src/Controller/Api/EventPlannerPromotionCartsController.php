<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * EventPlannerPromotionCarts Controller
 *
 * @property \App\Model\Table\EventPlannerPromotionCartsTable $EventPlannerPromotionCarts
 */
class EventPlannerPromotionCartsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['EventPlannerPromotions', 'Users']
        ];
        $eventPlannerPromotionCarts = $this->paginate($this->EventPlannerPromotionCarts);

        $this->set(compact('eventPlannerPromotionCarts'));
        $this->set('_serialize', ['eventPlannerPromotionCarts']);
    }

    /**
     * View method
     *
     * @param string|null $id Event Planner Promotion Cart id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eventPlannerPromotionCart = $this->EventPlannerPromotionCarts->get($id, [
            'contain' => ['EventPlannerPromotions', 'Users']
        ]);

        $this->set('eventPlannerPromotionCart', $eventPlannerPromotionCart);
        $this->set('_serialize', ['eventPlannerPromotionCart']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function EventPlannerPromotionsCartAdd()
    {
        $eventPlannerPromotionCart = $this->EventPlannerPromotionCarts->newEntity();
        if ($this->request->is('post')) {
			
			$user_id=$this->request->data('user_id');
			$event_planner_promotion_id=$this->request->data('event_planner_promotion_id');
			
			$data_count=$this->EventPlannerPromotionCarts->find()->where(['event_planner_promotion_id'=>$event_planner_promotion_id,'user_id'=>$user_id,'is_deleted'=>0])->count();

			if(empty($data_count)){
            $eventPlannerPromotionCart = $this->EventPlannerPromotionCarts->patchEntity($eventPlannerPromotionCart, $this->request->data);
            if ($this->EventPlannerPromotionCarts->save($eventPlannerPromotionCart)) {
                
						$message = 'The Event Planner Promotion Cart has been saved';
						$response_code = 200;
					}else{
						$message = 'The Event Planner Promotion Cart has not been saved';
						$response_code = 204;				
					}	
			}else{
				
				$query = $this->EventPlannerPromotionCarts->query();
					$query->update()
							->set(['is_deleted' => 1])
							->where(['event_planner_promotion_id'=>$event_planner_promotion_id,'user_id'=>$user_id])
							->execute();
						$message = 'The Event Planner Promotion Cart has been Deleted';
						$response_code = 300;
			}	
        }
		$this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);
    }

	
	public function EventPlannerPromotionsCartlist($user_id=null)
	{
		
		$user_id = $this->request->query('user_id');
		if(!empty($user_id))
		{
			$eventPlannerPromotionCarts=$this->EventPlannerPromotionCarts->find()->where(['EventPlannerPromotionCarts.user_id'=>$user_id, 'EventPlannerPromotionCarts.is_deleted'=>0,'EventPlannerPromotions.is_deleted'=>0])->contain(['EventPlannerPromotions'=>['PriceMasters','Countries','EventPlannerPromotionCities'=>['Cities'],'EventPlannerPromotionStates'=>['States'],'Users'=>function($q){
				return $q->select(['first_name','last_name','mobile_number','company_name']);
			},'EventPlannerPromotionCities'=>['Cities']]]);
			//pr($eventPlannerPromotionCarts->toArray()); exit;
			if(!empty($eventPlannerPromotionCarts->toArray())){
				
				
				foreach($eventPlannerPromotionCarts as $data){
					
					$event_planner_promotion_id=$data->event_planner_promotion_id;
					
					$data->total_likes = $this->EventPlannerPromotionCarts->EventPlannerPromotions->EventPlannerPromotionLikes
							->find()->where(['event_planner_promotion_id' => $event_planner_promotion_id])->count();	
					$exists = $this->EventPlannerPromotionCarts->EventPlannerPromotions->EventPlannerPromotionLikes->exists(['event_planner_promotion_id'=>$event_planner_promotion_id,'user_id'=>$user_id]);
					if($exists == 1)
					{ $data->isLiked = 'yes'; }
					else{ $data->isLiked = 'no'; }
					
					$carts = $this->EventPlannerPromotionCarts->exists(['EventPlannerPromotionCarts.event_planner_promotion_id'=>$event_planner_promotion_id,'EventPlannerPromotionCarts.user_id'=>$user_id,'EventPlannerPromotionCarts.is_deleted'=>0]);
					if($carts==0){
						$data->issaved=false;
					}else{
						$data->issaved=true;
					}	
					
					$data->total_views = $this->EventPlannerPromotionCarts->EventPlannerPromotions->EventPlannerPromotionViews
						->find()->where(['event_planner_promotion_id' => $event_planner_promotion_id])->count();
						
					$all_raiting=0;	
					$testimonial=$this->EventPlannerPromotionCarts->EventPlannerPromotions->Users->Testimonial->find()->where(['Testimonial.user_id'=>$data->event_planner_promotion->user_id]);
					$testimonial_count=$this->EventPlannerPromotionCarts->EventPlannerPromotions->Users->Testimonial->find()->where(['Testimonial.user_id'=>$data->event_planner_promotion->user_id])->count();
						 
						 foreach($testimonial as $test_data){
							 $rating=$test_data->rating;
							 $all_raiting+=$rating;
						 }
						 if($testimonial_count>0){
							 $final_raiting=($all_raiting/$testimonial_count);
							 if($final_raiting>0){
								$data->user_rating=number_format($final_raiting, 1);
							 }else{
								$data->user_rating="0";
							 }	
						 }else{
							$data->user_rating="0";
						 }	 
					
					
				}	
				$message = 'Event Planner Promotion Carts List Found Successfully';
				$response_code = 200;
			}
			else
			{
				$message = 'No Content Found';
				$eventPlannerPromotionCarts = [];
				$response_code = 204;			
			}			
		}		
		else
		{
			$message = 'Event Planner Promotion Carts is empty';
			$eventPlannerPromotionCarts = [];
			$response_code = 300;
		}		
		$this->set(compact('eventPlannerPromotionCarts','message','response_code'));
        $this->set('_serialize', ['eventPlannerPromotionCarts','message','response_code']);		
	}
	
	
    /**
     * Edit method
     *
     * @param string|null $id Event Planner Promotion Cart id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eventPlannerPromotionCart = $this->EventPlannerPromotionCarts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eventPlannerPromotionCart = $this->EventPlannerPromotionCarts->patchEntity($eventPlannerPromotionCart, $this->request->data);
            if ($this->EventPlannerPromotionCarts->save($eventPlannerPromotionCart)) {
                $this->Flash->success(__('The event planner promotion cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event planner promotion cart could not be saved. Please, try again.'));
        }
        $eventPlannerPromotions = $this->EventPlannerPromotionCarts->EventPlannerPromotions->find('list', ['limit' => 200]);
        $users = $this->EventPlannerPromotionCarts->Users->find('list', ['limit' => 200]);
        $this->set(compact('eventPlannerPromotionCart', 'eventPlannerPromotions', 'users'));
        $this->set('_serialize', ['eventPlannerPromotionCart']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event Planner Promotion Cart id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eventPlannerPromotionCart = $this->EventPlannerPromotionCarts->get($id);
        if ($this->EventPlannerPromotionCarts->delete($eventPlannerPromotionCart)) {
            $this->Flash->success(__('The event planner promotion cart has been deleted.'));
        } else {
            $this->Flash->error(__('The event planner promotion cart could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
