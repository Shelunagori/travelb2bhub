<?php

namespace App\Model\Table;

use App\Model\Entity\Promotion;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;





class PromotionsTable extends Table {
	/**

	 * Initialize method

	 *

	 * @param array $config The configuration for the Table.

	 * @return void

	 */

public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('promotion');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }
}