<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formadores extends Model 
{

    protected $table = 'formadores';
    public $timestamps = true;
    protected $guarded=[];
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function entidades_formadoreas()
    {
        return $this->belongsTo('App/Model\Entidades_Formadoreas', 'entidad');
    }

}