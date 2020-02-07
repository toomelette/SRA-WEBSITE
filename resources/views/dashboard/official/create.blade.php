@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Add Official</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.official.store') }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">
                  
            @csrf    


            {!! __form::file(
              '4', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!} 


            {!! __form::select_dynamic(
              '4', 'office_id', 'Office *', old('office_id'), $global_offices_all, 'office_id', 'name', $errors->has('office_id'), $errors->first('office_id'), 'select2', ''
            ) !!}


            {!! __form::select_dynamic(
              '4', 'station_id', 'Station *', old('station_id'), $global_stations_all, 'station_id', 'name', $errors->has('station_id'), $errors->first('station_id'), '', ''
            ) !!}


            {!! __form::textbox(
              '4', 'fullname', 'text', 'Fullname *', 'Fullname', old('fullname'), $errors->has('fullname'), $errors->first('fullname'), ''
            ) !!}


            {!! __form::textbox(
              '4', 'position', 'text', 'Position *', 'Position', old('position'), $errors->has('position'), $errors->first('position'), ''
            ) !!}


            {!! __form::textbox(
              '4', 'email', 'text', 'Email', 'Email', old('email'), $errors->has('email'), $errors->first('email'), ''
            ) !!}


            {!! __form::textbox(
              '4', 'contact_no', 'text', 'Contact No.', 'Contact No.', old('contact_no'), $errors->has('contact_no'), $errors->first('contact_no'), ''
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

    @if(Session::has('OFFICIAL_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('OFFICIAL_CREATE_SUCCESS')) !!}
    @endif

    {!! __js::img_upload('doc_file', 'fa', '') !!}

  </script>
    
@endsection