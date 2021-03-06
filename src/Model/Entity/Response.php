<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Response Entity
 *
 * @property int $id
 * @property int $request_id
 * @property int $user_id
 * @property string $comment
 * @property float $quotation_price
 * @property int $is_details_shared
 * @property \Cake\I18n\Time $created
 * @property int $status
 * @property bool $is_deleted
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Request $request
 * @property \App\Model\Entity\Testimonial $testimonial
 * @property \App\Model\Entity\UserChat[] $user_chats
 */
class Response extends Entity
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
