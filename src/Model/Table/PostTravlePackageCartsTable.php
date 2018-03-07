<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PostTravlePackageCarts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $PostTravlePackages
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\PostTravlePackageCart get($primaryKey, $options = [])
 * @method \App\Model\Entity\PostTravlePackageCart newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PostTravlePackageCart[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PostTravlePackageCart|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostTravlePackageCart patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PostTravlePackageCart[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PostTravlePackageCart findOrCreate($search, callable $callback = null, $options = [])
 */
class PostTravlePackageCartsTable extends Table
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

        $this->table('post_travle_package_carts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('PostTravlePackages', [
            'foreignKey' => 'post_travle_package_id',
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
        $rules->add($rules->existsIn(['post_travle_package_id'], 'PostTravlePackages'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
