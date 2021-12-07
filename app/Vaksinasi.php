<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaksinasi extends Model
{
    public $timestamps = false;
    protected $table = 'vaksinasi';
    protected $guarded = [];
}
