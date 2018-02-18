<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;

class CurrenciesController extends AppController
{

    public function index()
    {
        $Currencies = $this->Currencies->find('list')
		->where(['is_deleted'=>0]);
		
		if(!empty($Currencies->toArray()))
		{
			$message = 'List Found Successfully';
			$response_code = 200;
		}
		else
		{
			$message = 'No Content Found';
			$Currencies = [];
			$response_code = 204;			
		}
		
		$this->set(compact('Currencies','message','response_code'));
        $this->set('_serialize', ['Currencies','message','response_code']);
    }



}
