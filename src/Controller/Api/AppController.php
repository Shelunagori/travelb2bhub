<?php
namespace App\Controller\Api;
use Cake\Controller\Controller;
use Cake\Event\Event;

//use Cake\I18n\FrozenDate;
//use Cake\I18n\FrozenTime;
class AppController extends Controller
{
  use \Crud\Controller\ControllerTrait;
	
  public $components = [
        'RequestHandler',
        'Crud.Crud' => [
            'actions' => [
                'Crud.Index',
                'Crud.View',
                'Crud.Add',
                'Crud.Edit',
                'Crud.Delete'
            ],
            'listeners' => [
                'Crud.Api',
                'Crud.ApiPagination',
                'Crud.ApiQueryLog'
            ]
        ]
    ];
	public function initialize()
    {
		$coreVariable = [
			'SiteUrl' => 'http://app.ucciudaipur.in/webroot/',
		];
		$this->coreVariable = $coreVariable;
		$this->set(compact('coreVariable'));
	}
	
}

/*

*/
?>