<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class pagesController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        /** Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields

*/
			$this->filter = \DataFilter::source(new \App\pages);
			$this->filter->add('title', 'Page Title', 'text');
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();

			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('title', 'Page Title');
			
			$this->addStylesToGrid();
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        /* Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields */
	
			$this->edit = \DataEdit::source(new \App\pages());

			$this->edit->label('Edit Pages');

			$this->edit->add('title', 'Page Title', 'text');
			$this->edit->add('description', 'Description', 'redactor');
		
			


        
       
        return $this->returnEditView();
    }    
}
