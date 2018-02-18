<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PromotionTypes Model
 *
 * @property \Cake\ORM\Association\HasMany $PriceMasters
 *
 * @method \App\Model\Entity\PromotionType get($primaryKey, $options = [])
 * @method \App\Model\Entity\PromotionType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PromotionType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PromotionType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PromotionType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PromotionType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PromotionType findOrCreate($search, callable $callback = null, $options = [])
 */
class PromotionTypesTable extends Table
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

        $this->table('promotion_types');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->hasMany('PriceMasters', [
            'foreignKey' => 'promotion_type_id'
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
