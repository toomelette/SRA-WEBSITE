@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Edit Office</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
            &nbsp;
            {!! __html::back_button(['dashboard.office.index']) !!}
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.office.update', $office->slug) }}">

        <div class="box-body">
          <div class="col-md-12">
            
            <input name="_method" value="PUT" type="hidden">

            @csrf    

            {!! __form::textbox(
              '3', 'seq_no', 'text', 'Sequence No. *', 'Sequence No.', old('seq_no') ? old('seq_no') : $office->seq_no, $errors->has('seq_no'), $errors->first('seq_no'), ''
            ) !!}

            {!! __form::textbox(
              '9', 'name', 'text', 'Name *', 'Name', old('name') ? old('name') : $office->name, $errors->has('name'), $errors->first('name'), ''
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