<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

class TaxiFleetPromotionsController extends AppController
{

   public function add()
    {
        $taxiFleetPromotion = $this->TaxiFleetPromotions->newEntity();
        if ($this->request->is('post')) {
            $taxiFleetPromotion = $this->TaxiFleetPromotions->patchEntity($taxiFleetPromotion, $this->request->data(), [
			'associated' => ['TaxiFleetPromotionRows','TaxiFleetPromotionStates','TaxiFleetPromotionCities']]);

			$message = 'PERFECT';
			$response_code = 101;

			$id = $taxiFleetPromotion->user_id;
			$title = $taxiFleetPromotion->title;
			$image = $this->request->data('image');	
			$document = $this->request->data('document');
			$submitted_from = @$this->request->data('submitted_from');
			if(@$submitted_from=='web')
			{
				$taxiFleetPromotion->submitted_from=1;
				$state_id=$this->request->data['state_id'];
				$x=0; 
				$taxiFleetPromotion->taxi_fleet_promotion_states = [];
				$taxiFleetPromotion->taxi_fleet_promotion_cities = [];
				$taxiFleetPromotion->taxi_fleet_promotion_rows = [];
				foreach($state_id as $state)
				{
                    $taxiFleetPromotion_state = $this->TaxiFleetPromotions->TaxiFleetPromotionStates->newEntity();
					
					$taxiFleetPromotion_state->state_id = $state;
					
					$taxiFleetPromotion->taxi_fleet_promotion_states[$x]=$taxiFleetPromotion_state;
					$x++;	
 
				} 
				$city_id=$this->request->data['city_id'];
				 
				$y=0; 
				foreach($city_id as $city)
				{
					$taxiFleetPromotion_cities = $this->TaxiFleetPromotions->TaxiFleetPromotionCities->newEntity();
					$taxiFleetPromotion_cities->city_id = $city;
					$taxiFleetPromotion->taxi_fleet_promotion_cities[$y]=$taxiFleetPromotion_cities;
					$y++;	
				}
				 
				$vehicle_type=$this->request->data['vehicle_type'];
				$z=0; 
				foreach($vehicle_type as $vehicle)
				{
					$taxiFleetPromotion_row = $this->TaxiFleetPromotions->TaxiFleetPromotionRows->newEntity();$taxiFleetPromotion_row->taxi_fleet_car_bus_id = $vehicle;
					$taxiFleetPromotion->taxi_fleet_promotion_rows[$z]=$taxiFleetPromotion_row;					
					$z++;	
				}
			}
			if(!empty($this->request->data('visible_date')))
			{
				$taxiFleetPromotion->visible_date = date('Y-m-d',strtotime($this->request->data('visible_date')));
			}
			if(!empty($image))
			{	
				$dir = new Folder(WWW_ROOT . 'images/taxiFleetPromotion/'.$id.'/'.$title.'/image', true, 0755);
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
						/* Resize Image */
						$destination_url = WWW_ROOT . '/images/taxiFleetPromotion/'.$id.'/'.$title.'/image/'.$id.'.'.$ext;
						if($ext=='png'){
							$image = imagecreatefrompng($image['tmp_name']);
						}else{
							$image = imagecreatefromjpeg($image['tmp_name']); 
						}
						imagejpeg($image, $destination_url, $percentageTOReduse);
						$taxiFleetPromotion->image='images/taxiFleetPromotion/'.$id.'/'.$title.'/image/'.$id.'.'.$ext;
						if(file_exists(WWW_ROOT . '/images/taxiFleetPromotion/'.$id.'/'.$title.'/image/'.$id.'.'.$ext)>0) {
						}
						else
						{
							$message = 'Image not uploaded';
							$this->Flash->error(__($message));
							$response_code = 102;
						}
						/*if(move_uploaded_file($image['tmp_name'], WWW_ROOT . '/images/taxiFleetPromotion/'.$id.'/'.$title.'/image/'.$id.'.'.$ext)) {
							$taxiFleetPromotion->image='images/taxiFleetPromotion/'.$id.'/'.$title.'/image/'.$id.'.'.$ext;
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
			} else { $taxiFleetPromotion->image ='';  }	

			if(!empty($document))
			{  
				$dir = new Folder(WWW_ROOT . 'images/taxiFleetPromotion/'.$id.'/'.$title.'/document', true, 0755);
				$ext = substr(strtolower(strrchr($document['name'], '.')), 1); 
				$arr_ext = array('jpg', 'jpeg','png','pdf'); 				
				if(!empty($ext))
				{
					if (in_array($ext, $arr_ext)) {
						if (!file_exists('path/to/directory')) {
								mkdir('path/to/directory', 0777, true);
							}
						if(move_uploaded_file($document['tmp_name'], WWW_ROOT . '/images/taxiFleetPromotion/'.$id.'/'.$title.'/document/'.$id.'.'.$ext)) {
							$taxiFleetPromotion->document='images/taxiFleetPromotion/'.$id.'/'.$title.'/document/'.$id.'.'.$ext;
						} else {
							$message = 'Document not uploaded';
							$this->Flash->error(__($message)); 
							$response_code = 104;
							
						}
					} 
					else 
					{ 	
						$message = 'Invalid document extension';
						$this->Flash->error(__($message)); 
						$response_code = 105;  
						
					}					
				}
				else 
				{ 	
					$message = 'Invalid document extension';
					$this->Flash->error(__($message)); 
					$response_code = 105;  
					
				}				
			} else { $taxiFleetPromotion->document = ''; }			
			
			if($message == 'PERFECT' && $response_code == 101)
			{
				if ($this->TaxiFleetPromotions->save($taxiFleetPromotion)) {
					$message = 'The Taxi/Fleet promotions has been saved';
					$this->Flash->success(__($message)); 
					$response_code = 200;
				}else{
					$message = 'The Taxi/Fleet promotions has not been saved';
					$this->Flash->error(__($message)); 
					$response_code = 204; 
				}
			}			
        }
 
		if(@$submitted_from=='web'){
			return $this->redirect($this->coreVariable['SiteUrl'].'TaxiFleetPromotions/report');
		}		
		$this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);
    }

	public function likeTaxiFleetPromotions()
	{
        $likeTaxiFleetPromotions = $this->TaxiFleetPromotions->TaxiFleetPromotionLikes->newEntity();
        if ($this->request->is('post')) {
           
			$likeTaxiFleetPromotions = $this->TaxiFleetPromotions->TaxiFleetPromotionLikes->patchEntity($likeTaxiFleetPromotions, $this->request->data);		
			
			$exists = $this->TaxiFleetPromotions->TaxiFleetPromotionLikes->exists(['taxi_fleet_promotion_id'=>$likeTaxiFleetPromotions->taxi_fleet_promotion_id,'user_id'=>$likeTaxiFleetPromotions->user_id]);
			
			if($exists == 0)
			{
				if ($this->TaxiFleetPromotions->TaxiFleetPromotionLikes->save($likeTaxiFleetPromotions)) {
					$message = 'Liked successfully';
					$response_code = 200;
				}else{
					$message = 'Like not saved';
					$response_code = 204;				
				}				
			}
			else
			{
				$this->TaxiFleetPromotions->TaxiFleetPromotionLikes->deleteAll(['taxi_fleet_promotion_id'=>$likeTaxiFleetPromotions->taxi_fleet_promotion_id,'user_id'=>$likeTaxiFleetPromotions->user_id]);
					
				$message = 'Disliked';
				$response_code = 200;				
			}	

		}
		$this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);		
	}
	public function getTaxiFleetPromotions($isLikedUserId = null,$country_id=null,$country_id_short = null,$state_id=null,$state_id_short=null,$city_id=null,$city_id_short=null,$car_bus_id=null,$car_bus_short=null,$higestSort=null,$search=null,$page=null,$submitted_from=null,$following=null)
	{
		$submitted_from = $this->request->query('submitted_from');
		if($submitted_from="web")
		{
			$limit=100;
		}
		else{
			$limit=10;
		}
		$isLikedUserId = $this->request->query('isLikedUserId');
		$country_id_short = $this->request->query('country_id_short');		
		$country_id = $this->request->query('country_id');		
		$state_id = $this->request->query('state_id');
		$state_id_short = $this->request->query('state_id_short');
		$city_id_short = $this->request->query('city_id_short');
		$city_id = $this->request->query('city_id');
		$higestSort = $this->request->query('higestSort');
		$car_bus_short = $this->request->query('car_bus_short');
		$car_bus_id = $this->request->query('car_bus_id');	
		$search_bar = $this->request->query('search');		
		$page = $this->request->query('page');		
		$following = $this->request->query('following');		
		if(empty($page)){$page=1;}
		if(!empty($isLikedUserId))
		{
			if(!empty($country_id))
			{
				$country_id = ['TaxiFleetPromotions.country_id'=>$country_id];
			}else
			{
				$country_id = null;
			}
			
			if(!empty($state_id))
			{
				$state_id = explode(',',$state_id);
				$state_filter = ['TaxiFleetPromotionStates.state_id IN'=>$state_id];
			}else
			{
				$state_filter = null;
			}
			$city_filter = null;
			
			if(!empty($city_id))
			{
				$city_id = explode(',',$city_id);
				$city_filter = ['TaxiFleetPromotionCities.city_id IN'=>$city_id];
			}else
			{
				$city_filter = null;
			}			

			if(!empty($car_bus_id))
			{
				$car_bus_id = explode(',',$car_bus_id);
				$car_bus_filter = ['TaxiFleetPromotionRows.taxi_fleet_car_bus_id IN'=>$car_bus_id];
			}else
			{
				$car_bus_filter = null;
			}	

			//$where_short = ['TaxiFleetPromotions.position' =>'ASC'];
			$where_short=['TaxiFleetPromotions.position' =>'ASC','TaxiFleetPromotions.id' =>'DESC'];
			if(!empty($country_id_short))
			{
				$where_short = ['TaxiFleetPromotions.country_id' =>$country_id_short];
			} 			
			
			if(!empty($state_id_short))
			{
				$where_short = ['TaxiFleetPromotionsStates.id' =>$state_id_short];
			} 
			if(!empty($city_id_short))
			{
				$where_short = ['TaxiFleetPromotionCities.id' =>$city_id_short];
			} 
			if(!empty($car_bus_short))
			{
				$where_short = ['TaxiFleetPromotionRows.id' =>$car_bus_short];
			} 
			$conditions=array()	;	
			if(!empty($following))
			{
  				$this->loadModel('BusinessBuddies');
				$BusinessBuddies = $this->BusinessBuddies->find('list',['keyField' => "bb_user_id",'valueField' => 'bb_user_id'])->where(['user_id' => $isLikedUserId])->toArray();
				$conditions = ['TaxiFleetPromotions.user_id IN' => $BusinessBuddies];
			}

			$search_bar_title = null;
			$data_arr = [];
			$data_arr_state=[];
			$data_arr_title = [];
			if(!empty($search_bar))
			{	
				$search_bar_title = $this->TaxiFleetPromotions->find()
						->select(['id'])
						->where(['title Like' =>'%'.$search_bar.'%'])
						->toArray();
		
				if(!empty($search_bar_title)) 
				{
					foreach($search_bar_title as $data_bar)
					{
						$data_arr_title[] = $data_bar->id;
					}					
				}

				
				$search_bar_city = $this->TaxiFleetPromotions->TaxiFleetPromotionCities->Cities
				->find()->select(['id'])->where(['name Like' =>'%'.$search_bar.'%']);
				if(!empty($search_bar_city)) 
				{ 
					$search_bar_city_data = $this->TaxiFleetPromotions->TaxiFleetPromotionCities->find()
					->select(['taxi_fleet_promotion_id'])->where(['TaxiFleetPromotionCities.city_id IN' =>$search_bar_city])->toArray();
					
					if(!empty($search_bar_city_data))
					{
						foreach($search_bar_city_data as $data)
						{
							$data_arr_state[] = $data->taxi_fleet_promotion_id;
						}
					}
					
				}
				
				$search_bar_state = $this->TaxiFleetPromotions->TaxiFleetPromotionStates->States
				->find()->select(['id'])->where(['state_name Like' =>'%'.$search_bar.'%']);
				if(!empty($search_bar_state)) 
				{ 
					$search_bar_state_data = $this->TaxiFleetPromotions->TaxiFleetPromotionStates->find()
					->select(['taxi_fleet_promotion_id'])->where(['TaxiFleetPromotionStates.state_id IN' =>$search_bar_state])->toArray();
					
					if(!empty($search_bar_state_data))
					{
						foreach($search_bar_state_data as $data)
						{
							$data_arr[] = $data->taxi_fleet_promotion_id;
						}
					}
					
				}	
				$search_bar_title = array_merge($data_arr_title,$data_arr,$data_arr_state);
				if(!empty($search_bar_title)){
				$search_bar_title = ['TaxiFleetPromotions.id IN' =>$search_bar_title];
				}else
				{
					$search_bar_title = ['TaxiFleetPromotions.id IN' =>''];
				}				
			}


			//pr($search_bar_title);exit;
			
			$getTaxiFleetPromotions = $this->TaxiFleetPromotions->find();
			$getTaxiFleetPromotions->select(['total_likes'=>$getTaxiFleetPromotions->func()->count('TaxiFleetPromotionLikes.id')])
				->contain(['Users'=>function($q){
					return $q->select(['first_name','last_name','mobile_number','company_name','email']);
				}])
				->leftJoinWith('TaxiFleetPromotionLikes')
				
				->innerJoinWith('TaxiFleetPromotionStates',function($q) use($state_filter){ 
						return $q->where($state_filter);
					})
				->innerJoinWith('TaxiFleetPromotionCities',function($q) use($city_filter){ 
						return $q->where($city_filter);
					})
				->innerJoinWith('TaxiFleetPromotionRows',function($q) use($car_bus_filter){ 
						return $q->where($car_bus_filter);
					})					
				
				->contain(['Users','PriceMasters','Countries','TaxiFleetPromotionCities'=>['Cities'],'TaxiFleetPromotionRows'=>['TaxiFleetCarBuses'],'TaxiFleetPromotionStates'=>['States']])
					
				->where(['TaxiFleetPromotions.visible_date >=' =>date('Y-m-d')])
				->where($country_id)
				->where($search_bar_title)
				->where($conditions)
				->where(['TaxiFleetPromotions.is_deleted' =>0])
				->order($where_short)
				->group(['TaxiFleetPromotions.id'])
				->limit($limit)
				->page($page)
				->autoFields(true);
			//pr($getTravelPackages->toArray()); exit;
			if(!empty($getTaxiFleetPromotions->toArray()))
			{
				foreach($getTaxiFleetPromotions as $getTaxiFleetPromotion)
				{
					$getTaxiFleetPromotion->total_likes = $this->TaxiFleetPromotions->TaxiFleetPromotionLikes->find()->where(['taxi_fleet_promotion_id' => $getTaxiFleetPromotion->id])->count();	
							
					$exists = $this->TaxiFleetPromotions->TaxiFleetPromotionLikes->exists(['taxi_fleet_promotion_id'=>$getTaxiFleetPromotion->id,'user_id'=>$isLikedUserId]);
					
					if($exists == 1)
					{  $getTaxiFleetPromotion->isLiked = 'yes'; } 
					else { $getTaxiFleetPromotion->isLiked = 'no'; }	

					$carts = $this->TaxiFleetPromotions->TaxiFleetPromotionCarts->exists(['TaxiFleetPromotionCarts.taxi_fleet_promotion_id'=>$getTaxiFleetPromotion->id,'TaxiFleetPromotionCarts.user_id'=>$isLikedUserId,'TaxiFleetPromotionCarts.is_deleted'=>0]);
					if($carts==0){
						$getTaxiFleetPromotion->issaved=false;
					}else{
						$getTaxiFleetPromotion->issaved=true;
					}			
					
					$getTaxiFleetPromotion->total_views = $this->TaxiFleetPromotions->TaxiFleetPromotionViews
						->find()->where(['taxi_fleet_promotion_id' => $getTaxiFleetPromotion->id])->count();
					
					$getTaxiFleetPromotion->total_saved = $this->TaxiFleetPromotions->TaxiFleetPromotionCarts
						->find()->where(['taxi_fleet_promotion_id' => $getTaxiFleetPromotion->id])->count();
					
					$getTaxiFleetPromotion->total_flagged = $this->TaxiFleetPromotions->TaxiFleetPromotionReports
						->find()->where(['taxi_fleet_promotion_id' => $getTaxiFleetPromotion->id])->count();
					
					$all_raiting=0;	
					$testimonial=$this->TaxiFleetPromotions->Users->Testimonial->find()->where(['Testimonial.user_id'=>$getTaxiFleetPromotion->user_id]);
					$testimonial_count=$this->TaxiFleetPromotions->Users->Testimonial->find()->where(['Testimonial.user_id'=>$getTaxiFleetPromotion->user_id])->count();
						 
						 foreach($testimonial as $test_data){
							 $rating=$test_data->rating;
							 $all_raiting+=$rating;
						 }
						 if($testimonial_count>0){
							 $final_raiting=($all_raiting/$testimonial_count);
							 if($final_raiting>0){
								$getTaxiFleetPromotion->user_rating=number_format($final_raiting, 1);
							 }else{
								$getTaxiFleetPromotion->user_rating="0";
							 }	
						 }else{
							$getTaxiFleetPromotion->user_rating="0";
						 }	 
					 
				}

				if(!empty($higestSort))
				{
					if($higestSort == 'total_likes')
					{
						$getTaxiFleetPromotions = $getTaxiFleetPromotions->toArray();
						usort($getTaxiFleetPromotions, function ($a, $b) {
							return $b['total_likes'] - $a['total_likes'];
						});
					}
					else if($higestSort == 'total_views')
					{
						$getTaxiFleetPromotions = $getTaxiFleetPromotions->toArray();
						usort($getTaxiFleetPromotions, function ($a, $b) {
							return $b['total_views'] - $a['total_views'];
						});					
					}
					else if($higestSort == 'user_rating')
					{
						$getTaxiFleetPromotions = $getTaxiFleetPromotions->toArray();
						usort($getTaxiFleetPromotions, function ($a, $b) {
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
				$getTaxiFleetPromotions = [];
				$response_code = 204;			
			}			
		}
		else
		{
			$message = 'isLikedUserId is empty';
			$getTaxiFleetPromotions = [];
			$response_code = 204;		
		}
		
		$this->set(compact('getTaxiFleetPromotions','message','response_code'));
        $this->set('_serialize', ['getTaxiFleetPromotions','message','response_code']);		
	}
	
	public function getTaxiFleetPromotionsDetails($id = null,$user_id = null)
	{
		$id = $this->request->query('id');
		$user_id = $this->request->query('user_id');
		$getTaxiFleetPromotionsDetails = $this->TaxiFleetPromotions->find();
		$getTaxiFleetPromotionsDetails->select(['total_likes'=>$getTaxiFleetPromotionsDetails->func()->count('TaxiFleetPromotionLikes.id')])
			->leftJoinWith('TaxiFleetPromotionLikes')
			->contain(['Users'=>['Cities','States','Countries'],'PriceMasters','Countries','TaxiFleetPromotionStates'=>['States'],'TaxiFleetPromotionCities'=>['Cities'],'TaxiFleetPromotionRows'=>['TaxiFleetCarBuses']])
			->where(['TaxiFleetPromotions.id'=>$id])
			->group(['TaxiFleetPromotions.id'])
		->autoFields(true);
		//pr($getTaxiFleetPromotionsDetails->toArray()); exit;
		if(!empty($getTaxiFleetPromotionsDetails->toArray()))
		{
			$viewTaxiFleetPromotions = $this->TaxiFleetPromotions->TaxiFleetPromotionViews->newEntity();
  			$viewTaxiFleetPromotions->taxi_fleet_promotion_id = $id;
			$viewTaxiFleetPromotions->user_id = $user_id;  			
			$exists = $this->TaxiFleetPromotions->TaxiFleetPromotionViews->exists(['taxi_fleet_promotion_id'=>$viewTaxiFleetPromotions->taxi_fleet_promotion_id,'user_id'=>$viewTaxiFleetPromotions->user_id]);
			
			$carts = $this->TaxiFleetPromotions->TaxiFleetPromotionCarts->exists(['TaxiFleetPromotionCarts.taxi_fleet_promotion_id'=>$id,'TaxiFleetPromotionCarts.user_id'=>$user_id,'TaxiFleetPromotionCarts.is_deleted'=>0]);
			foreach($getTaxiFleetPromotionsDetails as $sfad){
			if($carts==0){
				
					$sfad->issaved=false;
				 
			}else{ 
					$sfad->issaved=true;
				 
			}
			
			$all_raiting=0;	
					$testimonial=$this->TaxiFleetPromotions->Users->Testimonial->find()->where(['Testimonial.user_id'=>$sfad->user_id]);
					$testimonial_count=$this->TaxiFleetPromotions->Users->Testimonial->find()->where(['Testimonial.user_id'=>$sfad->user_id])->count();
						 
						 foreach($testimonial as $test_data){
							 
							 $rating=$test_data->rating;
							 $all_raiting+=$rating;
						 }
						 if($testimonial_count>0){
							 $final_raiting=($all_raiting/$testimonial_count);
							 foreach($getTaxiFleetPromotionsDetails as $rat){
								 if($final_raiting>0){
									$rat->user_rating=number_format($final_raiting, 1);
								 }else{
									$rat->user_rating="0";
								 }
							 }	
						 }else{
							 foreach($getTaxiFleetPromotionsDetails as $rat){
								$rat->user_rating=0;
							 }	
							 
						 }
			}			 
			if($exists == 0)
			{
				if ($this->TaxiFleetPromotions->TaxiFleetPromotionViews->save($viewTaxiFleetPromotions)) {
					$message = 'Data found and view increased by 1';
					$response_code = 200;
				}else{
				//	pr($viewTaxiFleetPromotions); exit;
					$message = 'Data found but view not increased';
					$response_code = 204;				
				}				
			}
			else
			{
					$message = 'Data found but viewed already';
					$response_code = 205;					
			}
				foreach($getTaxiFleetPromotionsDetails as $vew){
					$vew->total_views = $this->TaxiFleetPromotions->TaxiFleetPromotionViews
							->find()->where(['taxi_fleet_promotion_id' => $id])->count();
							
					$vew->total_flagged = $this->TaxiFleetPromotions->TaxiFleetPromotionReports
							->find()->where(['taxi_fleet_promotion_id' => $id])->count();
							
					$vew->total_saved = $this->TaxiFleetPromotions->TaxiFleetPromotionCarts
							->find()->where(['taxi_fleet_promotion_id' => $id])->count();

					$exists = $this->TaxiFleetPromotions->TaxiFleetPromotionLikes->exists(['taxi_fleet_promotion_id'=>$vew->id,'user_id'=>$user_id]);
					
					if($exists != 0)
					{  $vew->isLiked = 'yes'; } 
					else { $vew->isLiked = 'no'; }							
							
				}
		}
		else
		{
			$message = 'No Content Found';
			$getTaxiFleetPromotionsDetails = [];
			$response_code = 204;			
		}
		
		$this->set(compact('getTaxiFleetPromotionsDetails','message','response_code'));
        $this->set('_serialize', ['getTaxiFleetPromotionsDetails','message','response_code']);		
	}
	
	public function removeTaxFlletPromotions($taxi_id = null)
	{
		$taxi_id = $this->request->query('taxi_id');
		if(!empty($taxi_id))
		{
			$query = $this->TaxiFleetPromotions->query();
			$query->update()->set(['is_deleted' => 1])
			->where(['id' => $taxi_id])->execute();			
			$message = 'The Taxi/Fleet Promotions has been deleted successfully';
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

	public function getTaxiFleetPromotionReport($user_id = null)
	{
		$user_id = $this->request->query('user_id');
		if(!empty($user_id))
		{
			$getTaxifleets = $this->TaxiFleetPromotions->find()
			->where(['is_deleted' =>0])
			->where(['user_id'=>$user_id])
			->group(['TaxiFleetPromotions.id'])
			->autoFields(true);
	
			if(!empty($getTaxifleets->toArray()))
			{
				foreach($getTaxifleets as $getTaxifleet)
				{
					$getTaxifleet->total_likes = $this->TaxiFleetPromotions->TaxiFleetPromotionLikes
							->find()->where(['taxi_fleet_promotion_id' => $getTaxifleet->id])->count();

					$getTaxifleet->total_views = $this->TaxiFleetPromotions->TaxiFleetPromotionViews
							->find()->where(['taxi_fleet_promotion_id' => $getTaxifleet->id])->count();
					
					if($getTaxifleet->visible_date >= date('Y-m-d'))
					{
						$getTaxifleet->expir_status = 'valid';	
					}else
					{
						$getTaxifleet->expir_status = 'expired';		
					}
					
					
				}
				$message = 'List Found Successfully';
				$response_code = 200;
			}
			else
			{
				$message = 'No Content Found';
				$getTaxifleets = [];
				$response_code = 204;			
			}			
		}else {
				$message = 'Please Enter User ID ';
				$getTaxifleets = [];
				$response_code = 205;			
		}

		
		$this->set(compact('getTaxifleets','message','response_code'));
        $this->set('_serialize', ['getTaxifleets','message','response_code']);				
	}		
	
	public function renewTaxiFleet($taxifleet_id = null,$price_master_id=null,$price=null,$visible_date=null)
	{
		$taxifleet_id = $this->request->query('taxifleet_id');
		$price_master_id = $this->request->query('price_master_id');
		$price = $this->request->query('price');
		$visible_date = $this->request->query('visible_date');
		if(!empty($taxifleet_id) && !empty($price_master_id) && !empty($price) && !empty($visible_date))
		{
		$getTaxiFleetPromotions = $this->TaxiFleetPromotions->find()->where(['id'=>$taxifleet_id]);
			if(!empty($getTaxiFleetPromotions->toArray()))
			{
				foreach($getTaxiFleetPromotions as $getTaxiFleetPromotion)
				{
					$PriceBeforeRenews = $this->TaxiFleetPromotions->TaxiFleetPromotionPriceBeforeRenews->newEntity();
					
					$PriceBeforeRenews->taxi_fleet_promotion_id = $getTaxiFleetPromotion->id;
					$PriceBeforeRenews->price_master_id = $getTaxiFleetPromotion->price_master_id;
					$PriceBeforeRenews->price = $getTaxiFleetPromotion->price;
					$PriceBeforeRenews->visible_date = $getTaxiFleetPromotion->visible_date;
					
					if ($this->TaxiFleetPromotions->TaxiFleetPromotionPriceBeforeRenews->save($PriceBeforeRenews))
					{
						$query = $this->TaxiFleetPromotions->query();
						$query->update()->set(['price_master_id' => $price_master_id,'price'=>$price,'visible_date'=>date('Y-m-d',strtotime($visible_date)),'notified'=>0])
						->where(['id' => $taxifleet_id])->execute();			
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
	
	public function TexiPromotionViews($texifleet_promotion_id=null,$page=null,$user_id=null,$search=null)
	{
		$texifleet_promotion_id = $this->request->query('texifleet_promotion_id');
		$user_id = $this->request->query('user_id');
		$search_bar = $this->request->query('search');
		$page = $this->request->query('page');
		$filter_search=array();
		if(!empty($search_bar)){
			$filter_search["OR"] = array("Users.first_name Like"=> '%'.$search_bar.'%',"Users.last_name Like"=> '%'.$search_bar.'%',"Users.company_name Like"=> '%'.$search_bar.'%');
 		}
		$limit=10;
		if(empty($page)){$page=1;}
		$COunt = $this->TaxiFleetPromotions->TaxiFleetPromotionViews->find()->where(['taxi_fleet_promotion_id'=>$texifleet_promotion_id])->count();
		if($COunt>0)
		{
			$getTravelPackages = $this->TaxiFleetPromotions->TaxiFleetPromotionViews->find()
				->contain(['Users'=>function($q)use($filter_search){
					return $q->select(['first_name','last_name','mobile_number','company_name','role_id'])->where($filter_search);
				}])
				->where(['taxi_fleet_promotion_id'=>$texifleet_promotion_id]);
				//->limit($limit)
				//->page($page);
			foreach($getTravelPackages as $packages){
				$Follow = $this->TaxiFleetPromotions->TaxiFleetPromotionViews->Users->BusinessBuddies->exists(['user_id'=>$user_id,'bb_user_id'=>$packages->user_id]);  
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
	
	public function TexiPromotionLikes($texifleet_promotion_id=null,$page=null,$user_id=null,$search=null)
	{
		$texifleet_promotion_id = $this->request->query('texifleet_promotion_id');
		$user_id = $this->request->query('user_id');
		$search_bar = $this->request->query('search');
		$page = $this->request->query('page');
		$filter_search=array();
		if(!empty($search_bar)){
			$filter_search["OR"] = array("Users.first_name Like"=> '%'.$search_bar.'%',"Users.last_name Like"=> '%'.$search_bar.'%',"Users.company_name Like"=> '%'.$search_bar.'%');
 		}
		$limit=10;
		if(empty($page)){$page=1;}
		$COunt = $this->TaxiFleetPromotions->TaxiFleetPromotionLikes->find()->where(['taxi_fleet_promotion_id'=>$texifleet_promotion_id])->count();
		if($COunt>0)
		{
			$getTravelPackages = $this->TaxiFleetPromotions->TaxiFleetPromotionLikes->find()
				->contain(['Users'=>function($q)use($filter_search){
					return $q->select(['first_name','last_name','mobile_number','company_name','role_id'])->where($filter_search);
				}])
				->where(['taxi_fleet_promotion_id'=>$texifleet_promotion_id]);
				//->limit($limit)
				//->page($page);
			foreach($getTravelPackages as $packages){
				$Follow = $this->TaxiFleetPromotions->TaxiFleetPromotionLikes->Users->BusinessBuddies->exists(['user_id'=>$user_id,'bb_user_id'=>$packages->user_id]);  
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
