
@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area content-margin">
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-9">
            {{ Breadcrumbs::render('announcement_details', $announcement) }}
          </div>
          <div class="col-lg-9 posts-list">
            <div class="single-post row">
              <div class="col-lg-12 col-md-12 blog_details">
                  <h2>{{ $announcement->title }}</h2>
                  <span>{{ __dataType::date_parse($announcement->created_at, 'F d, Y') }}</span>
                  <p class="excert">{!! $announcement->content !!}</p>
                  @if ($announcement->type == "FILE")
                    <a href="{{ route('guest.announcement.view_file', $announcement->slug) }}" class="blog_btn" target="__blank">View Document</a>  
                  @else
                    <a href="{{ $announcement->url }}" class="blog_btn" target="__blank">View Site</a>
                  @endif
              </div>
          </div>
            
          </div>

          @include('layouts.guest-sidebar')

        </div>
    </div>
  </section>





@endsection


