<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TaxiFleetPromotionRow Entity
 *
 * @property int $id
 * @property int $taxi_fleet_promotion_id
 * @property int $taxi_fleet_car_bus_id
 *
 * @property \App\Model\Entity\TaxiFleetPromotion $taxi_fleet_promotion
 * @property \App\Model\Entity\TaxiFleetCarBus $taxi_fleet_car_bus
 */
class TaxiFleetPromotionRow extends Entity
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
