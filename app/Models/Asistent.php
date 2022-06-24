<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asistent extends Model
{

    protected $table = 'asistent';
    public $timestamps = true;
    protected $guarded=[];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function cursos()
    {
        return $this->belongsTo(Cursos::class, 'curso');
    }

    public function operadores()
    {
        return $this->belongsTo(Operadores::class, 'operador');
    }

    public function teoria()
    {
        return $this->belongsTo('App\Model\Teoria', 'tipo_carnet');
    }

    public function tipo_maquina()
    {
        return $this->belongsTo(Tipo_Maquina::class, 'tipo_1');
    }

}
