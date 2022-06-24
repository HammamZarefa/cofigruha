<?php

namespace App\Exports;

use App\Models\Operadores;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OperatorExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
//        dd(Cursos::all());
        return Operadores::all();
    }

    public function headings(): array
    {
        return[
            'Id',
            'created_at',
            'updated_at',
            'deleted_at',
            'dni',
            'apellidos',
            'nombre',
            'entidad',
            'foto',
            'dni_img',
            'fecha_nacimiento',
            'provincia',

            'ciudad',
            'direccion',
            'codigo_postal',
            'mail',
            'carnet',
            'fecha',
            'estado',

        ];
    }
}
