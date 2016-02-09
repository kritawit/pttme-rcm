@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ Session::get('project') }}
        </h1>
        <ol class="breadcrumb">
           <li><a href="{{ url('/project') }}"><i class="fa fa-home"></i> Home</a></li>
           <li class="active">Reference Data - Equipment Category</li>
         </ol>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Reference Data - Equipment Category</h3>
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

                {!! Form::open(array('url'=>'reference-data/equipment/category','class'=>'form-horizontal','role'=>'form')) !!}
                <fieldset>
                <div class="form-group">
                  {!! Form::label('description','Equipment Category: ',array('class'=>'col-lg-2 control-label')) !!}
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
              <a href="#" class="btn btn-danger" onclick="deleteRef();return false;"><i class="fa fa-trash-o"></i> Delete Selected</a>
              <hr>
                <div>
                    <table id="tb-equipment" class="table table-hover">
                      <thead>
                        <tr>
                            <th class="text-center">Active</th>
                            <th class="text-center">Equipment Category</th>
                            <th class="text-center">Created By</th>
                            <th class="text-center">Created Date</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($category as $cate)
                        <tr>
                            <td width="20"><input type="checkbox" value="{{ $cate->id }}" name="active[]"></td>
                            <td>{{ $cate->description }}</td>
                            <td>{{$cate->members->name}}</td>
                            <td>{{$cate->created_at}}</td>
                            <td class="text-center">
                                <a href="#" onclick="getEdit({{$cate->id}});"><span class="fa fa-edit text-warning"></span></a>
                            </td>
                            <td class="text-center">
                              <a href="#" onclick="desTroy({{$cate->id}});return false;"><span class="fa fa-trash-o text-danger"></span></a>
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
          <h4 class="modal-title">Edit Equipment Category</h4>
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
		var table = $("#tb-equipment").DataTable();
	});
  function deleteRef() {
    var checked = new Array();
    checked = $(':checkbox:checked[name^=active]').val();
    if (checked != null) {
      if(confirm("Are you sure you want to delete?")){
        $(':checkbox:checked[name^=active]').val(function() {
          deleteSelect(this.value);
        });
        
        setTimeout(function() {
          window.location.reload();
        }, 100);

      }
    }else {
      alert('Please select!');
    }
  }
  function getEdit(id){
    $.ajax({
      url: '{{url()}}/reference-data/equipment/editcategory',
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
      url: '{{url()}}/reference-data/equipment/destroycategory',
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
  function deleteSelect(id){
    $.ajax({
      url: '{{url()}}/reference-data/equipment/destroycategory',
      type: 'POST',
      data: {'id':id, '_token': $('input[name=_token]').val()}
    });
  }
	</script>
@stop