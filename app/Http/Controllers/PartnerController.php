<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;

class PartnerController extends Controller
{
     /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
       $partner = Partner::orderBy('id','desc')->get();
       return view('admin.partner.index',compact('partner'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       return view('admin.partner.create');
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
           'logo' => 'required|max:2048',
           'nombre' => 'required',
           'enlace' => 'required',
       ]);
       $partner = new Partner();
       $partner->name = $request->nombre;
       $partner->link = $request->enlace;


       $partner->empresa = $request->empresa;
       $partner->direccion = $request->direccion;
       $partner->codigo_postal = $request->codigo_postal;
       $partner->poblacion = $request->poblacion;
       $partner->provincia = $request->provincia;
       $partner->telefono = $request->telefono;
       $partner->email = $request->email;
       $cover = $request->file('logo');
       if($cover){
       $cover_path = $cover->store('images/partner', 'public');
       $partner->cover = $cover_path;
       }
      if ( $partner->save()) {
       return redirect()->route('admin.partner')->with('success', 'partner added successfully');
      } else {
       return redirect()->route('admin.partner.create')->with('error', 'partner failed to add');
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
       $partner = Partner::findOrFail($id);

       return view('admin.partner.edit',compact('partner'));
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
           'nombre' => 'required',
           'enlace' => 'required',
           'logo'=>'max:2048'
       ]);
//       dd($request);
       $partner = Partner::findOrFail($id);
       $partner->name = $request->nombre;
       $partner->link = $request->enlace;

       $partner->empresa = $request->empresa;
       $partner->direccion = $request->direccion;
       $partner->codigo_postal = $request->codigo_postal;
       $partner->poblacion = $request->poblacion;
       $partner->provincia = $request->provincia;
       $partner->telefono = $request->telefono;
       $partner->email = $request->email;

       $new_cover = $request->file('logo');

       if($new_cover){
       if($partner->cover && file_exists(storage_path('app/public/' . $partner->cover))){
           \Storage::delete('public/'. $partner->cover);
       }
       $new_cover_path = $new_cover->store('images/partner', 'public');
       $partner->cover = $new_cover_path;
       }

      if ( $partner->save()) {

       return redirect()->route('admin.partner')->with('success', 'Data added successfully');

      } else {

       return redirect()->route('admin.partner.create')->with('error', 'Data failed to add');

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
       $partner = Partner::findOrFail($id);

       if($partner->cover && file_exists(storage_path('app/public/' . $partner->cover))){
        \Storage::delete('public/'. $partner->cover);
    }

       $partner->delete();

       return redirect()->route('admin.partner')->with('success', 'Data deleted successfully');
   }
}
