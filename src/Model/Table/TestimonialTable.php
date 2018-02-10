<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Testimonial Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Authors
 * @property \Cake\ORM\Association\BelongsTo $Requests
 * @property \Cake\ORM\Association\BelongsTo $Responses
 *
 * @method \App\Model\Entity\Testimonial get($primaryKey, $options = [])
 * @method \App\Model\Entity\Testimonial newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Testimonial[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Testimonial|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Testimonial patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Testimonial[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Testimonial findOrCreate($search, callable $callback = null)
 */
class TestimonialTable extends Table
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

        $this->table('testimonial');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
		$this->belongsTo('Authors', [
			'className' => 'Users',
            'foreignKey' => 'author_id',
            'joinType' => 'INNER'
        ]);
		 
        $this->belongsTo('Requests', [
            'foreignKey' => 'request_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Responses', [
            'foreignKey' => 'response_id',
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

       /*  $validator
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');

        $validator
            ->requirePresence('rating', 'create')
            ->notEmpty('rating');

        $validator
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->dateTime('updated_at')
            ->requirePresence('updated_at', 'create')
            ->notEmpty('updated_at');

        $validator
            ->dateTime('created_at')
            ->requirePresence('created_at', 'create')
            ->notEmpty('created_at');
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
        //$rules->add($rules->existsIn(['author_id'], 'Authors'));
        $rules->add($rules->existsIn(['request_id'], 'Requests'));
        $rules->add($rules->existsIn(['response_id'], 'Responses'));

        return $rules;
    }
}
