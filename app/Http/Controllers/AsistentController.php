<?php

namespace App\Http\Controllers;

use App\Exports\AssistantExport;
use App\Exports\CursoExport;
use Illuminate\Http\Request;

use App\Models\{
    Asistent,
    Cursos,
    EntidadesFormadoreas,
    Examen,
    Formadores,
    Operadores,
    Pcategory,
    Practica,
    Teoria,
    Tipo_De_Curso,
    Tipo_Maquina
};
use Maatwebsite\Excel\Facades\Excel;

class AsistentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asistent = Asistent::orderBy('id', 'desc')->get();
        $operador = Operadores::orderBy('id', 'desc')->get();

        return view('admin.asistent.index', compact('asistent', 'operador'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = auth()->user();
        if ($user->perfil == 'Administrador') {
            $operador = Operadores::select('id', 'nombre', 'apellidos')->get();
        } else {
            $operador = Operadores::select('id', 'nombre', 'apellidos')->where('entidad', '=', $user->entidad)->get();
        }
        $curso = Cursos::select('id', 'codigo')->get();
        $cursos = Cursos::orderBy('id', 'desc')->get();

        $tipo_carnet = Teoria::select('id', 'formacion')->get();
        $tipo = Tipo_Maquina::orderBy('id', 'desc')->get();
        $corse = Cursos::where('id', $id)->first();
        $x =Asistent::select('orden')->orderBy('id','desc')->latest()->get();
        if(count($x) > 0){
            $orden = $x[0]->orden +1;
        }else{
            $orden = 1;
        }

        $tipo_1 = $corse->tipo_maquina_1;
        $tipo_2 = $corse->tipo_maquina_2;
        $tipo_3 = $corse->tipo_maquina_3;
        $tipo_4 = $corse->tipo_maquina_4;
        $tipos = [$tipo_1,$tipo_2,$tipo_3,$tipo_4];
        return view('admin.asistent.create', compact('curso','orden', 'id', 'operador', 'tipo_carnet', 'tipo', 'cursos', 'tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'curso' => 'required',
            'orden' => 'required|max:7',
            'operador' => 'required',
            'tipo_carnet' => 'required',
            'nota_t' => 'required|numeric',
            'nota_p' => 'required|numeric',
            'tipo_1' => 'required',
        ]);
//dd($request);

        $asistent = new Asistent($request->except('_token'));
        if (!$request->tipo_2) {
            $asistent->tipo_2 = 0;
        }
        if (!$request->tipo_3) {
            $asistent->tipo_3 = 0;
        }
        if (!$request->tipo_4) {
            $asistent->tipo_4 = 0;
        }

        $examen_t_pdf = $request->file('examen_t_pdf');
        if ($examen_t_pdf) {
            $examen_t_pdf_path = $examen_t_pdf->store('asistent/', 'public');

            $asistent->examen_t_pdf = $examen_t_pdf_path;
        } else {
            $asistent->examen_t_pdf = '';
        }
        $examen_p_pdf = $request->file('examen_p_pdf');
        if ($examen_p_pdf) {
            $examen_p_pdf_path = $examen_p_pdf->store('asistent/', 'public');

            $asistent->examen_p_pdf = $examen_p_pdf_path;
        } else {
            $asistent->examen_p_pdf = '';
        }
        $operador = Operadores::findOrFail((int)$request->operador);
        $asistent->emision = $operador->fecha;
        $asistent->vencimiento = $operador->fecha_nacimiento;

//        $cover = $request->file('cover');
//
//        if($cover){
//        $cover_path = $cover->store('images/Asistent', 'public');
//        $Asistent->cover = $cover_path;
//        }
        $cursos = Cursos::findOrFail($request->curso);
        $entidad = EntidadesFormadoreas::select('id', 'nombre')->get();
        $formador = Formadores::select('id', 'nombre')->get();
        $tipo_maquina = Tipo_Maquina::select('id', 'tipo_maquina')->get();
        $tipo_curso = Tipo_De_Curso::select('id', 'tipo_curso')->get();
        $examen_t = Examen::select('id', 'nombre')->where('tipo', 1)->get();
        $examen_p = Examen::select('id', 'nombre')->where('tipo', 2)->get();
        $formadors = Formadores::select('id', 'nombre')->get();
        $formadors2 = Formadores::select('id', 'nombre')->get();
        $formadors3 = Formadores::select('id', 'nombre')->get();

        if ($asistent->save()) {
//            dd($asistent);


            return redirect()->route('admin.cursos.edit', $cursos->id)->with('cursos', 'entidad', 'formador', 'tipo_maquina', 'tipo_curso', 'examen_t', 'examen_p', 'formadors', 'formadors2', 'formadors3');

        } else {

            return redirect()->route('admin.asistent.create')->with('error', 'Data failed to add');

        }
    }

    public function export()
    {
        return Excel::download(new AssistantExport(), 'asistent.xlsx');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();
        if ($user->perfil == 'Administrador') {
            $operador = Operadores::select('id', 'nombre', 'apellidos')->get();
        } else {
            $operador = Operadores::select('id', 'nombre', 'apellidos')->where('entidad', '=', $user->entidad)->get();
        }
        $asistent = Asistent::findOrFail($id);
        $curso = Cursos::select('id', 'codigo')->get();
        $tipo_carnet = Teoria::select('id', 'formacion')->get();
        $tipo = Tipo_Maquina::orderBy('id', 'desc')->get();
        $corse = Cursos::where('id', $asistent->curso)->first();
        $tipo_1 = $corse->tipo_maquina_1;
        $tipo_2 = $corse->tipo_maquina_2;
        $tipo_3 = $corse->tipo_maquina_3;
        $tipo_4 = $corse->tipo_maquina_4;
        $tipos = [$tipo_1,$tipo_2,$tipo_3,$tipo_4];
//        dd($tipos);

        return view('admin.asistent.edit', compact('asistent', 'curso', 'operador', 'tipo_carnet', 'tipo','tipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        \Validator::make($request->all(), [
//            "category" => "required",
//            "desc" => "required"
//        ])->validate();
        $request->validate([
            'curso' => 'required',
            'orden' => 'required',
            'operador' => 'required',
            'tipo_carnet' => 'required',
            'nota_t' => 'required',
            'nota_p' => 'required',
            'tipo_1' => 'required',
        ]);
        $asistent = Asistent::findOrFail($id);
        $asistent->curso = $request->curso;
        $asistent->orden = $request->orden;
        $asistent->operador = $request->operador;
        $asistent->tipo_carnet = $request->tipo_carnet;
        $asistent->nota_t = $request->nota_t;
        $asistent->nota_p = $request->nota_p;
        $asistent->observaciones = $request->observaciones;
        $operador = Operadores::findOrFail((int)$request->operador);
        $asistent->emision = $operador->fecha;
        $asistent->vencimiento = $operador->fecha_nacimiento;
        $asistent->tipo_1 = $request->tipo_1;
        if (!$request->tipo_2) {
            $asistent->tipo_2 = 0;
        } else {
            $asistent->tipo_2 = $request->tipo_2;
        }
        if (!$request->tipo_3) {
            $asistent->tipo_3 = 0;
        } else {
            $asistent->tipo_3 = $request->tipo_3;
        }
        if (!$request->tipo_4) {
            $asistent->tipo_4 = 0;
        } else {
            $asistent->tipo_4 = $request->tipo_4;
        }


        $examen_t_pdf = $request->file('examen_t_pdf');

        if ($examen_t_pdf) {
            if ($asistent->examen_t_pdf && file_exists(storage_path('app/public/' . $asistent->examen_t_pdf))) {
                \Storage::delete('public/' . $asistent->examen_t_pdf);
            }

            $examen_t_pdf_path = $examen_t_pdf->store('images/asistent', 'public');

            $asistent->examen_t_pdf = $examen_t_pdf_path;

        }
        $examen_p_pdf = $request->file('examen_p_pdf');

        if ($examen_p_pdf) {
            if ($asistent->examen_p_pdf && file_exists(storage_path('app/public/' . $asistent->examen_p_pdf))) {
                \Storage::delete('public/' . $asistent->examen_p_pdf);
            }

            $examen_p_pdf_path = $examen_p_pdf->store('images/asistent', 'public');

            $asistent->examen_p_pdf = $examen_p_pdf_path;

        }


        if ($asistent->save()) {

            return redirect()->route('admin.cursos.edit', [$asistent->curso])->with('success', 'Data updated successfully');

        } else {

            return redirect()->route('admin.asistent.edit')->with('error', 'Data failed to update');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asistent = Asistent::findOrFail($id);
        $curso = $asistent->curso;
        $asistent->delete();

        return redirect()->route('admin.cursos.edit', [$curso])->with('success', 'Data deleted successfully');
    }
}
