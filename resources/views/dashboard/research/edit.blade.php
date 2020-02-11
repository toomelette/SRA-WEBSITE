@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Edit Research</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.research.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.research.update', $research->slug) }}">

        <div class="box-body">

            <input name="_method" value="PUT" type="hidden">
                  
            @csrf    

            {!! __form::textbox(
              '12', 'title', 'text', 'Title *', 'Title', old('title') ? old('title') : $research->title, $errors->has('title'), $errors->first('title'), ''
            ) !!}

            {!! __form::textarea(
              '12', 'content', 'Content *', old('content') ? old('content') : $research->content, $errors->has('content'), $errors->first('content'), ''
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

    $(function () {
      CKEDITOR.replace('editor');
    });

  </script>
    
@endsection