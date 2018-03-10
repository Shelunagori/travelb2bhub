<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * HotelPromotionReports Model
 *
 * @property \Cake\ORM\Association\BelongsTo $HotelPromotions
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $ReportReasons
 *
 * @method \App\Model\Entity\HotelPromotionReport get($primaryKey, $options = [])
 * @method \App\Model\Entity\HotelPromotionReport newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\HotelPromotionReport[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\HotelPromotionReport|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\HotelPromotionReport patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\HotelPromotionReport[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\HotelPromotionReport findOrCreate($search, callable $callback = null)
 */
class HotelPromotionReportsTable extends Table
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

        $this->table('hotel_promotion_reports');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('HotelPromotions', [
            'foreignKey' => 'hotel_promotion_id',
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
        $rules->add($rules->existsIn(['hotel_promotion_id'], 'HotelPromotions'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['report_reason_id'], 'ReportReasons'));

        return $rules;
    }
}
