@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area content-margin">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-9 posts-list">
          {{ Breadcrumbs::render('aboutUs_administrators') }}
          <div class="single-post row">

            <div class="col-lg-12 col-md-12 blog_details">
              <h3 class="text-heading title_color">ADMINISTRATORS</h3>
            </div>
            
            <div class="container">

                <div class="progress-table-wrap">
                  <div class="progress-table">
                    @foreach ($administrators as $data)
                      <div class="table-row">
                        <div class="visit"> 
                          @if (isset($data->file_location) && $data->file_location != "")
                            <img src="{{ route('guest.about_us.view_administrator_img', $data->slug) }}" style="height:120px;">
                          @else
                            <img src="{{ asset('images/avatar.jpeg') }}" class="profile-user-img img-responsive img-circle" alt="User Image"  style="height:120px;">
                          @endif
                        </div>
                        <div class="percentage">
                          {{ $data->fullname }}
                        </div>
                        <div class="percentage">
                          {{ $data->date_scope }}
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


