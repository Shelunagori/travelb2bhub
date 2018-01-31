<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;

class requestsController extends CrudController{

    public function all($entity){
        parent::all($entity); 
//$this->filter = \DataFilter::source(new \App\requests);
$this->filter =\DataFilter::source(\App\requests::with('users'));
			//$this->filter->add('name', 'City Name', 'text');
			//$statesArray = \App\states::lists('state_name', 'id');
			//$statesArray->prepend('Select  State', '');
			//$this->filter->add('state_id', 'State', 'select')->options($statesArray);
			$userArray = \App\users::select(
          DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')
          ->pluck('name', 'id');	
			
			$this->filter->add('reference_id', 'Reference Id', 'text');
			$this->filter->add('user_id', 'User', 'autocomplete')->options($userArray);
			$this->filter->add('total_budget', 'Total Budget', 'text');
			$this->filter->add('status', 'Status', 'select')->option('', 'Select Status')->option('2', 'Finalized')->option('0', 'Open');
			$this->filter->add('is_deleted', 'Removed', 'select')->option('', 'Select Status')->option('1', 'Removed')->option('0', 'Open');
			$this->filter->add('category_id', 'Request Type', 'select')->option('', 'Select Request Type')->option('1', 'Package')->option('2', 'Transport')->option('3', 'Hotel');
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();
			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('reference_id', 'Reference Id');
			$this->grid->add('{{ $users->first_name }} {{ $users->last_name }}' , 'Agent Name');
			$this->grid->add('locality', 'Locality');
			$this->grid->add('total_budget', 'Total Budget',true);
			$this->grid->add('category_id','Request Type')->cell( function( $value, $row) {
			if($value==1) { return "Package";}
			if($value==2 ) { return "Transport";}
			if($value==3 ) { return "Hotel";}
			 });
			$this->grid->add('created', 'Created At',true);
			$this->grid->add('status','Status')->cell( function( $value, $row) {
			if($value==2) { return "Finalized";}
			if($value=="" || $value==0 ) { return "Open";}
			 });
			
			$this->grid->add('is_deleted','Removed')->cell( function( $value, $row) {
			if($value==1) { return "Removed";}
			if($value=="" || $value==0 ) { return "Open";}
			 });
		$this->grid->add('city_id','City')->cell( function( $value, $row) {
			if($value==null OR $value==0) { return "";}else{
				//if('{{$request->category_id}}==1')
				$citiesArray = \App\cities::select(
          DB::raw("name"),'id')
          ->pluck('name', 'id');
		 $cities = $citiesArray;
			return $cities[$value];
			}
			 });
		
		$this->grid->add('state_id','State')->cell( function( $value, $row) {
			if($value==null OR $value==0) { return "";}else{
				$statesArray = \App\states::select(
          DB::raw("state_name"),'id')
          ->pluck('state_name', 'id');
		 $states = $statesArray;
			return $states[$value];
			}	
		});
		
		$this->grid->add('pickup_city','Pickup City')->cell( function( $value, $row) {
			if($value==null OR $value==0) { return "";}else{
				$citiesArray = \App\cities::select(
          DB::raw("name"),'id')
          ->pluck('name', 'id');
		 $cities = $citiesArray;
			return $cities[$value];
			}	
			 });
		
		$this->grid->add('pickup_state','Pickup State')->cell( function( $value, $row) {
			if($value==null OR $value==0) { return "";}else{
				$statesArray = \App\states::select(
          DB::raw("state_name"),'id')
          ->pluck('state_name', 'id');
		 $states = $statesArray;
			return $states[$value];
			}	
		});	
		
			$this->addStylesToGrid();
                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        /* Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields
	*/
			$this->edit = \DataEdit::source(new \App\requests());
			//$this->edit =\DataEdit::source(\App\requests::with('users'));

			$this->edit->label('Request Details');
			
			$userArray = \App\users::select(
          DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')
          ->pluck('name', 'id');

			$this->edit->add('reference_id', 'Reference Id', 'text');
			$this->edit->add('locality', 'Locality', 'text');
			//$this->edit->add('{{ $users->first_name }} {{ $users->last_name }}' , 'Agent Name','text');
			$this->edit->add('user_id','User','select')->options($userArray);
			$this->edit->add('total_budget', 'Total Budget', 'text');
			$this->edit->add('category_id', 'Request Type', 'select')->option('1', 'Package')->option('2', 'Transport')->option('3', 'Hotel');
			//$this->edit->add('category', 'Category', 'select')->option('1', 'Capital City')->option('2', 'Metro')->option('3', 'General');
		
			$statesArray = \App\states::lists('state_name', 'id');
			$statesArray->prepend('Select  State', '');
			$this->edit->add('state_id', 'State', 'select')->options($statesArray);
			$citiesArray = \App\cities::lists('name', 'id');
			$citiesArray->prepend('Select  City', '');
			$this->edit->add('city_id', 'City', 'select')->options($citiesArray);
			$this->edit->add('children', 'Children below 6', 'text');
			$this->edit->add('adult', 'Number of adults', 'text');
			$this->edit->add('room1', 'No. of Rooms single', 'text');
			$this->edit->add('room2', 'No. of Rooms double', 'text');
			$this->edit->add('room3', 'No. of Rooms triple', 'text');
			$this->edit->add('child_with_bed', 'Child with bed', 'text');
			$this->edit->add('child_without_bed', 'Child without bed', 'text');
			
       
        return $this->returnEditView();
    }
    
	public function requestsview($entity)
    {
    	$response = array();
		$requestid =  Input::get('requestid');
		$requests = DB::table('requests')
            ->where('id', $requestid )
          	->get();
    $requests = $requests[0];
    $hotels = array();
    $request_stops = array();
	if($requests->category_id==1 OR $requests->category_id==3){
		$hotels =  DB::table('hotels')
         			 ->selectRaw('*')
         			 ->where('req_id', $requests->id )
          			 ->get();
		}elseif($requests->category_id==2) {
			$request_stops =  DB::table('request_stops')
         			 ->selectRaw('*')
         			 ->where('request_id', $requests->id )
          			 ->get();
		}
		$hotelCategories = array("1"=>"Corporate Hotel", "2"=>"Boutique Hotel", "3"=>"Heritage Hotel", "4"=>"House Boat", "5"=>"Resort", "6"=>"Eco Resort", "7"=>"Farm-stay", "8"=>"Homestay", "9"=>"Heritage Homestay", "10"=>"Camping", "11"=>"Glamping");
		$mealplans = array("1"=>"EP - European Plan", "2"=>"CP - Contenental Plan", "3"=>"MAP - Modified American Plan", "4"=>"AP - American Plan");
	 	$transports = array("1"=>"Luxury Car", "2"=>"Sedan", "3"=>"Innova/ Tavera", "4"=>"Tempo Traveller", "5"=>"AC Coach", "6"=>"Non AC Bus"); 
    $statesArray = \App\states::lists('state_name', 'id');
    $citiesArray = \App\cities::lists('name', 'id');
    $states = $statesArray;
    $cities = $citiesArray;
	 $userid = $requests->user_id;
	 $user =  DB::table('users')
         			 ->selectRaw('first_name, last_name')
         			 ->where('id', $userid )
          			 ->get();
     // return view('tests.show', compact('test'));
	 return \View::make('panelViews::requestsview', compact('requests','response','user','hotels','cities','states','mealplans','hotelCategories','request_stops','transports'));	
    }    
    
}
