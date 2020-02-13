@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Add Industry Statistic</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.industry_statistic.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.industry_statistic.update', $industry_statistic->slug) }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">
            
            <input name="_method" value="PUT" type="hidden">

            @csrf   

            {!! __form::file(
              '4', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!} 

            {!! __form::select_dynamic(
              '4', 'crop_year_id', 'Crop Year *', old('crop_year_id') ? old('crop_year_id') : $industry_statistic->crop_year_id, $global_crop_years_all, 'crop_year_id', 'name', $errors->has('crop_year_id'), $errors->first('crop_year_id'), 'select2', ''
            ) !!}

            {!! __form::select_dynamic(
              '4', 'industry_statistics_category_id', 'Category *', old('industry_statistics_category_id') ? old('industry_statistics_category_id') : $industry_statistic->industry_statistics_category_id, $global_industry_statistics_categories_all, 'industry_statistics_category_id', 'name', $errors->has('industry_statistics_category_id'), $errors->first('industry_statistics_category_id'), 'select2', ''
            ) !!}
           
            {!! __form::textbox(
              '4', 'title', 'text', 'Title *', 'Title', old('title') ? old('title') : $industry_statistic->title, $errors->has('title'), $errors->first('title'), ''
            ) !!}

            {!! __form::datepicker(
              '4', 'cut_off_date',  'Cut Off Date *', old('cut_off_date') ? old('cut_off_date') : $industry_statistic->cut_off_date, $errors->has('cut_off_date'), $errors->first('cut_off_date')
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

    @if(Session::has('INDUSTRY_STATISTIC_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('INDUSTRY_STATISTIC_CREATE_SUCCESS')) !!}
    @endif

    {!! __js::pdf_upload('doc_file', 'fa', route('dashboard.industry_statistic.view_file', $industry_statistic->slug)) !!}

  </script>
    
@endsection