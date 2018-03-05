<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Countries Model
 *
 * @property \Cake\ORM\Association\HasMany $EventPlannerPromotions
 * @property \Cake\ORM\Association\HasMany $Hotels
 * @property \Cake\ORM\Association\HasMany $PostTravlePackages
 * @property \Cake\ORM\Association\HasMany $Requests
 * @property \Cake\ORM\Association\HasMany $States
 * @property \Cake\ORM\Association\HasMany $TaxiFleetPromotions
 * @property \Cake\ORM\Association\HasMany $Userdetails
 * @property \Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Country get($primaryKey, $options = [])
 * @method \App\Model\Entity\Country newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Country[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Country|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Country patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Country[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Country findOrCreate($search, callable $callback = null)
 */
class CountriesTable extends Table
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

        $this->table('countries');
        $this->displayField('country_name');
        $this->primaryKey('id');

        $this->hasMany('EventPlannerPromotions', [
            'foreignKey' => 'country_id'
        ]);
        $this->hasMany('Hotels', [
            'foreignKey' => 'country_id'
        ]);
        $this->hasMany('PostTravlePackages', [
            'foreignKey' => 'country_id'
        ]);
        $this->hasMany('Requests', [
            'foreignKey' => 'country_id'
        ]);
        $this->hasMany('States', [
            'foreignKey' => 'country_id'
        ]);
        $this->hasMany('TaxiFleetPromotions', [
            'foreignKey' => 'country_id'
        ]);
        $this->hasMany('Userdetails', [
            'foreignKey' => 'country_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'country_id'
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

      /*  $validator
            ->requirePresence('country_cod', 'create')
            ->notEmpty('country_cod');

        $validator
            ->requirePresence('country_name', 'create')
            ->notEmpty('country_name');

        $validator
            ->integer('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');
*/
        return $validator;
    }
}
