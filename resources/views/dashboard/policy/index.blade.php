<?php

  $table_sessions = [ Session::get('POLICY_UPDATE_SUCCESS_SLUG') ];

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
      <h1>Policy List</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.policy.index') }}">

    <div class="box box-solid" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.policy.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th style="width: 100px">Attachment</th>
            <th>@sortablelink('policyCategory.name', 'Category')</th>
            <th>@sortablelink('cropYear.name', 'Crop Year')</th>
            <th>@sortablelink('title', 'Title')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($policies as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
              <td id="mid-vert"> 
                @if(Storage::disk('local')->exists($data->file_location))
                  <a href="{{ route('dashboard.policy.view_file', $data->slug) }}" class="btn btn-sm btn-success" target="_blank">
                    <i class="fa fa-file-pdf-o"></i>
                  </a>
                @else
                  <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-exclamation-circle"></i></a>
                @endif
              </td>
              <td id="mid-vert">{{ optional($data->policyCategory)->name }}</td>
              <td id="mid-vert">{{ optional($data->cropYear)->name }}</td>
              <td id="mid-vert">{{ $data->title }}</td>
              <td id="mid-vert">
                <div class="btn-group">
                  <a type="button" class="btn btn-default" id="edit_button" href="{{ route('dashboard.policy.edit', $data->slug) }}">
                    <i class="fa fa-pencil"></i></a>
                  <a type="button" class="btn btn-default" id="delete_button" data-action="delete" data-url="{{ route('dashboard.policy.destroy', $data->slug) }}">
                    <i class="fa fa-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($policies->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($policies) !!}
        {!! $policies->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}
      </div>

    </div>

  </section>

@endsection





@section('modals')

  {!! __html::modal_delete('policy_delete') !!}

@endsection 





@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! __js::button_modal_confirm_delete_caller('policy_delete') !!}

    {{-- UPDATE TOAST --}}
    @if(Session::has('POLICY_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('POLICY_UPDATE_SUCCESS')) !!}
    @endif

    {{-- DELETE TOAST --}}
    @if(Session::has('POLICY_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('POLICY_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection