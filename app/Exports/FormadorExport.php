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
        $formadores= Formadores::all();
        foreach ($formadores as $formador)
        {
            $formador->fecha=date('d/m/Y',strtotime($formador->fecha));
        }
        return $formadores;
    }

    public function headings(): array
    {
        return[
            'Id',
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
