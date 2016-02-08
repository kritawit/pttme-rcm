{!! Form::open(array('url'=>'reference-data/order-type/update','class'=>'form-horizontal','role'=>'form')) !!}
<fieldset>
    {!! Form::hidden('id', $data->id ) !!}
    <div class="form-group">
      {!! Form::label('name','Name : ',array('class'=>'col-lg-3 control-label')) !!}
      <div class="col-lg-6">
          {!! Form::text('name',$data->name,array('class'=>'form-control')) !!}
      </div>
    </div>
    <div class="form-group">
    {!! Form::label('description','Description : ',array('class'=>'col-lg-3 control-label')) !!}
      <div class="col-lg-6">
          <textarea name="description" class="form-control" cols="50" rows="3">{{$data->description}}</textarea>
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