<div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Informations</h3>
      <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
  <div class="box-body" >
    <form action="{{url('/')}}/asset-register/saveformlevel8" id="frmL8" method="POST" class="form-horizontal" role="form" >
    <input type="hidden" name="node_id" value="{{$node_id}}" id="node_id"  >
    <input type="hidden" name="complex_node" value="{{$assets->complex_node}}" id="complex_node"  >
            <div class="row">
              <div class="col-lg-6">
              <div class="form-group">
              <label for="" class="control-label col-lg-4">{{ $assets->level_desc}}</label>
              <div class="col-lg-8">
                <input type="text" name="asset_name" id="asset_name" value="{{ $assets->asset_name}}"  required class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label for="" class="control-label col-lg-4">Description</label>
              <div class="col-lg-8">
                <textarea name="description" required  id="description" class="form-control" cols="25" rows="3">{{ $assets->description}}</textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="control-label col-lg-4">Drawing No.</label>
              <div class="col-lg-8">
                <input type="text" name="drawing" id="drawing" value="{{ $assets->drawing}}"  required class="form-control">
              </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-lg-4">Create Date</label>
                <div class="col-lg-8">
                <input type="text" value="{{ $assets->created_at}}"  readonly class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="control-label col-lg-4">Create By</label>
                <div class="col-lg-8">
                <input type="text" value="{{ $assets->create_name}}"  readonly class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="control-label col-lg-4">Update Date</label>
                <div class="col-lg-8">
                <input type="text" value="{{ $assets->updated_at}}"  readonly class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label for="" class="control-label col-lg-4">Update By</label>
                <div class="col-lg-8">
                <input type="text" value="{{ $assets->update_name}}"  readonly class="form-control">
                </div>
              </div>
              <div class="form-group">
              <label for="" class="control-label col-lg-4">Failure Effect Remark</label>
              <div class="col-lg-8">
                <textarea name="failure_effect" required  id="failure_effect" class="form-control" cols="25" rows="3">{{ $assets->failure_effect}}</textarea>
              </div>
            </div>
    <div class="form-group">
      <label for="" class="control-label col-lg-4">RPN</label>
      <div class="col-lg-8">
      <input type="text" name="rpn" id="rpn" value="{{$assets->rpn}}"  required class="form-control">
      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-4"></div>
      <div class="col-lg-9">
        <button type="button" id="view_risk_matrix" class="btn btn-sm btn-info" id="view_risk_matrix">View Risk Matrix</button>
        <button type="button" class="btn btn-sm btn-info" id="task_selection">Task Selection</button>
      </div>
    </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
              <div class="col-lg-3" id="colour_asset">
                
              </div>
              <div class="col-lg-9">
                <div id="img-level">
                  
                </div>
                {!! Form::file('file_upload',['class'=>'form-control','id' => 'file_upload']) !!}
              </div>
            </div>
          <div class="form-group">
              <label for="" class="control-label col-lg-6">Plant or Unit SD?</label>
              <div class="col-lg-6">
                <input type="text" name="ref1" id="ref1" value="{{$assets->ref1}}"  required class="form-control">
              </div>
          </div>
          <div class="form-group">
            <label for="" class="control-label col-lg-6">Damage Cost (Bath)</label>
            <div class="col-lg-6">
              <input type="text" value="{{$assets->ref2}}" name="ref2" id="ref2" required class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="control-label col-lg-6">Spare part problem</label>
            <div class="col-lg-6">
              <input type="text" value="{{$assets->ref3}}" name="ref3" id="ref3" required class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="control-label col-lg-4">Maintenance Time</label>
            <div class="col-lg-8">
              <input type="text" value="{{$assets->ref4}}" name="ref4" id="ref4" required class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="control-label col-lg-8">Unit Preparation and Start up time</label>
            <div class="col-lg-4">
              <input type="text" value="{{$assets->ref5}}" name="ref5" id="ref5" required class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="control-label col-lg-6">Total Economic loss (Bath)</label>
            <div class="col-lg-6">
              <input type="text" value="{{$assets->ref6}}" name="ref6" id="ref6" required class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="control-label col-lg-6">Existing Detection method</label>
            <div class="col-lg-6">
              <input type="text" value="{{$assets->ref7}}" name="ref7" id="ref7" required class="form-control">
            </div>
          </div>
          <div class="form-group">
            <label for="" class="control-label col-lg-4">None</label>
            <div class="col-lg-8">
              <input type="text" value="{{$assets->ref8}}" name="ref8" id="ref8" required class="form-control">
            </div>
          </div>
        </div>
    </div>
    <div class="col-lg-12">
          
    </div>
  </form>
    <button class="btn btn-success" id="basic-equip"><i class="fa fa-plus"></i>  Add / Update</button>
    <div id="table_basic_eq">
      
    </div>
    <hr>
    <button class="btn btn-success" id="serv-occ-dec"><i class="fa fa-plus"></i>  Add / Update</button>
    <div id="table_serv_occ_dec">
      
    </div>
    <hr>
    <button href="#" class="btn btn-success" id="func-failure"><i class="fa fa-plus"></i>  Add / Update</button>
    <br><br>
    <div id="table_func_failure">
      
    </div>
    <button type="button" onclick="saveformlevel();" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
  </div><!-- /.box-body -->
