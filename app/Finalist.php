<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Finalist extends Model
{
    use SoftDeletes;
    protected $table = 'finalist';
    public $timestamps = false;

    protected $fillable = ['contestantid'];
}
