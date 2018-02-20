<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TaxiFleetPromotionViews Model
 *
 * @property \Cake\ORM\Association\BelongsTo $TaxiFleetPromotions
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\TaxiFleetPromotionView get($primaryKey, $options = [])
 * @method \App\Model\Entity\TaxiFleetPromotionView newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TaxiFleetPromotionView[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TaxiFleetPromotionView|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaxiFleetPromotionView patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TaxiFleetPromotionView[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TaxiFleetPromotionView findOrCreate($search, callable $callback = null, $options = [])
 */
class TaxiFleetPromotionViewsTable extends Table
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

        $this->table('taxi_fleet_promotion_views');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('TaxiFleetPromotions', [
            'foreignKey' => 'taxi_fleet_promotion_id',
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
        $rules->add($rules->existsIn(['taxi_fleet_promotion_id'], 'TaxiFleetPromotions'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
