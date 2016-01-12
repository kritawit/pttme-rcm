<form action="{{url()}}/asset-register/savefuncfailure" id="frmFailure" method="POST" class="form-horizontal" role="form">
<input type="hidden" class="form-control" name="node" id="node">
	<div class="form-group">
		<label for="" class="control-label col-lg-3">Failure Mode</label>
		<div class="col-lg-6">
			{!! Form::select('', ['' => 'Select one'] + $failuremode,null,['class'=>'form-control select2','id' => 'mode_id']) !!}
		</div>
	</div>
	<div class="form-group">
		<label for="" class="control-label col-lg-3">Failure Cause</label>
		<div class="col-lg-6">
			<select name="basic_failure_id" class="form-control" id="cause">
				<option value="" selected>Select one</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="control-label col-lg-3">Worst case</label>
		<div class="col-lg-6">
			<input type="text" class="form-control" name="worst_case" id="worst_case">
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-12" align="center">
			<button type="button" onclick="savefuncfailure();" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
			<button class="btn btn-danger" data-dismiss="modal">Cancel</button>
		</div>
	</div>
</form>

<script type="text/javascript">
$(document).ready(function() {
	$("input[name=node]").val($("#node_id").val());
	$('#mode_id').change(function() {
      if ($(this).val()!='') {
        $.ajax({
          url: '{{url()}}/asset-register/cause',
          type: 'GET',
          data: {mode_id:$(this).val()},
          success:function(data){
            $("#cause").html(data);
          }
        });
      }else{
        $("#cause").html('<option value="" selected>Select one</option>');
      }
    });
});
function savefuncfailure(){
	if (frmvalidate()==true) {
		$.ajax({
			url: '{{url()}}/asset-register/savefuncfailure',
			type: 'POST',
			data: $("#frmFailure").serialize(),
			success:function(data){
				if (data==='success') {
					$("#modal-failure").modal('hide');
					loadfuncfailure();
					checktaskselection();
				}else if(data==='fail'){
					$("#modal-failure").modal('hide');
					alert('save fail!');
				}else if (data==='duplicate') {
					$("#modal-failure").modal('hide');
					alert('data duplicate!');
				}
			}
		});
	}
}
function frmvalidate(){
	if ($("#mode_id").val()=='') {
		$("#mode_id").focus();
		alert('Failure Mode invalid!');
		return false;
	}else if($("#cause").val()==''){
		$("#cause").focus();
		alert('Failure Cause invalid!');
		return false;
	}else if($("#worst_case").val()==''){
		$("#worst_case").focus();
		alert('Worst case invalid!');
		return false;
	}else {
		return true;
	}
}
</script>