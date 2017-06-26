<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //create relationship with user model
    public function user() {
    	return $this->belongsTo('App\User');
    }
}
