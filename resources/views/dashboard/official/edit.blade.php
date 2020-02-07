@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Edit Official</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.official.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.official.update', $official->slug) }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">

            <input name="_method" value="PUT" type="hidden">
                  
            @csrf    

            {!! __form::file(
              '4', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!} 


            {!! __form::select_dynamic(
              '4', 'office_id', 'Office *', old('office_id') ? old('office_id') : $official->office_id, $global_offices_all, 'office_id', 'name', $errors->has('office_id'), $errors->first('office_id'), 'select2', ''
            ) !!}


            {!! __form::select_dynamic(
              '4', 'station_id', 'Station *', old('station_id') ? old('station_id') : $official->station_id, $global_stations_all, 'station_id', 'name', $errors->has('station_id'), $errors->first('station_id'), '', ''
            ) !!}


            {!! __form::textbox(
              '4', 'fullname', 'text', 'Fullname *', 'Fullname', old('fullname') ? old('fullname') : $official->fullname, $errors->has('fullname'), $errors->first('fullname'), ''
            ) !!}


            {!! __form::textbox(
              '4', 'position', 'text', 'Position *', 'Position', old('position') ? old('position') : $official->position, $errors->has('position'), $errors->first('position'), ''
            ) !!}


            {!! __form::textbox(
              '4', 'email', 'text', 'Email', 'Email', old('email') ? old('email') : $official->email, $errors->has('email'), $errors->first('email'), ''
            ) !!}


            {!! __form::textbox(
              '4', 'contact_no', 'text', 'Contact No.', 'Contact No.', old('contact_no') ? old('contact_no') : $official->contact_no, $errors->has('contact_no'), $errors->first('contact_no'), ''
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

    {!! __js::img_upload('doc_file', 'fa', route('dashboard.official.view_avatar', $official->slug)) !!}

  </script>
    
@endsection