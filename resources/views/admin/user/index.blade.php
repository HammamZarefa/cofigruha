@extends('layouts.admin')

@section('styles')

<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')

<!-- Page Heading -->

<h1 class="h3 mb-2 text-gray-800">{{__('message.users')}}</h1>

@if (session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!-- DataTales Example -->

<div class="card shadow mb-4">
@can('isAdmin')
    <div class="card-header py-3">
        <a href="{{ route('admin.users.create') }}" class="btn btn-pass">{{__('message.add_new')}}</a>
    </div>
@endcan
    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>{{__('message.No.')}}</th>

                        <th>{{__('message.Nombre')}}</th>

                        <th>{{__('message.Email')}}</th>

                        <th>{{__('message.Perfil')}}</th>

                        <th>{{__('message.Option')}}</th>

                    </tr>

                </thead>

                <tbody>

                @php

                $no=0;

                @endphp

                @foreach ($user as $user)
                @if(auth()->user()->perfil=='Administrador' || (auth()->user()->perfil=='Responsable_de_Formacion' && auth()->user()->entidad==$user->entidad)
                || (auth()->user()->perfil=='Formador' && auth()->user()->entidad==$user->entidad&& $user->perfil='Formador'))
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $user->nombre }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->perfil }}</td>
                        <td>
                            @if(auth()->user()->id==$user->id || (auth()->user()->perfil=='Responsable_de_Formacion' && auth()->user()->entidad==$user->entidad && $user->perfil='Formador' && auth()->user()->id==$user->id))

                            <a href="#" data-toggle="modal" data-target="#changepasswordModal" class="btn btn-pass btn-sm">{{__('message.Change Password')}}</a>
                            @endif
                                @if(auth()->user()->perfil=='Administrador')
                            <a href="{{route('admin.users.edit', [$user->id])}}" class="btn btn-edit btn-sm"> <i class="fas fa-edit"></i> </a>

                            <form method="POST" action="{{route('admin.users.destroy', [$user->id])}}" class="d-inline" onsubmit="return confirm('{{__("message.Delete this user permanently?")}}')">

                                @csrf

                                <input type="hidden" name="_method" value="DELETE">

                                <button type="submit" value="Delete" class="btn btn-delete btn-sm">
                                <i class='fas fa-trash-alt'></i>
                                </button>

                            </form>
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

<!-- Change password Modal-->
<div class="modal fade" id="changepasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{__('message.Change Password')}}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="{{ route('admin.users.changepassword',$user->id) }}" method="POST">
            @csrf
        <div class="modal-body">

            <input type="password" name='password' class="form-control {{$errors->first('password') ? "is-invalid" : "" }} " id="password" placeholder="{{__('message.New Password')}}">

        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">{{__('message.Cancel')}}</button>

          <button type="submit" class="btn btn-primary">{{__('message.Update')}}</button>

        </div>
    </form>
      </div>
    </div>
  </div>

@endsection

@push('scripts')

<script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>

@endpush
