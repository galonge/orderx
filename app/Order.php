<?php

namespace App;


use Sofa\Eloquence\Eloquence;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;



class Order extends Model
{

	use Eloquence;

    //create relationship with user model
    public function user() {
    	return $this->belongsTo('App\User');
    }

     public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
