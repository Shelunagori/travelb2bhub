<?php
namespace App\Model\Entity;
use Cake\Auth\DefaultPasswordHasher; //include this line
use Cake\ORM\Entity;

/**
 * Admin Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $permissions
 * @property bool $activated
 * @property string $activation_code
 * @property \Cake\I18n\Time $activated_at
 * @property \Cake\I18n\Time $last_login
 * @property string $persist_code
 * @property string $reset_password_code
 * @property string $remember_token
 * @property string $first_name
 * @property string $last_name
 * @property string $formemail
 * @property \Cake\I18n\Time $created_at
 * @property \Cake\I18n\Time $updated_at
 *
 * @property \App\Model\Entity\AdminRole[] $admin_role
 */
class Admin extends Entity
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
    
    protected function _setPassword($password)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($password);
    }
}
