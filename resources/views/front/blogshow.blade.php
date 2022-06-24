@extends('layouts.front')

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
    <section id="blog" class="blog">
      <div class="container">
      <h2 class="title">{{__('message.Blog show')}}</h2>
        <div class="row" style="margin-top: 50px;">
        <div class="col-lg-4">

<div class="sidebar">
  <h3 class="sidebar-title">{{__('message.categorías')}}</h3>
  <div class="sidebar-item categories">
    <ul>
      @foreach ($categories as $category)
      <li><a href="{{ route('category',$category->slug) }}">{{ $category->name }} <span>({{ $category->count() }})</span></a></li>
      @endforeach
    </ul>

  </div><!-- End sidebar categories-->

  <h3 class="sidebar-title">{{__('message.recent post')}}</h3>
  <div class="sidebar-item recent-posts">

    @foreach ($recent as $recent)
    <div class="post-item clearfix">

      <h4><a href="{{route('blogshow',$recent->slug)}}">{{ $recent->title }}</a></h4>
      <time datetime="2020-01-01">{{ Carbon\Carbon::parse($recent->created_at)->format("d F, Y") }}</time>
    </div>
    @endforeach

  </div><!-- End sidebar recent posts-->

  <h3 class="sidebar-title">{{__('message.tags')}}</h3>
  <div class="sidebar-item tags">
    <ul>
      @foreach ($tags as $tag)
       <li><a href="{{ route('tag',$tag->slug) }}">{{ $tag->name }}</a></li>
      @endforeach
    </ul>

  </div><!-- End sidebar tags-->

</div><!-- End sidebar -->

</div><!-- End blog sidebar -->
          <div class="col-lg-8 entries">

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

              <!-- <div class="entry-footer clearfix">
                <div >
                  <i class="icofont-folder"></i>
                  <ul class="cats">
                    <li><a href="{{ route('category',$post->category->slug) }}">{{ $post->category->name }}</a></li>
                  </ul>
                  </div>
                  <div >
                  <i class="icofont-tags"></i>
                  <ul class="tags">
                    @foreach ($tags as $tag)
                   <li><a href="{{ route('tag',$tag->slug) }}">{{ $tag->name }}</a></li>
                    @endforeach
                  </ul>

                  </div>
              </div> -->

            </article><!-- End blog entry -->

            <div class="blog-comments" data-aos="fade-up">

              <h4>{{__('message.Leave a Comment')}} </h4>
              <p>{{__('message.Your email address will not be published. Required fields are marked')}}</p>
              <textarea placeholder="{{__('message.type here')}}" cols="20" rows="4"></textarea>
              <div class="val-info" >
                <input type="text" placeholder="{{__('message.Name')}}">
                <input type="email" placeholder="{{__('message.Mail')}}">
                <input type="text" placeholder="{{__('message.WEB')}}">
              </div>
              <div class="save-info" >
                <input type="checkbox">
                <p>{{__('message.Save my name, email, and website in this browser for the next time I comment')}}.</p>
              </div>
              <div class="send">
                <button>{{__('message.Post Comment')}}    <i class="icofont-send-mail"></i></button>

              </div>

            </div><!-- End blog comments -->

          </div><!-- End blog entries list -->


        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->
@endsection

@push('scripts')
    {!! $general->disqus !!}
@endpush
