@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Add Invitation to Bid</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.invitation_to_bid.store') }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">
                  
            @csrf   

            {!! __form::file(
              '3', 'doc_file_itb', 'ITB *', $errors->has('doc_file_itb'), $errors->first('doc_file_itb'), ''
            ) !!} 

            {!! __form::file(
              '3', 'doc_file_pbd', 'PBD *', $errors->has('doc_file_pbd'), $errors->first('doc_file_pbd'), ''
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

    @if(Session::has('INVITATION_TO_BID_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('INVITATION_TO_BID_CREATE_SUCCESS')) !!}
    @endif

    {!! __js::pdf_upload('doc_file_itb', 'fa', '') !!}

    {!! __js::pdf_upload('doc_file_pbd', 'fa', '') !!}

  </script>
    
@endsection