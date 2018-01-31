<?php

namespace App\Model\Table;

use App\Model\Entity\BusinessBuddy;

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

class BusinessBuddiesTable extends Table

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



        $this->table('business_buddies');

        $this->displayField('id');

        $this->primaryKey('id');



        $this->addBehavior('Timestamp');
           
         $this->belongsTo('Users', [
            'foreignKey' => 'bb_user_id',
            'joinType' => 'INNER'
        ]);
    }
}