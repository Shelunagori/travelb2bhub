<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PostTravlePackages Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Currencies
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\BelongsTo $PriceMasters
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\HasMany $PostTravlePackageCities
 * @property \Cake\ORM\Association\HasMany $PostTravlePackageRows
 * @property \Cake\ORM\Association\HasMany $PostTravlePackageStates
 *
 * @method \App\Model\Entity\PostTravlePackage get($primaryKey, $options = [])
 * @method \App\Model\Entity\PostTravlePackage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PostTravlePackage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PostTravlePackage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PostTravlePackage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PostTravlePackage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PostTravlePackage findOrCreate($search, callable $callback = null, $options = [])
 */
class PostTravlePackagesTable extends Table
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

        $this->table('post_travle_packages');
        $this->displayField('title');
        $this->primaryKey('id');

        $this->belongsTo('Currencies', [
            'foreignKey' => 'currency_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('PriceMasters', [
            'foreignKey' => 'price_master_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('PostTravlePackageCities', [
            'foreignKey' => 'post_travle_package_id',
			'saveStrategy'=>'replace'
        ]);
        $this->hasMany('PostTravlePackageRows', [
            'foreignKey' => 'post_travle_package_id',
			'saveStrategy'=>'replace'
        ]);
        $this->hasMany('PostTravlePackageLikes', [
            'foreignKey' => 'post_travle_package_id'
        ]);
		$this->hasMany('PostTravlePackageViews', [
            'foreignKey' => 'post_travle_package_id'
        ]);
        $this->hasMany('PostTravlePackageStates', [
            'foreignKey' => 'post_travle_package_id',
			'saveStrategy'=>'replace'
        ]);
        $this->hasMany('PostTravlePackageCountries', [
            'foreignKey' => 'post_travle_package_id',
			'saveStrategy'=>'replace'
        ]);
        $this->hasMany('PostTravlePackagePriceBeforeRenews', [
            'foreignKey' => 'post_travle_package_id'
        ]);
		$this->hasMany('PostTravlePackageCarts', [
            'foreignKey' => 'post_travle_package_id'
        ]);
		$this->hasMany('PostTravlePackageReports', [
            'foreignKey' => 'post_travle_package_id'
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
            ->requirePresence('title', 'create')
            ->notEmpty('title');

/*         $validator
            ->integer('duration_night')
            ->requirePresence('duration_night', 'create')
            ->notEmpty('duration_night');

        $validator
            ->integer('duration_day')
            ->requirePresence('duration_day', 'create')
            ->notEmpty('duration_day'); */

        /* $validator
            ->date('valid_date')
            ->requirePresence('valid_date', 'create')
            ->notEmpty('valid_date'); */

        $validator
            ->decimal('starting_price')
            ->requirePresence('starting_price', 'create')
            ->notEmpty('starting_price');

        $validator
            ->requirePresence('package_detail', 'create')
            ->notEmpty('package_detail');

  /*       $validator
            ->requirePresence('image', 'create')
            ->notEmpty('image');

        $validator
            ->date('visible_date')
            ->requirePresence('visible_date', 'create')
            ->notEmpty('visible_date'); */

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
        $rules->add($rules->existsIn(['currency_id'], 'Currencies'));
        $rules->add($rules->existsIn(['country_id'], 'Countries'));
        $rules->add($rules->existsIn(['price_master_id'], 'PriceMasters'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
