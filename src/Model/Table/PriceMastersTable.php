<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PriceMasters Model
 *
 * @property \Cake\ORM\Association\BelongsTo $PromotionTypes
 * @property \Cake\ORM\Association\HasMany $EventPlannerPromotionPriceBeforeRenews
 * @property \Cake\ORM\Association\HasMany $EventPlannerPromotions
 * @property \Cake\ORM\Association\HasMany $HotelPromotionPriceBeforeRenews
 * @property \Cake\ORM\Association\HasMany $HotelPromotions
 * @property \Cake\ORM\Association\HasMany $PostTravlePackagePriceBeforeRenews
 * @property \Cake\ORM\Association\HasMany $PostTravlePackages
 * @property \Cake\ORM\Association\HasMany $TaxiFleetPromotionPriceBeforeRenews
 * @property \Cake\ORM\Association\HasMany $TaxiFleetPromotions
 *
 * @method \App\Model\Entity\PriceMaster get($primaryKey, $options = [])
 * @method \App\Model\Entity\PriceMaster newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PriceMaster[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PriceMaster|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PriceMaster patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PriceMaster[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PriceMaster findOrCreate($search, callable $callback = null)
 */
class PriceMastersTable extends Table
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

        $this->table('price_masters');
        $this->displayField('week');
        $this->primaryKey('id');

        $this->belongsTo('PromotionTypes', [
            'foreignKey' => 'promotion_type_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('EventPlannerPromotionPriceBeforeRenews', [
            'foreignKey' => 'price_master_id'
        ]);
        $this->hasMany('EventPlannerPromotions', [
            'foreignKey' => 'price_master_id'
        ]);
        $this->hasMany('HotelPromotionPriceBeforeRenews', [
            'foreignKey' => 'price_master_id'
        ]);
        $this->hasMany('HotelPromotions', [
            'foreignKey' => 'price_master_id'
        ]);
        $this->hasMany('PostTravlePackagePriceBeforeRenews', [
            'foreignKey' => 'price_master_id'
        ]);
        $this->hasMany('PostTravlePackages', [
            'foreignKey' => 'price_master_id'
        ]);
        $this->hasMany('TaxiFleetPromotionPriceBeforeRenews', [
            'foreignKey' => 'price_master_id'
        ]);
        $this->hasMany('TaxiFleetPromotions', [
            'foreignKey' => 'price_master_id'
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
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->requirePresence('week', 'create')
            ->notEmpty('week');

        /* $validator
            ->integer('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted'); */

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
        $rules->add($rules->existsIn(['promotion_type_id'], 'PromotionTypes'));

        return $rules;
    }
}
