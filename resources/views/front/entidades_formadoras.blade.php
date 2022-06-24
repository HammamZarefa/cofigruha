@extends('layouts.front')

@section('content')
<main id="main">

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">
     <div class="d-flex justify-content-between flex-wrap">
        <h2 class="title" style="margin-top: 50px;">{{__('message.Entidades Formadoras')}}</h2>
      <div class="search">
      <input type="text" placeholder="Search">
        <i class="icofont-search"></i>
      </div>
        </div>
        <div class="row">
          @foreach ($entidadesFormadores as $entidadesFormadores)
          <div class="col-lg-4 col-md-6 d-flex justify-content-center mt-4" data-aos="zoom-in" data-aos-delay="100">
          <div class="icon-box icon-box2" style="width: 100%;">
            <div class="imag">
              <img src="{{asset('storage/' . $entidadesFormadores->logo)}}" alt="" height="200px">
            </div>
{{--            <h4><a href="{{ route('serviceshow',$service->slug) }}">2100001</a></h4>--}}
            <p>{{$entidadesFormadores->nombre}}</p>
              <p>{{$entidadesFormadores->direccion}}</p>
              <hr>
              <p>{{__('message.WEB')}}: <a href="{{$entidadesFormadores->web}}" > {{$entidadesFormadores->web}}</a></p>
              <hr>
              <p>{{__('message.Mail')}}: <a href="mailto:{{$entidadesFormadores->mail}}" > {{$entidadesFormadores->mail}}</a></p>
           <a href="{{ route('entidade_formadora',$entidadesFormadores->id) }}"> <button>{{__('message.Details')}}</button></a>
          </div>
        </div>
        @endforeach
        </div>

      </div>
    </section><!-- End Services Section -->

  </main><!-- End #main -->
@endsection
