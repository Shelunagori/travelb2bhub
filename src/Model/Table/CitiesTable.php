<?php

namespace App\Model\Table;

use App\Model\Entity\City;
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

class CitiesTable extends Table {
	/**

	 * Initialize method

	 *

	 * @param array $config The configuration for the Table.

	 * @return void

	 */

	public function initialize(array $config)

	{

		parent::initialize($config);



		$this->table('cities');

		$this->displayField('id');

		$this->primaryKey('id');



		$this->addBehavior('Timestamp');

		 $this->belongsTo('States', [
			'foreignKey' => 'state_id',
			'joinType' => 'INNER'
		]);
		$this->hasMany('Requests', [
			'foreignKey' => 'city_id'
		]);		$this->hasMany('Hotels', ['foreignKey' => 'city_id' ]);		$this->hasMany('Transports', [            'foreignKey' => 'city_id'        ]);
		  $this->hasMany('Users', [
			'foreignKey' => 'city_id'
		]);
	}
	public function getAllCities() {
		//$cities  = $this->Cities->query('SELECT * FROM cities c inner join states s on c.state_id=s.id where s.country_id=101 order by c.name');
		$cities = $this->find()
                            ->contain(["States"])
                            ->where(['States.country_id' => 101])
							->order(["Cities.name" => "ASC"])
							->all();
		return $cities;
	}
	
}