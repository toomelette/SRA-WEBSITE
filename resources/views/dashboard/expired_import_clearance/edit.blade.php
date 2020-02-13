@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Add Expired Import Clearance</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.expired_import_clearance.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.expired_import_clearance.update', $expired_import_clearance->slug) }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">

            <input name="_method" value="PUT" type="hidden">
                  
            @csrf   

            {!! __form::file(
              '4', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!} 

            {!! __form::select_dynamic(
              '4', 'expired_import_clearance_cat_id', 'Category *', old('expired_import_clearance_cat_id') ? old('expired_import_clearance_cat_id') : $expired_import_clearance->expired_import_clearance_cat_id, $global_expired_import_clearance_categories_all, 'expired_import_clearance_cat_id', 'name', $errors->has('expired_import_clearance_cat_id'), $errors->first('expired_import_clearance_cat_id'), '', ''
            ) !!}
           
            {!! __form::textbox(
              '4', 'year', 'text', 'Year *', 'Year', old('year') ? old('year') : $expired_import_clearance->year, $errors->has('year'), $errors->first('year'), ''
            ) !!}
           
            {!! __form::textbox(
              '8', 'title', 'text', 'Title *', 'Title', old('title') ? old('title') : $expired_import_clearance->title, $errors->has('title'), $errors->first('title'), ''
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

    {!! __js::pdf_upload('doc_file', 'fa', route('dashboard.expired_import_clearance.view_file', $expired_import_clearance->slug)) !!}

  </script>
    
@endsection