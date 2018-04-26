<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HotelPromotion Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $hotel_name
 * @property string $hotel_location
 * @property int $hotel_category_id
 * @property float $cheap_tariff
 * @property float $expensive_tariff
 * @property string $website
 * @property string $status
 * @property int $hotel_pic
 * @property string $payment_status
 * @property float $total_charges
 * @property int $price_master_id
 * @property \Cake\I18n\Time $visible_date
 * @property int $hotel_rating
 * @property \Cake\I18n\Time $created_on
 * @property \Cake\I18n\Time $updated_on
 * @property \Cake\I18n\Time $accept_date
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\HotelCategory $hotel_category
 * @property \App\Model\Entity\PriceMaster $price_master
 * @property \App\Model\Entity\HotelPromotionCity[] $hotel_promotion_cities
 * @property \App\Model\Entity\HotelPromotionLike[] $hotel_promotion_likes
 * @property \App\Model\Entity\HotelPromotionPriceBeforeRenews[] $hotel_promotion_price_before_renews
 * @property \App\Model\Entity\HotelPromotionReport[] $hotel_promotion_reports
 * @property \App\Model\Entity\HotelPromotionView[] $hotel_promotion_views
 */
class HotelPromotion extends Entity
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
	protected $_virtual = [
       'full_image'
    ];	
	
	protected function _getFullImage()
	{
		if(!empty($this->_properties['hotel_pic']))
		{
			return 'http://udaipurcare.com/travelb2b/webroot/'. $this->_properties['hotel_pic'];
		}
	}
}
