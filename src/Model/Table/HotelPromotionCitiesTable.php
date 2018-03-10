<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HotelPromotionCities Model
 *
 * @property \Cake\ORM\Association\BelongsTo $HotelPromotions
 * @property \Cake\ORM\Association\BelongsTo $Cities
 *
 * @method \App\Model\Entity\HotelPromotionCity get($primaryKey, $options = [])
 * @method \App\Model\Entity\HotelPromotionCity newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HotelPromotionCity[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HotelPromotionCity|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HotelPromotionCity patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HotelPromotionCity[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HotelPromotionCity findOrCreate($search, callable $callback = null)
 */
class HotelPromotionCitiesTable extends Table
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

        $this->table('hotel_promotion_cities');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('HotelPromotions', [
            'foreignKey' => 'hotel_promotion_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
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
            ->numeric('charges')
            ->requirePresence('charges', 'create')
            ->notEmpty('charges');

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
        $rules->add($rules->existsIn(['city_id'], 'Cities'));

        return $rules;
    }
}
