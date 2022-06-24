<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $link = Link::orderBy('id','desc')->get();
        return view('admin.link.index',compact('link'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.link.create');
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
            'título' => 'required',
            'descripción' => 'required',
            'enlace' => 'required',
        ]);
        $link = new Link();
        $link->title = $request->título;
        $link->text = $request->descripción;
        $link->slug = $request->enlace;

        if ( $link->save()) {

            return redirect()->route('admin.link')->with('success', 'Data added successfully');

           } else {

            return redirect()->route('admin.link.create')->with('error', 'Data failed to add');

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
        $link = Link::findOrFail($id);
        return view('admin.link.edit',compact('link'));
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
            'título' => 'required',
            'descripción' => 'required',
            'enlace' => 'required',
        ]);
        $link = Link::findOrFail($id);
        $link->title = $request->título;
        $link->text = $request->descripción;
        $link->slug = $request->enlace;

        if ( $link->save()) {

            return redirect()->route('admin.link')->with('success', 'Data updated successfully');

           } else {

            return redirect()->route('admin.link.create')->with('error', 'Data failed to update');

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
        $link = Link::findOrFail($id);
        $link->delete();

        return redirect()->route('admin.link')->with('success', 'Data deleted successfully');
    }
}
