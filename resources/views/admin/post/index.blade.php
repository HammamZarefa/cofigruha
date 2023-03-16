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

                        <th>{{__('message.Publico')}}</th>

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

                        <td>{{ $post->keyword }}</td>

                        <td>{{ $post->status }}</td>

                        <td>{{ $post->public == 1 ? __('message.Publico') : __('message.Privado') }}</td>

                        <td>

                            <a href="{{route('admin.post.edit', [$post->id])}}" class="btn btn-info btn-sm"> <i class="fas fa-edit"></i> </a>

                            <form method="POST" class="d-inline" onsubmit="return confirm('¿Mover el post a la basura?')" action="{{route('admin.post.destroy', $post->id)}}">
                                @csrf

                                <input type="hidden" value="DELETE" name="_method">

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
