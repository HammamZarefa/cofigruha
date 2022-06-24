@extends('layouts.front')

@section('content')
<main id="main">

    <!-- ======= Testimonials Section ======= -->
    <section class="courses">
      <div class="container">
      <h2 class="title" style="margin: 50px 0;"></h2>
        <div class="row">

        <div class="d-flex justify-content-center contain-card">
        <div class="card">
              <div class="d-flex justify-content-between flex-wrap">
              <h2>{{$curso->codigo}}</h2>
              <h3>{{$curso->curso}}</h3>
            </div>
              <h3></h3>
              <hr/>
             <p>Province :{{$curso->provincia}}</p>
             <p>Ciudad :{{$curso->ciudad}} </p>
             <p>Direccion :{{$curso->direccion}}</p>
             <p>Codigo Postal :{{$curso->codigo_postal}} </p>
             <div class="d-flex align-items-center mt-3" >
               <p style="margin:0 15px 0 0">Entidad formadora :</p>
               <a >{{$entidad->nombre}}</a>
             </div>
             <p>Fecha de inicio : {{$curso->fecha_inicio}} </p>
             <p> Tipo Maquina : @foreach($tipo as $tipo)
                     {{$curso->tipo_maquina_1 == $tipo->id ? "$tipo->tipo_maquina ," : ""}}
                     {{$curso->tipo_maquina_2 == $tipo->id ? "$tipo->tipo_maquina ," : ""}}
                     {{$curso->tipo_maquina_3 == $tipo->id ? "$tipo->tipo_maquina ," : ""}}
                     {{$curso->tipo_maquina_4 == $tipo->id ? "$tipo->tipo_maquina ," : ""}}
                     {{--                {{$entidade->id}}--}}
                 @endforeach </p>

             <p>horarios:</p>
             <p></p>
            <div class="row">
                <div class="col-sm" style="border: 2px solid #ddd;">
                    <label for="horario" class="col-sm-2 col-form-label">Horario</label>
                    <div class="col-sm-12">

                        <div class="table-responsive">

                            <table class="table" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Contenido</th>

                                    <th>Fecha Inicio</th>

                                    <th>Final</th>

                                    <th>Alumnos</th>



                                </tr>

                                </thead>

                                <tbody>



                                @foreach ($horario as $horario)

                                    <tr>
                                        <td>{{ $horario->contenido }}</td>

                                        <td>{{ $horario->fecha_inicio }}</td>

                                        <td>{{ $horario->final }}</td>

                                        <td>{{ $horario->alumnos }}</td>

                                    </tr>
                                @endforeach

                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
              <p></p>
            <p>Asistentes:</p>
            <p></p>
            <div class="row">
                <div class="col-sm" style="border: 2px solid #ddd;">
                    <label for="asistent" class="col-sm-2 col-form-label">Asistent</label>
                    <div class="col-sm-12">

                        <div class="table-responsive">

                            <table class="table" id="dataTable" width="100%" cellspacing="0">

                                <thead>

                                <tr>

                                    <th style="vertical-align: top;">Apellido.</th>

                                    <th style="vertical-align: top;">Nombre</th>

                                    <th style="vertical-align: top;">Número de asistente</th>

                                    <th style="vertical-align: top;">Nota Examen teorico	</th>

                                    <th style="vertical-align: top;">Nota Examen Practico	</th>

                                </tr>

                                </thead>

                                <tbody>

                                @php

                                    $no=0;

                                @endphp

                                @foreach ($asistent as $asistent)

                                    <tr>

                                        <td>
                                            @foreach($operador as $ope)
                                                {{$ope->id == $asistent->operador ? $ope->apellidos : "" }}
                                            @endforeach
                                        </td>

                                        <td>
                                            @foreach($operador as $ope)
                                                {{$ope->id == $asistent->operador ? $ope->nombre : "" }}
                                            @endforeach
                                        </td>

                                        <td>

                                            {{ $asistent->orden }}

                                        </td>

                                        <td>{{ $asistent->nota_t }}</td>

                                        <td>{{ $asistent->nota_p }}</td>



                                    </tr>

                                @endforeach

                                </tbody>

                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <p></p>
              <div class="d-flex justify-content-center">
                  @if(isset($curso->asistentes_pdf))
              <a href="{{asset('storage/' . $curso->asistentes_pdf)}}">mostrar Asistentes</a>
              <span class="ml-3 mr-3">or</span>
              <a href="{{asset('storage/' . $curso->asistentes_pdf)}}" download>Descargar</a>
                  @else
                      <span>no Asistentes</span>
                      @endif
              </div>
        </div>
      </div>

        </div>
      </div>
    </section><!-- End Testimonials Section -->

  </main><!-- End #main -->
@endsection
