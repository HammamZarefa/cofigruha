<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\Formadores;
use Illuminate\Http\Request;

class ExamenController extends Controller
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

            $examen = Examen::orderBy('id','desc')->get();


        else
            $examen = Examen::orderBy('id','desc')->get();
        return view('admin.examen.index',compact('examen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.examen.create');
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
        'codigo' => 'required',
        'tipo' => 'required',
        'nombre' => 'required',
        'url' => 'required',
    ]);

        $examen = new Examen($request->except('_token','url'));
        $url = $request->file('url');

        if($url){
            $url_path = $url->store('examen/'.$request->nombre, 'public');

            $examen->url = $url_path;
        }else{
            $examen->url ='';
        }

        if ( $examen->save()) {

            return redirect()->route('admin.examen')->with('success', 'Data added successfully');

        } else {

            return redirect()->route('admin.examen.create')->with('error', 'Data failed to add');

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
        $examen = Examen::findOrFail($id);
        return view('admin.examen.edit',compact('examen'));
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
            'tipo' => 'required',
            'nombre' => 'required',
        ]);
        $examen = Examen::findOrFail($id);
        $examen->codigo = $request->codigo;
        $examen->nombre = $request->nombre;
        $examen->tipo = $request->tipo;

        $url = $request->file('url');

        if($url){
            if($examen->dni_img && file_exists(storage_path('app/public/' . $examen->url))){
                \Storage::delete('public/'. $examen->url);
            }

            $url_path = $url->store('examen/'.$request->nombre, 'public');

            $examen->url = $url_path;
        }

        if ( $examen->save()) {

            return redirect()->route('admin.examen')->with('success', 'Data added successfully');

        } else {

            return redirect()->route('admin.examen.edit',$id)->with('error', 'Data failed to add');

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
        $examen = Examen::findOrFail($id);

        $examen->delete();

        return redirect()->route('admin.examen')->with('success', 'Data deleted successfully');
    }
}
