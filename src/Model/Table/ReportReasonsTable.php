<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ReportReasons Model
 *
 * @property \Cake\ORM\Association\BelongsTo $PromotionTypes
 * @property \Cake\ORM\Association\HasMany $EventPlannerPromotionReports
 * @property \Cake\ORM\Association\HasMany $PostTravlePackageReports
 * @property \Cake\ORM\Association\HasMany $TaxiFleetPromotionReports
 *
 * @method \App\Model\Entity\ReportReason get($primaryKey, $options = [])
 * @method \App\Model\Entity\ReportReason newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ReportReason[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ReportReason|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ReportReason patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ReportReason[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ReportReason findOrCreate($search, callable $callback = null, $options = [])
 */
class ReportReasonsTable extends Table
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

        $this->table('report_reasons');
        $this->displayField('reason');
        $this->primaryKey('id');

        $this->belongsTo('PromotionTypes', [
            'foreignKey' => 'promotion_types_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('EventPlannerPromotionReports', [
            'foreignKey' => 'report_reason_id'
        ]);
        $this->hasMany('PostTravlePackageReports', [
            'foreignKey' => 'report_reason_id'
        ]);
        $this->hasMany('TaxiFleetPromotionReports', [
            'foreignKey' => 'report_reason_id'
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
            ->requirePresence('reason', 'create')
            ->notEmpty('reason');

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
        $rules->add($rules->existsIn(['promotion_types_id'], 'PromotionTypes'));

        return $rules;
    }
}
