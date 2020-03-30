
@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area">
    <div class="container">
        <div class="row">
          <div class="col-lg-8">
            {{ Breadcrumbs::render('news') }}
          </div>
          <div class="col-lg-8">
            <div class="blog_left_sidebar">

              @foreach ($news_list as $data)
                <article class="row blog_item" style="padding-bottom:50px;">
                  <div class="col-md-12">
                    <div class="blog_post">
                      <img src="{{ route('guest.news.view_img', $data->slug) }}" alt="">
                      <div class="blog_details">
                        <a href="{{ route('guest.news.details', $data->slug) }}">
                            <h2>{{ $data->title }}</h2>
                        </a>
                        <span>{{ __dataType::date_parse($data->created_at, 'F d, Y') }}</span>
                        <p>{!! Str::limit($data->content, 300 , ' ...') !!}</p>
                        <a href="{{ route('guest.news.details', $data->slug) }}" class="blog_btn">Read More</a>
                        @if ($data->type == "FILE")
                          <a href="{{ route('guest.news.view_file', $data->slug) }}" class="blog_btn" target="__blank">View Document</a>  
                        @else
                          <a href="{{ $data->url }}" class="blog_btn" target="__blank">View Site</a>
                        @endif
                      </div>
                    </div>
                    </div>
                </article>
              @endforeach

            {!! $news_list->appends([])->render('vendor.pagination.bootstrap-4')!!}
            
            </div>
          </div>

          @include('layouts.guest-sidebar')

        </div>
    </div>
  </section>





@endsection


