<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EventPlannerPromotions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\BelongsTo $PriceMasters
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $EventPlannerPromotionCities
 * @property \Cake\ORM\Association\HasMany $EventPlannerPromotionStates
 *
 * @method \App\Model\Entity\EventPlannerPromotion get($primaryKey, $options = [])
 * @method \App\Model\Entity\EventPlannerPromotion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EventPlannerPromotion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EventPlannerPromotion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EventPlannerPromotion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EventPlannerPromotion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EventPlannerPromotion findOrCreate($search, callable $callback = null, $options = [])
 */
class EventPlannerPromotionsTable extends Table
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

        $this->table('event_planner_promotions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
		
        $this->belongsTo('States');
        $this->belongsTo('Cities');
		
        $this->belongsTo('PriceMasters', [
            'foreignKey' => 'price_master_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('EventPlannerPromotionCities', [
            'foreignKey' => 'event_planner_promotion_id'
        ]);
        $this->hasMany('EventPlannerPromotionLikes', [
            'foreignKey' => 'event_planner_promotion_id'
        ]);		
        $this->hasMany('EventPlannerPromotionViews', [
            'foreignKey' => 'event_planner_promotion_id'
        ]);		
        $this->hasMany('EventPlannerPromotionStates', [
            'foreignKey' => 'event_planner_promotion_id'
        ]);
        $this->hasMany('EventPlannerPromotionPriceBeforeRenews', [
            'foreignKey' => 'event_planner_promotion_id'
        ]);
		$this->hasMany('EventPlannerPromotionCarts', [
            'foreignKey' => 'event_planner_promotion_id'
        ]);
		$this->hasMany('EventPlannerPromotionReports', [
            'foreignKey' => 'event_planner_promotion_id'
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
            ->requirePresence('event_detail', 'create')
            ->notEmpty('event_detail');

       /*  $validator
            ->requirePresence('image', 'create')
            ->notEmpty('image'); */

       /*  $validator
            ->requirePresence('document', 'create')
            ->notEmpty('document');
 */
       /*  $validator
            ->date('visible_date')
            ->requirePresence('visible_date', 'create')
            ->notEmpty('visible_date');
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
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        $rules->add($rules->existsIn(['price_master_id'], 'PriceMasters'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
