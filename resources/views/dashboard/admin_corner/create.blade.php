@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Add Administrator's Record</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.admin_corner.store') }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">
                  
            @csrf   

            {!! __form::select_static(
              '4', 'type', 'Type *', old('type'), ['ACTIVITY' => '1', 'SPEECH/MESSAGE' => '2', 'PRESENTATION' => '3'], $errors->has('type'), $errors->first('type'), '', ''
            ) !!}
           
            {!! __form::textbox(
              '8', 'title', 'text', 'Title *', 'Title', old('title'), $errors->has('title'), $errors->first('title'), ''
            ) !!}

            {!! __form::file(
              '12', 'img_file', 'Upload Image', $errors->has('img_file'), $errors->first('img_file'), ''
            ) !!} 

            {!! __form::textarea(
              '12', 'content', 'Content *', old('content'), $errors->has('content'), $errors->first('content'), ''
            ) !!}

          </div>
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

    @if(Session::has('ADMIN_CORNER_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('ADMIN_CORNER_CREATE_SUCCESS')) !!}
    @endif

    {!! __js::img_upload('img_file', 'fa', '') !!}

    $(function () {
      CKEDITOR.replace('editor');
    });

  </script>
    
@endsection