@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Add Office</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.office.store') }}">

        <div class="box-body">
          <div class="col-md-12">
                  
            @csrf    

            {!! __form::textbox(
              '3', 'seq_no', 'text', 'Sequence No. *', 'Sequence No.', old('seq_no'), $errors->has('seq_no'), $errors->first('seq_no'), ''
            ) !!}

            {!! __form::textbox(
              '9', 'name', 'text', 'Name *', 'Name', old('name'), $errors->has('name'), $errors->first('name'), ''
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

    @if(Session::has('OFFICE_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('OFFICE_CREATE_SUCCESS')) !!}
    @endif

  </script>
    
@endsection