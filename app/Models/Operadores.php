<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Operadores extends Model
{

    protected $table = 'operadores';
    public $timestamps = true;
    protected $guarded=[];
//    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function entidades_formadoreas()
    {
        return $this->belongsTo(EntidadesFormadoreas::class, 'entidad');
    }

    public function asistent()
    {
        return $this->hasMany(Asistent::class, 'operador');
    }

    public function carnett()
    {
        return $this->hasOne(Carnet::class, 'operador');
    }

    public function certificado()
    {
        return $this->hasMany(Certificado::class, 'operador');
    }

}
