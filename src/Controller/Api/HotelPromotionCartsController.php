<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * HotelPromotionCarts Controller
 *
 * @property \App\Model\Table\HotelPromotionCartsTable $HotelPromotionCarts
 */
class HotelPromotionCartsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['HotelPromotions', 'Users']
        ];
        $hotelPromotionCarts = $this->paginate($this->HotelPromotionCarts);

        $this->set(compact('hotelPromotionCarts'));
        $this->set('_serialize', ['hotelPromotionCarts']);
    }

    /**
     * View method
     *
     * @param string|null $id Hotel Promotion Cart id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hotelPromotionCart = $this->HotelPromotionCarts->get($id, [
            'contain' => ['HotelPromotions', 'Users']
        ]);

        $this->set('hotelPromotionCart', $hotelPromotionCart);
        $this->set('_serialize', ['hotelPromotionCart']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function HotelPromotionCartAdd()
    {
        $hotelPromotionCart = $this->HotelPromotionCarts->newEntity();
        if ($this->request->is('post')) {
			
			$user_id=$this->request->data('user_id');
			$hotel_promotion_id=$this->request->data('hotel_promotion_id');
			
			$data_count=$this->HotelPromotionCarts->find()->where(['hotel_promotion_id'=>$hotel_promotion_id,'user_id'=>$user_id,'is_deleted'=>0])->count();
			
			if(empty($data_count)){
            $hotelPromotionCart = $this->HotelPromotionCarts->patchEntity($hotelPromotionCart, $this->request->data);
            if ($this->HotelPromotionCarts->save($hotelPromotionCart)) {
               
						$message = 'Hotel Promotion Cart has been saved';
						$response_code = 200;
					}else{
						$message = 'Hotel Promotion Cart has not been saved';
						$response_code = 204;				
					}	
			}else{
				
				$query = $this->HotelPromotionCarts->query();
					$query->update()
							->set(['is_deleted' => 1])
							->where(['hotel_promotion_id'=>$hotel_promotion_id,'user_id'=>$user_id])
							->execute();
						$message = 'The Hotel Promotion Cart has been Deleted';
						$response_code = 300;
			}	
        }
		$this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);
    }

	
	public function HotelPromotionCartlist($user_id=null)
	{
		
		$user_id = $this->request->query('user_id');
		if(!empty($user_id))
		{
			$hotelPromotionCarts=$this->HotelPromotionCarts->find()->where(['HotelPromotionCarts.user_id'=>$user_id, 'HotelPromotionCarts.is_deleted'=>0])->contain(['HotelPromotions','Users']);
			if(!empty($hotelPromotionCarts->toArray())){
				
				foreach($hotelPromotionCarts as $data){
					
					$hotel_promotion_id=$data->hotel_promotion_id;
					$data->total_likes = $this->HotelPromotionCarts->HotelPromotions->HotelPromotionLikes
							->find()->where(['hotel_promotion_id' => $hotel_promotion_id])->count();	
					$exists = $this->HotelPromotionCarts->HotelPromotions->HotelPromotionLikes->exists(['hotel_promotion_id'=>$hotel_promotion_id,'user_id'=>$user_id]);
					if($exists == 1)
					{ $data->isLiked = 'yes'; }
					else{ $data->isLiked = 'no'; }
					
					$carts = $this->HotelPromotionCarts->exists(['HotelPromotionCarts.hotel_promotion_id'=>$hotel_promotion_id,'HotelPromotionCarts.user_id'=>$user_id,'HotelPromotionCarts.is_deleted'=>0]);
					if($carts==0){
						$data->issaved=false;
					}else{
						$data->issaved=true;
					}
					
					$data->total_views = $this->HotelPromotionCarts->HotelPromotions->HotelPromotionViews
						->find()->where(['hotel_promotion_id' => $hotel_promotion_id])->count();
					
					$all_raiting=0;	
					$testimonial=$this->HotelPromotionCarts->HotelPromotions->Users->Testimonial->find()->where(['Testimonial.user_id'=>$user_id]);
					$testimonial_count=$this->HotelPromotionCarts->HotelPromotions->Users->Testimonial->find()->where(['Testimonial.user_id'=>$user_id])->count();
						 
						 foreach($testimonial as $test_data){
							 $rating=$test_data->rating;
							 $all_raiting+=$rating;
						 }
						 if($testimonial_count>0){
							 $final_raiting=($all_raiting/$testimonial_count);
							 if($final_raiting>0){
								$data->user_rating=number_format($final_raiting, 1);
							 }else{
								$data->user_rating=0;
							 }	
						 }else{
								$data->user_rating=0;
						 }	 
					
				}
				
				
				$message = 'Hotel Promotion Carts List Found Successfully';
				$response_code = 200;
			}
			else
			{
				$message = 'No Content Found';
				$hotelPromotionCarts = [];
				$response_code = 204;			
			}			
		}		
		else
		{
			$message = 'Hotel Promotion Carts is empty';
			$hotelPromotionCarts = [];
			$response_code = 300;
		}		
		$this->set(compact('hotelPromotionCarts','message','response_code'));
        $this->set('_serialize', ['hotelPromotionCarts','message','response_code']);		
	}
	
    /**
     * Edit method
     *
     * @param string|null $id Hotel Promotion Cart id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hotelPromotionCart = $this->HotelPromotionCarts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hotelPromotionCart = $this->HotelPromotionCarts->patchEntity($hotelPromotionCart, $this->request->data);
            if ($this->HotelPromotionCarts->save($hotelPromotionCart)) {
                $this->Flash->success(__('The hotel promotion cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The hotel promotion cart could not be saved. Please, try again.'));
        }
        $hotelPromotions = $this->HotelPromotionCarts->HotelPromotions->find('list', ['limit' => 200]);
        $users = $this->HotelPromotionCarts->Users->find('list', ['limit' => 200]);
        $this->set(compact('hotelPromotionCart', 'hotelPromotions', 'users'));
        $this->set('_serialize', ['hotelPromotionCart']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Hotel Promotion Cart id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hotelPromotionCart = $this->HotelPromotionCarts->get($id);
        if ($this->HotelPromotionCarts->delete($hotelPromotionCart)) {
            $this->Flash->success(__('The hotel promotion cart has been deleted.'));
        } else {
            $this->Flash->error(__('The hotel promotion cart could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
