@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{__('message.Examen')}}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        @if(auth()->user()->perfil=='Administrador')
            <a href="{{ route('admin.examen.create') }}" class="btn btn-pass">{{__('message.add_new')}} examen</a>
        @endif

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{__('message.Codigo')}}</th>

                        <th>{{__('message.Nombre')}} </th>

                        <th>{{__('message.tipo')}} </th>

                        <th>{{__('message.url')}}</th>

                        <th>{{__('message.Option')}}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($examen as $examen)
{{--                    @if(auth()->user()->perfil=='Administrador' || (auth()->user()->perfil=='Responsable_de_Formacion' && auth()->user()->entidad==$formadores->entidad)--}}
{{--                        || (auth()->user()->perfil=='Formador' && auth()->user()->entidad==$formadores->entidad))--}}
                    <tr>
                        <td>{{ $examen->codigo }}</td>
                        <td> {{ $examen->nombre }} </td>
                        <td>{{ $examen->tipo }}</td>
                        <td>
                            @if($examen->url && file_exists(storage_path('app/public/' . $examen->url)))
                            <a href="{{asset('storage/' . $examen->url)}}" class="button" download><i class="fa fa-download"></i>Descargar</a>
                            @else
                                <i class="fa fa-close"></i>
                            @endif

                        </td>
                        <td>
                            @if(auth()->user()->perfil=='Administrador')
                                <a href="{{route('admin.examen.edit', [$examen->id])}}" class="btn btn-edit btn-sm"> <i class="fas fa-edit"></i> </a>


                                <form method="POST" action="{{route('admin.examen.destroy', [$examen->id])}}" class="d-inline" onsubmit="return confirm('{{__("message.Delete permanently?")}}')">

                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">

                                    <button type="submit" value="Delete" class="btn btn-delete btn-sm">
                                    <i class='fas fa-trash-alt'></i>
                                    </button>
                                </form>
                            @endif
</td>
</tr>
{{--                        @endif--}}
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
