<?php

namespace App\Http\Controllers;

use App\Models\EntidadesFormadoreas;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = User::all();
        return view('admin.user.index',['user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entidad = EntidadesFormadoreas::orderBy('id','desc')->get();
       return view ('admin.user.create',compact('entidad'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->estado);
        \Validator::make($request->all(), [
            "nombre" => "required",
            "perfil" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:6",
            "alias" => "required|unique:users",
            "apellidos" => "required",
            "ciudad" => "required",
            "direccion" => "required",
            "codigo_postal" => "required|max:7",
        ])->validate();

        $user = new User();
//        dd($user);
        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->perfil=$request->perfil;
        $user->remember_token = $request->_token;
        $user->alias = $request->alias;
        $user->apellidos = $request->apellidos;
        $user->nombre = $request->nombre;
        $user->ciudad = $request->ciudad;
        $user->direccion = $request->direccion;
        $user->provincia = $request->provincia;
        $user->codigo_postal = $request->codigo_postal;
        if($request->perfil != "Administrador"){
            $user->entidad = $request->entidad;
        }else{
            $user->entidad = 0;
        }
        if($request->estado == null){
            $user->estado = 0;
        }else{
            $user->estado = 1;
        }

//dd($user);

        if ($user->save()) {
            return redirect()->route('admin.users.index')->with('success', 'Data added successfully');
        }else {

            return redirect()->route('admin.users.create')->with('error', 'Data failed to add');

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
//        dd($id);
        $user = User::findOrFail($id);
        $entidad = EntidadesFormadoreas::orderBy('id','desc')->get();
//        dd($user);
        return view('admin.user.edit',compact('user','entidad'));
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
        \Validator::make($request->all(), [
            "nombre" => "required",
            "email" => "required|email",
            "alias" => "required",
            "apellidos" => "required",
            "ciudad" => "required",
            "direccion" => "required",
            "codigo_postal" => "required|max:7",
        ])->validate();
        $user = User::findOrFail($id);
        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->perfil=$request->perfil;
        $user->alias = $request->alias;
        $user->apellidos = $request->apellidos;
        $user->nombre = $request->nombre;
        $user->ciudad = $request->ciudad;
        $user->direccion = $request->direccion;
        $user->provincia = $request->provincia;
//        dd($user);
        $user->codigo_postal = $request->codigo_postal;
        if($request->perfil != "Administrador"){
            $user->entidad = $request->entidad;
        }else{
            $user->entidad = 0;
        }
        if($request->estado == null){
            $user->estado = 0;
        }else{
            $user->estado = 1;
        }

        if ( $user->save()) {

            return redirect()->route('admin.users.index')->with('success', 'Data updated successfully');

           } else {

            return redirect()->route('admin.user.edit')->with('error', 'Data failed to update');

           }
    }

    public function changepassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->password = Hash::make($request->password);

        if ( $user->save()) {

            return redirect()->route('admin.users.index')->with('success', 'Password updated successfully');

           } else {

            return redirect()->route('admin.users.index')->with('error', 'Password failed to update');

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
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Data deleted successfully');
    }
}
