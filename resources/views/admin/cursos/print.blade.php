@extends('layouts.print')

@section('styles')

    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

    @if($cursos->estado != 0)
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <img width="200" height="70" src="{{ asset('admin/img/logo-anpat.png')}}" class="attachment-medium size-medium" alt="" loading="lazy" srcset="" sizes="(max-width: 207px) 100vw, 207px">

        </div>
        <div class="col-lg-6">

        </div>
        <div class="col-lg-3">
            <H2 style="float: right;">{{__('message.Horario del curso')}}</H2>
            <span style="float: right;">{{__('message.version')}} 02</span>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>
                        <span> {{__('message.Curso')}} : </span>
                        <h3 style="text-align: center;">{{$cursos->codigo}}</h3>
                    </th>
                    <th>
                        <span> {{__('message.Entidad formadora')}} : </span>
                        <h3 style="text-align: center;">{{$cursos->entidades_formadoreas->nombre}}</h3>
                    </th>
                </tr>
                </thead>
            </table>
        </div>
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>
                        {{__('message.CONTENIDO')}}
                    </th>
                    <th>
                        {{__('message.FECHA Y HORA DE INICIO')}}
                    </th>
                    <th>
                        {{__('message.FECHA Y HORA DE FIN')}}
                    </th>
                    <th>
                        {{__('message.NUMERO ALUMNOS')}}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($cursos->horario as $hora)
                    <tr>
                        <td>{{$hora->contenido}}</td>
                        <td>{{date('d/m/Y H:i:s',strtotime($hora->fecha_inicio))}}</td>
                        <td>{{date('d/m/Y H:i:s',strtotime($hora->final))}}</td>
                        <td>{{$hora->alumnos}}</td>
                    </tr>
                @endforeach
                @if(count($cursos->horario)<10)
                    @for($i=10-count($cursos->horario);$i>0;$i--)
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @endfor
                @endif
                </tbody>
            </table>
        </div>
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="text-align: center;height: 200px;">
                        <span>{{__('message.Firma del Responsable de formacion y selio de la Entidad Formadora')}}</span>
                    </th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<br><br>
    @endif
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <img width="200" height="67" src="{{ asset('admin/img/logo-anpat.png')}}" class="attachment-medium size-medium" alt="" loading="lazy" srcset="" sizes="(max-width: 207px) 100vw, 207px">

        </div>
        <div class="col-lg-1">

        </div>
        <div class="col-lg-8">
            <H4 style="float: right;">{{__('message.Control de asistencia y calificaciones')}}</H4>
        </div>
{{--        <div class="clearfix"></div>--}}
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>
                        <span> {{__('message.Curso')}} : </span>
                        <h5 style="text-align: left;">{{$cursos->codigo}}</h5>
                    </th>
                    <th>
                        <span> {{__('message.Entidad formadora')}} : </span>
                        <h5 style="text-align: center;">{{$cursos->entidades_formadoreas->nombre}}</h5>
                    </th>
                    <th>
                        <span> {{__('message.Fecha')}}: </span>
                        <h5 style="text-align: center;">{{$cursos->fecha_inicio}}</h5>
                    </th>
                </tr>
                <tr>
                    <th colspan="3">
                        <span> {{__('message.Formador')}}: </span>
                        <span style="text-align: center;">{{$cursos->formadores->nombre}} {{$cursos->formadores->apellidos}}</span>
                    </th>
                </tr>
                <tr>
                    <th>
                        <span> {{__('message.Formadores de apoyo')}}: </span>
                        <h5 style="text-align: center;">{{$formador1 != null ? $formador1->nombre : ""}} {{$formador1 != null ? $formador1->apellidos:""}}</h5>
                    </th>
                    <th>

                        <h5 style="text-align: center;">{{$formador2 != null ? $formador2->nombre : "-"}} {{$formador2 != null ? $formador2->apellidos : ""}}</h5>
                    </th>
                    <th>

                        <h5 style="text-align: center;">{{$formador3 != null ? $formador3->nombre : "-"}} {{$formador3 != null ? $formador3->apellidos : ""}}</h5>
                    </th>
                </tr>
                </thead>
            </table>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th rowspan="2" style="text-align: center;">{{__('message.N-As')}}.</th>
                    <th rowspan="2" style="text-align: center;">{{__('message.DNI')}}</th>
                    <th rowspan="2" style="text-align: center;">{{__('message.Apellidos y nombre')}}</th>
                    <th style="text-align: center" colspan="2" >
                        <span>{{__('message.NOTAs')}}</span>
                    </th>
                    <th rowspan="2" style="text-align: center;">{{__('message.Firma del alumno')}}</th>
                </tr>
                <tr>
                    <th style="text-align: center;">{{__('message.teoria')}}</th>
                    <th style="text-align: center;">{{__('message.pract')}}</th>
                </tr>
                </thead>
                <tbody>
                @php

                    $no=00;

                @endphp
                @foreach($cursos->asistent as $asistent)
                <tr>
                    <td style="text-align: center;">{{++$no}}</td>
                    <td style="text-align: center;">{{$asistent->operadores->dni}}</td>
                    <td style="text-align: center;">{{$asistent->operadores->nombre}} {{$asistent->operadores->apellidos}}</td>
                    <td style="text-align: center;">{{$asistent->nota_t}}</td>
                    <td style="text-align: center;">{{$asistent->nota_p}}</td>
                    <td style="text-align: center;"></td>
                </tr>
                    @endforeach
                @if(count($cursos->asistent)<10)
                    @for($i=10-count($cursos->asistent);$i>0;$i--)
                        <tr>
                            <td style="text-align: center;">{{++$no}}</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td></td>
                        </tr>
                    @endfor
                @endif
                </tbody>
            </table>
            <span>{{__('message.Firmas')}}:</span>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th width="25%">
                        <span> {{__('message.Formador')}}:</span>
                        <h5 style="text-align: center;">{{$formador1 != null ? $formador1->nombre : ""}} {{$formador1 != null ? $formador1->apellidos:""}}</h5>
                    </th>
                    <th width="25%">
                        <span> {{__('message.Formadores de apoyo')}}: </span>
                        <h5 style="text-align: center;">{{$formador1 != null ? $formador1->nombre : ""}} {{$formador1 != null ? $formador1->apellidos:""}}</h5></th>
                    <th width="25%">
                        <h5 style="text-align: center;">{{$formador2 != null ? $formador2->nombre : "-"}} {{$formador2 != null ? $formador2->apellidos : ""}}</h5></th></th>
                    <th width="25%">
                        <h5 style="text-align: center;">{{$formador3 != null ? $formador3->nombre : "-"}} {{$formador3 != null ? $formador3->apellidos : ""}}</h5></th></th>
                </tr>
                <tr>
                    <th colspan="4" style="text-align: center;height: 100px;">
                        <span>{{__('message.Firma del Responsable de formacion y selio de la Entidad Formadora')}}</span>
                    </th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

