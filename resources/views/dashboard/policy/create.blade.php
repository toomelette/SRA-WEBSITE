@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Add Policy</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.policy.store') }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">
                  
            @csrf   

            {!! __form::file(
              '4', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!} 

            {!! __form::select_dynamic(
              '4', 'crop_year_id', 'Crop Year *', old('crop_year_id'), $global_crop_years_all, 'crop_year_id', 'name', $errors->has('crop_year_id'), $errors->first('crop_year_id'), 'select2', ''
            ) !!}

            {!! __form::select_dynamic(
              '4', 'policy_category_id', 'Category *', old('policy_category_id'), $global_policy_categories_all, 'policy_category_id', 'name', $errors->has('policy_category_id'), $errors->first('policy_category_id'), 'select2', ''
            ) !!}
           
            {!! __form::textbox(
              '8', 'title', 'text', 'Title *', 'Title', old('title'), $errors->has('title'), $errors->first('title'), ''
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

    @if(Session::has('POLICY_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('POLICY_CREATE_SUCCESS')) !!}
    @endif

    {!! __js::pdf_upload('doc_file', 'fa', '') !!}

  </script>
    
@endsection