@extends('layouts.admin')
@section('styles')
    <style>
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

        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9); /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content, #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {
                -webkit-transform: scale(0)
            }
            to {
                -webkit-transform: scale(1)
            }
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }
            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }
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
        #operador_pdf{
            cursor: pointer;
            display: block;
            height: 100%;
            left: 0;
            opacity: 0 !important;
            position: absolute;
            top: 0;
            width: 100%;
        }
        #cert_empresa_pdf{
            cursor: pointer;
            display: block;
            height: 100%;
            left: 0;
            opacity: 0 !important;
            position: absolute;
            top: 0;
            width: 100%;
        }

        #dni_img{
            cursor: pointer;
            display: block;
            height: 100%;
            left: 0;
            opacity: 0 !important;
            position: absolute;
            top: 0;
            width: 100%;
        }

        #vida_laboral_pdf{
            cursor: pointer;
            display: block;
            height: 100%;
            left: 0;
            opacity: 0 !important;
            position: absolute;
            top: 0;
            width: 100%;
        }

        #cap_pdf{
            cursor: pointer;
            display: block;
            height: 100%;
            left: 0;
            opacity: 0 !important;
            position: absolute;
            top: 0;
            width: 100%;
        }

        #pemp_pdf{
            cursor: pointer;
            display: block;
            height: 100%;
            left: 0;
            opacity: 0 !important;
            position: absolute;
            top: 0;
            width: 100%;
        }

        #prl_pdf{
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

    <form action="{{ route('admin.formadores.update',$formadores->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-groups">


            <div class="form-group col-md-4">

                <label for="codigo" class="col-sm-2 col-form-label">{{__('message.Codigo')}}</label>

                <div class="col-sm-9">
                    <input type="text" name='codigo'
                           class="form-control {{$errors->first('codigo') ? "is-invalid" : "" }} "
                           value="{{old('codigo') ? old('codigo') : $formadores->codigo}}" id="codigo" placeholder="Código del Formador
