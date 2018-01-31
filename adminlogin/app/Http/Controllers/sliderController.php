<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class sliderController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        /** Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields
 */

			$this->filter = \DataFilter::source(new \App\slider);
			

			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('title', 'Title');
		
			$this->addStylesToGrid();

       
                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        /* Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields */
	
			$this->edit = \DataEdit::source(new \App\slider());
			$this->edit->label('Edit Slider');

			$this->edit->add('title', 'Title', 'text')->rule('required');
			$this->edit->add('headerimg', 'Slider Picture', 'image')->move('../../webroot/img/slider/')->preview(700,250);
		   $this->edit->add('status', 'Status','radiogroup')->option('1', 'Active')->option('0', 'Deactive');


        
       
        return $this->returnEditView();
    }    
}
