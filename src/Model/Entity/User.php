<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;


/**
 * User Entity.
 *
 * @property int $id
 * @property int $ownerid
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $password
 * @property string $mobile
 * @property string $image
 * @property string $slug
 * @property string $role
 * @property string $address
 * @property int $area_id
 * @property \App\Model\Entity\Area $area
 * @property int $city_id
 * @property \App\Model\Entity\City $city
 * @property int $state_id
 * @property \App\Model\Entity\State $state
 * @property int $country_id
 * @property \App\Model\Entity\Country $country
 * @property int $pincode
 * @property int $status
 * @property int $deleted
 * @property int $created
 * @property int $modified
 * @property \App\Model\Entity\School[] $schools
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];
    
    protected function _setPassword($password){
        return (new \Cake\Auth\DefaultPasswordHasher())->hash($password);
    }
}
