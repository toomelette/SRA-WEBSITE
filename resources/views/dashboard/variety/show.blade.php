@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title" style="padding-top: 5px;">Details</h2>
        <div class="pull-right">  
          {!! __html::back_button(['dashboard.variety.index']) !!}
        </div> 
      </div>

        <div class="box-body box-profile" style="padding:20px;">

          <div class="col-md-3">
            
            @if(isset($variety->file_location) && $variety->file_location != "")

              <img class="img-responsive" src="{{ route('dashboard.variety.view_img', $variety->slug) }}" alt="User profile picture" style="width:280px;">

            @endif

            <h3 class="profile-username text-center">{{ $variety->fullname }}</h3>

            <p class="text-muted text-center">{{ $variety->position }}</p>

          </div>


          <div class="col-md-9">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Variety Data</h3>
                </div>
                <div class="box-body">

                  <table class="table table-hover">
                    <tr>
                      <th>Field</th>
                      <th>Value</th>
                    </tr>
                    @foreach($variety->varietyData->sortBy('seq_no') as $data) 

                        <td id="mid-vert">{{ $data->field }}</td>
                        <td id="mid-vert">{{ $data->value }}</td>
                      </tr>
                    @endforeach
                  </table>

                </div>
              </div>

          </div>


        </div> 

    </div>

</section>

@endsection