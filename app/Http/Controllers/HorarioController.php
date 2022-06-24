<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Models\EntidadesFormadoreas;
use App\Models\Examen;
use App\Models\Formadores;
use App\Models\Tipo_De_Curso;
use App\Models\Tipo_Maquina;
use Illuminate\Http\Request;
use App\Models\Horario;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $horario = Horario::all();
        $cursos = Cursos::select('id','codigo')->get();
//        dd($cursos[0]->id);
        return view ('admin.horario.index', compact('horario','cursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $curso=Cursos::select('id','curso','codigo')->get();
        $tipo_maq = Tipo_Maquina::select('id','tipo_maquina')->get();
        $corse = Cursos::where('id', $id)->first();
        $tipo_1 = $corse->tipo_maquina_1;
        $tipo_2 = $corse->tipo_maquina_2;
        $tipo_3 = $corse->tipo_maquina_3;
        $tipo_4 = $corse->tipo_maquina_4;
        $tipos = [$tipo_1,$tipo_2,$tipo_3,$tipo_4];
        return view('admin.horario.create',compact('curso','id','tipo_maq','tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'curso' => 'required',
            'contenido' => 'required',
            'fecha_inicio' => 'required',
            'final' => 'required',
            'alumnos' => 'required',
        ]);
        $data = $request->all();
        if ($data['contenido'] == "1"){
            $data['tipo_maquina'] = 0;
//            dd($data['tipo_maquina'] );
        }



        $horario = Horario::create($data);
        $cursos = Cursos::findOrFail($request->curso);
        $entidad=EntidadesFormadoreas::select('id','nombre')->get();
        $formador=Formadores::select('id','nombre')->get();
        $tipo_maquina=Tipo_Maquina::select('id','tipo_maquina')->get();
        $tipo_curso=Tipo_De_Curso::select('id','tipo_curso')->get();
        $examen_t=Examen::select('id','nombre')->where('tipo',1)->get();
        $examen_p=Examen::select('id','nombre')->where('tipo',2)->get();
        $formadors=Formadores::select('id','nombre')->get();
        $formadors2=Formadores::select('id','nombre')->get();
        $formadors3=Formadores::select('id','nombre')->get();

        if ($horario) {

            return redirect()->route('admin.cursos.edit',$cursos->id)->with('cursos','entidad','formador','tipo_maquina','tipo_curso','examen_t','examen_p','formadors','formadors2','formadors3');

        } else {

            return redirect()->route('admin.horario.create')->with('error', 'Data Gagal Ditambahkan');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $horario = Horario::findOrFail($id);
        $tipo_maq = Tipo_Maquina::select('id','tipo_maquina')->get();
        $curso=Cursos::select('id','curso','codigo')->get();
        $corse = Cursos::where('id', $horario->curso)->first();
        $tipo_1 = $corse->tipo_maquina_1;
        $tipo_2 = $corse->tipo_maquina_2;
        $tipo_3 = $corse->tipo_maquina_3;
        $tipo_4 = $corse->tipo_maquina_4;
        $tipos = [$tipo_1,$tipo_2,$tipo_3,$tipo_4];
//        dd($horario);
        return view ('admin.horario.edit', compact('horario','curso','tipo_maq','tipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'curso' => 'required',
            'contenido' => 'required',
            'fecha_inicio' => 'required',
            'final' => 'required',
            'alumnos' => 'required',
        ]);
        $horario = horario::findOrFail($id);

        $horario->curso = $request->curso;
        $horario->contenido = $request->contenido;
        $horario->alumnos = $request->alumnos;
        $horario->fecha_inicio = $request->fecha_inicio;
        $horario->final = $request->final;
        if ($request->contenido == "1"){
            $horario->tipo_maquina= 0;
        }else{
            $horario->tipo_maquina = $request->tipo_maquina;
        }






        if ($horario->save()) {

            return redirect()->route('admin.cursos.edit', [$horario->curso])->with('success', 'Data updated successfully');

        } else {

            return redirect()->route('admin.horario.edit')->with('error', 'Data Gagal Diperbarui');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Horario = Horario::findOrFail($id);

        $Horario->delete();

        return redirect()->route('admin.horario')->with('success', 'Data Berhasil Dihapus');
    }
}
