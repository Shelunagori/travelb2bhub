<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class citiesController extends CrudController{

    public function all($entity){
        parent::all($entity); 
$this->filter = \DataFilter::source(new \App\cities);
			$this->filter->add('name', 'City Name', 'text');
			$statesArray = \App\states::lists('state_name', 'id');
			$statesArray->prepend('Select  State', '');
			$this->filter->add('state_id', 'State', 'select')->options($statesArray);
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();
			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('name', 'City');
			$this->addStylesToGrid();
                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        /* Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields
	*/
			$this->edit = \DataEdit::source(new \App\cities());

			$this->edit->label('Edit City');

			$this->edit->add('name', 'Name', 'text');
			$this->edit->add('price', 'Price', 'text');
			$this->edit->add('category', 'Category', 'select')->option('1', 'Capital City')->option('2', 'Metro')->option('3', 'General');
		
				$statesArray = \App\states::lists('state_name', 'id');
			$statesArray->prepend('Select  State', '');
			$this->edit->add('state_id', 'State', 'select')->options($statesArray);


        
       
        return $this->returnEditView();
    }    
}
