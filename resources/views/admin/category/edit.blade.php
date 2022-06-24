@extends('layouts.admin')

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.category.update',$category->id) }}" method="POST">
    @csrf

    <div class="container">

        <div class="form-group ml-5">

            <label for="name" class="col-sm-2 col-form-label">{{__('message.Name')}}</label>

            <div class="col-sm-7">

                <input type="text" name='name' class="form-control {{$errors->first('name') ? "is-invalid" : "" }} " value="{{old('name') ? old('name') : $category->name}}" id="name" placeholder="{{__('message.Name')}}">

                <div class="invalid-feedback">
                    {{ $errors->first('name') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="keyword" class="col-sm-2 col-form-label">{{__('message.Palabra clave')}}</label>

            <div class="col-sm-7">

                <input type="text" name='keyword' class="form-control {{$errors->first('keyword') ? "is-invalid" : "" }} " value="{{old('keyword') ? old('keyword') : $category->keyword}}" id="keyword" placeholder="{{__('message.Palabra clave')}}">

                <div class="invalid-feedback">
                    {{ $errors->first('keyword') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="meta_desc" class="col-sm-2 col-form-label">{{__('message.Meta Desc')}}</label>

            <div class="col-sm-7">

                <input type="text" name='meta_desc' class="form-control {{$errors->first('meta_desc') ? "is-invalid" : "" }} " value="{{old('meta_desc') ? old('meta_desc') : $category->meta_desc}}" id="meta_desc" placeholder="{{__('message.Meta Desc')}}">

                <div class="invalid-feedback">
                    {{ $errors->first('meta_desc') }}
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
