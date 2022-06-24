@extends('layouts.admin')

@section('styles')

    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        .modal1 {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9); /* Black w/ opacity */
        }

        /* modal1 Content (image) */
        .modal1-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* caption1 of modal1 Image */
        #caption1 {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal1-content, #caption1 {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0)
            }
            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }
            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal1-content {
                width: 100%;
            }
        }
    </style>

@endsection

@section('content')

    <!-- Page Heading -->

    <h1 class="h3 mb-2 text-gray-800">{{__('message.Formadores')}}</h1>

    @if (session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif

    <!-- DataTales Example -->

    <div class="card shadow mb-4">

        <div class="card-header py-3">
            @if(auth()->user()->perfil=='Administrador')
                <a href="{{ route('admin.formadores.create') }}" class="btn btn-pass">{{__('message.add_new_formador')}}
                    </a>
                    <a href="{{ route('admin.formadores.export',auth()->user()->entidad) }}" class="btn btn-primary">
                        {{__('message.Exportar Formadores')}}
                    </a>

            @endif


        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                    <thead>

                    <tr>

                        <th>{{__('message.Codigo')}}</th>

                        <th>{{__('message.Nombre')}} </th>

                        <th>{{__('message.Apellidos')}} </th>

                        <th>{{__('message.DNI')}}</th>

                        <th>{{__('message.Operador pdf')}}</th>

                        <th>{{__('message.Cert Empresa')}}</th>

                        <th>{{__('message.Vida Laboral')}}</th>

                        <th>{{__('message.PRL')}}</th>

                        <th>{{__('message.PEMP')}}</th>

                        <th>{{__('message.CAP')}}</th>

                        <th>{{__('message.Option')}}</th>

                    </tr>

                    </thead>

                    <tbody>

                    @php

                        $no=0;

                    @endphp

                    @foreach ($formadores as $formadores)
                        @if(auth()->user()->perfil=='Administrador' || (auth()->user()->perfil=='Responsable_de_Formacion' && auth()->user()->entidad==$formadores->entidad)
                            || (auth()->user()->perfil=='Formador' && auth()->user()->entidad==$formadores->entidad))
                            <tr>
                                <td>{{ $formadores->codigo }}</td>
                                <td> {{ $formadores->nombre }} </td>
                                <td>{{ $formadores->apellidos }}</td>
                                <td>
                                    @if($formadores->dni_img && file_exists(storage_path('app/public/' . $formadores->dni_img)) && substr($formadores->dni_img, -3) == 'pdf')
                                        <a target="_blank" href="{{asset('storage/' . $formadores->dni_img)}}"><i
                                                class="fa fa-eye"></i> </a>
                                    @elseif(substr($formadores->dni_img, -3) != 'pdf')
                                    <img src="{{asset('storage/' . $formadores->dni_img)}}" width="96px" id="myImg{{$formadores->dni_img}}" onclick="show( this);"/>
                                    <!-- The modal1 -->
                                    <div id="mymodal11" class="modal1">
                                        <span class="close">&times;</span>
                                        <img class="modal1-content" id="img011">
                                        <div id="caption1"></div>
                                    </div>
                                    @else
                                        <i class="fa fa-close"></i>
                                    @endif
                                </td>

                                <td style="text-align: center">
                                    @if($formadores->operador_pdf && file_exists(storage_path('app/public/' . $formadores->operador_pdf)))
                                    <a target="_blank" href="{{asset('storage/' . $formadores->operador_pdf)}}"><i
                                            class="fa fa-eye"></i> </a>
                                    @else
                                        <i class="fa fa-close"></i>
                                    @endif
                                </td>

                                <td style="text-align: center">
                                    @if($formadores->cert_empresa_pdf && file_exists(storage_path('app/public/' . $formadores->cert_empresa_pdf)))
                                        <a target="_blank" href="{{asset('storage/' . $formadores->cert_empresa_pdf)}}"><i
                                                class="fa fa-eye"></i> </a>
                                    @else
                                        <i class="fa fa-close"></i>
                                    @endif
                                </td>

                                <td style="text-align: center">
                                    @if($formadores->vida_laboral_pdf && file_exists(storage_path('app/public/' . $formadores->vida_laboral_pdf)))
                                        <a target="_blank" href="{{asset('storage/' . $formadores->vida_laboral_pdf)}}"><i
                                                class="fa fa-eye"></i> </a>
                                    @else
                                        <i class="fa fa-close"></i>
                                    @endif
                                </td>

                                <td style="text-align: center">
                                    @if($formadores->prl_pdf && file_exists(storage_path('app/public/' . $formadores->prl_pdf)))
                                        <a target="_blank" href="{{asset('storage/' . $formadores->prl_pdf)}}"><i
                                                class="fa fa-eye"></i> </a>
                                    @else
                                        <i class="fa fa-close"></i>
                                    @endif
                                </td>

                                <td style="text-align: center">
                                    @if($formadores->pemp_pdf && file_exists(storage_path('app/public/' . $formadores->pemp_pdf)))
                                        <a target="_blank" href="{{asset('storage/' . $formadores->pemp_pdf)}}"><i
                                                class="fa fa-eye"></i> </a>
                                    @else
                                        <i class="fa fa-close"></i>
                                    @endif
                                </td>

                                <td style="text-align: center">
                                    @if($formadores->cap_pdf && file_exists(storage_path('app/public/' . $formadores->cap_pdf)))
                                        <a target="_blank" href="{{asset('storage/' . $formadores->cap_pdf)}}"><i
                                                class="fa fa-eye"></i> </a>
                                    @else
                                        <i class="fa fa-close"></i>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('admin.formadores.edit', [$formadores->id])}}"
                                       class="btn btn-edit btn-sm"> <i class="fas fa-edit"></i> </a>

                                    @if(auth()->user()->perfil=='Administrador')
                                        <form method="POST"
                                              action="{{route('admin.formadores.destroy', [$formadores->id])}}"
                                              class="d-inline"
                                              onsubmit="return confirm('{{__("message.Delete permanently?")}}')">

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

@endsection

@push('scripts')
    <script>
        function show(elem) {
// Get the modal1
//             console.log(id);
            var modal11 = document.getElementById("mymodal11");

            // Get the image and insert it inside the modal1 - use its "alt" text as a caption1
            var modal1Img1 = document.getElementById("img011");
            var caption1Text = document.getElementById("caption1");

                modal11.style.display = "block";
                modal1Img1.src = $(elem).attr('src');
                // caption1Text.innerHTML = this.alt;


            // Get the <span> element that closes the modal1
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal1
            span.onclick = function() {
                modal11.style.display = "none";
            }
        }

    </script>

    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('admin/js/demo/datatables-demo.js') }}"></script>

@endpush
