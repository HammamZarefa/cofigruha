<?php

namespace App\Exports;

use App\Models\Operadores;
use function GuzzleHttp\Psr7\str;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OperatorExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $operadores= Operadores::all();
        foreach ($operadores as $operador)
        {
            $operador->fecha=date('d/m/Y',strtotime($operador->fecha));
            $operador->fecha_nacimiento=date('d/m/Y',strtotime($operador->fecha_nacimiento));
        }
        return $operadores;
    }

    public function headings(): array
    {
        return[
            'Id',
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
