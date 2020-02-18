@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Edit Invitation to Bid</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.invitation_to_bid.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.invitation_to_bid.update', $invitation_to_bid->slug) }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">
            
            <input name="_method" value="PUT" type="hidden">
                  
            @csrf   

            {!! __form::file(
              '3', 'doc_file_itb', 'ITB *', $errors->has('doc_file_itb'), $errors->first('doc_file_itb'), ''
            ) !!} 

            {!! __form::file(
              '3', 'doc_file_pbd', 'PBD *', $errors->has('doc_file_pbd'), $errors->first('doc_file_pbd'), ''
            ) !!} 

            {!! __form::textbox(
              '6', 'description', 'text', 'Description *', 'Description', old('description') ? old('description') : $invitation_to_bid->description, $errors->has('description'), $errors->first('description'), ''
            ) !!}

            {!! __form::select_static(
              '3', 'station', 'Station *', old('station') ? old('station') : __dataType::boolean_to_string($invitation_to_bid->station), ['SRA-QUEZON CITY' => 'true', 'SRA-BACOLOD CITY' => 'false'], $errors->has('station'), $errors->first('station'), '', ''
            ) !!}

            {!! __form::datepicker(
              '3', 'date',  'Date *', old('date') ? old('date') : $invitation_to_bid->date, $errors->has('date'), $errors->first('date')
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

    {!! __js::pdf_upload('doc_file_itb', 'fa', route('dashboard.invitation_to_bid.view_file', [$invitation_to_bid->slug, 'ITB'])) !!}

    {!! __js::pdf_upload('doc_file_pbd', 'fa', route('dashboard.invitation_to_bid.view_file', [$invitation_to_bid->slug, 'PBD'])) !!}

  </script>
    
@endsection