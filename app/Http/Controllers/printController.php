<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cursos;

class PrintController extends Controller
{
    public function index()
    {
        $curso = Cursos::all();
        return view('print')->with('curso',$curso);
    }

    public function prnpriview()
    {
        $curso = Cursos::all();
        return view('index');
    }
}
