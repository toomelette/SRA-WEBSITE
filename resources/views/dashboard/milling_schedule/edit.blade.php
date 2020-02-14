@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Edit Milling Schedule</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.milling_schedule.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.milling_schedule.update', $milling_schedule->slug) }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">

            <input name="_method" value="PUT" type="hidden">

            @csrf   

            {!! __form::file(
              '5', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!} 
           
            {!! __form::textbox(
              '7', 'title', 'text', 'Title *', 'Title', old('title') ? old('title') : $milling_schedule->title, $errors->has('title'), $errors->first('title'), ''
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

    @if(Session::has('MILLING_SCHEDULE_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('MILLING_SCHEDULE_CREATE_SUCCESS')) !!}
    @endif

    {!! __js::pdf_upload('doc_file', 'fa', route('dashboard.milling_schedule.view_file', $milling_schedule->slug)) !!}

  </script>
    
@endsection