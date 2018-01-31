<?php

namespace App\Model\Table;

use App\Model\Entity\State;

use Cake\ORM\Query;

use Cake\ORM\RulesChecker;

use Cake\ORM\Table;

use Cake\Validation\Validator;



/**

 * Users Model

 *

 * @property \Cake\ORM\Association\BelongsTo $Areas

 * @property \Cake\ORM\Association\BelongsTo $Cities

 * @property \Cake\ORM\Association\BelongsTo $States

 * @property \Cake\ORM\Association\BelongsTo $Countries

 * @property \Cake\ORM\Association\HasMany $Schools

 */

class StatesTable extends Table

{



    /**

     * Initialize method

     *

     * @param array $config The configuration for the Table.

     * @return void

     */

    public function initialize(array $config)

    {

        parent::initialize($config);



        $this->table('states');

        $this->displayField('id');

        $this->primaryKey('id');



        $this->addBehavior('Timestamp');

        
        $this->hasMany('Users', [
            'foreignKey' => 'state_id'
        ]);
        

    }

   public function getAllStates() {
	
		$states = $this->find()
                            
                            ->where(['States.country_id' => 101])
							->order(["States.state_name" => "ASC"])
							->all();
		return $states;
	}     

    }