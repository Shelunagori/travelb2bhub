<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;

class UsersController extends AppController
{

    public function index($user_id = null)
    {
		$user_id = $this->request->query('user_id');
        $Users = $this->Users->find()
		->where(['id'=>$user_id]);
		if(!empty($user_id))
		{
			if(!empty($Users->toArray()))
			{
				$message = 'Data Found Successfully';
				$response_code = 200;
			}
			else
			{
				$message = 'No Content Found';
				$Users = [];
				$response_code = 204;			
			}			
		}else
		{
				$message = 'Invalid Parameter';
				$Users = [];
				$response_code = 205;				
		}

		
		$this->set(compact('Users','message','response_code'));
        $this->set('_serialize', ['Users','message','response_code']);
    }



}
