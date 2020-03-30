
@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area">
    <div class="container">
        <div class="row">
          <div class="col-lg-8">
            {{ Breadcrumbs::render('announcement') }}
          </div>
          <div class="col-lg-8">
            <div class="blog_left_sidebar">

              @foreach ($announcement_list as $data)
                <article class="row blog_item" style="padding-bottom:50px;">
                    <div class="col-md-12">
                        <div class="blog_post">
                            <div class="blog_details">
                                <a href="{{ route('guest.announcement.details', $data->slug) }}">
                                    <h2>{{ $data->title }}</h2>
                                </a>
                                <span>{{ __dataType::date_parse($data->created_at, 'F d, Y') }}</span>
                                <p>{!! Str::limit($data->content, 300 , ' ...') !!}</p>
                                <a href="{{ route('guest.announcement.details', $data->slug) }}" class="blog_btn">Read More</a>
                                @if ($data->type == "FILE")
                                  <a href="{{ route('guest.announcement.view_file', $data->slug) }}" class="blog_btn" target="__blank">View Document</a>  
                                @else
                                  <a href="{{ $data->url }}" class="blog_btn" target="__blank">View Site</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
              @endforeach

            {!! $announcement_list->appends([])->render('vendor.pagination.bootstrap-4')!!}
            
            </div>
          </div>

          @include('layouts.guest-sidebar')

        </div>
    </div>
  </section>





@endsection


