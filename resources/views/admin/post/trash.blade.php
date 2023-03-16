@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{__('message.Blog')}}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">

    <div class="card-header py-3">

        <a href="{{ route('admin.post.create') }}" class="btn btn-success">{{__('message.Create Post')}}</a>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>

                    <tr>

                        <th>{{__('message.num')}}.</th>

                        <th>{{__('message.Title')}}</th>

                        <th>{{__('message.Palabra clave')}}</th>

                        <th>{{__('message.Status')}}</th>

                        <th>{{__('message.Option')}}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($post as $post)

                    <tr>

                        <td>{{ ++$no }}</td>

                        <td>{{ $post->title }}</td>

                        <td>{{ $post->category->name }}</td>

                        <td>{{ $post->status }}</td>

                        <td>

                            <form method="POST" action="{{route('admin.post.restore', $post->id)}}" class="d-inline">
                                @csrf
                                <input type="submit" value="Restaurar" class="btn btn-success btn-sm">
                            </form>

                            <form method="POST" action="{{route('admin.post.deletePermanent', $post->id)}}" class="d-inline" onsubmit="return confirm('¿Borrar este post permanentemente?')">

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
