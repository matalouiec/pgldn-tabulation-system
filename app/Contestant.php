<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contestant extends Model
{
    protected $table = 'contestant';

    public function Rating(){
        return $this->hasMany('App\Rating');
    }
}
