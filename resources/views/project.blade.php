@extends('layouts.app')
@section('content')
        <section class="content-header">
            <h1>Project Management</h1>
          <ol class="breadcrumb">
            <li><a href="{{url()}}/project"><i class="fa fa-home"></i> Home</a></li>
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
                        @if(Session::has('message_error'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <p>{{Session::get('message_error')}}</p>
                            </div>
                        @endif
                        <button class="btn btn-success" id="btn-new-project"><i class="glyphicon glyphicon-plus"></i> New RCM Project</button>
                        <button class="btn btn-warning" id="btn-import-project"><i class="fa fa-file-text"></i> Import Project</button>
                        <hr>
                        <div class="col-sm-12">
                            <div>
                                <table id="tb-openrecent" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Project Name</th>
                                            <th class="text-center">Edit</th>
                                            <th class="text-center">Duplicate Project</th>
                                            <th class="text-center">Export</th>
                                            <th class="text-center">Open</th>
                                            <th class="text-center">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($project as $pro)
                                            <tr>
                                                <td>{{ $pro->name }}</td>
                                                <td><a href="#" onclick="editProject({{$pro->id}},'{{$pro->name}}');return false;" class="btn btn-warning"><i class="fa fa-edit"></i></a></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn bg-maroon" onclick="dupproject({{ $pro->id }});"><span class="fa fa-copy"></span></button>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{url()}}/project/exportproject?project_id={{$pro->id}}&projectname={{$pro->name}}" class="btn btn-default"><i class="fa fa-file-archive-o"></i></a>
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
                        <h4 class="modal-title">Project Form</h4>
                    </div>
                <div class="modal-body">
                {!! Form::open(array('url'=>'project/saveproject','class'=>'form-horizontal','role'=>'form')) !!}
                    <fieldset>
                        <input type="hidden" name="project_id" id="project_form_id" value="">
                        <div class="form-group">
                            {!! Form::label('name','Project Name : ',array('class'=>'col-lg-3 control-label')) !!}
                                <div class="col-lg-6">
                                    {!! Form::text('name',null,array('class'=>'form-control','id'=>'name_form')) !!}
                                </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modal-import_project">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Import Project</h4>
                    </div>
                <div class="modal-body">
                {!! Form::open(array('url'=>'project/importproject','class'=>'form-horizontal','role'=>'form','method'=>'POST', 'files'=>true,'id'=>'frmImport')) !!}
                    <fieldset>
                        <input type="hidden" name="project_id" id="project_form_id" value="">
                        <div class="form-group">
                            {!! Form::label('name','Project Name : ',array('class'=>'col-lg-3 control-label')) !!}
                                <div class="col-lg-6">
                                    {!! Form::text('name',null,array('class'=>'form-control','id'=>'name_form')) !!}
                                </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('name','File Project : ',array('class'=>'col-lg-3 control-label')) !!}
                                <div class="col-lg-6">
                                    {!! Form::file('import',['class'=>'form-control','id' => 'import']) !!}
                                </div>
                        </div>
                    </fieldset>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
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
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
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
        $('#modal-import_project').on('hidden.bs.modal', function (e) {
            document.getElementById("frmImport").reset();
        });


        $("#tb-openrecent").DataTable();
        $("#btn-new-project").click(function(event) {
            $("#modal-new_project").modal("show");
        });
        $("#btn-import-project").click(function(event) {
            $("#modal-import_project").modal('show');
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
      function editProject(id,name){
        $("#project_form_id").val(id);
        $("#name_form").val(name);
        $("#modal-new_project").modal('show');
      }
    </script>
    @endsection