{{--@foreach($cursos->asistent as $asistent)--}}
{{--<div class="container">--}}
{{--    <div class="row">--}}
{{--        <div class="col-lg-3">--}}
{{--            <img width="207" height="97" src="{{ asset('admin/img/logo-anpat.png')}}" class="attachment-medium size-medium" alt="" loading="lazy" srcset="" sizes="(max-width: 207px) 100vw, 207px">--}}

{{--        </div>--}}
{{--        <div class="col-lg-6">--}}

{{--        </div>--}}
{{--        <div class="col-lg-3">--}}
{{--            <H3 style="float: right;">Examen Teórico {{$examen_t->codigo}}</H3>--}}
{{--            <span style="float: right;">version 01</span>--}}
{{--        </div>--}}
{{--        <div class="clearfix"></div>--}}
{{--        <div class="col-lg-12">--}}
{{--            <table class="table table-bordered">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>--}}
{{--                        <span> Codigo Examen : </span>--}}
{{--                        <h5 style="text-align: left;">{{$examen_t->codigo}},  {{$cursos->curso}},  {{$asistent->orden}}</h5>--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        <span> Fecha : </span>--}}
{{--                        <h5 style="text-align: left;">{{$cursos->fecha_inicio}}</h5>--}}
{{--                    </th>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th>--}}
{{--                        <span> Curso: </span>--}}
{{--                        <h5 style="text-align: left;">{{$cursos->tipo_curso}},  {{$cursos->codigo}},  {{$cursos->curso}}</h5>--}}
{{--                    </th>--}}
{{--                    <th>--}}
{{--                        <span> Formador : </span>--}}
{{--                        <h5 style="text-align: left;">{{$cursos->formadores->nombre}} {{$cursos->formadores->apellidos}}</h5>--}}
{{--                    </th>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <th colspan="2">--}}
{{--                        <span> Nombre del Alumno : </span>--}}
{{--                        <h5 style="text-align: center;">{{$asistent->operadores->nombre}} {{$asistent->operadores->apellidos}}</h5>--}}
{{--                    </th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--            </table>--}}
{{--            <h2 style="text-align: center;text-decoration-line: underline;">Cuestionario de Prequntas</h2>--}}
{{--            <embed--}}
{{--                id="myIFrame"--}}
{{--                src="{{ asset('storage/'.$asistent->examen_t_pdf) }}#toolbar=0&navpanes=0&scrollbar=0"--}}
{{--                frameBorder="0"--}}
{{--                scrolling="auto"--}}
{{--                height="100%"--}}
{{--                width="100%"--}}
{{--            >--}}
{{--                <script>function getIFrame() {--}}
{{--                        console.log('getIFrame')--}}
{{--                    }</script>--}}
{{--            </embed>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endforeach--}}
<div class="container" id="print-div" style="margin-bottom: 50px;">
    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary" id="print-link" onclick="printx();" style="width: 100%;">
                {{__('message.Print')}}
            </button>
        </div>
    </div>
</div>





<script type="text/javascript">
    function printx(){
        document.getElementById('print-div').style.display = "none";
        document.getElementById('print-link').style.display = "none";
        window.print()
    }
</script>
@endsection
