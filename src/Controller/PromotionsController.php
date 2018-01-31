<?php

namespace App\Controller;

use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Datasource\ConnectionManager;

/**
 * Promotions Controller
 *
 * @property \App\Model\Table\PromotionsTable $Promotions
 */
class PromotionsController extends AppController {
var $helpers = array('Html', 'Form');
   

public function addPromotion(){
date_default_timezone_set('Asia/Kolkata');
    
      if ($this->request->is(['post', 'put'])) {
      	 
$PromotionsTable = TableRegistry::get('Promotion');
$Promotion = $PromotionsTable->newEntity();
      	//print_r($this->request->data);
      	
      	if(is_uploaded_file($this->request->data['hotel_pic']['tmp_name']) && !empty($this->request->data['hotel_pic']['tmp_name']))
			{
				$path_info = pathinfo($this->request->data['hotel_pic']['name']);
				chmod ($this->request->data['hotel_pic']['tmp_name'], 0644);
				$photo=time().mt_rand().".".$path_info['extension'];
				$fullpath= WWW_ROOT."img".DS."hotels";
				$res1 = is_dir($fullpath);
				if($res1 != 1) {
					$res2= mkdir($fullpath, 0777, true);
				}
				move_uploaded_file($this->request->data['hotel_pic']['tmp_name'],$fullpath.DS.$photo);
			      //$this->request->data['hotel_pic'] = $photo;
			}
			else {
                                $photo = "";
				unset($this->request->data['hotel_pic']);
			}
			
			//print_r($this->request->data['city']);
			
			
			
			$Promotion->user_id = $this->request->data['user_id'];
			$Promotion->hotel_name =  $this->request->data['hotel_name'];
$Promotion->hotel_location =  $this->request->data['hotel_location'];
			$Promotion->hotel_type =  $this->request->data['hotel_categories'];
			$Promotion->cheap_tariff =  $this->request->data['cheap_tariff'];
			$Promotion->expensive_tariff =  $this->request->data['expensive_tariff'];
			$Promotion->website =  $this->request->data['website'];
			
			if(isset($this->request->data['city']) && count($this->request->data['city']) > 0)
			{
			$cityval1 =array();
			foreach($this->request->data['city'] as $cityval){
			$citysingle = explode('-',$cityval);
			//print_r($citysingle[0] );
			$cityval1[] = $citysingle[0];
			}
			$Promotion->cities =  implode(',',$cityval1);
			$Promotion->citycharge =  implode(',',$this->request->data['city']);
			
			$Promotion->duration =  $this->request->data['duration'];
$total_days = 30*$Promotion->duration;
//$Promotion->expiry_date = date('Y-m-d H:i:s', strtotime('+'.$this->request->data['duration'].' months'));
			$Promotion->expiry_date = date('Y-m-d H:i:s', strtotime('+'.$total_days.' days'));
			$Promotion->charges =  $this->request->data['charges'];
			}
			$Promotion->hotel_name =  $this->request->data['hotel_name'];
			if(isset($Promotion->hotel_pic)){
			$Promotion->hotel_pic =  $this->request->data['hotel_pic']['name'];
		}
                        $Promotion->hotel_pic = $photo;
			$Promotion->payment_status =  'pending';
			$Promotion->status =  '1';
			$Promotion->created_at = date("Y-m-d H:i:s");

			if ($PromotionsTable->save($Promotion)) {

    		$id = $Promotion->id;
    		return $this->redirect('/pages/promotionthanks');
			}      
    }
    }
    
public function checkcitystatus () {
date_default_timezone_set('Asia/Kolkata');
if ($this->request->is(['post'])) {
$customduration = 12;
	$user_id = $this->request->data['user_id'];
	$city_id = $this->request->data['city_id'];
	$duration = $this->request->data['duration'];
$total_days = 30*$customduration;
	$conn = ConnectionManager::get('default');
	$start_date = date('Y-m-d H:i:s');
	$expiry_date = date('Y-m-d H:i:s', strtotime('+'.$total_days.' days'));
	$sql = "SELECT * FROM promotion WHERE 
	(expiry_date BETWEEN '".$start_date."' AND '".$expiry_date."')	AND
	user_id='".$user_id."' AND FIND_IN_SET ('".$city_id."', cities) > 0 ";
	$stmt = $conn->execute($sql);
	$result = $stmt ->fetchAll('assoc');
	if(count($result)==0){
		echo '1';
	}else{
		$query ="Select name FROM cities where id='".$city_id."'";
		$stmt = $conn->execute($query);
		$result = $stmt ->fetch('assoc');
		$city_name = $result['name'];
		echo "Promotion is already running for $city_name, please choose another city.";
	}
	die();
	}
}
    
public function addpromotionapi(){
    
      if ($_POST) {
$PromotionsTable = TableRegistry::get('Promotion');
$Promotion = $PromotionsTable->newEntity();
      	//print_r($this->request->data);
					if(!empty($_POST['hotel_pic']))
					{
						$hotel_pic = $_POST['hotel_pic'];
						$id=time().mt_rand().".png";
						$path =  WWW_ROOT."img".DS."hotels";
						file_put_contents($path,base64_decode($hotel_pic));
						$_POST['hotel_pic'] = $id;
					}
					else {
					unset($_POST['hotel_pic']);
					}
			$Promotion->user_id = $_POST['user_id'];
			$Promotion->hotel_name =  $_POST['hotel_name'];
			$Promotion->hotel_type =  $_POST['hotel_categories'];
			$Promotion->cheap_tariff =  $_POST['cheap_tariff'];
$Promotion->hotel_location =  $this->request->data['hotel_location'];
			$Promotion->expensive_tariff =  $_POST['expensive_tariff'];
			$Promotion->website =  $_POST['website'];
			
			
			$Promotion->cities =   $_POST['cityid'];
			$Promotion->citycharge =   $_POST['citycharge'];
			
			$Promotion->duration =  $_POST['duration'];
			$Promotion->expiry_date = date('Y-m-d H:i:s', strtotime('+'.$_POST['duration'].' months'));
			$Promotion->charges =  $_POST['charges'];
			
			$Promotion->hotel_name = $_POST['hotel_name'];
		
			$Promotion->payment_status =  'pending';
			$Promotion->status =  '1';
			$Promotion->created_at = date("Y-m-d H:i:s");

			if ($PromotionsTable->save($Promotion)) {

    	
    		$result['response_code'] = 200;
			$result['response_object'] = "Success";
    		$data =   json_encode($result);
      	echo $data;
      	exit;
			}
}
    }


}