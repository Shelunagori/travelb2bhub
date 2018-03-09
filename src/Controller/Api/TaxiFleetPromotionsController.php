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
				$state_id=$this->request->data['state_id'];
				$x=0; 
				foreach($state_id as $state)
				{
					$taxiFleetPromotion['taxi_fleet_promotion_states['.$x.']["state_id"]']=$state_id[$x];
					$x++;	
				}
				$city_id=$this->request->data['city_id'];
				$y=0; 
				foreach($city_id as $city)
				{
					$taxiFleetPromotion['taxi_fleet_promotion_cities['.$y.']["city_id"]']=$city_id[$y];
					$y++;	
				}
				$vehicle_type=$this->request->data['vehicle_type'];
				$z=0; 
				foreach($vehicle_type as $vehicle)
				{
					$taxiFleetPromotion['taxi_fleet_promotion_rows['.$z.']["taxi_fleet_car_bus_id"]']=$vehicle_type[$z];
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
						if(move_uploaded_file($image['tmp_name'], WWW_ROOT . '/images/taxiFleetPromotion/'.$id.'/'.$title.'/image/'.$id.'.'.$ext)) {
							$taxiFleetPromotion->image='images/taxiFleetPromotion/'.$id.'/'.$title.'/image/'.$id.'.'.$ext;
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
			} else { $taxiFleetPromotion->document = ''; }			
			
			if($message == 'PERFECT' && $response_code == 101)
			{
				if ($this->TaxiFleetPromotions->save($taxiFleetPromotion)) {
					$message = 'The Taxi/Fleet promotions has been saved';
					$response_code = 200;
				}else{
					$message = 'The Taxi/Fleet promotions has not been saved';
					$response_code = 204; 
				}
			}			
        } 
		if(@$submitted_from=='web'){
			$this->Flash->success(__('message')); 
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
	public function getTaxiFleetPromotions($isLikedUserId = null)
	{
		$isLikedUserId = $this->request->query('isLikedUserId');		
		if(!empty($isLikedUserId))
		{
			$getTaxiFleetPromotions = $this->TaxiFleetPromotions->find();
				$getTaxiFleetPromotions->select(['total_likes'=>$getTaxiFleetPromotions->func()->count('TaxiFleetPromotionLikes.id')])
				->leftJoinWith('TaxiFleetPromotionLikes')
			->contain(['Users','PriceMasters','Countries'])
			->where(['TaxiFleetPromotions.visible_date >=' =>date('Y-m-d')])
			->group(['TaxiFleetPromotions.id'])
			->autoFields(true);
			//pr($getTravelPackages->toArray()); exit;
			if(!empty($getTaxiFleetPromotions->toArray()))
			{
				foreach($getTaxiFleetPromotions as $getTaxiFleetPromotion)
				{
					$exists = $this->TaxiFleetPromotions->TaxiFleetPromotionLikes->exists(['taxi_fleet_promotion_id'=>$getTaxiFleetPromotion->id,'user_id'=>$isLikedUserId]);
					
					if($exists == 0)
					{  $getTaxiFleetPromotion->isLiked = 'yes'; } 
					else { $getTaxiFleetPromotion->isLiked = 'no'; }				
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
			->contain(['Users','PriceMasters','Countries','TaxiFleetPromotionStates'=>['States'],'TaxiFleetPromotionCities'=>['Cities'],'TaxiFleetPromotionRows'=>['TaxiFleetCarBuses']])
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
						$query->update()->set(['price_master_id' => $price_master_id,'price'=>$price,'visible_date'=>date('Y-m-d',strtotime($visible_date))])
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
	
}
