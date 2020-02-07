@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title" style="padding-top: 5px;">Edit Announcement</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.announcement.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.announcement.update', $announcement->slug) }}" enctype="multipart/form-data">

        <div class="box-body">

          <input name="_method" value="PUT" type="hidden">

          @csrf  

          {!! __form::select_static(
            '3', 'type', 'Type *', old('type') ? old('type') : $announcement->type, ['URL' => 'URL', 'FILE' => 'FILE'], $errors->has('type'), $errors->first('type'), '', ''
          ) !!}
          
          <div class="col-md-9"></div>

          <div class="col-md-12 no-padding" id="doc_file_div">

            {!! __form::file(
              '12', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!} 
          
          </div> 

          <div class="col-md-12 no-padding" id="url_div">

            {!! __form::textbox(
              '12', 'url', 'text', 'Url *', 'Url', old('url') ? old('url') : $announcement->url, $errors->has('url'), $errors->first('url'), ''
            ) !!}

          </div>

          {!! __form::textbox(
            '12', 'title', 'text', 'Title *', 'Title', old('title') ? old('title') : $announcement->title, $errors->has('title'), $errors->first('title'), ''
          ) !!}

          {!! __form::textarea(
            '12', 'content', 'Content *', old('content') ? old('content') : $announcement->content, $errors->has('content'), $errors->first('content'), ''
          ) !!}  
                
        </div>


        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

</section>

@endsection




@section('scripts')

  <script type="text/javascript">


    @if($announcement->type == 'FILE')
      $('#doc_file_div').show();
      $('#url_div').hide();
    @elseif($announcement->type == 'URL')
      $('#url_div').show();
      $('#doc_file_div').hide();
    @else
      $( document ).ready(function() {
        $('#url_div').hide();
        $('#doc_file_div').hide();
      });
    @endif


    @if(old('type') == 'FILE')
      $('#doc_file_div').show();
      $('#url_div').hide();
    @elseif(old('type') == 'URL')
      $('#url_div').show();
      $('#doc_file_div').hide();
    @endif


    $(document).on("change", "#type", function () {
      $('#doc_file').val('');
      $('#url').val('');
      var val = $(this).val();
        if(val == "FILE"){ 
          $('#doc_file_div').show();
          $('#url_div').hide();
        }else if(val == "URL"){
          $('#url_div').show();
          $('#doc_file_div').hide();
        }else{
          $('#url_div').hide();
          $('#doc_file_div').hide();
        }
    });


    {!! __js::pdf_upload('doc_file', 'fa', route('dashboard.announcement.view_file', $announcement->slug)) !!}


    $(function () {
      CKEDITOR.replace('editor');
    });


    @if(Session::has('ANNOUNCEMENT_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('ANNOUNCEMENT_CREATE_SUCCESS')) !!}
    @endif


  </script>
    
@endsection