<?php

  $table_sessions = [ Session::get('INVITATION_TO_BID_UPDATE_SUCCESS_SLUG') ];

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
      <h1>Invitation to Bid List</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.invitation_to_bid.index') }}">

    <div class="box box-solid" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.invitation_to_bid.index')) !!}
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
          @foreach($invitations_to_bid as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >

              <td id="mid-vert"> 

                @if(Storage::disk('local')->exists($data->file_location_itb))
                  <a href="{{ route('dashboard.invitation_to_bid.view_file', [$data->slug, 'ITB']) }}" class="btn btn-sm btn-success" target="_blank">
                    ITB
                  </a>
                @else
                  <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-exclamation-circle"></i></a>
                @endif

                @if(Storage::disk('local')->exists($data->file_location_pbd))
                  <a href="{{ route('dashboard.invitation_to_bid.view_file', [$data->slug, 'PBD']) }}" class="btn btn-sm btn-success" target="_blank">
                    PBD
                  </a>
                @else
                  <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-exclamation-circle"></i></a>
                @endif

              </td>

              <td id="mid-vert">{{ $data->description }}</td>
              <td id="mid-vert">{{ $data->station == 1 ? 'SRA - Quezon City' : 'SRA - Bacolod City' }}</td>
              <td id="mid-vert">{{ __dataType::date_parse($data->date, 'M d,Y') }}</td>
              <td id="mid-vert">
                <div class="btn-group">
                  <a type="button" class="btn btn-default" id="edit_button" href="{{ route('dashboard.invitation_to_bid.edit', $data->slug) }}">
                    <i class="fa fa-pencil"></i></a>
                  <a type="button" class="btn btn-default" id="delete_button" data-action="delete" data-url="{{ route('dashboard.invitation_to_bid.destroy', $data->slug) }}">
                    <i class="fa fa-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($invitations_to_bid->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($invitations_to_bid) !!}
        {!! $invitations_to_bid->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}
      </div>

    </div>

  </section>

@endsection





@section('modals')

  {!! __html::modal_delete('invitation_to_bid_delete') !!}

@endsection 





@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! __js::button_modal_confirm_delete_caller('invitation_to_bid_delete') !!}

    {{-- UPDATE TOAST --}}
    @if(Session::has('INVITATION_TO_BID_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('INVITATION_TO_BID_UPDATE_SUCCESS')) !!}
    @endif

    {{-- DELETE TOAST --}}
    @if(Session::has('INVITATION_TO_BID_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('INVITATION_TO_BID_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection