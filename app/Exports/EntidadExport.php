<?php

namespace App\Exports;

use App\Models\EntidadesFormadoreas;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EntidadExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $entidades= EntidadesFormadoreas::all();
        foreach ($entidades as $entidad)
        {
            $entidad->fecha=date('d/m/Y',strtotime($entidad->fecha));
        }
        return $entidades;
    }

    public function headings(): array
    {
        return[
            'Id',
            'socio',
            'cif',
            'nombre',
            'razon_social',
            'province',
            'ciudad',
            'direccion',
            'codigo_postal',
            'logo',
            'web',
            'mail',
            'doc_medios_pdf',
            'fecha',
            'estado',
            'certificado',

        ];
    }
}
