<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PostTravlePackages Controller
 *
 * @property \App\Model\Table\PostTravlePackagesTable $PostTravlePackages
 */
class PostTravlePackagesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		$first_name=$this->Auth->User('first_name');
		$last_name=$this->Auth->User('last_name');
		$profile_pic=$this->Auth->User('profile_pic');    
		$loginId=$this->Auth->User('id');
		$role_id=$this->Auth->User('role_id');
		$authUserName=$first_name.' '.$last_name;
		$this->set('MemberName',$authUserName);
		$this->set('profile_pic', $profile_pic);
		$this->set('loginId',$loginId);
		$this->set('roleId',$role_id);
		
		//----	 FInalized
		$this->loadModel('Requests');
		$finalreq["Requests.user_id"] = $this->Auth->user('id');
		$finalreq["Requests.status"] = 2;
		$finalreq["Requests.is_deleted "] = 0;
		$finalizeRequest = $this->Requests->find()->where($finalreq)->count();
		$this->set('finalizeRequest', $finalizeRequest);
		//--- Removed Request
		$remoev["Requests.user_id"] = $this->Auth->user('id');
		$remoev["Requests.is_deleted "] = 1;
		$RemovedReqest = $this->Requests->find()->where($remoev)->count();
		$this->set('RemovedReqest', $RemovedReqest);
		//--- Blocked User
		$this->loadModel('blocked_users');
		$blk["blocked_users.blocked_by"] = $this->Auth->user('id');
		$blockedUserscount = $this->blocked_users->find()->where($blk)->count();
		$this->set('blockedUserscount', $blockedUserscount);
		//--- Finalize Response;
		$this->loadModel('Responses');
		$FInalResponseCount = $this->Responses->find('all', ['conditions' => ['Responses.status' =>1,'Responses.is_deleted' =>0,'Responses.user_id' => $this->Auth->user('id')]])->count();
		$this->set('FInalResponseCount', $FInalResponseCount);
		//*--- UserChats
		$this->loadModel('UserChats');
		$csort['created'] = "DESC";
		$allUnreadChat = $this->UserChats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->order($csort)->all();
		$chatCount = $allUnreadChat->count();
		$this->set('chatCount',$chatCount); 
		$this->set('allunreadchat',$allUnreadChat);
		//*---
		$this->loadModel('UserChats');
		$csort['created'] = "DESC";
		$allUnreadChat = $this->UserChats->find()->where(['is_read' => 0, 'send_to_user_id'=> $this->Auth->user('id')])->order($csort)->limit(10)->all();
		$chatCount = $allUnreadChat->count();
		$this->set('chatCount',$chatCount); 
		$this->set('allunreadchat',$allUnreadChat);
		//--
		
	}
    public function index()
    {
		$this->viewBuilder()->layout('user_layout');
        $this->paginate = [
            'contain' => ['Currencies', 'Countries', 'PriceMasters', 'Users','PostTravlePackageRows']
        ];
        $postTravlePackages = $this->paginate($this->PostTravlePackages);
		//pr($postTravlePackages->toArray());exit;
        $this->set(compact('postTravlePackages'));
        $this->set('_serialize', ['postTravlePackages']);
    }

    /**
     * View method
     *
     * @param string|null $id Post Travle Package id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('user_layout');
		$user_id=$this->Auth->User('id');
		$this->set(compact('user_id','id'));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('user_layout');
		$user_id=$this->Auth->User('id');
		$this->set(compact('user_id'));
       /* $postTravlePackage = $this->PostTravlePackages->newEntity();
        if ($this->request->is('post'))
		{
            $postTravlePackage = $this->PostTravlePackages->patchEntity($postTravlePackage, $this->request->data);
			// Call Curl FOR FB DETAILS
				
				$state_id=$this->request->data['state_id'];
				$x=0;
				$array_of_state=array();
				foreach($state_id as $state)
				{
					$array_of_state['post_travle_package_states['.$x.']["state_id"]']=$state_id[$x];
					$x++;	
				}
				
				$city_id=$this->request->data['city_id'];
				$y=0;
				$array_of_cities=array();
				foreach($city_id as $city)
				{
					$array_of_cities['post_travle_package_cities['.$y.']["city_id"]']=$city_id[$y];
					$y++;	
				}
				$package_category_id=$this->request->data['package_category_id'];
				$z=0;
				$array_of_category=array();
				//pr($city_id);
				foreach($package_category_id as $category)
				{
					
$array_of_category['post_travle_package_rows['.$z.']["post_travle_package_category_id"]']=$package_categ
ory_id[$z];
					$z++;	
				}

							$post =[
								'company_name' => $this->request->data['company_name'],
								'UserId' => $UserId,
								'title' =>$this->request->data['title'],
								'image' =>'',//$this->request->data['image'],
								'document' =>'',//$this->request->data['document'],
								'duration_night' =>$this->request->data['duration_night'],									
								'duration_day' =>$this->request->data['duration_day'],									
								//'promotion_type' =>$this->request->data['promotion_type'],									
								'valid_date' =>$this->request->data['valid_date1'],									
								'currency_id' =>$this->request->data['currency_id'],									
								'starting_price' =>$this->request->data['starting_price'],									
								'country_id' =>$this->request->data['country_id'],									
								'package_detail' =>$this->request->data['package_detail'],									
								'excluded_detail' =>$this->request->data['excluded_detail'],									
								'price_master_id' =>$this->request->data['price_master_id'],									
								'visible_date' =>$this->request->data['visible_date']									
								//'payment_amount' =>$this->request->data['payment_amount'],									
							];
							$post=array_merge($post,$array_of_category);
							$post=array_merge($post,$array_of_cities);
							$post=array_merge($post,$array_of_state);
							//pr($post);exit;
							$ch = curl_init('http://konciergesolutions.com/travelb2bhub/api/post_travle_packages/add.json');
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
							$response = curl_exec($ch);
							$result = json_encode($response);
							curl_close($ch);
							pr($result);
				exit;
				
          /*   if ($this->PostTravlePackages->save($postTravlePackage))
				{
                $this->Flash->success(__('The post travle package has been saved.'));

                return $this->redirect(['action' => 'index']);
				}
			else
				$this->Flash->error(__('The post travle package could not be saved. Please, try again.'));
		} */
	//}
		/*$city = $this->PostTravlePackages->Users->Cities->find('list');
		$cat = $this->PostTravlePackages->PostTravlePackageRows->PostTravlePackageCategories->find('list');
		//pr($cat->toArray());exit;
		$states = $this->PostTravlePackages->Users->States->find('list', ['limit' => 200])->where(['country_id'=>'101']);
        $currencies = $this->PostTravlePackages->Currencies->find('list', ['limit' => 200]);
        $countries = $this->PostTravlePackages->Countries->find('list', ['limit' => 200]);
		//$priceMasters = $this->PostTravlePackages->PriceMasters->find('all', ['limit' => 200])->where(['promotion_type_id'=>1]);
        $users = $this->PostTravlePackages->Users->find()->where(['id'=>$uest_id])->first();  
        $this->set(compact('postTravlePackage', 'currencies', 'countries', 'users','states','city','cat','uest_id'));
        $this->set('_serialize', ['postTravlePackage']);*/
    }

    public function edit($id = null)
    {
        $postTravlePackage = $this->PostTravlePackages->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postTravlePackage = $this->PostTravlePackages->patchEntity($postTravlePackage, $this->request->data);
            if ($this->PostTravlePackages->save($postTravlePackage)) {
                $this->Flash->success(__('The post travle package has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post travle package could not be saved. Please, try again.'));
        }
        $currencies = $this->PostTravlePackages->Currencies->find('list', ['limit' => 200]);
        $countries = $this->PostTravlePackages->Countries->find('list', ['limit' => 200]);
        $priceMasters = $this->PostTravlePackages->PriceMasters->find('list', ['limit' => 200]);
        $users = $this->PostTravlePackages->Users->find('list', ['limit' => 200]);
        $this->set(compact('postTravlePackage', 'currencies', 'countries', 'priceMasters', 'users'));
        $this->set('_serialize', ['postTravlePackage']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Post Travle Package id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $postTravlePackage = $this->PostTravlePackages->get($id);
        if ($this->PostTravlePackages->delete($postTravlePackage)) {
            $this->Flash->success(__('The post travle package has been deleted.'));
        } else {
            $this->Flash->error(__('The post travle package could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	public function report($higestSort = null,$country_id = null,$category_id = null,$duration_day_night = null,$starting_price = null,$posttravle_id= null,$removeposttravle= null)
    {
		$higestSort=$this->request->query('higestSort'); 
		$country_id=$this->request->query('country_id'); 
		$category_id=$this->request->query('category_id'); 
		$duration_day_night=$this->request->query('duration_day_night'); 
		$starting_price=$this->request->query('starting_price'); 
		 //-- REMOVE PARAMETER
		$user_id=$this->Auth->User('id');
		if ($this->request->is(['patch', 'post', 'put'])) 
		{
			//pr($this->request->data); exit;
			//-- REMOVE EVENT
		 	if (isset($this->request->data['removeposttravle']))
			{
 				$posttravle_id=$this->request->data('posttravle_id');
				//pr($posttravle_id);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/PostTravlePackages/removePostTravelPackages.json?post_travel_id=".$posttravle_id,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 899aa26c-f697-c513-89c1-b6bba1e1fbdf"
				  ),
				));

				$removeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				  $removeResult=json_decode($removeResponse);
				}
				$displayMessage=$removeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'report']);
			} 
			//-- Like EVENT
			if(isset($this->request->data['LikeEvent']))
			{
 				$posttravle_id=$this->request->data('posttravle_id');
				$post =[
						'post_travle_package_id' => $posttravle_id,
						'user_id' =>$user_id						 							
					];
					//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/PostTravlePackages/likePostTravelPackages.json",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>$post,
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 7e320187-3288-d2ad-e6f3-890260c02fc7"
				  ),
				));
				$LikeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				 $LikeResult=json_decode($LikeResponse);
				} 
				$displayMessage=$LikeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'report']);
			}
			//---Save cart TaxiFleet Promotion
			if(isset($this->request->data['saveposttravle']))
			{
				$user_id=$this->Auth->User('id');
				$posttravle_id=$this->request->data('posttravle_id');
				$post =[
						'post_travle_package_id' => $posttravle_id,
						'user_id' =>$user_id						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/PostTravlePackageCarts/postTravlePackageCartAdd.json",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS =>$post,
				  CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"postman-token: 7e320187-3288-d2ad-e6f3-890260c02fc7"
				  ),
				));
				$LikeResponse = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);
				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				 $LikeResult=json_decode($LikeResponse);
				} 
				$displayMessage=$LikeResult->message;
				$this->Flash->success(__($displayMessage));
				return $this->redirect(['action' => 'report']);
			} 
		}
		$this->viewBuilder()->layout('user_layout');
        $user_id=$this->Auth->User('id');
		$this->set(compact('user_id','higestSort','country_id','category_id','duration_day_night','starting_price'));
    }

}
