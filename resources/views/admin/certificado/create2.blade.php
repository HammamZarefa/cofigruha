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


    <form action="{{ route('admin.certificado.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-groups">


            <div class="form-group col-md-4">

                <label for="numero" class="col-sm-2 col-form-label">{{__('message.Numero')}}</label>

                <div class="col-sm-9">
                    <input type="text" name='numero' class="form-control {{$errors->first('numero') ? "is-invalid" : "" }} " value="{{old('numero')}}" id="numero" placeholder="Numero">
                    <div class="invalid-feedback">
                        {{ $errors->first('numero') }}
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
                <label for="operador" class="col-sm-2 col-form-label">{{__('message.Operador')}} </label>
                <div class="col-sm-9">
                    <select name='operador' class="form-control {{$errors->first('operador') ? "is-invalid" : "" }} " id="operador">
                        <option disabled selected>{{__('message.Choose_One')}}</option>
                        @foreach ($operadores as $operadores)
                            <option value="{{ $operadores->id }}" {{old('operador') == $operadores->id  ? "selected" : ""}}>{{ $operadores->nombre }} {{ $operadores->apellidos }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('operador') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="curso" class="col-sm-2 col-form-label">{{__('message.Curso')}} </label>
                <div class="col-sm-9">
                    <select name='curso' class="form-control {{$errors->first('curso') ? "is-invalid" : "" }} " id="curso">
                        <option disabled selected>{{__('message.Choose_One')}}</option>
                        @foreach ($cursos as $cursos)
                            <option value="{{ $cursos->id }}" {{old('curso') == $cursos->id  ? "selected" : ""}}>{{ $cursos->codigo }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('curso') }}
                    </div>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label for="emision" class="col-sm-4 col-form-label">	{{__('message.Fecha De Emisión')}}</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="date" name="emision" id="emision"   class="form-control {{$errors->first('emision') ? "is-invalid" : "" }} " value="{{old('emision')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('emision') }}
                    </div>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label for="vencimiento" class="col-sm-5 col-form-label">{{__('message.Fecha De Vencimiento')}}</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="date" name="vencimiento" id="vencimiento"  class="form-control {{$errors->first('vencimiento') ? "is-invalid" : "" }} " value="{{old('vencimiento')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('vencimiento') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">

                <label for="tipos_de_pemp" class="col-sm-4 col-form-label">{{__('message.Tipos De Pemp')}}</label>

                <div class="col-sm-9">

                    <select name='tipos_de_pemp[]'  class="form-control {{$errors->first('tipos_de_pemp') ? "is-invalid" : "" }} select2" id="tipos_de_pemp" multiple>
                        @foreach ($tipos as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->tipo_maquina }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('tipos_de_pemp') }}
                    </div>

                </div>

            </div>

            <div class="form-group col-md-4">

                <label for="observaciones" class="col-sm-2 col-form-label">{{__('message.Observaciones')}}</label>
                <div class="col-sm-9">
                    <input type="text" name='observaciones' class="form-control {{$errors->first('observaciones') ? "is-invalid" : "" }} " value="{{old('observaciones')}}" id="observaciones" placeholder="Comentarios ">
                    <div class="invalid-feedback">
                        {{ $errors->first('observaciones') }}
                    </div>
                </div>

            </div>


            <div class="form-group col-md-4">
                <label for="cer_fecha" class="col-sm-5 col-form-label">{{__('message.Fecha de Exportación')}}</label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="date" name="cer_fecha" id="cer_fecha"  class="form-control {{$errors->first('cer_fecha') ? "is-invalid" : "" }} " value="{{old('cer_fecha')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('cer_fecha') }}
                    </div>
                </div>
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
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: "Tipos De Pemp"
            });
        });


    </script>

@endpush
