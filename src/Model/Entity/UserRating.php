<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * UserRating Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $request_id
 * @property int $rating
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Author $author
 * @property \App\Model\Entity\Promotion $promotion
 */
class UserRating extends Entity
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
