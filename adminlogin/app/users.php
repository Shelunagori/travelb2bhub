<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class users extends Model {

    protected $table = 'users';
	public function cities() {
        return $this->belongsTo('\App\cities', 'city_id');
}
	public function states() {
        return $this->belongsTo('\App\states', 'state_id');
}

}
