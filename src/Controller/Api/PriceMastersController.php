<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;

class PriceMastersController extends AppController
{

    public function index($promotion_type_id = null)
    {
		$promotion_type_id = $this->request->query('promotion_type_id');
        $PriceMasters = $this->PriceMasters->find('list')
		->where(['is_deleted'=>0,'promotion_type_id'=>$promotion_type_id]);
		
		if(!empty($PriceMasters->toArray()))
		{
			$message = 'List Found Successfully';
			$response_code = 200;
		}
		else
		{
			$message = 'No Content Found';
			$PriceMasters = [];
			$response_code = 204;			
		}
		
		$this->set(compact('PriceMasters','message','response_code'));
        $this->set('_serialize', ['PriceMasters','message','response_code']);
    }



}
