@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area content-margin">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-9 posts-list">
          {{ Breadcrumbs::render('aboutUs_orgChart') }}
          <div class="single-post row">
            <div class="section-top-border">
              <h3 class="title_color">ORGANIZATIONAL CHART</h3>
              <div class="row gallery-item">
                <div class="col-md-12">
                  <p>Click the image to view fullscreen</p>
                  <a href="{{ route('guest.about_us.view_org_chart_img') }}" class="img-gal" target="__blank">
                    <div class="single-gallery-image" style="background: url({{ route('guest.about_us.view_org_chart_img') }}); height:570px; width:950px;"></div>
                  </a>
                  <br>
                  Read more:
                  <a href="{{ route('guest.about_us.view_org_functional_statements') }}" class="link-default" target="__blank">
                    FUNCTIONAL STATEMENTS
                  </a>
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


