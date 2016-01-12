{!! Form::open(array('url'=>'basic-data-setup/updateequipment','class'=>'form-horizontal','role'=>'form')) !!}
    <fieldset>
                @foreach($basics as $basic)
                {!! Form::hidden('id',$basic->id ) !!}
                <div class="form-group">
                  <label for="stu_title" class="col-lg-4 control-label"><b>Equipment Category : </b></label>
                  <div class="col-lg-6">
                      <select name="category_id" class="form-control select2" style="width:250px;">
                        <option value="{{ $basic->category_id }}">{{ $basic->category->description }}</option>
                          @foreach($cat as $cats)
                            <option value="{{ $cats->id }}">{{ $cats->description }}</option>
                          @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="stu_title" class="col-lg-4 control-label"><b>Equipment Type : </b></label>
                  <div class="col-lg-6">
                      <select name="type_id" class="form-control select2" style="width:250px;">
                        <option value="{{ $basic->type_id }}">{{ $basic->type->description }}</option>
                          @foreach($type as $types)
                            <option value="{{ $types->id }}">{{ $types->description }}</option>
                          @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="stu_title" class="col-lg-4 control-label"><b>Equipment Part : </b></label>
                  <div class="col-lg-6">
                      <select name="part_id" class="form-control select2" style="width:250px;">
                        <option value="{{$basic->part_id}}">{{ $basic->part->description }}</option>
                          @foreach($part as $parts)
                            <option value="{{ $parts->id }}">{{ $parts->description }}</option>
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