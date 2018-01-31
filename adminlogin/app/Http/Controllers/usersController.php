<?php 

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class usersController extends CrudController{

    public function all($entity){
        parent::all($entity); 
		//	$this->filter = \DataFilter::source(new \App\users);
		$this->filter =\DataFilter::source(\App\users::with('cities','states'));
			$this->filter->add('first_name', 'Name', 'text');
			$this->filter->add('mobile_number', 'Mobile Number', 'text');
			$this->filter->add('email', 'Email', 'text');
			$membershipArray = \App\membership::where('status', 1)->lists('membership_name', 'id');
			$membershipArray->prepend('Select User category', '');
       	$this->filter->add('role_id', 'User Category', 'select')->options($membershipArray);
			$this->filter->add('status', 'Status', 'select')->option('', 'Select Status')->option('1', 'Active')->option('0', 'Deactive');
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();
			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('{{$first_name}} {{$last_name}}', 'Name');
		$this->grid->add('{{ $states->state_name }}' , 'State');
			$this->grid->add('{{ $cities->name }}' , 'City');
			$this->grid->add('mobile_number', 'Mobile Number');
			$this->grid->add('email', 'Email');
			$this->grid->add('role_id','Role')->cell( function( $value, $row) {
			if($value==1) { return "Travel Agent";}
			if($value==2) { return "Event Planner";}
			if($value==3) { return "Hotelier";}
			 });
			$this->grid->add('status','Status')->cell( function( $value, $row) {
			if($value==1) { return "Active";}
			if($value=="" || $value==0 ) { return "Deactive";}
			 }); 
			
			$this->addStylesToGrid();
			$this->grid->paginate(50);
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);
		$users = array();
		
	 $id =  Input::get('show');
	$editid =  Input::get('modify');
	if(!empty($id)){
		$users = DB::table('users')
            ->where('id', $id )
          	->get();
    $users = $users[0];
	}elseif(!empty($editid))
	{
	$users = DB::table('users')
            ->where('id', $editid )
          	->get();
    $users = $users[0];
	}
        /* Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields  */
	
			$this->edit = \DataEdit::source(new \App\users());
		
			$this->edit->label('Edit Users');

			$this->edit->add('first_name', 'First Name', 'text');
			$this->edit->add('last_name', 'Last Name', 'text');
			$membershipArray = \App\membership::where('status', 1)->lists('membership_name', 'id');
			$membershipArray->prepend('Select User category', '');
			$this->edit->add('role_id', 'User Category', 'select')->options($membershipArray);
			$this->edit->add('mobile_number', 'Mobile Number', 'text');
			$this->edit->add('p_contact', 'Secondary contact', 'text');
			$this->edit->add('email', 'Email', 'text');
			$this->edit->add('status', 'Status','radiogroup')->option('1', 'Active')->option('0', 'Deactive');
			$this->edit->add('address', 'Address Line 1', 'textarea');
			$this->edit->add('adress1', 'Address Line 2', 'textarea');
			$this->edit->add('locality', 'Locality', 'text');
			//	$this->edit->add('users.first_name', 'City', 'autocomplete')->search(array('first_name'));
if(!empty($id)){
			$this->edit->add('city_id','city','select')->options(\App\cities::lists('name', 'id')->all());
			$this->edit->add('state_id','State','select')->options(\App\states::lists('state_name', 'id')->all());
			$this->edit->add('country_id','Country','select')->options(\App\countries::lists('country_name', 'id')->all());
}else{
$this->edit->add('city_id','city','autocomplete')->options(\App\cities::lists('name', 'id')->all());
			$this->edit->add('state_id','State','autocomplete')->options(\App\states::lists('state_name', 'id')->all());
			$this->edit->add('country_id','Country','autocomplete')->options(\App\countries::lists('country_name', 'id')->all());
}
		if(!empty($users) AND $users->role_id==1){
		$this->edit->add('preference','Preference States','Multiselect')->options(\App\states::lists('state_name', 'id')->all());	
		}
			$this->edit->add('email_verified', 'Email Verified', 'select')->option('1', 'Yes')->option('0', 'No');
			$this->edit->add('web_url', 'Website url', 'text');
			$foldername =  Input::get('update')!="" ? Input::get('update') : Input::get('modify');
			$this->edit->add('profile_pic', 'Profile Picture', 'image')->move('../../webroot/img/user_docs/'.$foldername.'/')->preview(100,100);
			$this->edit->add('company_img_1_pic', 'Photograph of Office (pic 1)', 'image')->move('../../webroot/img/user_docs/'.$foldername.'/')->preview(100,100);
			$this->edit->add('company_img_2_pic', 'Photograph of Office (pic 2)', 'image')->move('../../webroot/img/user_docs/'.$foldername.'/')->preview(100,100);
			$this->edit->add('pancard_pic', 'Pan card', 'image')->move('../../webroot/img/user_docs/'.$foldername.'/')->preview(200,120);
			$this->edit->add('id_card_pic', 'Business Card', 'image')->move('../../webroot/img/user_docs/'.$foldername.'/')->preview(200,120);
			$this->edit->add('company_shop_registration_pic', 'Company Shop Act Registration', 'image')->move('../../webroot/img/user_docs/'.$foldername.'/')->preview(200,120);
if(!empty($users) AND $users->role_id==1){
			$this->edit->add('iata_pic', 'I A T A Pic', 'image')->move('../../webroot/img/user_travel_certificates/'.$foldername.'/')->preview(200,120);
			$this->edit->add('tafi_pic', 'T A F I Pic', 'image')->move('../../webroot/img/user_travel_certificates/'.$foldername.'/')->preview(200,120);
			$this->edit->add('taai_pic', 'T A A I Pic', 'image')->move('../../webroot/img/user_travel_certificates/'.$foldername.'/')->preview(200,120);
			$this->edit->add('iato_pic', 'I A T O Pic', 'image')->move('../../webroot/img/user_travel_certificates/'.$foldername.'/')->preview(200,120);
			$this->edit->add('adyoi_pic', 'A D Y O I Pic', 'image')->move('../../webroot/img/user_travel_certificates/'.$foldername.'/')->preview(200,120);
			$this->edit->add('iso9001_pic', 'I S O 9001 Pic', 'image')->move('../../webroot/img/user_travel_certificates/'.$foldername.'/')->preview(200,120);
			$this->edit->add('uftaa_pic', 'U F T A A Pic', 'image')->move('../../webroot/img/user_travel_certificates/'.$foldername.'/')->preview(200,120);
			$this->edit->add('adtoi_pic', 'A D T O I Pic', 'image')->move('../../webroot/img/user_travel_certificates/'.$foldername.'/')->preview(200,120);
}   
	return $this->returnEditView();
    }    
}
