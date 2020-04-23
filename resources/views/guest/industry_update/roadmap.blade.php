@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area content-margin">
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-9 posts-list">
            {{ Breadcrumbs::render('industryUpdate_roadmap') }}
            <div class="single-post row">

              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="text-heading title_color">Roadmap</h3>
              </div>
              
              <div class="container">

                <a href="{{ route('guest.industry_update.view_roadmap_doc') }}" class="link-default" target="__blank">
                  DOWNLOAD
                </a>
                <br>
                <object
                  type="application/pdf" 
                  data="{{ route('guest.industry_update.view_roadmap_doc') }}#toolbar=0" 
                  width="1000" 
                  height="700"
                >
                </object>

              </div>

            </div>
          </div>

          @include('layouts.guest-sidebar')

        </div>
    </div>
  </section>

@endsection


