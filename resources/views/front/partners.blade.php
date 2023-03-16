@extends('layouts.front')

@section('content')
    <main id="main">

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">
                <h2 class="title" style="margin-top: 50px;">{{__('message.Our Partner')}}</h2>
                <div class="row">
                    @foreach ($partners as $partners)
                        <div class="col-lg-4 col-md-6 d-flex justify-content-center mt-4" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon-box icon-box2" style="width: 100%;">
                                <div class="imag">
                                    <img src="{{asset('storage/' . $partners->cover)}}" alt="" height="200px">
                                </div>
                                {{--            <h4><a href="{{ route('serviceshow',$service->slug) }}">2100001</a></h4>--}}
                                <p>{{$partners->name}}</p>

                                <hr>

                                <a href="{{ route('partner',$partners->id) }}"> <button>{{__('message.Details')}}</button></a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </section><!-- End Services Section -->

    </main><!-- End #main -->
@endsection
