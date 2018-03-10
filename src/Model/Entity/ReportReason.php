<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ReportReason Entity
 *
 * @property int $id
 * @property int $promotion_types_id
 * @property string $reason
 *
 * @property \App\Model\Entity\PromotionType $promotion_type
 * @property \App\Model\Entity\EventPlannerPromotionReport[] $event_planner_promotion_reports
 * @property \App\Model\Entity\PostTravlePackageReport[] $post_travle_package_reports
 * @property \App\Model\Entity\TaxiFleetPromotionReport[] $taxi_fleet_promotion_reports
 */
class ReportReason extends Entity
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
