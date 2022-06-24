<?php

namespace App\Http\Controllers;

use App\Entidades_Formadoreas;
use App\Models\EntidadesFormadoreas;
use Illuminate\Http\Request;


class EntidadesFormadoreasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entidadesFormadores = EntidadesFormadoreas::orderBy('id','desc')->get();

        return view('admin.entidades_formadoreas.index',compact('entidadesFormadores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.entidades_formadoreas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entidades_formadoreas = new EntidadesFormadoreas();
        $entidades_formadoreas->name = $request->name;
        $entidades_formadoreas->position = $request->position;
        $entidades_formadoreas->twitter = $request->twitter;
        $entidades_formadoreas->facebook = $request->facebook;
        $entidades_formadoreas->instagram = $request->instagram;
        $entidades_formadoreas->linkedin = $request->linkedin;

        $photo = $request->file('photo');

        if($photo){
            $cover_path = $photo->store('images/entidades_formadoreas', 'public');

            $entidades_formadoreas->photo = $cover_path;
        }

        if ( $entidades_formadoreas->save()) {

            return redirect()->route('admin.entidades_formadoreas')->with('success', 'Data added successfully');

        } else {

            return redirect()->route('admin.entidades_formadoreas.create')->with('error', 'Data failed to add');

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
        $entidades_formadoreas = entidades_formadoreas::findOrFail($id);

        return view('admin.entidades_formadoreas.edit',compact('entidades_formadoreas'));
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
        $entidades_formadoreas = entidades_formadoreas::findOrFail($id);
        $entidades_formadoreas->name = $request->name;
        $entidades_formadoreas->position = $request->position;
        $entidades_formadoreas->twitter = $request->twitter;
        $entidades_formadoreas->facebook = $request->facebook;
        $entidades_formadoreas->instagram = $request->instagram;
        $entidades_formadoreas->linkedin = $request->linkedin;

        $new_photo = $request->file('photo');

        if($new_photo){
            if($entidades_formadoreas->photo && file_exists(storage_path('app/public/' . $entidades_formadoreas->photo))){
                \Storage::delete('public/'. $entidades_formadoreas->photo);
            }

            $new_cover_path = $new_photo->store('images/entidades_formadoreas', 'public');

            $entidades_formadoreas->photo = $new_cover_path;
        }

        if ( $entidades_formadoreas->save()) {

            return redirect()->route('admin.entidades_formadoreas')->with('success', 'Data updated successfully');

        } else {

            return redirect()->route('admin.entidades_formadoreas.edit')->with('error', 'Data failed to update');

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
        $entidades_formadoreas = entidades_formadoreas::findOrFail($id);

        $entidades_formadoreas->delete();

        return redirect()->route('admin.entidades_formadoreas')->with('success', 'Data deleted successfully');


    }
}
