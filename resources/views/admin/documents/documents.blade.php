@extends('layouts.admin')

@section('title')
    Blog -
@endsection

@section('content')
    <main id="main">
        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
            <div class="container">
                <h2 class="title">{{$category}}</h2>
                <div class="row" style="margin-top: 50px;">
                    <div class="col-lg-12 entries">
                        <div class="sidebar-item search-form ">
                            <form action="{{ route("admin.documents.search") }}" method="GET">
                                <input type="text" name="query" placeholder="{{__('message.Search')}}">
                                <button type="submit"><i class="icofont-search"></i></button>
                            </form>
                        </div><!-- End sidebar search formn-->
                        <div class="row">
                                @forelse($documents as $post)
                                    <div class="col-md-4">
                                        <article class="entry" data-aos="fade-up">
                                            <div class="entry-img blog-image">
                                                <img src="{{asset('storage/' . $post->cover)}}" alt="{{ $post->title }}" class="img-fluid">
                                            </div>
                                            <h2 class="entry-title">
                                                <a href="{{ route('admin.document',$post->slug) }}">{{ $post->title }}</a>
                                            </h2>
                                            <div class="entry-meta">
                                                <ul>
                                                    <li class="d-flex align-items-center"><i class="icofont-user"></i> <a
                                                                href="{{route('admin.document',$post->slug)}}">{{ $post->user->name }}</a>
                                                    </li>
                                                    <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i>
                                                        <a href="{{route('admin.document',$post->slug)}}">
                                                            <time
                                                                    datetime="2020-01-01">{{ Carbon\Carbon::parse($post->created_at)->format("d/m/Y") }}</time>
                                                        </a></li>
                                                    <li class="d-flex align-items-center"><i class="icofont-eye"></i> <a
                                                                href="{{route('admin.document',$post->slug)}}">{{ $post->views }} {{__('message.Views')}}</a>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="entry-content">
                                                <p>
                                                    {{ Str::limit( strip_tags( $post->body ), 250 ) }}
                                                </p>
                                                <div class="read-more">
                                                    <a href="{{ route('admin.document',$post->slug) }}">{{__('message.Read More')}}</a>
                                                </div>
                                            </div>

                                        </article><!-- End blog entry -->
                                    </div>
                                @empty

                                @endforelse
                        </div>

                        @if($documents != null)
                            <div class="blog-pagination">
                                <ul class="justify-content-center">
                                    {{ $documents->links() }}
                                </ul>
                            </div>
                        @endif
                    </div>
                    <!-- End blog entries list -->


                </div>

            </div>
        </section><!-- End Blog Section -->

    </main><!-- End #main -->
@endsection
