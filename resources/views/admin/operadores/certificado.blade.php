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

<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="picture" style="width: 300px;height: 300px;">
                <img src="{{asset('storage/' . $operador->foto)}}" width="300px" height="300px">
            </div>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-4">
            <h6>{{__('message.Código del certificado')}} : <br><span>{{$cert_numero}}</span></h6>
        </div>
        <div class="col-md-4">
            <h6>{{__('message.Nombre')}} :<br> <span>{{$operador->nombre}}</span></h6>
        </div>
        <div class="col-md-4">
            <h6>{{__('message.Apellidos')}} :<br> <span>{{$operador->apellidos}}</span></h6>
        </div>
        <div class="col-md-4">
            <h6>{{__('message.DNI')}} :<br> <span>{{$operador->dni}}</span></h6>
        </div>
        <div class="col-md-4">
            <h6>{{__('message.Tipo de curso')}} :<br> <span>
                    @if($curso != null)
                    @if($curso->tipo_curso == 1)
                        Básico
                    @else
                        Renovación
                    @endif
                    @endif
                </span></h6>
        </div>
        <div class="col-md-4">
            <h6>{{__('message.Código de curso')}} :<br> <span>
                    @if($curso != null)
                    {{$curso->codigo}}
                    @endif
                </span></h6>
        </div>
        <div class="col-md-4">
            <h6>{{__('message.Fecha de alta')}} :<br> <span>
                    @if($curso != null)
                    {{date('d/m/Y',strtotime($curso->fecha_alta))}}
                    @endif
                </span></h6>
        </div>
        <div class="col-md-4">
            <h6>{{__('message.Entidad Formadora')}} :<br> <span>{{$operador->entidades_formadoreas->razon_social}}</span></h6>
        </div>
        <div class="col-md-4">
            <h6>{{__('message.Nombre Entidad')}} :<br> <span>{{$operador->entidades_formadoreas->nombre}}</span></h6>
        </div>
        <div class="col-md-4">
            <h6>{{__('message.Fecha de emisión')}} :<br> <span>
                    @if(isset($activeAsistent))
                    {{date('d/m/Y',strtotime($activeAsistent->emision))}}
                    @endif
                </span></h6>
        </div>
        <div class="col-md-4">
            <h6>{{__('message.Fecha de vencimiento')}} :<br> <span>
                    @if(isset($activeAsistent))
                    {{date('d/m/Y',strtotime($activeAsistent->vencimiento))}}
                    @endif
                </span></h6>
        </div>
        <div class="col-md-4">
            <h6>{{__('message.Maquina 1')}} :<br> <span>
                    @foreach($tipos as $tipo)
                        @if(isset($activeAsistent))
                        @if($activeAsistent->tipo_1 == $tipo->id)
                            {{$tipo->tipo_maquina}}
                        @elseif($activeAsistent->tipo_1 == 0)
                            --
                        @endif
                        @endif
                    @endforeach
                </span></h6>
        </div>
        <div class="col-md-4">
            <h6>{{__('message.Maquina 2')}} :<br> <span>
                    @foreach($tipos as $tipo)
                        @if(isset($activeAsistent))
                        @if($activeAsistent->tipo_2 == $tipo->id)
                            {{$tipo->tipo_maquina}}
                        @elseif($activeAsistent->tipo_2 == 0)
                            --
                        @endif
                        @endif
                    @endforeach
                </span></h6>
        </div>
        <div class="col-md-4">
            <h6>{{__('message.Maquina 3')}} :<br> <span>
                    @foreach($tipos as $tipo)
                        @if(isset($activeAsistent))
                        @if($activeAsistent->tipo_3 == $tipo->id)
                            {{$tipo->tipo_maquina}}
                        @elseif($activeAsistent->tipo_3 == 0)
                            --
                        @endif
                        @endif
                    @endforeach
                </span></h6>
        </div>
        <div class="col-md-4">
            <h6>{{__('message.Maquina 4')}} :<br> <span>
                    @foreach($tipos as $tipo)
                        @if(isset($activeAsistent))
                        @if($activeAsistent->tipo_4 == $tipo->id)
                            {{$tipo->tipo_maquina}}
                        @elseif($activeAsistent->tipo_4 == 0)
                            --
                        @endif
                        @endif
                    @endforeach
                </span></h6>
        </div>
        <div class="col-md-4">
            <h6>{{__('message.Tipo de carné')}} :<br> <span>
                    @if(isset($curso))
                    @if($curso->tipo_curso == 1)
                        B
                    @else
                        R
                    @endif
                    @endif
                </span></h6>
        </div>
        <div class="col-md-4">
            <h6>{{__('message.Número de carné')}} :<br> <span>
                    @if(isset($operador->carnett))
                        {{$operador->carnett->numero}}
                    @else
                      --------
                    @endif
                </span></h6>
        </div>
        <div class="col-md-4">
            <h6>{{__('message.Observaciones')}} :<br> <span>
                    @foreach($operador->asistent as $as)
                        {{$as->observaciones}}
                    @endforeach
                </span></h6>
        </div>
        <div class="col-md-4">
            <h6>{{__('message.Fecha de Exportación')}} :<br> <span></span></h6>
        </div>
    </div>
</div>
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
