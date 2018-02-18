<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * PriceMaster Entity
 *
 * @property int $id
 * @property int $promotion_type_id
 * @property float $price
 * @property string $week
 * @property int $is_deleted
 *
 * @property \App\Model\Entity\PromotionType $promotion_type
 * @property \App\Model\Entity\EventPlannerPromotion[] $event_planner_promotions
 * @property \App\Model\Entity\PostTravlePackage[] $post_travle_packages
 * @property \App\Model\Entity\TaxiFleetPromotion[] $taxi_fleet_promotions
 */
class PriceMaster extends Entity
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