Name">
                    <div class="invalid-feedback">
                        {{ $errors->first('codigo') }}
                    </div>
                </div>
            </div>

            {{--<div class="form-group col-md-4">--}}
            {{--<label for="quote" class="col-sm-2 col-form-label">Entidad</label>--}}
            {{--<div class="col-sm-9">--}}
            {{--<input type="text" name='entidad' class="form-control {{$errors->first('entidad') ? "is-invalid" : "" }} " value="{{old('entidad')}}" id="entidad" placeholder="entidad">--}}
            {{--<div class="invalid-feedback">--}}
            {{--{{ $errors->first('entidad') }}--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class="form-group col-md-4">
                <label for="entidad" class="col-sm-2 col-form-label">{{__('message.Entidad')}} </label>
                <div class="col-sm-9">
                    <select name='entidad' class="form-control {{$errors->first('entidad') ? "is-invalid" : "" }} "
                            id="entidad">
                        <option disabled selected>{{__('message.Choose_One')}}</option>
                        @foreach ($entidad as $entidad)
                            <option
                                value="{{ $entidad->id }}" {{$formadores->entidad == $entidad->id ? "selected" : ""}}>{{ $entidad->nombre }}</option>
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

                    <input type="text" placeholder="Apellidos del Formador Name" name="apellidos" id="apellidos"
                           cols="40" rows="10"
                           class="form-control {{$errors->first('apellidos') ? "is-invalid" : "" }} "
                           value="{{old('apellidos') ? old('apellidos') : $formadores->apellidos}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('apellidos') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="nombre" class="col-sm-2 col-form-label">{{__('message.Nombre')}} </label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="text" name="nombre" placeholder="Nombre del formador" id="nombre"
                           class="form-control {{$errors->first('nombre') ? "is-invalid" : "" }} "
                           value="{{old('nombre') ? old('nombre') : $formadores->nombre}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="dni" class="col-sm-2 col-form-label">{{__('message.DNI')}} </label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="text" placeholder="Documento identificación" name="dni" id="dni" cols="40" rows="10"
                           class="form-control {{$errors->first('dni') ? "is-invalid" : "" }} "
                           value="{{old('dni') ? old('dni') : $formadores->dni}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('dni') }}
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                @if(substr($formadores->dni_img, -3) == 'pdf')
                    @if($formadores->dni_img && file_exists(storage_path('app/public/' . $formadores->operador_pdf)))
                        <label for="dni_img" class="col-sm-1 col-form-label">
                            <a id="dni_img_download" href="{{asset('storage/' . $formadores->dni_img)}}" download><i class="fa fa-download"></i> </a> </label>
                        <a id="dni_img_privew" target="_blank" href="{{asset('storage/' . $formadores->dni_img)}}"  ><i class="fa fa-eye"></i> </a>
                        <div class="col-sm-12">
                            <i class="fas fa-edit" style="font-size: 20px"></i>
                            <input type="file" name='dni_img' class="form-control {{$errors->first('dni_img') ? "is-invalid" : "" }} " value="{{old('dni_img') ? old('dni_img') : $formadores->dni_img}}" style="opacity: 0 !important" id="dni_img" placeholder="Link Linkedin">
                            <div class="invalid-feedback">
                                {{ $errors->first('dni_img') }}
                            </div>
                        </div>
                    @else
                        <div class="col-sm-12">
                            <input type="file" name='operador_pdf' class="form-control {{$errors->first('operador_pdf') ? "is-invalid" : "" }} " value="{{old('operador_pdf') ? old('operador_pdf') : $formadores->operador_pdf}}" id="operador_pdff" placeholder="Link Linkedin">
                            <div class="invalid-feedback">
                                {{ $errors->first('operador_pdf') }}
                            </div>
                        </div>
                    @endif
                @elseif(substr($formadores->dni_img, -3) != 'pdf')
                <div class="image">
                    <div class="form-group col-md-12">
                        <div class="picture-container">
                            <div class="picture">
                                <img src="{{asset('storage/' . $formadores->dni_img)}}" class="picture-src"
                                     id="wizardPicturePreview" height="200px" width="400px" title=""/>
                                <input type="file" id="wizard-picture" name="dni_img"
                                       class="form-control {{$errors->first('dni_img') ? "is-invalid" : "" }} " value="{{old('dni_img') ? old('dni_img') : $formadores->dni_img}}">
                                <div class="invalid-feedback">
                                    {{ $errors->first('dni_img') }}
                                </div>
                            </div>
                            <h6>{{__('message.DNI')}}</h6>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            <div class="form-group col-md-4">
                <label for="operador_pdf" class="col-sm-4 col-form-label">{{__('message.Operador PDF')}}</label>
                @if($formadores->operador_pdf && file_exists(storage_path('app/public/' . $formadores->operador_pdf)))
                    <label for="operador_pdf" class="col-sm-1 col-form-label">
                        <a id="operador_pdf_download" href="{{asset('storage/' . $formadores->operador_pdf)}}" download><i class="fa fa-download"></i> </a> </label>
                    <a id="operador_pdf_privew" target="_blank" href="{{asset('storage/' . $formadores->operador_pdf)}}"  ><i class="fa fa-eye"></i> </a>
                    <div class="col-sm-12">
                        <i class="fas fa-edit" style="font-size: 20px"></i>
                        <input type="file" name='operador_pdf' class="form-control {{$errors->first('operador_pdf') ? "is-invalid" : "" }} " value="{{old('operador_pdf') ? old('operador_pdf') : $formadores->operador_pdf}}" style="opacity: 0 !important" id="operador_pdf" placeholder="Link Linkedin">
                        <div class="invalid-feedback">
                            {{ $errors->first('operador_pdf') }}
                        </div>
                    </div>
                @else
                    <div class="col-sm-12">
                        <input type="file" name='operador_pdf' class="form-control {{$errors->first('operador_pdf') ? "is-invalid" : "" }} " value="{{old('operador_pdf') ? old('operador_pdf') : $formadores->operador_pdf}}" id="operador_pdff" placeholder="Link Linkedin">
                        <div class="invalid-feedback">
                            {{ $errors->first('operador_pdf') }}
                        </div>
                    </div>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="cert_empresa_pdf" class="col-sm-4 col-form-label">{{__('message.Cert Empresa PDF')}}</label>
                @if($formadores->cert_empresa_pdf && file_exists(storage_path('app/public/' . $formadores->cert_empresa_pdf)))
                    <label for="cert_empresa_pdf" class="col-sm-1 col-form-label">
                        <a id="cert_empresa_pdf_download" href="{{asset('storage/' . $formadores->cert_empresa_pdf)}}" download><i class="fa fa-download"></i> </a> </label>
                    <a id="cert_empresa_pdf_privew" target="_blank" href="{{asset('storage/' . $formadores->cert_empresa_pdf)}}"  ><i class="fa fa-eye"></i> </a>
                    <div class="col-sm-12">
                        <i class="fas fa-edit" style="font-size: 20px"></i>
                        <input type="file" name='cert_empresa_pdf' class="form-control {{$errors->first('cert_empresa_pdf') ? "is-invalid" : "" }} " value="{{old('cert_empresa_pdf') ? old('cert_empresa_pdf') : $formadores->cert_empresa_pdf}}" style="opacity: 0 !important" id="cert_empresa_pdf" placeholder="Link Linkedin">
                        <div class="invalid-feedback">
                            {{ $errors->first('cert_empresa_pdf') }}
                        </div>
                    </div>
                @else
                    <div class="col-sm-12">
                        <input type="file" name='cert_empresa_pdf' class="form-control {{$errors->first('cert_empresa_pdf') ? "is-invalid" : "" }} " value="{{old('cert_empresa_pdf') ? old('cert_empresa_pdf') : $formadores->cert_empresa_pdf}}" id="cert_empresa_pdff" placeholder="Link Linkedin">
                        <div class="invalid-feedback">
                            {{ $errors->first('cert_empresa_pdf') }}
                        </div>
                    </div>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="vida_laboral_pdf" class="col-sm-4 col-form-label">{{__('message.Vida laboral pdf')}}</label>
                @if($formadores->vida_laboral_pdf && file_exists(storage_path('app/public/' . $formadores->vida_laboral_pdf)))
                    <label for="vida_laboral_pdf" class="col-sm-1 col-form-label">
                        <a id="vida_laboral_pdf_download" href="{{asset('storage/' . $formadores->vida_laboral_pdf)}}" download><i class="fa fa-download"></i> </a> </label>
                    <a id="vida_laboral_pdf_privew" target="_blank" href="{{asset('storage/' . $formadores->vida_laboral_pdf)}}"  ><i class="fa fa-eye"></i> </a>
                    <div class="col-sm-12">
                        <i class="fas fa-edit" style="font-size: 20px"></i>
                        <input type="file" name='vida_laboral_pdf' class="form-control {{$errors->first('vida_laboral_pdf') ? "is-invalid" : "" }} " value="{{old('vida_laboral_pdf') ? old('vida_laboral_pdf') : $formadores->vida_laboral_pdf}}" style="opacity: 0 !important" id="vida_laboral_pdf" placeholder="Link Linkedin">
                        <div class="invalid-feedback">
                            {{ $errors->first('vida_laboral_pdf') }}
                        </div>
                    </div>
                @else
                    <div class="col-sm-12">
                        <input type="file" name='vida_laboral_pdf' class="form-control {{$errors->first('vida_laboral_pdf') ? "is-invalid" : "" }} " value="{{old('vida_laboral_pdf') ? old('vida_laboral_pdf') : $formadores->vida_laboral_pdf}}" id="vida_laboral_pdff" placeholder="Link Linkedin">
                        <div class="invalid-feedback">
                            {{ $errors->first('vida_laboral_pdf') }}
                        </div>
                    </div>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="prl_pdf" class="col-sm-4 col-form-label">{{__('message.PRL PDF')}}</label>
                @if($formadores->prl_pdf && file_exists(storage_path('app/public/' . $formadores->prl_pdf)))
                    <label for="prl_pdf" class="col-sm-1 col-form-label">
                        <a id="prl_pdf_download" href="{{asset('storage/' . $formadores->prl_pdf)}}" download><i class="fa fa-download"></i> </a> </label>
                    <a id="prl_pdf_privew" target="_blank" href="{{asset('storage/' . $formadores->prl_pdf)}}"  ><i class="fa fa-eye"></i> </a>
                    <div class="col-sm-12">
                        <i class="fas fa-edit" style="font-size: 20px"></i>
                        <input type="file" name='prl_pdf' class="form-control {{$errors->first('prl_pdf') ? "is-invalid" : "" }} " value="{{old('prl_pdf') ? old('prl_pdf') : $formadores->prl_pdf}}" style="opacity: 0 !important" id="prl_pdf" placeholder="Link Linkedin">
                        <div class="invalid-feedback">
                            {{ $errors->first('prl_pdf') }}
                        </div>
                    </div>
                @else
                    <div class="col-sm-12">
                        <input type="file" name='prl_pdf' class="form-control {{$errors->first('prl_pdf') ? "is-invalid" : "" }} " value="{{old('prl_pdf') ? old('prl_pdf') : $formadores->prl_pdf}}" id="prl_pdff" placeholder="Link Linkedin">
                        <div class="invalid-feedback">
                            {{ $errors->first('prl_pdf') }}
                        </div>
                    </div>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label for="pemp_pdf" class="col-sm-4 col-form-label">{{__('message.PEMP PDF')}}</label>
                @if($formadores->pemp_pdf && file_exists(storage_path('app/public/' . $formadores->pemp_pdf)))
                    <label for="pemp_pdf" class="col-sm-1 col-form-label">
                        <a id="pemp_pdf_download" href="{{asset('storage/' . $formadores->pemp_pdf)}}" download><i class="fa fa-download"></i> </a> </label>
                    <a id="pemp_pdf_privew" target="_blank" href="{{asset('storage/' . $formadores->pemp_pdf)}}"  ><i class="fa fa-eye"></i> </a>
                    <div class="col-sm-12">
                        <i class="fas fa-edit" style="font-size: 20px"></i>
                        <input type="file" name='pemp_pdf' class="form-control {{$errors->first('pemp_pdf') ? "is-invalid" : "" }} " value="{{old('pemp_pdf') ? old('pemp_pdf') : $formadores->pemp_pdf}}" style="opacity: 0 !important" id="pemp_pdf" placeholder="Link Linkedin">
                        <div class="invalid-feedback">
                            {{ $errors->first('pemp_pdf') }}
                        </div>
                    </div>
                @else
                    <div class="col-sm-12">
                        <input type="file" name='pemp_pdf' class="form-control {{$errors->first('pemp_pdf') ? "is-invalid" : "" }} " value="{{old('pemp_pdf') ? old('pemp_pdf') : $formadores->pemp_pdf}}" id="pemp_pdff" placeholder="Link Linkedin">
                        <div class="invalid-feedback">
                            {{ $errors->first('pemp_pdf') }}
                        </div>
                    </div>
                @endif
            </div>



            <div class="form-group col-md-4">
                <label for="cap_pdf" class="col-sm-4 col-form-label">{{__('message.CAP PDF')}}</label>
                @if($formadores->cap_pdf && file_exists(storage_path('app/public/' . $formadores->cap_pdf)))
                    <label for="cap_pdf" class="col-sm-1 col-form-label">
                        <a id="cap_pdf_download" href="{{asset('storage/' . $formadores->cap_pdf)}}" download><i class="fa fa-download"></i> </a> </label>
                    <a id="cap_pdf_privew" target="_blank" href="{{asset('storage/' . $formadores->cap_pdf)}}"  ><i class="fa fa-eye"></i> </a>
                    <div class="col-sm-12">
                        <i class="fas fa-edit" style="font-size: 20px"></i>
                        <input type="file" name='cap_pdf' class="form-control {{$errors->first('cap_pdf') ? "is-invalid" : "" }} " value="{{old('cap_pdf') ? old('cap_pdf') : $formadores->cap_pdf}}" style="opacity: 0 !important" id="cap_pdf" placeholder="Link Linkedin">
                        <div class="invalid-feedback">
                            {{ $errors->first('cap_pdf') }}
                        </div>
                    </div>
                @else
                    <div class="col-sm-12">
                        <input type="file" name='cap_pdf' class="form-control {{$errors->first('cap_pdf') ? "is-invalid" : "" }} " value="{{old('cap_pdf') ? old('cap_pdf') : $formadores->cap_pdf}}" id="cap_pdff" placeholder="Link Linkedin">
                        <div class="invalid-feedback">
                            {{ $errors->first('cap_pdf') }}
                        </div>
                    </div>
                @endif
            </div>
            <div class="form-group col-md-4">
                <label for="fecha" class="col-sm-2 col-form-label">{{__('message.Fecha')}} </label>
                <div class="col-sm-9">
                    {{-- <input type="text" class="form-control" id="title" placeholder="Title"> --}}

                    <input type="date" name="fecha" id="fecha" cols="40" rows="10"
                           class="form-control {{$errors->first('fecha') ? "is-invalid" : "" }} "
                           value="{{old('fecha') ? old('fecha') : $formadores->fecha}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('fecha') }}
                    </div>
                </div>
            </div>
            <div class="col-md-2 d-flex flex-column justify-content-center">
                <label for="estado" class="col-sm-12 col-form-label text-center">{{__('message.Estado')}}</label>
                <label class="switch">
                    <input type="checkbox" name="estado" {{$formadores->estado == 1 ? "checked" : ""}}>
                    <span class="slider round"></span>
                </label>
            </div>

            <div class="form-group col-md-12">

                <div class="col-sm-3">

                    <button type="submit" class="btn btn-info">{{__('message.Update')}}</button>

                </div>

            </div>

        </div>

    </form>
@endsection
@push('scripts')
{{--    <script>--}}
{{--        function show(elem) {--}}
{{--// Get the modal--}}
{{--//             console.log(id);--}}
{{--            var modal = document.getElementById("myModal");--}}

{{--            // Get the image and insert it inside the modal - use its "alt" text as a caption--}}
{{--            var modalImg = document.getElementById("img01");--}}
{{--            var captionText = document.getElementById("caption");--}}

{{--            modal.style.display = "block";--}}
{{--            modalImg.src = $(elem).attr('src');--}}
{{--            // captionText.innerHTML = this.alt;--}}


{{--            // Get the <span> element that closes the modal--}}
{{--            var span = document.getElementsByClassName("close")[0];--}}

{{--            // When the user clicks on <span> (x), close the modal--}}
{{--            span.onclick = function() {--}}
{{--                modal.style.display = "none";--}}
{{--            }--}}
{{--        }--}}

{{--    </script>--}}
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
    $("#dni_img").change(function(){
        readURL1(this);
    });
    //Function to show image before upload

    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#dni_img_download').attr('href', e.target.result).fadeIn('slow');
                document.getElementById('dni_img_privew').style.display = "none";
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
    <script>
        // Prepare the preview for profile picture
        $("#operador_pdf").change(function(){
            readURL1(this);
        });
        //Function to show image before upload

        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#operador_pdf_download').attr('href', e.target.result).fadeIn('slow');
                    document.getElementById('operador_pdf_privew').style.display = "none";
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        // Prepare the preview for profile picture
        $("#cert_empresa_pdf").change(function(){
            readURL2(this);
        });
        //Function to show image before upload

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#cert_empresa_pdf_download').attr('href', e.target.result).fadeIn('slow');
                    document.getElementById('cert_empresa_pdf_privew').style.display = "none";
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        // Prepare the preview for profile picture
        $("#vida_laboral_pdf").change(function(){
            readURL3(this);
        });
        //Function to show image before upload

        function readURL3(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#vida_laboral_pdf_download').attr('href', e.target.result).fadeIn('slow');
                    document.getElementById('vida_laboral_pdf_privew').style.display = "none";
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        // Prepare the preview for profile picture
        $("#cap_pdf").change(function(){
            readURL4(this);
        });
        //Function to show image before upload

        function readURL4(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#cap_pdf_download').attr('href', e.target.result).fadeIn('slow');
                    document.getElementById('cap_pdf_privew').style.display = "none";
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        // Prepare the preview for profile picture
        $("#pemp_pdf").change(function(){
            readURL5(this);
        });
        //Function to show image before upload

        function readURL5(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#pemp_pdf_download').attr('href', e.target.result).fadeIn('slow');
                    document.getElementById('pemp_pdf_privew').style.display = "none";
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        // Prepare the preview for profile picture
        $("#prl_pdf").change(function(){
            readURL6(this);
        });
        //Function to show image before upload

        function readURL6(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#prl_pdf_download').attr('href', e.target.result).fadeIn('slow');
                    document.getElementById('prl_pdf_privew').style.display = "none";
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
