@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{__('message.Categories')}}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <a href="{{ route('admin.category.create') }}" class="btn btn-success">{{__('message.Create category')}}</a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{__('message.num')}}.</th>

                        <th>{{__('message.Name')}}</th>

                        <th>{{__('message.Slug')}}</th>

                        <th>{{__('message.Palabra clave')}}</th>

                        <th>{{__('message.Meta Desc')}}</th>

                        <th>{{__('message.Option')}}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($category as $category)

                    <tr>

                        <td>{{ ++$no }}</td>

                        <td>{{ $category->name }}</td>

                        <td>{{ $category->slug }}</td>

                        <td>{{ $category->keyword }}</td>

                        <td>{{ $category->meta_desc }}</td>

                        <td>

                            <a href="{{route('admin.category.edit', [$category->id])}}" class="btn btn-info btn-sm"> <i class="fas fa-edit"></i> </a>

                            <form method="POST" action="{{route('admin.category.destroy', [$category->id])}}" class="d-inline" onsubmit="return confirm('¿Borrar esta categoría permanentemente?')">

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
