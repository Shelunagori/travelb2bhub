<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HotelPromotionCarts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $HotelPromotions
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\HotelPromotionCart get($primaryKey, $options = [])
 * @method \App\Model\Entity\HotelPromotionCart newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HotelPromotionCart[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HotelPromotionCart|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HotelPromotionCart patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HotelPromotionCart[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HotelPromotionCart findOrCreate($search, callable $callback = null, $options = [])
 */
class HotelPromotionCartsTable extends Table
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

        $this->table('hotel_promotion_carts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('HotelPromotions', [
            'foreignKey' => 'hotel_promotion_id',
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

      /*   $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

        $validator
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
        $rules->add($rules->existsIn(['hotel_promotion_id'], 'HotelPromotions'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
