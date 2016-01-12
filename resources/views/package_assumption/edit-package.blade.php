{!! Form::open(array('url'=>'package-assumption/updatepackage','class'=>'form-horizontal','role'=>'form')) !!}
  <fieldset>
  {!! Form::hidden('id', $package->id ) !!}
  <div class="form-group">
    {!! Form::label('name','Name : ',array('class'=>'col-lg-4 control-label')) !!}
          <div class="col-lg-6">
              {!! Form::text('name',$package->name,array('class'=>'form-control')) !!}
          </div>
    </div>
  <div class="form-group">
    {!! Form::label('description','Description : ',array('class'=>'col-lg-4 control-label')) !!}
          <div class="col-lg-6">
              {!! Form::text('description',$package->description,array('class'=>'form-control')) !!}
          </div>
    </div>
    <div class="form-group">
      <label for="" class="col-md-4"></label>
      <div class="col-md-8">
        <button type="submit" class="btn btn-success"></span> Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
</fieldset>
{!! Form::close() !!}