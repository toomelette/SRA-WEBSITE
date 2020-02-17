@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Add SIDA Program Category</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.sida_program_category.store') }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">
                  
            @csrf   
           
            {!! __form::textbox(
              '6', 'name', 'text', 'Name *', 'Name', old('name'), $errors->has('name'), $errors->first('name'), ''
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

    @if(Session::has('SIDA_PROGRAM_CATEGORY_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('SIDA_PROGRAM_CATEGORY_CREATE_SUCCESS')) !!}
    @endif

    {!! __js::pdf_upload('doc_file', 'fa', '') !!}

  </script>
    
@endsection