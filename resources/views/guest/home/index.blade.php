
@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area content-margin">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-9 posts-list">
            
          {{-- Slide Show --}}
          <div class="popular_courses">
            <div class="container">

              <div class="owl-carousel active_course">
                @foreach ($news_list as $data)
                    <div class="single_course">
                      <div class="course_content">
                        <h5>
                          <a style="color:#002347;" href="{{ route('guest.news.details', $data->slug) }}">{{ $data->title }}</a>
                        </h5>
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
          <div class="container">
            <div class="row h_blog_item">
              <div class="col-lg-6">
                <div class="h_blog_img">
                  <img class="img-fluid" src="{{ asset('images/admin-serafica.jpg') }}" />
                </div>
              </div>
              <div class="col-lg-6">
                <div class="h_blog_text">
                  <div class="h_blog_text_inner left right">
                    <h4>Administrator's Corner</h4>
                    <p>
                      TRIVIA : On December 4, 1934, the Sugar Limitation Law (Act No. 4166) was passed which provides for the limitations, regulation and allocation of sugar produced in the Philippines including the processing and marketing thereof.  It was later amended authorizing the representation of planters and millers in the Sugar Quota Administration.
                    </p>
                    <a href="#">
                      <p style="color:#002347; ">Learn More About the Administrator <i class="ti-arrow-right ml-1"></i></p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>



          {{-- Announcements --}}
          <section class="feature_area section_gap_top">
            <div class="popular_courses">
              <div class="container">
                <div class="main_title">
                  <h2 class="mb-3">Announcements</h2>
                </div>
                <div class="owl-carousel active_course">
                  @foreach ($announcement_list as $data)
                    <div class="single_course">
                      <div class="course_content">
                        <h5>
                          <a style="color:#002347;" href="{{ route('guest.announcement.details', $data->slug) }}">{{ $data->title }}</a>
                        </h5>
                        <p>{!! Str::limit(strip_tags($data->content), 70, ' ...'); !!}</p><br>
                        <a href="{{ route('guest.announcement.details', $data->slug) }}">
                          <span class="tag mb-4 d-inline-block">Read More</span>
                        </a>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
              <div class="col-lg-12">
                <div class="text-center">
                  <a href="{{ route('guest.announcement.index') }}">
                    <p style="color:#002347;">View All Announcements <i class="ti-arrow-right ml-1"></i></p>
                  </a>
                </div>
              </div>
            </div>
          </section>



          {{-- Trainings --}}
          <section class="sample-text-area" style="margin-top: -200px;">
            <div class="events_area">
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-lg-5">
                    <div class="main_title">
                      <h2 class="mb-3 text-white">OPSI Trainings</h2>
                    </div>
                  </div>
                </div>
                <div class="row">

                  <div class="col-lg-6 col-md-6">
                    <div class="single_event position-relative">
                      <div class="event_thumb">
                        <img src="{{ asset('template_guest/img/event/e1.jpg') }}" alt="" />
                      </div>
                      <div class="event_details">
                        <div class="d-flex mb-4">
                          <div class="date"><span>15</span> Jun</div>

                          <div class="time-location">
                            <p>
                              <span class="ti-time mr-2"></span> 8:00 AM - 12:00 PM
                            </p>
                            <p>
                              <span class="ti-location-pin mr-2"></span> LAREC
                            </p>
                          </div>
                        </div>
                        <p>
                          One make creepeth man for so bearing their firmament won't
                          fowl meat over seas great
                        </p>
                        <a href="#" class="primary-btn rounded-0 mt-3">View Details</a>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="single_event position-relative">
                      <div class="event_thumb">
                        <img src="{{ asset('template_guest/img/event/e2.jpg') }}" alt="" />
                      </div>
                      <div class="event_details">
                        <div class="d-flex mb-4">
                          <div class="date"><span>15</span> Jun</div>

                          <div class="time-location">
                            <p>
                              <span class="ti-time mr-2"></span> 12:00 AM - 12:30 AM
                            </p>
                            <p>
                              <span class="ti-location-pin mr-2"></span> LGAREC
                            </p>
                          </div>
                        </div>
                        <p>
                          One make creepeth man for so bearing their firmament won't
                          fowl meat over seas great
                        </p>
                        <a href="#" class="primary-btn rounded-0 mt-3">View Details</a>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="text-center pt-lg-5 pt-3">
                      <a href="#" class="primary-btn small">
                        View All OPSI Trainings <span class="ti-arrow-right"></span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
          
        </div>

          @include('layouts.guest-sidebar')

      </div>
    </div>
  </section>





@endsection


