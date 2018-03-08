<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TaxiFleetPromotions Controller
 *
 * @property \App\Model\Table\TaxiFleetPromotionsTable $TaxiFleetPromotions
 */
class TaxiFleetPromotionsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null*/
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
            'contain' => ['Countries', 'PriceMasters', 'Users','TaxiFleetPromotionRows','TaxiFleetPromotionCities','TaxiFleetPromotionStates']
        ];
        $taxiFleetPromotions = $this->paginate($this->TaxiFleetPromotions);
		//pr($taxiFleetPromotions->toArray());exit;
        $this->set(compact('taxiFleetPromotions'));
        $this->set('_serialize', ['taxiFleetPromotions']);
    }

    /**
     * View method
     *
     * @param string|null $id Taxi Fleet Promotion id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('user_layout');
        $taxiFleetPromotion = $this->TaxiFleetPromotions->get($id, [
            'contain' => ['Countries', 'PriceMasters', 'Users', 'TaxiFleetPromotionCities'=>['Cities'], 'TaxiFleetPromotionRows', 'TaxiFleetPromotionStates'=>['States']]
        ]);
        $this->set('taxiFleetPromotion', $taxiFleetPromotion);
        $this->set('_serialize', ['taxiFleetPromotion']);
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
        /* if ($this->request->is('post'))
			{
				$taxiFleetPromotion = $this->TaxiFleetPromotions->patchEntity($taxiFleetPromotion, $this->request->data);
				// Call Curl FOR FB DETAILS
				
				$state_id=$this->request->data['state_id'];
				$x=0;
				$array_of_state=array();
				foreach($state_id as $state)
				{
					$array_of_state['taxi_fleet_promotion_states['.$x.']["state_id"]']=$state_id[$x];
					$x++;	
				}
				
				$city_id=$this->request->data['city_id'];
				$y=0;
				$array_of_cities=array();
				foreach($city_id as $city)
				{
					$array_of_cities['taxi_fleet_promotion_cities['.$y.']["city_id"]']=$city_id[$y];
					$y++;	
				}
				$vehicle_type=$this->request->data['vehicle_type'];
				$z=0;
				$array_of_vehicles=array();
				//pr($city_id);
				foreach($vehicle_type as $vehicle)
				{
					$array_of_vehicles['taxi_fleet_promotion_rows['.$z.']["taxi_fleet_car_bus_id"]']=$vehicle_type[$z];
					$z++;	
				}
							 
							$post =[
								'company_name' => $this->request->data['company_name'],
								'user_id' => $UserId,
								'title' =>$this->request->data['title'],
								'image' =>$this->request->data['image'],
								'document' =>$this->request->data['document'],
								'vehicle_type' =>$this->request->data['vehicle_type'],									
								'country_id' =>$this->request->data['country_id'],			 									
								'fleet_detail' =>$this->request->data['fleet_detail'],									
								'price_master_id' =>$this->request->data['price_master_id'],									
								'visible_date' =>$this->request->data['visible_date'],									
								'payment_amount' =>$this->request->data['payment_amount'],									
							];
							$post=array_merge($post,$array_of_vehicles);
							$post=array_merge($post,$array_of_cities);
							$post=array_merge($post,$array_of_state);
							pr($post); 
							$headers = array("Content-Type:multipart/form-data");
							$ch = curl_init('http://konciergesolutions.com/travelb2bhub/api/taxi_fleet_promotions/add.json');
							curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
							curl_setopt($ch, CURLOPT_HEADER, 1);
							$result = curl_exec($ch);
							curl_close($ch);
 
							pr($result);
						exit;
							
				  if ($this->TaxiFleetPromotions->save($taxiFleetPromotion)) {
					$this->Flash->success(__('The taxi fleet promotion has been saved.'));

					return $this->redirect(['action' => 'index']);
				}

				$this->Flash->error(__('The taxi fleet promotion could not be saved. Please, try again.'));  
			}
			*/
		/*$city = $this->TaxiFleetPromotions->Users->Cities->find('list');
		$company = $this->TaxiFleetPromotions->Users->find('all');
		//pr($company->toArray());exit;
		$states = $this->TaxiFleetPromotions->Users->States->find('list', ['limit' => 200])->where(['country_id'=>'101']);
		$cat = $this->TaxiFleetPromotions->TaxiFleetPromotionRows->TaxiFleetCarBuses->find('list');
		//pr($cat->toArray());exit;
        $countries = $this->TaxiFleetPromotions->Countries->find('list', ['limit' => 200]);
        $priceMasters = $this->TaxiFleetPromotions->PriceMasters->find('all', ['limit' => 200])->where(['promotion_type_id'=>2]);
		$users = $this->TaxiFleetPromotions->Users->find()->where(['id'=>$UserId])->first();
        $this->set(compact('taxiFleetPromotion', 'countries', 'priceMasters', 'users','states','company','city','cat'));
        $this->set('_serialize', ['taxiFleetPromotion']);
		*/
    }

    /**
     * Edit method
     *
     * @param string|null $id Taxi Fleet Promotion id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $taxiFleetPromotion = $this->TaxiFleetPromotions->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $taxiFleetPromotion = $this->TaxiFleetPromotions->patchEntity($taxiFleetPromotion, $this->request->data);
            if ($this->TaxiFleetPromotions->save($taxiFleetPromotion)) {
                $this->Flash->success(__('The taxi fleet promotion has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The taxi fleet promotion could not be saved. Please, try again.'));
        }
        $countries = $this->TaxiFleetPromotions->Countries->find('list', ['limit' => 200]);
        $priceMasters = $this->TaxiFleetPromotions->PriceMasters->find('list', ['limit' => 200]);
        $users = $this->TaxiFleetPromotions->Users->find('list', ['limit' => 200]);
        $this->set(compact('taxiFleetPromotion', 'countries', 'priceMasters', 'users'));
        $this->set('_serialize', ['taxiFleetPromotion']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Taxi Fleet Promotion id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $taxiFleetPromotion = $this->TaxiFleetPromotions->get($id);
        if ($this->TaxiFleetPromotions->delete($taxiFleetPromotion)) {
            $this->Flash->success(__('The taxi fleet promotion has been deleted.'));
        } else {
            $this->Flash->error(__('The taxi fleet promotion could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	 public function report()
    {
        $this->viewBuilder()->layout('user_layout');
        $this->paginate = [
            'contain' => ['Countries', 'PriceMasters', 'Users','TaxiFleetPromotionRows','TaxiFleetPromotionCities','TaxiFleetPromotionStates']
        ];
        $taxiFleetPromotions = $this->paginate($this->TaxiFleetPromotions);
		pr($taxiFleetPromotions->toArray());exit;
        $this->set(compact('taxiFleetPromotions'));
        $this->set('_serialize', ['taxiFleetPromotions']);
    }
	
}
