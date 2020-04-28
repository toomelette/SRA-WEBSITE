
<?php

  $appended_requests = [
                      'q'=> Request::get('q'),
                      'sort' => Request::get('sort'),
                      'direction' => Request::get('direction'),

                      'md' => Request::get('md'),
  ];  

?>

@extends('layouts.guest-master')

@section('content')

  <section class="blog_area single-post-area content-margin">
    <div class="container-fluid">
        <div class="row">

          <div class="col-lg-9 posts-list">
            
            {{ Breadcrumbs::render('sida_sidaUpdates') }}

            <div class="col-lg-12 col-md-12 blog_details">
              <h3 class="text-heading title_color">SIDA Updates</h3>
            </div>
            
<form data-pjax id="filter_form" method="GET" autocomplete="off" action="{{ route('guest.sida.sida_updates') }}">

            <div class="row">

              <div class="col-lg-3">
                <div class="blog_right_sidebar">
                  <aside class="popular_post_widget">
                    <h4>FILTERS</h4>
                      <div class="media-body" style="margin-left:0px;">

                        @foreach ($global_provinces_all as $data)

                          <span>{{ $data->name }}</span>

                          @foreach ($data->millDistrict as $data_mill)

                            <div class="custom-control custom-checkbox" style="margin-left: 10px;">
                              <input type="checkbox" 
                                     class="custom-control-input md" 
                                     id="{{ $data_mill->mill_district_id }}" 
                                     name="md"
                                     value="{{ $data_mill->mill_district_id }}">
                              <label class="custom-control-label" for="{{ $data_mill->mill_district_id }}" style="font-size: 14px;">
                                {{ $data_mill->name }}
                              </label>
                            </div>

                          @endforeach

                        @endforeach

                      </div>
                  </aside>
                </div>
              </div>



              <div class="col-lg-9">

                <div class="row" style="margin-bottom:10px;">
                    
                  <div class="col-md-12">
                    <div class="input-group input-group-md" style="width: 500px;">
                      <input name="q" class="form-control pull-right" placeholder="Search ..." type="text">
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
                    </thead>
                    <tbody>
                      @foreach ($sida_programs as $data)
                        <tr>
                          <td id="mid-vert">
                            <a href="{{ route('guest.sida.view_sida_program_doc', $data->slug) }}" class="link-default" target="_blank">
                              {{ $data->title }}
                            </a>
                          </td>
                          <td id="mid-vert">{{ $data->year }}</td>
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
                  {!! $sida_programs->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}

                </div>

              </div>

            </div>

          </div>

          @include('layouts.guest-sidebar')

        </div>
    </div>
  </section>

@endsection


@section('scripts')

  <script type="text/javascript">
    
    $('.md').change(function(){
      if(this.checked == true){
        $('input[type="checkbox"]').not(this).prop('checked', false);
        $('#table_search_button').click();
      }else{
        $('#table_search_button').click();
      }
    });

  </script>


@endsection


