<div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Informations</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
  <div class="box-body" >
    <form action="{{url()}}/asset-register/saveformlevel" id="frmOther" method="POST" class="form-horizontal" role="form" >
            <div class="row">
              <div class="col-lg-6">
              <div class="form-group">
              <label for="" class="control-label col-lg-4">{{ $assets->level_desc}}:</label>
              <div class="col-lg-8">
                <input type="hidden" name="node_id"  value="{{ $assets->id}}" required class="form-control" >
                <input type="text" name="asset_name" value="{{ $assets->asset_name}}"  required class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label for="" class="control-label col-lg-4">Description : </label>
              <div class="col-lg-8">
                <textarea name="description" id="description" required class="form-control" cols="25" rows="3">{{ $assets->description}}</textarea>
              </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-lg-4">Created Date</label>
                <div class="col-lg-8">
                <input type="text" value="{{ $assets->created_at}}" readonly  class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="control-label col-lg-4">Created By</label>
                <div class="col-lg-8">
                <input type="text" value="{{ $assets->create_name}}" readonly  class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="control-label col-lg-4">Updated Date</label>
                <div class="col-lg-8">
                <input type="text" value="{{ $assets->updated_at}}" readonly  class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="control-label col-lg-4">Updated By</label>
                <div class="col-lg-8">
                <input type="text" value="{{ $assets->update_name}}" readonly   class="form-control">
                </div>
              </div>
              <div class="form-group">
        <div class="col-lg-4"></div>
        <div class="col-lg-8">
          <button type="button" onclick="saveformlevel();" class="btn btn-success"> Save</button>
        </div>
      </div>
      </div>
      <div class="col-lg-6">
          <div>
            <div class="form-group">
              <div class="col-lg-12">
                <label>Upload Photo:</label>
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-12">
                <div id="img-level">
                  
                </div>
                <input type="file" class="form-control" name="file_upload" value="" placeholder="">
              </div>
            </div>
          </div>
      </div>
      </div>
    </form>
      <hr>
    <table class="table table-hover" id="tb_unders">
      <thead>
      <tr>
        <th style="display:none;">Parent</th>
        <th class="text-center">Name</th>
        <th class="text-center">Description</th>
        <th class="text-center">Type</th>
      </tr>
      </thead>
      <tbody>
      @foreach ($unders as $un)
        <tr>
          <td style="display:none;">{{$un->parent}}</td>
          <td>{{$un->asset_name}}</td>
          <td>{{$un->description}}</td>
          <td>{{$un->type_name}}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div><!-- /.box-body -->
</div><!-- /.box -->
{!! HTML::script('public/js/jquery.form.js') !!}
<script type="text/javascript">
  $(function() {
    $("#tb_unders").DataTable();
    loadpicture($("input[name=node_id]").val());
  });
  function saveformlevel(){
  if (frmvalidate() == true) {
    $("#frmOther").ajaxForm({
    dataType: 'json',
    success: function(text){
      if (text[0]['message']==='success') {
        alert('Information Successfully Saved.');
        loadpicture($("input[name=node_id]").val());
      }else{
        alert('Information Fail Saved');
      }
    }
    }).submit();
    }
  }
  function loadpicture(id){
    $("#img-level").load('{{url()}}/asset-register/picturelevel?node_id='+id);
  }
  function frmvalidate(){
  if($("input[name=asset_name]").val()==''){
    alert('{{ $assets->level_desc}} invalid!');
    $("input[name=asset_name]").focus();
    return false;
  }else if($("#description").val()==''){
    alert('Description invalid!');
    $("#description").focus();
    return false;
  }else{
    return true;
  }
}
</script>