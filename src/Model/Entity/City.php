<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * City Entity
 *
 * @property int $id
 * @property string $name
 * @property int $state_id
 * @property int $price
 * @property string $category
 * @property \Cake\I18n\Time $updated_at
 * @property \Cake\I18n\Time $created_at
 *
 * @property \App\Model\Entity\State $state
 * @property \App\Model\Entity\Request[] $requests
 * @property \App\Model\Entity\Hotel[] $hotels
 * @property \App\Model\Entity\Transport[] $transports
 * @property \App\Model\Entity\User[] $users
 */
class City extends Entity
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
}
