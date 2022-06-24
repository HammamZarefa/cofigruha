@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{__('message.Operadores')}}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">
        @if(auth()->user()->perfil=='Administrador' || (auth()->user()->perfil=='Responsable_de_Formacion'))
        <a href="{{ route('admin.operadores.create') }}" class="btn btn-pass">{{__('message.add_new')}} operador</a>
        @endif
            @if(auth()->user()->perfil=='Administrador')
                <a href="{{ route('admin.operadores.export',auth()->user()->entidad) }}" class="btn btn-primary">
                    {{__('message.Exportar Operadores')}}
                </a>
            @endif
    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>



                        <th>{{__('message.Foto')}}</th>

                        <th>{{__('message.Nombre')}}</th>

                        <th>{{__('message.Apellidos')}} </th>

                        <th>{{__('message.Direccion')}} </th>
                        <th>{{__('message.ACTIVE')}} </th>
                        @if(auth()->user()->perfil=='Administrador' || (auth()->user()->perfil=='Responsable_de_Formacion'))
                        <th>{{__('message.Option')}}</th>
                        @endif
                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($operadores as $operadores)

                    <tr>



                        <td>

                            <img src="{{asset('storage/' . $operadores->foto)}}" width="96px"/>

                        </td>

                        <td>{{ $operadores->nombre }}</td>

                        <td>{{ $operadores->apellidos }}</td>

                        <td>{{ $operadores->direccion  }}</td>
                        <td>{{ $operadores->estado == 1 ? "Yes" : "No"  }}</td>

                        <td>
                            @if(count($operadores->asistent) > 0)
{{--                                {{$operadores->asistent}}--}}
                            <a href="{{route('admin.operadores.certificado', [$operadores->id])}}" class="btn btn-edit btn-sm"> <i class="fas fa-certificate"></i> </a>
                            @endif
                            @if(auth()->user()->perfil=='Administrador' || (auth()->user()->perfil=='Responsable_de_Formacion'))
                            <a href="{{route('admin.operadores.edit', [$operadores->id])}}" class="btn btn-edit btn-sm"> <i class="fas fa-edit"></i> </a>

                            <form method="POST" action="{{route('admin.operadores.destroy', [$operadores->id])}}" class="d-inline" onsubmit="return confirm('{{__("message.Delete permanently?")}}')">

                                @csrf

                                <input type="hidden" name="_method" value="DELETE">

                                <button type="submit" value="Delete" class="btn btn-delete btn-sm">
                                <i class='fas fa-trash-alt'></i>
                                </button>

                            </form>
                                    <a href="{{route('admin.operadores.show', [$operadores->id])}}"
                                       class="btn btn-edit btn-sm"> <i class="fas fa-eye"></i> </a>
                            @endif
                        </td>

                    </tr>

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
