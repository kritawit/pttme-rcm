@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ Session::get('project') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/project') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Reference Data - Task Interval Unit</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Reference Data - Task Interval Unit</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body" style="display: block;">
                @if($errors->has())
                <div class="alert alert-danger">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <p>The follow errors have occurred:</p>
                  <ul>
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                  </ul>
                </div>
                @endif

                {!! Form::open(array('url'=>'reference-data/task/interval','class'=>'form-horizontal','role'=>'form')) !!}
                <fieldset>
                <div class="form-group">
                  {!! Form::label('interval','Interval : ',array('class'=>'col-lg-2 control-label')) !!}
                        <div class="col-lg-2">
                            {!! Form::text('interval',null,array('class'=>'form-control')) !!}
                        </div>
                </div>
                <div class="form-group">
                  {!! Form::label('description','Description : ',array('class'=>'col-lg-2 control-label')) !!}
                        <div class="col-lg-4">
                            {!! Form::text('description',null,array('class'=>'form-control')) !!}
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
              <div class="col-sm-12">
                <div>
                    <table id="tb-task-interval" class="table table-hover">
                      <thead>
                      <tr>
                          <th class="text-center">Interval</th>
                          <th class="text-center">Description</th>
                          <th class="text-center">Edit</th>
                          <th class="text-center">Delete</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach($intervals as $interval)
                        <tr>
                            <td>{{ $interval->interval }}</td>
                            <td>{{ $interval->description }}</td>
                            <td class="text-center">
                                <a href="#" onclick="getEdit({{$interval->id}});"><span class="fa fa-edit text-warning"></span></a>
                            </td>
                            <td class="text-center">
                                <a href="#" onclick="desTroy({{$interval->id}});return false;"><span class="fa fa-trash-o text-danger"></span></a>
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
		</div>
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Edit Task Interval Unit</h4>
        </div>
        <div class="modal-body">
            {!! HTML::image('public/images/loader.GIF','',array('class' => 'loader')) !!}
        </div>
      </div>
    </div>
  </div>
	</section>
	@include('include.normal-js')
	<script type="text/javascript">
	$(function() {
		$("#tb-task-interval").DataTable();
	});
  function getEdit(id){
    $.ajax({
      url: '{{url()}}/reference-data/task/editinterval',
      type: 'POST',
      data: {'id':id, '_token': $('input[name=_token]').val()},
      success:function(data){
          $('#modal-edit').modal('show');
          $('.modal-body').html(data);
      }
    });
    return false;
  }

  function desTroy(id){
    if(confirm("Are you sure you want to delete?")){
      $.ajax({
      url: '{{url()}}/reference-data/task/destroyinterval',
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
@endsection