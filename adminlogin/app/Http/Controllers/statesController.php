<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class statesController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        /** Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields
*/

			$this->filter = \DataFilter::source(new \App\states);
			$this->filter->add('state_name', 'State Name', 'text');
			$countriesArray = \App\countries::lists('country_name', 'id');
			$countriesArray->prepend('Select  Country', '');
			$this->filter->add('country_id', 'Country', 'select')->options($countriesArray);
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();
			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('state_name', 'State Name');
			$this->addStylesToGrid();

        	return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        /* Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields  */
	
			$this->edit = \DataEdit::source(new \App\states());

			$this->edit->label('Edit States');

			$this->edit->add('state_name', 'State Name', 'text');
		
			$countriesArray = \App\countries::lists('country_name', 'id');
			$countriesArray->prepend('Select  Country', '');
			$this->edit->add('country_id', 'Country', 'select')->options($countriesArray);

       
       
        return $this->returnEditView();
    }    
}
