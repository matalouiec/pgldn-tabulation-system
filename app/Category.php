<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    public function levels(){
        return $this->belongsTo('App\Level');
    }

    public function criterias(){
        return $this->hasMany('App\Criteria');
    }
}
