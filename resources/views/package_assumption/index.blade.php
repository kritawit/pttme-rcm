@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ Session::get('project') }}
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/project') }}"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Package and Assumption</li>
        </ol>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Package Assumption</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
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

                {!! Form::open(array('url'=>'package-assumption/package','class'=>'form-horizontal','role'=>'form')) !!}
                <fieldset>
                <div class="form-group">
                  {!! Form::label('name','Name : ',array('class'=>'col-lg-2 control-label')) !!}
                        <div class="col-lg-4">
                            {!! Form::text('name',null,array('class'=>'form-control')) !!}
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
                      <button type="submit" class="btn btn-success"></span> Save</button>
                    </div>
                  </div>
              </fieldset>
              {!! Form::close() !!}
             	<hr>
              <div class="col-sm-12">
                <div>
                    <table id="tb-package-assumption" class="table table-hover">
                      <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($package as $pk)
                        <tr>
                            <td>{{ $pk->name }}</td>
                            <td>{{ $pk->description }}</td>
                            <td class="text-center">
                                <a href="#" onclick="getEdit({{$pk->id}});return false;" class="text-warning"><span class="fa fa-edit fa-5"></span></a>
                            </td>
                            <td class="text-center">
                                <a href="#" onclick="desTroy({{$pk->id}});return false;" class="text-danger"><span class="fa fa-trash-o fa-5"></span></a>
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
          <h4 class="modal-title">Edit Package and Assumption Function</h4>
        </div>
        <div class="modal-body">
            {!! HTML::image('public/images/loader.GIF','',array('class' => 'loader')) !!}
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
	</section>
	@include('include.normal-js')
	<script type="text/javascript">
	$(function() {
		$("#tb-package-assumption").DataTable();
	});
  function getEdit(id){
    $.ajax({
      url: '{{url()}}/package-assumption/editpackage',
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
      url: '{{url()}}/package-assumption/destroypackage',
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