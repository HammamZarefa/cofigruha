@extends('layouts.admin')

@section('styles')

    <style>
        .picture-container {
            position: relative;
            cursor: pointer;
            text-align: center;
        }
        .picture {
            width: 300px;
            height: 400px;
            background-color: #999999;
            border: 4px solid #CCCCCC;
            color: #FFFFFF;
            /* border-radius: 50%; */
            margin: 5px auto;
            overflow: hidden;
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
        #url{
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


    <form action="{{ route('admin.examen.update',$examen->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-groups">


            <div class="form-group col-md-4">

                <label for="codigo" class="col-sm-2 col-form-label">{{__('message.Codigo')}}</label>

                <div class="col-sm-9">
                    <input type="text" name='codigo' class="form-control {{$errors->first('codigo') ? "is-invalid" : "" }} " value="{{old('codigo') ? old('codigo') : $examen->codigo}}" id="codigo" placeholder="Código del Examen">
                    <div class="invalid-feedback">
                        {{ $errors->first('codigo') }}
                    </div>
                </div>
            </div>



            <div class="form-group col-md-4">
                <label for="nombre" class="col-sm-2 col-form-label">{{__('message.Nombre')}} </label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="text" name="nombre" placeholder="Nombre del Examen" id="nombre"  class="form-control {{$errors->first('nombre') ? "is-invalid" : "" }} " value="{{old('nombre') ? old('nombre') : $examen->nombre}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="tipo" class="col-sm-12 col-form-label">{{__('message.Tipo')}}</label>
                <div class="col-sm-9">
                    <select name='tipo' class="form-control {{$errors->first('tipo') ? "is-invalid" : "" }} " id="tipo">
                        <option disabled selected>{{__('message.Choose_One')}}</option>

                        <option value="T-Theoretical" {{$examen->tipo == "T-Theoretical" ? "selected" : ""}}>{{__('message.Examen Teórico')}}</option>
                        <option value="P-Practical" {{$examen->tipo == "P-Practical" ? "selected" : ""}}>{{__('message.Exámen Práctico')}}</option>

                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('tipo') }}
                    </div>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label for="url" class="col-sm-4 col-form-label">{{__('message.URL')}}</label>
                <span class="maxsize"> El tamaño máximo de archivo subido no debe superar 2 MB</span>
                @if($examen->url && file_exists(storage_path('app/public/' . $examen->url)))
                    <label for="url" class="col-sm-1 col-form-label">
                        <a id="url_download" href="{{asset('storage/' . $examen->url)}}" download><i class="fa fa-download"></i> </a> </label>
                    <a id="url_privew" target="_blank" href="{{asset('storage/' . $examen->url)}}"  ><i class="fa fa-eye"></i> </a>
                    <div class="col-sm-12">
                        <i class="fas fa-edit" style="font-size: 20px"></i>
                        <input type="file" name='url' class="form-control {{$errors->first('url') ? "is-invalid" : "" }} " value="{{old('url') ? old('url') : $examen->url}}" style="opacity: 0 !important" id="url" placeholder="Link Linkedin">
                        <div class="invalid-feedback">
                            {{ $errors->first('url') }}
                        </div>
                    </div>
                @else
                    <div class="col-sm-12">
                        <input type="file" name='url' class="form-control {{$errors->first('url') ? "is-invalid" : "" }} " value="{{old('url') ? old('url') : $examen->url}}" id="urlf" placeholder="Link Linkedin">
                        <div class="invalid-feedback">
                            {{ $errors->first('url') }}
                        </div>
                    </div>
                @endif
            </div>

            <div class="form-group col-md-12">

                <div class="col-sm-3">

                    <button type="submit" class="btn btn-info">{{__('message.edit')}}</button>

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
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        // Prepare the preview for profile picture
        $("#url").change(function(){
            readURL6(this);
        });
        //Function to show image before upload

        function readURL6(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#url_download').attr('href', e.target.result).fadeIn('slow');
                    document.getElementById('url_privew').style.display = "none";
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endpush
