<?php

  $table_sessions = [ Session::get('OFFICIAL_UPDATE_SUCCESS_SLUG') ];

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
      <h1>List of Officials</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.official.index') }}">

    <div class="box box-solid" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.official.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th style="text-align:center; width:150px;">@sortablelink('', 'Avatar')</th>
            <th>@sortablelink('fullname', 'Fullname')</th>
            <th>@sortablelink('office.name', 'Office')</th>
            <th>@sortablelink('station.name', 'Station')</th>
            <th>@sortablelink('email', 'Email')</th>
            <th>@sortablelink('contact_no', 'Contact No.')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($officials as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >

              <td  style="padding:15px; text-align:center;">
                @if(isset($data->file_location) && $data->file_location != "")

                  <img src="{{ route('dashboard.official.view_avatar', $data->slug) }}" class="profile-user-img img-responsive img-circle" alt="User Image"  style="width:70px;">

                @else

                  <img src="{{ asset('images/avatar.jpeg') }}" class="profile-user-img img-responsive img-circle" alt="User Image"  style="width:70px;">

                @endif
              </td>

              <td id="mid-vert">{{ $data->fullname }}</td>
              <td id="mid-vert">{{ $data->office->name }}</td>
              <td id="mid-vert">{{ $data->station->name }}</td>
              <td id="mid-vert">{{ $data->email }}</td>
              <td id="mid-vert">{{ $data->contact_no }}</td>

              <td id="mid-vert">
                <div class="btn-group">
                  <a type="button" class="btn btn-default" id="show_button" href="{{ route('dashboard.official.show', $data->slug) }}">
                    <i class="fa fa-eye"></i>
                  </a>
                  <a type="button" class="btn btn-default" id="edit_button" href="{{ route('dashboard.official.edit', $data->slug) }}">
                    <i class="fa fa-pencil"></i></a>
                  <a type="button" class="btn btn-default" id="delete_button" data-action="delete" data-url="{{ route('dashboard.official.destroy', $data->slug) }}">
                    <i class="fa fa-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($officials->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($officials) !!}
        {!! $officials->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}
      </div>

    </div>

  </section>

@endsection





@section('modals')

  {!! __html::modal_delete('official_delete') !!}

@endsection 





@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! __js::button_modal_confirm_delete_caller('official_delete') !!}

    {{-- UPDATE TOAST --}}
    @if(Session::has('OFFICIAL_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('OFFICIAL_UPDATE_SUCCESS')) !!}
    @endif

    {{-- DELETE TOAST --}}
    @if(Session::has('OFFICIAL_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('OFFICIAL_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection