<?php

namespace App\Http\Controllers;


use App\Exports\CursoExport;
use App\Exports\FormadorExport;
use App\Models\EntidadesFormadoreas;
use App\Models\Formadores;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FormadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if($user->perfil=='Responsable_de_Formacion' || $user->perfil=='Formador')

            $formadores = Formadores::orderBy('id','desc')->where('entidad','=',$user->entidad)->get();

        else
            $formadores = Formadores::orderBy('id','desc')->get();
//        foreach ($formadores as $formadore){
//           dd(in_array($formadore->dni_img['content-type'], ['image/jpg', 'application/pdf']));
//        }
        return view('admin.formadores.index',compact('formadores'));
    }

    public function export()
    {
        return Excel::download(new FormadorExport(), 'formadores.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        if($user->perfil=='Responsable_de_Formacion' || $user->perfil=='Formador')
            $entidad=EntidadesFormadoreas::select('id','nombre')->where('id','=',$user->entidad)->get();

        else $entidad=EntidadesFormadoreas::select('id','nombre')->get();
        return view('admin.formadores.create',compact('entidad'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $request->validate([
            'codigo' => 'required',
            'entidad' => 'required',
            'apellidos' => 'required',
            'nombre' => 'required',
            'dni' => 'required',
            'dni_img' => 'required',
        ]);


        $formadores = new formadores($request->except('_token','estado'));
        $dni = $request->file('dni_img');
        $operador_pdf =$request->file('operador_pdf');
        $cert_empresa_pdf =$request->file('cert_empresa_pdf');
        $vida_laboral_pdf =$request->file('vida_laboral_pdf');
        $prl_pdf =$request->file('prl_pdf');
        $pemp_pdf =$request->file('pemp_pdf');
        $cap_pdf =$request->file('cap_pdf');

        if($request->estado == null){
            $formadores->estado = 0;
        }else{
            $formadores->estado = 1;
        }


        if($dni){
            $dni_path = $dni->store('formadores/'.$request->nombre, 'public');

            $formadores->dni_img = $dni_path;
        }else{
            $formadores->dni_img ='';
        }
        if($operador_pdf){
            $operador_pdf_path = $operador_pdf->store('formadores/'.$request->nombre, 'public');

            $formadores->operador_pdf = $operador_pdf_path;
        }else{
            $formadores->operador_pdf ='';
        }
        if($cert_empresa_pdf){
            $cert_empresa_pdf_path = $cert_empresa_pdf->store('formadores/'.$request->nombre, 'public');

            $formadores->cert_empresa_pdf = $cert_empresa_pdf_path;
        }else{
            $formadores->cert_empresa_pdf ='';
        }
        if($vida_laboral_pdf){
            $vida_laboral_pdf_path = $vida_laboral_pdf->store('formadores/'.$request->nombre, 'public');

            $formadores->vida_laboral_pdf = $vida_laboral_pdf_path;
        }else{
            $formadores->vida_laboral_pdf ='';
        }
        if($prl_pdf){
            $prl_pdf_path = $prl_pdf->store('formadores/'.$request->nombre, 'public');

            $formadores->prl_pdf = $prl_pdf_path;
        }else{
            $formadores->prl_pdf ='';
        }
        if($pemp_pdf){
            $pemp_pdf_path = $pemp_pdf->store('formadores/'.$request->nombre, 'public');

            $formadores->pemp_pdf = $pemp_pdf_path;
        }else{
            $formadores->pemp_pdf ='';
        }
        if($cap_pdf){
            $cap_pdf_path = $cap_pdf->store('formadores/'.$request->nombre, 'public');

            $formadores->cap_pdf = $cap_pdf_path;
        }else{
            $formadores->cap_pdf ='';
        }


        if ( $formadores->save()) {

            return redirect()->route('admin.formadores')->with('success', 'Data added successfully');

        } else {

            return redirect()->route('admin.formadores.create')->with('error', 'Data failed to add');

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
        $formadores = Formadores::findOrFail($id);
        $entidad=EntidadesFormadoreas::select('id','nombre')->get();

        return view('admin.formadores.edit',compact('formadores','entidad'));
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
            'codigo' => 'required',
            'entidad' => 'required',
            'apellidos' => 'required',
            'nombre' => 'required',
            'dni' => 'required',
        ]);

        $formadores = Formadores::findOrFail($id);
        $formadores->codigo = $request->codigo;
        $formadores->entidad = $request->entidad;
        $formadores->apellidos = $request->apellidos;
        $formadores->nombre = $request->nombre;
        $formadores->dni = $request->dni;
        $formadores->fecha = $request->fecha;

        if($request->estado == null){
            $formadores->estado = 0;
        }else{
            $formadores->estado = 1;
        }


        $dni_img = $request->file('dni_img');
        $operador_pdf = $request->file('operador_pdf');
        $cert_empresa_pdf = $request->file('cert_empresa_pdf');
        $vida_laboral_pdf = $request->file('vida_laboral_pdf');
        $prl_pdf = $request->file('prl_pdf');
        $pemp_pdf = $request->file('pemp_pdf');
        $cap_pdf = $request->file('cap_pdf');

        if($dni_img){
            if($formadores->dni_img && file_exists(storage_path('app/public/' . $formadores->dni_img))){
                \Storage::delete('public/'. $formadores->dni_img);
            }

            $dni_img_path = $dni_img->store('formadores/'.$request->nombre, 'public');

            $formadores->dni_img = $dni_img_path;
        }
        if($operador_pdf){
            if($formadores->operador_pdf && file_exists(storage_path('app/public/' . $formadores->operador_pdf))){
                \Storage::delete('public/'. $formadores->operador_pdf);
            }

            $operador_pdf_path = $operador_pdf->store('formadores/'.$request->nombre, 'public');

            $formadores->operador_pdf = $operador_pdf_path;
        }
        if($cert_empresa_pdf){
            if($formadores->cert_empresa_pdf && file_exists(storage_path('app/public/' . $formadores->cert_empresa_pdf))){
                \Storage::delete('public/'. $formadores->cert_empresa_pdf);
            }

            $cert_empresa_pdf_path = $cert_empresa_pdf->store('formadores/'.$request->nombre, 'public');

            $formadores->cert_empresa_pdf = $cert_empresa_pdf_path;
        }
        if($vida_laboral_pdf){
            if($formadores->vida_laboral_pdf && file_exists(storage_path('app/public/' . $formadores->vida_laboral_pdf))){
                \Storage::delete('public/'. $formadores->vida_laboral_pdf);
            }

            $vida_laboral_pdf_path = $vida_laboral_pdf->store('formadores/'.$request->nombre, 'public');

            $formadores->vida_laboral_pdf = $vida_laboral_pdf_path;
        }
        if($prl_pdf){
            if($formadores->prl_pdf && file_exists(storage_path('app/public/' . $formadores->prl_pdf))){
                \Storage::delete('public/'. $formadores->prl_pdf);
            }

            $prl_pdf_path = $prl_pdf->store('formadores/'.$request->nombre, 'public');

            $formadores->prl_pdf = $prl_pdf_path;
        }
        if($pemp_pdf){
            if($formadores->pemp_pdf && file_exists(storage_path('app/public/' . $formadores->pemp_pdf))){
                \Storage::delete('public/'. $formadores->pemp_pdf);
            }

            $pemp_pdf_path = $pemp_pdf->store('formadores/'.$request->nombre, 'public');

            $formadores->pemp_pdf = $pemp_pdf_path;
        }
        if($cap_pdf){
            if($formadores->cap_pdf && file_exists(storage_path('app/public/' . $formadores->cap_pdf))){
                \Storage::delete('public/'. $formadores->cap_pdf);
            }

            $cap_pdf_path = $cap_pdf->store('formadores/'.$request->nombre, 'public');

            $formadores->cap_pdf = $cap_pdf_path;
        }


        if ( $formadores->save()) {

            return redirect()->route('admin.formadores')->with('success', 'Data added successfully');

        } else {

            return redirect()->route('admin.formadores.create')->with('error', 'Data failed to add');

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
        $formadores = Formadores::findOrFail($id);

        $formadores->delete();

        return redirect()->route('admin.formadores')->with('success', 'Data deleted successfully');
    }
}
