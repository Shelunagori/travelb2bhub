<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class requests extends Model {

    protected $table = 'requests';
    public function users() {
        return $this->belongsTo('\App\users', 'user_id');
	}
	public function authors() {
        return $this->belongsTo('\App\users', 'author_id');
	}

}
