@extends('layouts.admin')

@section('content')
      <!-- Begin Page Content -->
      <div class="container-fluid">
         <!-- Page Heading -->
         <h1 class="h3 mb-2 text-gray-800">{{__('message.banners')}}</h1>
         @if (session('success'))
         <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
           <a href="{{ route('admin.banner.create') }}" class="btn btn-primary btn-md">{{__('message.add new Banner')}}</a>
          </div>
          <div class="card-body">
              <h4>Las dimensiones de la foto deben ser 1700 * 1134 o lo que se adapte a estas dimensiones & El tamaño de la imagen debe ser inferior a 2 MB.</h4>
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>{{__('message.num')}}.</th>
                    <th>{{__('message.Cover')}}</th>
                    <th>{{__('message.Title')}}</th>
                    <th>{{__('message.Option')}}</th>
                  </tr>
                </thead>
                <tbody>
                    @php
                    $no=0;
                    @endphp
                @foreach ($banner as $banner)
                  <tr>
                    <td>{{ ++$no }}</td>
                    <td>
                        <img src="{{ asset('storage/'.$banner->cover) }}" alt="" height="200px" width="250px">
                    </td>
                    <td>{{ $banner->title }}</td>
                    <td>
                        <a href="{{route('admin.banner.edit', [$banner->id])}}" class="btn btn-info btn-sm"> <i class="fas fa-edit"></i> </a>

                        <form method="POST" action="{{route('admin.banner.destroy', [$banner->id])}}" class="d-inline" onsubmit="return confirm('¿Borrar este banner permanentemente?')">

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

      </div>
      <!-- /.container-fluid -->
@endsection
