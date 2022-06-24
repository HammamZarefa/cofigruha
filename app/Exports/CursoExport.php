<?php

namespace App\Exports;

use App\Models\Cursos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CursoExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
//        dd(Cursos::all());
        $cursos = Cursos::all();
        foreach ($cursos as $curso){
            if ($curso->estado == 1){
                $curso->estado = true;
            }else{
                $curso->estado = false;
            }
            if ($curso->cerrado == 1){
                $curso->cerrado = true;
            }else{
                $curso->cerrado = false;
            }

            if ($curso->publico_privado == 1){
                $curso->publico_privado = "publico";
            }else{
                $curso->publico_privado = 'privado';
            }
        }
        return $cursos;
    }

    public function headings(): array
    {
        return[
            'Id',
            'created_at',
            'updated_at',
            'deleted_at',
            'curso',
            'tipo_curso',
            'tipo_maquina_1',
            'tipo_maquina_2',
            'tipo_maquina_3',
            'tipo_maquina_4',
            'codigo',
            'entidad',

            'formador',
            'formador_apoyo_1',
            'formador_apoyo_2',
            'formador_apoyo_3',
            'fecha_inicio',
            'direccion',
            'ciudad',
            'provincia',
            'codigo_postal',
            'examen_t',
            'examen_p',
            'asistentes_pdf',
            'fecha_alta',
            'publico_privado',
            'observaciones',
            'cerrado',
            'estado',
        ];
    }
}
