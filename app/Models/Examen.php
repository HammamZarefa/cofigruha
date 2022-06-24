<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examen extends Model
{

    protected $table = 'examen';
    public $timestamps = true;
    protected $guarded=[];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
