@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{__('message.Horario')}}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <a href="{{ route('admin.horario.create') }}" class="btn btn-success">{{__('message.add_new')}} {{__('message.Horario')}}</a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{__('message.Curso')}}</th>

                        <th>{{__('message.Contenido')}}</th>

                        <th>{{__('message.Fecha Inicio')}} </th>

                        <th>{{__('message.Final')}}</th>

                        <th>{{__('message.Alumnos')}}</th>

                        <th>{{__('message.Option')}}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($horario as $horario)

                    <tr>

                        <td>{{ $horario->curso }}</td>

                        <td>{{ $horario->contenido }}</td>

                        <td>{{ $horario->fecha_inicio }}</td>

                        <td>{{ $horario->final }}</td>

                        <td>{{ $horario->alumnos }}</td>

                        <td>

                            <a href="{{route('admin.horario.edit', [$horario->id])}}" class="btn btn-info btn-sm"> <i class="fas fa-edit"></i> </a>

                            <form method="POST" action="{{route('admin.horario.destroy', [$horario->id])}}" class="d-inline" onsubmit="return confirm({{__('message.add_new')}}'Delete permanently?')">

                                @csrf

                                <input type="hidden" name="_method" value="DELETE">

                                <button type="submit" value="Delete" class="btn btn-danger btn-sm">
                                <i class='fas fa-trash-alt'></i>
                                </button>

                            </form>

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
