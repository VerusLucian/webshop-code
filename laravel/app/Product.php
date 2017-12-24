<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    public function warehouse()
    {
        return $this->hasMany('App\Warehouse');
    }
    public function image()
    {
        return $this->hasMany('App\image');
    }
    public function brand()
    {
        return $this->hasMany('App\brand');
    }
    public function house()
    {
        return $this->belongsTo('App\house');
    }
    public function category()
    {
        return $this->belongsTo('App\categorie');
    }
}
