<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

use Cake\ORM\TableRegistry;

class TravelHelper extends Helper
{

	public function getFormatedPrice($price) {
		$formatedPrice = "";
		if(!empty($price)) {
			$formatedPrice = number_format($price, 2, ".", ",");
		}
		return $formatedPrice;
	}
}