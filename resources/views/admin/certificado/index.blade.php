@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{__('message.Certificado')}}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">


{{--        <a href="{{ route('admin.certificado.create') }}" class="btn btn-pass">{{__('message.add_new')}} Certificado</a>--}}
        @if(auth()->user()->perfil=='Administrador')
            <a href="{{ route('admin.certificado.export',$activo) }}" class="btn btn-primary">
                {{__('message.Exportar Certificado')}}
            </a>
        @endif

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{__('message.numero')}}</th>

                        <th>{{__('message.Entidades Formadoras')}}</th>

                        <th>{{__('message.Nombre')}}</th>

                        <th>{{__('message.Apellidos')}}</th>

                        <th>Tipo de curso</th>

                        <th>{{__('message.Fecha De Emisión')}} </th>

                        <th>{{__('message.Fecha De Vencimiento')}} </th>
                        <th>{{__('message.Curso')}} </th>

                        <th>{{__('message.Option')}}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($certificados as $certificado)

                    <tr>
                        <td>{{ $certificado->numero }}</td>
                        <td> {{ $certificado->entidad_nombre }} </td>
                        <td> {{ $certificado->cer_nombre }} </td>
                        <td> {{ $certificado->cer_apellidos }} </td>
                        <td> {{ $certificado->tipos_carnet }} </td>
                        <td> {{date('d/m/Y',strtotime($certificado->emision))  }} </td>
                        <td>{{ date('d/m/Y',strtotime($certificado->vencimiento)) }}</td>
                        <td> {{ @$certificado->cursoo->codigo }} </td>
                        <td>
{{--                        <a href="{{route('admin.certificado.edit', [$certificado->id])}}" class="btn btn-edit btn-sm"> <i class="fas fa-eye"></i> </a>--}}


{{--                            <form method="POST" action="{{route('admin.certificado.destroy', [$certificado->id])}}" class="d-inline" onsubmit="return confirm('{{__("message.Delete permanently?")}}')">--}}

{{--                                @csrf--}}
{{--                                <input type="hidden" name="_method" value="DELETE">--}}

{{--                                <button type="submit" value="Delete" class="btn btn-delete btn-sm">--}}
{{--                                <i class='fas fa-trash-alt'></i>--}}
{{--                                </button>--}}
{{--                            </form>--}}
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
