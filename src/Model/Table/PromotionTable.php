<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Promotion Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Promotion get($primaryKey, $options = [])
 * @method \App\Model\Entity\Promotion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Promotion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Promotion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Promotion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Promotion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Promotion findOrCreate($search, callable $callback = null)
 */
class PromotionTable extends Table
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

        $this->table('promotion');
        $this->displayField('id');
        $this->primaryKey('id');

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

       /* $validator
            ->requirePresence('hotel_name', 'create')
            ->notEmpty('hotel_name');

        $validator
            ->requirePresence('hotel_location', 'create')
            ->notEmpty('hotel_location');

        $validator
            ->requirePresence('hotel_type', 'create')
            ->notEmpty('hotel_type');

        $validator
            ->integer('cheap_tariff')
            ->requirePresence('cheap_tariff', 'create')
            ->notEmpty('cheap_tariff');

        $validator
            ->integer('expensive_tariff')
            ->requirePresence('expensive_tariff', 'create')
            ->notEmpty('expensive_tariff');

        $validator
            ->requirePresence('website', 'create')
            ->notEmpty('website');

        $validator
            ->requirePresence('cities', 'create')
            ->notEmpty('cities');

        $validator
            ->integer('charges')
            ->requirePresence('charges', 'create')
            ->notEmpty('charges');

        $validator
            ->integer('duration')
            ->requirePresence('duration', 'create')
            ->notEmpty('duration');

        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->requirePresence('hotel_pic', 'create')
            ->notEmpty('hotel_pic');

        $validator
            ->requirePresence('payment_status', 'create')
            ->notEmpty('payment_status');

        $validator
            ->requirePresence('citycharge', 'create')
            ->notEmpty('citycharge');

        $validator
            ->dateTime('expiry_date')
            ->requirePresence('expiry_date', 'create')
            ->notEmpty('expiry_date');

        $validator
            ->integer('count')
            ->requirePresence('count', 'create')
            ->notEmpty('count');

        $validator
            ->dateTime('created_at')
            ->requirePresence('created_at', 'create')
            ->notEmpty('created_at');

        $validator
            ->dateTime('updated_at')
            ->requirePresence('updated_at', 'create')
            ->notEmpty('updated_at');

        $validator
            ->dateTime('accept_date')
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

        return $rules;
    }
}
