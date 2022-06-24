<?php

namespace App\Exports;

use App\Models\Formadores;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FormadorExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
//        dd(Cursos::all());
        return Formadores::all();
    }

    public function headings(): array
    {
        return[
            'Id',
            'created_at',
            'updated_at',
            'deleted_at',
            'codigo',
            'entidad',
            'apellidos',
            'nombre',
            'dni',
            'dni_img',
            'operador_pdf',
            'cert_empresa_pdf',

            'vida_laboral_pdf',
            'prl_pdf',
            'pemp_pdf',
            'cap_pdf',
            'fecha',
            'estado',

        ];
    }
}
