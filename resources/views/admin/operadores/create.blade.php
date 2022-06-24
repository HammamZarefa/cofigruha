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

<form action="{{ route('admin.operadores.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-groups">


    <div class="form-group col-md-4">

        <label for="dni" class="col-sm-12 col-form-label">{{__('message.Dni')}}</label>

        <div class="col-sm-7">
            <input type="text" name='dni' class="form-control {{$errors->first('dni') ? "is-invalid" : "" }} " value="{{old('dni')}}" id="dni" placeholder="Documento identificativo">
            <div class="invalid-feedback">
                {{ $errors->first('dni') }}
            </div>
        </div>
    </div>

    <div class="form-group col-md-4">
        <label for="apellidos" class="col-sm-12 col-form-label">{{__('message.Apellidos')}}</label>
        <div class="col-sm-7">
            <input type="text" name='apellidos' class="form-control {{$errors->first('apellidos') ? "is-invalid" : "" }} " value="{{old('apellidos')}}" id="apellidos" placeholder="Apellidos">
            <div class="invalid-feedback">
                {{ $errors->first('apellidos') }}
            </div>
        </div>
    </div>


    <div class="form-group col-md-4">
        <label for="nombre" class="col-sm-12 col-form-label">{{__('message.Nombre')}}</label>
        <div class="col-sm-7">
            <input type="text" name='nombre' class="form-control {{$errors->first('nombre') ? "is-invalid" : "" }} " value="{{old('nombre')}}" id="twitter" placeholder="Nombre ">
            <div class="invalid-feedback">
                {{ $errors->first('nombre') }}
            </div>
        </div>
    </div>

        <div class="form-group col-md-4">
            <label for="entidad" class="col-sm-12 col-form-label">{{__('message.Entidad')}}</label>
            <div class="col-sm-9">
                @if(auth()->user()->perfil=='Administrador')
                    <select name='entidad' class="form-control {{$errors->first('entidad') ? "is-invalid" : "" }} " id="entidad">
                        <option disabled selected>{{__('message.Choose_One')}}</option>
                        @foreach ($entidad as $entidad)
                            <option value="{{ $entidad->id }}" {{old('entidad') == $entidad->id ? "selected" : ""}}>{{ $entidad->nombre }}</option>
                        @endforeach
                    </select>
                @else
                    <input type="text" readonly class="form-control" value="{{$entidad->nombre}}" placeholder="">
                    <input type="hidden" name="entidad" class="form-control" value="{{$entidad->id}}">
                @endif

                <div class="invalid-feedback">
                    {{ $errors->first('entidad') }}
                </div>
            </div>
        </div>

        <div class="form-group col-md-4">
            <div class="picture-container">
                <div class="picture" style="width: 200px">
                    <img src="" class="picture-src" id="wizardPicturePreview" height="200px" width="400px" title=""/>
                    <input type="file" id="wizard-picture" name="foto" class="form-control {{$errors->first('foto') ? "is-invalid" : "" }} ">
                    <div class="invalid-feedback">
                        {{ $errors->first('foto') }}
                    </div>
                </div>
                <h6>{{__('message.Foto')}}</h6>
            </div>
        </div>
{{--    <div class="form-group col-md-4">--}}
{{--        <label for="foto" class="col-sm-12 col-form-label">{{__('message.Foto')}}</label>--}}
{{--        <div class="col-sm-7">--}}
{{--            <input type="file" name='foto' class="form-control {{$errors->first('foto') ? "is-invalid" : "" }} " value="{{old('foto')}}" id="foto" placeholder="foto">--}}
{{--            <div class="invalid-feedback">--}}
{{--                {{ $errors->first('foto') }}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

        <div class="form-group col-md-4">
            <div class="picture-container">
                <div class="picture">
                    <img src="" class="picture-src" id="wizardPicturePreview1" height="200px" width="400px" title=""/>
                    <input type="file" id="wizard-picture1" name="dni_img" class="form-control {{$errors->first('dni_img') ? "is-invalid" : "" }} ">
                    <div class="invalid-feedback">
                        {{ $errors->first('dni_img') }}
                    </div>
                </div>
                <h6>{{__('message.Dni Img')}}</h6>
            </div>
        </div>


    <div class="form-group col-md-4">
        <label for="fecha_nacimiento" class="col-sm-12 col-form-label">{{__('message.Fecha Nacimiento')}}</label>
        <div class="col-sm-7">
            <input type="date" name='fecha_nacimiento' class="form-control {{$errors->first('fecha_nacimiento') ? "is-invalid" : "" }} " value="{{old('fecha_nacimiento')}}" id="fecha_nacimiento" placeholder="fecha nacimiento">
            <div class="invalid-feedback">
                {{ $errors->first('fecha_nacimiento') }}
            </div>
        </div>
    </div>
        <div class="form-group col-md-4">
            <label for="provincia" class="col-sm-12 col-form-label">{{__('message.Provincia')}}</label>
            <div class="col-sm-7">
                <input type="text" name='provincia' class="form-control {{$errors->first('provincia') ? "is-invalid" : "" }} " value="{{old('provincia')}}" id="provincia" placeholder="Provincia">
                <div class="invalid-feedback">
                    {{ $errors->first('provincia') }}
                </div>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="ciudad" class="col-sm-12 col-form-label">{{__('message.Ciudad')}}</label>
            <div class="col-sm-7">
                <input type="text" name='ciudad' class="form-control {{$errors->first('ciudad') ? "is-invalid" : "" }} " value="{{old('ciudad')}}" id="ciudad" placeholder="Ciudad">
                <div class="invalid-feedback">
                    {{ $errors->first('ciudad') }}
                </div>
            </div>
        </div>

        <div class="form-group col-md-4">
            <label for="direccion" class="col-sm-12 col-form-label">{{__('message.Direccion')}}</label>
            <div class="col-sm-7">
                <input type="text" name='direccion' class="form-control {{$errors->first('direccion') ? "is-invalid" : "" }} " value="{{old('direccion')}}" id="direccion" placeholder="Dirección del formador">
                <div class="invalid-feedback">
                    {{ $errors->first('direccion') }}
                </div>
            </div>
        </div>

        <div class="form-group col-md-4">
            <label for="codigo_postal" class="col-sm-12 col-form-label">{{__('message.Codigo Postal')}}</label>
            <div class="col-sm-7">
                <input type="number" name='codigo_postal' class="form-control {{$errors->first('codigo_postal') ? "is-invalid" : "" }} " value="{{old('codigo_postal')}}" id="codigo_postal" placeholder="Código postal">
                <div class="invalid-feedback">
                    {{ $errors->first('codigo_postal') }}
                </div>
            </div>
        </div>


        <div class="form-group col-md-4">
            <label for="mail" class="col-sm-12 col-form-label">{{__('message.Mail')}}</label>
            <div class="col-sm-7">
                <input type="text" name='mail' class="form-control {{$errors->first('mail') ? "is-invalid" : "" }} " value="{{old('mail')}}" id="mail" placeholder="Cuenta de correo">
                <div class="invalid-feedback">
                    {{ $errors->first('mail') }}
                </div>
            </div>
        </div>
        @if(auth()->user()->perfil=='Administrador')
        <div class="form-group col-md-4">
            <label for="carnet" class="col-sm-12 col-form-label">{{__('message.Número de Carnet')}}</label>
            <div class="col-sm-7">
                <input type="text" name='carnet' class="form-control {{$errors->first('carnet') ? "is-invalid" : "" }} " value="{{old('carnet')}}" id="carnet" placeholder="Número de carné">
                <div class="invalid-feedback">
                    {{ $errors->first('carnet') }}
                </div>
            </div>
        </div>
        @else
            <input type="hidden" name="carnet" value="">
        @endif
       <div class="form-group col-md-4">
            <label for="fecha" class="col-sm-12 col-form-label">{{__('message.Fecha')}}</label>
            <div class="col-sm-7">
                <input type="date" readonly name='fecha' class="form-control {{$errors->first('fecha') ? "is-invalid" : "" }} " value="{{$now}}" id="fecha" placeholder="Fecha de alta">
                <div class="invalid-feedback">
                    {{ $errors->first('fecha') }}
                </div>
            </div>
        </div>
        @if(auth()->user()->perfil=='Administrador')
        <div class="col-md-2 d-flex flex-column justify-content-center">
            <label for="estado" class="col-sm-12 col-form-label text-center">{{__('message.Estado')}}</label>
            <label class="switch">
                <input type="checkbox" name="estado">
                <span class="slider round" ></span>
            </label>
        </div>
        @endif
        </div>
        </div>
      <div class="form-group col-md-4">
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
    // Prepare the preview for profile picture
    $("#wizard-picture1").change(function(){
        readURL1(this);
    });
    //Function to show image before upload
    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#wizardPicturePreview1').attr('src', e.target.result).fadeIn('slow');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endpush
