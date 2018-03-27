<?php

/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;
use Cake\Controller\Controller;

use Cake\Event\Event;
use Cake\Routing\Router;

//namespace App\View;
//use Cake\View\View;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    protected $appSession;
	var $helpers = array('Html', 'Form', 'Travel');

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
   public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
	 
		$coreVariable = [
			'SiteUrl' => 'http://13.127.63.130/travelb2bhub/',
		];
		$this->coreVariable = $coreVariable;
		$this->set(compact('coreVariable'));
	 
        if($this->request->params['controller'] == 'Admins') 
		{
		 
			$this->loadComponent('Auth', [
				'authenticate' => [
					'Form' => [
						'fields' => [
							'username' => 'email',
							'password' => 'password'
						],
						'userModel' => 'Admins'
					]
				],
				'loginAction' => [
					'controller' => 'Admins',
					'action' => 'login'
				],
				'loginRedirect' => [
					'controller' => 'Admins',
					'action' => 'index',
				],
				'logoutRedirect' => [
					'controller' => 'Admins',
					'action' => 'login'
				],
				'unauthorizedRedirect' => $this->referer(),
			]);
		}
		else
		{
$this->loadComponent('Auth', [
			 'authenticate' => [
					'Form' => [
						'fields' => [
							'username' => 'email',
							'password' => 'password'
						],
						'scope' => ['status' => '1'],
						'userModel' => 'Users'
					]
				],
				'loginRedirect' => [
					'controller' => 'Users',
					'action' => 'dashboard'
				],
				'logoutRedirect' => [
					'controller' => 'Users',
					'action' => 'login'
				],
				'unauthorizedRedirect' => $this->referer(),
			]);
			
		}	
		
    }

	public function beforeFilter(Event $event) {
		$this->set('login_status', $this->Auth->user('id'));
		$email = $this->getSettings('email');
		$address = $this->getSettings('address');
		$phone = $this->getSettings('phone');
		$officehours = $this->getSettings('office-hours');
		$freemembership = $this->getSettings('freemembership');
		$reqcount = $this->getSettings('requestcount');
		$freemembershipdate = $this->getSettings('freemembershipdate');
		$roleid = $this->getRoleID($this->Auth->user('id'));
		$this->set('emailsystem',   $email);
		$this->set('addresssystem',   $address);
		$this->set('phonesystem',   $phone);
		$this->set('officehourssystem',   $officehours);
		$this->set('freemembership',   $freemembership);
		$this->set('freemembershipdate',   $freemembershipdate);
		$this->set('reqcount',   $reqcount);
		$this->set('role_idsession',   $roleid);
	}
	
	public function getSettings($field)
	{
		$this->loadModel('Setting');
		$data= $this->Setting->find()->where(['field' => $field])->first();
		return $data;
	}	
	
	public function getRoleID($userid)
	{
		$this->loadModel('Users');
		$data= $this->Users->find()->where(['id' => $userid])->first();
		return $data['role_id'];
	}
    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event) {
        if (!array_key_exists('_serialize', $this->viewVars) &&
                in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

	function ymdFormatByDateFormat($date, $format, $dateSeparator) {
		$newDate = "";
		if($date!='') {
			$dtArr = explode($dateSeparator, $date);
			if(!empty($dtArr)) {
				if($format == "m-d-Y") {
					$newDate = $dtArr[2].'-'.$dtArr[0].'-'.$dtArr[1];
				} elseif($format == "d-m-Y") {
					$newDate = $dtArr[2].'-'.$dtArr[1].'-'.$dtArr[0];
				} else {
					$newDate = $dtArr[0].'-'.$dtArr[1].'-'.$dtArr[2];
				}
			}
		}
		return $newDate;
	}
	
	public function commonaddress(){
		$email = $this->Model->query("SELECT value FROM setting where field='email'" );
		echo $email ;
	}
	
	
}