</div><!-- /.box -->
<div class="modal fade" id="modal-failure">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Function / Failure Cause</h4>
      </div>
      <div class="modal-body" id="body-func">
        
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="modal-servrity_occ_dec">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Severity / Occurrence / Detection</h4>
      </div>
      <div class="modal-body">
      <form id="frm_serv_occ_dec" method="POST" class="form-horizontal" role="form">
      <input type="hidden" name="node_id" value="{{$node_id}}">
          <div class="form-group">
          <div class="col-lg-12">
          <table width="100%">
          <tbody>
          <tr>
            <td class="cell3">
              <label for="" class="control-label">Severity</label>
              {!! Form::select('serv_id', ['' => 'Select one'] + $severity,null,['class'=>'form-control select2','id' => 'serv_id']) !!}
            </td>
            <td class="cell3">
              <label for="" class="control-label">Occurrence</label>
              {!! Form::select('occ_id', ['' => 'Select one'] + $occorrence,null,['class'=>'form-control select2','id' => 'occ_id']) !!}
            </td>
            <td class="cell3">
              <label for="" class="control-label">Detection</label>
              {!! Form::select('detection_id', ['' => 'Select one'] + $detection,null,['class'=>'form-control select2','id' => 'detection_id']) !!}
            </td>
          </tr>
        </tbody>
        </table>
        </div>
        </div>
          <div class="form-group">
            <div class="col-lg-12" align="right">
              <button type="button" class="btn btn-primary" id="save_serv_occ_dec"><i class="fa fa-save"></i>  Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
      </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal-basic_equip">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Basic Equipment</h4>
      </div>
      <div class="modal-body">
        <form id="frm_basic_equip" method="POST" class="form-horizontal" role="form">
        <input type="hidden" name="node_id" value="{{$node_id}}">
          <div class="form-group">
          <div class="col-lg-12">
          <table width="100%">
          <tbody>
          <tr>
          <td class="cell3">
            <label for="">Category</label>
            {!! Form::select('cat_id', ['' => 'Select one'] + $category,null,['class'=>'form-control','id' => 'cat_id']) !!}
          </td>
          <td class="cell3">
            <label for="">Type</label>
            <select name="type_id" class="form-control" id="types">
              <option value="" selected>Select one</option>
            </select>
          </td>
          <td class="cell3">
            <label for="">Part</label>
            <select name="part_id" class="form-control" id="parts">
              <option value="" selected>Select one</option>
            </select>
          </td>
          </tr>
          </tbody>
          </table>
        </div>
        </div>
          <div class="form-group">
            <div class="col-lg-12" align="right">
              <button type="button" class="btn btn-primary" id="save_basic_equip"><i class="fa fa-save"></i>  Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
      </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal modal-example-lg fade" id="modal-view_risk_matrix">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">View Risk Matrix</h4>
      </div>
      <div class="modal-body" id="body_view_risk_matrix" style="overflow: scroll;height: 550px;">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{!! HTML::script('public/js/jquery.form.js') !!}
{!! HTML::script('public/js/ptt-rcm.js') !!}
<script type="text/javascript">
$(document).ready(function() {
    checktaskselection();
    reloadTree();
    loadpicture($("#node_id").val());
    getServOccDec($("#node_id").val());
    getBasicEquip($("#node_id").val());
    getcolors($("#node_id").val());
    loadfuncfailure();
    $("#tb-failure").DataTable();
    $('#cat_id').change(function() {
      if ($(this).val()!='') {
        $.ajax({
          url: '{{url("/")}}/asset-register/type',
          type: 'GET',
          data: {cat_id:$(this).val()},
          success:function(data){
            $("#types").html(data);
            $.ajax({
              url: '{{url("/")}}/asset-register/part',
              type: 'GET',
              data: {type_id:$('#types').val()},
              success:function(data){
                $("#parts").html(data);
              }
            });
          }
        });
      }else{
        $("#parts").html('<option value="" selected>Select one</option>');
        $("#types").html('<option value="" selected>Select one</option>');
      }
    });
    $('#types').change(function() {
      if ($(this).val()!='') {
        $.ajax({
          url: '{{url("/")}}/asset-register/part',
          type: 'GET',
          data: {type_id:$(this).val()},
          success:function(data){
            $("#parts").html(data);
          }
        });
      }else{
        $("#parts").html('<option value="" selected>Select one</option>');
      }
    });
    $("#func-failure").click(function(event) {
      $("#modal-failure").modal('show');
      $("#body-func").load('{{url("/")}}/asset-register/basicfailureform');
    });
    $("#serv-occ-dec").click(function(event) {
      $("#modal-servrity_occ_dec").modal('show');
    });
    $("#save_serv_occ_dec").click(function(event) {
      if (frmvalidatesevoccdec()) {
        $.ajax({
          url: '{{url("/")}}/asset-register/updateservoccdec',
          type: 'POST',
          data: $("#frm_serv_occ_dec").serialize(),
          success:function(data){
            reloadTree();
            if (data==='success') {
              checktaskselection();
              $("#modal-servrity_occ_dec").modal('hide');
              reloadTree();
              getServOccDec($("#node_id").val());
              getcolors($("#node_id").val());
            }else if(data==='fail'){
              alert('save serverity ,occurrence and detection fail!');
            }
          }
      });
      }
    });

    $("#basic-equip").click(function(event) {
      $("#modal-basic_equip").modal('show');
    });

    $("#save_basic_equip").click(function(event) {
      $.ajax({
        url: '{{url("/")}}/asset-register/updatebasicequip',
        type: 'POST',
        data: $("#frm_basic_equip").serialize(),
        success:function(data){
          if (data==='success') {
            $("#modal-basic_equip").modal('hide');
            getBasicEquip($("#node_id").val());
          }else if(data==='fail'){
            alert('save basic equipment fail!');
          }
        }
      });
    });

    $("#view_risk_matrix").click(function(event) {
      $.ajax({
        url: '{{url()}}/asset-register/formlevel',
        type: 'GET',
        data:{
          name:$("#asset_name").val(),
          id:$("#complex_node").val(),
          level:3,
        },
        success:function(data){
          $("#control-panel").html(data);
        }
      });
    });

    $("#task_selection").click(function(event) {
      $("#control-panel").load("{{url()}}/asset-register/taskselection?node_id="+$("#node_id").val()+"&level={{$assets->level}}");
    });
});


