<?php

namespace App\Exports;

use App\Models\Asistent;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AssistantExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $asistents= Asistent::select('id','curso','orden','operador','tipo_carnet','nota_t','nota_p',
            'examen_t_pdf','examen_p_pdf','tipo_1','tipo_2','tipo_3','tipo_4',
            'emision','vencimiento','observaciones','tipos_carnet')->get();

        foreach ($asistents as $asistent)
        {
            $asistent->emision=date('d/m/Y',strtotime($asistent->emision));
            $asistent->vencimiento=date('d/m/Y',strtotime($asistent->vencimiento));
        }
        return $asistents;
    }

    public function headings(): array
    {
        return[
            'Id',
            'curso',
            'orden',
            'operador',
            'tipo_carnet',
            'nota_t',
            'nota_p',
            'examen_t_pdf',
            'examen_p_pdf',

            'tipo_1',
            'tipo_2',
            'tipo_3',
            'tipo_4',
            'emision',
            'vencimiento',
            'observaciones',
            'tipos_carnet',

        ];
    }
}
