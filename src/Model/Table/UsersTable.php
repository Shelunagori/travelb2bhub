<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Areas
 * @property \Cake\ORM\Association\BelongsTo $Cities
 * @property \Cake\ORM\Association\BelongsTo $States
 * @property \Cake\ORM\Association\BelongsTo $Countries
 * @property \Cake\ORM\Association\HasMany $Schools
 */
class UsersTable extends Table
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

        $this->table('users');
        $this->displayField('first_name');
        $this->displayField('last_name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');
        
        $this->hasMany('ADmad/HybridAuth.SocialProfiles');
        \Cake\Event\EventManager::instance()->on('HybridAuth.newUser', [$this, 'createUser']);
        
        
        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER'
        ]); 
        $this->belongsTo('Cities', [
            'foreignKey' => 'city_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('States', [
            'foreignKey' => 'state_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Countries', [
            'foreignKey' => 'country_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Requests', [
            'foreignKey' => 'user_id',
            'dependent' => TRUE
        ]);
		$this->hasMany('Responses', [
            'foreignKey' => 'user_id',
            'dependent' => TRUE
        ]);
		 $this->hasMany('Hotels', [
            'foreignKey' => 'user_id',
            'dependent' => TRUE
        ]);
		 $this->hasMany('Transports', [
            'foreignKey' => 'user_id',
            'dependent' => TRUE
        ]);
		 
        $this->hasOne('Credits', [
            'foreignKey' => 'user_id',
            'dependent' => TRUE
        ]);
		$this->hasMany('Promotion', [
            'foreignKey' => 'user_id'
        ]);
        
		 $this->hasMany('Testimonial', [
            'foreignKey' => 'user_id',
            'dependent' => TRUE
        ]);
		$this->hasMany('BusinessBuddies');
        
    }
    public function createUser(\Cake\Event\Event $event) {
		// Entity representing record in social_profiles table
		$profile = $event->data()['profile'];

		$user = $this->newEntity(['email' => $profile->email]);
		$user = $this->save($user);

		if (!$user) {
			throw new \RuntimeException('Unable to save new user');
		}
		
		return $user;
	
    }
    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
  

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        
        $rules->add($rules->isUnique(['email']));

        return $rules;
    }
    
    
    
    public function validationDefault(Validator $validator) {
        $validator->add(
        'email', 
        ['unique' => [
            'rule' => 'validateUnique', 
            'provider' => 'table', 
            'message' => 'Not unique']
        ]
    );

        

        return $validator;
    }
   public function getAllUserCount($cityid)
   {
    $query = $this->find('all', [
    'conditions' => ['Users.city_id ' => $cityid,'Users.role_id !=' =>2]
]);
$usercount = $query->count();

    return $usercount ;
   }
}
