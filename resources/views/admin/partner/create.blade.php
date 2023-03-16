@extends('layouts.admin')

@section('styles')
<style>
   .picture-container {
  position: relative;
  cursor: pointer;
  text-align: center;
}
 .picture {
  width: 800px;
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

</style>
@endsection
@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.partner.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="container">
        <div class="form-group">
            <div class="picture-container">
                <span class="maxsize"> El tamaño máximo de archivo subido no debe superar 2 MB</span>
                <div class="picture">
                    <img src="" class="picture-src" id="wizardPicturePreview" height="200px" width="400px" title=""/>
                    <input type="file" id="wizard-picture" name="logo" class="form-control {{$errors->first('logo') ? "is-invalid" : "" }} ">
                    <div class="invalid-feedback" style="position: absolute;right: 0;bottom: -20px;">
                        {{ $errors->first('logo') }}
                    </div>
                </div>
{{--                <div class="invalid-feedback">--}}
{{--                    {{ $errors->first('logo') }}--}}
{{--                </div>--}}
                <h6>{{__('message.Logo')}}</h6>
            </div>
        </div>
        <div class="form-group ml-5">
            <label for="nombre" class="col-sm-2 col-form-label">{{__('message.Name')}}</label>
            <div class="col-sm-9">
                <input type="text" name='nombre' class="form-control {{$errors->first('nombre') ? "is-invalid" : "" }} " value="{{old('nombre')}}" id="nombre" placeholder="ex: Wiklop">
                <div class="invalid-feedback">
                    {{ $errors->first('nombre') }}
                </div>
            </div>
        </div>
        <div class="form-group ml-5">
            <label for="enlace" class="col-sm-2 col-form-label">{{__('message.Link')}}</label>
            <div class="col-sm-9">
                <input type="text" name='enlace' class="form-control {{$errors->first('enlace') ? "is-invalid" : "" }} " value="{{old('enlace')}}" id="enlace" placeholder="ex: Wiklop.com">
                <div class="invalid-feedback">
                    {{ $errors->first('enlace') }}
                </div>
            </div>
        </div>

        <div class="form-group ml-5">
            <label for="enlace" class="col-sm-2 col-form-label">{{__('message.empresa')}}</label>
            <div class="col-sm-9">
                <input type="text" name='empresa' class="form-control {{$errors->first('empresa') ? "is-invalid" : "" }} " value="{{old('empresa')}}" id="empresa" placeholder="empresa">
                <div class="invalid-feedback">
                    {{ $errors->first('empresa') }}
                </div>
            </div>
        </div>
        <div class="form-group ml-5">
            <label for="direccion" class="col-sm-2 col-form-label">{{__('message.direccion')}}</label>
            <div class="col-sm-9">
                <input type="text" name='direccion' class="form-control {{$errors->first('direccion') ? "is-invalid" : "" }} " value="{{old('direccion')}}" id="direccion" placeholder="direccion">
                <div class="invalid-feedback">
                    {{ $errors->first('direccion') }}
                </div>
            </div>
        </div>
        <div class="form-group ml-5">
            <label for="codigo_postal" class="col-sm-2 col-form-label">{{__('message.codigo_postal')}}</label>
            <div class="col-sm-9">
                <input type="text" name='codigo_postal' class="form-control {{$errors->first('codigo_postal') ? "is-invalid" : "" }} " value="{{old('codigo_postal')}}" id="codigo_postal" placeholder="codigo_postal">
                <div class="invalid-feedback">
                    {{ $errors->first('codigo_postal') }}
                </div>
            </div>
        </div>
        <div class="form-group ml-5">
            <label for="poblacion" class="col-sm-2 col-form-label">{{__('message.poblacion')}}</label>
            <div class="col-sm-9">
                <input type="text" name='poblacion' class="form-control {{$errors->first('poblacion') ? "is-invalid" : "" }} " value="{{old('poblacion')}}" id="poblacion" placeholder="poblacion">
                <div class="invalid-feedback">
                    {{ $errors->first('poblacion') }}
                </div>
            </div>
        </div>
        <div class="form-group ml-5">
            <label for="provincia" class="col-sm-2 col-form-label">{{__('message.Provincia')}}</label>
            <div class="col-sm-9">
                <input type="text" name='provincia' class="form-control {{$errors->first('provincia') ? "is-invalid" : "" }} " value="{{old('provincia')}}" id="provincia" placeholder="provincia">
                <div class="invalid-feedback">
                    {{ $errors->first('provincia') }}
                </div>
            </div>
        </div>
        <div class="form-group ml-5">
            <label for="telefono" class="col-sm-2 col-form-label">{{__('message.telefono')}}</label>
            <div class="col-sm-9">
                <input type="text" name='telefono' class="form-control {{$errors->first('telefono') ? "is-invalid" : "" }} " value="{{old('telefono')}}" id="telefono" placeholder="telefono">
                <div class="invalid-feedback">
                    {{ $errors->first('telefono') }}
                </div>
            </div>
        </div>
        <div class="form-group ml-5">
            <label for="email" class="col-sm-2 col-form-label">{{__('message.Email')}}</label>
            <div class="col-sm-9">
                <input type="email" name='email' class="form-control {{$errors->first('email') ? "is-invalid" : "" }} " value="{{old('email')}}" id="email" placeholder="email">
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            </div>
        </div>
        <div class="form-group ml-5">
            <div class="col-sm-3">
                <button type="submit" class="btn btn-primary">{{__('message.Create')}}</button>
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
