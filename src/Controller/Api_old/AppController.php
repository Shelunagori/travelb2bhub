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

namespace App\Controller\Api;

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
            'loginAction' => '/pages/home',
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
    
    
    
    
    
    
    public function beforeFilter(\Cake\Event\Event $event) {
        
        parent::beforeFilter($event);
        $this->Auth->allow(['index']);
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
    
    
      public function getarray($datas){
         $raw_data = file_get_contents('php://input');
         $boundary = substr($raw_data, 0, strpos($raw_data, "\r\n"));
         if(empty($boundary)){
         parse_str($raw_data,$data);
         return $data;
       }
       $parts = array_slice(explode($boundary, $raw_data), 1);
       foreach ($parts as $part) {
        if ($part == "--\r\n") break;
        $part = ltrim($part, "\r\n");
        list($raw_headers, $body) = explode("\r\n\r\n", $part, 2);
        $raw_headers = explode("\r\n", $raw_headers);
        $headers = array();
        foreach ($raw_headers as $header) {
            list($name, $value) = explode(':', $header);
            $headers[strtolower($name)] = ltrim($value, ' ');
        }
      if (isset($headers['content-disposition'])) {
            $filename = null;
            $tmp_name = null;
            preg_match(
                '/^(.+); *name="([^"]+)"(; *filename="([^"]+)")?/',
                $headers['content-disposition'],
                $matches
            );
            list(, $type, $name) = $matches;

         if( isset($matches[4]) )
            {
                if( isset( $_FILES[ $matches[ 2 ] ] ) )
                {
                    continue;
                }
              $filename = $matches[4];
                 $filename_parts = pathinfo( $filename );
                $tmp_name = tempnam( ini_get('upload_tmp_dir'), $filename_parts['filename']);
                 $_FILES[ $matches[ 2 ] ] = array(
                    'error'=>0,
                    'name'=>$filename,
                    'tmp_name'=>$tmp_name,
                    'size'=>strlen( $body ),
                    'type'=>$value
                );
               file_put_contents($tmp_name, $body);
            }
          else
            {
                $data[$name] = substr($body, 0, strlen($body) - 2);
            }
        }
        }
    $globals = $data;
    return $globals;   
    }

}
