<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventPlannerPromotionStates Model
 *
 * @property \Cake\ORM\Association\BelongsTo $EventPlannerPromotions
 * @property \Cake\ORM\Association\BelongsTo $States
 *
 * @method \App\Model\Entity\EventPlannerPromotionState get($primaryKey, $options = [])
 * @method \App\Model\Entity\EventPlannerPromotionState newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EventPlannerPromotionState[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EventPlannerPromotionState|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EventPlannerPromotionState patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EventPlannerPromotionState[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EventPlannerPromotionState findOrCreate($search, callable $callback = null, $options = [])
 */
class EventPlannerPromotionStatesTable extends Table
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

        $this->table('event_planner_promotion_states');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('EventPlannerPromotions', [
            'foreignKey' => 'event_planner_promotion_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
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
        $rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }
}
