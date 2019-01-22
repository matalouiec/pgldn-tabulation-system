<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'rating';

    public function RatingEntries(){
        return $this->hasMany('App\RatingEntry','parentid');
    }

    public function Contestant(){
        return $this->belongsTo('App\Contestant','contestantid');
    }
}
