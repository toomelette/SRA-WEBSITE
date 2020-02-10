@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Edit Administrator</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.administrator.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.administrator.update', $administrator->slug) }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">

            <input name="_method" value="PUT" type="hidden">
                  
            @csrf   

            {!! __form::file(
              '4', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!} 
           
            {!! __form::textbox(
              '4', 'fullname', 'text', 'Fullname *', 'Fullname', old('fullname') ? old('fullname') : $administrator->fullname, $errors->has('fullname'), $errors->first('fullname'), 'data-transform="uppercase"'
            ) !!}

            {!! __form::textbox(
              '4', 'date_scope', 'text', 'Scope of Date *', 'Scope of Date', old('date_scope') ? old('date_scope') : $administrator->date_scope, $errors->has('date_scope'), $errors->first('date_scope'), ''
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

    {!! __js::img_upload('doc_file', 'fa', route('dashboard.administrator.view_avatar', $administrator->slug)) !!}

  </script>
    
@endsection