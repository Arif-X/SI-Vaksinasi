<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempatVaksin extends Model
{
    public $timestamps = false;
    protected $table = 'tempat_vaksin';
    protected $guarded = [];
}
