@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area content-margin">
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-9 posts-list">
            {{ Breadcrumbs::render('aboutUs_officials') }}
            <div class="single-post row">

              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="text-heading title_color">OFFICIALS</h3>
              </div>
              
              <div class="container">

                  <div class="progress-table-wrap">
                    <div class="progress-table">
                    <h4 class="mb-20">SUGAR BOARD</h4>
                      @foreach ($officials->where('office_id', 'O10001') as $data)
                        <div class="table-row">
                          <div class="visit"> 
                            @if (isset($data->file_location) && $data->file_location != "")
                              <img src="{{ route('guest.about_us.view_official_img', $data->slug) }}" style="height:80px;">
                            @else
                              <img src="{{ asset('images/avatar.jpeg') }}" class="profile-user-img img-responsive img-circle" alt="User Image"  style="height:80px;">
                            @endif
                          </div>
                          <div class="percentage">
                            {{ $data->fullname }}<br>
                            {{ $data->position }}
                          </div>
                          <div class="percentage">
                            {{ $data->contact_no }}<br>
                            {{ $data->email }}
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>

                  <div class="progress-table-wrap">
                    <div class="progress-table">
                    <h4 class="mb-20">OFFICE OF THE DEPUTY ADMINISTRATOR FOR ADMINISTRATION AND FINANCE</h4>
                      @foreach ($officials->where('office_id', 'O10002') as $data)
                        <div class="table-row">
                          <div class="visit">
                            @if (isset($data->file_location) && $data->file_location != "")
                              <img src="{{ route('guest.about_us.view_official_img', $data->slug) }}" style="height:80px;">
                            @else
                              <img src="{{ asset('images/avatar.jpeg') }}" class="profile-user-img img-responsive img-circle" alt="User Image"  style="height:80px;">
                            @endif
                          </div>
                          <div class="percentage">
                            {{ $data->fullname }}<br>
                            {{ $data->position }}
                          </div>
                          <div class="percentage">
                            {{ $data->contact_no }}<br>
                            {{ $data->email }}
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>

                  <div class="progress-table-wrap">
                    <div class="progress-table">
                    <h4 class="mb-20">OFFICE OF THE DEPUTY ADMINISTRATOR FOR RESEARCH, DEVELOPMENT AND EXTENSION</h4>
                      @foreach ($officials->where('office_id', 'O10003') as $data)
                        <div class="table-row">
                          <div class="visit">
                            @if (isset($data->file_location) && $data->file_location != "")
                              <img src="{{ route('guest.about_us.view_official_img', $data->slug) }}" style="height:80px;">
                            @else
                              <img src="{{ asset('images/avatar.jpeg') }}" class="profile-user-img img-responsive img-circle" alt="User Image"  style="height:80px;">
                            @endif
                          </div>
                          <div class="percentage">
                            {{ $data->fullname }}<br>
                            {{ $data->position }}
                          </div>
                          <div class="percentage">
                            {{ $data->contact_no }}<br>
                            {{ $data->email }}
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>

                  <div class="progress-table-wrap">
                    <div class="progress-table">
                    <h4 class="mb-20">OFFICE OF THE DEPUTY ADMINISTRATOR FOR REGULATIONS</h4>
                      @foreach ($officials->where('office_id', 'O10004') as $data)
                        <div class="table-row">
                          <div class="visit">
                            @if (isset($data->file_location) && $data->file_location != "")
                              <img src="{{ route('guest.about_us.view_official_img', $data->slug) }}" style="height:80px;">
                            @else
                              <img src="{{ asset('images/avatar.jpeg') }}" class="profile-user-img img-responsive img-circle" alt="User Image"  style="height:80px;">
                            @endif
                          </div>
                          <div class="percentage">
                            {{ $data->fullname }}<br>
                            {{ $data->position }}
                          </div>
                          <div class="percentage">
                            {{ $data->contact_no }}<br>
                            {{ $data->email }}
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>

                  <div class="progress-table-wrap">
                    <div class="progress-table">
                    <h4 class="mb-20">INTERNAL AUDIT DEPARTMENT</h4>
                      @foreach ($officials->where('office_id', 'O10005') as $data)
                        <div class="table-row">
                          <div class="visit">
                            @if (isset($data->file_location) && $data->file_location != "")
                              <img src="{{ route('guest.about_us.view_official_img', $data->slug) }}" style="height:80px;">
                            @else
                              <img src="{{ asset('images/avatar.jpeg') }}" class="profile-user-img img-responsive img-circle" alt="User Image"  style="height:80px;">
                            @endif
                          </div>
                          <div class="percentage">
                            {{ $data->fullname }}<br>
                            {{ $data->position }}
                          </div>
                          <div class="percentage">
                            {{ $data->contact_no }}<br>
                            {{ $data->email }}
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>

                  <div class="progress-table-wrap">
                    <div class="progress-table">
                    <h4 class="mb-20">LEGAL DEPARTMENT</h4>
                      @foreach ($officials->where('office_id', 'O10006') as $data)
                        <div class="table-row">
                          <div class="visit">
                            @if (isset($data->file_location) && $data->file_location != "")
                              <img src="{{ route('guest.about_us.view_official_img', $data->slug) }}" style="height:80px;">
                            @else
                              <img src="{{ asset('images/avatar.jpeg') }}" class="profile-user-img img-responsive img-circle" alt="User Image"  style="height:80px;">
                            @endif
                          </div>
                          <div class="percentage">
                            {{ $data->fullname }}<br>
                            {{ $data->position }}
                          </div>
                          <div class="percentage">
                            {{ $data->contact_no }}<br>
                            {{ $data->email }}
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>

                  <div class="progress-table-wrap">
                    <div class="progress-table">
                    <h4 class="mb-20">PLANNING, POLICY AND SPECIAL PROJECTS DEPARTMENT</h4>
                      @foreach ($officials->where('office_id', 'O10007') as $data)
                        <div class="table-row">
                          <div class="visit">
                            @if (isset($data->file_location) && $data->file_location != "")
                              <img src="{{ route('guest.about_us.view_official_img', $data->slug) }}" style="height:80px;">
                            @else
                              <img src="{{ asset('images/avatar.jpeg') }}" class="profile-user-img img-responsive img-circle" alt="User Image"  style="height:80px;">
                            @endif
                          </div>
                          <div class="percentage">
                            {{ $data->fullname }}<br>
                            {{ $data->position }}
                          </div>
                          <div class="percentage">
                            {{ $data->contact_no }}<br>
                            {{ $data->email }}
                          </div>
                        </div>
                      @endforeach
                    </div>
                  </div>

              </div>

            </div>
          </div>

          @include('layouts.guest-sidebar')

        </div>
    </div>
  </section>

@endsection


