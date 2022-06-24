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
        input[type="radio"] {
            cursor: pointer;
            width: 10%;
            margin: 0 auto;
        }
        input[type="radio"]:focus {
            color: #495057;
            background-color: #0477b1 !important;
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

    <form action="{{ route('admin.cursos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{--first row--}}
        <div class="form-groups">
            <div class="col-md-4">
                <label for="curso" class="col-sm-12 col-form-label">{{__('message.Curso')}}</label>
                <div class="col-sm-9">
                    <input type="text" readonly name='curso' class="form-control {{$errors->first('curso') ? "is-invalid" : "" }} " value="{{$course_code}}" id="curso" placeholder="Código del curso">
                    <div class="invalid-feedback">
                        {{ $errors->first('curso') }}
                    </div>
                </div>

            </div>


            <div class="col-md-4">
                <label for="tipo_curso" class="col-sm-12 col-form-label">{{__('message.Tipo Curso')}}</label>
                <div class="col-sm-9">
                    <select name='tipo_curso' class="form-control {{$errors->first('tipo_curso') ? "is-invalid" : "" }} " id="tipo_curso">
                        <option disabled selected>{{__('message.Choose_One')}}</option>
                        @foreach ($tipo_curso as $tipo_curso)
                            <option value="{{ $tipo_curso->id }}" {{old('tipo_curso') == $tipo_curso->id ? "selected" : ""}}>{{ $tipo_curso->tipo_curso }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('tipo_curso') }}
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <label for="tipo_maquina" class="col-sm-9 col-form-label">{{__('message.Tipo Maquina')}}</label>
                <div class="col-sm-9">
                    @foreach($tipo_maquina as $tipo_maquina)
                        <div class="form-check">
                            <input class="form-check-input {{$errors->first('tipo_maquina') ? "is-invalid" : "" }}" name="tipo_maquina[]" type="checkbox" value="{{$tipo_maquina->id}}" id="{{$tipo_maquina->id}}" onclick="updateSearchBox();" >
                            <label class="form-check-label" for="flexCheckDefault">
                                {{$tipo_maquina->tipo_maquina}}
                            </label>
                        </div>
                    @endforeach
                        <div class="invalid-feedback">
                            {{ $errors->first('tipo_maquina') }}
                        </div>
                </div>
            </div>



            {{--second row--}}

            <div class="col-md-4">
                <label for="codigo" class="col-sm-12 col-form-label">{{__('message.Codigo')}}</label>
                <div class="col-sm-9">
                    <input  type="text" readonly name='codigo' class="form-control {{$errors->first('codigo') ? "is-invalid" : "" }} " value="{{old('codigo')}}" id="codigo" placeholder="Código de prácticas">
                    <div class="invalid-feedback">
                        {{ $errors->first('codigo') }}
                    </div>
                </div>
            </div>


            <div class="col-md-4">
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


