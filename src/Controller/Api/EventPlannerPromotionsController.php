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
				$eventPlannerPromotion->event_planner_promotion_states = [];
				$eventPlannerPromotion->event_planner_promotion_cities = []; 
				$state_id=$this->request->data['state_id'];
				$x=0;
				foreach($state_id as $state)
				{
 					$eventPlannerPromotionStates = $this->EventPlannerPromotions->EventPlannerPromotionStates->newEntity();
					$eventPlannerPromotionStates->state_id = $state;
					$eventPlannerPromotion->event_planner_promotion_states[$x]=$eventPlannerPromotionStates;
					$x++;
				}
				$city_id=$this->request->data['city_id'];
				$y=0;
				foreach($city_id as $city)
				{
					$eventPlannerPromotionCities = $this->EventPlannerPromotions->EventPlannerPromotionCities->newEntity();
					$eventPlannerPromotionCities->state_id = $city;
					$eventPlannerPromotion->event_planner_promotion_cities[$x]=$eventPlannerPromotionCities;
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
		if(@$submitted_from=='web'){
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
	
	public function getEventPlanners($isLikedUserId = null,$country_id=null,$country_id_short = null,$state_id=null,$state_id_short=null,$city_id=null,$city_id_short=null,$higestSort=null,$search=null,$page=null)
	{
		$isLikedUserId = $this->request->query('isLikedUserId');
		if(!empty($isLikedUserId))
		{
			$limit=10;
			$country_id = $this->request->query('country_id');
			$country_id_short = $this->request->query('country_id_short');
			$state_id = $this->request->query('state_id');
			$state_id_short = $this->request->query('state_id_short');
			$city_id_short = $this->request->query('city_id_short');
			$city_id = $this->request->query('city_id');
			$higestSort = $this->request->query('higestSort');
			$search_bar = $this->request->query('search');
			$page = $this->request->query('page');
			if(empty($page)){$page=1;}
			if(!empty($country_id))
			{
				$country_id = ['EventPlannerPromotions.country_id'=>$country_id];
			}else
			{
				$country_id = null;
			}
			$state_filter = null;
			
			if(!empty($state_id))
			{
				$state_id = explode(',',$state_id);
				$state_filter = ['EventPlannerPromotionStates.state_id IN'=>$state_id];
			}else
			{
				$state_filter = null;
			}
			$city_filter = null;
			
			if(!empty($city_id))
			{
				$city_id = explode(',',$city_id);
				$city_filter = ['EventPlannerPromotionCities.city_id IN'=>$city_id];
			}else
			{
				$city_filter = null;
			}
			
			$where_short = ['EventPlannerPromotions.id' =>'DESC'];
			if(!empty($country_id_short))
			{
				$where_short = ['EventPlannerPromotions.country_id' =>$country_id_short];
			} 	
			
			
			if(!empty($state_id_short))
			{
				$where_short = ['EventPlannerPromotionStates.id' =>$state_id_short];
			}
			
			if(!empty($city_id_short))
			{
				$where_short = ['EventPlannerPromotionCities.id' =>$city_id_short];
			} 	

			$search_bar_title = null;
			$data_arr = [];
			$data_arr_state=[];
			
			if(!empty($search_bar))
			{	
				$search_bar_city = $this->EventPlannerPromotions->EventPlannerPromotionCities->Cities
				->find()->select(['id'])->where(['name Like' =>'%'.$search_bar.'%']);
				if(!empty($search_bar_city)) 
				{ 
					$search_bar_city_data = $this->EventPlannerPromotions->EventPlannerPromotionCities->find()
					->select(['event_planner_promotion_id'])->where(['EventPlannerPromotionCities.city_id IN' =>$search_bar_city])->toArray();
					
					if(!empty($search_bar_city_data))
					{
						foreach($search_bar_city_data as $data)
						{
							$data_arr_state[] = $data->event_planner_promotion_id;
						}
					}
					
				}
				
				$search_bar_state = $this->EventPlannerPromotions->EventPlannerPromotionStates->States
				->find()->select(['id'])->where(['state_name Like' =>'%'.$search_bar.'%']);
				if(!empty($search_bar_state)) 
				{ 
					$search_bar_state_data = $this->EventPlannerPromotions->EventPlannerPromotionStates->find()
					->select(['event_planner_promotion_id'])->where(['EventPlannerPromotionStates.state_id IN' =>$search_bar_state])->toArray();
					
					if(!empty($search_bar_state_data))
					{
						foreach($search_bar_state_data as $data)
						{
							$data_arr[] = $data->event_planner_promotion_id;
						}
					}
					
				}	
				$search_bar_title = array_merge($data_arr,$data_arr_state);
				if(!empty($search_bar_title)){
				$search_bar_title = ['EventPlannerPromotions.id IN' =>$search_bar_title];
				}else
				{
					$search_bar_title = ['EventPlannerPromotions.id IN' =>''];
				}				
			}	
			
			$getEventPlanners = $this->EventPlannerPromotions->find();
			 
				$getEventPlanners->select(['total_likes'=>$getEventPlanners->func()->count('EventPlannerPromotionLikes.id')])
				->contain(['Users'=>function($q){
				return $q->select(['first_name','last_name','mobile_number','company_name','email']);
			},'PriceMasters','Countries','EventPlannerPromotionStates'=>['States'],'EventPlannerPromotionCities'=>['Cities']])
				->leftJoinWith('EventPlannerPromotionLikes')
				->innerJoinWith('EventPlannerPromotionStates',function($q) use($state_filter){ 
						return $q->where($state_filter);
					})
				->innerJoinWith('EventPlannerPromotionCities',function($q) use($city_filter){ 
						return $q->where($city_filter);
					})	
			->where(['visible_date >=' =>date('Y-m-d')])
			->where(['EventPlannerPromotions.is_deleted' =>0])
			->where($country_id)
			->order($where_short)
			->where($search_bar_title)
			->group(['EventPlannerPromotions.id'])
			->limit($limit)
			->page($page)
			->autoFields(true);
			//pr($where_short);exit;	
			if(!empty($getEventPlanners->toArray()))
			{
				foreach($getEventPlanners as $getEventPlanner)
				{
					
					$getEventPlanner->total_likes = $this->EventPlannerPromotions->EventPlannerPromotionLikes
                            ->find()->where(['event_planner_promotion_id' => $getEventPlanner->id])->count();
					
					$exists = $this->EventPlannerPromotions->EventPlannerPromotionLikes->exists(['event_planner_promotion_id'=>$getEventPlanner->id,'user_id'=>$isLikedUserId]);
					if($exists == 1)
					{ $getEventPlanner->isLiked = 'yes'; }
					else{ $getEventPlanner->isLiked = 'no'; }
					
					$carts = $this->EventPlannerPromotions->EventPlannerPromotionCarts->exists(['EventPlannerPromotionCarts.event_planner_promotion_id'=>$getEventPlanner->id,'EventPlannerPromotionCarts.user_id'=>$isLikedUserId,'EventPlannerPromotionCarts.is_deleted'=>0]);
					if($carts==0){
						$getEventPlanner->issaved=false;
					}else{
						$getEventPlanner->issaved=true;
					}	
					
					$getEventPlanner->total_views = $this->EventPlannerPromotions->EventPlannerPromotionViews
						->find()->where(['event_planner_promotion_id' => $getEventPlanner->id])->count();
						
					$all_raiting=0;	
					$testimonial=$this->EventPlannerPromotions->Users->Testimonial->find()->where(['Testimonial.user_id'=>$getEventPlanner->user_id]);
					$testimonial_count=$this->EventPlannerPromotions->Users->Testimonial->find()->where(['Testimonial.user_id'=>$getEventPlanner->user_id])->count();
						 
						 foreach($testimonial as $test_data){
							 $rating=$test_data->rating;
							 $all_raiting+=$rating;
						 }
						 if($testimonial_count>0){
							 $final_raiting=($all_raiting/$testimonial_count);
							 if($final_raiting>0){
								$getEventPlanner->user_rating=number_format($final_raiting, 1);
							 }else{
								$getEventPlanner->user_rating="0";
							 }	
						 }else{
							$getEventPlanner->user_rating="0";
						 }	 
				}
				if(!empty($higestSort))
				{
					if($higestSort == 'total_likes')
					{
						$getEventPlanners = $getEventPlanners->toArray();
						usort($getEventPlanners, function ($a, $b) {
							return $b['total_likes'] - $a['total_likes'];
						});
					}
					else if($higestSort == 'total_views')
					{
						$getEventPlanners = $getEventPlanners->toArray();
						usort($getEventPlanners, function ($a, $b) {
							return $b['total_views'] - $a['total_views'];
						});					
					}
					else if($higestSort == 'user_rating')
					{
						$getEventPlanners = $getEventPlanners->toArray();
						usort($getEventPlanners, function ($a, $b) {
							return $b['user_rating'] - $a['user_rating'];
						});					
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
			
			$carts = $this->EventPlannerPromotions->EventPlannerPromotionCarts->exists(['EventPlannerPromotionCarts.event_planner_promotion_id'=>$id,'EventPlannerPromotionCarts.user_id'=>$user_id,'EventPlannerPromotionCarts.is_deleted'=>0]);
			foreach($getEventPlannersDetails as $sfad){
			if($carts==0){
				
					$sfad->issaved=false;
				 
				
			}else{
				 	$sfad->issaved=true;
				 
			}
			
			$all_raiting=0;	
					$testimonial=$this->EventPlannerPromotions->Users->Testimonial->find()->where(['Testimonial.user_id'=>$sfad->user_id]);
					$testimonial_count=$this->EventPlannerPromotions->Users->Testimonial->find()->where(['Testimonial.user_id'=>$sfad->user_id])->count();
						 
						 foreach($testimonial as $test_data){
							 
							 $rating=$test_data->rating;
							 $all_raiting+=$rating;
						 }
						 if($testimonial_count>0){
							 $final_raiting=($all_raiting/$testimonial_count);
							 foreach($getEventPlannersDetails as $rat){
								 if($final_raiting>0){
									$rat->user_rating=number_format($final_raiting, 1);
								 }else{
									$rat->user_rating="0";
								 }
							 }	
						 }else{
							 foreach($getEventPlannersDetails as $rat){
								$rat->user_rating=0;
							 }	
							 
					}	 }
						 
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
			
			foreach($getEventPlannersDetails as $vew){
					$vew->total_views = $this->EventPlannerPromotions->EventPlannerPromotionViews
							->find()->where(['event_planner_promotion_id' => $id])->count();

					$exists = $this->EventPlannerPromotions->EventPlannerPromotionLikes->exists(['event_planner_promotion_id'=>$vew->id,'user_id'=>$user_id]);
					if($exists == 1)
					{ $vew->isLiked = 'yes'; }
					else{ $vew->isLiked = 'no'; }							
							
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

	
	public function EventPlannerViews($event_planner_promotion_id=null,$page=null,$user_id=null,$search=null)
	{
		$event_planner_promotion_id = $this->request->query('event_planner_promotion_id');
		$user_id = $this->request->query('user_id');
		$search_bar = $this->request->query('search');
		$page = $this->request->query('page');
		$filter_search=array();
		if(!empty($search_bar)){
			$filter_search["OR"] = array("Users.first_name Like"=> '%'.$search_bar.'%',"Users.last_name Like"=> '%'.$search_bar.'%',"Users.company_name Like"=> '%'.$search_bar.'%');
 		}
		$limit=10;
		if(empty($page)){$page=1;}
		$COunt = $this->EventPlannerPromotions->EventPlannerPromotionViews->find()->where(['event_planner_promotion_id'=>$event_planner_promotion_id])->count();
		if($COunt>0)
		{
			$getTravelPackages = $this->EventPlannerPromotions->EventPlannerPromotionViews->find()
				->contain(['Users'=>function($q)use($filter_search){
					return $q->select(['first_name','last_name','mobile_number','company_name','role_id'])->where($filter_search);
				}])
				->where(['event_planner_promotion_id'=>$event_planner_promotion_id])
				->limit($limit)
				->page($page);
			foreach($getTravelPackages as $packages){
				$Follow = $this->EventPlannerPromotions->EventPlannerPromotionViews->Users->BusinessBuddies->exists(['user_id'=>$user_id,'bb_user_id'=>$packages->user_id]);  
				if($Follow==0){
					$packages->isfollow=false;
				}else{
					$packages->isfollow=true;
				}
 			}
			$response_object = $getTravelPackages;
			$response_code = 200;
			$message = '';
		}
		else{
			$response_object = array();
			$response_code = 204;
			$message = 'No data found';
		}
			
		$this->set(compact('message','response_code','response_object'));
        $this->set('_serialize', ['message','response_code','response_object']);		
		
	}
	
	public function EventPlannerLikes($event_planner_promotion_id=null,$page=null,$user_id=null,$search=null)
	{
		$event_planner_promotion_id = $this->request->query('event_planner_promotion_id');
		$user_id = $this->request->query('user_id');
		$search_bar = $this->request->query('search');
		$page = $this->request->query('page');
		$filter_search=array();
		if(!empty($search_bar)){
			$filter_search["OR"] = array("Users.first_name Like"=> '%'.$search_bar.'%',"Users.last_name Like"=> '%'.$search_bar.'%',"Users.company_name Like"=> '%'.$search_bar.'%');
 		}
		$limit=10;
		if(empty($page)){$page=1;}
		$COunt = $this->EventPlannerPromotions->EventPlannerPromotionLikes->find()->where(['event_planner_promotion_id'=>$event_planner_promotion_id])->count();
		if($COunt>0)
		{
			$getTravelPackages = $this->EventPlannerPromotions->EventPlannerPromotionLikes->find()
				->contain(['Users'=>function($q)use($filter_search){
					return $q->select(['first_name','last_name','mobile_number','company_name','role_id'])->where($filter_search);
				}])
				->where(['event_planner_promotion_id'=>$event_planner_promotion_id])
				->limit($limit)
				->page($page);
			foreach($getTravelPackages as $packages){
				$Follow = $this->EventPlannerPromotions->EventPlannerPromotionLikes->Users->BusinessBuddies->exists(['user_id'=>$user_id,'bb_user_id'=>$packages->user_id]);  
				if($Follow==0){
					$packages->isfollow=false;
				}else{
					$packages->isfollow=true;
				}
 			}
			$response_object = $getTravelPackages;
			$response_code = 200;
			$message = '';
		}
		else{
			$response_object = array();
			$response_code = 204;
			$message = 'No data found';
		}
			
		$this->set(compact('message','response_code','response_object'));
        $this->set('_serialize', ['message','response_code','response_object']);		
		
	}
	
}
