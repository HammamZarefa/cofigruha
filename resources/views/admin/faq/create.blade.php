@extends('layouts.admin')

@section('content')

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="{{ route('admin.faq.store') }}" method="POST">
    @csrf

    <div class="container">

        <div class="form-group ml-5">

            <label for="tipo_de_pempa" class="col-sm-2 col-form-label">{{__('message.Tipo de PEMPA')}}</label>

            <div class="col-sm-7">

                <input type="text" name='tipo_de_pempa' class="form-control {{$errors->first('tipo_de_pempa') ? "is-invalid" : "" }} " value="{{old('tipo_de_pempa')}}" id="tipo_de_pempa" placeholder="{{__('message.Tipo de PEMPA')}}">

                <div class="invalid-feedback">
                    {{ $errors->first('tipo_de_pempa') }}
                </div>

            </div>

        </div>

        <div class="form-group ml-5">

            <label for="descripción" class="col-sm-2 col-form-label">{{__('message.desc')}}</label>

            <div class="col-sm-7">

                <textarea name="descripción" class="form-control {{$errors->first('descripción') ? "is-invalid" : "" }} "  id="" cols="30" rows="10">{{old('descripción')}}</textarea>
                <div class="invalid-feedback">
                    {{ $errors->first('descripción') }}
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
