@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Edit Policy</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.policy.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.policy.update', $policy->slug) }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">
            
            <input name="_method" value="PUT" type="hidden">

            @csrf   

            {!! __form::file(
              '4', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!} 

            {!! __form::select_dynamic(
              '4', 'crop_year_id', 'Crop Year *', old('crop_year_id') ? old('crop_year_id') : $policy->crop_year_id, $global_crop_years_all, 'crop_year_id', 'name', $errors->has('crop_year_id'), $errors->first('crop_year_id'), 'select2', ''
            ) !!}

            {!! __form::select_dynamic(
              '4', 'policy_category_id', 'Category *', old('policy_category_id') ? old('policy_category_id') : $policy->policy_category_id, $global_policy_categories_all, 'policy_category_id', 'name', $errors->has('policy_category_id'), $errors->first('policy_category_id'), 'select2', ''
            ) !!}
           
            {!! __form::textbox(
              '8', 'title', 'text', 'Title *', 'Title', old('title') ? old('title') : $policy->title, $errors->has('title'), $errors->first('title'), ''
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

    {!! __js::pdf_upload('doc_file', 'fa', route('dashboard.policy.view_file', $policy->slug)) !!}

  </script>
    
@endsection