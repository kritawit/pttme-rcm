<div class="box box-warning">
    <div class="box-header with-border">
      <h3 class="box-title">Informations</h3>
      <div class="box-tools pull-right">
      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
  <div class="box-body" >
  <form id="frmDetailNode" action="{{url()}}/asset-register/saveformlevel" method="post" class="form-horizontal" role="form">
  <div class="row">
  <div class="col-sm-6">
    <div class="form-group">
      <label for="" class="control-label col-lg-4">{{ $assets->level_desc}}:</label>
      <div class="col-lg-8">
        <input type="hidden" name="node_id" id="node_id" value="{{ $assets->id}}"  class="form-control" >
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
        <div class="form-group">
      <label for="" class="control-label col-lg-4"></label>
      <div class="col-lg-8">
    <button class="btn btn-success" type="button" id="savedetainode"> Save</button>
      </div>
    </div>
    
    </div>
    <div class="col-lg-6">
      <div id="img-level">
          
      </div>
      <div class="col-lg-6">
        {!! Form::file('file_upload',['class'=>'form-control','id' => 'file_upload']) !!}
      </div>
    </div>
    </div>
  </form>
  <div class="rows">
    <div class="col-lg-12">
      <button class="btn btn-primary" type="button" id="add_basic">Add Failure</button>
      <hr>
      <div id="basic_table">

      </div>
    </div>
  </div>
  </div><!-- /.box-body -->
</div><!-- /.box -->

<div class="modal fade" id="modal-basic">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Failure Mode</h4>
      </div>
      <div class="modal-body">
        <form action="" id="FormBasic" method="POST" class="form-horizontal" role="form">
            <input type="hidden" name="node_id"  value="{{ $assets->id}}"  class="form-control" >
            <div class="form-group">
              <label for="" class="control-label col-lg-3">Equipment Part:</label>
              <div class="col-lg-4">
                {!! Form::select('part_id', ['' => 'Select one'] + $equip_part,null,['class'=>'form-control select2','id' => 'part_id']) !!}
              </div>
            </div>
            <div class="form-group">
              <label for="" class="control-label col-lg-3">Failure Mode:</label>
              <div class="col-lg-4">
                {!! Form::select('mode_id', ['' => 'Select one'] + $failuremode,null,['class'=>'form-control select2','id' => 'mode_id']) !!}
              </div>
            </div>
            <div class="form-group">
              <label for="" class="control-label col-lg-3">Failure Cause:</label>
              <div class="col-lg-4">
                <select name="basic_failure_id" class="form-control" id="basic_failure_id">
                  <option value="" selected>Select one</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-10 col-sm-offset-3">
                <button type="button" id="save-basic" class="btn btn-success"> Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              </div>
            </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal-fmeca">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">FMECA</h4>
      </div>
      <div class="modal-body" id="body_fmeca">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="saveFMECA">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{!! HTML::script('public/js/jquery.form.js') !!}
{!! HTML::script('public/js/ptt-rcm.js') !!}
<script type="text/javascript">
  $(function() {
    loadpicture();
    getbasictable();

    $("#add_basic").click(function(event) {
      $("#modal-basic").modal('show');
    });

    $("#savedetainode").click(function(event) {
      $("#frmDetailNode").ajaxForm({
        dataType: 'json',
        success: function(text){
          if (text[0]['message']==='success') {
              alert('Information Successfully Saved.');
              loadpicture();
          }else{
            alert('Information Fail Saved');
          }
        }
      }).submit();
    });


    $('#mode_id').change(function() {
      if ($(this).val()!='') {
        $.ajax({
          url: '{{url()}}/asset-register/cause',
          type: 'GET',
          data: {mode_id:$(this).val()},
          success:function(data){
            $("#basic_failure_id").html(data);
          }
        });
      }else{
        $("#basic_failure_id").html('<option value="" selected>Select one</option>');
      }
    });

    $("#save-basic").click(function(event) {
      if (validateBasic()) {
        $.ajax({
          url: '{{url()}}/asset-register/savebasic',
          type: 'POST',
          data: $("#FormBasic").serialize(),
          success:function(data){
            if (data==='success') {
              $("#modal-basic").modal('hide');
              getbasictable();
            }else{
              alert('Save basic fail.');
            }
          }
        });
      }
    });

    $("#saveFMECA").click(function(event) {
      if (validateFormFMECA()) {
        $.ajax({
          url: '{{url()}}/asset-register/addfmeca',
          type: 'POST',
          data: $("#frmFMECA").serialize(),
          success:function(data){
            if (data==='success') {
              $("#modal-fmeca").modal('hide');
              reloadTree();
              getbasictable();
            }else{
              alert('Save FMECA Fail!');
            }
          }
        });
      }
    });

  });

  function loadpicture(){
    $("#img-level").load('{{url()}}/asset-register/picturelevel?node_id='+$("#node_id").val());
  }

  function getMaxRPN(){
    $.ajax({
      url: '{{url()}}/asset-register/maxbasicfailure',
      type: 'GET',
      data: {
        node: $("#node_id").val()
      },
      success:function(data){
        $("#max_rpn").val(data);
      }
    })
  }


  function validateBasic(){
    var rs = true;
    if ($("#part_id").val()=='') {
      alert('Equipment Part invalid!');
      $("#part_id").focus();
      rs = false;
    }else if($("#mode_id").val()==''){
      alert('Failure mode invalid!');
      $("#mode_id").focus();
      rs = false;
    }else if($("#basic_failure_id").val()==''){
      alert('Failure Cause invalid!');
      $("#basic_failure_id").focus();
      rs = false;
    }
    return rs;
  }

  function validateFormFMECA(){

    if($("#serv_id").val()==''){
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
    }else if($("#failure_effect").val()==''){
      alert('Failure effect remark invalid!');
      $("#failure_effect").focus();
      return false;
    }else if($("#rpn").val()==''){
      alert('RPN No. invalid!');
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

  function getbasictable(){
    $("#basic_table").load("{{url()}}/asset-register/basictable?node_id="+$("#node_id").val());
  }

  function getTaskSelection(){
    $("#control-panel").load("{{url()}}/asset-register/taskselection?node_id="+$("#node_id").val()+"&level={{$assets->level}}");
  }

  function getformdetail(id,node){
    $.ajax({
      url: '{{url()}}/asset-register/formdetail',
      type: 'GET',
      data: {
        node_id: node,
        id:id,
      },
      success:function(data){
        $("#body_fmeca").html(data);
        $("#modal-fmeca").modal('show');
      }
    });
  }
</script>

