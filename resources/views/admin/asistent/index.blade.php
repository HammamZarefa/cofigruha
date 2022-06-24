@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{__('message.asistent')}}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <a href="{{ route('admin.asistent.create') }}" class="btn btn-success">{{__('message.Create')}}</a>

    </div>

    <div class="card-body col-md-12">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{__('message.Nombre')}}</th>

                        <th>{{__('message.Apellido')}}.</th>

                        <th>{{__('message.Número de asistente')}}</th>

                        <th>{{__('message.Nota Examen teorico')}}	</th>

                        <th>{{__('message.Nota Examen Practico')}}	</th>

                        <th>{{__('message.Option')}}</th>

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
                                {{$ope->id == $asistent->operador ? $ope->nombre : "" }}
                            @endforeach
                        </td>

                        <td>
                            @foreach($operador as $ope)
                            {{$ope->id == $asistent->operador ? $ope->apellidos : "" }}
                            @endforeach
                        </td>

                        <td>

                            {{ $asistent->orden }}

                        </td>

                        <td>{{ $asistent->nota_t }}</td>

                        <td>{{ $asistent->nota_p }}</td>

                        <td>

                            <a href="{{route('admin.asistent.edit', [$asistent->id])}}" class="btn btn-info btn-sm"> <i class="fas fa-edit"></i> </a>

                            <form method="POST" action="{{route('admin.asistent.destroy', [$asistent->id])}}" class="d-inline" onsubmit="return confirm('{{__("message.Delete this asistent permanently?")}}')">

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
