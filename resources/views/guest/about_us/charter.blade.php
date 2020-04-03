@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area content-margin">
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-9 posts-list">
            {{ Breadcrumbs::render('aboutUs_charter') }}
            <div class="single-post row">


              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="text-heading title_color">CHARTER</h3>
                <p class="sample-text">
                  The Sugar  Regulatory Administration (SRA) was created by virtue of Executive Order No. 18 dated May 28, 1986.  E.O. No. 18 was promulgated during the Freedom Constitution or Proclamation No. 3 dated March 25, 1986 by President Corazon C. Aquino which recognized the sugar industry as a major component of the socio-economic and political structure of the country.  It also reiterates that in order to protect the national interest, free market forces should be allowed to prevail in the marketing of sugar although the production of the same should be regulated and supported with an innovative research and development program and a socio-economic program which will be primarily be the private sector’s responsibility.
                </p>
                Further Reading:
                <a href="{{ route('guest.about_us.view_charter_eo') }}" class="link-default" target="__blank">
                  EXECUTIVE ORDER NO.18
                </a>
              </div>

          </div>
            
          </div>

          @include('layouts.guest-sidebar')

        </div>
    </div>
  </section>

@endsection


