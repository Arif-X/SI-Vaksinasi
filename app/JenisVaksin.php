<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisVaksin extends Model
{
    public $timestamps = false;
    protected $table = 'jenis_vaksin';
    protected $guarded = [];
}
