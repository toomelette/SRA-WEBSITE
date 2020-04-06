
@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area content-margin">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-9 posts-list">
          


          {{-- Slide Show --}}
          <div class="popular_courses col-lg-12">
            <div class="container">
              <div class="main_title">
                <h2 class="mb-2">News</h2>
              </div>
              <div class="owl-carousel active_course">
                @foreach ($news_list as $data)
                    <div class="single_course">
                      <div class="course_content">
                        <h4 class="mb-3">
                          <a href="{{ route('guest.news.details', $data->slug) }}">{{ $data->title }}</a>
                        </h4>
                        <p>{!! Str::limit(strip_tags($data->content), 70, ' ...'); !!}</p><br>
                        <a href="{{ route('guest.news.details', $data->slug) }}">
                          <span class="tag mb-4 d-inline-block">Read More</span>
                        </a>
                      </div>
                    </div>
                @endforeach
              </div>
              <div class="col-lg-12">
                <div class="text-center">
                  <a href="{{ route('guest.news.index') }}">
                    <p style="color:#002347;">View All News <i class="ti-arrow-right ml-1"></i></p>
                  </a>
                </div>
              </div>
            </div>
          </div>



          {{-- Admin Corner --}}
          <div class="container col-lg-12">
            <div class="row h_blog_item">
              <div class="col-lg-6">
                <div class="h_blog_img">
                  <img class="img-fluid" src="{{ asset('images/admin-serafica.png') }}" />
                </div>
              </div>
              <div class="col-lg-6">
                <div class="h_blog_text">
                  <div class="h_blog_text_inner left right">
                    <h4>Administrator's Corner</h4>
                    <p>
                      On December 4, 1934, the Sugar Limitation Law (Act No. 4166) was passed which provides for the limitations, regulation and allocation of sugar produced in the Philippines including the processing and marketing thereof.  It was later amended authorizing the representation of planters and millers in the Sugar Quota Administration.
                    </p>
                    <a href="#">
                      <p style="color:#002347;">Learn more about the Administrator <i class="ti-arrow-right ml-1"></i></p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          


          <div class="container-fluid row">
            
            {{-- Logo's --}}
            <div class="col-lg-4">
              <div class="single_feature">
                <div class="col-lg-12" style="text-align: center;">
                  <a href="">
                    <img src="{{ asset('images/citizen-charter.png') }}" style="height:170px; margin-bottom:10px;">
                  </a>
                </div>
                <div class="col-lg-12" style="text-align: center;">
                  <a href="">
                    <img src="{{ asset('images/transparency-seal.png') }}" style="height:120px; margin-bottom:10px;">
                  </a>
                </div>
                <div class="col-lg-12" style="text-align: center;">
                  <a href="">
                    <img src="{{ asset('images/gcg-logo.png') }}" style="height:130px; margin-bottom:10px;">
                  </a>
                </div>
                <div class="col-lg-12" style="text-align: center;">
                  <a href="">
                    <img src="{{ asset('images/foi-logo.png') }}" style="height:140px; margin-bottom:10px;">
                  </a>
                </div>
                <div class="col-lg-12" style="text-align: center;">
                  <a href="">
                    <img src="{{ asset('images/iso-sra-qr-code.jpg') }}" style="height:80px; margin-bottom:10px;">
                  </a>
                </div>
              </div>
            </div>

            {{-- Announcements --}}
            <div class="col-lg-8">
              <div class="blog_right_sidebar">
                <aside class="popular_post_widget">
                  <h3 class="widget_title">Announcements</h3>
                  @foreach ($announcement_list as $data)
                    <div class="media post_item">
                      <div class="media-body">
                        <a href="{{ route('guest.announcement.details', $data->slug) }}">
                          <h3>{{ $data->title }}</h3>
                        </a>
                        <p>{{ __dataType::date_parse($data->created_at, 'F d, Y') }}</p>
                      </div>
                    </div>
                    <div class="br"></div>
                  @endforeach
                    <div class="media post_item">
                      <div class="media-body text-center">
                        <a href="{{ route('guest.announcement.index') }}">
                          <p style="color:#002347;"><h3>View All<i class="ti-arrow-right ml-1"></i></h3></p>
                        </a>
                      </div>
                    </div>
                </aside>
              </div>
            </div>
          </div>




        </div>

        @include('layouts.guest-sidebar')

      </div>
    </div>
  </section>

@endsection