<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventPlannerPromotionCart Entity
 *
 * @property int $id
 * @property int $event_planner_promotion_id
 * @property int $user_id
 * @property \Cake\I18n\Time $created_on
 * @property int $is_deleted
 *
 * @property \App\Model\Entity\EventPlannerPromotion $event_planner_promotion
 * @property \App\Model\Entity\User $user
 */
class EventPlannerPromotionCart extends Entity
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
