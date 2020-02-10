@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title" style="padding-top: 5px;">Details</h2>
        <div class="pull-right">  
          {!! __html::back_button(['dashboard.official.index']) !!}
        </div> 
      </div>

        <div class="box-body box-profile" style="padding:20px;">

          <div class="col-md-3">
            
            @if(isset($official->file_location) && $official->file_location != "")

              <img class="profile-user-img img-responsive img-circle" src="{{ route('dashboard.official.view_avatar', $official->slug) }}" alt="User profile picture" style="width:200px;">

            @else

              <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/avatar.jpeg') }}" alt="User profile picture" style="width:250px;">

            @endif

            <h3 class="profile-username text-center">{{ $official->fullname }}</h3>

            <p class="text-muted text-center">{{ $official->position }}</p>

          </div>


          <div class="col-md-9">

            <strong><i class="fa fa-building margin-r-5"></i>Office</strong>
            <p class="text-muted">{{ $official->office->name }}</p>

            <hr>

            <strong><i class="fa fa-map-marker margin-r-5"></i>Station</strong>
            <p class="text-muted">{{ $official->station->name }}</p>

            <hr>

            <strong><i class="fa fa-envelope margin-r-5"></i>Email</strong>
            <p class="text-muted">{{ $official->email }}</p>

            <hr>

            <strong><i class="fa fa-envelope margin-r-5"></i>Contact No.</strong>
            <p class="text-muted">{{ $official->contact_no }}</p>

            <hr>

          </div>


        </div> 

    </div>

</section>

@endsection