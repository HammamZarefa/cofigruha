<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Horario extends Model
{
    protected $guarded=[];
    protected $table = 'horario';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function cursos()
    {
        return $this->belongsTo(Cursos::class, 'curso');
    }

    public function tipo_maquinaa()
    {
        return $this->belongsTo(Tipo_Maquina::class, 'tipo_maquina');
    }

}
