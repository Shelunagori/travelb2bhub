<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class membershipController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        /** Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields

 */
			$this->filter = \DataFilter::source(new \App\membership);
			$this->filter->add('membership_name', 'Membership Name', 'text');
			$this->filter->add('status', 'Status','select')->option('1', 'Active')->option('0', 'Deactive');
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();
			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('membership_name', 'Membership Name');
			$this->grid->add('price', 'Price');
			$this->grid->add('duration', 'Duration');
			$this->addStylesToGrid();
         return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);
        /* Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields
	 */	
			$this->edit = \DataEdit::source(new \App\membership());
			$this->edit->label('Edit Membership');
			$this->edit->add('membership_name', 'Membership Name', 'text')->rule('required');
			$this->edit->add('price', 'Price', 'text')->rule('required');
			$this->edit->add('duration', 'Duration', 'text')->rule('required');
			$this->edit->add('description', 'Description', 'redactor');
			$this->edit->add('status', 'Status','radiogroup')->option('1', 'Active')->option('0', 'Deactive');
         return $this->returnEditView();
    }    
}
