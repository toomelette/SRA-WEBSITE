<?php

  $table_sessions = [ Session::get('ADMIN_CORNER_UPDATE_SUCCESS_SLUG') ];

  $appended_requests = [
                        'q'=> Request::get('q'),
                        'sort' => Request::get('sort'),
                        'direction' => Request::get('direction'),
                        'e' => Request::get('e'),
                      ];

  $type = [
    '1' => 'ACTIVITY',
    '2' => 'SPEECH/MESSAGE',
    '3' => 'PRESENTATION',
  ]; 


?>





@extends('layouts.admin-master')

@section('content')
    
  <section class="content-header">
      <h1>Admin Corner Records</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.admin_corner.index') }}">

    <div class="box box-solid" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.admin_corner.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('title', 'Title')</th>
            <th>@sortablelink('type', 'Type')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($admin_corners as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
              <td id="mid-vert">{{ $data->title }}</td>
              <td id="mid-vert">{{ $type[$data->type] }}</td>
              <td id="mid-vert">
                <div class="btn-group">
                  <a type="button" class="btn btn-default" id="edit_button" href="{{ route('dashboard.admin_corner.edit', $data->slug) }}">
                    <i class="fa fa-pencil"></i></a>
                  <a type="button" class="btn btn-default" id="delete_button" data-action="delete" data-url="{{ route('dashboard.admin_corner.destroy', $data->slug) }}">
                    <i class="fa fa-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($admin_corners->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($admin_corners) !!}
        {!! $admin_corners->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}
      </div>

    </div>

  </section>

@endsection





@section('modals')

  {!! __html::modal_delete('admin_corner_delete') !!}

@endsection 





@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! __js::button_modal_confirm_delete_caller('admin_corner_delete') !!}

    {{-- UPDATE TOAST --}}
    @if(Session::has('ADMIN_CORNER_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('ADMIN_CORNER_UPDATE_SUCCESS')) !!}
    @endif

    {{-- DELETE TOAST --}}
    @if(Session::has('ADMIN_CORNER_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('ADMIN_CORNER_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection