<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HotelPromotions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $HotelCategories
 * @property \Cake\ORM\Association\BelongsTo $PriceMasters
 * @property \Cake\ORM\Association\HasMany $HotelPromotionCities
 * @property \Cake\ORM\Association\HasMany $HotelPromotionLikes
 * @property \Cake\ORM\Association\HasMany $HotelPromotionPriceBeforeRenews
 * @property \Cake\ORM\Association\HasMany $HotelPromotionReports
 * @property \Cake\ORM\Association\HasMany $HotelPromotionViews
 *
 * @method \App\Model\Entity\HotelPromotion get($primaryKey, $options = [])
 * @method \App\Model\Entity\HotelPromotion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HotelPromotion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HotelPromotion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HotelPromotion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HotelPromotion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HotelPromotion findOrCreate($search, callable $callback = null)
 */
class HotelPromotionsTable extends Table
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

        $this->table('hotel_promotions');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('HotelCategories', [
            'foreignKey' => 'hotel_category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('PriceMasters', [
            'foreignKey' => 'price_master_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('HotelPromotionCities', [
            'foreignKey' => 'hotel_promotion_id'
        ]);
        $this->hasMany('HotelPromotionLikes', [
            'foreignKey' => 'hotel_promotion_id'
        ]);
        $this->hasMany('HotelPromotionPriceBeforeRenews', [
            'foreignKey' => 'hotel_promotion_id'
        ]);
        $this->hasMany('HotelPromotionReports', [
            'foreignKey' => 'hotel_promotion_id'
        ]);
        $this->hasMany('HotelPromotionViews', [
            'foreignKey' => 'hotel_promotion_id'
        ]);
        $this->hasMany('HotelPromotionCarts', [
            'foreignKey' => 'hotel_promotion_id'
        ]);
        $this->hasMany('HotelPromotionReports', [
            'foreignKey' => 'hotel_promotion_id'
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
            ->requirePresence('hotel_name', 'create')
            ->notEmpty('hotel_name');

        $validator
            ->requirePresence('hotel_location', 'create')
            ->notEmpty('hotel_location');

        $validator
            ->numeric('cheap_tariff')
            ->requirePresence('cheap_tariff', 'create')
            ->notEmpty('cheap_tariff');

        $validator
            ->numeric('expensive_tariff')
            ->requirePresence('expensive_tariff', 'create')
            ->notEmpty('expensive_tariff');

        $validator
            ->requirePresence('website', 'create')
            ->notEmpty('website');

       /* $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');
		*/
        $validator
            ->integer('hotel_pic')
            ->requirePresence('hotel_pic', 'create')
            ->notEmpty('hotel_pic');

        $validator
            ->requirePresence('payment_status', 'create')
            ->notEmpty('payment_status');

        $validator
            ->numeric('total_charges')
            ->requirePresence('total_charges', 'create')
            ->notEmpty('total_charges');

        $validator
            ->date('visible_date')
            ->requirePresence('visible_date', 'create')
            ->notEmpty('visible_date');

        $validator
            ->integer('hotel_rating')
            ->requirePresence('hotel_rating', 'create')
            ->notEmpty('hotel_rating');

       /* $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
            ->date('updated_on')
            ->requirePresence('updated_on', 'create')
            ->notEmpty('updated_on');

        $validator
            ->date('accept_date')
            ->requirePresence('accept_date', 'create')
            ->notEmpty('accept_date');
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
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['hotel_category_id'], 'HotelCategories'));
        $rules->add($rules->existsIn(['price_master_id'], 'PriceMasters'));

        return $rules;
    }
}
