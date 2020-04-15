
@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area content-margin">
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-9">
            {{ Breadcrumbs::render('aboutSugarcane_researchDetails', $research) }}
          </div>
          <div class="col-lg-9 posts-list">
            <div class="single-post row">
              <div class="col-lg-12 col-md-12 blog_details">
                <h2>{{ $research->title }}</h2>
                <p class="excert">{!! $research->content !!}</p>
              </div>
          </div>
            
          </div>

          @include('layouts.guest-sidebar')

        </div>
    </div>
  </section>





@endsection


