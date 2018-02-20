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

			$id=$taxiFleetPromotion->user_id;
			$title = $taxiFleetPromotion->title;
			$image = $this->request->data('image');	
			$document = $this->request->data('document');				
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
					$message = 'Already Liked';
					$response_code = 205;					
			}	

		}
		$this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);		
	}
	public function getTaxiFleetPromotions()
	{
		$getTaxiFleetPromotions = $this->TaxiFleetPromotions->find();
			$getTaxiFleetPromotions->select(['total_likes'=>$getTaxiFleetPromotions->func()->count('TaxiFleetPromotionLikes.id')])
			->leftJoinWith('TaxiFleetPromotionLikes')
		->where(['visible_date >=' =>date('Y-m-d')])
		->group(['TaxiFleetPromotions.id'])
		->autoFields(true);
		//pr($getTravelPackages->toArray()); exit;
		if(!empty($getTaxiFleetPromotions->toArray()))
		{
			$message = 'List Found Successfully';
			$response_code = 200;
		}
		else
		{
			$message = 'No Content Found';
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
	
	
}
