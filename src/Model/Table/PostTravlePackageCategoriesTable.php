<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PostTravlePackageCategories Model
 *
 * @property \Cake\ORM\Association\HasMany $PostTravlePackageRows
 *
 * @method \App\Model\Entity\PostTravlePackageCategory get($primaryKey, $options = [])
 * @method \App\Model\Entity\PostTravlePackageCategory newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PostTravlePackageCategory[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PostTravlePackageCategory|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostTravlePackageCategory patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PostTravlePackageCategory[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PostTravlePackageCategory findOrCreate($search, callable $callback = null, $options = [])
 */
class PostTravlePackageCategoriesTable extends Table
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

        $this->table('post_travle_package_categories');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('PostTravlePackageRows', [
            'foreignKey' => 'post_travle_package_category_id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->integer('is_deleted')
            ->requirePresence('is_deleted', 'create')
            ->notEmpty('is_deleted');

        return $validator;
    }
}
