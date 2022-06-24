@extends('layouts.front')

@section('content')
<main id="main">

    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
      <div class="container" data-aos="fade-up">
      <h2 class="title" style="margin-top: 50px;">{{__('message.Cursos')}}</h2>
        <div class="row">
          @foreach ($cursos as $cursos)
          <div class="col-lg-3 col-md-6 d-flex justify-content-center mt-4" data-aos="zoom-in" data-aos-delay="100">
          <div class="icon-box">
            <h4><a href="{{ route('curso',$cursos->curso) }}">{{$cursos->codigo}}</a></h4>
            <p>
                @foreach($entidades as $entidade)
                {{$cursos->entidad == $entidade->id ? $entidade->nombre : ""}}
{{--                {{$entidade->id}}--}}
                @endforeach
            </p>
              <p>
                  {{$cursos->ciudad}} : {{$cursos->direccion}}
              </p>
              <p>
                  {{$cursos->fecha_inicio}}
              </p>
           <a href="{{ route('curso',$cursos->curso) }}"> <button>{{__('message.Details')}}</button></a>
          </div>
        </div>
        @endforeach
        </div>

      </div>
    </section><!-- End Services Section -->

  </main><!-- End #main -->
@endsection
