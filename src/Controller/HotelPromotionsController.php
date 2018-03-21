<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * HotelPromotions Controller
 *
 * @property \App\Model\Table\HotelPromotionsTable $HotelPromotions
 */
class HotelPromotionsController extends AppController
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
		//--

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
            'contain' => ['Users', 'HotelCategories', 'PriceMasters']
        ];
        $hotelPromotions = $this->paginate($this->HotelPromotions);

        $this->set(compact('hotelPromotions'));
        $this->set('_serialize', ['hotelPromotions']);
    }

    /**
     * View method
     *
     * @param string|null $id Hotel Promotion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('user_layout');
		$user_id=$this->Auth->User('id');
		$this->set(compact('user_id','id'));
        /* $hotelPromotion = $this->HotelPromotions->get($id, [
            'contain' => ['Users', 'HotelCategories', 'PriceMasters', 'HotelPromotionCities', 'HotelPromotionLikes', 'HotelPromotionPriceBeforeRenews', 'HotelPromotionReports', 'HotelPromotionViews']
        ]); */
		
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		
		$this->viewBuilder()->layout('user_layout');
		$user_id=$this->Auth->User('id');
		$this->set(compact('user_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Hotel Promotion id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('user_layout');
		$user_id=$this->Auth->User('id');
		$this->set(compact('user_id'));
        $hotelPromotion = $this->HotelPromotions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hotelPromotion = $this->HotelPromotions->patchEntity($hotelPromotion, $this->request->data);
            if ($this->HotelPromotions->save($hotelPromotion)) {
                $this->Flash->success(__('The hotel promotion has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The hotel promotion could not be saved. Please, try again.'));
            }
        }
        $users = $this->HotelPromotions->Users->find('list', ['limit' => 200]);
        $hotelCategories = $this->HotelPromotions->HotelCategories->find('list', ['limit' => 200]);
        $priceMasters = $this->HotelPromotions->PriceMasters->find('list', ['limit' => 200]);
        $this->set(compact('hotelPromotion', 'users', 'hotelCategories', 'priceMasters'));
        $this->set('_serialize', ['hotelPromotion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Hotel Promotion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hotelPromotion = $this->HotelPromotions->get($id);
        if ($this->HotelPromotions->delete($hotelPromotion)) {
            $this->Flash->success(__('The hotel promotion has been deleted.'));
        } else {
            $this->Flash->error(__('The hotel promotion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function report($higestSort = null,$category_id = null,$rating_filter = null,$hotelpromotion_id= null,$savehotelpromotion= null)
    {
		$higestSort=$this->request->query('higestSort');
		$category_id=$this->request->query('category_id');
		$rating_filter=$this->request->query('rating_filter');
		$user_id=$this->Auth->User('id');
		if ($this->request->is(['patch', 'post', 'put'])) 
		{
			//-- Like EVENT
			if(isset($this->request->data['LikeEvent']))
			{
 				$hotelpromotion_id=$this->request->data('hotelpromotion_id');
				$post =[
						'hotel_promotion_id' => $hotelpromotion_id,
						'user_id' =>$user_id						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/hotel_promotions/likeHotelPromotions.json",
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
			//---Remove TaxiFleet Promotion
			if(isset($this->request->data['removehotelpromtion']))
			{
				$hotelpromotion_id=$this->request->data('hotelpromotion_id');
				//pr($taxifleet_id);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/hotel_promotions/removePromotion.json?promotion_id=".$hotelpromotion_id,
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
							//-- Save Unsave
			if(isset($this->request->data['savehotelpromotion']))
			{
 				$hotelpromotion_id=$this->request->data('hotelpromotion_id');
				$post =[
						'hotel_promotion_id' => $hotelpromotion_id,
						'user_id' =>$user_id						 							
					];
				//pr($post);exit;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => $this->coreVariable['SiteUrl']."api/HotelPromotionCarts/HotelPromotionCartAdd.json",
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
        $this->set(compact('user_id','higestSort','category_id','rating_filter'));
	}
}
