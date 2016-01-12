@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ Session::get('project') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/project') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Basic Data Setup - Failure</li>
        </ol>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Basic data setup - Failure</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body" style="display: block;">
                @if($errors->has())
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <p>The Following Errors have occurred:</p>
                  <ul>
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                  </ul>
                </div>
                @endif
                {!! Form::open(array('url'=>'basic-data-setup/failure','class'=>'form-horizontal','role'=>'form')) !!}
                <fieldset>
                <div class="form-group">
                  <label for="stu_title" class="col-lg-2 control-label"><b>Failure Mode : </b></label>
                        <div class="col-lg-4" id="gradename">
                          {!! Form::select('mode_id',['' => 'Select Failure Mode'] +$modes,null,['class'=>'form-control select2']) !!}
                        </div>
                  </div>
                  <div class="form-group">
                  <label for="stu_title" class="col-lg-2 control-label"><b>Failure Cause : </b></label>
                    <div class="col-lg-4" id="classrm">
                        {!! Form::select('cause_id',['' => 'Select Failure Cause'] +$causes,null,['class'=>'form-control select2']) !!}
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-lg-2"></label>
                    <div class="col-md-4">
                      <button type="submit" class="btn btn-success"> Save</button>
                    </div>
                  </div>
              </fieldset>
              {!! Form::close() !!}
                	<hr>
                	<div>
                		<table id="tb-failure" class="table table-hover">
                			<thead>
                				<tr>
                                    <th class="text-center">Failure Mode</th>
                                    <th class="text-center">Failure Cause</th>
                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Delete</th>
                                </tr>
                			</thead>
                			<tbody>
                				@foreach($basics as $basic)
                        <tr>
                            <td>{{ $basic->mode->description }}</td>
                            <td>{{ $basic->cause->description }}</td>
                            <td class="text-center">
                                <a href="#" onclick="getEdit({{$basic->id}});"><span class="fa fa-edit text-warning"></span></a>
                            </td>
                            <td class="text-center">
                                <a href="#" onclick="desTroy({{$basic->id}});return false;"><span class="fa fa-trash-o text-danger"></span></a>
                            </td>
                        </tr>
                        @endforeach
                			</tbody>
                		</table>
                	</div>
                </div>
            </div>
			</div>
		</div>
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Basic data setup - Edit Failure</h4>
        </div>
        <div class="modal-body" id="content-edit">
            {!! HTML::image('public/images/loader.GIF','',array('class' => 'loader')); !!}
        </div>
      </div>
    </div>
  </div>
	</section>
	@include('include.normal-js')
	<script type="text/javascript">
$(function() {
		$("#tb-failure").DataTable({ordering: false});
function groupTable($rows, startIndex, total){
if (total === 0){
  return;
}
var i , currentIndex = startIndex, count=1, lst=[];
var tds = $rows.find('td:eq('+ currentIndex +')');
var ctrl = $(tds[0]);
lst.push($rows[0]);
for (i=1;i<=tds.length;i++){
  if (ctrl.text() ==  $(tds[i]).text()){
  count++;
  $(tds[i]).addClass('deleted');
  lst.push($rows[i]);
}
else{
  if (count>1){
    ctrl.attr('rowspan',count);
    groupTable($(lst),startIndex+1,total-1);
  }
  count=1;
  lst = [];
  ctrl=$(tds[i]);
  lst.push($rows[i]);
    }
  }
}
groupTable($('#tb-equipment tr:has(td)'),0,3);

$('#tb-equipment .deleted').remove();

	});
    function getEdit(id){
    $.ajax({
      url: '{{url()}}/basic-data-setup/editfailure',
      type: 'POST',
      data: {'id':id, '_token': $('input[name=_token]').val()},
      success:function(data){
          $('#modal-edit').modal('show');
          $('#content-edit').html(data);
      }
    });
    return false;
  }

  function desTroy(id){
    if(confirm("Are you sure you want to delete?")){
      $.ajax({
      url: '{{url()}}/basic-data-setup/destroyfailure',
      type: 'POST',
      data: {'id':id, '_token': $('input[name=_token]').val()},
      success:function(data){
        if(data='success'){
          location.reload();
        }
      }
      });
    }
  }
	</script>
@stop