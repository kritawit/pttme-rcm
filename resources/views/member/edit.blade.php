{!! Form::open(array('url'=>'member/update','class'=>'form-horizontal','role'=>'form', 'id'=>'form-update')) !!}
<fieldset>
    {!! Form::hidden('id', $item->id ) !!}
    <div class="form-group">
        {!! Form::label('name','Name : ',array('class'=>'col-lg-4 control-label')) !!}
        <div class="col-lg-6">
            {!! Form::text('name',$item->name,array('class'=>'form-control','required'=>'required')) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('email','Email : ',array('class'=>'col-lg-4 control-label')) !!}
        <div class="col-lg-6">
            {!! Form::text('email',$item->email,array('class'=>'form-control','required'=>'required')) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('username','Username : ',array('class'=>'col-lg-4 control-label')) !!}
        <div class="col-lg-6">
            {!! Form::text('username',$item->username,array('class'=>'form-control','required'=>'required')) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('password','Password : ',array('class'=>'col-lg-4 control-label')) !!}
        <div class="col-lg-6">
            {!! Form::password('password',array('class'=>'form-control', 'id'=>'edit-password')) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('confrim_password','Confirm Password : ',array('class'=>'col-lg-4 control-label')) !!}
        <div class="col-lg-6">
            {!! Form::password('confirm_password',array('class'=>'form-control', 'id'=>'edit-confirm_password')) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('role','Role : ',array('class'=>'col-lg-4 control-label')) !!}
        <div class="col-lg-6">
            {!! Form::select('role',$roles,$item->role,['class'=>'form-control select2']) !!}
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-lg-4"></label>
        <div class="col-md-6">
            <button type="submit" class="btn btn-success"> Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</fieldset>
{!! Form::close() !!}