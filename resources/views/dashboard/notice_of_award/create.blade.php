@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Add Notice of Award</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.notice_of_award.store') }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">
                  
            @csrf   

            {!! __form::file(
              '3', 'doc_file_noa', 'NOA *', $errors->has('doc_file_noa'), $errors->first('doc_file_noa'), ''
            ) !!} 

            {!! __form::file(
              '3', 'doc_file_bacreso', 'BAC Reso *', $errors->has('doc_file_bacreso'), $errors->first('doc_file_bacreso'), ''
            ) !!} 

            {!! __form::textbox(
              '6', 'description', 'text', 'Description *', 'Description', old('description'), $errors->has('description'), $errors->first('description'), ''
            ) !!}

            {!! __form::select_static(
              '3', 'station', 'Station *', old('station'), ['SRA-QUEZON CITY' => 'true', 'SRA-BACOLOD CITY' => 'false'], $errors->has('station'), $errors->first('station'), '', ''
            ) !!}

            {!! __form::datepicker(
              '3', 'date',  'Date *', old('date'), $errors->has('date'), $errors->first('date')
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

    @if(Session::has('NOTICE_OF_AWARD_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('NOTICE_OF_AWARD_CREATE_SUCCESS')) !!}
    @endif

    {!! __js::pdf_upload('doc_file_noa', 'fa', '') !!}

    {!! __js::pdf_upload('doc_file_bacreso', 'fa', '') !!}

  </script>
    
@endsection