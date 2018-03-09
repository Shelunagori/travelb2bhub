<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;


class EventPlannerPromotionsController extends AppController
{
    public function add()
    {
        $eventPlannerPromotion = $this->EventPlannerPromotions->newEntity();
        if ($this->request->is('post')) {
            $eventPlannerPromotion = $this->EventPlannerPromotions->patchEntity($eventPlannerPromotion,$this->request->data(),['associated' => ['EventPlannerPromotionStates','EventPlannerPromotionCities']]);

			$message = 'PERFECT';
			$response_code = 101;
			$id=$eventPlannerPromotion->user_id;
			$title = 'Event_'.rand();
			$image = $this->request->data('image');	
			$document = $this->request->data('document');
			$submitted_from = @$this->request->data('submitted_from');
			if(@$submitted_from=='web')
			{
				$state_id=$this->request->data['state_id'];
				$x=0;
				foreach($state_id as $state)
				{
					$eventPlannerPromotion['event_planner_promotion_states['.$x.']["state_id"]']=$state_id[$x];
					$x++;
				}
				$city_id=$this->request->data['city_id'];
				$y=0;
				foreach($city_id as $city)
				{
					$eventPlannerPromotion['event_planner_promotion_cities['.$y.']["city_id"]']=$city_id[$y];
					$y++;	
				}
			}
			if(!empty($this->request->data('visible_date')))
			{
				$eventPlannerPromotion->visible_date = date('Y-m-d',strtotime($this->request->data('visible_date')));
			}
			if(!empty($image))
			{	
				$dir = new Folder(WWW_ROOT . 'images/eventPlannerPromotion/'.$id.'/'.$title.'/image', true, 0755);
				$ext = substr(strtolower(strrchr($image['name'], '.')), 1); 
				$arr_ext = array('jpg', 'jpeg','png'); 				
				
				if(!empty($ext))
				{
					if(in_array($ext, $arr_ext)) { 
						if (!file_exists('path/to/directory')) {
								mkdir('path/to/directory', 0777, true);
							}
						if(move_uploaded_file($image['tmp_name'], WWW_ROOT . '/images/eventPlannerPromotion/'.$id.'/'.$title.'/image/'.$id.'.'.$ext)) {
							$eventPlannerPromotion->image='images/eventPlannerPromotion/'.$id.'/'.$title.'/image/'.$id.'.'.$ext;
						} else {
							$message = 'Image not uploaded';
							$response_code = 102;
						}
					} 
					else 
					{ 
						$message = 'Invalid image extension';
						$response_code = 103;  
					}					
				}
				else 
				{ 	
					$message = 'Invalid image extension';
					$response_code = 103;  
				}				
			} else { $eventPlannerPromotion->image ='';  }	

			if(!empty($document))
			{  
				$dir = new Folder(WWW_ROOT . 'images/eventPlannerPromotion/'.$id.'/'.$title.'/document', true, 0755);
				$ext = substr(strtolower(strrchr($document['name'], '.')), 1); 
				$arr_ext = array('jpg', 'jpeg','png','pdf'); 				
				if(!empty($ext))
				{
					if (in_array($ext, $arr_ext)) {
						if (!file_exists('path/to/directory')) {
								mkdir('path/to/directory', 0777, true);
							}
						if(move_uploaded_file($document['tmp_name'], WWW_ROOT . '/images/eventPlannerPromotion/'.$id.'/'.$title.'/document/'.$id.'.'.$ext)) {
							$eventPlannerPromotion->document='images/eventPlannerPromotion/'.$id.'/'.$title.'/document/'.$id.'.'.$ext;
						} else {
							$message = 'Document not uploaded';
							$response_code = 104;
							
						}
					} 
					else 
					{ 	
						$message = 'Invalid document extension';
						$response_code = 105;  
					}					
				}
				else 
				{ 	
					$message = 'Invalid document extension';
					$response_code = 105;  
				}				
			} else { $eventPlannerPromotion->document = ''; }			

			if($message == 'PERFECT' && $response_code == 101)
			{
				if ($this->EventPlannerPromotions->save($eventPlannerPromotion)) {
					$message = 'The event promotions has been saved';
					$response_code = 200;
				}else{
					$message = 'The event promotions has not been saved';
					$response_code = 204;				
				}
			}			
        }
		if(@$submitted_from=='web')
		{
			$this->Flash->success(__('message')); 
			return $this->redirect($this->coreVariable['SiteUrl'].'EventPlannerPromotions/report');
		}
		$this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);		
    }

	public function likeEventPlannerPromotions()
	{
        $likeEventPlannerPromotions = $this->EventPlannerPromotions->EventPlannerPromotionLikes->newEntity();
        if ($this->request->is('post')) {
           
			$likeEventPlannerPromotions = $this->EventPlannerPromotions->EventPlannerPromotionLikes->patchEntity($likeEventPlannerPromotions, $this->request->data);		
			
			$exists = $this->EventPlannerPromotions->EventPlannerPromotionLikes->exists(['event_planner_promotion_id'=>$likeEventPlannerPromotions->event_planner_promotion_id,'user_id'=>$likeEventPlannerPromotions->user_id]);
			
			if($exists == 0)
			{
				if ($this->EventPlannerPromotions->EventPlannerPromotionLikes->save($likeEventPlannerPromotions)) {
					$message = 'Liked successfully';
					$response_code = 200;
				}else{
					$message = 'Like not saved';
					$response_code = 204;				
				}				
			}
			else
			{
				$this->EventPlannerPromotions->EventPlannerPromotionLikes->deleteAll(['event_planner_promotion_id'=>$likeEventPlannerPromotions->event_planner_promotion_id,'user_id'=>$likeEventPlannerPromotions->user_id]);
					
				$message = 'Disliked';
				$response_code = 200;						
			}	

		}
		$this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);		
	}
	
	public function removeEvent($event_id = null)
	{
		$event_id = $this->request->query('event_id');
		if(!empty($event_id))
		{
			$query = $this->EventPlannerPromotions->query();
			$query->update()->set(['is_deleted' => 1])
			->where(['id' => $event_id])->execute();			
			$message = 'The Package has been deleted successfully';
			$response_code = 200;			
		}
		else
		{
			$message = 'Enter Event ID';
			$response_code = 204;				
		}
		$this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);				
	}

	public function getEventPlannerReport($user_id = null)
	{
		$user_id = $this->request->query('user_id');
		if(!empty($user_id))
		{
			$getEventPlanners = $this->EventPlannerPromotions->find()
			->where(['is_deleted' =>0])
			->where(['user_id'=>$user_id])
			->group(['EventPlannerPromotions.id'])
			->autoFields(true);
	
			if(!empty($getEventPlanners->toArray()))
			{
				foreach($getEventPlanners as $getEventPlanner)
				{
					$getEventPlanner->total_likes = $this->EventPlannerPromotions->EventPlannerPromotionLikes
							->find()->where(['event_planner_promotion_id' => $getEventPlanner->id])->count();

					$getEventPlanner->total_views = $this->EventPlannerPromotions->EventPlannerPromotionViews
							->find()->where(['event_planner_promotion_id' => $getEventPlanner->id])->count();
					
					if($getEventPlanner->visible_date >= date('Y-m-d'))
					{
						$getEventPlanner->expir_status = 'valid';	
					}else
					{
						$getEventPlanner->expir_status = 'expired';		
					}
				}
				$message = 'List Found Successfully';
				$response_code = 200;
			}
			else
			{
				$message = 'No Content Found';
				$getEventPlanners = [];
				$response_code = 204;			
			}			
		}else {
				$message = 'Please Enter User ID ';
				$getEventPlanners = [];
				$response_code = 205;			
		}

		
		$this->set(compact('getEventPlanners','message','response_code'));
        $this->set('_serialize', ['getEventPlanners','message','response_code']);				
	}	
	
	public function getEventPlanners($isLikedUserId = null)
	{
		$isLikedUserId = $this->request->query('isLikedUserId');
		if(!empty($isLikedUserId))
		{
			$getEventPlanners = $this->EventPlannerPromotions->find();
				$getEventPlanners->select(['total_likes'=>$getEventPlanners->func()->count('EventPlannerPromotionLikes.id')])
				->leftJoinWith('EventPlannerPromotionLikes')
			->contain(['Users','PriceMasters','Countries'])
			->where(['EventPlannerPromotions.visible_date >=' =>date('Y-m-d')])
			->where(['EventPlanner.Promotionsis_deleted' =>0])
			->group(['EventPlannerPromotions.id'])
			->autoFields(true);
			
			if(!empty($getEventPlanners->toArray()))
			{
				foreach($getEventPlanners as $getEventPlanner)
				{
					$exists = $this->EventPlannerPromotions->EventPlannerPromotionLikes->exists(['event_planner_promotion_id'=>$getEventPlanner->id,'user_id'=>$isLikedUserId]);
					if($exists == 1)
					{ $getEventPlanner->isLiked = 'yes'; }
					else{ $getEventPlanner->isLiked = 'no'; }
				}
				
				
				$message = 'List Found Successfully';
				$response_code = 200;
			}
			else
			{
				$message = 'No Content Found';
				$getEventPlanners = [];
				$response_code = 204;			
			}			
		}
		else
		{
				$message = 'isLikedUserId is empty';
				$getEventPlanners = [];
				$response_code = 204;				
		}

		
		$this->set(compact('getEventPlanners','message','response_code'));
        $this->set('_serialize', ['getEventPlanners','message','response_code']);		
	}

	public function getEventPlannersDetails($id = null,$user_id = null)
	{
		$id = $this->request->query('id');
		$user_id = $this->request->query('user_id');
		$getEventPlannersDetails = $this->EventPlannerPromotions->find();
		$getEventPlannersDetails->select(['total_likes'=>$getEventPlannersDetails->func()->count('EventPlannerPromotionLikes.id')])
			->leftJoinWith('EventPlannerPromotionLikes')
			->contain(['Users','PriceMasters','Countries','EventPlannerPromotionStates'=>['States'],'EventPlannerPromotionCities'=>['Cities']])
			->where(['EventPlannerPromotions.id'=>$id])
			->where(['EventPlannerPromotions.is_deleted' =>0])
			->group(['EventPlannerPromotions.id'])
		->autoFields(true);
		
		//pr($getEventPlannersDetails->toArray()); exit;
		
		if(!empty($getEventPlannersDetails->toArray()))
		{
			$viewEventPlannerPromotions = $this->EventPlannerPromotions->EventPlannerPromotionViews->newEntity();
      
  			$viewEventPlannerPromotions->event_planner_promotion_id = $id;
			$viewEventPlannerPromotions->user_id = $user_id;         
			
			
			$exists = $this->EventPlannerPromotions->EventPlannerPromotionViews->exists(['event_planner_promotion_id'=>$viewEventPlannerPromotions->event_planner_promotion_id,'user_id'=>$viewEventPlannerPromotions->user_id]);
			
			if($exists == 0)
			{
				if ($this->EventPlannerPromotions->EventPlannerPromotionViews->save($viewEventPlannerPromotions)) {
					$message = 'Data found and view increased by 1';
					$response_code = 200;
				}else{
					$message = 'Data found but view not increased';
					$response_code = 204;				
				}				
			}
			else
			{
					$message = 'Data found but viewed already';
					$response_code = 205;					
			}
		}
		else
		{
			$message = 'No Content Found';
			$getEventPlannersDetails = [];
			$response_code = 204;			
		}
		
		$this->set(compact('getEventPlannersDetails','message','response_code'));
        $this->set('_serialize', ['getEventPlannersDetails','message','response_code']);		
	}

	public function renewEventPlanner($event_id = null,$price_master_id=null,$price=null,$visible_date=null)
	{
		$event_id = $this->request->query('event_id');
		$price_master_id = $this->request->query('price_master_id');
		$price = $this->request->query('price');
		$visible_date = $this->request->query('visible_date');
		if(!empty($event_id) && !empty($price_master_id) && !empty($price) && !empty($visible_date))
		{
		$getEventPlannerPromotions = $this->EventPlannerPromotions->find()->where(['id'=>$event_id]);
			if(!empty($getEventPlannerPromotions->toArray()))
			{
				foreach($getEventPlannerPromotions as $getEventPlannerPromotion)
				{
					$PriceBeforeRenews = $this->EventPlannerPromotions->EventPlannerPromotionPriceBeforeRenews->newEntity();
					
					$PriceBeforeRenews->event_planner_promotion_id = $getEventPlannerPromotion->id;
					$PriceBeforeRenews->price_master_id = $getEventPlannerPromotion->price_master_id;
					$PriceBeforeRenews->price = $getEventPlannerPromotion->price;
					$PriceBeforeRenews->visible_date = $getEventPlannerPromotion->visible_date;
					
					if ($this->EventPlannerPromotions->EventPlannerPromotionPriceBeforeRenews->save($PriceBeforeRenews))
					{
						$query = $this->EventPlannerPromotions->query();
						$query->update()->set(['price_master_id' => $price_master_id,'price'=>$price,'visible_date'=>date('Y-m-d',strtotime($visible_date))])
						->where(['id' => $event_id])->execute();			
						$message = 'Update Successfully';
						$response_code = 200;						
					}else
					{
						$message = 'not updated';
						$response_code = 204;						
					}
				}
			}			
		}else
		{
						$message = 'Invalid Data';
						$response_code = 205;				
		}

		$this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);		

	}		

	
}
