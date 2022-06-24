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


    <form action="{{ route('admin.carnet.update',$carnet->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-groups">


            <div class="form-group col-md-4">

                <label for="numero" class="col-sm-2 col-form-label">{{__('message.Numero')}}</label>

                <div class="col-sm-9">
                    <input type="text" name='numero' class="form-control {{$errors->first('numero') ? "is-invalid" : "" }} " value="{{old('numero') ? old('numero') : $carnet->numero}}" id="numero" placeholder="Numero">
                    <div class="invalid-feedback">
                        {{ $errors->first('numero') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="operador" class="col-sm-2 col-form-label">{{__('message.Operador')}} </label>
                <div class="col-sm-9">
                    <select name='operador' class="form-control {{$errors->first('operador') ? "is-invalid" : "" }} " id="operador">
                        <option disabled selected>{{__('message.Choose_One')}}</option>
                        @foreach ($operadores as $operadores)
                            <option value="{{ $operadores->id }}"  {{$carnet->operador == $operadores->id ? "selected" : ""}}>{{ $operadores->nombre }} {{ $operadores->apellidos }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('operador') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="foto" class="col-sm-2 col-form-label">{{__('message.Foto')}} </label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="file" name="foto" id="foto"   class="form-control {{$errors->first('foto') ? "is-invalid" : "" }} " value="{{old('foto') ? old('foto') : $carnet->foto}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('foto') }}
                    </div>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label for="fecha_de_alta" class="col-sm-4 col-form-label">	{{__('message.Fecha De Emisión')}}</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="date" name="fecha_de_alta" id="fecha_de_alta"   class="form-control {{$errors->first('fecha_de_alta') ? "is-invalid" : "" }} " value="{{old('fecha_de_alta') ? old('fecha_de_alta') : $carnet->fecha_de_alta}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_de_alta') }}
                    </div>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label for="fecha_de_emision" class="col-sm-5 col-form-label">{{__('message.Fecha De Vencimiento')}}</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="date" name="fecha_de_emision" id="fecha_de_emision"  class="form-control {{$errors->first('fecha_de_emision') ? "is-invalid" : "" }} " value="{{old('fecha_de_emision') ? old('fecha_de_emision') : $carnet->fecha_de_emision}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha_de_emision') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">

                <label for="tipos_de_pemp" class="col-sm-4 col-form-label">{{__('message.Tipos De Pemp')}}</label>

                <div class="col-sm-9">

                    <select name='tipos_de_pemp[]' class="form-control {{$errors->first('tipos_de_pemp') ? "is-invalid" : "" }} select2" id="tipos_de_pemp" multiple>
                        @foreach ($carnet->Tipo_Maquinas as $tipo)
                            <option selected value="{{ $tipo->id }}">{{ $tipo->tipo_maquina }}</option>
                        @endforeach

                        @foreach ($tipos as $tipos)
                            <option value="{{ $tipos->id }}">{{ $tipos->tipo_maquina }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('tipos_de_pemp') }}
                    </div>

                </div>

            </div>
            <div class="form-group col-md-4">
                <label for="curso" class="col-sm-2 col-form-label">{{__('message.Curso')}} </label>
                <div class="col-sm-9">
                    <select name='curso' class="form-control {{$errors->first('curso') ? "is-invalid" : "" }} " id="curso">
                        <option disabled selected>{{__('message.Choose_One')}}</option>
                        @foreach ($cursos as $cursos)
                            <option value="{{ $cursos->id }}" {{$carnet->curso == $cursos->id ? "selected" : ""}}>{{ $cursos->codigo }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('curso') }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="examen_teorico_realizado" class="col-sm-12 col-form-label">{{__('message.Examen Teorico Realizado')}}</label>
                <div class="col-sm-9">
                    <select name='examen_teorico_realizado' class="form-control {{$errors->first('examen_teorico_realizado') ? "is-invalid" : "" }} " id="examen_teorico_realizado">
                        <option disabled selected>{{__('message.Choose_One')}}</option>

                        <option value="básico" {{$carnet->examen_teorico_realizado == "básico" ? "selected" : ""}}>{{__('message.Básico')}}</option>
                        <option value="Extendido" {{$carnet->examen_teorico_realizado == "Extendido" ? "selected" : ""}}>{{__('message.Extendido')}}</option>

                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('examen_teorico_realizado') }}
                    </div>
                </div>
            </div>
            <div class="col-md-2 d-flex flex-column justify-content-center">
                <label for="estado" class="col-sm-12 col-form-label text-center">{{__('message.Estado')}}</label>
                <label class="switch">
                    <input type="checkbox" name="estado" {{$carnet->estado == 1 ? "checked" : ""}}>
                    <span class="slider round" ></span>
                </label>
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

@endpush
