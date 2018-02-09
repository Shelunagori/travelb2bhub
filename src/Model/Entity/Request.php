<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Request Entity
 *
 * @property int $id
 * @property int $category_id
 * @property int $user_id
 * @property int $final_id
 * @property int $state_id
 * @property int $country_id
 * @property string $locality
 * @property string $reference_id
 * @property int $response_id
 * @property int $total_budget
 * @property string $children
 * @property string $adult
 * @property string $room1
 * @property string $room2
 * @property string $room3
 * @property string $child_with_bed
 * @property string $child_without_bed
 * @property int $hotel_rating
 * @property string $hotel_category
 * @property string $meal_plan
 * @property int $destination_city
 * @property \Cake\I18n\Time $check_in
 * @property \Cake\I18n\Time $check_out
 * @property string $transport_requirement
 * @property int $pickup_city
 * @property int $pickup_state
 * @property int $pickup_country
 * @property string $pickup_locality
 * @property int $city_id
 * @property string $final_locality
 * @property int $final_city
 * @property int $final_state
 * @property int $final_country
 * @property string $comment
 * @property \Cake\I18n\Time $start_date
 * @property \Cake\I18n\Time $end_date
 * @property string $stops
 * @property int $status
 * @property int $is_deleted
 * @property \Cake\I18n\Time $accept_date
 * @property \Cake\I18n\Time $created
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\UserRating $user_rating
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Response[] $responses
 * @property \App\Model\Entity\Hotel[] $hotels
 * @property \App\Model\Entity\RequestStop[] $request_stops
 */
class Request extends Entity
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
