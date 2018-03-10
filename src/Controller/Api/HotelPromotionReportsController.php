<?php
namespace App\Controller\Api;
use App\Controller\Api\AppController;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HotelPromotionReports Controller
 *
 * @property \App\Model\Table\HotelPromotionReportsTable $HotelPromotionReports
 */
class HotelPromotionReportsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['HotelPromotions', 'Users', 'ReportReasons']
        ];
        $hotelPromotionReports = $this->paginate($this->HotelPromotionReports);

        $this->set(compact('hotelPromotionReports'));
        $this->set('_serialize', ['hotelPromotionReports']);
    }

    /**
     * View method
     *
     * @param string|null $id Hotel Promotion Report id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $hotelPromotionReport = $this->HotelPromotionReports->get($id, [
            'contain' => ['HotelPromotions', 'Users', 'ReportReasons']
        ]);

        $this->set('hotelPromotionReport', $hotelPromotionReport);
        $this->set('_serialize', ['hotelPromotionReport']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */

    public function HotelPromotionReportAdd()
    {
        $hotelPromotionReport = $this->HotelPromotionReports->newEntity();
        if ($this->request->is('post')) {
            $hotelPromotionReport = $this->HotelPromotionReports->patchEntity($hotelPromotionReport, $this->request->data);
            if ($this->HotelPromotionReports->save($hotelPromotionReport)) {
                $message = 'The Hotel Promotion Report has been saved';
				$response_code = 200;
			}else{
				 
				$message = 'The Hotel Promotion Report has not been saved';
				$response_code = 204;
			}
        }
        $this->set(compact('message','response_code'));
        $this->set('_serialize', ['message','response_code']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Hotel Promotion Report id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $hotelPromotionReport = $this->HotelPromotionReports->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $hotelPromotionReport = $this->HotelPromotionReports->patchEntity($hotelPromotionReport, $this->request->data);
            if ($this->HotelPromotionReports->save($hotelPromotionReport)) {
                $this->Flash->success(__('The hotel promotion report has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The hotel promotion report could not be saved. Please, try again.'));
            }
        }
        $hotelPromotions = $this->HotelPromotionReports->HotelPromotions->find('list', ['limit' => 200]);
        $users = $this->HotelPromotionReports->Users->find('list', ['limit' => 200]);
        $reportReasons = $this->HotelPromotionReports->ReportReasons->find('list', ['limit' => 200]);
        $this->set(compact('hotelPromotionReport', 'hotelPromotions', 'users', 'reportReasons'));
        $this->set('_serialize', ['hotelPromotionReport']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Hotel Promotion Report id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $hotelPromotionReport = $this->HotelPromotionReports->get($id);
        if ($this->HotelPromotionReports->delete($hotelPromotionReport)) {
            $this->Flash->success(__('The hotel promotion report has been deleted.'));
        } else {
            $this->Flash->error(__('The hotel promotion report could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
