@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title" style="padding-top: 5px;">Edit News</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.news.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.news.update', $news->slug) }}" enctype="multipart/form-data">

        <div class="box-body">

          <input name="_method" value="PUT" type="hidden">

          @csrf  

          <div class="col-md-12 no-padding">

            {!! __form::file(
              '6', 'img_file', 'Upload Image *', $errors->has('img_file'), $errors->first('img_file'), ''
            ) !!} 

          </div>

          {!! __form::select_static(
            '3', 'type', 'Type *', old('type') ? old('type') : $news->type, ['URL' => 'URL', 'FILE' => 'FILE'], $errors->has('type'), $errors->first('type'), '', ''
          ) !!}
          
          <div class="col-md-12"></div>

          <div class="col-md-6 no-padding" id="doc_file_div">

            {!! __form::file(
              '12', 'doc_file', 'File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!} 
          
          </div> 

          <div class="col-md-12 no-padding" id="url_div">

            {!! __form::textbox(
              '6', 'url', 'text', 'Url *', 'Url', old('url') ? old('url') : $news->url, $errors->has('url'), $errors->first('url'), ''
            ) !!}

          </div>

          {!! __form::textbox(
            '12', 'title', 'text', 'Title *', 'Title', old('title') ? old('title') : $news->title, $errors->has('title'), $errors->first('title'), ''
          ) !!}

          {!! __form::textarea(
            '12', 'content', 'Content *', old('content') ? old('content') : $news->content, $errors->has('content'), $errors->first('content'), ''
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


    @if($news->type == 'FILE')
      $('#doc_file_div').show();
      $('#url_div').hide();
    @elseif($news->type == 'URL')
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


    {!! __js::img_upload('img_file', 'fa', route('dashboard.news.view_img', $news->slug)) !!}

    {!! __js::pdf_upload('doc_file', 'fa', route('dashboard.news.view_file', $news->slug)) !!}


    $(function () {
      CKEDITOR.replace('editor');
    });


    @if(Session::has('NEWS_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('NEWS_CREATE_SUCCESS')) !!}
    @endif


  </script>
    
@endsection