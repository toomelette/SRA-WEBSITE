@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area content-margin">
    <div class="container-fluid">
        <div class="row">

          {{-- <div class="col-lg-3">
            <div class="blog_right_sidebar">
              <aside class="popular_post_widget">
                <h3 class="widget_title">Announcements</h3>
                  <div class="media post_item">
                    <div class="media-body">
                      <a href="#">
                        <h3>Test</h3>
                      </a>
                      <p></p>
                    </div>
                  </div>
              </aside>
            </div>
          </div> --}}

          <div class="col-lg-9 posts-list">
            {{ Breadcrumbs::render('sida_sidaUpdates') }}
            <div class="single-post row">

              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="text-heading title_color">SIDA Updates</h3>
              </div>
              
              <div class="container">

                <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('guest.sida.sida_updates') }}">

                  <div class="row" style="margin-bottom:10px;">
                      
                    <div class="col-md-12">
                      <div class="input-group input-group-md" style="width: 500px;">
                        <input name="q" class="form-control pull-right" placeholder="Search ..." type="text" value="{{ Request::get('q') }}">
                        <div class="input-group-btn">
                          <button id="table_search_button" type="submit" class="btn btn-default btn-md">Search <i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    </div>

                  </div>

                </form>

                <div id="pjax-container">
                  <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <td style="color:red;">@sortablelink('title', 'Title')</td>
                      <td style="color:red;">@sortablelink('year', 'Crop Year')</td>
                      <td style="width:150px;"></td>
                    </thead>
                    <tbody>
                      @foreach ($sida_programs as $data)
                        <tr>
                          <td id="mid-vert">{{ $data->title }}</td>
                          <td id="mid-vert">{{ $data->year }}</td>
                          <td id="mid-vert">
                            <a href="{{ route('guest.sida.view_sida_program_doc', $data->slug) }}" class="genric-btn btn-info small" target="_blank">
                              Download
                            </a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

                  @if($sida_programs->isEmpty())
                    <div style="padding :5px;">
                      <center><h4>No Records found!</h4></center>
                    </div>
                  @endif

                  {!! __html::table_counter($sida_programs) !!}
                  {!! $sida_programs->appends([])->render('vendor.pagination.bootstrap-4')!!}

                </div>
              </div>

            </div>
          </div>

          @include('layouts.guest-sidebar')

        </div>
    </div>
  </section>

@endsection


