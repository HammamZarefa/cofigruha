@extends('layouts.front')

@section('content')
    <main id="main">

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">
                <h2 class="title" style="margin-top: 50px;">Carnets</h2>
                <form action="{{ route('searchcarnet') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">

                            <label for="numero" class="col-sm-2 col-form-label">Numero</label>

                            <div class="col-sm-9">
                                <input type="text" name='numero' class="form-control {{$errors->first('numero') ? "is-invalid" : "" }} " value="{{old('numero')}}" id="numero" placeholder="Numero">
                                <div class="invalid-feedback">
                                    {{ $errors->first('numero') }}
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">

                        <label for="numero" class="col-sm-2 col-form-label">Buscar</label>

                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-info">{{__('message.Buscar')}}</button>
                        </div>
                    </div>
                        <div class="form-group col-md-12" style="margin-left: 25px;">
                            <span>{{$test}}</span>
                        </div>
                    </div>
                </form>
{{--                <div class="row">--}}
{{--                    @foreach ($carnets as $carnets)--}}
{{--                        <div class="col-lg-4 col-md-6 d-flex justify-content-center mt-4" data-aos="zoom-in" data-aos-delay="100">--}}
{{--                            <div class="icon-box icon-box2" style="width: 100%;">--}}
{{--                                <div class="imag">--}}
{{--                                    <img src="{{asset('storage/' . $carnets->foto)}}" alt="" height="200px">--}}
{{--                                </div>--}}
{{--                                --}}{{--            <h4><a href="{{ route('serviceshow',$service->slug) }}">2100001</a></h4>--}}
{{--                                <p>{{$carnets->numero}}</p>--}}
{{--                                <p>--}}
{{--                                    @foreach($operadores as $operadores)--}}
{{--                                    {{$carnets->operador == $operadores->id ? "$operadores->nombre $operadores->apellidos" : "" }}--}}
{{--                                    @endforeach--}}
{{--                                </p>--}}
{{--                                <hr>--}}

{{--                                <a href="{{ route('carnet',$carnets->id) }}"> <button>Details</button></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}

            </div>
        </section><!-- End Services Section -->

    </main><!-- End #main -->
@endsection
