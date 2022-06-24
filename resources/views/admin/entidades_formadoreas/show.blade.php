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

                            <h2>{{$entidadesFormadore->nombre}}</h2>
                            <div class="d-flex align-items-center">
                                <h3>Ciudad : {{$entidadesFormadore->ciudad}} <br>
                                    Socio : {{$entidadesFormadore->socio}}
                                </h3>
                                <img class="image" src="{{asset('storage/' . $entidadesFormadore->logo)}}" alt=""></div>
                            <hr/>
                            <p>Province : {{$entidadesFormadore->province}}</p>
                            <p>Dirección : {{$entidadesFormadore->direccion}}</p>
                            <p>CIF : {{$entidadesFormadore->cif}}</p>
                            <p>Razón social : {{$entidadesFormadore->razon_social}}</p>
                            <p>Codigo postal : {{$entidadesFormadore->codigo_postal}}</p>
                            <p>Web: <a href="{{$entidadesFormadore->web}}" > {{$entidadesFormadore->web}}</a></p>
                            <p>mail : <a href="mailto:{{$entidadesFormadore->mail}}" > {{$entidadesFormadore->mail}}</a></p>
                            <p>Fecha : {{date('d/m/Y',strtotime($entidadesFormadore->fecha))}} </p>
                            <p>Certificada : {{$entidadesFormadore->certificado == 0 ? "En Proceso de Certificación" : "Yes"}}</p>
                            <p></p>
                            {{--              <div class="d-flex justify-content-center">--}}
                            {{--              <a href="">Show Assistants</a>--}}
                            {{--              <span class="ml-3 mr-3">or</span>--}}
                            {{--              <a href="">Download</a>--}}
                            {{--              </div>--}}
                            <p></p>
                            <button><a href="{{$entidadesFormadore->web}}" style="color: #000000;"> Web</a></button>
                        </div>
                    </div>

                </div>
            </div>
        </section><!-- End Testimonials Section -->

    </main>
@endsection

