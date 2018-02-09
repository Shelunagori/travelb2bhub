<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * States Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\HasMany $Cities
 * @property \Cake\ORM\Association\HasMany $Hotels
 * @property \Cake\ORM\Association\HasMany $RequestStops
 * @property \Cake\ORM\Association\HasMany $Requests
 * @property \Cake\ORM\Association\HasMany $Userdetails
 * @property \Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\State get($primaryKey, $options = [])
 * @method \App\Model\Entity\State newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\State[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\State|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\State patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\State[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\State findOrCreate($search, callable $callback = null)
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

        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Cities', [
            'foreignKey' => 'state_id'
        ]);
        $this->hasMany('Hotels', [
            'foreignKey' => 'state_id'
        ]);
        $this->hasMany('RequestStops', [
            'foreignKey' => 'state_id'
        ]);
        $this->hasMany('Requests', [
            'foreignKey' => 'state_id'
        ]);
        $this->hasMany('Userdetails', [
            'foreignKey' => 'state_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'state_id'
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
            ->requirePresence('state_name', 'create')
            ->notEmpty('state_name');

        /*$validator
            ->dateTime('created_at')
            ->requirePresence('created_at', 'create')
            ->notEmpty('created_at');
*/
        return $validator;
    }

     
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['country_id'], 'Countries'));

        return $rules;
    }
	
	public function getAllStates() {
	
		$states = $this->find()
			->where(['States.country_id' => 101])
			->order(["States.state_name" => "ASC"])
			->all();
		return $states;
	}
}
