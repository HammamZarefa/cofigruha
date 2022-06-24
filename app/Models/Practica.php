<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Practica extends Model 
{

    protected $table = 'practica';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function cursos()
    {
        return $this->hasOne('App\Model\Cursos', 'examen-p');
    }

    public function asistent()
    {
        return $this->hasMany('App\Model\Asistent', 'tipo_1', 'tipo_2', 'tipo_3', 'tipo_4');
    }

}