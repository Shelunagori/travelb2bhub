<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
/**
 * HotelPromotions Controller
 *
 * @property \App\Model\Table\HotelPromotionsTable $HotelPromotions
 */
class HotelPromotionsController extends AppController
{

    public function add()
    {
        $hotelPromotions = $this->HotelPromotions->newEntity();
        if ($this->request->is('post')) {
            $hotelPromotions = $this->HotelPromotions->patchEntity($hotelPromotions,$this->request->data());

			$message = 'PERFECT';
			$response_code = 101;
			$id=$hotelPromotions->user_id;
			$title = $id.'hotel_'.rand();
			$image = $this->request->data('hotel_pic');	 
			$submitted_from = @$this->request->data('submitted_from');
			if(@$submitted_from=='web')
			{
				/*$state_id=$this->request->data['state_id'];
				$x=0;
				foreach($state_id as $state)
				{
					$hotelPromotions['event_planner_promotion_states['.$x.']["state_id"]']=$state_id[$x];
					$x++;
				}
				$city_id=$this->request->data['city_id'];
				$y=0;
				foreach($city_id as $city)
				{
					$hotelPromotions['event_planner_promotion_cities['.$y.']["city_id"]']=$city_id[$y];
					$y++;	
				}*/
				$hotelPromotions->payment_status = 'Pending';
			} 
			if(!empty($this->request->data('visible_date')))
			{
				$hotelPromotions->visible_date = date('Y-m-d',strtotime($this->request->data('visible_date')));
			}
			if(!empty($image))
			{	
				$dir = new Folder(WWW_ROOT . 'img/hotels/', true, 0755);
				$ext = substr(strtolower(strrchr($image['name'], '.')), 1); 
				$arr_ext = array('jpg', 'jpeg','png'); 				
				
				if(!empty($ext))
				{
					if(in_array($ext, $arr_ext)) { 
						if (!file_exists('path/to/directory')) {
								mkdir('path/to/directory', 0777, true);
						}
						$percentageTOReduse=100;
						if(@$submitted_from=='web')
						{
							if(($image['size']>3000000) &&($image['size']<=4000000)){
								$percentageTOReduse=50;
							}
							elseif(($image['size']>4000000) &&($image['size']<=6000000)){ 
								$percentageTOReduse=20;
							}
							elseif($image['size']>6000000){
								$percentageTOReduse=10;
							}
						}
						//pr($percentageTOReduse); exit;
						/* Resize Image */
						$destination_url = WWW_ROOT . '/img/hotels/'.$title.'.'.$ext;
						if($ext=='png'){
							$image = imagecreatefrompng($image['tmp_name']);
						}else{
							$image = imagecreatefromjpeg($image['tmp_name']); 
						}
						imagejpeg($image, $destination_url, $percentageTOReduse);
						$hotelPromotions->hotel_pic='img/hotels/'.$title.'.'.$ext;
						if(file_exists(WWW_ROOT . '/img/hotels/'.$title.'.'.$ext)>0) {
						}
						else
						{
							$message = 'Image not uploaded';
							$this->Flash->error(__($message));
							$response_code = 102;
						}
						/*
						if(move_uploaded_file($image['tmp_name'], WWW_ROOT . '/img/hotels/'.$title.'.'.$ext)) {
							$hotelPromotions->hotel_pic='img/hotels/'.$title.'.'.$ext;
						} else {
							$message = 'Image not uploaded';
							$this->Flash->error(__($message)); 
							$response_code = 102;
						}*/
					} 
					else 
					{ 
						$message = 'Invalid image extension';
						$this->Flash->error(__($message)); 
						$response_code = 103;  
					}					
				}
				else 
				{ 	
					$message = 'Invalid image extension';
					$this->Flash->error(__($message)); 
					$response_code = 103;  
				}				
			} else { $hotelPromotions->hotel_pic ='';  }	

			// print_r($hotelPromotions); exit;
			if($message == 'PERFECT' && $response_code == 101)
			{
				//pr($hotelPromotions); exit;
				if ($this->HotelPromotions->save($hotelPromotions)) {
					$message = 'The hotel promotions has been saved';
					$this->Flash->success(__($message)); 
					$response_code = 200;
				}else{
					$message = 'The hotel promotions has not been saved';
					$this->Flash->error(__($message)); 
					$response_code = 204;				
				}
			}			
        } 
		if(@$submitted_from=='web'){
			return $this->redirect($this->coreVariable['SiteUrl'].'HotelPromotions/report');
		}
		$this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);		
    }
	
	public function likeHotelPromotions()
	{
        $likeHotelPromotions = $this->HotelPromotions->HotelPromotionLikes->newEntity();
        if ($this->request->is('post')) {
           
			$likeHotelPromotions = $this->HotelPromotions->HotelPromotionLikes->patchEntity($likeHotelPromotions, $this->request->data);		
			
			$exists = $this->HotelPromotions->HotelPromotionLikes->exists(['hotel_promotion_id'=>$likeHotelPromotions->hotel_promotion_id,'user_id'=>$likeHotelPromotions->user_id]);
			
			if($exists == 0)
			{
				if ($this->HotelPromotions->HotelPromotionLikes->save($likeHotelPromotions)) {
					$message = 'Liked successfully';
					$response_code = 200;
				}else{
					$message = 'Like not saved';
					$response_code = 204;				
				}				
			}
			else
			{
				$this->HotelPromotions->HotelPromotionLikes->deleteAll(['hotel_promotion_id'=>$likeHotelPromotions->hotel_promotion_id,'user_id'=>$likeHotelPromotions->user_id]);
					
				$message = 'Disliked';
				$response_code = 200;						
			}	
		}
		$this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);		
	}
	
	public function removePromotion($event_id = null)
	{
		$event_id = $this->request->query('promotion_id');
		if(!empty($event_id))
		{
			$query = $this->HotelPromotions->query();
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

	public function getHotelReport($user_id = null)
	{
		$user_id = $this->request->query('user_id');
		if(!empty($user_id))
		{
			$getEventPlanners = $this->HotelPromotions->find()
			->where(['HotelPromotions.is_deleted' =>0])
			->where(['HotelPromotions.user_id'=>$user_id])
			->group(['HotelPromotions.id'])
			->autoFields(true);
	
			if(!empty($getEventPlanners->toArray()))
			{
				foreach($getEventPlanners as $getEventPlanner)
				{
					$getEventPlanner->total_likes = $this->HotelPromotions->HotelPromotionLikes
							->find()->where(['hotel_promotion_id' => $getEventPlanner->id])->count();

					$getEventPlanner->total_views = $this->HotelPromotions->HotelPromotionViews
							->find()->where(['hotel_promotion_id' => $getEventPlanner->id])->count();
					
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
$getHotelPromotion=$getEventPlanners ;
		
		$this->set(compact('getHotelPromotion','message','response_code'));
        $this->set('_serialize', ['getHotelPromotion','message','response_code']);				
	}	
	
	public function getHotelList($isLikedUserId = null,$category_id = null,$short=null,$rating_filter=null,$higestSort=null,$page=null,$search=null,$starting_price=null,$submitted_from=null)
	{
		$isLikedUserId = $this->request->query('isLikedUserId');
		$submitted_from = $this->request->query('submitted_from');
		if($submitted_from="web")
		{
			$limit=100;
		}
		else{
			$limit=10;
		}
		if(!empty($isLikedUserId))
		{
			$category_id = $this->request->query('category_id');
			$short = $this->request->query('short'); 
			$rating_filter = $this->request->query('rating_filter');
			$higestSort = $this->request->query('higestSort');
			$starting_price = $this->request->query('starting_price');
			$page = $this->request->query('page');
			$search_bar = $this->request->query('search');
			if(empty($page)){$page=1;}
			$category_id_filter = null;
			//-- Filter 
			if(!empty($search_bar))
			{
				$Searchbox = ['HotelPromotions.hotel_location LIKE'=> '%'.$search_bar.'%'];
			}
			if(!empty($category_id))
			{
				$category_id = explode(',',$category_id);
				$category_id_filter = ['HotelPromotions.hotel_category_id IN'=>$category_id];
			}
			else
			{
				$category_id_filter = null;
			}
			$rating_filter_filter = null;
			if(!empty($rating_filter))
			{
				$Ratings = explode(',',$rating_filter);
				$rating_filter_filter = ['HotelPromotions.hotel_rating IN'=>$Ratings];
			}
			//-- SHORTs
			$where_short=['HotelPromotions.id' =>'DESC'];
			if(!empty($short))
			{ 
				if($short=='cheap_tariff')
				{
					$where_short = ['HotelPromotions.cheap_tariff' =>'DESC'];
				}
			
				if($short=='hotel_rating')
				{
					$where_short = ['HotelPromotions.hotel_rating' =>'DESC'];
				}
			}
			$conditions=array();
			if(!empty($starting_price)) {
 				$result = explode("-", $starting_price); 
				$MinQuotePrice = $result[0];
				$MaxQuotePrice = $result[1];
				if($MaxQuotePrice=='100000'){ $MaxQuotePrice='1000000000';}
				$conditions["HotelPromotions.cheap_tariff >="] = $MinQuotePrice;
				$conditions["HotelPromotions.cheap_tariff <="] = $MaxQuotePrice;
			}
			
			$getHotelPromotion = $this->HotelPromotions->find();
			
				$getHotelPromotion->select(['total_likes'=>$getHotelPromotion->func()->count('HotelPromotionLikes.id')])
				->contain(['HotelCategories','Users'=>function($q){
				return $q->select(['first_name','last_name','mobile_number','company_name','email']);
			}])
			->leftJoinWith('HotelPromotionLikes')
			->where($category_id_filter)
			->where($Searchbox)
			->where($rating_filter_filter)
			->where($conditions)
			->where(['HotelPromotions.visible_date >=' =>date('Y-m-d')])
			->where(['HotelPromotions.is_deleted' =>0])
			->order($where_short)
			->group(['HotelPromotions.id'])
			->limit($limit)
			->page($page)
			->autoFields(true);
			 
			if(!empty($getHotelPromotion->toArray()))
			{
				foreach($getHotelPromotion as $getEventPlanner)
				{
					$getEventPlanner->total_likes = $this->HotelPromotions->HotelPromotionLikes
							->find()->where(['hotel_promotion_id' => $getEventPlanner->id])->count();	
					$exists = $this->HotelPromotions->HotelPromotionLikes->exists(['hotel_promotion_id'=>$getEventPlanner->id,'user_id'=>$isLikedUserId]);
					if($exists == 1)
					{ $getEventPlanner->isLiked = 'yes'; }
					else{ $getEventPlanner->isLiked = 'no'; }
					
					$carts = $this->HotelPromotions->HotelPromotionCarts->exists(['HotelPromotionCarts.hotel_promotion_id'=>$getEventPlanner->id,'HotelPromotionCarts.user_id'=>$isLikedUserId,'HotelPromotionCarts.is_deleted'=>0]);
					if($carts==0){
						$getEventPlanner->issaved=false;
					}else{
						$getEventPlanner->issaved=true;
					}	
					
					$getEventPlanner->total_views = $this->HotelPromotions->HotelPromotionViews
						->find()->where(['hotel_promotion_id' => $getEventPlanner->id])->count();
						
					$getEventPlanner->total_saved = $this->HotelPromotions->HotelPromotionCarts
						->find()->where(['hotel_promotion_id' => $getEventPlanner->id])->count();
						
					$getEventPlanner->total_flagged = $this->HotelPromotions->HotelPromotionReports
						->find()->where(['hotel_promotion_id' => $getEventPlanner->id])->count();

						
					$all_raiting=0;	
					$testimonial=$this->HotelPromotions->Users->Testimonial->find()->where(['Testimonial.user_id'=>$getEventPlanner->user_id]);
					$testimonial_count=$this->HotelPromotions->Users->Testimonial->find()->where(['Testimonial.user_id'=>$getEventPlanner->user_id])->count();
						 
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
						$getHotelPromotion = $getHotelPromotion->toArray();
						usort($getHotelPromotion, function ($a, $b) {
							return $b['total_likes'] - $a['total_likes'];
						});
					}
					else if($higestSort == 'total_views')
					{
						$getHotelPromotion = $getHotelPromotion->toArray();
						usort($getHotelPromotion, function ($a, $b) {
							return $b['total_views'] - $a['total_views'];
						});					
					}
					else if($higestSort == 'user_rating')
					{
						$getHotelPromotion = $getHotelPromotion->toArray();
						usort($getHotelPromotion, function ($a, $b) {
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
				$getHotelPromotion= [];
				$response_code = 204;			
			}			
		}
		else
		{
				$message = 'isLikedUserId is empty';
				$getHotelPromotion= [];
				$response_code = 204;				
		}

		
		$this->set(compact('getHotelPromotion','message','response_code'));
        $this->set('_serialize', ['getHotelPromotion','message','response_code']);		
	}

	public function getHotelDetails($id = null,$user_id = null)
	{
		$id = $this->request->query('id');
		$user_id = $this->request->query('user_id');
		$getEventPlannersDetails = $this->HotelPromotions->find();
		$getEventPlannersDetails->select(['total_likes'=>$getEventPlannersDetails->func()->count('HotelPromotionLikes.id')])
			->leftJoinWith('HotelPromotionLikes')
			->contain(['HotelCategories','Users','PriceMasters'])
			->where(['HotelPromotions.id'=>$id])
			->where(['HotelPromotions.is_deleted' =>0])
			->group(['HotelPromotions.id'])
		->autoFields(true);
		
		//pr($getEventPlannersDetails->toArray()); exit;
		
		if(!empty($getEventPlannersDetails->toArray()))
		{
			$viewHotelPromotions = $this->HotelPromotions->HotelPromotionViews->newEntity();
      
  			$viewHotelPromotions->hotel_promotion_id = $id;
			$viewHotelPromotions->user_id = $user_id;         
			
			
			$exists = $this->HotelPromotions->HotelPromotionViews->exists(['HotelPromotionViews.hotel_promotion_id'=>$id,'HotelPromotionViews.user_id'=>$user_id]);
			$count_view=$this->HotelPromotions->HotelPromotionViews->find()->where(['HotelPromotionViews.hotel_promotion_id'=>$id,'HotelPromotionViews.user_id'=>$user_id])->count();
			$carts = $this->HotelPromotions->HotelPromotionCarts->exists(['HotelPromotionCarts.hotel_promotion_id'=>$id,'HotelPromotionCarts.user_id'=>$user_id,'HotelPromotionCarts.is_deleted'=>0]);
			foreach($getEventPlannersDetails as $sfad){
				if($carts==0){
						$sfad->issaved=false;
				}else{
						$sfad->issaved=true;
				}
			 
				$exists = $this->HotelPromotions->HotelPromotionLikes->exists(['hotel_promotion_id'=>$sfad->id,'user_id'=>$user_id ]);
				if($exists == 1)
				{ $sfad->isLiked = 'yes'; }
				else{ $sfad->isLiked = 'no'; }
			 
			
			$all_raiting=0;	
					$testimonial=$this->HotelPromotions->Users->Testimonial->find()->where(['Testimonial.user_id'=>$sfad->user_id]);
					$testimonial_count=$this->HotelPromotions->Users->Testimonial->find()->where(['Testimonial.user_id'=>$sfad->user_id])->count();
						 
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
							 
						 }
				}		 
			if($count_view==0)
			{
				if ($this->HotelPromotions->HotelPromotionViews->save($viewHotelPromotions)) {
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
					$vew->total_views = $this->HotelPromotions->HotelPromotionViews
							->find()->where(['hotel_promotion_id' => $id])->count();
							
					$vew->total_flagged = $this->HotelPromotions->HotelPromotionReports
							->find()->where(['hotel_promotion_id' => $id])->count();
							
					$vew->total_saved = $this->HotelPromotions->HotelPromotionCarts
							->find()->where(['hotel_promotion_id' => $id])->count();
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

	public function renewHotelpromotion($event_id = null,$price_master_id=null,$price=null,$visible_date=null)
	{
		$event_id = $this->request->query('promotion_id');
		$price_master_id = $this->request->query('price_master_id');
		$price = $this->request->query('price');
		$visible_date = $this->request->query('visible_date');
		if(!empty($event_id) && !empty($price_master_id) && !empty($price) && !empty($visible_date))
		{
		$getHotelPromotions = $this->HotelPromotions->find()->where(['id'=>$event_id]);
			if(!empty($getHotelPromotions->toArray()))
			{
				foreach($getHotelPromotions as $getHotelPromotion)
				{
					$PriceBeforeRenews = $this->HotelPromotions->HotelPromotionPriceBeforeRenews->newEntity();
					
					$PriceBeforeRenews->hotel_promotion_id = $getHotelPromotion->id;
					$PriceBeforeRenews->price_master_id = $getHotelPromotion->price_master_id;
					$PriceBeforeRenews->price = $getHotelPromotion->total_charges;
					$PriceBeforeRenews->visible_date = $getHotelPromotion->visible_date;
					
					if ($this->HotelPromotions->HotelPromotionPriceBeforeRenews->save($PriceBeforeRenews))
					{
						$query = $this->HotelPromotions->query();
						$query->update()->set(['price_master_id' => $price_master_id,'total_charges'=>$price,'visible_date'=>date('Y-m-d',strtotime($visible_date))])
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

	public function checkCityStatus($user_id = null,$city_id = null){
		$city_id = $this->request->query('city_id');
		$user_id = $this->request->query('user_id');
		$visible_date=date('Y-m-d');
		
		$getEventPlannersDetails = $this->HotelPromotions->find()
		->where(['HotelPromotions.visible_date >='=>$visible_date])
		->where(['HotelPromotions.is_deleted' =>0])
		->where(['HotelPromotions.user_id' =>$user_id])->count();
		
		if($getEventPlannersDetails > 0){
			$getEventPlannersDetailsu = $this->HotelPromotions->find()
			 ->notMatching('HotelPromotionCities', function(\Cake\ORM\Query $q)use($city_id) {
				return $q->where(['HotelPromotionCities.city_id' => $city_id]);
			})
			->where(['HotelPromotions.visible_date >='=>$visible_date])
			->where(['HotelPromotions.is_deleted' =>0])
			->where(['HotelPromotions.user_id' =>$user_id])->count();
			if($getEventPlannersDetailsu==0)
			{
				$response_code = 200;
				$message = "Promotion is already running, please choose another city.";
			}
			else{
				$response_code = 204;
				$message='Success';
			}
		}
		else
		{
			$response_code = 204;
			$message='Success';
		}
	 
		$this->set(compact('response_code','message'));
        $this->set('_serialize', ['response_code','message']);		
		 
	}
	public function HotelPromotionsViews($hotel_promotion_id=null,$page=null,$user_id=null,$search=null)
	{
		$hotel_promotion_id = $this->request->query('hotel_promotion_id');
		$user_id = $this->request->query('user_id');
		$search_bar = $this->request->query('search');
		$page = $this->request->query('page');
		$filter_search=array();
		if(!empty($search_bar)){
			$filter_search["OR"] = array("Users.first_name Like"=> '%'.$search_bar.'%',"Users.last_name Like"=> '%'.$search_bar.'%',"Users.company_name Like"=> '%'.$search_bar.'%');
 		}
		$limit=10;
		if(empty($page)){$page=1;}
		$COunt = $this->HotelPromotions->HotelPromotionViews->find()->where(['hotel_promotion_id'=>$hotel_promotion_id])->count();
		if($COunt>0)
		{
			$getTravelPackages = $this->HotelPromotions->HotelPromotionViews->find()
				->contain(['Users'=>function($q)use($filter_search){
					return $q->select(['first_name','last_name','mobile_number','company_name','role_id'])->where($filter_search);
				}])
				->where(['hotel_promotion_id'=>$hotel_promotion_id])
				->limit($limit)
				->page($page);
			foreach($getTravelPackages as $packages){
				$Follow = $this->HotelPromotions->HotelPromotionViews->Users->BusinessBuddies->exists(['user_id'=>$user_id,'bb_user_id'=>$packages->user_id]);  
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
	
	public function HotelPromotionsLikes($hotel_promotion_id=null,$page=null,$user_id=null,$search=null)
	{
		$hotel_promotion_id = $this->request->query('hotel_promotion_id');
		$user_id = $this->request->query('user_id');
		$search_bar = $this->request->query('search');
		$page = $this->request->query('page');
		$filter_search=array();
		if(!empty($search_bar)){
			$filter_search["OR"] = array("Users.first_name Like"=> '%'.$search_bar.'%',"Users.last_name Like"=> '%'.$search_bar.'%',"Users.company_name Like"=> '%'.$search_bar.'%');
 		}
		$limit=10;
		if(empty($page)){$page=1;}
		$COunt = $this->HotelPromotions->HotelPromotionLikes->find()->where(['hotel_promotion_id'=>$hotel_promotion_id])->count();
		if($COunt>0)
		{
			$getTravelPackages = $this->HotelPromotions->HotelPromotionLikes->find()
				->contain(['Users'=>function($q)use($filter_search){
					return $q->select(['first_name','last_name','mobile_number','company_name','role_id'])->where($filter_search);
				}])
				->where(['hotel_promotion_id'=>$hotel_promotion_id])
				->limit($limit)
				->page($page);
			foreach($getTravelPackages as $packages){
				$Follow = $this->HotelPromotions->HotelPromotionLikes->Users->BusinessBuddies->exists(['user_id'=>$user_id,'bb_user_id'=>$packages->user_id]);  
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
