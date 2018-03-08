<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventPlannerPromotionCarts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $EventPlannerPromotions
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\EventPlannerPromotionCart get($primaryKey, $options = [])
 * @method \App\Model\Entity\EventPlannerPromotionCart newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EventPlannerPromotionCart[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EventPlannerPromotionCart|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EventPlannerPromotionCart patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EventPlannerPromotionCart[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EventPlannerPromotionCart findOrCreate($search, callable $callback = null, $options = [])
 */
class EventPlannerPromotionCartsTable extends Table
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

        $this->table('event_planner_promotion_carts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('EventPlannerPromotions', [
            'foreignKey' => 'event_planner_promotion_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
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
/* 
        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->integer('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');
 */
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
