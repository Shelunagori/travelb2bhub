<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PostTravlePackageStates Model
 *
 * @property \Cake\ORM\Association\BelongsTo $PostTravlePackages
 * @property \Cake\ORM\Association\BelongsTo $States
 *
 * @method \App\Model\Entity\PostTravlePackageState get($primaryKey, $options = [])
 * @method \App\Model\Entity\PostTravlePackageState newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PostTravlePackageState[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PostTravlePackageState|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostTravlePackageState patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PostTravlePackageState[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PostTravlePackageState findOrCreate($search, callable $callback = null, $options = [])
 */
class PostTravlePackageStatesTable extends Table
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

        $this->table('post_travle_package_states');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('PostTravlePackages', [
            'foreignKey' => 'post_travle_package_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
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
        $rules->add($rules->existsIn(['post_travle_package_id'], 'PostTravlePackages'));
        $rules->add($rules->existsIn(['state_id'], 'States'));

        return $rules;
    }
}
