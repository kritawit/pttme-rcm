@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {{ Session::get('member') }}&nbsp;
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url('/project') }}"><i class="fa fa-home"></i>Home</a></li>
            <li class="active">User Management</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Users</h3>
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
                        @if (Auth::user()->role == 3)<button class="btn btn-success" id="btn-new-member"><i class="glyphicon glyphicon-plus"></i> New Users</button>@endif
                        <hr>

                        <div class="col-sm-12">
                            <div>
                                <table id="tb-list" class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center" data-sortable="false">Edit</th>
                                        <th class="text-center" data-sortable="false">Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->role_title() }}</td>
                                            <td class="text-center">
                                                <a href="#" onclick="getEdit({{$item->id}});"><span class="fa fa-edit text-warning"></span></a>
                                            </td>
                                            <td class="text-center">
                                                <a href="#" onclick="desTroy({{$item->id}});return false;"><span class="fa fa-trash-o text-danger"></span></a>
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
        <div class="modal fade" id="modal-add">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">New User Informations</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(array('url'=>'member/add','class'=>'form-horizontal','role'=>'form','id'=>'form-new')) !!}
                        <fieldset>
                            <div class="form-group">
                                {!! Form::label('name','Name : ',array('class'=>'col-lg-4 control-label','required'=>'required')) !!}
                                <div class="col-lg-6">
                                    {!! Form::text('name',null,array('class'=>'form-control','required'=>'required')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('email','Email : ',array('class'=>'col-lg-4 control-label')) !!}
                                <div class="col-lg-6">
                                    {!! Form::text('email',null,array('class'=>'form-control','required'=>'required')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('username','Username : ',array('class'=>'col-lg-4 control-label')) !!}
                                <div class="col-lg-6">
                                    {!! Form::text('username',null,array('class'=>'form-control','required'=>'required')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('password','Password : ',array('class'=>'col-lg-4 control-label')) !!}
                                <div class="col-lg-6">
                                    {!! Form::password('password',null,array('class'=>'form-control','required'=>'required')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('confirm_password','Confirm Password : ',array('class'=>'col-lg-4 control-label')) !!}
                                <div class="col-lg-6">
                                    {!! Form::password('confirm_password',null,array('class'=>'form-control','required'=>'required')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('role','Role : ',array('class'=>'col-lg-4 control-label')) !!}
                                <div class="col-lg-6">
                                    {!! Form::select('role',['' => 'Select Role']+$roles,null,['class'=>'form-control select2']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-lg-4"></label>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-success" id="btn-new-save"> Save</button>
                                </div>
                            </div>
                        </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-edit">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Edit User Informations</h4>
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
            $("#tb-list").DataTable();
            $("#btn-new-member").click(function(event) {
                $("#modal-add").modal("show");
            });
            $("#form-new").submit(function() {
                var message = '';
                if (isEmpty('#name')) { message += '- Name\r\n'; }
                if (isEmpty('#email')) { message += '- Email\r\n'; }
                if (isEmpty('#username')) { message += '- Username\r\n'; }
                if (isEmpty('#password')) { message += '- Password\r\n'; }
                if (isEmpty('#confirm_password')) { message += '- Confirm Password\r\n'; }
                if (isEmpty('#role')) { message += '- Role\r\n'; }
                if ($('#password').val() != $('#confirm_password').val()) { message += '- Passwords do not match.\r\n'; }
                if (message.length > 0) {
                    alert('Please check:\r\n' + message);
                    return false;
                }
                return true;
            });
        });
        function isEmpty(element) {
            return ($(element).val().trim().length == 0);
        }
        function getEdit(id){
            $.ajax({
                url: '{{url()}}/member/edit',
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
                    url: '{{url()}}/member/destroy',
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