<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PostTravlePackageRows Model
 *
 * @property \Cake\ORM\Association\BelongsTo $PostTravlePackages
 * @property \Cake\ORM\Association\BelongsTo $PostTravlePackageCategories
 *
 * @method \App\Model\Entity\PostTravlePackageRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\PostTravlePackageRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PostTravlePackageRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PostTravlePackageRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostTravlePackageRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PostTravlePackageRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PostTravlePackageRow findOrCreate($search, callable $callback = null, $options = [])
 */
class PostTravlePackageRowsTable extends Table
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

        $this->table('post_travle_package_rows');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('PostTravlePackages', [
            'foreignKey' => 'post_travle_package_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('PostTravlePackageCategories', [
            'foreignKey' => 'post_travle_package_category_id',
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
        $rules->add($rules->existsIn(['post_travle_package_category_id'], 'PostTravlePackageCategories'));

        return $rules;
    }
}
