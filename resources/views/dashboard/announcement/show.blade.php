@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title" style="padding-top: 5px;">Details</h2>
        <div class="pull-right">  
          {!! __html::back_button(['dashboard.announcement.index']) !!}
        </div> 
      </div>

        <div class="box-body">
          <div class="col-md-12">
            <h3>{{ $announcement->title }}</h3>
            <p>{!! $announcement->content !!}</p>
          </div>    
        </div> 

        <div class="box-footer">&nbsp;</div>

    </div>

</section>

@endsection