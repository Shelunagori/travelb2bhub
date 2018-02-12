<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Countries Controller
 *
 * @property \App\Model\Table\CountriesTable $Countries
 */
class CountriesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $countries = $this->paginate($this->Countries);

        $this->set(compact('countries'));
        $this->set('_serialize', ['countries']);
    }

    /**
     * View method
     *
     * @param string|null $id Country id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $country = $this->Countries->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('country', $country);
        $this->set('_serialize', ['country']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add($id = null)
    {
		$this->viewBuilder()->layout('admin_layout');	
		if(!$id)
		{				
			$country = $this->Countries->newEntity();
		}
		else
		{
			$country = $this->Countries->get($id, [
				'contain' => []
			]);
		}
        if ($this->request->is(['patch','post','put'])) 
		{	
            $country = $this->Countries->patchEntity($country, $this->request->data);
            if ($this->Countries->save($country)) {
                $this->Flash->success(__('The country has been saved.'));

                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The country could not be saved. Please, try again.'));
            }
        }
		//-- View 
		if(isset($this->request->query['search_report'])){
			$CountryName = $this->request->query['CountryName'];
			if(!empty($CountryName)){
				$conditions['Countries.country_name LIKE']='%'.$CountryName.'%';
			}
			$conditions['Countries.is_deleted']=0;
 			$countries = $this->paginate($this->Countries->find()->where($conditions));
  		}
		else {
			$countries = $this->paginate($this->Countries->find()->where(['Countries.is_deleted'=>0]));
		}
		 
        $this->set(compact('country','countries','id'));
        $this->set('_serialize', ['country','countries','id']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Country id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $country = $this->Countries->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $country = $this->Countries->patchEntity($country, $this->request->data);
            if ($this->Countries->save($country)) {
                $this->Flash->success(__('The country has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The country could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('country'));
        $this->set('_serialize', ['country']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Country id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['patch','post', 'put']);
        $country = $this->Countries->get($id);
		$this->request->data['is_deleted']=1;
		$country = $this->Countries->patchEntity($country, $this->request->data());
        if ($this->Countries->save($country)) {
            $this->Flash->success(__('The country has been deleted.'));
        } else {
            $this->Flash->error(__('The country could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'add']);
    }
}
