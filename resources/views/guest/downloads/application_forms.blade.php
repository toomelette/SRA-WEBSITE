@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area content-margin">
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-9 posts-list">
            {{ Breadcrumbs::render('downloads_applicationForms') }}
            <div class="single-post row">

              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="text-heading title_color">Application Forms</h3>
              </div>
              
              <div class="container">
                <div class="row" style="margin-bottom:10px;">

                  <div class="col-md-10">
                    <div class="input-group input-group-sm" style="width: 300px;">
                      <input name="q" class="form-control pull-right" placeholder="Search any.." type="text" value="">
                      <div class="input-group-btn">
                        <button id="table_search_button" type="submit" class="btn btn-default btn-sm">Search <i class="fa fa-search"></i></button>
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
                          <option value="">10</option>
                          <option value="50">50</option>
                          <option value="100">100</option>
                        </select>
                      </div>
                    </div>
                  </div>

                </div>

                <table class="table table-striped table-bordered" style="width:100%">
                  <thead>
                    <td style="color:red;">@sortablelink('title', 'Title')</td>
                    <td>@sortablelink('description', 'Description')</td>
                    <td>@sortablelink('', 'File size')</td>
                    <td style="width:150px;"></td>
                  </thead>
                  <tbody>
                    @foreach ($application_forms as $data)
                      <td>{{ $data->title }}</td>
                      <td>{{ $data->description }}</td>
                      <td>{{ number_format(Storage::disk('local')->size($data->file_location)) }} KB</td>
                      <td>
                        <a href="#" class="genric-btn btn-info small">Download</a>
                      </td>
                    @endforeach
                  </tbody>
                </table>

                @if($application_forms->isEmpty())
                  <div style="padding :5px;">
                    <center><h4>No Records found!</h4></center>
                  </div>
                @endif

                {!! __html::table_counter($application_forms) !!}
                {!! $application_forms->appends([])->render('vendor.pagination.bootstrap-4')!!}

              </div>

            </div>
          </div>

          @include('layouts.guest-sidebar')

        </div>
    </div>
  </section>

@endsection


