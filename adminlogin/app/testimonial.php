<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class testimonial extends Model {
    protected $table = 'testimonial';
	 public function users() {
        return $this->belongsTo('\App\users', 'user_id');
		}
	public function authors() {
        return $this->belongsTo('\App\users', 'author_id');
		}
}
