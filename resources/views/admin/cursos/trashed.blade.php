@extends('layouts.admin')

@section('styles')

    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Eliminación Cursos</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>{{__('message.Cursos')}}</th>
                        <th>{{__('message.Codigo')}}</th>
                        <th>{{__('message.Provincia')}}</th>
                        <th>{{__('message.Direccion')}}</th>
                        <th>{{__('message.Option')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $no=0; @endphp
                    @foreach ($cursos as $cursos)
                        @if(auth()->user()->perfil=='Administrador' || (auth()->user()->perfil=='Responsable_de_Formacion' && auth()->user()->entidad==$cursos->entidad)
                                             || (auth()->user()->perfil=='Formador' && auth()->user()->entidad==$cursos->entidad))
                            <tr>
                                <td>{{ $cursos->curso }}</td>
                                <td>
                                    {{ $cursos->codigo }}
                                </td>
                                <td>{{ $cursos->provincia }}</td>
                                <td>{{ $cursos->direccion }}</td>
                                <td>
                                    @if(auth()->user()->perfil=='Administrador' || (auth()->user()->perfil=='Responsable_de_Formacion' && auth()->user()->entidad==$cursos->entidad) && $cursos->estado ==1
                                                                              || (auth()->user()->perfil=='Formador' && auth()->user()->entidad==$cursos->entidad && $cursos->estado ==1))
                                        @if(auth()->user()->perfil=='Responsable_de_Formacion' && $cursos->cerrado ==0 || auth()->user()->perfil=='Administrador' || auth()->user()->perfil=='Formador' && $cursos->cerrado ==0)
                                            <form method="POST"
                                                  action="{{route('admin.cursos.restore')}}"
                                                  class="d-inline"
                                                  onsubmit="return confirm('{{__("message.Restore this cursos ?")}}')">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$cursos->id}}">
                                                <button type="submit" value="Delete" class="btn btn-edit btn-sm">
                                                    <i class='fas fa-trash-restore'></i>
                                                </button>
                                            </form>
                                            @if(auth()->user()->perfil=='Administrador')
                                                <form method="post" action="{{route('admin.cursos.force-delete')}}" class="d-inline" onsubmit="return confirm('{{__("message.Delete this cursos permanently?")}}')">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$cursos->id}}">
                                                    <button type="submit" value="Delete" class="btn btn-delete btn-sm">
                                                        <i class='fas fa-trash-alt'></i>
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <span class="-align-center">Curso Cerrado</span>
                                        @endif
                                        {{--                            <a href="{{route('admin.cursos.activo', [$cursos->id])}}" class="btn btn-edit btn-sm"> Activo </a>--}}
                                    @else
                                        <span class="-align-center">Curso Inactivo</span>
                                    @endif

                                </td>
                            </tr>
                        @endif
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
