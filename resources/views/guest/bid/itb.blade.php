@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area content-margin">
    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-9 posts-list">
            {{ Breadcrumbs::render('bid_ITB') }}
            <div class="single-post row">

              <div class="col-lg-12 col-md-12 blog_details">
                <h3 class="text-heading title_color">Invitation to Bid</h3>
              </div>
              
              <div class="container">

                <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('guest.bid.itb') }}">

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
                      <td>@sortablelink('description', 'Description')</td>
                      <td>@sortablelink('station', 'Station')</td>
                      <td>@sortablelink('date', 'Date Posted')</td>
                      <td style="width:200px;"></td>
                    </thead>
                    <tbody>
                      @foreach ($itb_list as $data)
                        <tr>
                          <td id="mid-vert">{{ $data->description }}</td>
                          <td id="mid-vert">{{ $data->station }}</td>
                          <td id="mid-vert">{{ __dataType::date_parse($data->date, 'm/d/Y') }}</td>
                          <td id="mid-vert">
                            <a href="{{ route('guest.bid.view_itb', $data->slug) }}" class="genric-btn btn-info small" target="_blank">
                              ITB
                            </a>
                            <a href="{{ route('guest.bid.view_pbd', $data->slug) }}" class="genric-btn btn-info small" target="_blank">
                              PBD
                            </a>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

                  @if($itb_list->isEmpty())
                    <div style="padding :5px;">
                      <center><h4>No Records found!</h4></center>
                    </div>
                  @endif

                  {!! __html::table_counter($itb_list) !!}
                  {!! $itb_list->appends([])->render('vendor.pagination.bootstrap-4')!!}

                </div>
              </div>

            </div>
          </div>

          @include('layouts.guest-sidebar')

        </div>
    </div>
  </section>

@endsection


