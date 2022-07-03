<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Cofigruha</title>
  <meta content="{{ $general->meta_desc }}" name="description">
  <meta content="{{ $general->keyword }}" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('storage/'.$general->favicon) }}" rel="icon">
  <link href="{{ asset('storage/'.$general->favicon) }}" rel="apple-touch-icon">

  @yield('meta')

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/vendor/venobox/venobox.css') }}" rel="stylesheet">
  <link href="{{ asset('front/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('front/vendor/remixicon/remixicon.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <!-- <link href="{{ asset('front/css/style.css') }}" rel="stylesheet"> -->
  <link href="{{ asset('front/css/style-anapat.css') }}" rel="stylesheet">

  {{-- Sharethis --}}
  {!! $general->sharethis !!}

  <!-- =======================================================
  * Template Name: Company - v2.1.0
  * Template URL: https://bootstrapmade.com/company-free-html-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top  d-flex">
  <a href="/" class="logo ml-5">
        <img src="{{ asset('admin/img/logo-anpat.png')}}" alt="" class="img-fluid"></a>
    <div class="container d-flex align-items-center">



      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li {{ request()->is('/') ? 'class=active' : '' }}><a href="{{ route('homepage') }}">{{__('message.Home')}}</a></li>

          {{--<li class="drop-down"><a href="">QUIENES SOMOS</a>--}}
            {{--<ul>--}}
              {{--<li ><a href="{{ route('about') }}">Quienes somos</a></li>--}}
              {{--<li><a href="{{ route('partners') }}">Junta directiva</a></li>--}}
            {{--</ul>--}}
          {{--</li>--}}
          <li class="drop-down"><a href="">{{__('message.Formación')}}</a>
            <ul>
              <li ><a href="{{ route('entidades_formadoras') }}">{{__('message.Entidades Formadoras')}}</a></li>
              <li ><a href="{{ route('cursos') }}">{{__('message.Cursos')}}</a></li>
              <li ><a href="{{ route('carnets') }}">{{__('message.Consulta de carnet')}}</a></li>
            </ul>
          </li>
          {{--<li class="drop-down"><a href="">{{__('message.Documentación')}}</a>--}}
            {{--<ul>--}}
              {{--<li class="drop-down"><a href="">{{__('message.Cosas didácticas')}}</a>--}}
            {{--<ul>--}}
              {{--<li ><a href="{{ route('category',"guides") }}">{{__('message.Guías')}}</a></li>--}}
              {{--<li ><a href="{{ route('category',"manuals") }}">{{__('message.Manuales')}}</a></li>--}}
            {{--</ul>--}}

              {{--</li>--}}
              {{--<li class="drop-down"><a href="">{{__('message.Forms')}}</a>--}}
            {{--<ul>--}}
              {{--<li ><a href="{{ route('category',"inscription") }}">{{__('message.Inscripción')}}</a></li>--}}
              {{--<li ><a href="{{ route('category',"come-down") }}">{{__('message.Baja')}} </a></li>--}}
            {{--</ul>--}}

              {{--</li>--}}
              {{--<li ><a href="{{ route('category',"others") }}">{{__('message.Otras')}}</a></li>--}}
            {{--</ul>--}}
          {{--</li>--}}
          {{--<li ><a href="{{ route('category',"news") }}">{{__('message.Noticias')}}</a></li>--}}
          <li><a href="{{ route('contact') }}">{{__('message.Contacto')}}</a></li>
        </ul>
      </nav><!-- .nav-menu -->

      <div class="header-social-links">
        <a href="{{ route('login') }}"><i class="icofont-ui-user"> Cuenta</i></a>
      </div>

    </div>
  </header><!-- End Header -->

  @yield('content')

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 footer-links">
                <img src="{{ asset('admin/img/logo-anpat.png')}}" alt="" width="70%">
            </div>
          <div class="col-lg-3 col-md-6 footer-links">
          <h3>{{__('message.Company')}}</h3>
            <ul>
              <li> {{$general->title}}</li>
              <li>   {{$general->address1}}.</li>
              <li> {{$general->address2}}</li>
              <li> <strong>Tel:</strong> {{$general->phone}} /  <strong> FAX:</strong> {{$general->twitter}}</li>
              <li> <a href="">{{$general->email}}</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 footer-links">
            <h3>{{__('message.Site Map')}}</h3>
            <ul>
              <li> <a href="{{ route('homepage') }}">{{__('message.Home')}}</a></li>
              <li> <a href="{{ route('about') }}">{{__('message.About')}}</a></li>
              <li><a href="{{ route('contact') }}">{{__('message.Contact')}}</a></li>
              <li> <a href="{{ route('blog') }}">{{__('message.blog')}}</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6 footer-links">
            <h3>Enlaces de interés</h3>
            <ul>
              <li> <a href="{{ route('entidades_formadoras') }}">{{__('message.Training Entity')}}</a></li>
              <li> <a href="{{ route('partners') }}">{{__('message.Partner')}}</a></li>
              <li><a href="{{ route('cursos') }}">{{__('message.Course')}}</a></li>
              <li> <a href="{{ route('carnets') }}">{{__('message.Card')}}</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>
    <div class="container d-md-flex py-4">
      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
        Copyright © 2022 Cofigruha Todos los derechos reservados.
        </div>
      </div>
      <!-- <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="{{ $general->twitter }}" target="_blank" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="{{ $general->facebook }}" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="{{ $general->instagram }}" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="{{ $general->linkedin }}" target="_blank" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div> -->
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('front/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('front/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('front/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('front/vendor/jquery-sticky/jquery.sticky.js') }}"></script>
  <script src="{{ asset('front/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('front/vendor/venobox/venobox.min.js') }}"></script>
  <script src="{{ asset('front/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('front/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('front/vendor/aos/aos.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('front/js/main.js') }}"></script>

  {!! $general->tawkto !!}

  @stack('scripts')

</body>

</html>
