@extends('layouts.admin')

@section('title')
{{ $post->title }} -
@endsection
@section('meta')

<!-- Primary Meta Tags -->
<meta name="title" content="{{ $post->title }}">
<meta name="description" content="{{ $post->meta_desc }}">
<meta name='keywords' content='{{ $post->keyword }}' />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="127.0.0.1:8000/blog/{{ $post->slug }}">
<meta property="og:title" content="{{ $post->title }}">
<meta property="og:description" content="{{ $post->meta_desc }}">
<meta property="og:image" content="{{ asset('storage/'.$post->cover) }}">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="127.0.0.1:8000/blog/{{ $post->slug }}">
<meta property="twitter:title" content="{{ $post->title }}">
<meta property="twitter:description" content="{{ $post->meta_desc }}">
<meta property="twitter:image" content="{{ asset('storage/'.$post->cover) }}">
@endsection

@section('content')
<main id="main">
    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog" style="margin-top: 50px;">
      <div class="container">
      <h2 class="title" style="text-align: center">{{ $post->title }}</h2>
        <div class="row" style="margin-top: 25px;">
          <div class="col-lg-12 entries">
            <article class="entry entry-single" data-aos="fade-up">
                <div class="row">
                    <div class="col-md-6">
                        <div class="entry-img">
                            <img src="{{asset('storage/' . $post->cover)}}" alt="{{ $post->title }}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="entry-meta">
                            <ul style="display: block">
                                <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="{{route('blogshow',$post->slug)}}">{{ $post->user->name }}</a></li>
                                <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="{{route('blogshow',$post->slug)}}"><time datetime="2020-01-01">{{ Carbon\Carbon::parse($post->created_at)->format("d F, Y") }}</time></a></li>
                                <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="{{ URL::current()}}#disqus_thread">{{__('message.Comentarios')}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
              <h2 class="entry-title">
                <a href="{{route('blogshow',$post->slug)}}">{{ $post->title }}</a>
              </h2>
              <div class="entry-content">
                <p>
                  {!! $post->body !!}
                </p>
              </div>
            </article><!-- End blog entry -->
          </div><!-- End blog entries list -->
        </div>
      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->
@endsection

