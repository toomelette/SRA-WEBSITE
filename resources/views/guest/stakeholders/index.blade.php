@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area content-margin">
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-9 posts-list">
            {{ Breadcrumbs::render('aboutUs_officials') }}
            <div class="single-post row">

              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="text-heading title_color">Sugar Traders</h3>
              </div>
              
              <div class="container">
                @foreach ($traders_dir_cat_list as $traders_dir_cat_data)
                  <div class="progress-table-wrap">
                    <div class="progress-table">
                    <h4 class="mb-20">{{ $traders_dir_cat_data->name }}</h4>
                      @foreach ($traders_dir_cat_data->tradersDirectory as $traders_dir_data)
                        <b>{{ $traders_dir_data->title }}</b><br>
                        <a href="{{ route('guest.stakeholders.view_traders_directory_doc', $traders_dir_data->slug) }}" class="link-default" target="_blank">{{ $traders_dir_data->description }}</a><br><br>
                      @endforeach
                    </div>
                  </div>
                @endforeach
              </div>


              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="text-heading title_color">Sugar Mills Affiliation / Planters</h3>
              </div>
              
              <div class="container">
                @foreach ($planters_dir_cat_list as $planters_dir_cat_data)
                  <div class="progress-table-wrap">
                    <div class="progress-table">
                    <h4 class="mb-20">{{ $planters_dir_cat_data->name }}</h4>
                      @foreach ($planters_dir_cat_data->plantersDirectory as $planters_dir_data)
                        <b>{{ $planters_dir_data->title }}</b><br>
                        <a href="{{ route('guest.stakeholders.view_planters_directory_doc', $planters_dir_data->slug) }}" class="link-default" target="_blank">{{ $planters_dir_data->description }}</a><br><br>
                      @endforeach
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


