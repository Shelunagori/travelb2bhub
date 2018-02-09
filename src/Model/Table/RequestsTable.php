<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Requests Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Categories
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Finals
 * @property \Cake\ORM\Association\BelongsTo $States
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\BelongsTo $References
 * @property \Cake\ORM\Association\BelongsTo $Responses
 * @property \Cake\ORM\Association\BelongsTo $Cities
 * @property \Cake\ORM\Association\HasMany $RequestStops
 * @property \Cake\ORM\Association\HasMany $Responses
 * @property \Cake\ORM\Association\HasMany $Testimonial
 * @property \Cake\ORM\Association\HasMany $UserChats
 * @property \Cake\ORM\Association\HasMany $UserChats123
 * @property \Cake\ORM\Association\HasMany $UserRatings
 *
 * @method \App\Model\Entity\Request get($primaryKey, $options = [])
 * @method \App\Model\Entity\Request newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Request[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Request|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Request patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Request[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Request findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RequestsTable extends Table
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

        $this->table('requests');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Finals', [
            'foreignKey' => 'final_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id'
        ]);
        $this->belongsTo('References', [
            'foreignKey' => 'reference_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Responses', [
            'foreignKey' => 'response_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id'
        ]);
        $this->hasMany('RequestStops', [
            'foreignKey' => 'request_id'
        ]);
        $this->hasMany('Responses', [
            'foreignKey' => 'request_id'
        ]);
        $this->hasMany('Testimonial', [
            'foreignKey' => 'request_id'
        ]);
        $this->hasMany('UserChats', [
            'foreignKey' => 'request_id'
        ]);
        $this->hasMany('UserChats123', [
            'foreignKey' => 'request_id'
        ]);
        $this->hasMany('UserRatings', [
            'foreignKey' => 'request_id'
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
            ->allowEmpty('locality');

        $validator
            ->integer('total_budget')
            ->requirePresence('total_budget', 'create')
            ->notEmpty('total_budget');

        $validator
            ->requirePresence('children', 'create')
            ->notEmpty('children');

        $validator
            ->requirePresence('adult', 'create')
            ->notEmpty('adult');

        $validator
            ->requirePresence('room1', 'create')
            ->notEmpty('room1');

        $validator
            ->requirePresence('room2', 'create')
            ->notEmpty('room2');

        $validator
            ->requirePresence('room3', 'create')
            ->notEmpty('room3');

        $validator
            ->requirePresence('child_with_bed', 'create')
            ->notEmpty('child_with_bed');

        $validator
            ->requirePresence('child_without_bed', 'create')
            ->notEmpty('child_without_bed');

        $validator
            ->integer('hotel_rating')
            ->allowEmpty('hotel_rating');

        $validator
            ->requirePresence('hotel_category', 'create')
            ->notEmpty('hotel_category');

        $validator
            ->requirePresence('meal_plan', 'create')
            ->notEmpty('meal_plan');

        $validator
            ->integer('destination_city')
            ->requirePresence('destination_city', 'create')
            ->notEmpty('destination_city');

        $validator
            ->date('check_in')
            ->requirePresence('check_in', 'create')
            ->notEmpty('check_in');

        $validator
            ->date('check_out')
            ->requirePresence('check_out', 'create')
            ->notEmpty('check_out');

        $validator
            ->allowEmpty('transport_requirement');

        $validator
            ->integer('pickup_city')
            ->allowEmpty('pickup_city');

        $validator
            ->integer('pickup_state')
            ->allowEmpty('pickup_state');

        $validator
            ->integer('pickup_country')
            ->allowEmpty('pickup_country');

        $validator
            ->allowEmpty('pickup_locality');

        $validator
            ->requirePresence('final_locality', 'create')
            ->notEmpty('final_locality');

        $validator
            ->integer('final_city')
            ->allowEmpty('final_city');

        $validator
            ->integer('final_state')
            ->allowEmpty('final_state');

        $validator
            ->integer('final_country')
            ->allowEmpty('final_country');

        $validator
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');

        $validator
            ->date('start_date')
            ->allowEmpty('start_date');

        $validator
            ->date('end_date')
            ->allowEmpty('end_date');

        $validator
            ->requirePresence('stops', 'create')
            ->notEmpty('stops');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->integer('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');

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
        //$rules->add($rules->existsIn(['category_id'], 'Categories'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        //$rules->add($rules->existsIn(['final_id'], 'Finals'));
        $rules->add($rules->existsIn(['state_id'], 'States'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        //$rules->add($rules->existsIn(['reference_id'], 'References'));
        $rules->add($rules->existsIn(['response_id'], 'Responses'));
        $rules->add($rules->existsIn(['city_id'], 'Cities'));

        return $rules;
    }
}
