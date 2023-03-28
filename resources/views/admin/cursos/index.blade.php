@extends('layouts.admin')

@section('styles')
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{__('message.Cursos')}}</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            @if(auth()->user()->perfil=='Administrador' || (auth()->user()->perfil=='Responsable_de_Formacion' ))
                <a href="{{ route('admin.cursos.create') }}" class="btn btn-pass">{{__('message.add_new')}}</a>
            @endif
            @if(auth()->user()->perfil=='Administrador')
                <a href="{{ route('admin.cursos.export',auth()->user()->entidad) }}" class="btn btn-primary">
                    {{__('message.Exportar Cursos')}}
                </a>
                <a href="{{ route('admin.asistent.export',auth()->user()->entidad) }}" class="btn btn-primary">
                    {{__('message.Exportar asistent')}}
                </a>
            @endif
        </div>
        <div class="card-body col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>{{__('message.Cursos')}}</th>
                        <th>{{__('message.Codigo')}}</th>
                        <th>{{__('message.Provincia')}}</th>
                        <th>{{__('message.Entidad')}}</th>
                        <th>{{__('message.Direccion')}}</th>
                        <th>{{__('message.Fecha Inicio')}}</th>
                        <th>{{__('message.Option')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        $no=0;
                    @endphp
                    @foreach ($cursos as $cursos)
                        @can('show_course',$cursos)
                            <tr>
                                <td>{{ $cursos->curso }}</td>
                                <td>
                                    {{ $cursos->codigo }}
                                </td>
                                <td>{{ $cursos->provincia }}</td>
                                <td>{{ @$cursos->entidades_formadoreas->nombre }}</td>
                                <td>{{ $cursos->direccion }}</td>
                                <td>{{ $cursos->fecha_inicio }}</td>

                                <td>
                                    @if(auth()->user()->perfil=='Administrador' || (auth()->user()->perfil=='Responsable_de_Formacion' && auth()->user()->entidad==$cursos->entidad) && $cursos->estado ==1
                                                                              || (auth()->user()->perfil=='Formador' && auth()->user()->entidad==$cursos->entidad && $cursos->estado ==1))
                                        @if(auth()->user()->perfil=='Responsable_de_Formacion' && $cursos->cerrado ==0 || auth()->user()->perfil=='Administrador' || auth()->user()->perfil=='Formador' && $cursos->cerrado ==0)
                                            <a href="{{route('admin.cursos.edit', [$cursos->id])}}"
                                               class="btn btn-edit btn-sm"> <i class="fas fa-edit"></i> </a>
                                            @if(auth()->user()->perfil=='Administrador')
                                                @if(count($cursos->certificados)<1 && count($cursos->carnet)<1 && count($cursos->asistent)<1)
                                                    <form method="POST"
                                                          action="{{route('admin.cursos.destroy', [$cursos->id])}}"
                                                          class="d-inline"
                                                          onsubmit="return confirm('{{__("message.Delete this cursos ?")}}')">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" value="Delete"
                                                                class="btn btn-delete btn-sm">
                                                            <i class='fas fa-trash-alt'></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        @else
                                            <span class="-align-center">Curso Cerrado</span>
                                        @endif
                                        {{--                            <a href="{{route('admin.cursos.activo', [$cursos->id])}}" class="btn btn-edit btn-sm"> Activo </a>--}}
                                    @else
                                        <span class="-align-center">Curso Inactivo</span>
                                    @endif
                                    <a href="{{route('admin.cursos.print', [$cursos->id])}}"
                                       class="btn btn-edit btn-sm" target="_blank"> <i class="fas fa-print"></i> </a>
                                    @if(isset($cursos->asistentes_pdf))
                                        <a title="Descargar lista de asistentes"
                                           href="{{asset('storage/' . $cursos->asistentes_pdf)}}"
                                           class="btn btn-edit btn-sm" download><i class="fa fa-download"></i></a>
                                        <a title="mostrar lista de asistentes" target="_blank"
                                           href="{{asset('storage/' . $cursos->asistentes_pdf)}}"
                                           class="btn btn-edit btn-sm"><i
                                                    class="fa fa-eye"></i> </a>
                                    @endif
                                    @if(auth()->user()->perfil=='Administrador')
                                        <a href="{{route('admin.cursos.asistents',$cursos)}}"
                                           class="btn btn-edit btn-sm" target="_blank"> <i class="fas fa-user-graduate"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endcan
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>
@endpush
