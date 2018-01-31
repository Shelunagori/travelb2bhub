<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class countriesController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        /** Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields
 */

			$this->filter = \DataFilter::source(new \App\countries);
			$this->filter->add('country_name', 'Country Name', 'text');
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();

			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('country_name', 'Country Name');
			$this->grid->add('country_cod', 'Country Code');
			$this->addStylesToGrid();

       
                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        /* Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields */
	
			$this->edit = \DataEdit::source(new \App\countries());

			$this->edit->label('Edit Country');

			$this->edit->add('country_name', 'Country Name', 'text')->rule('required');
		
			$this->edit->add('country_cod', 'Country Code', 'text')->rule('required');


        
       
        return $this->returnEditView();
    }    
}
