<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TaxiFleetPromotionReports Controller
 *
 * @property \App\Model\Table\TaxiFleetPromotionReportsTable $TaxiFleetPromotionReports
 */
class TaxiFleetPromotionReportsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['TaxiFleetPromotions', 'Users', 'ReportReasons']
        ];
        $taxiFleetPromotionReports = $this->paginate($this->TaxiFleetPromotionReports);

        $this->set(compact('taxiFleetPromotionReports'));
        $this->set('_serialize', ['taxiFleetPromotionReports']);
    }

    /**
     * View method
     *
     * @param string|null $id Taxi Fleet Promotion Report id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $taxiFleetPromotionReport = $this->TaxiFleetPromotionReports->get($id, [
            'contain' => ['TaxiFleetPromotions', 'Users', 'ReportReasons']
        ]);

        $this->set('taxiFleetPromotionReport', $taxiFleetPromotionReport);
        $this->set('_serialize', ['taxiFleetPromotionReport']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function TaxiFleetPromotionReportAdd()
    {
        $taxiFleetPromotionReport = $this->TaxiFleetPromotionReports->newEntity();
        if ($this->request->is('post')) {
            $taxiFleetPromotionReport = $this->TaxiFleetPromotionReports->patchEntity($taxiFleetPromotionReport, $this->request->data);
            if ($this->TaxiFleetPromotionReports->save($taxiFleetPromotionReport)) {
                $message = 'The Taxi Fleet Promotion Report has been saved';
				$response_code = 200;
			}else{
				$message = 'The Taxi Fleet Promotion Report has not been saved';
				$response_code = 204;
			}
        }
        $this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Taxi Fleet Promotion Report id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $taxiFleetPromotionReport = $this->TaxiFleetPromotionReports->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $taxiFleetPromotionReport = $this->TaxiFleetPromotionReports->patchEntity($taxiFleetPromotionReport, $this->request->data);
            if ($this->TaxiFleetPromotionReports->save($taxiFleetPromotionReport)) {
                $this->Flash->success(__('The taxi fleet promotion report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The taxi fleet promotion report could not be saved. Please, try again.'));
        }
        $taxiFleetPromotions = $this->TaxiFleetPromotionReports->TaxiFleetPromotions->find('list', ['limit' => 200]);
        $users = $this->TaxiFleetPromotionReports->Users->find('list', ['limit' => 200]);
        $reportReasons = $this->TaxiFleetPromotionReports->ReportReasons->find('list', ['limit' => 200]);
        $this->set(compact('taxiFleetPromotionReport', 'taxiFleetPromotions', 'users', 'reportReasons'));
        $this->set('_serialize', ['taxiFleetPromotionReport']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Taxi Fleet Promotion Report id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $taxiFleetPromotionReport = $this->TaxiFleetPromotionReports->get($id);
        if ($this->TaxiFleetPromotionReports->delete($taxiFleetPromotionReport)) {
            $this->Flash->success(__('The taxi fleet promotion report has been deleted.'));
        } else {
            $this->Flash->error(__('The taxi fleet promotion report could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