function loadfuncfailure(){
  $.ajax({
      url: '{{url("/")}}/asset-register/funcfailure',
      type: 'GET',
      data: {node: $("#node_id").val()},
      success:function(data){
        $("#table_func_failure").html(data);
      }
  });
}


function checktaskselection(){
  $.ajax({
    url: '{{url('/')}}/asset-register/checktaskselection',
    type: 'GET',
    data: {node_id: $("#node_id").val()},
    success:function(data){
      if (data=='has') {
        document.getElementById("task_selection").disabled = false;
      }else if(data=='not'){
        document.getElementById("task_selection").disabled = true;
      }
    }
  });
}

function getServOccDec(id){
  $("#table_serv_occ_dec").load("{{url('/')}}/asset-register/servoccdec?node_id="+id);
}

function getBasicEquip(id){
  $("#table_basic_eq").load("{{url('/')}}/asset-register/basicequip?node_id="+id);
}

function getcolors(id){
  $("#colour_asset").load("{{url('/')}}/asset-register/colourcal?node_id="+id);
}

function loadpicture(id){
  $("#img-level").load('{{url('/')}}/asset-register/picturelevel?node_id='+id);
}

function saveformlevel(){
  if (frmvalidate() == true) {
    $("#frmL8").ajaxForm({
    dataType: 'json',
    success: function(text){
      if (text[0]['message']==='success') {
        alert('save successfully.');
        loadpicture($("#node_id").val());
      }else{
        alert('save fail!');
      }
    }
    }).submit();
  }
}

