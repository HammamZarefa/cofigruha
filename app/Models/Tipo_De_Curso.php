<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipo_De_Curso extends Model 
{

    protected $table = 'tipo_de_curso';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function cursos()
    {
        return $this->hasOne('App\Model\Cursos', 'tipo_curso');
    }

}