@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Add SIDA Program</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.sida_program.store') }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">
                  
            @csrf   

            {!! __form::file(
              '4', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!} 

            {!! __form::select_dynamic(
              '4', 'province_id', 'Province *', old('province_id'), $global_provinces_all, 'province_id', 'name', $errors->has('province_id'), $errors->first('province_id'), 'select2', ''
            ) !!}

            {!! __form::select_dynamic(
              '4', 'mill_district_id', 'Mill District *', old('mill_district_id'), $global_mill_districts_all, 'mill_district_id', 'name', $errors->has('mill_district_id'), $errors->first('mill_district_id'), 'select2', ''
            ) !!}

            {!! __form::select_dynamic(
              '4', 'sida_program_cat_id', 'Program Category *', old('sida_program_cat_id'), $global_sida_program_categories_all, 'sida_program_cat_id', 'name', $errors->has('sida_program_cat_id'), $errors->first('sida_program_cat_id'), 'select2', ''
            ) !!}

            {!! __form::textbox(
              '4', 'year', 'number', 'Year *', 'Year', old('year'), $errors->has('year'), $errors->first('year'), ''
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

    @if(Session::has('SIDA_PROGRAM_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('SIDA_PROGRAM_CREATE_SUCCESS')) !!}
    @endif

    {!! __js::pdf_upload('doc_file', 'fa', '') !!}

  </script>
    
@endsection