  <input type="hidden" id="bss_unit" name="bss_unit" value="{{$business_unit}}">
  <input type="hidden" name="status" id="status" value="{{$status}}">
  <input type="hidden" name="node_id" id="node_id" value="{{$node}}">
  <input type="hidden" name="node_id_complex" id="node_id_complex" value="{{$node}}">
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
<div class="modal fade" id="modal-color">
  <div class="modal-dialog">
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
        <input type="hidden" class="form-control" name="color" id="color">
        <label for="" class="control-label">Description</label>
        <input type="text" class="form-control" name="ref1" id="ref1" value="" placeholder="">
        <label for="" class="control-label">Question</label>
        <select name="question" id="question" class="form-control">
          <option value="1">Yes</option>
          <option value="2">No</option>
        </select>
        <br>
        <table class="display" width="100%" id="tb_color">
          <thead>
            <tr>
              <th>Colour</th>
              <th>Code</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($color as $c): ?>
              <tr>
                <td bgcolor="{{$c->description}}" style="background-color:{{$c->description}}"></td>
                <td>{{$c->description}}</td>
              </tr>
            <?php endforeach ?>
            <tr>
              <td bgcolor="#000099" style="background-color:#000099"></td>
              <td>#000099</td>
            </tr>
            <tr>
              <td bgcolor="#006600" style="background-color:#006600"></td>
              <td>#006600</td>
            </tr>
            <tr>
              <td bgcolor="#0099FF" style="background-color:#0099FF"></td>
              <td>#0099FF</td>
            </tr>
            <tr>
              <td bgcolor="#00FF00" style="background-color:#00FF00"></td>
              <td>#00FF00</td>
            </tr>
            <tr>
              <td bgcolor="#00FFFF" style="background-color:#00FFFF"></td>
              <td>#00FFFF</td>
            </tr>
            <tr>
              <td bgcolor="#808000" style="background-color:#808000"></td>
              <td>#808000</td>
            </tr>
            <tr>
              <td bgcolor="#CC00FF" style="background-color:#CC00FF"></td>
              <td>#CC00FF</td>
            </tr>
            <tr>
              <td bgcolor="#FF6600" style="background-color:#FF6600"></td>
              <td>#FF6600</td>
            </tr>
            <tr>
              <td bgcolor="#FF6699" style="background-color:#FF6699"></td>
              <td>#FF6699</td>
            </tr>
            <tr>
              <td bgcolor="#FFFF00" style="background-color:#FFFF00"></td>
              <td>#FFFF00</td>
            </tr>
          </tbody>
        </table>
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
  var selected_color = null;
   $(document).ready(function() {

    var table = $("#tb_color").DataTable();
    $('#tb_color tbody').on( 'click', 'tr', function () {
          if ($(this).hasClass('selected') ) {
              $(this).removeClass('selected');
              $("#color").val('');
          }else{
              table.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
          }
          var d = new Array();
          d = table.rows('.selected').data().toArray();
          selected_color = d[0][1];
          $("#color").val(selected_color);
    });


    
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
        if ($(this).val()==1||$(this).val()==2) {
          document.getElementById('custom').checked = true;
        }else{
          document.getElementById('default').checked = true;
        }

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
      if(checkFormColor()){
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
      }
    });

  });

  function checkFormColor(){
    if ($("#color").val()=='') {
      alert('Please select color!');
      return false;
    }else if ($("#ref1").val()=='') {
      alert('Description invalid!');
      $("#ref1").focus();
      return false;
    }else{
      return true;
    }
  }

  function loadcomplexdetail(complex_id){

    $.ajax({
            url: '{{url()}}/asset-register/complexform',
            type: 'GET',
            data: {
              complex_id: complex_id,
              node_id:$("#node_id").val(),
              bss_unit: $("#bss_unit").val(),
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

  function opencolor(col,com_id,description,ref1){
    var data_type = $("input[type='radio'][name='data_type']:checked").val();
    if (data_type == 2) {
      $("input[name=com_id]").val(com_id);
      $("input[name=ref1]").val(ref1);
      $("input[name=color]").val(description);
      $("input[name=color_id]").val(col);
      $("#modal-color").modal('show');
    }
  }

  function updatecomplexnode(){
    $.ajax({
      url: '{{url()}}/asset-register/savecompnode',
      type: 'POST',
      data: {node_id: $("#node_id_complex").val()},
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
        com_id: $("#complex_id").val(),
        bss_unit : $("#bss_unit").val(),
      },
      success:function(data){
        console.log(data);
      }
    });
  }

</script>


