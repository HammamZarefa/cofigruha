<?php

namespace App\Http\Controllers;

use App\Exports\CursoExport;
use Illuminate\Http\Request;

use App\Models\{Asistent,
    Cursos,
    EntidadesFormadoreas,
    Examen,
    Formadores,
    Horario,
    Operadores,
    Pcategory,
    Tipo_De_Curso,
    Tipo_Maquina};
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use http\Env\Response;

class CursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cursos = Cursos::orderBy('id','desc')->where('estado',1)->get();

        return view('admin.cursos.index',compact('cursos'));
    }

    public function prnpriview()
    {
        $cursos = Cursos::orderBy('id','desc')->where('estado',1)->get();

        return view('admin.cursos.index',compact('cursos'));
    }



    public function print($id)
    {
        $cursos = Cursos::where('id',$id)->first();
        $formador1 = Formadores::where('id',$cursos->formador_apoyo_1)->first();
        $formador2 = Formadores::where('id',$cursos->formador_apoyo_2)->first();
        $formador3 = Formadores::where('id',$cursos->formador_apoyo_3)->first();
        $examen_t = Examen::where('id',$cursos->examen_t)->first();


        return view('admin.cursos.print',compact('cursos','examen_t','formador1','formador2','formador3'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index2()
    {

        $cursos = Cursos::orderBy('id','desc')->where('estado',0)->get();

        return view('admin.cursos.index',compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = auth()->user();
//        dd($user);
        if($user->perfil=='Administrador'){
            $entidad=EntidadesFormadoreas::select('id','nombre')->get();
            $formador=Formadores::select('id','nombre')->get();
            $formadors=Formadores::select('id','nombre')->get();
            $formadors2=Formadores::select('id','nombre')->get();
            $formadors3=Formadores::select('id','nombre')->get();
        }else{
            $entidad=EntidadesFormadoreas::select('id','nombre')->where('id','=',$user->entidad)->first();
            $formador=Formadores::select('id','nombre')->where('entidad','=',$user->entidad)->get();
            $formadors=Formadores::select('id','nombre')->where('entidad','=',$user->entidad)->get();
            $formadors2=Formadores::select('id','nombre')->where('entidad','=',$user->entidad)->get();
            $formadors3=Formadores::select('id','nombre')->where('entidad','=',$user->entidad)->get();
        }



        $tipo_maquina=Tipo_Maquina::select('id','tipo_maquina')->get();
        $tipo_curso=Tipo_De_Curso::select('id','tipo_curso')->get();
        $examen_t=Examen::select('id','nombre')->where('tipo',1)->get();
        $examen_p=Examen::select('id','nombre')->where('tipo',2)->get();

        $x =Cursos::select('curso')->orderBy('id','desc')->latest()->get();
//        dd(count($x));
        if (count($x) > 0){
            $course_code = $x[0]->curso +1;
        }else{
            $course_code = "2200001";
        }


//        dd($course_code);

//        dd($formador[0]->nombre);
        return view('admin.cursos.create',compact('entidad','course_code','formador','tipo_maquina','tipo_curso','examen_t','examen_p','formadors','formadors2','formadors3'));
    }

    public function export()
    {
        return Excel::download(new CursoExport(), 'cursos.xlsx');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//dd($request);
        $request->validate([
            'curso' => 'required|max:255|unique:cursos',
            'tipo_curso' => 'required',
            'codigo' => 'required',
            'entidad' => 'required',
            'formador' => 'required',
            'ciudad' => 'required',
            'direccion' => 'required',
            'tipo_maquina' => 'required',
            'examen_t' => 'required',
            'examen_p' => 'required',
            'codigo_postal' => 'max:7'
        ]);
        $cursos = new Cursos($request->except('_token','tipo_maquina','examen-t','examen-p','publico-privado','estado','cerrado','fecha_alta'));
//        dd($cursos);

//        $cursos = new Cursos();
        if($request->cerrado == null){
            $cursos->cerrado = 0;
        }elseif ($request->cerrado == "1"  ||$request->cerrado == "on"){
            $cursos->cerrado = 1;
        }else{
            $cursos->cerrado = 0;
        }
        if($request->estado == null){
            $cursos->estado = 0;
        }elseif ($request->estado == "1" ||$request->estado == "on"){
            $cursos->estado = 1;
        }else{
            $cursos->estado = 0;
        }
        if($request->publico_privado == "on"){
            $cursos->publico_privado = 1;
        }else{
            $cursos->publico_privado = 0;
        }
//dd($cursos->cerrado);
        if(!$request->formador_apoyo_2){
            $cursos->formador_apoyo_2 = 0;
        }
        $x =$request->input('tipo_maquina');

$now = now().date('');
        $cursos->fecha_alta = $now;
//dd($now);

        for( $i=0 ; $i <= count($x)-1 ;$i++ ){
            if($i == 0){
                $cursos->tipo_maquina_1 = $x[$i];
//                dd($x[$i]);
                $cursos->tipo_maquina_2 = null;
                $cursos->tipo_maquina_3 = null;
                $cursos->tipo_maquina_4 = null;
            }elseif ($i == 1){
                $cursos->tipo_maquina_2 = $x[$i];
                $cursos->tipo_maquina_3 = null;
                $cursos->tipo_maquina_4 = null;
            }elseif ($i == 2){
                $cursos->tipo_maquina_3 = $x[$i];
                $cursos->tipo_maquina_4 = null;
            }elseif ($i == 3){
                $cursos->tipo_maquina_4 = $x[$i];
            }

        }

        $cursos->examen_t = $request->examen_t;
        $cursos->examen_p = $request->examen_p;



        $asistentes_pdf = $request->file('asistentes_pdf');

        if($asistentes_pdf){
            $asistentes_pdf_path = $asistentes_pdf->store('Cursos/'.$request->codigo, 'public');
            $cursos->asistentes_pdf = $asistentes_pdf_path;
        }

        if ($cursos->save()) {

            return redirect()->route('admin.cursos')->with('success', 'Data added successfully');

        } else {

            return redirect()->route('admin.cursos.create')->with('error', 'Data failed to add');

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
        $user = auth()->user();
        if($user->perfil=='Administrador'){
            $entidad=EntidadesFormadoreas::select('id','nombre')->get();
            $formador=Formadores::select('id','nombre')->get();
            $formadors=Formadores::select('id','nombre')->get();
            $formadors2=Formadores::select('id','nombre')->get();
            $formadors3=Formadores::select('id','nombre')->get();
        }else{
            $entidad=EntidadesFormadoreas::select('id','nombre')->where('id','=',$user->entidad)->get();
            $formador=Formadores::select('id','nombre')->where('entidad','=',$user->entidad)->get();
            $formadors=Formadores::select('id','nombre')->where('entidad','=',$user->entidad)->get();
            $formadors2=Formadores::select('id','nombre')->where('entidad','=',$user->entidad)->get();
            $formadors3=Formadores::select('id','nombre')->where('entidad','=',$user->entidad)->get();
        }
        $cursos = Cursos::findOrFail($id);
        $tipo_maquina=Tipo_Maquina::select('id','tipo_maquina')->get();
        $tipo_curso=Tipo_De_Curso::select('id','tipo_curso')->get();
        $examen_t=Examen::select('id','nombre','url')->where('tipo',1)->get();
        $examen_p=Examen::select('id','nombre','url')->where('tipo',2)->get();
        $asistent = Asistent::orderBy('id','desc')->where('curso',$id)->get();
        $operador = Operadores::orderBy('id','desc')->get();
        $horario = Horario::orderBy('id','desc')->where('curso',$id)->get();

        return view('admin.cursos.edit',compact('cursos','horario','asistent','operador','entidad','formador','tipo_maquina','tipo_curso','examen_t','examen_p','formadors','formadors2','formadors3'));
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
            'curso' => 'required|max:255',
            'tipo_curso' => 'required',
            'codigo' => 'required',
            'entidad' => 'required',
            'formador' => 'required',
            'ciudad' => 'required',
            'direccion' => 'required',
            'tipo_maquina' => 'required',
            'examen_t' => 'required',
            'examen_p' => 'required',
            'codigo_postal' => 'max:7'
        ]);

        $cursos = Cursos::findOrFail($id);
//        dd($request);

        $cursos->curso = $request->curso;
        $cursos->tipo_curso = $request->tipo_curso;
        $cursos->codigo = $request->codigo;
        $cursos->entidad = $request->entidad;
        $cursos->formador = $request->formador;
        $cursos->formador_apoyo_1 = $request->formador_apoyo_1;
        $cursos->formador_apoyo_2 = $request->formador_apoyo_2;
        $cursos->formador_apoyo_3 = $request->formador_apoyo_3;
        if ($request->fecha_inicio != null){
            $cursos->fecha_inicio = $request->fecha_inicio;
        }else{
            $cursos->fecha_inicio = $cursos->fecha_inicio;
        }

        $cursos->direccion = $request->direccion;
        $cursos->ciudad = $request->ciudad;
        $cursos->provincia = $request->provincia;
        $cursos->codigo_postal = $request->codigo_postal;
        $cursos->examen_t = $request->examen_t;
        $cursos->examen_p = $request->examen_p;
//        $cursos->fecha_alta = $cursos->fecha_alta;
//        $cursos->publico_privado = $request->publico_privado;
        $cursos->observaciones = $request->observaciones;
        if(!$request->formador_apoyo_2){
            $cursos->formador_apoyo_2 = 0;
        }
//        $cursos->cerrado = $request->cerrado;
//        $cursos->estado = $request->estado;
        $x =$request->input('tipo_maquina');
//dd($request);
        if($request->cerrado == null){
            $cursos->cerrado = 0;
        }elseif ($request->cerrado == "1" ||$request->cerrado == "on" ){
            $cursos->cerrado = 1;
        }else{
            $cursos->cerrado = 0;
        }
        if($request->estado == null){
            $cursos->estado = 0;
        }elseif ($request->estado == "1" ||$request->estado == "on"){
            $cursos->estado = 1;
        }else{
            $cursos->estado = 0;
        }
        if($request->publico_privado == null){
            $cursos->publico_privado = 0;
        }else{
            $cursos->publico_privado = 1;
        }

        for( $i=0 ; $i <= count($x)-1 ;$i++ ){
            if($i == 0){
                $cursos->tipo_maquina_1 = $x[$i];
//                dd($x[$i]);
                $cursos->tipo_maquina_2 = null;
                $cursos->tipo_maquina_3 = null;
                $cursos->tipo_maquina_4 = null;
            }elseif ($i == 1){
                $cursos->tipo_maquina_2 = $x[$i];
                $cursos->tipo_maquina_3 = null;
                $cursos->tipo_maquina_4 = null;
            }elseif ($i == 2){
                $cursos->tipo_maquina_3 = $x[$i];
                $cursos->tipo_maquina_4 = null;
            }elseif ($i == 3){
                $cursos->tipo_maquina_4 = $x[$i];
            }

        }


        $asistentes_pdf = $request->file('asistentes_pdf');

        if($asistentes_pdf){
            if($cursos->asistentes_pdf && file_exists(storage_path('app/public/' . $cursos->asistentes_pdf))){
                \Storage::delete('public/'. $cursos->asistentes_pdf);
            }

            $asistentes_pdf_path = $asistentes_pdf->store('images/Cursos', 'public');

            $cursos->asistentes_pdf = $asistentes_pdf_path;

        }

        if ($cursos->save()) {

            return redirect()->route('admin.cursos')->with('success', 'Data updated successfully');

        } else {

            return redirect()->route('admin.cursos.edit')->with('error', 'Data failed to update');

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
        $cursos = cursos::findOrFail($id);
        $cursos->delete();

        return redirect()->route('admin.cursos')->with('success', 'Data deleted successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activo($id)
    {
        $cursos = cursos::findOrFail($id);
        $cursos->estado = 1;
//        $cursos->delete();
        $cursos->save();

        return redirect()->route('admin.cursos')->with('success', 'Data deleted successfully');
    }
}
