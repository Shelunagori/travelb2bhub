<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * TaxiFleetPromotionCarts Controller
 *
 * @property \App\Model\Table\TaxiFleetPromotionCartsTable $TaxiFleetPromotionCarts
 */
class TaxiFleetPromotionCartsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['TaxiFleetPromotions', 'Users']
        ];
        $taxiFleetPromotionCarts = $this->paginate($this->TaxiFleetPromotionCarts);

        $this->set(compact('taxiFleetPromotionCarts'));
        $this->set('_serialize', ['taxiFleetPromotionCarts']);
    }

    /**
     * View method
     *
     * @param string|null $id Taxi Fleet Promotion Cart id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $taxiFleetPromotionCart = $this->TaxiFleetPromotionCarts->get($id, [
            'contain' => ['TaxiFleetPromotions', 'Users']
        ]);

        $this->set('taxiFleetPromotionCart', $taxiFleetPromotionCart);
        $this->set('_serialize', ['taxiFleetPromotionCart']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function TaxiFleetPromotionsCartAdd()
    {
        $taxiFleetPromotionCart = $this->TaxiFleetPromotionCarts->newEntity();
        if ($this->request->is('post')) {
			
			$user_id=$this->request->data('user_id');
			$taxi_fleet_promotion_id=$this->request->data('taxi_fleet_promotion_id');
			
			$data_count=$this->TaxiFleetPromotionCarts->find()->where(['taxi_fleet_promotion_id'=>$taxi_fleet_promotion_id,'user_id'=>$user_id,'is_deleted'=>0])->count();
			
			if(empty($data_count)){
            $taxiFleetPromotionCart = $this->TaxiFleetPromotionCarts->patchEntity($taxiFleetPromotionCart, $this->request->data);
            if ($this->TaxiFleetPromotionCarts->save($taxiFleetPromotionCart)) {
 
						$message = 'The Taxi Fleet Promotion Cart has been saved';
						$response_code = 200;
					}else{
						
						$message = 'The Taxi Fleet Promotion Cart has not been saved';
						$response_code = 204;				
					}	
			}else{
				
				$query = $this->TaxiFleetPromotionCarts->query();
					$query->update()
							->set(['is_deleted' => 1])
							->where(['taxi_fleet_promotion_id'=>$taxi_fleet_promotion_id,'user_id'=>$user_id])
							->execute();
						$message = 'The Taxi Fleet Promotion Cart has been Deleted';
						$response_code = 300;
			}	
        }
		$this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);
    }

	
	public function TaxiFleetPromotionsCartlist($user_id=null)
	{
		
		$user_id = $this->request->query('user_id');
		if(!empty($user_id))
		{
			$taxiFleetPromotionCarts=$this->TaxiFleetPromotionCarts->find()->where(['TaxiFleetPromotionCarts.user_id'=>$user_id, 'TaxiFleetPromotionCarts.is_deleted'=>0,'TaxiFleetPromotions.is_deleted'=>0])->contain(['TaxiFleetPromotions'=>['TaxiFleetPromotionStates'=>['States'],'Users'=>function($q){
				return $q->select(['first_name','last_name','mobile_number','company_name','email']);
			},'TaxiFleetPromotionCities'=>['Cities'],TaxiFleetPromotionRows=>['TaxiFleetCarBuses']]]);
			if(!empty($taxiFleetPromotionCarts->toArray())){
				
				foreach($taxiFleetPromotionCarts as $data){
					
					
					$taxi_fleet_promotion_id=$data->taxi_fleet_promotion_id;
					$data->total_likes = $this->TaxiFleetPromotionCarts->TaxiFleetPromotions->TaxiFleetPromotionLikes
							->find()->where(['taxi_fleet_promotion_id' => $taxi_fleet_promotion_id])->count();	
							
					$exists = $this->TaxiFleetPromotionCarts->TaxiFleetPromotions->TaxiFleetPromotionLikes->exists(['TaxiFleetPromotionLikes.taxi_fleet_promotion_id'=>$taxi_fleet_promotion_id,'TaxiFleetPromotionLikes.user_id'=>$user_id]);
					
					if($exists != 0)
					{  $data->isLiked = 'yes'; } 
					else { $data->isLiked = 'no'; }	

					$carts = $this->TaxiFleetPromotionCarts->exists(['TaxiFleetPromotionCarts.taxi_fleet_promotion_id'=>$taxi_fleet_promotion_id,'TaxiFleetPromotionCarts.user_id'=>$user_id,'TaxiFleetPromotionCarts.is_deleted'=>0]);
					if($carts==0){
						$data->issaved=false;
					}else{
						$data->issaved=true;
					}			
					
					$data->total_views = $this->TaxiFleetPromotionCarts->TaxiFleetPromotions->TaxiFleetPromotionViews
						->find()->where(['taxi_fleet_promotion_id' => $taxi_fleet_promotion_id])->count();
					
					$all_raiting=0;	
					$testimonial=$this->TaxiFleetPromotionCarts->TaxiFleetPromotions->Users->Testimonial->find()->where(['Testimonial.user_id'=>$data->taxi_fleet_promotion->user_id]);
					$testimonial_count=$this->TaxiFleetPromotionCarts->TaxiFleetPromotions->Users->Testimonial->find()->where(['Testimonial.user_id'=>$data->taxi_fleet_promotion->user_id])->count();
						 
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
				
				
				$message = 'Taxi Fleet Promotion Carts List Found Successfully';
				$response_code = 200;
			}
			else
			{
				$message = 'No Content Found';
				$taxiFleetPromotionCarts = [];
				$response_code = 204;			
			}			
		}		
		else
		{
			$message = 'Taxi Fleet Promotion Carts is empty';
			$taxiFleetPromotionCarts = [];
			$response_code = 300;
		}		
		$this->set(compact('taxiFleetPromotionCarts','message','response_code'));
        $this->set('_serialize', ['taxiFleetPromotionCarts','message','response_code']);		
	}
	
    /**
     * Edit method
     *
     * @param string|null $id Taxi Fleet Promotion Cart id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $taxiFleetPromotionCart = $this->TaxiFleetPromotionCarts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $taxiFleetPromotionCart = $this->TaxiFleetPromotionCarts->patchEntity($taxiFleetPromotionCart, $this->request->data);
            if ($this->TaxiFleetPromotionCarts->save($taxiFleetPromotionCart)) {
                $this->Flash->success(__('The taxi fleet promotion cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The taxi fleet promotion cart could not be saved. Please, try again.'));
        }
        $taxiFleetPromotions = $this->TaxiFleetPromotionCarts->TaxiFleetPromotions->find('list', ['limit' => 200]);
        $users = $this->TaxiFleetPromotionCarts->Users->find('list', ['limit' => 200]);
        $this->set(compact('taxiFleetPromotionCart', 'taxiFleetPromotions', 'users'));
        $this->set('_serialize', ['taxiFleetPromotionCart']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Taxi Fleet Promotion Cart id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $taxiFleetPromotionCart = $this->TaxiFleetPromotionCarts->get($id);
        if ($this->TaxiFleetPromotionCarts->delete($taxiFleetPromotionCart)) {
            $this->Flash->success(__('The taxi fleet promotion cart has been deleted.'));
        } else {
            $this->Flash->error(__('The taxi fleet promotion cart could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
