@extends('layouts.admin')

<link href="{{ asset('front/css/style-anapat.css') }}" rel="stylesheet">
@section('content')
    <main id="main">

        <!-- ======= Testimonials Section ======= -->
        <section class="courses">
            <div class="container">
                <h2 class="title" style="margin: 50px 0;"></h2>
                <div class="row">

                    <div class="d-flex justify-content-center contain-card">
                        <div class="card">

                            <h2>{{$operador->nombre}}{{$operador->apellidos}}</h2>
                            <div class="d-flex align-items-center">
                                <h3>Ciudad : {{$operador->ciudad}} <br>
                                    dni : {{$operador->dni}}
                                </h3>
                                <img class="image" src="{{asset('storage/' . $operador->foto)}}" alt="">
                            <img class="image" src="{{asset('storage/' . $operador->dni_img)}}" alt=""></div>
                            <hr/>
                            <p>Province : {{$operador->provincia}}</p>
                            <p>Dirección : {{$operador->direccion}}</p>
                            <p>Codigo postal : {{$operador->codigo_postal}}</p>
                            <p>mail : <a href="mailto:{{$operador->mail}}" > {{$operador->mail}}</a></p>
                            <p>Fecha Nacimiento : {{date('d/m/Y',strtotime($operador->fecha_nacimiento))}} </p>
                        <p>Fecha : {{date('d/m/Y',strtotime($operador->fecha))}} </p>
                            <p>Entidad : {{$operador->entidades_formadoreas->nombre}}</p>

                            <p>Asistente :
                                @foreach($operador->asistent as $asis)
                                    {{$asis->cursos->codigo}},
                                @endforeach
                            </p>
                            <p>Carnet :  {{$operador->carnett != null ?$operador->carnett->numero : "----"}}
                            <p>Certificado :
                                @foreach($operador->certificado as $certificado)
                                    {{$certificado->numero}},
                                @endforeach
                            </p>
                            </p>
                            {{--              <div class="d-flex justify-content-center">--}}
                            {{--              <a href="">Show Assistants</a>--}}
                            {{--              <span class="ml-3 mr-3">or</span>--}}
                            {{--              <a href="">Download</a>--}}
                            {{--              </div>--}}
                            <p></p>
                        </div>
                    </div>

                </div>
            </div>
        </section><!-- End Testimonials Section -->

    </main>
@endsection

