<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carnet extends Model
{

    protected $table = 'carnet';
    public $timestamps = true;
    protected $guarded=[];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function operadores()
    {
        return $this->belongsTo(Operadores::class, 'operador');
    }

    public function cursos()
    {
        return $this->belongsTo('App\Model\Cursos', 'curso');
    }

    public function Tipo_Maquinas()
    {
        return $this->belongsToMany(Tipo_Maquina::class);
    }

}
