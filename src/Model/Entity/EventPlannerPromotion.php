<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EventPlannerPromotion Entity
 *
 * @property int $id
 * @property int $country_id
 * @property string $event_detail
 * @property string $image
 * @property string $document
 * @property int $price_master_id
 * @property \Cake\I18n\Time $visible_date
 * @property int $like_count
 * @property int $user_id
 * @property \Cake\I18n\Time $created_on
 * @property int $edited_by
 * @property \Cake\I18n\Time $edited_on
 *
 * @property \App\Model\Entity\County $county
 * @property \App\Model\Entity\PriceMaster $price_master
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\EventPlannerPromotionCity[] $event_planner_promotion_cities
 * @property \App\Model\Entity\EventPlannerPromotionState[] $event_planner_promotion_states
 */
class EventPlannerPromotion extends Entity
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
       'full_image','full_document'
    ];	
	
	protected function _getFullImage()
	{
		if(!empty($this->_properties['image']))
		{
			return 'http://konciergesolutions.com/travelb2bhub/webroot/'. $this->_properties['image'];
		}
	}
	protected function _getFullDocument()
	{
		if(!empty($this->_properties['document']))
		{
			return 'http://konciergesolutions.com/travelb2bhub/webroot/'. $this->_properties['document'];
		}
	}	
}
