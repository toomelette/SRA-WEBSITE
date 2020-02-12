@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Edit Planters Directory</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.planters_directory.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.planters_directory.update', $planters_directory->slug) }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">

            <input name="_method" value="PUT" type="hidden">
                  
            @csrf   

            {!! __form::file(
              '5', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!} 

            {!! __form::select_dynamic(
              '7', 'planters_dir_cat_id', 'Category *', old('planters_dir_cat_id') ? old('planters_dir_cat_id') : $planters_directory->planters_dir_cat_id, $global_planters_directory_categories_all, 'planters_dir_cat_id', 'name', $errors->has('planters_dir_cat_id'), $errors->first('planters_dir_cat_id'), 'select2', ''
            ) !!}
           
            {!! __form::textbox(
              '7', 'title', 'text', 'Title *', 'Title', old('title') ? old('title') : $planters_directory->title, $errors->has('title'), $errors->first('title'), ''
            ) !!}
           
            {!! __form::textbox(
              '7', 'description', 'text', 'Description *', 'Description', old('description') ? old('description') : $planters_directory->description, $errors->has('description'), $errors->first('description'), ''
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

    {!! __js::pdf_upload('doc_file', 'fa', route('dashboard.planters_directory.view_file', $planters_directory->slug)) !!}

  </script>
    
@endsection