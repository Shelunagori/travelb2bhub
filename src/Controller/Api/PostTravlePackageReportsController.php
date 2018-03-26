<?php

namespace App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class PostTravlePackageReportsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    
    public function index()
    {
        $this->paginate = [
            'contain' => ['PostTravlePackages', 'Users', 'ReportReasons']
        ];
        $postTravlePackageReports = $this->paginate($this->PostTravlePackageReports);

        $this->set(compact('postTravlePackageReports'));
        $this->set('_serialize', ['postTravlePackageReports']);
    }

    /**
     * View method
     *
     * @param string|null $id Post Travle Package Report id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $postTravlePackageReport = $this->PostTravlePackageReports->get($id, [
            'contain' => ['PostTravlePackages', 'Users', 'ReportReasons']
        ]);

        $this->set('postTravlePackageReport', $postTravlePackageReport);
        $this->set('_serialize', ['postTravlePackageReport']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function PostTravlePackageReportAdd()
    {
        $postTravlePackageReport = $this->PostTravlePackageReports->newEntity();
        if ($this->request->is('post')) {
            $postTravlePackageReport = $this->PostTravlePackageReports->patchEntity($postTravlePackageReport, $this->request->data);
            if ($this->PostTravlePackageReports->save($postTravlePackageReport)) {
				$message = 'Your report has been submitted successfully';
				$response_code = 200;
			}else{
				$message = 'Your report has not been submitted successfully';
				$response_code = 204;				
			}
        }
        $this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Post Travle Package Report id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $postTravlePackageReport = $this->PostTravlePackageReports->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $postTravlePackageReport = $this->PostTravlePackageReports->patchEntity($postTravlePackageReport, $this->request->data);
            if ($this->PostTravlePackageReports->save($postTravlePackageReport)) {
                $this->Flash->success(__('The post travle package report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post travle package report could not be saved. Please, try again.'));
        }
        $postTravlePackages = $this->PostTravlePackageReports->PostTravlePackages->find('list', ['limit' => 200]);
        $users = $this->PostTravlePackageReports->Users->find('list', ['limit' => 200]);
        $reportReasons = $this->PostTravlePackageReports->ReportReasons->find('list', ['limit' => 200]);
        $this->set(compact('postTravlePackageReport', 'postTravlePackages', 'users', 'reportReasons'));
        $this->set('_serialize', ['postTravlePackageReport']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Post Travle Package Report id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $postTravlePackageReport = $this->PostTravlePackageReports->get($id);
        if ($this->PostTravlePackageReports->delete($postTravlePackageReport)) {
            $this->Flash->success(__('The post travle package report has been deleted.'));
        } else {
            $this->Flash->error(__('The post travle package report could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
