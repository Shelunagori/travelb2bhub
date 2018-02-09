<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Cities Model
 *
 * @property \Cake\ORM\Association\BelongsTo $States
 * @property \Cake\ORM\Association\HasMany $Hotels
 * @property \Cake\ORM\Association\HasMany $RequestStops
 * @property \Cake\ORM\Association\HasMany $Requests
 * @property \Cake\ORM\Association\HasMany $Transports
 * @property \Cake\ORM\Association\HasMany $Userdetails
 * @property \Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\City get($primaryKey, $options = [])
 * @method \App\Model\Entity\City newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\City[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\City|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\City patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\City[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\City findOrCreate($search, callable $callback = null)
 */
class CitiesTable extends Table
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

        $this->table('cities');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Hotels', [
            'foreignKey' => 'city_id'
        ]);
        $this->hasMany('RequestStops', [
            'foreignKey' => 'city_id'
        ]);
        $this->hasMany('Requests', [
            'foreignKey' => 'city_id'
        ]);
        $this->hasMany('Transports', [
            'foreignKey' => 'city_id'
        ]);
        $this->hasMany('Userdetails', [
            'foreignKey' => 'city_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'city_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

       /* $validator
            ->integer('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->requirePresence('category', 'create')
            ->notEmpty('category');

       $validator
            ->dateTime('updated_at')
            ->requirePresence('updated_at', 'create')
            ->notEmpty('updated_at');

        $validator
            ->dateTime('created_at')
            ->requirePresence('created_at', 'create')
            ->notEmpty('created_at');
*/
        return $validator;
    }
	public function getAllCities() {
		$cities = $this->find()
			->contain(["States"])
			->where(['States.country_id' => 101])
			->order(["Cities.name" => "ASC"])
			->all();
		return $cities;
	}

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }
}
