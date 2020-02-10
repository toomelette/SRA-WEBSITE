@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Edit Historical Data</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.historical_data.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.historical_data.update', $historical_data->slug) }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">

            <input name="_method" value="PUT" type="hidden">
                  
            @csrf   

            {!! __form::file(
              '4', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!} 
           
            {!! __form::textbox(
              '8', 'title', 'text', 'Title *', 'Title', old('title') ? old('title') : $historical_data->title, $errors->has('title'), $errors->first('title'), ''
            ) !!}

            {!! __form::datepicker(
              '4', 'date_from',  'Date From *', old('date_from') ? old('date_from') : $historical_data->date_from, $errors->has('date_from'), $errors->first('date_from')
            ) !!}

            {!! __form::datepicker(
              '4', 'date_to',  'Date To *', old('date_to') ? old('date_to') : $historical_data->date_to, $errors->has('date_to'), $errors->first('date_to')
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

    {!! __js::pdf_upload('doc_file', 'fa', route('dashboard.historical_data.view_file', $historical_data->slug)) !!}

  </script>
    
@endsection