@extends('layouts.admin')


@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <form action="{{ route('admin.post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="form-group">
                <div class="picture-container">
                    <span class="maxsize"> El tamaño máximo de archivo subido no debe superar 2 MB</span>
                    <div class="picture">
                        <img src="{{asset('storage/' . $post->cover)}}" class="picture-src" id="wizardPicturePreview"
                             height="200px" width="400px" title=""/>
                        <input type="file" id="wizard-picture" name="cover"
                               class="form-control {{$errors->first('cover') ? "is-invalid" : "" }} ">
                        <div class="invalid-feedback">
                            {{ $errors->first('cover') }}
                        </div>
                    </div>
                    <h6>{{__('message.Cover')}}</h6>
                </div>
            </div>
            <div class="form-group ml-5">
                <label for="title" class="col-sm-2 col-form-label">{{__('message.Title')}}</label>
                <div class="col-sm-7">
                    <input type="text" name='title'
                           class="form-control {{$errors->first('title') ? "is-invalid" : "" }} "
                           value="{{old('title') ? old('title') : $post->title}}" id="title"
                           placeholder="{{__('message.Title')}}">

                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                </div>
            </div>
            <div class="form-group ml-5">
                <label for="category" class="col-sm-2 col-form-label">{{__('message.Categoría')}}</label>
                <div class="col-sm-7">
                    <select name='category' class="form-control {{$errors->first('category') ? "is-invalid" : "" }} "
                            id="category">
                        <option disabled selected>{{__('message.Choose One!')}}</option>
                        @foreach ($categories as $category)
                            <option
                                {{ $category->id == $post->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                </div>
            </div>
            <div class="form-group ml-5">
                <label for="tags" class="col-sm-2 col-form-label">{{__('message.Tags')}}</label>
                <div class="col-sm-7">
                    <select name='tags[]' class="form-control {{$errors->first('tags') ? "is-invalid" : "" }} select2"
                            id="tags" multiple>
                        @foreach ($post->tags as $tag)
                            <option selected value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach

                        @foreach ($tags as $tags)
                            <option value="{{ $tags->id }}">{{ $tags->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('tags') }}
                    </div>
                </div>
            </div>
            <div class="form-group ml-5">
                <label for="body" class="col-sm-2 col-form-label">{{__('message.Description')}}</label>
                <div class="col-sm-8">
                    <textarea name="body" class="form-control {{$errors->first('body') ? "is-invalid" : "" }} "
                              id="summernote" cols="30" rows="10">{{old('body') ? old('body') : $post->body}}</textarea>
                    <div class="invalid-feedback">
                        {{ $errors->first('body') }}
                    </div>
                </div>
            </div>
            <div class="form-group ml-5">
                <label for="keyword" class="col-sm-2 col-form-label">{{__('message.Palabra clave')}}</label>
                <div class="col-sm-7">
                    <input type="text" name='keyword'
                           class="form-control {{$errors->first('keyword') ? "is-invalid" : "" }} "
                           value="{{old('keyword') ? old('keyword') : $post->keyword}}" id="keyword"
                           placeholder="{{__('message.Palabra clave')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('keyword') }}
                    </div>
                </div>
            </div>
            <div class="form-group ml-5">
                <label for="meta_desc" class="col-sm-2 col-form-label">{{__('message.Meta Desc')}}</label>
                <div class="col-sm-7">
                    <input type="text" name='meta_desc'
                           class="form-control {{$errors->first('meta_desc') ? "is-invalid" : "" }} "
                           value="{{old('meta_desc') ? old('meta_desc') : $post->meta_desc}}" id="meta_desc"
                           placeholder="{{__('message.Meta Desc')}}">
                    <div class="invalid-feedback">
                        {{ $errors->first('meta_desc') }}
                    </div>
                </div>
            </div>

            <div class="form-group ml-5">
                <label for="status" class="col-sm-2 col-form-label">{{__('message.Status')}}</label>
                <div class="col-sm-7">
                    <select name='status' class="form-control {{$errors->first('status') ? "is-invalid" : "" }} "
                            id="status">
                        <option
                            {{$post->status == 'PUBLISH' ? 'selected' : ''}} value="PUBLISH">{{__('message.PUBLISH')}}</option>
                        <option
                            {{$post->status == 'DRAFT' ? 'selected' : ''}} value="DRAFT">{{__('message.DRAFT')}}</option>
                    </select>
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                </div>
            </div>
            <div class="form-group ml-5">
                <div class="col-md-2 d-flex flex-column justify-content-center">
                    <label for="public" class="col-sm-12 col-form-label text-center">{{__('message.Publico')}}</label>
                    <label class="switch">
                        <input type="hidden" name="public" value=0>
                        <input type="checkbox" name="public" {{$post->public == 1 ? "checked" : ""}}>
                        <span class="slider round"></span>
                    </label>
                </div>
            </div>
            <div class="form-group ml-5">

                <div class="col-sm-3">

                    <button type="submit" class="btn btn-primary">{{__('message.Update')}}</button>

                </div>

            </div>

        </div>

    </form>
@endsection

@push('scripts')

    <script>
        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Prepare the preview for profile picture
        $("#wizard-picture").change(function () {
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

        var HelloButton = function (context) {
            var ui = $.summernote.ui;

            // create button
            var button = ui.button({
                contents: '<i class="fa fa-file-pdf-o" id="btnImportData"/> PDF',
                tooltip: 'hello',
            });

            return button.render();   // return button as jquery object
        }

        $('#summernote').summernote({
            height: 500,
            focus: true,
            toolbar: [

                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']] ,
                ['HelloBytton', ['parametros']],
            ],
            buttons: {
                parametros: HelloButton,
            },
            hint: {
                match: /#(\w{2,})$/,
                search: function(keyword, callback) {
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: 'some_url'
                    }).then(function (data) {
                        callback(data.items);
                    });
                },
                template: function(item) {
                    return '[<strong>' + item.slug + '</strong>] ' + item.name;
                }
            }
        });

        $("#btnImportData").on("click",function (e){
            var fileDialog = $('<input type="file" name="file" id="file">');
            fileDialog.click();
            fileDialog.on("change",onFileSelected);
        });

        var onFileSelected = function(e){
            var files = $(this)[0].files;
            var data = new FormData();
            data.append("file", files[0]);
            data.append('_token',CSRF_TOKEN);
            $.ajax({
                url: "{{url('/api/uploadpdf')}}",
                cache: false,
                contentType: false,
                processData: false,
                data: data,
                type: "post",
                success: function (path) {
                    if (path.status == 1) {
                        body='<object data="'+path.path+'" type="application/pdf" width="750px" height="750px">'+
                            '<embed src="'+path.path+'" type="application/pdf"> </object>'
                        $('#summernote').summernote("code", body);
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        };

    </script>
@endpush
