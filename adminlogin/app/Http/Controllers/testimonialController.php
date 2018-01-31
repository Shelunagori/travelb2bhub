<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;

class testimonialController extends CrudController{

    public function all($entity){
        parent::all($entity);
        /** Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields */
		//	$this->filter = \DataFilter::source(new \App\testimonial);
		$this->filter =\DataFilter::source(\App\testimonial::with('users','authors'));
			$this->filter->add('rating', 'Rating', 'select')->option('', 'Select Rating')->option('1', '1')->option('2', '2')->option('3', '3')->option('4', '4')->option('5', '5');
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();
			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('rating', 'Rating');
		$this->grid->add('{{$users->first_name}} {{$users->last_name}}', 'User');
		$this->grid->add('{{$authors->first_name}} {{$authors->last_name}}', 'Author');
			$this->addStylesToGrid();
         return $this->returnView();
    }
    public function  edit($entity){
        parent::edit($entity);
			 /* Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields */
			 $this->edit = \DataEdit::source(new \App\testimonial());
			 $this->edit->label('Edit Testimonial');
			 $userArray = \App\users::select(
          DB::raw("CONCAT(first_name,' ',last_name) AS name"),'id')->pluck('name', 'id');
          $this->edit->add('user_id','Author','autocomplete')->options($userArray)->rule('required');
          $this->edit->add('author_id','User','autocomplete')->options($userArray)->rule('required');
		    $this->edit->add('rating', 'Rating', 'select')->option('1', '1')->option('2', '2')->option('3', '3')->option('4', '4')->option('5', '5');
		   $this->edit->add('comment', 'Comment', 'textarea');
	
          $this->edit->add('request_id','sas','hidden');
         return $this->returnEditView();
    }
}
