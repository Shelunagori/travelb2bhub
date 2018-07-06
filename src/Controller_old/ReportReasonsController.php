<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ReportReasons Controller
 *
 * @property \App\Model\Table\ReportReasonsTable $ReportReasons
 */
class ReportReasonsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PromotionTypes']
        ];
        $reportReasons = $this->paginate($this->ReportReasons);

        $this->set(compact('reportReasons'));
        $this->set('_serialize', ['reportReasons']);
    }

    /**
     * View method
     *
     * @param string|null $id Report Reason id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reportReason = $this->ReportReasons->get($id, [
            'contain' => ['PromotionTypes', 'EventPlannerPromotionReports', 'PostTravlePackageReports', 'TaxiFleetPromotionReports']
        ]);

        $this->set('reportReason', $reportReason);
        $this->set('_serialize', ['reportReason']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reportReason = $this->ReportReasons->newEntity();
        if ($this->request->is('post')) {
            $reportReason = $this->ReportReasons->patchEntity($reportReason, $this->request->data);
            if ($this->ReportReasons->save($reportReason)) {
                $this->Flash->success(__('The report reason has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The report reason could not be saved. Please, try again.'));
        }
        $promotionTypes = $this->ReportReasons->PromotionTypes->find('list', ['limit' => 200]);
        $this->set(compact('reportReason', 'promotionTypes'));
        $this->set('_serialize', ['reportReason']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Report Reason id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reportReason = $this->ReportReasons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reportReason = $this->ReportReasons->patchEntity($reportReason, $this->request->data);
            if ($this->ReportReasons->save($reportReason)) {
                $this->Flash->success(__('The report reason has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The report reason could not be saved. Please, try again.'));
        }
        $promotionTypes = $this->ReportReasons->PromotionTypes->find('list', ['limit' => 200]);
        $this->set(compact('reportReason', 'promotionTypes'));
        $this->set('_serialize', ['reportReason']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Report Reason id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reportReason = $this->ReportReasons->get($id);
        if ($this->ReportReasons->delete($reportReason)) {
            $this->Flash->success(__('The report reason has been deleted.'));
        } else {
            $this->Flash->error(__('The report reason could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
