<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;
class PostTravlePackagesController extends AppController
{

    public function add()
    {
        $postTravlePackage = $this->PostTravlePackages->newEntity();
        if ($this->request->is('post')) {
           
			$postTravlePackage = $this->PostTravlePackages->patchEntity($postTravlePackage, $this->request->data(),[ 'associated' => ['PostTravlePackageRows','PostTravlePackageCountries', 'PostTravlePackageStates','PostTravlePackageCities'] ]);

			$message = 'PERFECT';
			$response_code = 101;
			
			$id=$postTravlePackage->user_id;
			$image = $this->request->data('image');	
			$title = $postTravlePackage->title;
			$document = $this->request->data('document');	
			if(!empty($this->request->data('visible_date')))
			{
				$postTravlePackage->visible_date = date('Y-m-d',strtotime($this->request->data('visible_date')));
			}
			if(!empty($this->request->data('valid_date')))
			{
				$postTravlePackage->valid_date = date('Y-m-d',strtotime($this->request->data('valid_date')));
			}
			
			if(!empty($image))
			{	
				$dir = new Folder(WWW_ROOT . 'images/PostTravelPackages/'.$id.'/'.$title.'/image', true, 0755);
				$ext = substr(strtolower(strrchr($image['name'], '.')), 1); 
				$arr_ext = array('jpg', 'jpeg','png'); 				
				
				if(!empty($ext))
				{
					if(in_array($ext, $arr_ext)) { 
						if (!file_exists('path/to/directory')) {
								mkdir('path/to/directory', 0777, true);
								
							}
						if(move_uploaded_file($image['tmp_name'], WWW_ROOT . '/images/PostTravelPackages/'.$id.'/'.$title.'/image/'.$id.'.'.$ext)) {
							$postTravlePackage->image='images/PostTravelPackages/'.$id.'/'.$title.'/image/'.$id.'.'.$ext;
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
			} else { $postTravlePackage->image ='';  }

			if(!empty($document))
			{  
				$dir = new Folder(WWW_ROOT . 'images/PostTravelPackages/'.$id.'/'.$title.'/document', true, 0755);
				$ext = substr(strtolower(strrchr($document['name'], '.')), 1); 
				$arr_ext = array('jpg', 'jpeg','png','pdf'); 				
				if(!empty($ext))
				{
					if (in_array($ext, $arr_ext)) {
						if (!file_exists('path/to/directory')) {
								mkdir('path/to/directory', 0777, true);
							}
						if(move_uploaded_file($document['tmp_name'], WWW_ROOT . '/images/PostTravelPackages/'.$id.'/'.$title.'/document/'.$id.'.'.$ext)) {
							$postTravlePackage->document='images/PostTravelPackages/'.$id.'/'.$title.'/document/'.$id.'.'.$ext;
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
			} else { $postTravlePackage->document = ''; }

			if($message == 'PERFECT' && $response_code == 101)
			{
				if ($this->PostTravlePackages->save($postTravlePackage)) {
					$message = 'The post travel package has been saved';
					$response_code = 200;
				}else{
					pr($postTravlePackage); exit;
					$message = 'The post travel package has not been saved';
					$response_code = 204;				
				}				
			}
		}
		$this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);
    }

	public function getTravelPackages($isLikedUserId=null,$category_id = null, $category_short = null,$duration_day=null,$duration_night=null,$duration_short=null,$valid_date=null,$valid_date_short=null,$starting_price=null,$starting_price_short=null,$country_id=null,$country_id_short=null,$state_id=null,$state_id_short=null)
	{
		
		$isLikedUserId = $this->request->query('isLikedUserId');
		if(!empty($isLikedUserId))
		{
			$category_id = $this->request->query('category_id');
			$category_short = $this->request->query('category_short');
			$duration_day = $this->request->query('duration_day');
			$duration_night = $this->request->query('duration_night');
			$duration_short = $this->request->query('duration_short');
			$valid_date = $this->request->query('valid_date');
			$valid_date_short = $this->request->query('valid_date_short');
			$starting_price = $this->request->query('starting_price');
			$starting_price_short = $this->request->query('starting_price_short');
			$country_id = $this->request->query('country_id');
			$country_id_short = $this->request->query('country_id_short');
			$state_id = $this->request->query('state_id');
			$state_id_short = $this->request->query('state_id_short');

			// Start shorting code
			if(empty($category_short))
			{
				$category_short = 'ASC';
			}
			
			if(!empty($state_id_short))
			{
				
			}else
			{

			}
			
			
			if(!empty($valid_date))
			{ 
				$valid_date = ['valid_date =' =>date('Y-m-d',strtotime($valid_date))];
			}
			else
			{ 
				$valid_date = ['valid_date >=' =>date('Y-m-d')]; 
			}
			
			if(!empty($duration_short) && $duration_short == 'ASC')
			{
				$where_short = ['duration_day' =>'ASC','duration_night' =>'DESC'];
			}
			else if(!empty($duration_short) && $duration_short == 'DESC')
			{
				$where_short = ['duration_day' =>'DESC','duration_night' =>'ASC'];
			}else
			{
				$where_short = null;
			}
			
			if(!empty($valid_date_short))
			{
				$where_short = ['valid_date' =>$valid_date_short];
			}else
			{
				$where_short = null;
			}
			if(!empty($starting_price_short))
			{
				$where_short = ['starting_price' =>$starting_price_short];
			}else
			{
				$where_short = null;
			}
			if(!empty($country_id_short))
			{
				$where_short = ['country_id' =>$country_id_short];
			}else
			{
				$where_short = null;
			}


			// End Shorting code
			// Start Filter code
			
			if(!empty($duration_day) && !empty($duration_night))
			{
				$where_duration = ['duration_day'=>$duration_day,'duration_night'=>$duration_night];
			}
			else if(!empty($duration_day) && empty($duration_night))
			{
				$where_duration = ['duration_day'=>$duration_day];
			}
			else if(empty($duration_day) && !empty($duration_night))
			{
				$where_duration = ['duration_night'=>$duration_night];
			}else
			{
				$where_duration = null;
			}
			
			$category_id_filter = null;
			if(!empty($category_id))
			{
				$category_id_filter = ['post_travle_package_category_id'=>$category_id];
			}else
			{
				$category_id_filter = null;
			}
			
			$state_filter = null;
			
			if(!empty($state_id))
			{
				$state_filter = ['state_id'=>$state_id];
			}else
			{
				$state_filter = null;
			}
			
			if(!empty($starting_price))
			{
				$starting_price = ['starting_price'=>$starting_price];
			}else
			{
				$starting_price = null;
			}
			if(!empty($country_id))
			{
				$country_id = ['country_id'=>$country_id];
			}else
			{
				$country_id = null;
			}

			// End Filter code
			
			$getTravelPackages = $this->PostTravlePackages->find()
			->contain(['Users'])
			->leftJoinWith('PostTravlePackageRows',function($q) use($category_id_filter,$category_short){ 
						return $q->where(['post_travle_package_category_id' =>$category_id_filter])
							->contain(['PostTravlePackageCategories'=>function ($q) use($category_short)
							{	
								return $q->order(['name' => $category_short]);
							}]);
					})
				->leftJoinWith('PostTravlePackageStates',function($q) use($state_filter){ 
						return $q->where($state_filter);
					})				
				->where($where_duration)
				->where($valid_date)
				->where($starting_price)
				->where($country_id)
				->order($where_short)
				->group(['PostTravlePackages.id'])
				->autoFields(true);
			
			//pr($getTravelPackages->toArray()); exit;
			if(!empty($getTravelPackages->toArray()))
			{
				foreach($getTravelPackages as $getTravelPackage)
				{
					$getTravelPackage->total_likes = $this->PostTravlePackages->PostTravlePackageLikes
							->find()->where(['post_travle_package_id' => $getTravelPackage->id])->count();					
					$exists = $this->PostTravlePackages->PostTravlePackageLikes->exists(['post_travle_package_id'=>$getTravelPackage->id,'user_id'=>$isLikedUserId]);
					if($exists == 1)
					{ $getTravelPackage->isLiked = 'yes'; }
					else { $getTravelPackage->isLiked = 'no'; }					
				}
				$message = 'List Found Successfully';
				$response_code = 200;
			}
			else
			{
				$message = 'No Content Found';
				$getTravelPackages = [];
				$response_code = 204;			
			}			
		}		
		else
		{
			$message = 'isLikedUserId is empty';
			$getTravelPackages = [];
			$response_code = 204;			
		}		
		$this->set(compact('getTravelPackages','message','response_code'));
        $this->set('_serialize', ['getTravelPackages','message','response_code']);		
	}

	public function getTravelPackageDetails($id = null,$user_id = null)
	{
		$id = $this->request->query('id');
		$user_id = $this->request->query('user_id');
		$getTravelPackageDetails = $this->PostTravlePackages->find();
		$getTravelPackageDetails->select(['total_likes'=>$getTravelPackageDetails->func()->count('PostTravlePackageLikes.id')])
			->leftJoinWith('PostTravlePackageLikes')
			->contain(['Users','PriceMasters','Currencies','PostTravlePackageRows'=>['PostTravlePackageCategories'],'PostTravlePackageStates'=>['States'],'PostTravlePackageCities'=>['Cities'],'PostTravlePackageCountries'=>['Countries']])
			->where(['PostTravlePackages.id'=>$id])
			->group(['PostTravlePackages.id'])
		->autoFields(true);
		if(!empty($getTravelPackageDetails->toArray()))
		{
		
			$viewPostTravelPackages = $this->PostTravlePackages->PostTravlePackageViews->newEntity();
			$viewPostTravelPackages->post_travle_package_id = $id;
			$viewPostTravelPackages->user_id = $user_id;
			$exists = $this->PostTravlePackages->PostTravlePackageViews->exists(['post_travle_package_id'=>$viewPostTravelPackages->post_travle_package_id,'user_id'=>$viewPostTravelPackages->user_id]);
			
			if($exists == 0)
			{
				if ($this->PostTravlePackages->PostTravlePackageViews->save($viewPostTravelPackages)) {
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
			//$message = 'Data Found Successfully';
			//$response_code = 200;
		}
		else
		{
			$message = 'No Content Found';
			$getTravelPackageDetails = [];
			$response_code = 204;			
		}
		
		$this->set(compact('getTravelPackageDetails','message','response_code'));
        $this->set('_serialize', ['getTravelPackageDetails','message','response_code']);		
	}
	
	public function likePostTravelPackages()
	{
        $likePostTravelPackages = $this->PostTravlePackages->PostTravlePackageLikes->newEntity();
        if ($this->request->is('post')) {
           
			$likePostTravelPackages = $this->PostTravlePackages->PostTravlePackageLikes->patchEntity($likePostTravelPackages, $this->request->data);		
			
			$exists = $this->PostTravlePackages->PostTravlePackageLikes->exists(['post_travle_package_id'=>$likePostTravelPackages->post_travle_package_id,'user_id'=>$likePostTravelPackages->user_id]);
			
			if($exists == 0)
			{
				if ($this->PostTravlePackages->PostTravlePackageLikes->save($likePostTravelPackages)) {
					$message = 'Liked successfully';
					$response_code = 200;
				}else{
					$message = 'Like not saved';
					$response_code = 204;				
				}				
			}
			else
			{
				$this->PostTravlePackages->PostTravlePackageLikes->deleteAll(['PostTravlePackageLikes.post_travle_package_id'=>$likePostTravelPackages->post_travle_package_id,'PostTravlePackageLikes.user_id'=>$likePostTravelPackages->user_id]);
					
					$message = 'Disliked';
					$response_code = 200;					
			}	

		}
		$this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);		
	}	
	
	public function removePostTravelPackages($post_travel_id = null)
	{
		$post_travel_id = $this->request->query('post_travel_id');
		if(!empty($post_travel_id))
		{
			$query = $this->PostTravlePackages->query();
			$query->update()->set(['is_deleted' => 1])
			->where(['id' => $post_travel_id])->execute();			
			$message = 'The Post Travel Packages has been deleted successfully';
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

	public function getPostTravelPackageReport($user_id = null)
	{ 
		$user_id = $this->request->query('user_id');
		if(!empty($user_id))
		{
			$getPostTravelPackages = $this->PostTravlePackages->find()
			->where(['is_deleted' =>0])
			->where(['user_id'=>$user_id])
			->group(['PostTravlePackages.id'])
			->autoFields(true);
			
			if(!empty($getPostTravelPackages->toArray()))
			{
				foreach($getPostTravelPackages as $getPostTravelPackage)
				{
					$getPostTravelPackage->total_likes = $this->PostTravlePackages->PostTravlePackageLikes
							->find()->where(['post_travle_package_id' => $getPostTravelPackage->id])->count();

					$getPostTravelPackage->total_views = $this->PostTravlePackages->PostTravlePackageViews
							->find()->where(['post_travle_package_id' => $getPostTravelPackage->id])->count();
					
					if($getPostTravelPackage->visible_date >= date('Y-m-d'))
					{
						$getPostTravelPackage->expir_status = 'valid';	
					}else
					{
						$getPostTravelPackage->expir_status = 'expired';		
					}	
				}
				$message = 'List Found Successfully';
				$response_code = 200;
			}
			else
			{
				$message = 'No Content Found';
				$getPostTravelPackages= [];
				$response_code = 204;			
			}			
		}else {
				$message = 'Please Enter User ID ';
				$getPostTravelPackages= [];
				$response_code = 205;			
		}


		$this->set(compact('getPostTravelPackages','message','response_code'));
        $this->set('_serialize', ['getPostTravelPackages','message','response_code']);				
	}

	public function renewPostTravelPackage($post_travel_id=null,$price_master_id=null,$price=null,$visible_date=null)
	{
		$post_travel_id = $this->request->query('post_travel_id');
		$price_master_id = $this->request->query('price_master_id');
		$price = $this->request->query('price');
		$visible_date = $this->request->query('visible_date'); 
		if(!empty($post_travel_id) && !empty($price_master_id) && !empty($price) && !empty($visible_date))
		{
		$getPostTravelPackages = $this->PostTravlePackages->find()->where(['id'=>$post_travel_id]);
			if(!empty($getPostTravelPackages->toArray()))
			{
				foreach($getPostTravelPackages as $getPostTravelPackage)
				{
					$PriceBeforeRenews = $this->PostTravlePackages->PostTravlePackagePriceBeforeRenews->newEntity();
					
					$PriceBeforeRenews->post_travle_package_id = $getPostTravelPackage->id;
					$PriceBeforeRenews->price_master_id = $getPostTravelPackage->price_master_id;
					$PriceBeforeRenews->price = $getPostTravelPackage->price;
					$PriceBeforeRenews->visible_date = $getPostTravelPackage->visible_date;
					
					if ($this->PostTravlePackages->PostTravlePackagePriceBeforeRenews->save($PriceBeforeRenews))
					{
						$query = $this->PostTravlePackages->query();
						$query->update()->set(['price_master_id' => $price_master_id,'price'=>$price,'visible_date'=>date('Y-m-d',strtotime($visible_date))])
						->where(['id' => $post_travel_id])->execute();			
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
