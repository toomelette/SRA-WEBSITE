<?php

  $table_sessions = [ Session::get('ANNOUNCEMENT_UPDATE_SUCCESS_SLUG') ];

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
      <h1>Announcement List</h1>
  </section>

  <section class="content">
    
    {{-- Form Start --}}
    <form data-pjax class="form" id="filter_form" method="GET" autocomplete="off" action="{{ route('dashboard.announcement.index') }}">

    <div class="box box-solid" id="pjax-container" style="overflow-x:auto;">

      {{-- Table Search --}}        
      <div class="box-header with-border">
        {!! __html::table_search(route('dashboard.announcement.index')) !!}
      </div>

    {{-- Form End --}}  
    </form>

      {{-- Table Grid --}}        
      <div class="box-body no-padding">
        <table class="table table-hover">
          <tr>
            <th style="width: 100px">Attachment</th>
            <th>@sortablelink('title', 'Title')</th>
            <th>@sortablelink('content', 'Content')</th>
            <th>@sortablelink('updated_at', 'Last Updated')</th>
            <th style="width: 150px">Action</th>
          </tr>
          @foreach($announcements as $data) 
            <tr {!! __html::table_highlighter($data->slug, $table_sessions) !!} >
              <td id="mid-vert"> 
                @if($data->type == "FILE")

                  @if(Storage::disk('local')->exists($data->file_location))
                    <a href="{{ route('dashboard.announcement.view_file', $data->slug) }}" class="btn btn-sm btn-success" target="_blank">
                      <i class="fa fa-file-pdf-o"></i>
                    </a>
                  @else
                    <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-exclamation-circle"></i></a>
                  @endif

                @elseif($data->type == "URL")

                  @if(isset($data->url) || $data->url != "")
                    <a href="{{ $data->url }}" class="btn btn-sm btn-success" target="_blank">
                      <i class="fa  fa-link"></i>
                    </a>
                  @else
                    <a href="#" class="btn btn-sm btn-warning"><i class="fa fa-exclamation-circle"></i></a>
                  @endif

                @endif

              </td>
              <td id="mid-vert">{{ $data->title }}</td>
              <td id="mid-vert">{!! Str::limit(strip_tags($data->content), 75)  !!}</td>
              <td id="mid-vert">{{ $data->updated_at->diffForHumans() }}</td>
              <td id="mid-vert">
                <div class="btn-group">
                  <a type="button" class="btn btn-default" id="show_button" href="{{ route('dashboard.announcement.show', $data->slug) }}">
                    <i class="fa fa-eye"></i>
                  </a>
                  <a type="button" class="btn btn-default" id="edit_button" href="{{ route('dashboard.announcement.edit', $data->slug) }}">
                    <i class="fa fa-pencil"></i></a>
                  <a type="button" class="btn btn-default" id="delete_button" data-action="delete" data-url="{{ route('dashboard.announcement.destroy', $data->slug) }}">
                    <i class="fa fa-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
            @endforeach
          </table>
      </div>

      @if($announcements->isEmpty())
        <div style="padding :5px;">
          <center><h4>No Records found!</h4></center>
        </div>
      @endif

      <div class="box-footer">
        {!! __html::table_counter($announcements) !!}
        {!! $announcements->appends($appended_requests)->render('vendor.pagination.bootstrap-4')!!}
      </div>

    </div>

  </section>

@endsection





@section('modals')

  {!! __html::modal_delete('announcement_delete') !!}

@endsection 





@section('scripts')

  <script type="text/javascript">

    {{-- CALL CONFIRM DELETE MODAL --}}
    {!! __js::button_modal_confirm_delete_caller('announcement_delete') !!}

    {{-- UPDATE TOAST --}}
    @if(Session::has('ANNOUNCEMENT_UPDATE_SUCCESS'))
      {!! __js::toast(Session::get('ANNOUNCEMENT_UPDATE_SUCCESS')) !!}
    @endif

    {{-- DELETE TOAST --}}
    @if(Session::has('ANNOUNCEMENT_DELETE_SUCCESS'))
      {!! __js::toast(Session::get('ANNOUNCEMENT_DELETE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection