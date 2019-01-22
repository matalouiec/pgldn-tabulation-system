<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RatingEntry extends Model
{
    protected $table = 'rating_entry';

    public function Rating(){
        return $this->belongsTo('App\Rating');
    }
}
