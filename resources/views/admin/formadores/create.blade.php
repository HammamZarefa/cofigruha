@extends('layouts.admin')

@section('styles')

    <style>
        .picture-container {
            position: relative;
            cursor: pointer;
            text-align: center;
        }
        .picture {
            width: 400px;
            height: 200px;
            background-color: #999999;
            border: 4px solid #CCCCCC;
            color: #FFFFFF;
            /* border-radius: 50%; */
            margin: 5px auto;
            /*overflow: hidden;*/
            transition: all 0.2s;
            -webkit-transition: all 0.2s;
        }
        .picture:hover {
            border-color: #2ca8ff;
        }
        .picture input[type="file"] {
            cursor: pointer;
            display: block;
            height: 100%;
            left: 0;
            opacity: 0 !important;
            position: absolute;
            top: 0;
            width: 100%;
        }
        .picture-src {
            width: 100%;
            height: 100%;
        }
        input[type="radio"] {
            cursor: pointer;
        }
        input[type="radio"]:focus {
            color: #495057;
            background-color: #0477b1;
            border-color: transparent;
            outline: 0;
            box-shadow: none;
        }
    </style>

@endsection

@section('content')

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <form action="{{ route('admin.formadores.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-groups">


            <div class="form-group col-md-4">

                <label for="codigo" class="col-sm-2 col-form-label">{{__('message.Codigo')}}</label>

                <div class="col-sm-9">
                    <input type="text" name='codigo' class="form-control {{$errors->first('codigo') ? "is-invalid" : "" }} " value="{{old('codigo')}}" id="codigo" placeholder="Código del Formador
