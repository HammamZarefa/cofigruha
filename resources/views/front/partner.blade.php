@extends('layouts.front')

@section('content')
    <main id="main">

        <!-- ======= Testimonials Section ======= -->
        <section class="courses">
            <div class="container">
                <h2 class="title" style="margin: 50px 0;"></h2>
                <div class="row">

                    <div class="d-flex justify-content-center contain-card">
                        <div class="card">


                            <div class="d-flex align-items-center">

                                <img class="image" src="{{asset('storage/' . $partner->cover)}}" alt=""></div>
                            <hr/>
                            <br>
                            <h2 class="align-self-lg-center">{{$partner->name}}</h2>
{{--                            <p>Web: <a href="{{$partner->link}}" > {{$partner->link}}</a></p>--}}

{{--                            <p></p>--}}
                            {{--              <div class="d-flex justify-content-center">--}}
                            {{--              <a href="">Show Assistants</a>--}}
                            {{--              <span class="ml-3 mr-3">or</span>--}}
                            {{--              <a href="">Download</a>--}}
                            {{--              </div>--}}
{{--                            <p></p>--}}
{{--                            <button><a href="{{$partner->link}}" style="color: #000000;"> Web</a></button>--}}
                        </div>
                    </div>

                </div>
            </div>
        </section><!-- End Testimonials Section -->

    </main><!-- End #main -->
@endsection
