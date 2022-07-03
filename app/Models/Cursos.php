<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cursos extends Model
{
    protected $guarded=[];
    protected $table = 'cursos';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function entidades_formadoreas()
    {
        return $this->belongsTo(EntidadesFormadoreas::class, 'entidad');
    }

    public function formadores()
    {
        return $this->belongsTo(Formadores::class, 'formador' );
    }

    public function tipo_maquina()
    {
        return $this->belongsTo(Tipo_Maquina::class, 'tipo_maquina_1', 'tipo_maquina_2', 'tipo_maquina_3', 'tipo_maquina_4');
    }

    public function tipo_de_curso()
    {
        return $this->belongsTo(Tipo_De_Curso::class, 'tipo_curso');
    }

    public function teoria()
    {
        return $this->belongsTo(Teoria::class, 'examen-t');
    }

    public function practica()
    {
        return $this->belongsTo('App\Model\Practica', 'examen-p');
    }

    public function horario()
    {
        return $this->hasMany(Horario::class, 'curso');
    }

    public function certificados()
    {
        return $this->hasMany(Certificado::class, 'curso');
    }

    public function asistent()
    {
        return $this->hasMany(Asistent::class, 'curso');
    }

    public function carnet()
    {
        return $this->hasMany('App\Model\Carnet', 'curso');
    }

}
