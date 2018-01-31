<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

use Cake\ORM\TableRegistry;

class ResponseHelper extends Helper
{

	public function getUserChats($requestId) {
		$UserChatsObj= TableRegistry::get('UserChats');
		$userChats = $UserChatsObj->find()
                        ->contain(["Requests"])
                        ->where(['UserChats.request_id' => $requestId])->order(["UserChats.id" => "ASC"])->all();
		return $userChats;
	}
}