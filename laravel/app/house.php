<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class house extends Model
{
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
