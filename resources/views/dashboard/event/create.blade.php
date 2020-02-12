@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Add Event</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.event.store') }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">
                  
            @csrf   

            {!! __form::file(
              '4', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!} 


            {!! __form::select_dynamic(
              '8', 'station_id', 'Station *', old('station_id'), $global_stations_all, 'station_id', 'name', $errors->has('station_id'), $errors->first('station_id'), '', ''
            ) !!}
           
            {!! __form::textbox(
              '8', 'title', 'text', 'Title *', 'Title', old('title'), $errors->has('title'), $errors->first('title'), ''
            ) !!}
           
            {!! __form::textbox(
              '8', 'description', 'text', 'Description *', 'Description', old('description'), $errors->has('description'), $errors->first('description'), ''
            ) !!}

            {!! __form::datepicker(
              '4', 'date_from',  'Date From *', old('date_from'), $errors->has('date_from'), $errors->first('date_from')
            ) !!}

            {!! __form::datepicker(
              '4', 'date_to',  'Date To *', old('date_to'), $errors->has('date_to'), $errors->first('date_to')
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

    @if(Session::has('EVENT_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('EVENT_CREATE_SUCCESS')) !!}
    @endif

    {!! __js::pdf_upload('doc_file', 'fa', '') !!}

  </script>
    
@endsection