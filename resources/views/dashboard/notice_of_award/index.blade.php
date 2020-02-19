<?php

  $table_sessions = [ Session::get('NOTICE_OF_AWARD_UPDATE_SUCCESS_SLUG') ];

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
      <h1>Notice of Award List</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.notice_of_award.index') }}">

    <div class="box box-solid" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.notice_of_award.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th style="width: 150px">Attachment</th>
            <th>@sortablelink('description', 'Description')</th>
            <th>@sortablelink('station', 'Station')</th>
            <th>@sortablelink('date', 'Date')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($notice_of_award as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >

              <td id="mid-vert"> 

                @if(Storage::disk('local')->exists($data->file_location_noa))
                  <a href="{{ route('dashboard.notice_of_award.view_file', [$data->slug, 'NOA']) }}" class="btn btn-sm btn-success" target="_blank">
                    NOA
                  </a>
                @endif

                @if(Storage::disk('local')->exists($data->file_location_bacreso))
                  <a href="{{ route('dashboard.notice_of_award.view_file', [$data->slug, 'BACRESO']) }}" class="btn btn-sm btn-success" target="_blank">
                    BAC Reso
                  </a>
                @endif

              </td>

              <td id="mid-vert">{{ $data->description }}</td>
              <td id="mid-vert">{{ $data->station == 1 ? 'SRA - Quezon City' : 'SRA - Bacolod City' }}</td>
              <td id="mid-vert">{{ __dataType::date_parse($data->date, 'M d,Y') }}</td>
              <td id="mid-vert">
                <div class="btn-group">
                  <a type="button" class="btn btn-default" id="edit_button" href="{{ route('dashboard.notice_of_award.edit', $data->slug) }}">
                    <i class="fa fa-pencil"></i></a>
                  <a type="button" class="btn btn-default" id="delete_button" data-action="delete" data-url="{{ route('dashboard.notice_of_award.destroy', $data->slug) }}">
                    <i class="fa fa-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($notice_of_award->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($notice_of_award) !!}
        {!! $notice_of_award->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}
      </div>

    </div>

  </section>

@endsection





@section('modals')

  {!! __html::modal_delete('notice_of_award_delete') !!}

@endsection 





@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! __js::button_modal_confirm_delete_caller('notice_of_award_delete') !!}

    {{-- UPDATE TOAST --}}
    @if(Session::has('NOTICE_OF_AWARD_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('NOTICE_OF_AWARD_UPDATE_SUCCESS')) !!}
    @endif

    {{-- DELETE TOAST --}}
    @if(Session::has('NOTICE_OF_AWARD_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('NOTICE_OF_AWARD_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection