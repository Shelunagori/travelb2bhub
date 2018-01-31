<?php

namespace App\Model\Entity;



use Cake\ORM\Entity;





/**

 * User Entity.

 *

 * @property int $id

 * @property int $ownerid

 * @property string $email

 * @property string $first_name

 * @property string $last_name

 * @property string $password

 * @property string $mobile

 * @property string $image

 * @property string $slug

 * @property string $role

 * @property string $address

 * @property int $area_id

 * @property \App\Model\Entity\Area $area

 * @property int $city_id

 * @property \App\Model\Entity\City $city

 * @property int $state_id

 * @property \App\Model\Entity\State $state

 * @property int $country_id

 * @property \App\Model\Entity\Country $country

 * @property int $pincode

 * @property int $status

 * @property int $deleted

 * @property int $created

 * @property int $modified

 * @property \App\Model\Entity\School[] $schools

 */

class Hotel extends Entity

{



}