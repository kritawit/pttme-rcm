{!! Form::open(array('url'=>'reference-data/task/updatelist','class'=>'form-horizontal','role'=>'form')) !!}
    <fieldset>
    {!! Form::hidden('id', $list->id ) !!}
    <div class="form-group">
      {!! Form::label('description','Task List : ',array('class'=>'col-lg-4 control-label')) !!}
      <div class="col-lg-6">
          {!! Form::text('description',$list->description,array('class'=>'form-control')) !!}
      </div>
    </div>
    <div class="form-group">
      <label for="" class="col-lg-4"></label>
      <div class="col-md-4">
        <button type="submit" class="btn btn-success"></span> Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </fieldset>
{!! Form::close() !!}