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
              
              <div class="row justify-content-center d-flex align-items-center">
                  
                @foreach ($officials as $data)

                  <div class="col-lg-4 col-md-6 col-sm-12 single-trainer">
                    <div class="thumb d-flex justify-content-sm-center">
                      @if (isset($data->file_location) && $data->file_location != "")
                        <img class="img-fluid" src="{{ route('guest.about_us.view_official_img', $data->slug) }}" alt="" />
                      @else
                        <img class="img-fluid" src="{{ asset('images/avatar.jpeg') }}" alt="" />
                      @endif
                    </div>
                    <div class="meta-text text-sm-center">
                      <h4>{{ $data->fullname }}</h4>
                      <p class="designation">{{ $data->position }}</p>
                      <p>
                        Email : {{ $data->email }}<br>
                        Contact No. : {{ $data->contact_no }}
                      </p>
                    </div>
                  </div>
                  
                @endforeach

              </div>

            </div>
          </div>

          @include('layouts.guest-sidebar')

        </div>
    </div>
  </section>

@endsection


