<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class responses extends Model {

    protected $table = 'responses';
    public function users() {
        return $this->belongsTo('\App\users', 'user_id');
		}
	public function requests() {
        return $this->belongsTo('\App\requests', 'request_id');
		}

}
