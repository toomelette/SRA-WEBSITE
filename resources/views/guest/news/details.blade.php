
@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area">
    <div class="container">
        <div class="row">
          <div class="col-lg-8">
            {{ Breadcrumbs::render('news_details', $news) }}
          </div>
          <div class="col-lg-8 posts-list">
            <div class="single-post row">
              <div class="col-lg-12">
                  <div class="feature-img">
                      <img class="img-fluid" src="{{ route('guest.news.view_img',$news->slug) }}" alt="">
                  </div>
              </div>
              <div class="col-lg-12 col-md-12 blog_details">
                  <h2>{{ $news->title }}</h2>
                  <p class="excert">{!! $news->content !!}</p>
                  @if ($news->type == "FILE")
                    <a href="{{ route('guest.news.view_file', $news->slug) }}" class="blog_btn" target="__blank">View Document</a>  
                  @else
                    <a href="{{ $news->url }}" class="blog_btn" target="__blank">View Site</a>
                  @endif
              </div>
          </div>
            
          </div>

          @include('layouts.guest-sidebar')

        </div>
    </div>
  </section>





@endsection


