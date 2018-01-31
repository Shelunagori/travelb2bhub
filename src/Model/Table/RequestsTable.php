<?php

namespace App\Model\Table;

use App\Model\Entity\Request;

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

class RequestsTable extends Table

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



        $this->table('requests');

        $this->displayField('id');

        $this->primaryKey('id');



        $this->addBehavior('Timestamp');
           
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);

		$this->hasOne('UserRatings', [
            'foreignKey' => 'request_id',
            'joinType' => 'LEFT'
        ]);
        
         $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ]);
		$this->hasMany('Responses', [
            'foreignKey' => 'request_id',
            'dependent' => TRUE
        ]);

		$this->hasMany('Hotels', [
            'foreignKey' => 'req_id',
            'dependent' => TRUE
        ]);
		$this->hasMany('RequestStops', [
            'foreignKey' => 'request_id',
            'dependent' => TRUE
        ]);
        

    }

        

    }