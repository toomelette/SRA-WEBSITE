@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area content-margin">
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-9 posts-list">
            {{ Breadcrumbs::render('industryUpdate_sugarStatistics') }}
            <div class="single-post row">

              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="text-heading title_color">Sugar Statistics</h3>
              </div>
              
              <div class="container">

                <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('guest.industry_update.sugar_statistics') }}">

                  <div class="row" style="margin-bottom:10px;">
                      
                    <div class="col-md-10">
                      <div class="input-group input-group-md" style="width: 500px;">
                        <input name="q" class="form-control pull-right" placeholder="Search ..." type="text" value="{{ Request::get('q') }}">
                        <div class="input-group-btn">
                          <button id="table_search_button" type="submit" class="btn btn-default btn-md">Search <i class="fa fa-search"></i></button>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="row">
                        <div class="col-md-4" style="margin-top:6px;">
                          Entries:
                        </div>
                        <div class="col-md-8">
                          <select id="e" name="e" class="small" onchange="document.getElementById('table_search_button').click()">
                            <option value="">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                          </select>
                        </div>
                      </div>
                    </div>

                  </div>

                </form>

                <div id="pjax-container">
                  <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <td style="color:red;">@sortablelink('title', 'Title')</td>
                      <td style="width:150px;"></td>
                    </thead>
                    <tbody>
                      @foreach ($sugar_statistics as $data)
                        <tr>
                          <td id="mid-vert">{{ $data->title }}</td>
                          <td id="mid-vert">
                            <a href="{{ route('guest.industry_update.view_sugar_statistics_doc', $data->slug) }}" class="genric-btn btn-info small" target="_blank">
                              Download
                            </a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

                  @if($sugar_statistics->isEmpty())
                    <div style="padding :5px;">
                      <center><h4>No Records found!</h4></center>
                    </div>
                  @endif

                  {!! __html::table_counter($sugar_statistics) !!}
                  {!! $sugar_statistics->appends([])->render('vendor.pagination.bootstrap-4')!!}

                </div>
              </div>

            </div>
          </div>

          @include('layouts.guest-sidebar')

        </div>
    </div>
  </section>

@endsection


