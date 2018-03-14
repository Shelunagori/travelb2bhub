<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

/**
 * PostTravlePackageCarts Controller
 *
 * @property \App\Model\Table\PostTravlePackageCartsTable $PostTravlePackageCarts
 */
class PostTravlePackageCartsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PostTravlePackages', 'Users']
        ];
        $postTravlePackageCarts = $this->paginate($this->PostTravlePackageCarts);

        $this->set(compact('postTravlePackageCarts'));
        $this->set('_serialize', ['postTravlePackageCarts']);
    }

    /**
     * View method
     *
     * @param string|null $id Post Travle Package Cart id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $postTravlePackageCart = $this->PostTravlePackageCarts->get($id, [
            'contain' => ['PostTravlePackages', 'Users']
        ]);

        $this->set('postTravlePackageCart', $postTravlePackageCart);
        $this->set('_serialize', ['postTravlePackageCart']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function postTravlePackageCartAdd()
    {
        $postTravlePackageCart = $this->PostTravlePackageCarts->newEntity();
        if ($this->request->is('post')) {
			
			$user_id=$this->request->data('user_id');
			$post_travle_package_id=$this->request->data('post_travle_package_id');
            
			$data_count=$this->PostTravlePackageCarts->find()->where(['post_travle_package_id'=>$post_travle_package_id,'user_id'=>$user_id,'is_deleted'=>0])->count();

			if(empty($data_count)){
				$postTravlePackageCart = $this->PostTravlePackageCarts->patchEntity($postTravlePackageCart, $this->request->data);
				if ($this->PostTravlePackageCarts->save($postTravlePackageCart)) {

						$message = 'The post travel package Cart has been saved';
						$response_code = 200;
					}else{
						$message = 'The post travel package Cart has not been saved';
						$response_code = 204;				
					}	
			}else{
				
				$query = $this->PostTravlePackageCarts->query();
					$query->update()
							->set(['is_deleted' => 1])
							->where(['post_travle_package_id'=>$post_travle_package_id,'user_id'=>$user_id])
							->execute();
						$message = 'The post travel package Cart has been Deleted';
						$response_code = 300;
			}		
        }
		$this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);
    }
	
	
	public function postTravlePackageCartlist($user_id=null)
	{
		
		$user_id = $this->request->query('user_id');
		if(!empty($user_id))
		{
			$postTravelPackageCarts=$this->PostTravlePackageCarts->find()->where(['PostTravlePackageCarts.user_id'=>$user_id, 'PostTravlePackageCarts.is_deleted'=>0])->contain(['PostTravlePackages'=>['Users'=>function($q){
				return $q->select(['first_name','last_name','mobile_number','company_name']);
			},'PostTravlePackageCities'=>['Cities'],'PostTravlePackageRows'=>['PostTravlePackageCategories']]]);
			 
			if(!empty($postTravelPackageCarts->toArray())){
				
				foreach($postTravelPackageCarts as $data){
		 
		 $post_travle_package_id=$data->post_travle_package_id;
				
				$data->total_likes = $this->PostTravlePackageCarts->PostTravlePackages->PostTravlePackageLikes
							->find()->where(['post_travle_package_id' => $post_travle_package_id])->count();					
					$exists = $this->PostTravlePackageCarts->PostTravlePackages->PostTravlePackageLikes->exists(['post_travle_package_id'=>$post_travle_package_id,'user_id'=>$user_id]);
					if($exists == 1)
					{ $data->isLiked = 'yes'; }
					else { $data->isLiked = 'no'; }

					$carts = $this->PostTravlePackageCarts->PostTravlePackages->PostTravlePackageCarts->exists(['PostTravlePackageCarts.post_travle_package_id'=>$post_travle_package_id,'PostTravlePackageCarts.user_id'=>$user_id,'PostTravlePackageCarts.is_deleted'=>0]);
					if($carts==0){
						$data->issaved=false;
					}else{
						$data->issaved=true;
					}	
					
					$data->total_views = $this->PostTravlePackageCarts->PostTravlePackages->PostTravlePackageViews
						->find()->where(['post_travle_package_id' => $post_travle_package_id])->count();
						
					$all_raiting=0;	
					$testimonial=$this->PostTravlePackageCarts->PostTravlePackages->Users->Testimonial->find()->where(['Testimonial.user_id'=>$data->post_travle_package->user_id]);
					$testimonial_count=$this->PostTravlePackageCarts->PostTravlePackages->Users->Testimonial->find()->where(['Testimonial.user_id'=>$data->post_travle_package->user_id])->count();
						 
						 foreach($testimonial as $test_data){
							 
							 $rating=$test_data->rating;
							 $all_raiting+=$rating;
						 }
						 if($testimonial_count>0){
							 $final_raiting=($all_raiting/$testimonial_count);
							 if($final_raiting>0){
								$data->user_rating=number_format($final_raiting, 1);
							 }else{
								 $data->user_rating=0;
							 }
						 }else{
							 $data->user_rating=0;
						 }
						  
				}
				$message = 'Post Travle Carts List Found Successfully';
				$response_code = 200;
			}
			else
			{
				$message = 'No Content Found';
				$postTravelPackageCarts = [];
				$response_code = 204;
			}			
		}		
		else
		{
			$message = 'Post Travle Carts is empty';
			$postTravelPackageCarts = [];
			$response_code = 300;
		}		
		$this->set(compact('postTravelPackageCarts','message','response_code'));
        $this->set('_serialize', ['postTravelPackageCarts','message','response_code']);		
	}

	 public function PostTravlePackageCartDelete($id = null)
    {
		
		$deleted_id=$this->request->query['id'];
        $PostTravlePackageCart = $this->PostTravlePackageCarts->get($deleted_id, [
            'contain' => []
        ]); 
		
        if ($this->request->is(['GET'])) {
			$this->request->data['is_deleted']=1;
            $PostTravlePackageCart = $this->PostTravlePackageCarts->patchEntity($PostTravlePackageCart, $this->request->data);
            if ($this->PostTravlePackageCarts->save($PostTravlePackageCart)){
					$message = 'Post Travle Carts Deleted Successfully';
					$response_code = 200;
            }else{
				$message = 'Post Travle Carts Not Deleted';
				$postTravelPackageCarts = [];
				$response_code = 204;	
			}
			 $this->set(compact('postTravelPackageCarts','message','response_code'));
			$this->set('_serialize', ['postTravelPackageCarts','message','response_code']);	
        }
		 
    }
	
    /**
     * Edit method
     *
     * @param string|null $id Post Travle Package Cart id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $postTravlePackageCart = $this->PostTravlePackageCarts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postTravlePackageCart = $this->PostTravlePackageCarts->patchEntity($postTravlePackageCart, $this->request->data);
            if ($this->PostTravlePackageCarts->save($postTravlePackageCart)) {
                $this->Flash->success(__('The post travle package cart has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post travle package cart could not be saved. Please, try again.'));
        }
        $postTravlePackages = $this->PostTravlePackageCarts->PostTravlePackages->find('list', ['limit' => 200]);
        $users = $this->PostTravlePackageCarts->Users->find('list', ['limit' => 200]);
        $this->set(compact('postTravlePackageCart', 'postTravlePackages', 'users'));
        $this->set('_serialize', ['postTravlePackageCart']);
    }

	
    /**
     * Delete method
     *
     * @param string|null $id Post Travle Package Cart id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $postTravlePackageCart = $this->PostTravlePackageCarts->get($id);
        if ($this->PostTravlePackageCarts->delete($postTravlePackageCart)) {
            $this->Flash->success(__('The post travle package cart has been deleted.'));
        } else {
            $this->Flash->error(__('The post travle package cart could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
