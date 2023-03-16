@extends('layouts.print')

@section('styles')

    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        td{
            line-height: 1.0!important;
            font-size:12px!important;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
            padding: 6px!important;
        }
        @media print {
            .myid_print_duo_name { /* Replace class_name with * to target all elements */
                -webkit-print-color-adjust: exact;
                color-adjust: exact; /* Non-Webkit Browsers */
            }
        }
    </style>

@endsection

@section('content')
    @if($cursos->estado != 0)
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <img width="150" height="75" src="{{ asset('admin/img/formacion.png')}}" class="attachment-medium size-medium" alt="" loading="lazy" srcset="" sizes="(max-width: 207px) 100vw, 207px">
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
                        <h3 style="text-align: center;">{{$cursos->entidades_formadoreas->razon_social}}</h3>
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
                @if(count($cursos->horario)<10 && count($cursos->horario)!=0)
                    @for($i=10-count($cursos->horario);$i>0;$i--)
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                    @endfor
                    @elseif(count($cursos->horario)==0)
                    @for($i=10-count($cursos->horario);$i>0;$i--)
                    <tr style="height: 35px">
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
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
                    <th style="text-align: center;height: 300px;">
                        <span>Firma del Responsable de formación y sello de la Entidad Formadora</span>
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
            <img width="150" height="75" src="{{ asset('admin/img/formacion.png')}}" class="attachment-medium size-medium" alt="" loading="lazy" srcset="" sizes="(max-width: 207px) 100vw, 207px">
        </div>
        <div class="col-lg-1">

        </div>
        <div class="col-lg-8">
            <h4 style="float: right;"><b>{{__('message.Control de asistencia y calificaciones')}}</b></h4>
        </div>
{{--        <div class="clearfix"></div>--}}
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>
                        <span style="font-size: 12px!important;"> {{__('message.Curso')}} : {{$cursos->codigo}} </span>
                    </th>
                    <th>
                        <span style="font-size: 12px!important;"> {{__('message.Entidad formadora')}} : {{$cursos->entidades_formadoreas->razon_social}}</span>
                    </th>
                    <th>
                        <span style="font-size: 12px!important;"> {{__('message.Fecha')}}: {{date('d/m/Y',strtotime($cursos->fecha_inicio))}}</span>
                    </th>
                </tr>
                <tr>
                    <th colspan="3">
                        <span style="font-size: 12px!important;"> {{__('message.Formador')}}: </span>
                        <span style="text-align: center;font-size:12px">{{$cursos->formadores->nombre}} {{$cursos->formadores->apellidos}}</span>
                    </th>
                </tr>
                <tr>
                    <th>
                        <span style="font-size: 12px!important;"> {{__('message.Formadores de apoyo')}}: </span>
                        <sup style="float: right;margin-top:7px;">(1)</sup>
                        <h6 style="text-align: center;">{{$formador1 != null ? $formador1->nombre : ""}} {{$formador1 != null ? $formador1->apellidos:""}}</h6>
                    </th>
                    <th>
                        <sup style="float: right;margin-top:-10px">(2)</sup>
                        <h6 style="text-align: center;">{{$formador2 != null ? $formador2->nombre : ""}} {{$formador2 != null ? $formador2->apellidos : ""}}</h6>
                    </th>
                    <th>
                        <sup style="float: right;margin-top:-10px;">(3)</sup>
                        <h6 style="text-align: center;">{{$formador3 != null ? $formador3->nombre : ""}} {{$formador3 != null ? $formador3->apellidos : ""}}</h6>
                    </th>
                </tr>
                </thead>
            </table>
            <table class="table table-bordered" style="margin-top:-20px">
                <thead>
                <tr >
                    <th rowspan="2" style="text-align: center;width: 7%;vertical-align: middle;font-size: 12px">{{__('message.N-As')}}.</th>
                    <th rowspan="2" style="text-align: center;width:14%;vertical-align: middle;font-size: 12px">{{__('message.DNI')}}<sup>1</sup></th>
                    <th rowspan="2" style="text-align: center;vertical-align: middle;font-size: 12px">{{__('message.Apellidos y nombre')}}</th>
                    <th style="text-align: center" colspan="2" >
                        <span style="font-size: 11px">{{__('message.NOTAs')}}<sup>2</sup></span>
                    </th>
                    <th rowspan="2" style="text-align: center;vertical-align: middle;font-size: 12px">{{__('message.Firma del alumno')}}<sup>3</sup></th>
                </tr>
                <tr>
                    <th style="text-align: center;font-size: 10px">Teoría</th>
                    <th style="text-align: center;font-size: 10px">Práct.</th>
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
                @if(count($cursos->asistent)<10 && count($cursos->asistent)!=0)
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
                @elseif(count($cursos->asistent)==0)
                    @for($i=10-count($cursos->asistent);$i>0;$i--)
                        <tr style="height: 35px">
                            <td style="text-align: center;">{{++$no}} </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                    @endfor
                @endif
                </tbody>
            </table>
            <span >{{__('message.Firmas')}}:</span>
            <table class="table table-bordered">
                <thead>
                <tr style="height: 50px!important;">
                    <th width="25%">
                        <span style="font-size: 14px"> {{__('message.Formador')}}:</span>
                        <h6 style="text-align: center;">{{$cursos->formadores->nombre}} {{$cursos->formadores->apellidos}}</h6>
                    </th>
                    <th width="25%">
                        <span style="font-size: 14px"> {{__('message.Formadores de apoyo')}}: <sup style="float: right;margin-top:5px">(1)</sup></span>
                        <h6 style="text-align: center;">{{$formador1 != null ? $formador1->nombre : ""}} {{$formador1 != null ? $formador1->apellidos:""}}</h6></th>
                    <th width="25%">
                        <sup style="float: right;margin-top:-20px">(2)</sup>
                        <h6 style="text-align: center;">{{$formador2 != null ? $formador2->nombre : ""}} {{$formador2 != null ? $formador2->apellidos : ""}}</h6></th></th>
                    <th width="25%">
                        <sup style="float: right;margin-top:-20px">(3)</sup>
                        <h6 style="text-align: center;">{{$formador3 != null ? $formador3->nombre : ""}} {{$formador3 != null ? $formador3->apellidos : ""}}</h6></th></th>
                </tr>
                <tr >
                    <th colspan="4" style="text-align: center;height: 70px;vertical-align: top;">
                        <span style="font-size: 16px">Firma del Responsable de formación y sello de la Entidad Formadora</span>

                    </th>
                </tr>
                </thead>
            </table>
            <div>
            <hr style="border-top: solid 1px #000 !important;margin-bottom: 5px!important;margin-top: 2px!important;width:30%;margin-left:20px!important;">
            <p style="font-size: 10px;  line-height: 1em;margin-left:20px;">
                <sup>1</sup><b>El Formador acredita</b> la identificación de los Alumnos mediante sus DNI y valida sus firmas en los exámenes y en el presente
                documento.<br>
                <sup>2</sup><b>El Formador acredita</b> la veracidad de las notas de los Exámenes obtenidas por cada uno de ellos.<br>
                <sup>3</sup><b>El alumno reconoce con su firma, que ha asistido a la presente formación y que ha recibido el material didáctico original.</b>
            </p>
            </div>
            <div style="color: ">
            <hr style="border-top: solid 1px #000 !important;margin-bottom: 2px!important;margin-top: 0px!important;margin-left:20px;">
            <p class="s9" style="text-align: center;color: #3374b7!important; font-size:12px!important;">ASOCIACIÓN NACIONAL DE ALQUILADORES DE PLATAFORMAS AÉREAS DE TRABAJO (COFIGRUHA)<br>
                <span style=" color: #548CD4!important;">Albasanz, 67 – Of: 47 – 28037 MADRID –Tel. 913 758 122– CIF: G80751860 – Nº Reg. 99004026</span></p>
            </div>
        </div>
    </div>
</div>

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
