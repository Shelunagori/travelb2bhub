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

namespace App\Controller\Admin;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Routing\Router;




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
        $this->loadComponent('Auth', [
            'loginAction' => '/users/login',
            'loginRedirect' => '/users/dashboard',
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ],
                'ADmad/HybridAuth.HybridAuth' => [
                    // All keys shown below are defaults
                    'fields' => [
                        'provider' => 'provider',
                        'openid_identifier' => 'openid_identifier',
                        'email' => 'email'
                    ],
                    'profileModel' => 'ADmad/HybridAuth.SocialProfiles',
                    'profileModelFkField' => 'user_id',
                    // The URL Hybridauth lib should redirect to after authentication.
                    // If no value is specified you are redirect to this plugin's
                    // HybridAuthController::authenticated() which handles persisting
                    // user info to AuthComponent and redirection.
                    'hauth_return_to' => null
                ]
            ]
        ]);
    }
    
    
   
//    
//     public function beforeFilter(Event $event) {
//        $this->appSession = $this->request->session();
//        parent::beforeFilter($event);
//        $this->set('currentUser', $this->Auth->user());
//         $this->Auth->allow(['add','edit','login','index','home']);
//    }
    
    
    
    
    
    
    

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

}
