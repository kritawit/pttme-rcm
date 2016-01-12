<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Asset Detail</a></li>
    <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Function Failure Cause</a></li>
    </ul>
    <div class="tab-content">
    <div class="tab-pane active" id="tab_1">
      {!! Form::open(array('url'=>'asset-register/saveformlevel8','class'=>'form-horizontal','role'=>'form')) !!}
            <div class="form-group">
              <label for="" class="control-label col-lg-3">Name : </label>
              <div class="col-lg-4">
                <input type="hidden" name="id" value="{{$id}}" required class="form-control" >
                <input type="text" value="{{$node}}" readonly required class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label for="" class="control-label col-lg-3">DrawNo : </label>
              <div class="col-lg-4">
                <input type="text" name="drawno" required class="form-control" name="drawno">
              </div>
            </div>
            <div class="form-group">
              <label for="" class="control-label col-lg-3">Detail : </label>
              <div class="col-lg-6">
                <textarea name="description" required class="form-control" cols="25" rows="3"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="control-label col-lg-3">Equipment Category : </label>
              <div class="col-lg-6">
              {!! Form::select('category_id', $categories,null,['class'=>'form-control select2']) !!}
              </div>
            </div>
            <div class="form-group">
              <label for="" class="control-label col-lg-3">Equipment Type : </label>
              <div class="col-lg-6">
              {!! Form::select('type_id', $types,null,['class'=>'form-control select2']) !!}
              </div>
            </div>
            <div class="form-group">
              <label for="" class="control-label col-lg-3">Equipment Part : </label>
              <div class="col-lg-6">
              {!! Form::select('part_id', $parts,null,['class'=>'form-control select2']) !!}
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-3-10 col-sm-offset-2">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
              </div>
            </div>
      {!! Form::close() !!}
      <hr>
      <table id="tb_asset_detail" class="table table-hover">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>DrawNo</th>
                          <th>Detail</th>
                          <th>Equipment Category</th>
                          <th>Equipment Type</th>
                          <th>Equipment Part</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($assets as $as)
                        <tr>
                          <td>{{ $as->asset_name }}</td>
                          <td>{{ $as->drawno }}</td>
                          <td>{{ $as->description }}</td>
                          <td>{{ $as->cat_desc }}</td>
                          <td>{{ $as->type_desc }}</td>
                          <td>{{ $as->part_desc }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
    </div><!-- /.tab-pane -->
    <div class="tab-pane" id="tab_2">
        <form id="frmfunction" action="" method="POST" class="form-horizontal" role="form">
            <div class="form-group">
              <label for="" class="control-label col-lg-3">Failure Mode : </label>
              <div class="col-lg-4">
                {!! Form::select('mode_id',$modes,null,['class'=>'form-control select2','style'=>'width:250px;']) !!}
              </div>
            </div>
            <div class="form-group">
              <label for="" class="control-label col-lg-3">Failure Cause : </label>
              <div class="col-lg-4">
                {!! Form::select('cause_id',$causes,null,['class'=>'form-control select2','style'=>'width:250px;']) !!}
              </div>
            </div>
            <div class="form-group">
              <label for="" class="control-label col-lg-3">Task Type : </label>
              <div class="col-lg-4" style="width: 100px;">
              {!! Form::select('ttype_id',$ttypes,null,['class'=>'form-control select2','style'=>'width:250px;']) !!}
              </div>
            </div>
            <div class="form-group">
              <label for="" class="control-label col-lg-3">Task List : </label>
              <div class="col-lg-4">
              {!! Form::select('tlist_id',$tlists,null,['class'=>'form-control select2','style'=>'width:250px;']) !!}
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-3-10 col-sm-offset-2">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
              </div>
            </div>
      </form>
      <legend></legend>
      <table id="tb_function" class="table table-striped table-hover">
        <thead>
          <tr>
            <th>Failure Mode</th>
            <th>Failure Cause</th>
            <th>Task Type</th>
            <th>Task List</th>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
    </div><!-- /.tab-pane -->
  </div><!-- /.tab-content -->
</div>
<script type="text/javascript">
  $(function() {
    $("#tb_asset_detail").DataTable();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content');
      }
    });

    $(".select2").select2();

    $("#tb_function").DataTable();

  });
</script>