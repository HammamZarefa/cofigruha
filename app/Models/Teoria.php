<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teoria extends Model 
{

    protected $table = 'teoria';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function cursos()
    {
        return $this->hasOne('App\Model\Cursos', 'examen-t');
    }

    public function asistent()
    {
        return $this->hasMany('App\Model\Asistent', 'tipo_carnet');
    }

}