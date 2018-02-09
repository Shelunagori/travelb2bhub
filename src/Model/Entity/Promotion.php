<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Promotion Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $hotel_name
 * @property int $hotel_rating
 * @property string $hotel_location
 * @property string $hotel_type
 * @property int $cheap_tariff
 * @property int $expensive_tariff
 * @property string $website
 * @property string $cities
 * @property int $charges
 * @property int $duration
 * @property string $status
 * @property string $hotel_pic
 * @property string $payment_status
 * @property string $citycharge
 * @property \Cake\I18n\Time $expiry_date
 * @property int $count
 * @property \Cake\I18n\Time $created_at
 * @property \Cake\I18n\Time $updated_at
 * @property \Cake\I18n\Time $accept_date
 *
 * @property \App\Model\Entity\User $user
 */
class Promotion extends Entity
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
