<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TaxiFleetCarBuses Model
 *
 * @property \Cake\ORM\Association\HasMany $TaxiFleetPromotionRows
 *
 * @method \App\Model\Entity\TaxiFleetCarBus get($primaryKey, $options = [])
 * @method \App\Model\Entity\TaxiFleetCarBus newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TaxiFleetCarBus[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TaxiFleetCarBus|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaxiFleetCarBus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TaxiFleetCarBus[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TaxiFleetCarBus findOrCreate($search, callable $callback = null)
 */
class TaxiFleetCarBusesTable extends Table
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

        $this->table('taxi_fleet_car_buses');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('TaxiFleetPromotionRows', [
            'foreignKey' => 'taxi_fleet_car_bus_id'
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

        $validator
            ->requirePresence('type', 'create')
            ->notEmpty('type');

        $validator
            ->integer('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');

        return $validator;
    }
}
