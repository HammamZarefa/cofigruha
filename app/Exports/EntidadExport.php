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
        return EntidadesFormadoreas::all();
    }

    public function headings(): array
    {
        return[
            'Id',
            'created_at',
            'updated_at',
            'deleted_at',
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
