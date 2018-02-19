<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PostTravlePackageLike Entity
 *
 * @property int $id
 * @property int $post_travle_package_id
 * @property int $user_id
 *
 * @property \App\Model\Entity\PostTravlePackage $post_travle_package
 * @property \App\Model\Entity\User $user
 */
class PostTravlePackageLike extends Entity
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
