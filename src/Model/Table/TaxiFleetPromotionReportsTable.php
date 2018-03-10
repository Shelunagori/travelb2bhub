<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TaxiFleetPromotionReports Model
 *
 * @property \Cake\ORM\Association\BelongsTo $TaxiFleetPromotions
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $ReportReasons
 *
 * @method \App\Model\Entity\TaxiFleetPromotionReport get($primaryKey, $options = [])
 * @method \App\Model\Entity\TaxiFleetPromotionReport newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TaxiFleetPromotionReport[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TaxiFleetPromotionReport|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaxiFleetPromotionReport patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TaxiFleetPromotionReport[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TaxiFleetPromotionReport findOrCreate($search, callable $callback = null, $options = [])
 */
class TaxiFleetPromotionReportsTable extends Table
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

        $this->table('taxi_fleet_promotion_reports');
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
        $this->belongsTo('ReportReasons', [
            'foreignKey' => 'report_reason_id',
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

        $validator
            ->requirePresence('comment', 'create')
            ->notEmpty('comment');

        $validator
            ->dateTime('created_on')
            ->requirePresence('created_on', 'create')
            ->notEmpty('created_on');

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
        $rules->add($rules->existsIn(['report_reason_id'], 'ReportReasons'));

        return $rules;
    }
}
