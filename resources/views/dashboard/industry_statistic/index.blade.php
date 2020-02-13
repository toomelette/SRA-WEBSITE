<?php

  $table_sessions = [ Session::get('INDUSTRY_STATISTIC_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                        'e' => Request::get('e'),
                      ];

?>





@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Industry Statistic List</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.industry_statistic.index') }}">

    <div class="box box-solid" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.industry_statistic.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th style="width: 100px">Attachment</th>
            <th>@sortablelink('industryStatisticsCategory.name', 'Category')</th>
            <th>@sortablelink('cropYear.name', 'Crop Year')</th>
            <th>@sortablelink('title', 'Title')</th>
            <th>@sortablelink('cut_off_date', 'Cut Off Date')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($industry_statistics as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
              <td id="mid-vert"> 
                @if(Storage::disk('local')->exists($data->file_location))
                  <a href="{{ route('dashboard.industry_statistic.view_file', $data->slug) }}" class="btn btn-sm btn-success" target="_blank">
                    <i class="fa fa-file-pdf-o"></i>
                  </a>
                @else
                  <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-exclamation-circle"></i></a>
                @endif
              </td>
              <td id="mid-vert">{{ optional($data->industryStatisticsCategory)->name }}</td>
              <td id="mid-vert">{{ optional($data->cropYear)->name }}</td>
              <td id="mid-vert">{{ $data->title }}</td>
              <td id="mid-vert">{{ __dataType::date_parse($data->cut_off_date) }}</td>
              <td id="mid-vert">
                <div class="btn-group">
                  <a type="button" class="btn btn-default" id="edit_button" href="{{ route('dashboard.industry_statistic.edit', $data->slug) }}">
                    <i class="fa fa-pencil"></i></a>
                  <a type="button" class="btn btn-default" id="delete_button" data-action="delete" data-url="{{ route('dashboard.industry_statistic.destroy', $data->slug) }}">
                    <i class="fa fa-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($industry_statistics->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($industry_statistics) !!}
        {!! $industry_statistics->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}
      </div>

    </div>

  </section>

@endsection





@section('modals')

  {!! __html::modal_delete('industry_statistic_delete') !!}

@endsection 





@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! __js::button_modal_confirm_delete_caller('industry_statistic_delete') !!}

    {{-- UPDATE TOAST --}}
    @if(Session::has('INDUSTRY_STATISTIC_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('INDUSTRY_STATISTIC_UPDATE_SUCCESS')) !!}
    @endif

    {{-- DELETE TOAST --}}
    @if(Session::has('INDUSTRY_STATISTIC_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('INDUSTRY_STATISTIC_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection