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
                    <div class="col-md-8">
                      <button type="submit" class="btn btn-success"> Save</button>
                        <a class="btn btn-warning" data-toggle="modal" href='#modal-import'><span class="fa fa-file-text"></span>  Import Failure CSV</a>
                        <a class="btn btn-info" data-toggle="modal" href='#modal-desc'><span class="fa fa-book"></span>  Description Guide CSV</a>
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

  <div class="modal fade" id="modal-import">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Import Basic Failure CSV</h4>
        </div>
        <div class="modal-body">
          {!! Form::open(array('url'=>'basic-data-setup/importbasicfailure','class'=>'form-horizontal','role'=>'form','method'=>'POST','files'=>true)) !!}
            <div class="form-group">
              <label for="" class="control-label col-lg-3">CSV File</label>
              <div class="col-lg-8">
                <input type="file" class="form-control" name="upload" value="" placeholder="">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-10 col-sm-offset-3">
                <button type="submit" class="btn btn-primary"><span class="fa fa-file-text"> Import</button>
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div class="modal modal-example-lg fade" id="modal-desc">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Description Guide CSV</h4>
        </div>
        <div class="modal-body">
          <div style="margin-bottom:15px;">
            <a href="{{url()}}/basic-data-setup/templatebasicfailure" class="btn btn-warning" download><i class="fa fa-download" ></i> Download Template</a>
          </div>
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">Failure Mode</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Failure Cause</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
            <table class="table table-hover" id="tb_mode">
            <thead>
              <tr>
                <th>ID</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($desc_mode as $mode): ?>
                <tr>
                  <td>{{$mode->id}}</td>
                  <td>{{$mode->description}}</td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <table class="table table-hover" id="tb_cause">
            <thead>
              <tr>
                <th>ID</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($desc_cause as $cause): ?>
                <tr>
                  <td>{{$cause->id}}</td>
                  <td>{{$cause->description}}</td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


	</section>
	@include('include.normal-js')
	<script type="text/javascript">
$(function() {
    $("#tb_mode").DataTable();
    $("#tb_cause").DataTable();
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