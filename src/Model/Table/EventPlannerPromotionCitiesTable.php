<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventPlannerPromotionCities Model
 *
 * @property \Cake\ORM\Association\BelongsTo $EventPlannerPromotions
 * @property \Cake\ORM\Association\BelongsTo $Cities
 *
 * @method \App\Model\Entity\EventPlannerPromotionCity get($primaryKey, $options = [])
 * @method \App\Model\Entity\EventPlannerPromotionCity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EventPlannerPromotionCity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EventPlannerPromotionCity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EventPlannerPromotionCity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EventPlannerPromotionCity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EventPlannerPromotionCity findOrCreate($search, callable $callback = null, $options = [])
 */
class EventPlannerPromotionCitiesTable extends Table
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

        $this->table('event_planner_promotion_cities');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('EventPlannerPromotions', [
            'foreignKey' => 'event_planner_promotion_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'Left'
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

        return $validator;
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
        $rules->add($rules->existsIn(['event_planner_promotion_id'], 'EventPlannerPromotions'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));

        return $rules;
    }
}
