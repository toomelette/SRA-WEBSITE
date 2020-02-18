@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Edit SIDA Program</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.sida_program.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.sida_program.update', $sida_program->slug) }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">

            <input name="_method" value="PUT" type="hidden">
                  
            @csrf   

            {!! __form::file(
              '4', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!} 

            {!! __form::select_dynamic(
              '4', 'province_id', 'Province *', old('province_id') ? old('province_id') : $sida_program->province_id, $global_provinces_all, 'province_id', 'name', $errors->has('province_id'), $errors->first('province_id'), 'select2', ''
            ) !!}

            {!! __form::select_dynamic(
              '4', 'mill_district_id', 'Mill District *', old('mill_district_id') ? old('mill_district_id') : $sida_program->mill_district_id, $global_mill_districts_all, 'mill_district_id', 'name', $errors->has('mill_district_id'), $errors->first('mill_district_id'), 'select2', ''
            ) !!}

            {!! __form::select_dynamic(
              '4', 'sida_program_cat_id', 'Program Category *', old('sida_program_cat_id') ? old('sida_program_cat_id') : $sida_program->sida_program_cat_id, $global_sida_program_categories_all, 'sida_program_cat_id', 'name', $errors->has('sida_program_cat_id'), $errors->first('sida_program_cat_id'), 'select2', ''
            ) !!}

            {!! __form::textbox(
              '4', 'year', 'number', 'Year *', 'Year', old('year') ? old('year') : $sida_program->year, $errors->has('year'), $errors->first('year'), ''
            ) !!}
           
            {!! __form::textbox(
              '8', 'title', 'text', 'Title *', 'Title', old('title') ? old('title') : $sida_program->title, $errors->has('title'), $errors->first('title'), ''
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

    {!! __js::pdf_upload('doc_file', 'fa', route('dashboard.sida_program.view_file', $sida_program->slug)) !!}

  </script>
    
@endsection