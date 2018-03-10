<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HotelPromotionPriceBeforeRenews Model
 *
 * @property \Cake\ORM\Association\BelongsTo $HotelPromotions
 * @property \Cake\ORM\Association\BelongsTo $PriceMasters
 *
 * @method \App\Model\Entity\HotelPromotionPriceBeforeRenews get($primaryKey, $options = [])
 * @method \App\Model\Entity\HotelPromotionPriceBeforeRenews newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HotelPromotionPriceBeforeRenews[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HotelPromotionPriceBeforeRenews|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HotelPromotionPriceBeforeRenews patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HotelPromotionPriceBeforeRenews[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HotelPromotionPriceBeforeRenews findOrCreate($search, callable $callback = null)
 */
class HotelPromotionPriceBeforeRenewsTable extends Table
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

        $this->table('hotel_promotion_price_before_renews');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('HotelPromotions', [
            'foreignKey' => 'hotel_promotion_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('PriceMasters', [
            'foreignKey' => 'price_master_id',
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

        $validator
            ->integer('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

        $validator
            ->date('visible_date')
            ->requirePresence('visible_date', 'create')
            ->notEmpty('visible_date');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

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
        $rules->add($rules->existsIn(['hotel_promotion_id'], 'HotelPromotions'));
        $rules->add($rules->existsIn(['price_master_id'], 'PriceMasters'));

        return $rules;
    }
}
