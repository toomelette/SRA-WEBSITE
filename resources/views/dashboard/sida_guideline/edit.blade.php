@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Edit SIDA Guideline</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.sida_guideline.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.sida_guideline.update', $sida_guideline->slug) }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">
            
            <input name="_method" value="PUT" type="hidden">

            @csrf   

            {!! __form::file(
              '4', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!} 
           
            {!! __form::textbox(
              '4', 'title', 'text', 'Title *', 'Title', old('title') ? old('title') : $sida_guideline->title, $errors->has('title'), $errors->first('title'), ''
            ) !!}
           
            {!! __form::textbox(
              '4', 'year', 'number', 'Year *', 'Year', old('year') ? old('year') : $sida_guideline->year, $errors->has('year'), $errors->first('year'), ''
            ) !!}
           
            {!! __form::textbox(
              '4', 'description', 'text', 'Description *', 'Description', old('description') ? old('description') : $sida_guideline->description, $errors->has('description'), $errors->first('description'), ''
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

    {!! __js::pdf_upload('doc_file', 'fa', route('dashboard.sida_guideline.view_file', $sida_guideline->slug)) !!}

  </script>
    
@endsection