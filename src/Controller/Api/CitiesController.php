<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
class CitiesController extends AppController
{
	 
	public function citiesForState($state_id = null){
		
		$state_id = $this->request->query('state_id');
		$Cities=$this->Cities->find('list')->where(['state_id'=>$state_id,'is_deleted'=>0]);
		$this->set(compact('Cities'));
		$this->set('Cities', $Cities);
        $this->set('_serialize', ['Cities']);		
	}		
}

?>