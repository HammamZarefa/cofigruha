@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{__('message.about home')}}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <a href="{{ route('admin.link.create') }}" class="btn btn-success">{{__('message.añadir nuevo')}}</a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{__('message.num')}}.</th>

                        <th>{{__('message.Title')}}</th>

                        <th>{{__('message.desc')}}</th>

                        <th>{{__('message.Link')}}</th>

                        <th>{{__('message.Option')}}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($link as $link)

                    <tr>

                        <td>{{ ++$no }}</td>

                        <td>{{ $link->title }}</td>

                        <td>{{substr($link->text, 0, 75)}}...</td>


                        <td>{{ $link->slug}}</td>

                        <td>

                            <a href="{{route('admin.link.edit', [$link->id])}}" class="btn btn-info btn-sm"> <i class="fas fa-edit"></i> </a>

                            <form method="POST" action="{{route('admin.link.destroy', [$link->id])}}" class="d-inline" onsubmit="return confirm('¿estás seguro?')">

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
