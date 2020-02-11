<?php

  $table_sessions = [ Session::get('VARIETY_UPDATE_SUCCESS_SLUG') ];

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
      <h1>Varieties</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.variety.index') }}">

    <div class="box box-solid" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.variety.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th>@sortablelink('name', 'Name')</th>
            <th style="width: 200px">Action</th>
          </tr>
          @foreach($varieties as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >

              <td id="mid-vert">{{ $data->name }}</td>

              <td id="mid-vert">
                <div class="btn-group">
                  <a type="button" class="btn btn-default" id="show_button" href="{{ route('dashboard.variety.show', $data->slug) }}">
                    <i class="fa fa-eye"></i>
                  </a>
                  <a type="button" class="btn btn-default" id="edit_button" href="{{ route('dashboard.variety.edit', $data->slug) }}">
                    <i class="fa fa-pencil"></i></a>
                  <a type="button" class="btn btn-default" id="delete_button" data-action="delete" data-url="{{ route('dashboard.variety.destroy', $data->slug) }}">
                    <i class="fa fa-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($varieties->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($varieties) !!}
        {!! $varieties->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}
      </div>

    </div>

  </section>

@endsection





@section('modals')

  {!! __html::modal_delete('variety_delete') !!}

@endsection 





@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! __js::button_modal_confirm_delete_caller('variety_delete') !!}

    {{-- UPDATE TOAST --}}
    @if(Session::has('VARIETY_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('VARIETY_UPDATE_SUCCESS')) !!}
    @endif

    {{-- DELETE TOAST --}}
    @if(Session::has('VARIETY_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('VARIETY_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection