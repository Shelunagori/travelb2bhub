<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

class promotion extends Model {

    protected $table = 'promotion';
    public function users() {
        return $this->belongsTo('\App\users', 'user_id');
}
}
