<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;

class PostTravlePackageCategoriesController extends AppController
{

    public function index()
    {
        $postTravlePackageCategories = $this->PostTravlePackageCategories->find()
		->where(['is_deleted'=>0]);
		
		if(!empty($postTravlePackageCategories->toArray()))
		{
			$message = 'List Found Successfully';
			$response_code = 200;
		}
		else
		{
			$message = 'No Content Found';
			$postTravlePackageCategories = [];
			$response_code = 204;			
		}
		
		$this->set(compact('postTravlePackageCategories','message','response_code'));
        $this->set('_serialize', ['postTravlePackageCategories','message','response_code']);
    }
}
