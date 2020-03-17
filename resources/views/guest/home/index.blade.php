
@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                
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
                      <a href="#">
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



            {{-- Side Bar --}}
            <div class="col-lg-4">
              <div class="blog_right_sidebar">


                  {{-- Industry Update --}}
                  <aside class="single_sidebar_widget post_category_widget">
                    <h4 class="widget_title">Industry Update</h4>
                    <ul class="list cat-list">
                      <li>
                        <a class="d-flex justify-content-between" href="">Sugar Supply and Demand Situation</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Millsite Prices</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Bioethanol Reference Price</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Metro Manila Prices</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Sugar Statistics</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Road Map</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Expired Import Clearances</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Milling Schedule</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Block Farm</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Crop Estimates and Statistics</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Vacant Positions</a>
                      </li>
                    </ul>
                    <div class="br"></div>
                  </aside>


                  {{-- Policy --}}
                  <aside class="single_sidebar_widget post_category_widget">
                    <h4 class="widget_title">Policy</h4>
                    <ul class="list cat-list">
                      <li>
                        <a class="d-flex justify-content-between" href="">Sugar Order</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Circular Letter</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Memorandum Order</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Memorandum Circular</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Molasses Order</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Muscovado Order</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href=""><p>General Administrative Order</p></a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Sugar Laws</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Bioenergy</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">ASEAN</a>
                      </li>
                    </ul>
                    <div class="br"></div>
                  </aside>


                  {{-- SIDA --}}
                  <aside class="single_sidebar_widget post_category_widget">
                    <h4 class="widget_title">SIDA</h4>
                    <ul class="list cat-list">
                      <li>
                        <a class="d-flex justify-content-between" href="">SIDA Updates</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">SIDA Guidelines</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">SIDA Laws</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">SIDA Fund Utilization</a>
                      </li>
                    </ul>
                    <div class="br"></div>
                  </aside>


                  {{-- Bid Corner --}}
                  <aside class="single_sidebar_widget post_category_widget">
                    <h4 class="widget_title">Bid Corner</h4>
                    <ul class="list cat-list">
                      <li>
                        <a class="d-flex justify-content-between" href="">Invitation to Bid</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Supplemental Bid</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Notice of Award</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Notice to Proceed</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Philgeps Posting</a>
                      </li>
                      <li>
                        <a class="d-flex justify-content-between" href="">Minutes of the Bid</a>
                      </li>
                    </ul>
                    <div class="br"></div>
                  </aside>


                  {{-- Logo's --}}
                  <aside class="single_sidebar_widget author_widget" style="margin-bottom:10px;">
                    <a href="">
                      <img src="{{ asset('images/transparency-seal.png') }}" style="height:150px; ">
                    </a><br>
                  </aside>
                  <aside class="single_sidebar_widget author_widget" style="margin-bottom:10px;">
                    <a href="">
                      <img src="{{ asset('images/gcg-logo.png') }}" style="height:160px; ">
                    </a><br>
                  </aside>
                  <aside class="single_sidebar_widget author_widget" style="margin-bottom:10px;">
                    <a href="">
                      <img src="{{ asset('images/foi-logo.png') }}" style="height:170px; ">
                    </a><br>
                  </aside>
                  <aside class="single_sidebar_widget author_widget" style="margin-bottom:10px;">
                    <a href="">
                      <img src="{{ asset('images/iso-sra-qr-code.jpg') }}" style="height:90px; ">
                    </a><br>
                  </aside>
                  <div class="br"></div>

                  {{-- News --}}
                  {{-- <aside class="single_sidebar_widget popular_post_widget">
                    <h3 class="widget_title">News</h3>
                    <div class="media post_item">
                      <img src="{{ asset('template_guest/img/blog/popular-post/post1.jpg') }}" alt="post">
                      <div class="media-body">
                          <a href="blog-details.html">
                              <h3>Space The Final Frontier</h3>
                          </a>
                          <p>02 Hours ago</p>
                      </div>
                    </div>
                    <div class="media post_item">
                      <img src="{{ asset('template_guest/img/blog/popular-post/post1.jpg') }}" alt="post">
                      <div class="media-body">
                          <a href="blog-details.html">
                              <h3>Space The Final Frontier</h3>
                          </a>
                          <p>02 Hours ago</p>
                      </div>
                    </div>
                    <div class="media post_item">
                      <img src="{{ asset('template_guest/img/blog/popular-post/post1.jpg') }}" alt="post">
                      <div class="media-body">
                          <a href="blog-details.html">
                              <h3>Space The Final Frontier</h3>
                          </a>
                          <p>02 Hours ago</p>
                      </div>
                    </div>
                    <div style="margin-top: 20px;">
                      <a href="#" style="text-align: center;">
                        <p style="color:#002347;">View All News <i class="ti-arrow-right ml-1"></i></p>
                      </a>
                    </div>
                  </aside>
                  <div class="br"></div> --}}

                  {{-- Announcements --}}
                  {{-- <aside class="single_sidebar_widget popular_post_widget">
                    <h3 class="widget_title">Announcements</h3>
                    <div class="media post_item">
                      <img src="{{ asset('template_guest/img/blog/popular-post/post1.jpg') }}" alt="post">
                      <div class="media-body">
                          <a href="blog-details.html">
                              <h3>Space The Final Frontier</h3>
                          </a>
                          <p>02 Hours ago</p>
                      </div>
                    </div>
                    <div class="media post_item">
                      <img src="{{ asset('template_guest/img/blog/popular-post/post1.jpg') }}" alt="post">
                      <div class="media-body">
                          <a href="blog-details.html">
                              <h3>Space The Final Frontier</h3>
                          </a>
                          <p>02 Hours ago</p>
                      </div>
                    </div>
                    <div class="media post_item">
                      <img src="{{ asset('template_guest/img/blog/popular-post/post1.jpg') }}" alt="post">
                      <div class="media-body">
                          <a href="blog-details.html">
                              <h3>Space The Final Frontier</h3>
                          </a>
                          <p>02 Hours ago</p>
                      </div>
                    </div>
                    <div style="margin-top: 20px;">
                      <a href="#" style="text-align: center;">
                        <p style="color:#002347;">View All Announcements <i class="ti-arrow-right ml-1"></i></p>
                      </a>
                    </div>
                  </aside>
                  <div class="br"></div>
 --}}
                  {{-- Newsletter --}}
                  {{-- <aside class="single_sidebar_widget popular_post_widget">
                    <h3 class="widget_title">Newsletter</h3>
                    <div class="media post_item">
                      <img src="{{ asset('template_guest/img/blog/popular-post/post1.jpg') }}" alt="post">
                      <div class="media-body">
                          <a href="blog-details.html">
                              <h3>Space The Final Frontier</h3>
                          </a>
                          <p>02 Hours ago</p>
                      </div>
                    </div>
                    <div class="media post_item">
                      <img src="{{ asset('template_guest/img/blog/popular-post/post1.jpg') }}" alt="post">
                      <div class="media-body">
                          <a href="blog-details.html">
                              <h3>Space The Final Frontier</h3>
                          </a>
                          <p>02 Hours ago</p>
                      </div>
                    </div>
                    <div class="media post_item">
                      <img src="{{ asset('template_guest/img/blog/popular-post/post1.jpg') }}" alt="post">
                      <div class="media-body">
                          <a href="blog-details.html">
                              <h3>Space The Final Frontier</h3>
                          </a>
                          <p>02 Hours ago</p>
                      </div>
                    </div>
                    <div style="margin-top: 20px;">
                      <a href="#" style="text-align: center;">
                        <p style="color:#002347;">View All Newsletters <i class="ti-arrow-right ml-1"></i></p>
                      </a>
                    </div>
                  </aside>
                  <div class="br"></div> --}}

              </div>
          </div>



        </div>
    </div>
  </section>





@endsection


