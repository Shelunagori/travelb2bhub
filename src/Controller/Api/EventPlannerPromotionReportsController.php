<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
/**
 * EventPlannerPromotionReports Controller
 *
 * @property \App\Model\Table\EventPlannerPromotionReportsTable $EventPlannerPromotionReports
 */
class EventPlannerPromotionReportsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['EventPlannerPromotions', 'Users', 'ReportReasons']
        ];
        $eventPlannerPromotionReports = $this->paginate($this->EventPlannerPromotionReports);

        $this->set(compact('eventPlannerPromotionReports'));
        $this->set('_serialize', ['eventPlannerPromotionReports']);
    }

    /**
     * View method
     *
     * @param string|null $id Event Planner Promotion Report id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $eventPlannerPromotionReport = $this->EventPlannerPromotionReports->get($id, [
            'contain' => ['EventPlannerPromotions', 'Users', 'ReportReasons']
        ]);

        $this->set('eventPlannerPromotionReport', $eventPlannerPromotionReport);
        $this->set('_serialize', ['eventPlannerPromotionReport']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function EventPlannerPromotionReportAdd()
    {
        $eventPlannerPromotionReport = $this->EventPlannerPromotionReports->newEntity();
        if ($this->request->is('post')) {
            $eventPlannerPromotionReport = $this->EventPlannerPromotionReports->patchEntity($eventPlannerPromotionReport, $this->request->data);
            if ($this->EventPlannerPromotionReports->save($eventPlannerPromotionReport)) {
                $message = 'The Event Planner Promotion Report has been saved';
				$response_code = 200;
			}else{
				$message = 'The Event Planner Promotion Report has not been saved';
				$response_code = 204;
			}
        }
        $this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Event Planner Promotion Report id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $eventPlannerPromotionReport = $this->EventPlannerPromotionReports->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $eventPlannerPromotionReport = $this->EventPlannerPromotionReports->patchEntity($eventPlannerPromotionReport, $this->request->data);
            if ($this->EventPlannerPromotionReports->save($eventPlannerPromotionReport)) {
                $this->Flash->success(__('The event planner promotion report has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event planner promotion report could not be saved. Please, try again.'));
        }
        $eventPlannerPromotions = $this->EventPlannerPromotionReports->EventPlannerPromotions->find('list', ['limit' => 200]);
        $users = $this->EventPlannerPromotionReports->Users->find('list', ['limit' => 200]);
        $reportReasons = $this->EventPlannerPromotionReports->ReportReasons->find('list', ['limit' => 200]);
        $this->set(compact('eventPlannerPromotionReport', 'eventPlannerPromotions', 'users', 'reportReasons'));
        $this->set('_serialize', ['eventPlannerPromotionReport']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Event Planner Promotion Report id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $eventPlannerPromotionReport = $this->EventPlannerPromotionReports->get($id);
        if ($this->EventPlannerPromotionReports->delete($eventPlannerPromotionReport)) {
            $this->Flash->success(__('The event planner promotion report has been deleted.'));
        } else {
            $this->Flash->error(__('The event planner promotion report could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
