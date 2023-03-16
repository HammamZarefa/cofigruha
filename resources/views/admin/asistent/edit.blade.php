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

        #examen_t_pdf {
            cursor: pointer;
            display: block;
            height: 100%;
            left: 0;
            opacity: 0 !important;
            position: absolute;
            top: 0;
            width: 100%;
        }

        #examen_p_pdf {
            cursor: pointer;
            display: block;
            height: 100%;
            left: 0;
            opacity: 0 !important;
            position: absolute;
            top: 0;
            width: 100%;
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


    <form action="{{ route('admin.asistent.update',$asistent->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{--first row--}}
        <div class="form-groups">

            <div class="form-group col-md-4">
                <label for="curso" class="col-sm-2 col-form-label">{{__('message.curso')}}</label>
                <div class="col-sm-9">
                    <select name='test' disabled class="form-control {{$errors->first('curso') ? "is-invalid" : "" }} "
                            id="curso">
                        @foreach ($curso as $curso)
                            <option
                                value="{{ $curso->id }}" {{$asistent->curso == $curso->id ? "selected" : ""}}>{{ $curso->codigo }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="curso" value="{{$asistent->curso}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('curso') }}
                    </div>
                </div>
            </div>


            {{--second row--}}

            <div class="form-group col-md-4">
                <label for="orden" class="col-sm-2 col-form-label">{{__('message.Orden')}}</label>
                <div class="col-sm-9">
                    <input type="number" name='orden'
                           class="form-control {{$errors->first('orden') ? "is-invalid" : "" }} "
                           value="{{old('orden') ? old('orden') : $asistent->orden}}" id="orden"
                           placeholder="Número de asistente">
                    <div class="invalid-feedback">
                        {{ $errors->first('orden') }}
                    </div>
                </div>
            </div>


            <div class="form-group col-md-4">
                <label for="operador" class="col-sm-2 col-form-label">{{__('message.Operador')}}</label>
                <div class="col-sm-9">
                    <select name='operador' class="form-control {{$errors->first('operador') ? "is-invalid" : "" }} "
                            id="operador">

                        @foreach ($operador as $operador)
                            <option
                                value="{{ $operador->id }}" {{$asistent->operador == $operador->id ? "selected" : ""}}>{{ $operador->nombre }} {{ $operador->apellidos }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('operador') }}
                    </div>
                </div>
            </div>

            @if(auth()->user()->perfil=='Administrador' )

                <div class="form-group col-md-4">
                    <label for="tipos_carnet" class="col-sm-2 col-form-label">{{__('message.tipo_carnet')}}</label>
                    <div class="col-sm-9">
                        <select name='tipos_carnet'
                                class="form-control {{$errors->first('tipos_carnet') ? "is-invalid" : "" }} " id="tipos_carnet">
                            <option disabled selected>{{__('message.Choose_One')}}</option>
                            <option value="R" {{$asistent->tipos_carnet == "R" ? "selected" : ""}}>R</option>
                            <option value="B" {{$asistent->tipos_carnet == "B" ? "selected" : ""}}>B</option>
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('tipos_carnet') }}
                        </div>
                    </div>
                </div>
                <input type="hidden" name="tipo_carnet" value="0">

            @else
                <input type="hidden" name="tipo_carnet" value="{{$asistent->tipo_carnet}}">
            @endif





            {{--third row--}}

            <div class="form-group col-md-4">
                <label for="nota_t" class="col-sm-2 col-form-label">{{__('message.Nota_t')}}</label>
                <div class="col-sm-9">
                    <input type="text" name='nota_t'
                           class="form-control {{$errors->first('nota_t') ? "is-invalid" : "" }} "
                           value="{{old('nota_t') ? old('nota_t') : $asistent->nota_t}}"
                           placeholder="Nota examen teórico" id="nota_t">
                    <div class="invalid-feedback">
                        {{ $errors->first('nota_t') }}
                    </div>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label for="nota_p" class="col-sm-2 col-form-label">{{__('message.Nota_p')}}</label>
                <div class="col-sm-9">
                    <select name='nota_p' class="form-control {{$errors->first('nota_p') ? "is-invalid" : "" }} "
                            id="nota_p">
                        <option  value="" {{!$asistent->notep ? "selected" : ""}}>Sin Nota</option>
                        @foreach ($notes as $note)
                            <option
                                value="{{ $note }}" {{$asistent->nota_p == $note ? "selected" : ""}}>{{$note}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('nota_p') }}
                    </div>
                </div>
            </div>


            {{--fourth row--}}
            <div class="form-group col-md-4">
                <label for="examen_t_pdf" class="col-sm-4 col-form-label">{{__('message.Exámen Teórico')}}</label>
                <span class="maxsize"> El tamaño máximo de archivo subido no debe superar 2 MB</span>
                @if($asistent->examen_t_pdf && file_exists(storage_path('app/public/' . $asistent->examen_t_pdf)))
                    <label for="examen_t_pdf" class="col-sm-1 col-form-label">
                        <a id="examen_t_pdf_download" href="{{asset('storage/' . $asistent->examen_t_pdf)}}" download><i
                                class="fa fa-download"></i> </a> </label>
                    <a id="examen_t_pdf_privew" target="_blank"
                       href="{{asset('storage/' . $asistent->examen_t_pdf)}}"><i class="fa fa-eye"></i> </a>
                    <div class="col-sm-12">
                        <i class="fas fa-edit" style="font-size: 20px"></i>
                        <input type="file" name='examen_t_pdf'
                               class="form-control {{$errors->first('examen_t_pdf') ? "is-invalid" : "" }} "
                               value="{{old('examen_t_pdf') ? old('examen_t_pdf') : $asistent->examen_t_pdf}}"
                               style="opacity: 0 !important" id="examen_t_pdf" placeholder="Link Linkedin">
                        <div class="invalid-feedback">
                            {{ $errors->first('examen_t_pdf') }}
                        </div>
                    </div>
                @else
                    <div class="col-sm-12">
                        <input type="file" name='examen_t_pdf'
                               class="form-control {{$errors->first('examen_t_pdf') ? "is-invalid" : "" }} "
                               value="{{old('examen_t_pdf') ? old('examen_t_pdf') : $asistent->examen_t_pdf}}"
                               id="examen_t_pdff" placeholder="Link Linkedin">
                        <div class="invalid-feedback">
                            {{ $errors->first('examen_t_pdf') }}
                        </div>
                    </div>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="examen_p_pdf" class="col-sm-4 col-form-label">{{__('message.Exámen Práctico')}}</label>
                <span class="maxsize"> El tamaño máximo de archivo subido no debe superar 2 MB</span>
                @if($asistent->examen_p_pdf && file_exists(storage_path('app/public/' . $asistent->examen_p_pdf)))
                    <label for="examen_p_pdf" class="col-sm-1 col-form-label">
                        <a id="examen_p_pdf_download" href="{{asset('storage/' . $asistent->examen_p_pdf)}}" download><i
                                class="fa fa-download"></i> </a> </label>
                    <a id="examen_p_pdf_privew" target="_blank"
                       href="{{asset('storage/' . $asistent->examen_p_pdf)}}"><i class="fa fa-eye"></i> </a>
                    <div class="col-sm-12">
                        <i class="fas fa-edit" style="font-size: 20px"></i>
                        <input type="file" name='examen_p_pdf'
                               class="form-control {{$errors->first('examen_p_pdf') ? "is-invalid" : "" }} "
                               value="{{old('examen_p_pdf') ? old('examen_p_pdf') : $asistent->examen_p_pdf}}"
                               style="opacity: 0 !important" id="examen_p_pdf" placeholder="Link Linkedin">
                        <div class="invalid-feedback">
                            {{ $errors->first('examen_p_pdf') }}
                        </div>
                    </div>
                @else
                    <div class="col-sm-12">
                        <input type="file" name='examen_p_pdf'
                               class="form-control {{$errors->first('examen_p_pdf') ? "is-invalid" : "" }} "
                               value="{{old('examen_p_pdf') ? old('examen_p_pdf') : $asistent->examen_p_pdf}}"
                               id="examen_p_pdff" placeholder="Link Linkedin">
                        <div class="invalid-feedback">
                            {{ $errors->first('examen_p_pdf') }}
                        </div>
                    </div>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="observaciones" class="col-sm-2 col-form-label">{{__('message.Observaciones')}}</label>
                <div class="col-sm-9">
                    <input type="text" name='observaciones'
                           class="form-control {{$errors->first('observaciones') ? "is-invalid" : "" }} "
                           value="{{old('observaciones') ? old('observaciones') : $asistent->observaciones}}"
                           id="observaciones" placeholder="Comentarios ">
                    <div class="invalid-feedback">
                        {{ $errors->first('observaciones') }}
                    </div>
                </div>
            </div>


            {{--fifth row--}}

            <div class="form-group col-md-4">
                <label for="emision" class="col-sm-2 col-form-label">{{__('message.Emision')}}</label>
                <div class="col-sm-9">
                    <input type="date" name='emision'
                           class="form-control {{$errors->first('emision') ? "is-invalid" : "" }} "
                           value="{{old('emision') ? old('emision') : $asistent->emision}}" id="emision"
                    {{auth()->user()->perfil=='Administrador' ? '' : 'disabled'}}>
                    <div class="invalid-feedback">{{ $errors->first('emision') }}</div>
                </div>
            </div>


            <div class="form-group col-md-4">
                <label for="vencimiento" class="col-sm-4 col-form-label">{{__('message.Vencimiento')}}</label>
                {{--                    <label for="vencimiento" class="col-sm-7 col-form-label">{{$asistent->vencimiento != null ? date('d/m/Y',strtotime($asistent->vencimiento)) : ""}}</label>--}}

                <div class="col-sm-9">
                    <input type="date" name='vencimiento'
                           class="form-control {{$errors->first('vencimiento') ? "is-invalid" : "" }} "
                           value="{{old('vencimiento') ? old('vencimiento') : $asistent->vencimiento}}"
                           id="vencimiento">
                    <div class="invalid-feedback">
                        {{ $errors->first('vencimiento') }}
                    </div>
                </div>
            </div>


            @if(auth()->user()->perfil=='Administrador' )
                <div class="form-group col-md-4">
                    <label for="tipo_1" class="col-sm-2 col-form-label">{{__('message.Tipo_1')}}</label>
                    <div class="col-sm-9">
                        <select name='tipo_1' class="form-control {{$errors->first('tipo_1') ? "is-invalid" : "" }} "
                                id="tipo_1">
                            <option disabled selected>{{__('message.Choose_One')}}</option>
                            @foreach ($tipo as $tipo_1)
                                @if($tipo_1->id == $tipos[0] || $tipo_1->id == $tipos[1] || $tipo_1->id == $tipos[2] || $tipo_1->id == $tipos[3])
                                    <option
                                        value="{{ $tipo_1->id }}" {{$asistent->tipo_1 == $tipo_1->id ? "selected" : ""}}>{{ $tipo_1->tipo_maquina }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('tipo_1') }}
                        </div>
                    </div>
                </div>


                <div class="form-group col-md-4">
                    <label for="tipo_2" class="col-sm-2 col-form-label">{{__('message.Tipo_2')}}</label>
                    <div class="col-sm-9">
                        <select name='tipo_2' class="form-control {{$errors->first('tipo_2') ? "is-invalid" : "" }} "
                                id="tipo_2">
                            <option value="0" selected>{{__('message.Choose_One')}}</option>
                            @foreach ($tipo as $tipo_2)
                                @if($tipo_2->id == $tipos[0] || $tipo_2->id == $tipos[1] || $tipo_2->id == $tipos[2] || $tipo_2->id == $tipos[3])
                                    <option
                                        value="{{ $tipo_2->id }}" {{$asistent->tipo_2 == $tipo_2->id ? "selected" : ""}}>{{ $tipo_2->tipo_maquina }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('tipo_2') }}
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="tipo_3" class="col-sm-2 col-form-label">{{__('message.Tipo_3')}}</label>
                    <div class="col-sm-9">
                        <select name='tipo_3' class="form-control {{$errors->first('tipo_3') ? "is-invalid" : "" }} "
                                id="tipo_3">
                            <option value="0" selected>{{__('message.Choose_One')}}</option>
                            @foreach ($tipo as $tipo_3)
                                @if($tipo_3->id == $tipos[0] || $tipo_3->id == $tipos[1] || $tipo_3->id == $tipos[2] || $tipo_3->id == $tipos[3])
                                    <option
                                        value="{{ $tipo_3->id }}" {{$asistent->tipo_3 == $tipo_3->id ? "selected" : ""}}>{{ $tipo_3->tipo_maquina }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('tipo_3') }}
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="tipo_4" class="col-sm-2 col-form-label">{{__('message.Tipo_4')}}</label>
                    <div class="col-sm-9">
                        <select name='tipo_4' class="form-control {{$errors->first('tipo_4') ? "is-invalid" : "" }} "
                                id="tipo_4">
                            <option value="0" selected>{{__('message.Choose_One')}}</option>
                            @foreach ($tipo as $tipo_4)
                                @if($tipo_4->id == $tipos[0] || $tipo_4->id == $tipos[1] || $tipo_4->id == $tipos[2] || $tipo_4->id == $tipos[3])
                                    <option
                                        value="{{ $tipo_4->id }}" {{$asistent->tipo_4 == $tipo_4->id ? "selected" : ""}}>{{ $tipo_4->tipo_maquina }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            {{ $errors->first('tipo_4') }}
                        </div>
                    </div>
                </div>
            @else
                <input type="hidden" name="tipo_1" value="{{$asistent->tipo_1}}">
                <input type="hidden" name="tipo_2" value="{{$asistent->tipo_2}}">
                <input type="hidden" name="tipo_3" value="{{$asistent->tipo_3}}">
                <input type="hidden" name="tipo_4" value="{{$asistent->tipo_4}}">
            @endif


        </div>
        <div class="container">
            <div class="row">
                <div class="form-group ml-5">

                    <div class="col-sm-3">

                        <button type="submit" class="btn btn-info">{{__('message.Update')}}</button>

                    </div>

                </div>
            </div>
        </div>


    </form>
@endsection

@push('scripts')
    <script>
        $("#nota_p").change(function (){
            if (this.value == 1){
                document.getElementById('tipo_1').value = 1;
                document.getElementById('tipo_2').value = 0;
                document.getElementById('tipo_3').value = 0;
                document.getElementById('tipo_4').value = 0;
            }else if (this.value == 2){
                document.getElementById('tipo_1').value = 2;
                document.getElementById('tipo_2').value = 0;
                document.getElementById('tipo_3').value = 0;
                document.getElementById('tipo_4').value = 0;
            }else if (this.value == 3){
                document.getElementById('tipo_1').value = 1;
                document.getElementById('tipo_2').value = 2;
                document.getElementById('tipo_3').value = 0;
                document.getElementById('tipo_4').value = 0;
            }else if (this.value == 4){
                document.getElementById('tipo_1').value = 5;
                document.getElementById('tipo_2').value = 0;
                document.getElementById('tipo_3').value = 0;
                document.getElementById('tipo_4').value = 0;
            }else if (this.value == 5){
                document.getElementById('tipo_1').value = 1;
                document.getElementById('tipo_2').value = 5;
                document.getElementById('tipo_3').value = 0;
                document.getElementById('tipo_4').value = 0;
            }else if (this.value == 6){
                document.getElementById('tipo_1').value = 2;
                document.getElementById('tipo_2').value = 5;
                document.getElementById('tipo_3').value = 0;
                document.getElementById('tipo_4').value = 0;
            }else if (this.value == 7){
                document.getElementById('tipo_1').value = 1;
                document.getElementById('tipo_2').value = 2;
                document.getElementById('tipo_3').value = 6;
                document.getElementById('tipo_4').value = 0;
            }else if (this.value == 8){
                document.getElementById('tipo_1').value = 6;
                document.getElementById('tipo_2').value = 0;
                document.getElementById('tipo_3').value = 0;
                document.getElementById('tipo_4').value = 0;
            }else if (this.value == 9){
                document.getElementById('tipo_1').value = 1;
                document.getElementById('tipo_2').value = 6;
                document.getElementById('tipo_3').value = 0;
                document.getElementById('tipo_4').value = 0;
            }else if (this.value == 10){
                document.getElementById('tipo_1').value = 2;
                document.getElementById('tipo_2').value = 6;
                document.getElementById('tipo_3').value = 0;
                document.getElementById('tipo_4').value = 0;
            }else if (this.value == 11){
                document.getElementById('tipo_1').value = 1;
                document.getElementById('tipo_2').value = 2;
                document.getElementById('tipo_3').value = 5;
                document.getElementById('tipo_4').value = 0;
            }else if (this.value == 12){
                document.getElementById('tipo_1').value = 5;
                document.getElementById('tipo_2').value = 6;
                document.getElementById('tipo_3').value = 0;
                document.getElementById('tipo_4').value = 0;
            }else if (this.value == 13){
                document.getElementById('tipo_1').value = 1;
                document.getElementById('tipo_2').value = 5;
                document.getElementById('tipo_3').value = 6;
                document.getElementById('tipo_4').value = 0;
            }else if (this.value == 14){
                document.getElementById('tipo_1').value = 2;
                document.getElementById('tipo_2').value = 5;
                document.getElementById('tipo_3').value = 6;
                document.getElementById('tipo_4').value = 0;
            }else if (this.value == 15){
                document.getElementById('tipo_1').value = 1;
                document.getElementById('tipo_2').value = 2;
                document.getElementById('tipo_3').value = 5;
                document.getElementById('tipo_4').value = 6;
            }else if (this.value == 16){
                document.getElementById('tipo_1').value = 3;
                document.getElementById('tipo_2').value = 0;
                document.getElementById('tipo_3').value = 0;
                document.getElementById('tipo_4').value = 0;
            }else if (this.value == 17){
                document.getElementById('tipo_1').value = 4;
                document.getElementById('tipo_2').value = 0;
                document.getElementById('tipo_3').value = 0;
                document.getElementById('tipo_4').value = 0;
            }
        })
    </script>
    <script>
        // Prepare the preview for profile picture
        $("#wizard-picture").change(function () {
            readURL(this);
        });

        //Function to show image before upload
        function readURL(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        // Prepare the preview for profile picture
        $("#examen_t_pdf").change(function () {
            readURL1(this);
        });

        //Function to show image before upload

        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#examen_t_pdf_download').attr('href', e.target.result).fadeIn('slow');
                    document.getElementById('examen_t_pdf_privew').style.display = "none";
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        // Prepare the preview for profile picture
        $("#examen_p_pdf").change(function () {
            readURL2(this);
        });

        //Function to show image before upload

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#examen_p_pdf_download').attr('href', e.target.result).fadeIn('slow');
                    document.getElementById('examen_p_pdf_privew').style.display = "none";
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
