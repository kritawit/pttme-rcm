@extends('layouts.app')
@section('content')
        <section class="content-header">
            <h1>Project Management</h1>
          <ol class="breadcrumb">
            <li><a href="/project"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">List All Projects</h3>
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
                        @if(Session::has('message'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <p>{{Session::get('message')}}</p>
                            </div>
                        @endif
                        <button class="btn btn-success" id="btn-new-project"><i class="glyphicon glyphicon-plus"></i> New RCM Project</button>
                        <hr>
                        <div class="col-sm-12">
                            <div>
                                <table id="tb-openrecent" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Project Name</th>
                                            <th class="text-center">Duplicate Project</th>
                                            <th class="text-center">Open</th>
                                            <th class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($project as $pro)
                                            <tr>
                                                <td>{{ $pro->name }}</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn bg-maroon" onclick="dupproject({{ $pro->id }});"><span class="fa fa-copy"></span></button>
                                                </td>
                                                <td class="text-center">
                                                    {!! Form::open(array('url'=>'project/openproject','class'=>'form-button')) !!}
                                                    {!! Form::hidden('id', $pro->id ) !!}
                                                    <button type="submit" class="btn btn-info" value="Open"><span class="fa fa-folder-open"></span></button>
                                                    {!! Form::close() !!}
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-danger" onclick="destroy({{$pro->id}});"><span class="fa fa-trash-o"></span></button>
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
        <div class="modal fade" id="modal-new_project">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Create New Project</h4>
                    </div>
                <div class="modal-body">
                    {!! Form::open(array('url'=>'project/newproject','class'=>'form-horizontal','role'=>'form')) !!}
                    <fieldset>
                        <div class="form-group">
                            {!! Form::label('name','Project Name : ',array('class'=>'col-lg-3 control-label')) !!}
                                <div class="col-lg-6">
                                    {!! Form::text('name',null,array('class'=>'form-control')) !!}
                                </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"> Create</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-duplicate">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Duplicate Project</h4>
                    </div>
                <div class="modal-body">
                    {!! Form::open(array('url'=>'project/dupproject','class'=>'form-horizontal','role'=>'form')) !!}
                    <fieldset>
                    <input type="hidden" name="project_id" id="project_id" value="">
                    <div class="form-group">
                    {!! Form::label('name','Project Name : ',array('class'=>'col-lg-3 control-label')) !!}
                        <div class="col-lg-6">
                            {!! Form::text('name',null,array('class'=>'form-control')) !!}
                        </div>
                    </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"> Create</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
  </section>
        @include('include.normal-js')
    <script type="text/javascript">
      $(function() {
        $("#tb-openrecent").DataTable();
        $("#btn-new-project").click(function(event) {
            $("#modal-new_project").modal("show");
        });
      });
      function dupproject(id){
        $("#project_id").val(id);
        $("#modal-duplicate").modal("show");
      }
      function destroy(id){
        if (confirm('Confirm to delete project?')) {
            window.location.href = "{{url()}}/project/destroyproject?id="+id;
        }
      }
    </script>
    @endsection

