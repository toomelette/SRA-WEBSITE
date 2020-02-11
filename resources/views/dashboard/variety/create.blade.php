@extends('layouts.admin-master')

@section('content')

<section class="content">
            
    <div class="box box-solid">
        
      <div class="box-header with-border">
        <h2 class="box-title">Add Variety</h2>
        <div class="pull-right">
            <code>Fields with asterisks(*) are required</code>
        </div> 
      </div>
      
      <form method="POST" autocomplete="off" action="{{ route('dashboard.variety.store') }}" enctype="multipart/form-data">

        <div class="box-body">
          <div class="col-md-12">
                  
            @csrf  

            {!! __form::file(
              '5', 'doc_file', 'Upload File *', $errors->has('doc_file'), $errors->first('doc_file'), ''
            ) !!}   

            {!! __form::textbox(
              '7', 'name', 'text', 'Name *', 'Name', old('name'), $errors->has('name'), $errors->first('name'), ''
            ) !!}

          </div>
        </div>

        {{-- USER MENU DYNAMIC TABLE GRID --}}
        <div class="col-md-12" style="padding-top:10px;">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Data:</h3>
              <button id="add_row" type="button" class="btn btn-sm bg-green pull-right">Add Row &nbsp;<i class="fa fw fa-plus"></i></button>
            </div>
            
            <div class="box-body no-padding">
              
              <table class="table table-bordered">

                <tr>
                  <th style="width: 100px">Seq No.</th>
                  <th style="width: 400px">Field</th>
                  <th>Value</th>
                  <th style="width: 40px"></th>
                </tr>

                <tbody id="table_body">


                  @if(old('row'))


                    @foreach(old('row') as $key => $value)

                      <tr>

                        <td>
                          <div class="form-group">
                            <input type="text" name="row[{{ $key }}][seq_no]" class="form-control" placeholder="#" value="{{ $value['seq_no'] }}">
                            <small class="text-danger">{{ $errors->first('row.'. $key .'.seq_no') }}</small>
                          </div>
                        </td>


                        <td>
                          <div class="form-group">
                            <input type="text" name="row[{{ $key }}][field]" class="form-control" placeholder="Field" value="{{ $value['field'] }}">
                            <small class="text-danger">{{ $errors->first('row.'. $key .'.field') }}</small>
                          </div>
                        </td>


                        <td>
                          <div class="form-group">
                            <textarea type="text" name="row[{{ $key }}][value]" class="form-control" placeholder="Value" value="{{ $value['value'] }}" rows="4">{{ $value['value'] }}</textarea>
                            <small class="text-danger">{{ $errors->first('row.'. $key .'.value') }}</small>
                          </div>
                        </td>


                        <td>
                            <button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>
                        </td>

                      </tr>

                    @endforeach

                  @endif

                  </tbody>
              </table>
             
            </div>

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

    @if(Session::has('VARIETY_CREATE_SUCCESS'))
      {!! __js::toast(Session::get('VARIETY_CREATE_SUCCESS')) !!}
    @endif


    {{-- ADD ROW --}}
    $(document).ready(function() {
      $("#add_row").on("click", function() {
        var i = $("#table_body").children().length;
        var content ='<tr>' +
                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][seq_no]" class="form-control" placeholder="#">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<input type="text" name="row[' + i + '][field]" class="form-control" placeholder="Field">' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                          '<div class="form-group">' +
                            '<textarea  type="text" name="row[' + i + '][value]" class="form-control" rows="4">' +
                            '</textarea>' +
                          '</div>' +
                        '</td>' +

                        '<td>' +
                            '<button id="delete_row" type="button" class="btn btn-sm bg-red"><i class="fa fa-times"></i></button>' +
                        '</td>' +

                      '</tr>';
        $("#table_body").append($(content));
      });
    });

  {!! __js::img_upload('doc_file', 'fa', '') !!}

  </script>
    
@endsection