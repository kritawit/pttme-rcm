<form id="frmFailure" method="POST" class="form-horizontal" role="form">
<input type="hidden" class="form-control" name="node" id="node">
<input type="hidden" name="id" value="{{$assets_func->id}}">
	<div class="form-group">
		<label for="" class="control-label col-lg-3">Failure Mode</label>
		<div class="col-lg-6">
			<select id="mode_id"  class="form-control select2">
                {{-- <option value="{{ $assets_func->mode_id }}" selected>{{ $assets_func->mode }}</option> --}}
                @foreach($mode as $m)
                	@if ($m->mode_id == $assets_func->mode_id)
                		<option value="{{ $m->mode_id }}" selected>{{ $m->mode }}</option>
                	@else
                		<option value="{{ $m->mode_id }}">{{ $m->mode }}</option>
                	@endif
                @endforeach
            </select>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="control-label col-lg-3">Failure Cause</label>
		<div class="col-lg-6">
			<select name="basic_failure_id"  class="form-control" id="cause">
				<option value="" selected>Select one</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="" class="control-label col-lg-3">Worst case</label>
		<div class="col-lg-6">
			<input type="text" class="form-control"  value="{{$assets_func->worst_case}}" name="worst_case" id="worst_case">
		</div>
	</div>
	<div class="form-group">
		<div class="col-lg-12" align="center">
			<button type="button" onclick="updatefuncfailure();" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
			<button class="btn btn-danger" data-dismiss="modal">Cancel</button>
		</div>
	</div>
</form>

<script type="text/javascript">
$(document).ready(function() {
	$("input[name=node]").val($("#node_id").val());
	$.ajax({
        url: '{{url()}}/asset-register/cause',
        type: 'GET',
        data: {mode_id:$('#mode_id').val()},
        success:function(data){
           $("#cause").html(data);
        }
    });
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
function updatefuncfailure(){
	if (frmvalidate()==true) {
		$.ajax({
		url: '{{url()}}/asset-register/updatefuncfailure',
		type: 'POST',
		data: $("#frmFailure").serialize(),
		success:function(data){
			if (data==='success') {
				$("#modal-failure").modal('hide');
				loadfuncfailure();
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