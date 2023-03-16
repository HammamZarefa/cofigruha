<?php

namespace App\Http\Controllers;


use App\Exports\CursoExport;
use App\Exports\OperatorExport;
use App\Models\Asistent;
use App\Models\Carnet;
use App\Models\Certificado;
use App\Models\Cursos;
use App\Models\EntidadesFormadoreas;
use App\Models\Operadores;
use App\Models\Tipo_Maquina;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class OperadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->perfil == 'Responsable_de_Formacion' || $user->perfil == 'Formador')

            $operadores = Operadores::orderBy('id', 'desc')->where('entidad', '=', $user->entidad)->get();

        else
            $operadores = Operadores::orderBy('id', 'desc')->get();


        return view('admin.operadores.index', compact('operadores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->perfil == 'Administrador') {
            $entidad = EntidadesFormadoreas::select('id', 'nombre')->get();
        } else {
            $entidad = EntidadesFormadoreas::select('id', 'nombre')->where('id', '=', $user->entidad)->first();
        }
        $now = date('Y-m-d', strtotime(now()));

        return view('admin.operadores.create', compact('entidad', 'now'));

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
            'dni' => 'required||unique:operadores',
            'apellidos' => 'required',
            'nombre' => 'required',
            'entidad' => 'required',
            'codigo_postal' => 'max:7',
            'foto' => 'max:2048',
            'dni_img' => 'max:2048',
        ]);


        $operadores = new operadores($request->except('_token', 'estado'));

        if ($request->estado == null) {
            $operadores->estado = 0;
        } else {
            $operadores->estado = 1;
        }

        $foto = $request->file('foto');
        $dni_img = $request->file('dni_img');
        if ($foto) {
            $fotopath = $foto->store('operadoe/' . $request->nombre, 'public');

            $operadores->foto = $fotopath;
        } else {
            $operadores->foto = '';
        }
        if ($dni_img) {
            $dni_imgpath = $dni_img->store('operadoe/' . $request->nombre, 'public');

            $operadores->dni_img = $dni_imgpath;
        } else {
            $operadores->dni_img = '';
        }


        if ($operadores->save()) {
            if ($request['carnet'] != null){
                $carnet = new Carnet();
                $carnet->numero = $request->carnet;
                $carnet->operador = $operadores->id;
                $fotoCarnet = $request->file('foto');
                if ($fotoCarnet) {
                    $fotopath = $fotoCarnet->store('carnets/' . $request->carnet, 'public');

                    $carnet->foto = $fotopath;
                } else {
                    $carnet->foto = '';
                }
                $carnet->curso = 0;
                $carnet->estado = 0 ;
                $carnet->save();

            }

            return redirect()->route('admin.operadores')->with('success', 'Data added successfully');

        } else {

            return redirect()->route('admin.operadores.create')->with('error', 'Data failed to add');

        }
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $operador = Operadores::findOrFail($id);
        return view('admin.operadores.show',compact('operador'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function certificado($id)
    {
        $operador = Operadores::findOrFail($id);
        $asistents = Asistent::where('operador', $id)->get();
        $activeAsistent = null;
        $curso = null;
        $cert_numero = null;
//        if ($activeAsistent != null) {
            foreach ($asistents as $asistent) {
                $curso = Cursos::findOrFail($asistent->curso);
                if ($curso->estado == 1) {
                    $activeAsistent = $asistent;
//                    dd($asistent);
                }
            }
//        dd($activeAsistent);



//        }
//        dd($activeAsistent);

        $tipos = Tipo_Maquina::orderBy('id', 'asc')->get();
        if ($activeAsistent != null)
        $cer = Certificado::where('operador',$id)->where('curso',$activeAsistent->curso)->get();
//        dd($cer);
//        dd($activeAsistent);
        if ($activeAsistent != null && $curso != null && $cert_numero != null && count($cer) == 0){
            $certificado = new Certificado();
            $asi_fecha = date('Y', strtotime($activeAsistent->created_at));
            $asi_orden = $activeAsistent->orden;
            $cert_numero = $asi_fecha . "" . $asi_orden . "" . $operador->dni;
            $certificado->numero = $cert_numero;
            $certificado->cer_apellidos = $operador->apellidos;
            $certificado->cer_nombre = $operador->nombre;
            $certificado->operador = $id;
            $certificado->entidad = $operador->entidad;
            if ($activeAsistent != null){
                $certificado->curso = $activeAsistent->curso;
                $certificado->emision = $activeAsistent->emision;
                $certificado->vencimiento = $activeAsistent->vencimiento;
                $certificado->observaciones = $activeAsistent->observaciones;
            }

            $certificado->dni = $operador->dni;
            if ($curso != null){
                if ($curso->tipo_curso == 1){
                    $certificado->cer_type_course = 'Básico';
                    $certificado->tipos_carnet = 'B';
                }else{
                    $certificado->cer_type_course = 'Renovación';
                    $certificado->tipos_carnet = 'R';
                }
                $certificado->fecha_alta = $curso->fecha_alta;
            }




            $certificado->entidad_nombre = $operador->entidades_formadoreas->nombre;
            if ($operador->carnett != null)
                $certificado->carnet = $operador->carnett->id;
            $certificado->save();
        }

//        $certificado->cer_fecha = $activeAsistent->observaciones;
//        dd($operador->carnett);
//        dd($cert_numero);
        return view('admin.operadores.certificado', compact('operador', 'curso', 'tipos', 'cert_numero', 'activeAsistent'));
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
            $entidad = EntidadesFormadoreas::select('id', 'nombre')->get();
        } else {
            $entidad = EntidadesFormadoreas::select('id', 'nombre')->where('id', '=', $user->entidad)->first();
        }
        $operadores = Operadores::findOrFail($id);

        return view('admin.operadores.edit', compact('operadores', 'entidad'));
    }

    public function export()
    {
        return Excel::download(new OperatorExport(), 'operadores.xlsx');
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
        $request->validate([
            'dni' => 'required',
            'apellidos' => 'required',
            'nombre' => 'required',
            'entidad' => 'required',
            'codigo_postal' => 'max:7',
            'foto' => 'max:2048',
            'dni_img' => 'max:2048',
        ]);
//dd($request);
        $operadores = Operadores::findOrFail($id);
        $operadores->dni = $request->dni;
        $operadores->apellidos = $request->apellidos;
        $operadores->nombre = $request->nombre;
        $operadores->entidad = $request->entidad;
        $operadores->fecha_nacimiento = $request->fecha_nacimiento;
        $operadores->provincia = $request->provincia;
        $operadores->ciudad = $request->ciudad;
        $operadores->direccion = $request->direccion;
        $operadores->codigo_postal = $request->codigo_postal;
        $operadores->mail = $request->mail;
        $operadores->carnet = $request->carnet;
        $operadores->fecha = $request->fecha;
        if ($request->estado == null) {
            $operadores->estado = 0;
        } elseif ($request->estado == "on" || $request->estado == "1") {
            $operadores->estado = 1;
        } else {
            $operadores->estado = 0;
        }

        $foto = $request->file('foto');
        $dni_img = $request->file('dni_img');
        if ($foto) {
            if ($operadores->foto && file_exists(storage_path('app/public/' . $operadores->foto))) {
                \Storage::delete('public/' . $operadores->foto);
            }

            $foto_path = $foto->store('operadore/' . $request->nombre, 'public');

            $operadores->foto = $foto_path;
        }
        if ($dni_img) {
            if ($operadores->dni_img && file_exists(storage_path('app/public/' . $operadores->dni_img))) {
                \Storage::delete('public/' . $operadores->dni_img);
            }

            $dni_img_path = $dni_img->store('operadore/' . $request->nombre, 'public');

            $operadores->dni_img = $dni_img_path;
        }


        if ($operadores->save()) {
            if ($request['carnet'] != null ){
                if ($operadores->carnett == null){
                    $carnet = new Carnet();
                    if ($request->carnet != null){
                        $carnet->numero = $request->carnet;
                    }else{
                        $carnet->numero = substr(md5(microtime()),rand(0,26),8) ;
                    }
//                    $carnet->numero = $request->carnet;
                    $carnet->operador = $operadores->id;
                    $fotoCarnet = $request->file('foto');
                    if ($fotoCarnet) {
                        $fotopath = $fotoCarnet->store('carnets/' . $request->carnet, 'public');

                        $carnet->foto = $fotopath;
                    } else {
                        $carnet->foto = $operadores->foto;
                    }
                    $carnet->curso = 0;
                    $carnet->estado = 0 ;
                    $carnet->save();
                }else{
                    $carnet = $operadores->carnett;
                    $carnet->numero = $request->carnet;
                    $carnet->operador = $operadores->id;
                    $fotoCarnet = $request->file('foto');
                    if ($fotoCarnet) {
                        $fotopath = $fotoCarnet->store('carnets/' . $request->carnet, 'public');

                        $carnet->foto = $fotopath;
                    } else {
                        $carnet->foto = '';
                    }

                    $carnet->save();
                }


            }

            return redirect()->route('admin.operadores')->with('success', 'Data added successfully');

        } else {

            return redirect()->route('admin.operadores.create')->with('error', 'Data failed to add');

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
        $operadores = Operadores::findOrFail($id);

        $operadores->delete();

        return redirect()->route('admin.operadores')->with('success', 'Data deleted successfully');
    }
}
