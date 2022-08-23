@extends('layouts.admin')

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.link.update',$link->id) }}" method="POST">
    @csrf

    <div class="container">

        <div class="form-group ml-5">

            <label for="título" class="col-sm-2 col-form-label">{{__('message.Title')}}</label>

            <div class="col-sm-7">

                <input type="text" name='título' class="form-control {{$errors->first('título') ? "is-invalid" : "" }} " value="{{old('título') ? old('título') : $link->title}}" id="título" placeholder="{{__('message.Title')}}">

                <div class="invalid-feedback">
                    {{ $errors->first('título') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="descripción" class="col-sm-2 col-form-label">{{__('message.desc')}}</label>

            <div class="col-sm-7">

                <textarea name="descripción" class="form-control {{$errors->first('descripción') ? "is-invalid" : "" }} "  id="summernote" cols="30" rows="10">{{old('descripción') ? old('descripción') : $link->text}}</textarea>
                <div class="invalid-feedback">
                    {{ $errors->first('descripción') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="enlace" class="col-sm-2 col-form-label">{{__('message.Link')}}</label>

            <div class="col-sm-7">

                <input type="text" name='enlace' class="form-control {{$errors->first('enlace') ? "is-invalid" : "" }} " value="{{old('enlace') ? old('enlace') : $link->slug}}" id="enlace" placeholder="{{__('message.Link')}}">

                <div class="invalid-feedback">
                    {{ $errors->first('enlace') }}
                </div>

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
