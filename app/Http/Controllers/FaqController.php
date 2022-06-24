<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faq = Faq::orderBy('id','desc')->get();

        return view('admin.faq.index',compact('faq'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faq.create');
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
            'tipo_de_pempa' => 'required',
            'descripción' => 'required',
        ]);
        $faq = new Faq();
        $faq->question = $request->tipo_de_PEMPA;
        $faq->answer = $request->descripción;
        if ( $faq->save()) {

            return redirect()->route('admin.faq')->with('success', 'Data added successfully');

           } else {

            return redirect()->route('admin.faq.create')->with('error', 'Data failed to add');

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
        $faq = Faq::findOrFail($id);

        return view('admin.faq.edit',compact('faq'));
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
            'tipo_de_pempa' => 'required',
            'descripción' => 'required',
        ]);
        $faq = Faq::findOrFail($id);
        $faq->question = $request->tipo_de_pempa;
        $faq->answer = $request->descripción;
        if ( $faq->save()) {

            return redirect()->route('admin.faq')->with('success', 'Data updated successfully');

           } else {

            return redirect()->route('admin.faq.create')->with('error', 'Data failed to update');

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
        $faq = Faq::findOrFail($id);

        $faq->delete();

        return redirect()->route('admin.faq')->with('success', 'Data deleted successfully');
    }
}
