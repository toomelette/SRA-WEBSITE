@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Add Research</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.research.store') }}">

        <div class="box-body">
                  
            @csrf    

            {!! __form::textbox(
              '12', 'title', 'text', 'Title *', 'Title', old('title'), $errors->has('title'), $errors->first('title'), ''
            ) !!}

            {!! __form::textarea(
              '12', 'content', 'Content *', old('content'), $errors->has('content'), $errors->first('content'), ''
            ) !!}

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

    @if(Session::has('RESEARCH_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('RESEARCH_CREATE_SUCCESS')) !!}
    @endif

    $(function () {
      CKEDITOR.replace('editor');
    });

  </script>
    
@endsection