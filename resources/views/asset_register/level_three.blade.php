<div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Informations</h3>
      <div class="box-tools pull-right">
      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
  <div class="box-body" >
  <input type="hidden" name="status" id="status" value="{{$status}}">
  <input type="hidden" name="node_id" id="node_id" value="{{$node}}">
  <form id="frmDetailNode" method="post" class="form-horizontal" role="form">
  <div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="" class="control-label col-lg-4">{{ $assets->level_desc}}:</label>
      <div class="col-lg-8">
        <input type="hidden" name="node"  value="{{ $assets->id}}"  class="form-control" >
        @if (!empty($complex_detail))
          <input type="text" name="asset_name" readonly value="{{ $assets->asset_name}}"   class="form-control node-detail">
        @else
          <input type="text" name="asset_name"  value="{{ $assets->asset_name}}"   class="form-control node-detail">
        @endif
      </div>
    </div>
    <div class="form-group">
      <label for="" class="control-label col-lg-4">Description:</label>
      <div class="col-lg-8">
          <textarea name="description" <?php if(!empty($complex_detail)){echo "readonly";} ?> id="description" class="form-control node-detail" cols="25" rows="3">{{ $assets->description}}</textarea>
      </div>
    </div>
    <div class="form-group">
        <label for="" class="control-label col-lg-4">Created Date:</label>
        <div class="col-lg-8">
        <input type="text" value="{{ $assets->created_at}}" disabled  class="form-control">
        </div>
    </div>
    <div class="form-group">
      <label for="" class="control-label col-lg-4">Created By:</label>
      <div class="col-lg-8">
      <input type="text" value="{{ $assets->create_name}}" disabled  class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label for="" class="control-label col-lg-4">Updated Date:</label>
      <div class="col-lg-8">
      <input type="text" value="{{ $assets->updated_at}}" disabled  class="form-control">
      </div>
    </div>
    <div class="form-group">
      <label for="" class="control-label col-lg-4">Updated By:</label>
      <div class="col-lg-8">
      <input type="text" value="{{ $assets->update_name}}" disabled   class="form-control">
      </div>
    </div>
  </form>
    @if (!empty($complex_detail))
      <div class="form-group">
        <label for="" class="control-label col-lg-4">Risk Matrix Size:</label>
        <div class="col-lg-8">
            <input type="text" class="form-control" readonly name="complex_name" id="" value="{{$complex_detail->complex_name}}">
            <input type="hidden" name="complex_id" id="complex_id" value="{{$complex_detail->complex_id}}">
        </div>
      </div>
    @else
      <div class="form-group">
        <label for="" class="control-label col-lg-4">Risk Matrix Size:</label>
        <div class="col-lg-8">
            {!! Form::select('complex_id', ['' => 'Select Risk Matrix Size'] + $complexs,null,['class'=>'form-control select2','id' => 'complex_id']) !!}
        </div>
      </div>
      <div class="form-group">
        <label for="" class="control-label col-lg-4">Risk Matrix Data : </label>
        <div class="col-lg-8">
          <div class="input-group">
              <input type="radio" name="data_type" id="default" value="1" checked=""> Default

              <input type="radio" name="data_type" id="custom" value="2" style="margin-left:15px;"> Custom
          </div>
        </div>
      </div>
    @endif
    </div>
    <div class="col-sm-6" id="color_detail" align="center">

    </div>
    <div class="col-sm-12" id="complex_detail" >

    </div>
  </div>
  </div><!-- /.box-body -->
