<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;

class TaxiFleetCarBusesController extends AppController
{

    public function index()
    {
        $TaxiFleetCarBuses = $this->TaxiFleetCarBuses->find()
		->where(['is_deleted'=>0]);
		
		if(!empty($TaxiFleetCarBuses->toArray()))
		{
			$message = 'List Found Successfully';
			$response_code = 200;
		}
		else
		{
			$message = 'No Content Found';
			$TaxiFleetCarBuses = [];
			$response_code = 204;			
		}
		
		$this->set(compact('TaxiFleetCarBuses','message','response_code'));
        $this->set('_serialize', ['TaxiFleetCarBuses','message','response_code']);
    }



}
