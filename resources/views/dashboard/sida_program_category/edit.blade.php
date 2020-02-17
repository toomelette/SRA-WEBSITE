@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Edit SIDA Program Category</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.sida_program_category.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.sida_program_category.update', $sida_program_category->slug) }}">

        <div class="box-body">

            <input name="_method" value="PUT" type="hidden">
                  
            @csrf    

            {!! __form::textbox(
              '6', 'name', 'text', 'Name *', 'Name', old('name') ? old('name') : $sida_program_category->name, $errors->has('name'), $errors->first('name'), ''
            ) !!}

        </div>

        <div class="box-footer">
          <button type="submit" class="btn btn-default">Save <i class="fa fa-fw fa-save"></i></button>
        </div>

      </form>

    </div>

</section>

@endsection