</div><!-- /.box -->
<div class="modal modal-example-sm fade" id="modal-color">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Update color</h4>
      </div>
      <div class="modal-body">
      <form id="frmcolor" action="" method="POST">
        <input type="hidden" name="com_id">
        <input type="hidden" name="color_id">
        <input type="hidden" name="nd_id" value="{{$node}}">
        <div class="radio">
          <label>
            <input type="radio" name="ref1" id="input" value="Non Critical" checked="checked">
            Non Critical
          </label>
          <label>
            <input type="radio" name="ref1" id="input" value="Critical">
            Critical
          </label>
        </div>
        <label for="color">Select color : </label>
        <input name="color" class="form-control my-colorpicker1 colorpicker-element">
      </div>
      <div class="modal-footer">
        <button type="button" id="savecolor" class="btn btn-primary"><i class="fa fa-save"></i>  Save changes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{!! HTML::script('public/plugins/colorpicker/bootstrap-colorpicker.min.js') !!}
{!! HTML::script('public/js/ptt-rcm.js') !!}
<script type="text/javascript">
   $(document).ready(function() {
    var com_id = $('#complex_id').val();
    if (com_id != '') {
      loadcolordetail(com_id);
      loadcomplexdetail(com_id);
    }

    $('#modal-color').on('hidden.bs.modal', function (e) {
        $("input[name=color]").val('');
    });
    $(".my-colorpicker1").colorpicker();
    $('#complex_id').change(function() {
      var data_type = $("input[type='radio'][name='data_type']:checked").val();
      if (data_type==1) {
        // $("#saveall").attr('disabled', true);
        // 1 = Default
        loadcolordetail($(this).val());
        loadcomplexdetail($(this).val());
      }else if(data_type==2){
        loadcolordetail($(this).val());
        loadcomplexdetail($(this).val());
        setTimeout(function(){
          $(".conseq").val('');
          $(".conseq").attr('readonly', false);
          $(".occe").attr('readonly', false);
          $(".det").attr('readonly', false);
          // $("#saveall").attr('disabled', false);
        },3000);
        // 2 = Custom
      }else{
        $("#color_detail").remove();
        $("#complex_detail").remove();
      }

    });

    $('input[name=data_type]:radio').on("change", function(){
        var data_type = $(this).val();
        if (data_type==1) {
          // $("#saveall").attr('disabled', true);
          if ($("#complex_id").val()!='') {
            loadcomplexdetail($("#complex_id").val());
            loadcolordetail($("#complex_id").val());
          }
        }else if(data_type==2){
          // $("#saveall").attr('disabled', false);
          $('.conseq').val('');
          $(".conseq").attr('readonly', false);
          $(".occe").attr('readonly', false);
          $(".det").attr('readonly', false);
        }
    });

    $("#savecolor").click(function(event) {
      setdetail();
      $.ajax({
        url: '{{url()}}/asset-register/updatecolor',
        type: 'POST',
        data: $("#frmcolor").serialize(),
        success:function(data){
          if (data==='success') {
            $("#modal-color").modal('hide');
            updatecomplexnode();
            loadcolordetail($("#complex_id").val());
          }else if(data==='fail'){
            $("#modal-color").modal('hide');
            alert('save color fail!');
          }
        }
      });
    });

  });

  function loadcomplexdetail(complex_id){
    $.ajax({
            url: '{{url()}}/asset-register/complexform',
            type: 'GET',
            data: {
              complex_id: complex_id,
              node_id:$("#node_id").val(),
            },
            success:function(data){
              $("#complex_detail").html(data);
            }
    });
  }

  function loadcolordetail(complex_id){
    $.ajax({
          url: '{{url()}}/asset-register/colorform',
          type: 'GET',
          data: {
            complex_id: complex_id,
            node_id:$("#node_id").val(),
          },
          success:function(data){
            $("#color_detail").html(data);
          }
    });
  }

  function opencolor(col,com_id){
    var data_type = $("input[type='radio'][name='data_type']:checked").val();
    if (data_type == 2) {
      $("input[name=com_id]").val(com_id);
      $("input[name=color_id]").val(col);
      $("#modal-color").modal('show');
    }
  }

  function updatecomplexnode(){
    $.ajax({
      url: '{{url()}}/asset-register/savecompnode',
      type: 'POST',
      data: {node_id: $("#node_id").val()},
      success:function(data){
        console.log("update complex node : "+data);
      }
    });
  }

  function checkForm(){
    if (checkFormNode()&&checkFormConsq()&&checkFormOcc()&&checkFormDet()) {
      return true;
    }else{
      return false;
    }
  }
  function checkFormNode(){
    var d = new Array();
    var rs = true;
    d = $("#frmDetailNode").serializeArray();
    for (var i = 1; i < d.length; i++) {
      if (d[i].name==='description') {
        if (d[i].value == '') {rs = false;}
      }
      if (d[i].name==='asset_name') {
        if (d[i].value == '') {rs = false;}
      }
    }
    return rs;
  }

  function checkFormConsq(){
    var d = new Array();
    var rs = true;
    d = $("#consequence").serializeArray();
    for (var i = 1; i < d.length; i++) {
      if (d[i].value == '') {rs = false;}
    }
    return rs;
  }

  function checkFormOcc(){
    var d = new Array();
    var rs = true;
    d = $("#occorrence").serializeArray();
    for (var i = 1; i < d.length; i++) {
      if (d[i].value == '') {rs = false;}
    }
    return rs;
  }

  function checkFormDet(){
    var d = new Array();
    var rs = true;
    d = $("#detection").serializeArray();
    for (var i = 1; i < d.length; i++) {
      if (d[i].value == '') {rs = false;}
    }
    return rs;
  }


  function setdetail(){
    $.ajax({
      url: '{{url()}}/asset-register/setdetailcomplex',
      type: 'POST',
      data: {
        node_id: $("#node_id").val(),
        com_id:$("#complex_id").val(),
      },
      success:function(data){
        console.log(data);
      }
    });
  }

</script>


