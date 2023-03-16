<?php

namespace App\Http\Controllers;

use App\Exports\AssistantExport;
use App\Exports\CursoExport;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\{
    Asistent,
    Carnet,
    Certificado,
    Cursos,
    EntidadesFormadoreas,
    Examen,
    Formadores,
    Operadores,
    Pcategory,
    Practica,
    Teoria,
    Tipo_De_Curso,
    Tipo_Maquina
};
use Maatwebsite\Excel\Facades\Excel;

class AsistentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asistent = Asistent::orderBy('id', 'desc')->get();
        $operador = Operadores::orderBy('id', 'desc')->get();

        return view('admin.asistent.index', compact('asistent', 'operador'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = auth()->user();
        if ($user->perfil == 'Administrador') {
            $operador = Operadores::select('id', 'nombre', 'apellidos')->where('estado', 0)->orderby('apellidos')->get();
        } else {
            $operador = Operadores::select('id', 'nombre', 'apellidos')->where('estado', 0)->where('entidad', '=', $user->entidad)->orderby('apellidos')->get();
        }
        $curso = Cursos::select('id', 'codigo')->get();
        $cursos = Cursos::orderBy('id', 'desc')->get();

        $tipo_carnet = Teoria::select('id', 'formacion')->get();
        $tipo = Tipo_Maquina::orderBy('id', 'desc')->get();
        $corse = Cursos::where('id', $id)->first();
        $tipo_maq = [];
        $notes = [];
        if ($corse->tipo_maquina_1 != null) {
            array_push($tipo_maq, $corse->tipo_maquina_1);
        }
        if ($corse->tipo_maquina_2 != null) {
            array_push($tipo_maq, $corse->tipo_maquina_2);
        }
        if ($corse->tipo_maquina_3 != null) {
            array_push($tipo_maq, $corse->tipo_maquina_3);
        }
        if ($corse->tipo_maquina_4 != null) {
            array_push($tipo_maq, $corse->tipo_maquina_4);
        }
        if (count($tipo_maq) == 4) {
            for ($i = 1; $i < 16; $i++) {
                array_push($notes, $i);
            }
        } elseif (count($tipo_maq) == 3) {

            if ($tipo_maq[0] == 1 || $tipo_maq[1] == 1 || $tipo_maq[2] == 1) {
//                array_push($notes,1);
            } else {
                array_push($notes, 2);
                array_push($notes, 4);
                array_push($notes, 6);
                array_push($notes, 8);
                array_push($notes, 10);
                array_push($notes, 12);
                array_push($notes, 14);
            }

            if ($tipo_maq[0] == 2 || $tipo_maq[1] == 2 || $tipo_maq[2] == 2) {
//                array_push($notes,2);
            } else {
                array_push($notes, 1);
                array_push($notes, 4);
                array_push($notes, 5);
                array_push($notes, 8);
                array_push($notes, 9);
                array_push($notes, 12);
                array_push($notes, 13);
            }
            if ($tipo_maq[0] == 5 || $tipo_maq[1] == 5 || $tipo_maq[2] == 5) {
//                array_push($notes,4);
            } else {
                array_push($notes, 1);
                array_push($notes, 2);
                array_push($notes, 3);
                array_push($notes, 8);
                array_push($notes, 9);
                array_push($notes, 10);
                array_push($notes, 11);
            }
            if ($tipo_maq[0] == 6 || $tipo_maq[1] == 6 || $tipo_maq[2] == 6) {
//                array_push($notes,8);
            } else {
                array_push($notes, 1);
                array_push($notes, 2);
                array_push($notes, 3);
                array_push($notes, 4);
                array_push($notes, 5);
                array_push($notes, 6);
                array_push($notes, 7);
            }

        } elseif (count($tipo_maq) == 2) {
            if ($tipo_maq[0] == 1 || $tipo_maq[1] == 1) {
                if ($tipo_maq[0] == 2 || $tipo_maq[1] == 2 || $tipo_maq[2] == 2) {
                    array_push($notes, 1);
                    array_push($notes, 2);
                    array_push($notes, 3);
                } elseif ($tipo_maq[0] == 5 || $tipo_maq[1] == 5 || $tipo_maq[2] == 5) {
                    array_push($notes, 1);
                    array_push($notes, 4);
                    array_push($notes, 5);
                } elseif ($tipo_maq[0] == 6 || $tipo_maq[1] == 6 || $tipo_maq[2] == 6) {
                    array_push($notes, 1);
                    array_push($notes, 8);
                    array_push($notes, 9);
                }

            }
            if ($tipo_maq[0] == 2 || $tipo_maq[1] == 2) {
                if ($tipo_maq[0] == 5 || $tipo_maq[1] == 5 || @$tipo_maq[2] == 5) {
                    array_push($notes, 2);
                    array_push($notes, 4);
                    array_push($notes, 6);
                } elseif ($tipo_maq[0] == 6 || $tipo_maq[1] == 6 || @$tipo_maq[2] == 6) {
                    array_push($notes, 2);
                    array_push($notes, 8);
                    array_push($notes, 10);
                }

            }
            if ($tipo_maq[0] == 5 || $tipo_maq[1] == 5) {
                if ($tipo_maq[0] == 6 || $tipo_maq[1] == 6 || @$tipo_maq[2] == 6) {
                    array_push($notes, 4);
                    array_push($notes, 8);
                    array_push($notes, 12);
                }

            }
        } elseif (count($tipo_maq) == 1) {
            if ($tipo_maq[0] == 1) {
                array_push($notes, 1);
            } elseif ($tipo_maq[0] == 2) {
                array_push($notes, 2);
            } elseif ($tipo_maq[0] == 3) {
                array_push($notes, 16);
            } elseif ($tipo_maq[0] == 4) {
                array_push($notes, 17);
            } elseif ($tipo_maq[0] == 5) {
                array_push($notes, 4);
            } elseif ($tipo_maq[0] == 6) {
                array_push($notes, 8);
            }
        }
        $x = Asistent::select('orden')->where('curso', $id)->orderBy('id', 'desc')->latest()->get();
        if (count($x) > 0) {
            $orden = $x[0]->orden + 1;
        } else {
            $orden = 1;
        }

        $tipo_1 = $corse->tipo_maquina_1;
        $tipo_2 = $corse->tipo_maquina_2;
        $tipo_3 = $corse->tipo_maquina_3;
        $tipo_4 = $corse->tipo_maquina_4;
        $tipos = [$tipo_1, $tipo_2, $tipo_3, $tipo_4];
        return view('admin.asistent.create', compact('notes', 'curso', 'orden', 'id', 'operador', 'tipo_carnet', 'tipo', 'cursos', 'tipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $request->validate([
            'curso' => 'required',
            'orden' => 'required|max:7',
            'operador' => 'required',
            'tipo_carnet' => 'required',
//            'nota_t' => 'required|numeric',
//            'nota_p' => 'required|numeric',
            'tipo_1' => 'required',
            'examen_p_pdf' => 'max:2048',
            'examen_t_pdf' => 'max:2048',
        ]);
//dd($request);

        $asistent = new Asistent($request->except('_token'));
        if (!$request->tipo_2) {
            $asistent->tipo_2 = 0;
        }
        if (!$request->tipo_3) {
            $asistent->tipo_3 = 0;
        }
        if (!$request->tipo_4) {
            $asistent->tipo_4 = 0;
        }

        $operador = Operadores::findOrFail((int)$request->operador);
        $asistent->emision = $operador->fecha;
        $ven = new Carbon($operador->fecha);
        $x = $ven->addYears(5);
        $asistent->vencimiento = Carbon::parse($x)->format('Y-m-d');
        $cursos = Cursos::findOrFail($request->curso);
        $entidad = EntidadesFormadoreas::select('id', 'nombre')->get();
        $formador = Formadores::select('id', 'nombre')->get();
        $tipo_maquina = Tipo_Maquina::select('id', 'tipo_maquina')->get();
        $tipo_curso = Tipo_De_Curso::select('id', 'tipo_curso')->get();
        $examen_t = Examen::select('id', 'nombre')->where('tipo', 1)->get();
        $examen_p = Examen::select('id', 'nombre')->where('tipo', 2)->get();
        $formadors = Formadores::select('id', 'nombre')->get();
        $formadors2 = Formadores::select('id', 'nombre')->get();
        $formadors3 = Formadores::select('id', 'nombre')->get();

        $examen_t_pdf = $request->file('examen_t_pdf');
        if ($examen_t_pdf) {
            $tFileName = 'TB-' . $asistent->cursos->curso . '-' . ($asistent->orden > 10 ? $asistent->orden : '0' . $asistent->orden . '.pdf');
            if ($examen_t_pdf->getClientOriginalName() == $tFileName)
                $examen_t_pdf_path = $examen_t_pdf->storeAs('asistent', $examen_t_pdf->getClientOriginalName(), 'public');
            else  return back()->with('error', 'File name not correct');
            $asistent->examen_t_pdf = $examen_t_pdf_path;
        } else {
            $asistent->examen_t_pdf = '';
        }
        $examen_p_pdf = $request->file('examen_p_pdf');
        if ($examen_p_pdf) {
            $pFileName = 'P' . substr($asistent->cursos->codigo, 1) . '-' . ($asistent->orden > 10 ? $asistent->orden : '0' . $asistent->orden . '.pdf');
            if ($examen_p_pdf->getClientOriginalName() == $pFileName)
                $examen_p_pdf_path = $examen_p_pdf->storeAs('asistent', $examen_p_pdf->getClientOriginalName(), 'public');
            else  return back()->with('error', 'File name not correct');
            $asistent->examen_p_pdf = $examen_p_pdf_path;
        } else {
            $asistent->examen_p_pdf = '';
        }

        if ($asistent->save()) {
            if ($operador->carnett != null) {
                $carnet = $operador->carnett;
                $carnet->curso = $cursos->id;
                $carnet->estado = 1;
                $carnet->fecha_de_alta = $asistent->vencimiento;
                $carnet->fecha_de_emision = $asistent->emision;
                $carnet->save();
                if ($cursos->tipo_maquina_1 != null) {
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_1);
                }
                if ($cursos->tipo_maquina_2 != null) {
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_2);
                }
                if ($cursos->tipo_maquina_3 != null) {
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_3);
                }
                if ($cursos->tipo_maquina_4 != null) {
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_4);
                }
            } else {
                $carnet = new Carnet();

                if ($operador->carnet != null) {
                    $carnet->numero = $operador->carnet;
                } else {
                    $carnet->numero = substr(md5(microtime()), rand(0, 26), 8);
                }

                $carnet->operador = $operador->id;
                $carnet->fecha_de_alta = $asistent->vencimiento;
                $carnet->fecha_de_emision = $asistent->emision;
                $carnet->foto = $operador->foto;
                $carnet->curso = $cursos->id;
                $carnet->estado = 1;
                $carnet->save();
                if ($cursos->tipo_maquina_1 != null) {
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_1);
                }
                if ($cursos->tipo_maquina_2 != null) {
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_2);
                }
                if ($cursos->tipo_maquina_3 != null) {
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_3);
                }
                if ($cursos->tipo_maquina_4 != null) {
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_4);
                }
            }
            $certificado = new Certificado();
            $asi_fecha = date('Y', strtotime($asistent->created_at));
            $asi_fecham = date('m', strtotime($asistent->created_at));
            $asi_fechad = date('d', strtotime($asistent->created_at));
            $asi_fechah = date('h', strtotime($asistent->created_at));
            $asi_fechai = date('i', strtotime($asistent->created_at));
            $asi_fechas = date('s', strtotime($asistent->created_at));
            $asi_orden = $asistent->orden;
            $cert_numero = $asi_fecha . "" . $asi_fecham . "" . $asi_fechad . "" . $asi_fechah . "" . $asi_fechai . "" . $asi_fechas . "" . $operador->dni;
            $certificado->numero = $cert_numero;
            $certificado->cer_apellidos = $operador->apellidos;
            $certificado->cer_nombre = $operador->nombre;
            $certificado->operador = $operador->id;
            if ($operador->entidad != 0) {
                $certificado->entidad = $operador->entidad;
                $certificado->entidad_nombre = $operador->entidades_formadoreas->nombre;
            } else {
                $certificado->entidad = 0;
                $certificado->entidad_nombre = "";
            }
            $certificado->curso = $asistent->curso;
            $certificado->emision = $asistent->emision;
            $certificado->vencimiento = $asistent->vencimiento;
            $certificado->observaciones = $asistent->observaciones;
            $certificado->dni = $operador->dni;
            if ($cursos != null) {
                if ($cursos->tipo_curso == 1) {
                    $certificado->cer_type_course = 'Básico';
                    $certificado->tipos_carnet = $asistent->tipos_carnet;
                } else {
                    $certificado->cer_type_course = 'Renovación';
                    $certificado->tipos_carnet = $asistent->tipos_carnet;
                }
                $certificado->fecha_alta = $cursos->fecha_alta;
            } else {
                $certificado->cer_type_course = '-';
                $certificado->tipos_carnet = '-';
                $certificado->fecha_alta = null;
            }
            if ($asistent->tipo_1 != 0) {
                $tipo_1 = Tipo_Maquina::findOrFail($asistent->tipo_1);

                if ($tipo_1 != null) {
                    $certificado->tipo_1 = $tipo_1->tipo_maquina;

                } else {
                    $certificado->tipo_1 = '';
                }
            } else {
                $certificado->tipo_1 = '';
            }
            if ($asistent->tipo_2 != 0) {
                $tipo_2 = Tipo_Maquina::findOrFail($asistent->tipo_2);
                if ($tipo_2 != null) {
                    $certificado->tipo_2 = $tipo_2->tipo_maquina;

                } else {
                    $certificado->tipo_2 = '';
                }
            } else {
                $certificado->tipo_2 = '';
            }
            if ($asistent->tipo_3 != 0) {
                $tipo_3 = Tipo_Maquina::findOrFail($asistent->tipo_3);
                if ($tipo_3 != null) {
                    $certificado->tipo_3 = $tipo_3->tipo_maquina;
                } else {
                    $certificado->tipo_3 = '';
                }
            } else {
                $certificado->tipo_3 = '';
            }
            if ($asistent->tipo_4 != 0) {
                $tipo_4 = Tipo_Maquina::findOrFail($asistent->tipo_4);
                if ($tipo_4 != null) {
                    $certificado->tipo_4 = $tipo_4->tipo_maquina;
                } else {
                    $certificado->tipo_4 = '';
                }
            } else {
                $certificado->tipo_4 = '';
            }
            if ($operador->carnett != null) {
                $certificado->carnet = $operador->carnett->numero;
            }
            $certificado->save();
            return redirect()->route('admin.cursos.edit', $cursos->id)->with('cursos', 'entidad', 'formador', 'tipo_maquina', 'tipo_curso', 'examen_t', 'examen_p', 'formadors', 'formadors2', 'formadors3');
        } else {
            return redirect()->route('admin.asistent.create')->with('error', 'Data failed to add');
        }
    }

    public function export()
    {
        return Excel::download(new AssistantExport(), 'asistent.xlsx');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $curso)
    {
//        dd($curso);
        $user = auth()->user();
        if ($user->perfil == 'Administrador') {
            $entidad = EntidadesFormadoreas::select('id', 'nombre')->get();
        } else {
            $entidad = EntidadesFormadoreas::select('id', 'nombre')->where('id', '=', $user->entidad)->first();
        }
        $operadores = Operadores::findOrFail($id);

        return view('admin.asistent.operador', compact('operadores', 'entidad', 'curso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateOperador(Request $request, $id)
    {
//        dd($request);
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
            if ($request['carnet'] != null) {
                if ($operadores->carnett == null) {
                    $carnet = new Carnet();
                    if ($request->carnet != null) {
                        $carnet->numero = $request->carnet;
                    } else {
                        $carnet->numero = substr(md5(microtime()), rand(0, 26), 8);
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
                    $carnet->estado = 0;
                    $carnet->save();
                } else {
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

            return redirect()->route('admin.cursos.edit', [$request->curso])->with('success', 'Data deleted successfully');

        } else {

            return back()->with('error', 'Data failed to Update');

        }
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
            $operador = Operadores::select('id', 'nombre', 'apellidos')->get();
        } else {
            $operador = Operadores::select('id', 'nombre', 'apellidos')->where('entidad', '=', $user->entidad)->get();
        }
        $asistent = Asistent::findOrFail($id);
        $curso = Cursos::select('id', 'codigo')->get();
        $tipo_carnet = Teoria::select('id', 'formacion')->get();
        $tipo = Tipo_Maquina::orderBy('id', 'desc')->get();
        $corse = Cursos::where('id', $asistent->curso)->first();
        $tipo_1 = $corse->tipo_maquina_1;
        $tipo_2 = $corse->tipo_maquina_2;
        $tipo_3 = $corse->tipo_maquina_3;
        $tipo_4 = $corse->tipo_maquina_4;
        $tipos = [$tipo_1, $tipo_2, $tipo_3, $tipo_4];
        $tipo_maq = [];
        $notes = [];
        if ($corse->tipo_maquina_1 != null) {
            array_push($tipo_maq, $corse->tipo_maquina_1);
        }
        if ($corse->tipo_maquina_2 != null) {
            array_push($tipo_maq, $corse->tipo_maquina_2);
        }
        if ($corse->tipo_maquina_3 != null) {
            array_push($tipo_maq, $corse->tipo_maquina_3);
        }
        if ($corse->tipo_maquina_4 != null) {
            array_push($tipo_maq, $corse->tipo_maquina_4);
        }
        if (count($tipo_maq) == 4) {
            for ($i = 1; $i < 16; $i++) {
                array_push($notes, $i);
            }
        } elseif (count($tipo_maq) == 3) {

            if ($tipo_maq[0] == 1 || $tipo_maq[1] == 1 || $tipo_maq[2] == 1) {
//                array_push($notes,1);
            } else {
                array_push($notes, 2);
                array_push($notes, 4);
                array_push($notes, 6);
                array_push($notes, 8);
                array_push($notes, 10);
                array_push($notes, 12);
                array_push($notes, 14);
            }

            if ($tipo_maq[0] == 2 || $tipo_maq[1] == 2 || $tipo_maq[2] == 2) {
//                array_push($notes,2);
            } else {
                array_push($notes, 1);
                array_push($notes, 4);
                array_push($notes, 5);
                array_push($notes, 8);
                array_push($notes, 9);
                array_push($notes, 12);
                array_push($notes, 13);
            }
            if ($tipo_maq[0] == 5 || $tipo_maq[1] == 5 || $tipo_maq[2] == 5) {
//                array_push($notes,4);
            } else {
                array_push($notes, 1);
                array_push($notes, 2);
                array_push($notes, 3);
                array_push($notes, 8);
                array_push($notes, 9);
                array_push($notes, 10);
                array_push($notes, 11);
            }
            if ($tipo_maq[0] == 6 || $tipo_maq[1] == 6 || $tipo_maq[2] == 6) {
//                array_push($notes,8);
            } else {
                array_push($notes, 1);
                array_push($notes, 2);
                array_push($notes, 3);
                array_push($notes, 4);
                array_push($notes, 5);
                array_push($notes, 6);
                array_push($notes, 7);
            }

        } elseif (count($tipo_maq) == 2) {
            if ($tipo_maq[0] == 1 || $tipo_maq[1] == 1) {
                if ($tipo_maq[0] == 2 || $tipo_maq[1] == 2) {
                    array_push($notes, 1);
                    array_push($notes, 2);
                    array_push($notes, 3);
                } elseif ($tipo_maq[0] == 5 || $tipo_maq[1] == 5) {
                    array_push($notes, 1);
                    array_push($notes, 4);
                    array_push($notes, 5);
                } elseif ($tipo_maq[0] == 6 || $tipo_maq[1] == 6) {
                    array_push($notes, 1);
                    array_push($notes, 8);
                    array_push($notes, 9);
                }

            }
            if ($tipo_maq[0] == 2 || $tipo_maq[1] == 2) {
                if ($tipo_maq[0] == 5 || $tipo_maq[1] == 5) {
                    array_push($notes, 2);
                    array_push($notes, 4);
                    array_push($notes, 6);
                } elseif ($tipo_maq[0] == 6 || $tipo_maq[1] == 6) {
                    array_push($notes, 2);
                    array_push($notes, 8);
                    array_push($notes, 10);
                }

            }
            if ($tipo_maq[0] == 5 || $tipo_maq[1] == 5) {
                if ($tipo_maq[0] == 6 || $tipo_maq[1] == 6) {
                    array_push($notes, 4);
                    array_push($notes, 8);
                    array_push($notes, 12);
                }

            }
        } elseif (count($tipo_maq) == 1) {
            if ($tipo_maq[0] == 1) {
                array_push($notes, 1);
            } elseif ($tipo_maq[0] == 2) {
                array_push($notes, 2);
            } elseif ($tipo_maq[0] == 3) {
                array_push($notes, 16);
            } elseif ($tipo_maq[0] == 4) {
                array_push($notes, 17);
            } elseif ($tipo_maq[0] == 5) {
                array_push($notes, 4);
            } elseif ($tipo_maq[0] == 6) {
                array_push($notes, 8);
            }
        }
//        dd($tipos);

        return view('admin.asistent.edit', compact('notes', 'asistent', 'curso', 'operador', 'tipo_carnet', 'tipo', 'tipos'));
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
//        dd($request);
//        \Validator::make($request->all(), [
//            "category" => "required",
//            "desc" => "required"
//        ])->validate();
        $request->validate([
            'curso' => 'required',
            'orden' => 'required',
            'operador' => 'required',
            'tipo_carnet' => 'required',
//            'nota_t' => 'required',
//            'nota_p' => 'required',
            'tipo_1' => 'required',
            'examen_p_pdf' => 'max:2048',
            'examen_t_pdf' => 'max:2048',
        ]);
        $asistent = Asistent::findOrFail($id);
        $asistent->curso = $request->curso;
        $asistent->orden = $request->orden;
        $asistent->operador = $request->operador;
        $asistent->tipos_carnet = $request->tipos_carnet;
        $asistent->nota_t = $request->nota_t;
        $asistent->nota_p = $request->nota_p;
        $asistent->observaciones = $request->observaciones;
        $operador = Operadores::findOrFail((int)$request->operador);
        if ($asistent->emision != $request->emision) {
            $asistent->emision = $request->emision;
        }
        $asistent->vencimiento = $request->vencimiento;
        $asistent->tipo_1 = $request->tipo_1;
        if (!$request->tipo_2) {
            $asistent->tipo_2 = 0;
        } else {
            $asistent->tipo_2 = $request->tipo_2;
        }
        if (!$request->tipo_3) {
            $asistent->tipo_3 = 0;
        } else {
            $asistent->tipo_3 = $request->tipo_3;
        }
        if (!$request->tipo_4) {
            $asistent->tipo_4 = 0;
        } else {
            $asistent->tipo_4 = $request->tipo_4;
        }

        $examen_t_pdf = $request->file('examen_t_pdf');
        if ($examen_t_pdf) {
            $tFileName = 'TB-' . $asistent->cursos->curso . '-' . ($asistent->orden > 10 ? $asistent->orden : '0' . $asistent->orden . '.pdf');
            if ($examen_t_pdf->getClientOriginalName() != $tFileName)
                return back()->with('error', 'File name not correct');
            if ($asistent->examen_t_pdf && file_exists(storage_path('app/public/' . $asistent->examen_t_pdf))) {
                \Storage::delete('public/' . $asistent->examen_t_pdf);
            }
            $examen_t_pdf_path = $examen_t_pdf->storeAs('asistent',$examen_t_pdf->getClientOriginalName() ,'public');
            $asistent->examen_t_pdf = $examen_t_pdf_path;
        }
        $examen_p_pdf = $request->file('examen_p_pdf');
        if ($examen_p_pdf) {
            $pFileName = 'P' . substr($asistent->cursos->codigo, 1) . '-' . ($asistent->orden > 10 ? $asistent->orden : '0' . $asistent->orden . '.pdf');
            if ($examen_p_pdf->getClientOriginalName() != $pFileName)
                return back()->with('error', 'File name not correct');
            if ($asistent->examen_p_pdf && file_exists(storage_path('app/public/' . $asistent->examen_p_pdf))) {
                \Storage::delete('public/' . $asistent->examen_p_pdf);
            }
            $examen_p_pdf_path = $examen_p_pdf->storeAs('asistent',$examen_p_pdf->getClientOriginalName() ,'public');
            $asistent->examen_p_pdf = $examen_p_pdf_path;
        }
        if ($asistent->save()) {
            $cursos = Cursos::findOrFail($request->curso);
            if ($operador->carnett != null) {
                $carnet = $operador->carnett;
                $carnet->curso = $cursos->id;
                $carnet->estado = 1;
                $carnet->fecha_de_alta = $asistent->vencimiento;
                $carnet->fecha_de_emision = $asistent->emision;
//                $carnet->
                $carnet->save();
                if ($cursos->tipo_maquina_1 != null) {
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_1);
                }
                if ($cursos->tipo_maquina_2 != null) {
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_2);
                }
                if ($cursos->tipo_maquina_3 != null) {
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_3);
                }
                if ($cursos->tipo_maquina_4 != null) {
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_4);
                }
            } else {
                $carnet = new Carnet();
                if ($operador->carnet != null) {
                    $carnet->numero = $operador->carnet;
                } else {
                    $carnet->numero = substr(md5(microtime()), rand(0, 26), 8);
                }
//
                $carnet->operador = $operador->id;
                $carnet->fecha_de_alta = $asistent->vencimiento;
                $carnet->fecha_de_emision = $asistent->emision;
//                dd($cursos->tipo_maquina_1);
                $carnet->foto = $operador->foto;
                $carnet->curso = $cursos->id;
                $carnet->estado = 1;
//                dd($carnet);
                $carnet->save();
                if ($cursos->tipo_maquina_1 != null) {
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_1);
                }
                if ($cursos->tipo_maquina_2 != null) {
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_2);
                }
                if ($cursos->tipo_maquina_3 != null) {
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_3);
                }
                if ($cursos->tipo_maquina_4 != null) {
                    $carnet->Tipo_Maquinas()->attach($cursos->tipo_maquina_4);
                }
            }
            if ($operador->certificado()->where('curso', $cursos->id)->first() != null) {
                $certificado = $operador->certificado()->where('curso', $cursos->id)->first();
//                dd($certificado);
            } else {
                $certificado = new Certificado();
//                dd('2222222222');
            }

            $asi_fecha = date('Y', strtotime($asistent->created_at));
            $asi_fecham = date('m', strtotime($asistent->created_at));
            $asi_fechad = date('d', strtotime($asistent->created_at));
            $asi_fechah = date('h', strtotime($asistent->created_at));
            $asi_fechai = date('i', strtotime($asistent->created_at));
            $asi_fechas = date('s', strtotime($asistent->created_at));
            $asi_orden = $asistent->orden;
            $cert_numero = $asi_fecha . "" . $asi_fecham . "" . $asi_fechad . "" . $asi_fechah . "" . $asi_fechai . "" . $asi_fechas . "" . $operador->dni;
            $certificado->numero = $cert_numero;
            $certificado->cer_apellidos = $operador->apellidos;
            $certificado->cer_nombre = $operador->nombre;
            $certificado->operador = $operador->id;
            if ($operador->entidad != 0) {
                $certificado->entidad = $operador->entidad;
                $certificado->entidad_nombre = $operador->entidades_formadoreas->nombre;
            } else {
                $certificado->entidad = 0;
                $certificado->entidad_nombre = "";
            }
            $certificado->curso = $asistent->curso;
            $certificado->emision = $asistent->emision;
            $certificado->vencimiento = $asistent->vencimiento;
            $certificado->observaciones = $asistent->observaciones;
            $certificado->dni = $operador->dni;
            if ($cursos != null) {
                if ($cursos->tipo_curso == 1) {
                    $certificado->cer_type_course = 'Básico';
                    $certificado->tipos_carnet = $asistent->tipos_carnet;
                } else {
                    $certificado->cer_type_course = 'Renovación';
                    $certificado->tipos_carnet = $asistent->tipos_carnet;
                }
                $certificado->fecha_alta = $cursos->fecha_alta;
            } else {
                $certificado->cer_type_course = '-';
                $certificado->tipos_carnet = '-';
                $certificado->fecha_alta = null;
            }
            if ($asistent->tipo_1 != 0) {
                $tipo_1 = Tipo_Maquina::findOrFail($asistent->tipo_1);

                if ($tipo_1 != null) {
                    $certificado->tipo_1 = $tipo_1->tipo_maquina;

                } else {
                    $certificado->tipo_1 = '';
                }
            } else {
                $certificado->tipo_1 = '';
            }
            if ($asistent->tipo_2 != 0) {
                $tipo_2 = Tipo_Maquina::findOrFail($asistent->tipo_2);
                if ($tipo_2 != null) {
                    $certificado->tipo_2 = $tipo_2->tipo_maquina;

                } else {
                    $certificado->tipo_2 = '';
                }
            } else {
                $certificado->tipo_2 = '';
            }
            if ($asistent->tipo_3 != 0) {
                $tipo_3 = Tipo_Maquina::findOrFail($asistent->tipo_3);
                if ($tipo_3 != null) {
                    $certificado->tipo_3 = $tipo_3->tipo_maquina;
                } else {
                    $certificado->tipo_3 = '';
                }
            } else {
                $certificado->tipo_3 = '';
            }
            if ($asistent->tipo_4 != 0) {
                $tipo_4 = Tipo_Maquina::findOrFail($asistent->tipo_4);
                if ($tipo_4 != null) {
                    $certificado->tipo_4 = $tipo_4->tipo_maquina;
                } else {
                    $certificado->tipo_4 = '';
                }
            } else {
                $certificado->tipo_4 = '';
            }
            if ($operador->carnett != null) {
                $certificado->carnet = $operador->carnett->numero;
            }
            $certificado->save();


            return redirect()->route('admin.cursos.edit', [$asistent->curso])->with('success', 'Data updated successfully');

        } else {

            return redirect()->route('admin.asistent.edit')->with('error', 'Data failed to update');

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
        $asistent = Asistent::findOrFail($id);
        $curso = $asistent->curso;
        $asistent->delete();

        return redirect()->route('admin.cursos.edit', [$curso])->with('success', 'Data deleted successfully');
    }

}
