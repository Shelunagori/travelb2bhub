<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TaxiFleetPromotions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\BelongsTo $PriceMasters
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $TaxiFleetPromotionCities
 * @property \Cake\ORM\Association\HasMany $TaxiFleetPromotionRows
 * @property \Cake\ORM\Association\HasMany $TaxiFleetPromotionStates
 *
 * @method \App\Model\Entity\TaxiFleetPromotion get($primaryKey, $options = [])
 * @method \App\Model\Entity\TaxiFleetPromotion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TaxiFleetPromotion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TaxiFleetPromotion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaxiFleetPromotion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TaxiFleetPromotion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TaxiFleetPromotion findOrCreate($search, callable $callback = null, $options = [])
 */
class TaxiFleetPromotionsTable extends Table
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

        $this->table('taxi_fleet_promotions');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('PriceMasters', [
            'foreignKey' => 'price_master_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('TaxiFleetPromotionCities', [
            'foreignKey' => 'taxi_fleet_promotion_id'
        ]);
        $this->hasMany('TaxiFleetPromotionRows', [
            'foreignKey' => 'taxi_fleet_promotion_id'
        ]);
        $this->hasMany('TaxiFleetPromotionLikes', [
            'foreignKey' => 'taxi_fleet_promotion_id'
        ]);	
        $this->hasMany('TaxiFleetPromotionViews', [
            'foreignKey' => 'taxi_fleet_promotion_id'
        ]);		
        $this->hasMany('TaxiFleetPromotionStates', [
            'foreignKey' => 'taxi_fleet_promotion_id'
        ]);
        $this->hasMany('TaxiFleetPromotionPriceBeforeRenews', [
            'foreignKey' => 'taxi_fleet_promotion_id'
        ]);
		$this->hasMany('TaxiFleetPromotionCarts', [
            'foreignKey' => 'taxi_fleet_promotion_id'
        ]);
		$this->hasMany('TaxiFleetPromotionReports', [
            'foreignKey' => 'taxi_fleet_promotion_id'
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('fleet_detail', 'create')
            ->notEmpty('fleet_detail');

        $validator
            ->requirePresence('image', 'create')
            ->notEmpty('image');

        $validator
            ->requirePresence('document', 'create')
            ->notEmpty('document');



        $validator
            ->date('visible_date')
            ->requirePresence('visible_date', 'create')
            ->notEmpty('visible_date');


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