Name">
                    <div class="invalid-feedback">
                        {{ $errors->first('codigo') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="entidad" class="col-sm-2 col-form-label">{{__('message.Entidad')}} </label>
                <div class="col-sm-9">
                    <select name='entidad' class="form-control {{$errors->first('entidad') ? "is-invalid" : "" }} " id="entidad">
                        <option disabled selected>{{__('message.Choose_One')}}</option>
                        @foreach ($entidad as $entidad)
                            <option value="{{ $entidad->id }}" >{{ $entidad->nombre }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('entidad') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="apellidos" class="col-sm-2 col-form-label">{{__('message.Apellidos')}} </label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="text" placeholder="Apellidos del Formador Name" name="apellidos" id="apellidos"  class="form-control {{$errors->first('apellidos') ? "is-invalid" : "" }} " value="{{old('apellidos')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('apellidos') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="nombre" class="col-sm-2 col-form-label">{{__('message.Nombre')}} </label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="text" name="nombre" placeholder="Nombre del formador" id="nombre"  class="form-control {{$errors->first('nombre') ? "is-invalid" : "" }} " value="{{old('nombre')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="dni" class="col-sm-2 col-form-label">{{__('message.DNI')}} </label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="text" placeholder="Documento identificación" name="dni" id="dni"   class="form-control {{$errors->first('dni') ? "is-invalid" : "" }} " value="{{old('dni')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('dni') }}
                    </div>
                </div>
            </div>
{{--            <div class="form-group col-md-4">--}}
{{--                <label for="dni_img" class="col-sm-2 col-form-label">{{__('message.DNI')}} </label>--}}
{{--                <div class="col-sm-9">--}}
{{--                    --}}{{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

{{--                    <input type="file" name="dni_img" id="dni_img"  class="form-control {{$errors->first('dni_img') ? "is-invalid" : "" }} " value="{{old('dni_img')}}">--}}
{{--                    <div class="invalid-feedback">--}}
{{--                        {{ $errors->first('dni_img') }}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="form-group col-md-4">
                <div class="picture-container" id="picture-container">
                    <div class="picture">
                        <img src="" class="picture-src" id="wizardPicturePreview" height="200px" width="400px" title=""/>
                        <input type="file" id="wizard-picture" name="dni_img" class="form-control {{$errors->first('dni_img') ? "is-invalid" : "" }} ">
                        <div class="invalid-feedback">
                            {{ $errors->first('dni_img') }}
                        </div>
                    </div>
                    <h6>{{__('message.DNI')}}</h6>
                </div>
                <div id="dni_pdf" style="display: none">
                    <label for="dni_img" class="col-sm-2 col-form-label text-center">{{__('message.DNI')}}</label>
                    <label for="dni_img" class="col-sm-1 col-form-label">
                        <a id="dni_img_download" href="#" download><i class="fa fa-download"></i> </a> </label>

                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="operador_pdf" class="col-sm-2 col-form-label">{{__('message.Operador pdf')}} </label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="operador_pdf" id="operador_pdf"  class="form-control {{$errors->first('operador_pdf') ? "is-invalid" : "" }} " value="{{old('operador_pdf')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('operador_pdf') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="cert_empresa_pdf" class="col-sm-2 col-form-label">{{__('message.Cert Empresa PDF')}}</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="cert_empresa_pdf" id="cert_empresa_pdf"   class="form-control {{$errors->first('cert_empresa_pdf') ? "is-invalid" : "" }} " value="{{old('cert_empresa_pdf	')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('cert_empresa_pdf') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="vida_laboral_pdf" class="col-sm-2 col-form-label">{{__('message.Vida Laboral PDF')}}</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="vida_laboral_pdf" id="vida_laboral_pdf"   class="form-control {{$errors->first('vida_laboral_pdf') ? "is-invalid" : "" }} " value="{{old('vida_laboral_pdf')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('vida_laboral_pdf') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="prl_pdf" class="col-sm-2 col-form-label">{{__('message.PRL PDF')}}</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="prl_pdf" id="prl_pdf" cols="40" rows="10"  class="form-control {{$errors->first('prl_pdf') ? "is-invalid" : "" }} " value="{{old('prl_pdf')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('prl_pdf') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="pemp_pdf" class="col-sm-2 col-form-label">{{__('message.PEMP PDF')}}</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="pemp_pdf" id="pemp_pdf" cols="40" rows="10"  class="form-control {{$errors->first('pemp_pdf') ? "is-invalid" : "" }} " value="{{old('pemp_pdf')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('pemp_pdf') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="cap_pdf" class="col-sm-2 col-form-label">{{__('message.CAP PDF')}}</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="cap_pdf" id="cap_pdf"   class="form-control {{$errors->first('cap_pdf') ? "is-invalid" : "" }} " value="{{old('cap_pdf')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('cap_pdf') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="fecha" class="col-sm-2 col-form-label">{{__('message.Fecha')}}	</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="date" name="fecha" id="fecha" cols="40" rows="10"  class="form-control {{$errors->first('fecha') ? "is-invalid" : "" }} " value="{{old('fecha')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha') }}
                    </div>
                </div>
            </div>
            <div class="col-md-2 d-flex flex-column justify-content-center">
                <label for="estado" class="col-sm-12 col-form-label text-center">{{__('message.Estado')}}</label>
                <label class="switch">
                    <input type="checkbox" name="estado">
                    <span class="slider round" ></span>
                </label>
            </div>

            <div class="form-group col-md-12">

                <div class="col-sm-3">

                    <button type="submit" class="btn btn-info">{{__('message.Create')}}</button>

                </div>

            </div>

        </div>
    </form>
@endsection

@push('scripts')
    <script>
        // Prepare the preview for profile picture
        $("#wizard-picture").change(function(){
            readURL(this);
        });
        //Function to show image before upload
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                    $('#dni_img_download').attr('href', e.target.result).fadeIn('slow');
                }
                if (input.files[0].type == 'application/pdf') {
                    $('#picture-container').attr('style','display : none;');

                    $('#dni_pdf').attr('style','display : block;');
                    console.log('Huzzah!')
                }else {
                    console.log('Huzdsfsdfsdfsdfsdfzah!')
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endpush
