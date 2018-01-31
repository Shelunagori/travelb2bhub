<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;


class promotionController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        /** Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields */


			$this->filter =\DataFilter::source(\App\promotion::with('users'));
		
			$this->filter->add('hotel_name', 'Hotel Name', 'text');
		  $this->filter->add('status', 'Status','radiogroup')->option('1', 'Active')->option('0', 'Deactive');
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();
			$this->grid = \DataGrid::source($this->filter);
			
			$this->grid->add('{{ $users->first_name }} {{ $users->last_name }}' , 'Hotelier Name');
		$this->grid->add('{{ $users->email }}' , 'Hotelier Email');
			$this->grid->add('hotel_name', 'Hotel Name');
		$this->grid->add('duration', 'Duration (In Month)');
		$this->grid->add('expiry_date', 'Expires On');
			
			$this->grid->add('cheap_tariff', 'Cheap Tariff', true);
         $this->grid->add('expensive_tariff', 'Expensive Tariff', true);
			$this->addStylesToGrid();
			$this->grid->paginate(100);
		
			
			$this->grid->add('status','Status')->cell( function( $value, $row) {
				if($value==1) { return "Active";}
				if($value=="" || $value==0 ) { return "Deactive";}
				 });
        	return $this->returnView();
    }

    public function  edit($entity){

        parent::edit($entity);
$id =  Input::get('show');
        /* Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields
        */
         	//$this->edit = \DataEdit::source(\App\promotion::with('users','cities'));
			$this->edit = \DataEdit::source(new \App\promotion());
			$this->edit->label('Edit Promotion');
			$userArray = \App\users::select(
          DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')
          ->where('role_id','3')
          ->pluck('name', 'id');
          
         $cityArray = \App\cities::select(
          DB::raw("CONCAT(id,'-',price) AS id"),'name')
          ->pluck('name', 'id');
        if(!empty($id)){
		$this->edit->add('user_id','User','select')->options($userArray)->rule('required');
		}else{
          $this->edit->add('user_id','User','autocomplete')->options($userArray)->rule('required');
		}
          $this->edit->add('hotel_name', 'Hotel Name', 'text')->rule('required');
          $this->edit->add('hotel_location', 'Hotel Location', 'text')->rule('required');
          $this->edit->add('hotel_type', 'Hotel Type', 'select')->options(array(''=>'Select Hotel Type','1' =>'Corporate Hotel ','2' =>'Boutique Hotel','3' =>'Heritage Hotel','4' =>'House Boat', '5' => 'Resort', '6' => 'Eco Resort' , '7' => 'Farm-stay' , '8' => 'Homestay' , '9' => 'Heritage Homestay' , '10' => 'Camping', '11' => 'Glamping'))->rule('required');
          $this->edit->add('cheap_tariff', 'Cheap Tariff', 'number')->rule('required');
          $this->edit->add('expensive_tariff', 'Expensive Tariff', 'number')->rule('required');
          $this->edit->add('website', 'Hotel Website', 'text')->rule('required');
 			 $this->edit->add('cities','City','Multiselect')->options(\App\cities::lists('name', 'id','price')->all());
 			 //$this->edit->add('cities','city','Multiselect')->options($cityArray);
 			 //$this->edit->add('citycharge','city','Multiselect')->options($cityArray);
		$this->edit->add('expiry_date', 'Expires On', 'text')->rule('required');
 			 $this->edit->add('charges', 'Charges', 'number')->rule('required');
          $this->edit->add('duration', 'Duration (in Months)', 'number')->rule('required');
         $this->edit->add('hotel_pic', 'Hotel image', 'image')->move('../../webroot/img/hotels/')->preview(100,100);
			return $this->returnEditView();
			
    }
}
