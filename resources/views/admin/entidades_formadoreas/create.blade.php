@extends('layouts.admin')

@section('styles')
<style>
   .picture-container {
  position: relative;
  cursor: pointer;
  text-align: center;
}
 .picture {
  width: 200px;
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

{{--    @if ($errors->any())--}}
{{--        <div class="alert alert-danger">--}}
{{--            <ul>--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}

    <form action="{{ route('admin.entidades_formadoreas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-groups">


            <div class="form-group col-md-4">

                <label for="socio" class="col-sm-2 col-form-label">{{__('message.Socio')}}</label>

                <div class="col-sm-12">

                    <input type="number" name='socio' class="form-control {{$errors->first('socio') ? "is-invalid" : "" }} " value="{{old('socio')}}" id="name" placeholder="Código de socio">

                    <div class="invalid-feedback">
                        {{ $errors->first('socio') }}
                    </div>

                </div>

            </div>

            <div class="form-group col-md-4">

                <label for="cif" class="col-sm-2 col-form-label">{{__('message.CIF')}}</label>

                <div class="col-sm-12">

                    <input type="text" name='cif' class="form-control {{$errors->first('cif') ? "is-invalid" : "" }} " value="{{old('cif')}}" id="position" placeholder="Código de identificación">

                    <div class="invalid-feedback">
                        {{ $errors->first('cif') }}
                    </div>

                </div>

            </div>


            <div class="form-group col-md-4">

                <label for="nombre" class="col-sm-2 col-form-label">{{__('message.Nombre')}}</label>

                <div class="col-sm-12">

                    <input type="text" name='nombre' class="form-control {{$errors->first('nombre') ? "is-invalid" : "" }} " value="{{old('nombre')}}" id="nombre" placeholder="Nombre comercial">

                    <div class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </div>

                </div>

            </div>

            <div class="form-group col-md-4">

                <label for="razon_social" class="col-sm-4 col-form-label">{{__('message.Razón Social')}}</label>

                <div class="col-sm-12">

                    <input type="text" name='razon_social' class="form-control {{$errors->first('razon_social') ? "is-invalid" : "" }} " value="{{old('razon_social')}}" id="razon_social" placeholder="Nombre de la empresa">

                    <div class="invalid-feedback">
                        {{ $errors->first('razon_social') }}
                    </div>

                </div>

            </div>

            <div class="form-group col-md-4">

                <label for="province" class="col-sm-2 col-form-label">{{__('message.Provincia')}}</label>

                <div class="col-sm-12">

                    <input type="text" name='province' class="form-control {{$errors->first('province') ? "is-invalid" : "" }} " value="{{old('province')}}" id="province" placeholder="Provincia de la sede">

                    <div class="invalid-feedback">
                        {{ $errors->first('province') }}
                    </div>

                </div>

            </div>

            <div class="form-group col-md-4">

                <label for="ciudad" class="col-sm-2 col-form-label">{{__('message.Ciudad')}}</label>

                <div class="col-sm-12">

                    <input type="text" name='ciudad' class="form-control {{$errors->first('ciudad') ? "is-invalid" : "" }} " value="{{old('ciudad')}}" id="ciudad" placeholder="Ciudad de la sede">

                    <div class="invalid-feedback">
                        {{ $errors->first('ciudad') }}
                    </div>

                </div>

            </div>




            <div class="form-group col-md-4">

                <label for="direccion" class="col-sm-2 col-form-label">{{__('message.Direccion')}}</label>

                <div class="col-sm-12">

                    <input type="text" name='direccion' class="form-control {{$errors->first('direccion') ? "is-invalid" : "" }} " value="{{old('direccion')}}" id="direccion" placeholder="Domicilio de la sede">

                    <div class="invalid-feedback">
                        {{ $errors->first('direccion') }}
                    </div>

                </div>

            </div>
            <div class="form-group col-md-4">

                <label for="codigo_postal" class="col-sm-5 col-form-label">{{__('message.Codigo_postal')}}</label>

                <div class="col-sm-12">

                    <input type="number" name='codigo_postal' class="form-control {{$errors->first('codigo_postal') ? "is-invalid" : "" }} " value="{{old('codigo_postal')}}" id="codigo_postal" placeholder="Código postal de la sede">

                    <div class="invalid-feedback">
                        {{ $errors->first('codigo_postal') }}
                    </div>

                </div>

            </div>
                    <div class="form-group col-md-4">
                        <div class="picture-container">
                            <div class="picture">
                                <img src="" class="picture-src" id="wizardPicturePreview" height="200px" width="400px" title=""/>
                                <input type="file" id="wizard-picture" name="logo" class="form-control {{$errors->first('logo') ? "is-invalid" : "" }} ">
                                <div class="invalid-feedback">
                                    {{ $errors->first('logo') }}
                                </div>
                            </div>
                            <h6>{{__('message.Logo')}}</h6>
                        </div>
                    </div>
{{--            <div class="form-group col-md-4">--}}

{{--                <label for="logo" class="col-sm-2 col-form-label"></label>--}}

{{--                <div class="col-sm-12">--}}

{{--                    <input type="file" name='logo' class="form-control {{$errors->first('logo') ? "is-invalid" : "" }} " value="{{old('logo')}}" id="logo" placeholder="Link Linkedin">--}}

{{--                    <div class="invalid-feedback">--}}
{{--                        {{ $errors->first('logo') }}--}}
{{--                    </div>--}}

{{--                </div>--}}

{{--            </div>--}}

            <div class="form-group col-md-4">

                <label for="web" class="col-sm-2 col-form-label">{{__('message.WEB')}}</label>

                <div class="col-sm-12">

                    <input type="text" name='web' class="form-control {{$errors->first('web') ? "is-invalid" : "" }} " value="{{old('web')}}" id="web" placeholder="URL de la web">

                    <div class="invalid-feedback">
                        {{ $errors->first('web') }}
                    </div>

                </div>

            </div>
            <div class="form-group col-md-4">

                <label for="mail" class="col-sm-2 col-form-label">{{__('message.Mail')}}</label>

                <div class="col-sm-12">

                    <input type="text" name='mail' class="form-control {{$errors->first('mail') ? "is-invalid" : "" }} " value="{{old('mail')}}" id="mail" placeholder="Correo electrónico">

                    <div class="invalid-feedback">
                        {{ $errors->first('mail') }}
                    </div>

                </div>

            </div>
            <div class="form-group col-md-4">

                <label for="doc_medios_pdf" class="col-sm-5 col-form-label">{{__('message.Doc Medios PDF')}}</label>

                <div class="col-sm-12">

                    <input type="file" name='doc_medios_pdf' class="form-control {{$errors->first('doc_medios_pdf') ? "is-invalid" : "" }} " value="{{old('doc_medios_pdf')}}" id="doc_medios_pdf" placeholder="Link Linkedin">

                    <div class="invalid-feedback">
                        {{ $errors->first('doc_medios_pdf') }}
                    </div>

                </div>

            </div><div class="form-group col-md-4">

                <label for="fecha" class="col-sm-2 col-form-label">{{__('message.Fecha')}}</label>

                <div class="col-sm-12">

                    <input type="date" name='fecha' class="form-control {{$errors->first('fecha') ? "is-invalid" : "" }} " value="{{old('fecha')}}" id="fecha" placeholder="Fecha de alta">

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

            <div class="col-md-2 d-flex flex-column justify-content-center">
                <label for="certificado" class="col-sm-12 col-form-label text-center">{{__('message.Certificado')}}</label>
                <label class="switch">
                    <input type="checkbox" name="certificado">
                    <span class="slider round" ></span>
                </label>
            </div>


            <div class="form-group  col-sm-12">
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

@endpush