function frmvalidatesevoccdec(){
  if ($("#serv_id").val()=='') {
    alert('Severity invalid!');
    $("#serv_id").focus();
    return false;
  }else if($("#occ_id").val()==''){
    alert('Occurrence invalid!');
    $("#occ_id").focus();
    return false;
  }else if($("#detection_id").val()==''){
    alert('Detection invalid!');
    $("#detection_id").focus();
    return false;
  }else{
    return true;
  }
}


function frmvalidate(){
  if($("#asset_name").val()==''){
    alert('{{ $assets->level_desc}} invalid!');
    $("#asset_name").focus();
    return false;
  }else if($("#description").val()==''){
    alert('Description invalid!');
    $("#description").focus();
    return false;
  }else if($("#drawing").val()==''){
    alert('Drawing invalid!');
    $("#drawing").focus();
    return false;
  }else if($("#failure_effect").val()==''){
    alert('Failure effect remark invalid!');
    $("#failure_effect").focus();
    return false;
  }else if($("#rpn").val()==''){
    alert('RPN invalid!');
    $("#rpn").focus();
    return false;
  }else if($("#ref1").val()==''){
    alert('Plant or Unit SD? invalid!');
    $("#ref1").focus();
    return false;
  }else if($("#ref2").val()==''){
    alert('Damage Cost (Bath) invalid!');
    $("#ref2").focus();
    return false;
  }else if($("#ref3").val()==''){
    alert('Spare part problem invalid!');
    $("#ref3").focus();
    return false;
  }else if($("#ref4").val()==''){
    alert('Maintenance Time invalid!');
    $("#ref4").focus();
    return false;
  }else if($("#ref5").val()==''){
    alert('Unit Preaparation and Start up time invalid!');
    $("#ref5").focus();
    return false;
  }else if($("#ref6").val()==''){
    alert('Total Economic loss (Bath) invalid!');
    $("#ref6").focus();
    return false;
  }else if($("#ref7").val()==''){
    alert('Existing Detection method invalid!');
    $("#ref7").focus();
    return false;
  }else if($("#ref8").val()==''){
    alert('None invalid!');
    $("#ref8").focus();
    return false;
  }else{
    return true;
  }
}


function editfunc(id){
  $.ajax({
    url: '{{url("/")}}/asset-register/editfuncfailure',
    type: 'GET',
    data: {id: id},
    success:function(data){
      $("#body-func").html(data);
      $("#modal-failure").modal('show');
    }
  });
}

function deletefunc(id){
  if (confirm('confirm for delete ?')) {
    $.ajax({
    url: '{{url("/")}}/asset-register/deletefuncfailure',
    type: 'GET',
    data: {id: id},
    success:function(data){
      if (data==='success') {
        loadfuncfailure();
      }else if(data==='fail'){
        alert('delete fail!');
      }
    }
  });
  }
}
</script>