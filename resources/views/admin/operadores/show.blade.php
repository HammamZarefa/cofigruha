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


                            <div class="d-flex align-items-center">
                                <img class="image" src="{{asset('storage/' . $operador->foto)}}" alt="" width="120px">
                            {{--<img class="image" src="{{asset('storage/' . $operador->dni_img)}}" alt=""></div>--}}
                            </div>
                            <hr/>
                            <h2>{{$operador->nombre}}  {{$operador->apellidos}}</h2>
                            <p>DNI : {{$operador->dni}}</p>
                            <p>Carnet :  {{$operador->carnett != null ?$operador->carnett->numero : ""}}</p>
                            <p>Fecha Nacimiento : {{date('d/m/Y',strtotime($operador->fecha_nacimiento))}} </p>
                            <p>Entidad : {{$operador->entidades_formadoreas->nombre}}</p>
                            <p>Asistente :
                                @foreach($operador->asistent as $asis)
                                    {{$asis->cursos->codigo}},
                                @endforeach
                            </p>
                            <p>Dirección : {{$operador->direccion}}</p>
                            <p>Ciudad : {{$operador->ciudad}} </p>
                            <p>Provincia : {{$operador->provincia}}</p>
                            <p>Codigo postal : {{$operador->codigo_postal}}</p>
                            <p>Mail : <a href="mailto:{{$operador->mail}}" > {{$operador->mail}}</a></p>
                            <p>Fecha : {{date('d/m/Y',strtotime($operador->fecha))}} </p>




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

