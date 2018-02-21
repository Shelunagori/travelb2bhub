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
           
			$postTravlePackage = $this->PostTravlePackages->patchEntity($postTravlePackage, $this->request->data(),[ 'associated' => ['PostTravlePackageRows', 'PostTravlePackageStates','PostTravlePackageCities'] ]);

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
					$message = 'The post travel package has not been saved';
					$response_code = 204;				
				}				
			}
		}
		$this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);
    }

	public function getTravelPackages($category_id = null, $category_short = null,$duration_day=null,$duration_night=null,$duration_short=null,$valid_date=null,$valid_date_short=null,$starting_price=null,$starting_price_short=null,$country_id=null,$country_id_short=null,$state_id=null,$state_id_short=null)
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
		
		$getTravelPackages = $this->PostTravlePackages->find();
			$getTravelPackages->select(['total_likes'=>$getTravelPackages->func()->count('PostTravlePackageLikes.id')])
			->leftJoinWith('PostTravlePackageLikes')
			->innerJoinWith('PostTravlePackageRows',function($q) use($category_id_filter,$category_short){ 
					return $q->where($category_id_filter)
						->contain(['PostTravlePackageCategories'=>function ($q) use($category_short)
						{	
							return $q->order(['name' => $category_short]);
						}]);
				})
			->innerJoinWith('PostTravlePackageStates',function($q) use($state_filter){ 
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
			$message = 'List Found Successfully';
			$response_code = 200;
		}
		else
		{
			$message = 'No Content Found';
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
			->contain(['Users','PriceMasters','Countries','Currencies','PostTravlePackageRows'=>['PostTravlePackageCategories'],'PostTravlePackageStates'=>['States'],'PostTravlePackageCities'=>['Cities']])
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
				$this->PostTravlePackages->PostTravlePackageLikes->deleteAll(['post_travle_package_id'=>$likePostTravelPackages->post_travle_package_id,'user_id'=>$likePostTravelPackages->user_id]);
					
					$message = 'Disliked';
					$response_code = 200;					
			}	

		}
		$this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);		
	}	
	
	
	

	
}
