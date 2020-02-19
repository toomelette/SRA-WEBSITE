@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Edit Minutes of the Bid Bid</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.minutes_of_the_bid.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.minutes_of_the_bid.update', $minutes_of_the_bid->slug) }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">
            
            <input name="_method" value="PUT" type="hidden">
                  
            @csrf   

            {!! __form::file(
              '4', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!} 

            {!! __form::textbox(
              '8', 'title', 'text', 'Title *', 'Title', old('title') ? old('title') : $minutes_of_the_bid->title, $errors->has('title'), $errors->first('title'), ''
            ) !!}

            {!! __form::textbox(
              '4', 'location', 'text', 'Location *', 'Location', old('location') ? old('location') : $minutes_of_the_bid->location, $errors->has('location'), $errors->first('location'), ''
            ) !!}

            {!! __form::datepicker(
              '4', 'date',  'Date *', old('date') ? old('date') : $minutes_of_the_bid->date, $errors->has('date'), $errors->first('date')
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

    {!! __js::pdf_upload('doc_file', 'fa', route('dashboard.minutes_of_the_bid.view_file', $minutes_of_the_bid->slug)) !!}

  </script>
    
@endsection