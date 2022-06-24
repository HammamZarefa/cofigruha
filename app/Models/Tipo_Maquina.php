<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tipo_Maquina extends Model
{

    protected $table = 'tipo_maquina';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function cursos()
    {
        return $this->hasMany('App\Model\Cursos', 'tipo_maquina_1', 'tipo_maquina_2', 'tipo_maquina_3', 'tipo_maquina_4');
    }

    public function horarios()
    {
        return $this->hasMany('App\Model\Horario', 'tipo_maquina');
    }
    public function carnets()
    {
        return $this->belongsToMany(Carnet::class);
    }

    public function certificados()
    {
        return $this->belongsToMany(Certificado::class);
    }



}
