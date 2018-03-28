<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Responses Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Requests
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $Requests
 * @property \Cake\ORM\Association\HasMany $Testimonial
 *
 * @method \App\Model\Entity\Response get($primaryKey, $options = [])
 * @method \App\Model\Entity\Response newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Response[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Response|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Response patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Response[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Response findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ResponsesTable extends Table
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

        $this->table('responses');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Requests', [
            'foreignKey' => 'request_id'  
        ]);
		
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
		$this->hasMany('UserChats', [
            'foreignKey' => 'request_id',
            'joinType' => 'RIGHT'
        ]);
        /* $this->hasMany('Requests', [
            'foreignKey' => 'response_id'
        ]); */
        $this->hasMany('Testimonial', [
            'foreignKey' => 'response_id'
        ]);
		$this->belongsTo('BusinessBuddies');
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
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');

    /*   $validator
            ->decimal('quotation_price')
            ->allowEmpty('quotation_price');

        $validator
            ->integer('is_details_shared')
            ->requirePresence('is_details_shared', 'create')
            ->notEmpty('is_details_shared');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->boolean('is_deleted')
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
        $rules->add($rules->existsIn(['request_id'], 'Requests'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