<div class="col-md-4">
<label for="formador" class="col-sm-12 col-form-label">{{__('message.Formador')}}</label>
<div class="col-sm-9">
    <select name='formador' class="form-control {{$errors->first('formador') ? "is-invalid" : "" }} " id="formador">
        <option disabled selected>{{__('message.Choose_One')}}</option>
        @foreach ($formador as $formador)
            <option value="{{ $formador->id }}" {{old('formador') == $formador->id ? "selected" : ""}}>{{ $formador->nombre }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">
        {{ $errors->first('formador') }}
    </div>
</div>
</div>


{{--third row--}}

<div class="col-md-4">
<label for="formador_apoyo_1" class="col-sm-12 col-form-label">{{__('message.Formador Apoyo')}} 1</label>
<div class="col-sm-9">
    <select name='formador_apoyo_1' class="form-control {{$errors->first('formador_apoyo_1') ? "is-invalid" : "" }} " id="formador_apoyo1">
        <option disabled selected>{{__('message.Choose_One')}}</option>
        @foreach ($formadors as $formadors)
            <option value="{{ $formadors->id }}" {{old('formador_apoyo_1') == $formadors->id ? "selected" : ""}}>{{ $formadors->nombre }}</option>
        @endforeach
    </select>
</div>
</div>


<div class="col-md-4">
<label for="formador_apoyo_2" class="col-sm-12 col-form-label">{{__('message.Formador Apoyo')}} 2</label>
<div class="col-sm-9">
    <select name='formador_apoyo_2' class="form-control {{$errors->first('formador_apoyo2') ? "is-invalid" : "" }} " id="formador_apoyo2">
        <option disabled selected>{{__('message.Choose_One')}}</option>
        @foreach ($formadors2 as $formador)
            <option value="{{ $formador->id }}" {{old('formador_apoyo_2') == $formador->id ? "selected" : ""}}>{{ $formador->nombre }}</option>
        @endforeach
    </select>
</div>

</div>

<div class="col-md-4">
<label for="formador_apoyo_3" class="col-sm-12 col-form-label">{{__('message.Formador Apoyo')}} 3</label>
<div class="col-sm-9">
    <select name='formador_apoyo_3' class="form-control {{$errors->first('formador_apoyo3') ? "is-invalid" : "" }} " id="formador_apoyo3">
        <option disabled selected>{{__('message.Choose_One')}}</option>
        @foreach ($formadors3 as $formador)
            <option value="{{ $formador->id }}" {{old('formador_apoyo_3') == $formador->id ? "selected" : ""}}>{{ $formador->nombre }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">
        {{ $errors->first('formador_apoyo3') }}
    </div>
</div>
</div>



{{--fourth row--}}

<div class="col-md-4">
<label for="fecha_inicio" class="col-sm-12 col-form-label">{{__('message.Fecha Inicio')}}</label>
<div class="col-sm-9">
    <input type="datetime-local" name='fecha_inicio' class="form-control {{$errors->first('fecha_inicio') ? "is-invalid" : "" }} " value="{{old('fecha_inicio')}}" id="fecha_inicio" >
    <div class="invalid-feedback">
        {{ $errors->first('fecha_inicio') }}
    </div>
</div>
</div>


<div class="col-md-4">
<label for="direccion" class="col-sm-12 col-form-label">{{__('message.Direccion')}}</label>
<div class="col-sm-9">
    <input type="text" name='direccion' class="form-control {{$errors->first('direccion') ? "is-invalid" : "" }} " value="{{old('direccion')}}" id="direccion" placeholder="Dirección del curso">
    <div class="invalid-feedback">
        {{ $errors->first('direccion') }}
    </div>
</div>
</div>


<div class="col-md-4">
<label for="ciudad" class="col-sm-12 col-form-label">{{__('message.Ciudad')}}</label>
<div class="col-sm-9">
    <input type="text" name='ciudad' class="form-control {{$errors->first('ciudad') ? "is-invalid" : "" }} " value="{{old('ciudad')}}" id="ciudad" placeholder="Ciudad del curso">
    <div class="invalid-feedback">
        {{ $errors->first('ciudad') }}
    </div>
</div>
</div>



{{--fifth row--}}

<div class="col-md-4">
<label for="provincia" class="col-sm-12 col-form-label">{{__('message.Provincia')}}</label>
<div class="col-sm-9">
    <input type="text" name='provincia' class="form-control {{$errors->first('provincia') ? "is-invalid" : "" }} " value="{{old('provincia')}}" id="provincia" placeholder="Provincia del curso">
    <div class="invalid-feedback">
        {{ $errors->first('provincia') }}
    </div>
</div>
</div>


<div class="col-md-4">
<label for="codigo_postal" class="col-sm-12 col-form-label">{{__('message.Codigo Postal')}}</label>
<div class="col-sm-9">
    <input type="number" name='codigo_postal' class="form-control {{$errors->first('codigo_postal') ? "is-invalid" : "" }} " value="{{old('codigo_postal')}}" id="codigo_postal" placeholder="Código postal del curso">
    <div class="invalid-feedback">
        {{ $errors->first('codigo_postal') }}
    </div>
</div>
</div>


<div class="col-md-4">
<label for="asistentes_pdf" class="col-sm-12 col-form-label">{{__('message.Asistentes Pdf')}}</label>
<div class="col-sm-9">
    <input type="file" name='asistentes_pdf' class="form-control {{$errors->first('asistentes_pdf') ? "is-invalid" : "" }} " value="{{old('asistentes_pdf')}}" id="asistentes_pdf" placeholder="asistentes_pdf">
    <div class="invalid-feedback">
        {{ $errors->first('asistentes_pdf') }}
    </div>
</div>
</div>


{{--sixth row--}}
            @if(auth()->user()->perfil=='Administrador' )
<div class="col-md-4">
<label for="examen-t" class="col-sm-12 col-form-label">{{__('message.Exámen Teórico')}}</label>
<div class="col-sm-9">
    <select name='examen_t' class="form-control {{$errors->first('examen_t') ? "is-invalid" : "" }} " id="examen-t">
        <option disabled selected>{{__('message.Choose_One')}}</option>
        @foreach ($examen_t as $examen_t)
            <option value="{{ $examen_t->id }}" {{old('examen_t') == $examen_t->id ? "selected" : ""}}>{{ $examen_t->nombre }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">
        {{ $errors->first('examen_t') }}
    </div>
</div>
</div>


<div class="col-md-4">
<label for="examen-p" class="col-sm-12 col-form-label">{{__('message.Exámen Práctico')}}</label>
<div class="col-sm-9">
    <select name='examen_p' class="form-control {{$errors->first('examen_p') ? "is-invalid" : "" }} " id="examen_p">
        <option disabled selected>{{__('message.Choose_One')}}</option>
        @foreach ($examen_p as $examen_p)
            <option value="{{ $examen_p->id }}" {{old('examen_p') == $examen_p->id ? "selected" : ""}}>{{ $examen_p->nombre }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">
        {{ $errors->first('examen_p') }}
    </div>
</div>
</div>
            @else
                <input type="hidden" name="examen_p" value="0">
                <input type="hidden" name="examen_t" value="0">
            @endif

{{--<div class="col-md-4">--}}

            {{--<div class="col-sm-9">--}}
            {{--    <input type="hidden" name='fecha_alta' class="form-control {{$errors->first('fecha_alta') ? "is-invalid" : "" }} " value="{{old('fecha_alta')}}" id="fecha_alta" >--}}
            {{--    <div class="invalid-feedback">--}}
            {{--        {{ $errors->first('fecha_alta') }}--}}
            {{--    </div>--}}
            {{--</div>--}}
            {{--</div>--}}


<div class="col-md-4">
<label for="observaciones" class="col-sm-12 col-form-label">{{__('message.Observaciones')}}</label>
<div class="col-sm-9">
    <input type="text" name='observaciones' class="form-control {{$errors->first('observaciones') ? "is-invalid" : "" }} " value="{{old('observaciones')}}" id="observaciones" placeholder="Observaciones al curso">
    <div class="invalid-feedback">
        {{ $errors->first('observaciones') }}
    </div>
</div>
</div>
            <div class="col-md-2 d-flex flex-column justify-content-center">
                <label for="estado" class="col-sm-12 col-form-label text-center">{{__('message.Publico')}} - {{__('message.Privado')}}</label>
                <label class="switch">
                    <input type="checkbox" name="publico_privado" {{old('publico_privado') == "on" ? "checked" : ""}} >
                    <span class="slider round"></span>
                </label>
            </div>

{{--seventh row--}}
@if(auth()->user()->perfil=='Administrador' )


<div class="col-md-2 d-flex flex-column justify-content-center">
<label for="estado" class="col-sm-12 col-form-label text-center">{{__('message.Cerrado')}}</label>
<label class="switch" >
    <input type="checkbox" name="cerrado" {{old('cerrado') == "on" ? "checked" : ""}}>
    <span class="slider round"></span>
</label>
</div>

<div class="col-md-2 d-flex flex-column justify-content-center">
<label for="estado" class="col-sm-12 col-form-label text-center">{{__('message.Estado')}}</label>
<label class="switch">
    <input type="checkbox" name="estado" {{old('estado') == "on" ? "checked" : ""}}>
    <span class="slider round" ></span>
</label>
</div>
@endif


</div>

{{--        <div class="form-group">--}}
{{--            <div class="picture-container">--}}
{{--                <div class="picture">--}}
{{--                    <img src="" class="picture-src" id="wizardPicturePreview" height="200px" width="400px" title=""/>--}}
{{--                    <input type="file" id="wizard-picture" name="cover" class="form-control {{$errors->first('cover') ? "is-invalid" : "" }} ">--}}
{{--                    <div class="invalid-feedback">--}}
{{--                        {{ $errors->first('cover') }}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <h6>Pilih Cover</h6>--}}
{{--            </div>--}}
{{--        </div>--}}

<div class="form-group mt-5">

<div class="col-sm-12">

<button type="submit" class="btn btn-info">{{__('message.Create')}}</button>

</div>

</div>

</form>
@endsection

@push('scripts')

<script>
var a1CheckBox = document.getElementById('1');
var b1CheckBox = document.getElementById('2');
var a2CheckBox = document.getElementById('3');
var b2CheckBox = document.getElementById('4');
var a3CheckBox = document.getElementById('5');
var b3CheckBox = document.getElementById('6');

var searchBox = document.getElementById('codigo');
var code = document.getElementById('curso').value;


function updateSearchBox() {
if(a2CheckBox.checked){
a1CheckBox.disabled  = true;
b1CheckBox.disabled  = true;
b2CheckBox.disabled  = true;
b3CheckBox.disabled  = true;
a3CheckBox.disabled  = true;
}
if(b2CheckBox.checked){
a1CheckBox.disabled  = true;
b1CheckBox.disabled  = true;
a2CheckBox.disabled  = true;
b3CheckBox.disabled  = true;
a3CheckBox.disabled  = true;
}
if(a1CheckBox.checked || b1CheckBox.checked || a3CheckBox.checked || b3CheckBox.checked){
a2CheckBox.disabled  = true;
b2CheckBox.disabled  = true;
}
if(!a1CheckBox.checked && !b1CheckBox.checked && !a2CheckBox.checked && !b2CheckBox.checked && !a3CheckBox.checked && !b3CheckBox.checked){
a1CheckBox.disabled  = false;
b1CheckBox.disabled  = false;
a2CheckBox.disabled  = false;
b2CheckBox.disabled  = false;
b3CheckBox.disabled  = false;
a3CheckBox.disabled  = false;
}


if (a1CheckBox.checked && !b1CheckBox.checked && !a2CheckBox.checked && !b2CheckBox.checked && !a3CheckBox.checked && !b3CheckBox.checked) {
searchBox.value = 'B01-' + code;
}else if (!a1CheckBox.checked && b1CheckBox.checked && !a2CheckBox.checked && !b2CheckBox.checked && !a3CheckBox.checked && !b3CheckBox.checked) {
searchBox.value = 'B02-' + code;
}else if (!a1CheckBox.checked && !b1CheckBox.checked && a2CheckBox.checked && !b2CheckBox.checked && !a3CheckBox.checked && !b3CheckBox.checked) {
searchBox.value = 'B03-' + code;
}else if (!a1CheckBox.checked && !b1CheckBox.checked && !a2CheckBox.checked && b2CheckBox.checked && !a3CheckBox.checked && !b3CheckBox.checked) {
searchBox.value ='B04-' + code;
}else if (!a1CheckBox.checked && !b1CheckBox.checked && !a2CheckBox.checked && !b2CheckBox.checked && a3CheckBox.checked && !b3CheckBox.checked) {
searchBox.value = 'B05-' + code;
}else if (!a1CheckBox.checked && !b1CheckBox.checked && !a2CheckBox.checked && !b2CheckBox.checked && !a3CheckBox.checked && b3CheckBox.checked) {
searchBox.value = 'B06-' + code;
}else if (a1CheckBox.checked && b1CheckBox.checked && !a2CheckBox.checked && !b2CheckBox.checked && !a3CheckBox.checked && !b3CheckBox.checked) {
searchBox.value = 'B07-' + code;
}else if (a1CheckBox.checked && !b1CheckBox.checked && !a2CheckBox.checked && !b2CheckBox.checked && a3CheckBox.checked && !b3CheckBox.checked) {
searchBox.value = 'B08-' + code;
}else if (a1CheckBox.checked && !b1CheckBox.checked && !a2CheckBox.checked && !b2CheckBox.checked && !a3CheckBox.checked && b3CheckBox.checked) {
searchBox.value = 'B09-' + code;
}else if (!a1CheckBox.checked && b1CheckBox.checked && !a2CheckBox.checked && !b2CheckBox.checked && a3CheckBox.checked && !b3CheckBox.checked) {
searchBox.value = 'B10-' + code;
}else if (!a1CheckBox.checked && b1CheckBox.checked && !a2CheckBox.checked && !b2CheckBox.checked && !a3CheckBox.checked && b3CheckBox.checked) {
searchBox.value = 'B11-' + code;
}else if (!a1CheckBox.checked && !b1CheckBox.checked && !a2CheckBox.checked && !b2CheckBox.checked && a3CheckBox.checked && b3CheckBox.checked) {
searchBox.value = 'B12-' + code;
}else if (a1CheckBox.checked && b1CheckBox.checked && !a2CheckBox.checked && !b2CheckBox.checked && a3CheckBox.checked && !b3CheckBox.checked) {
searchBox.value = 'B13-' + code;
}else if (a1CheckBox.checked && b1CheckBox.checked && !a2CheckBox.checked && !b2CheckBox.checked && !a3CheckBox.checked && b3CheckBox.checked) {
searchBox.value = 'B14-' + code;
}else if (a1CheckBox.checked && !b1CheckBox.checked && !a2CheckBox.checked && !b2CheckBox.checked && a3CheckBox.checked && b3CheckBox.checked) {
searchBox.value = 'B15-' + code;
}else if (a1CheckBox.checked && b1CheckBox.checked && !a2CheckBox.checked && !b2CheckBox.checked && a3CheckBox.checked && b3CheckBox.checked) {
searchBox.value = 'B17-' + code;
}else if (!a1CheckBox.checked && b1CheckBox.checked && !a2CheckBox.checked && !b2CheckBox.checked && a3CheckBox.checked && b3CheckBox.checked) {
    searchBox.value = 'B16-' + code;
}else {
searchBox.value = '{{__("message.you can not choose this type of machine togother")}}';
}
}

</script>

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
