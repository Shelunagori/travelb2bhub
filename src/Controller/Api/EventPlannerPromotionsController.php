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

		$this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);		
    }
}
