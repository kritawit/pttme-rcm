{!! Form::open(array('url'=>'reference-data/failure/updatemode','class'=>'form-horizontal','role'=>'form')) !!}
  <fieldset>
                {!! Form::hidden('id', $mode->id ) !!}
                <div class="form-group">
                  {!! Form::label('description','Failure Mode : ',array('class'=>'col-lg-4 control-label')) !!}
                        <div class="col-lg-6">
                            {!! Form::text('description',$mode->description,array('class'=>'form-control')) !!}
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