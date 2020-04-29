@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area content-margin">
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-9 posts-list">
            {{ Breadcrumbs::render('bid_philgepsPosting') }}
            <div class="single-post row">

              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="text-heading title_color">Philgeps Posting</h3>
              </div>
              
              <div class="container">
                <ul>
                  <li><a href="https://www.philgeps.gov.ph/GEPSNONPILOT/Tender/SplashOpportunitiesSearchUI.aspx?menuIndex=3&orgID=1252&type=agency&ClickFrom=OpenOpp" class="link-default" target="__blank">SRA - QUEZON CITY</a></li>
                  <li><a href="https://www.philgeps.gov.ph/GEPSNONPILOT/Tender/SplashOpportunitiesSearchUI.aspx?menuIndex=3&orgID=33666&type=agency&ClickFrom=OpenOpp" class="link-default" target="__blank">SRA - BACOLOD CITY</a></li>
                </ul>
              </div>

            </div>
          </div>

          @include('layouts.guest-sidebar')

        </div>
    </div>
  </section>

@endsection


