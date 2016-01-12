{!! Form::open(array('url'=>'basic-data-setup/updatefailure','class'=>'form-horizontal','role'=>'form')) !!}
    <fieldset>
                @foreach($basics as $basic)
                {!! Form::hidden('id',$basic->id ) !!}
                <div class="form-group">
                  <label for="mode_id" class="col-lg-4 control-label"><b>Failure Mode : </b></label>
                  <div class="col-lg-6">
                      <select name="mode_id" class="form-control select2" style="width:250px;">
                        <option value="{{ $basic->mode_id }}">{{ $basic->mode->description }}</option>
                          @foreach($modes as $mode)
                            <option value="{{ $mode->id }}">{{ $mode->description }}</option>
                          @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="cause_id" class="col-lg-4 control-label"><b>Failure Cause : </b></label>
                  <div class="col-lg-6">
                      <select name="cause_id" class="form-control select2" style="width:250px;">
                        <option value="{{ $basic->cause_id }}">{{ $basic->cause->description }}</option>
                          @foreach($causes as $cause)
                            <option value="{{ $cause->id }}">{{ $cause->description }}</option>
                          @endforeach

                    </select>
                  </div>
                </div>
                @endforeach
              <div class="form-group">
                    <label for="" class="col-lg-4"></label>
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-success"></span> Save</button>
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
              </div>
  </fieldset>
{!! Form::close() !!}
<script type="text/javascript">
    $(function() {
        $(".select2").select2();
    });
</script>