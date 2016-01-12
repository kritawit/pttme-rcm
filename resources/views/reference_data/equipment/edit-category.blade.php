{!! Form::open(array('url'=>'reference-data/equipment/updatecategory','class'=>'form-horizontal','role'=>'form')) !!}
  <fieldset>
  {!! Form::hidden('id', $cate->id ) !!}
  <div class="form-group">
    {!! Form::label('description','Equipment Category : ',array('class'=>'col-lg-4 control-label')) !!}
          <div class="col-lg-6">
              {!! Form::text('description',$cate->description,array('class'=>'form-control')) !!}
          </div>
    </div>
    <div class="form-group">
      <label for="" class="col-md-4"></label>
      <div class="col-md-8">
        <button type="submit" class="btn btn-success"> Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
</fieldset>
{!! Form::close() !!}