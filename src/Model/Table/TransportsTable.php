<?php

namespace App\Model\Table;

use App\Model\Entity\Transport;

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

class TransportsTable extends Table

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



        $this->table('transports');

        $this->displayField('id');

        $this->primaryKey('id');



        $this->addBehavior('Timestamp');
           
         $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        
         $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ]);
        

    }

        

    }