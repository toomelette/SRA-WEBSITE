@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Edit Mill District</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.mill_district.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.mill_district.update', $mill_district->slug) }}">

        <div class="box-body">

            <input name="_method" value="PUT" type="hidden">
                  
            @csrf     

            {!! __form::select_dynamic(
              '4', 'province_id', 'Province *', old('province_id') ? old('province_id') : $mill_district->province_id, $global_provinces_all, 'province_id', 'name', $errors->has('province_id'), $errors->first('province_id'), 'select2', ''
            ) !!} 

            {!! __form::textbox(
              '8', 'name', 'text', 'Name *', 'Name', old('name') ? old('name') : $mill_district->name, $errors->has('name'), $errors->first('name'), ''
            ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

</section>

@endsection