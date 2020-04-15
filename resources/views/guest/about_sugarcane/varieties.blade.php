@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area content-margin">
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-9 posts-list">
            {{ Breadcrumbs::render('aboutSugarcane_varieties') }}
            <div class="single-post row">

              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="text-heading title_color">Sugarcane Varieties</h3>
              </div>
              
              <div class="container">

                <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('guest.about_sugarcane.varieties') }}">

                  <div class="row" style="margin-bottom:10px;">
                      
                    <div class="col-md-10">
                      <div class="input-group input-group-sm" style="width: 300px;">
                        <input name="q" class="form-control pull-right" placeholder="Search ..." type="text" value="{{ Request::get('q') }}">
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

                </form>

                <div id="pjax-container" style="margin-top:50px;">
                  @foreach ($varieties as $data)
                    <h2>{{ $data->name }}</h2>
                    <article class="row blog_item" style="padding-bottom:50px;">
                      <div class="col-md-4">
                        @if (isset($data->file_location) && $data->file_location != "")
                          <img src="{{ route('guest.about_sugarcane.view_variety_img', $data->slug) }}" style="height:500px;">
                        @endif
                      </div>
                      <div class="col-md-8">
                        <table class="table table-sm table-striped table-bordered">
                          <tbody>
                            @foreach ($data->varietyData as $variety_data)
                              <tr>
                                <td id="mid-vert">{{ $variety_data->field }}</td>
                                <td id="mid-vert">{{ $variety_data->value }}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </article>
                  @endforeach

                  @if($varieties->isEmpty())
                    <div style="padding :5px;">
                      <center><h4>No Records found!</h4></center>
                    </div>
                  @endif

                  {!! __html::table_counter($varieties) !!}
                  {!! $varieties->appends([])->render('vendor.pagination.bootstrap-4')!!}

                </div>
              </div>

            </div>
          </div>

          @include('layouts.guest-sidebar')

        </div>
    </div>
  </section>

@endsection


