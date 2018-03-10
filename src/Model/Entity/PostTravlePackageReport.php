<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PostTravlePackageReport Entity
 *
 * @property int $id
 * @property int $post_travle_package_id
 * @property int $user_id
 * @property int $report_reason_id
 * @property string $comment
 * @property \Cake\I18n\Time $created_on
 *
 * @property \App\Model\Entity\PostTravlePackage $post_travle_package
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\ReportReason $report_reason
 */
class PostTravlePackageReport extends Entity
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
