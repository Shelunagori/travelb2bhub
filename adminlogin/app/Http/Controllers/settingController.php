<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class settingController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        /** Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields */

		$this->filter = \DataFilter::source(new \App\setting);
		$this->filter->add('field', 'Field', 'text');
		$this->filter->add('value', 'Value', 'text');
		$this->filter->submit('search');
		$this->filter->reset('reset');
		$this->filter->build();

		$this->grid = \DataGrid::source($this->filter);
		$this->grid->add('field', 'Field');
		$this->grid->add('value', 'Value');
		$this->addStylesToGrid();
		return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        /* Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields */
		
		$this->edit = \DataEdit::source(new \App\setting());
		$this->edit->label('Edit Setting');
		$this->edit->add('field', 'Field', 'text')->rule('required');
		$this->edit->add('value', 'Value', 'textarea')->rule('required');
		return $this->returnEditView();
    }    
}
