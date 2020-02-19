@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Edit Notice to Proceed</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.notice_to_proceed.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.notice_to_proceed.update', $notice_to_proceed->slug) }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">
            
            <input name="_method" value="PUT" type="hidden">
                  
            @csrf   

            {!! __form::file(
              '3', 'doc_file_ntp', 'NTP *', $errors->has('doc_file_ntp'), $errors->first('doc_file_ntp'), ''
            ) !!} 

            {!! __form::file(
              '3', 'doc_file_po', 'PO *', $errors->has('doc_file_po'), $errors->first('doc_file_po'), ''
            ) !!} 

            {!! __form::textbox(
              '6', 'description', 'text', 'Description *', 'Description', old('description') ? old('description') : $notice_to_proceed->description, $errors->has('description'), $errors->first('description'), ''
            ) !!}

            {!! __form::select_static(
              '3', 'station', 'Station *', old('station') ? old('station') : __dataType::boolean_to_string($notice_to_proceed->station), ['SRA-QUEZON CITY' => 'true', 'SRA-BACOLOD CITY' => 'false'], $errors->has('station'), $errors->first('station'), '', ''
            ) !!}

            {!! __form::datepicker(
              '3', 'date',  'Date *', old('date') ? old('date') : $notice_to_proceed->date, $errors->has('date'), $errors->first('date')
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

    {!! __js::pdf_upload('doc_file_ntp', 'fa', route('dashboard.notice_to_proceed.view_file', [$notice_to_proceed->slug, 'NTP'])) !!}

    {!! __js::pdf_upload('doc_file_po', 'fa', route('dashboard.notice_to_proceed.view_file', [$notice_to_proceed->slug, 'PO'])) !!}

  </script>
    
@endsection