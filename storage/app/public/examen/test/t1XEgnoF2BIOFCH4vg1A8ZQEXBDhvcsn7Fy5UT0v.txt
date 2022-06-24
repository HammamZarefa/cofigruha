@extends('layouts.front')

@section('meta')
<!-- Primary Meta Tags -->
<meta name="description" content="{{ $general->meta_desc }}">
<meta name="keywords" content="{{ $general->keyword }}">
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="127.0.0.1:8000">
<meta property="og:title" content="{{ $general->title }}">
<meta property="og:description" content="{{ $general->meta_desc }}">
<meta property="og:image" content="{{ asset('storage/'.$general->favicon) }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="127.0.0.1:8000">
<meta property="twitter:title" content="{{ $general->title }}">
<meta property="twitter:description" content="{{ $general->meta_desc }}">
<meta property="twitter:image" content="{{ asset('storage/'.$general->favicon) }}">

@endsection

@section('content')
    <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

      <div class="carousel-inner" role="listbox">

        @foreach ($banner as $key => $banner)

        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}" style="background-image: url(http://anapat.e-dalely.com/wp-content/uploads/2021/10/EstudioAlquiler_ANAPAT_2020-e1634196672288.jpg);">
          <div class="carousel-container">
           
          </div>
        </div>

        @endforeach


      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
  </section><!-- End Hero -->

  <main id="main">

 <!-- ======= about us Section ======= -->
 <section id="portfolio" class="portfolio">
      <div class="container">

      <div class="section-title">
      <h2>Types of MEWPs</h2>
        </div>

        <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="" class="filter-active">PAV</li>
           
              <li data-filter="">Mast Lifts</li>
              <li data-filter="">Scissor Lifts</li>
              <li data-filter="">Articulating Boom Lift</li>
              <li data-filter="">Stick Boom Lifts</li>
              <li data-filter="">Track Mounts</li>
              <li data-filter="">Truck Mounts</li>
            </ul>
          </div>
          <transition-group class="kinds" name="kinds" >
            <div>
              <h2 class="port-title">Reach height: <span>3.60m – 5.10m</span></h2>
              <h3 class="port-title">IPAF category: <span>PAV</span></h3>
              <p>
              Push around vertical platforms, often called PAVs or personnel lifts, are a small type of mobile vertical lift with scissor operation. PAVs are ideal for indoor low level access making them suitable for smaller warehouses and factories, replacing ladders and steps that are not recommended for safe access.
              </p>
              <p>
              They are compact and lightweight, which allows them to navigate aisles, doorways and narrow corners, and can be easily moved from location to location, including between floors in multistory buildings.
              </p>
              <p>
              PAVs meet the requirements of the Work at Height regulations by ensuring the safety of workers on the platform with a low entry point.
              </p>
            </div>
          </transition-group>
      </div>
    </section>
    <!-- End about us Section -->
    <!-- ======= about us Section ======= -->
 <section id="portfolio" class="portfolio about">
      <div class="container">

      <div class="section-title">
          <h2 >Inform About ANAPAT Training</h2>
        </div>

        <div class="row">
        <ul class="hList">
  <li>
    <a href="#click" class="menu">
      <h2 class="menu-title menu-title_2nd">about ANAPAT</h2>
      <ul class="menu-dropdown col-md-3 col-sm-12" >
        <li>about ANAPAT</li>
        <li>Characteristics</li>
        <li>certifications</li>
      </ul>
    </a>
  </li>
</ul>  

          
            <div class="col-md-9 col-sm-12 info" data-aos="fade-up">
        <h2>Reach height: <span>3.60m – 5.10m</span></h2>
     
        <p>
        Push around vertical platforms, often called PAVs or personnel lifts, are a small type of mobile vertical lift with scissor operation. PAVs are ideal for indoor low level access making them suitable for smaller warehouses and factories, replacing ladders and steps that are not recommended for safe access.
        They are compact and lightweight, which allows them to navigate aisles, doorways and narrow corners, and can be easily moved from location to location, including between floors in multistory buildings.
        PAVs meet the requirements of the Work at Height regulations by ensuring the safety of workers on the platform with a low entry point.
        </p>
      <button>show more</button>
        </div>
          </div>
     
      </div>
    </section>
    <!-- End about us Section -->
    <!-- ======= Our Clients Section ======= -->
    <section id="clients" class="clients">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Our Partner</h2>
        </div>

        <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">

        
          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <a href=" target="_blank" rel="noopener noreferrer">
                <img src="http://anapat.e-dalely.com/wp-content/uploads/2021/11/jlg-logo-sims-crane.jpg" class="img-fluid" alt="">
              </a>
            </div>
          </div>
        
          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <a href=" target="_blank" rel="noopener noreferrer">
                <img src="http://anapat.e-dalely.com/wp-content/uploads/2021/10/Genie_BluBlk_2-e1634564636678.jpg" class="img-fluid" alt="">
              </a>
            </div>
          </div>
          <div class="col-lg-3 col-md-4 col-6">
            <div class="client-logo">
              <a href=" target="_blank" rel="noopener noreferrer">
                <img src="http://anapat.e-dalely.com/wp-content/uploads/2021/10/HAULOTTE_Logo2017-2.jpg" class="img-fluid" alt="">
              </a>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Our Clients Section -->

  </main><!-- End #main -->
@endsection