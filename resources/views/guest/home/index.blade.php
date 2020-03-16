
@extends('layouts.guest-master')

@section('content')
  
  
  {{-- Slide Show --}}

  <div class="popular_courses">
    <div class="container">
      <div class="owl-carousel active_course">
        
        <div class="single_course">
          <div class="course_head">
            <img class="img-fluid" src="{{ asset('template_guest/img/courses/c1.jpg') }}" alt="" />
          </div>
          <div class="course_content">
            <span class="tag mb-4 d-inline-block">Read More</span>
            <h4 class="mb-3">
              <a href="course-details.html">Custom Product Design</a>
            </h4>
            <p>
              One make creepeth man bearing their one firmament won't fowl
              meat over sea
            </p>
          </div>
        </div>

        <div class="single_course">
          <div class="course_head">
            <img class="img-fluid" src="{{ asset('template_guest/img/courses/c2.jpg') }}" alt="" />
          </div>
          <div class="course_content">
            <span class="tag mb-4 d-inline-block">Read More</span>
            <h4 class="mb-3">
              <a href="course-details.html">Social Media Network</a>
            </h4>
            <p>
              One make creepeth man bearing their one firmament won't fowl
              meat over sea
            </p>
          </div>
        </div>

        <div class="single_course">
          <div class="course_head">
            <img class="img-fluid" src="{{ asset('template_guest/img/courses/c3.jpg') }}" alt="" />
          </div>
          <div class="course_content">
            <span class="tag mb-4 d-inline-block">Read More</span>
            <h4 class="mb-3">
              <a href="course-details.html">Computer Engineering</a>
            </h4>
            <p>
              One make creepeth man bearing their one firmament won't fowl
              meat over sea
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>



  {{-- Admin Corner --}}

  <div class="container">
    <div class="row h_blog_item">
      <div class="col-lg-6">
        <div class="h_blog_img">
          <img class="img-fluid" src="{{ asset('images/admin-serafica.jpg') }}" alt="" />
        </div>
      </div>
      <div class="col-lg-6">
        <div class="h_blog_text">
          <div class="h_blog_text_inner left right">
            <h4>Administrator's Corner</h4>
            <p>
              TRIVIA : On December 4, 1934, the Sugar Limitation Law (Act No. 4166) was passed which provides for the limitations, regulation and allocation of sugar produced in the Philippines including the processing and marketing thereof.  It was later amended authorizing the representation of planters and millers in the Sugar Quota Administration.
            </p>
            <a class="primary-btn" href="#">
              Learn More About the Administrator <i class="ti-arrow-right ml-1"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>



  {{-- Trainings --}}
  <section class="sample-text-area">
    <div class="events_area">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5">
            <div class="main_title">
              <h2 class="mb-3 text-white">Upcoming OPSI Trainings</h2>
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



  {{-- News --}}

  <section class="feature_area section_gap_top">

    <div class="popular_courses">
      <div class="container">
        <div class="main_title">
          <h2 class="mb-3">News</h2>
        </div>
        <div class="owl-carousel active_course">
          <div class="single_course">
            <div class="course_content">
              <h4 class="mb-3">
                <a href="course-details.html">Custom Product Design</a>
              </h4>
              <p>
                One make creepeth man bearing their one firmament won't fowl
                meat over sea
              </p><br>
              <a href="#">
                <span class="tag mb-4 d-inline-block">Read More</span>
              </a>
            </div>
          </div>
          <div class="single_course">
            <div class="course_content">
              <h4 class="mb-3">
                <a href="course-details.html">Custom Product Design</a>
              </h4>
              <p>
                One make creepeth man bearing their one firmament won't fowl
                meat over sea
              </p><br>
              <a href="#">
                <span class="tag mb-4 d-inline-block">Read More</span>
              </a>
            </div>
          </div>
          <div class="single_course">
            <div class="course_content">
              <h4 class="mb-3">
                <a href="course-details.html">Custom Product Design</a>
              </h4>
              <p>
                One make creepeth man bearing their one firmament won't fowl
                meat over sea
              </p><br>
              <a href="#">
                <span class="tag mb-4 d-inline-block">Read More</span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12">
        <div class="text-center pt-lg-5 pt-3">
          <a href="#" class="primary-btn small">
            View All News <span class="ti-arrow-right"></span>
          </a>
        </div>
      </div>
    </div>
  </section>



  {{-- Announcements --}}

  <div class="popular_courses">
    <div class="container">
      <div class="main_title">
        <h2 class="mb-3">Announcements</h2>
      </div>
      <div class="owl-carousel active_course">
        <div class="single_course">
          <div class="course_content">
            <h4 class="mb-3">
              <a href="course-details.html">Custom Product Design</a>
            </h4>
            <p>
              One make creepeth man bearing their one firmament won't fowl
              meat over sea
            </p><br>
            <a href="#">
              <span class="tag mb-4 d-inline-block">Read More</span>
            </a>
          </div>
        </div>
        <div class="single_course">
          <div class="course_content">
            <h4 class="mb-3">
              <a href="course-details.html">Custom Product Design</a>
            </h4>
            <p>
              One make creepeth man bearing their one firmament won't fowl
              meat over sea
            </p><br>
            <a href="#">
              <span class="tag mb-4 d-inline-block">Read More</span>
            </a>
          </div>
        </div>
        <div class="single_course">
          <div class="course_content">
            <h4 class="mb-3">
              <a href="course-details.html">Custom Product Design</a>
            </h4>
            <p>
              One make creepeth man bearing their one firmament won't fowl
              meat over sea
            </p><br>
            <a href="#">
              <span class="tag mb-4 d-inline-block">Read More</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="text-center pt-lg-5 pt-3">
        <a href="#" class="primary-btn small">
          View All Announcements <span class="ti-arrow-right"></span>
        </a>
      </div>
    </div>
  </div>





@endsection


