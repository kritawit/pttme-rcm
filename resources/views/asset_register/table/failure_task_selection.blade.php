<div class="rows">
	<form action="{{url('/')}}/asset-register/savetaskselection"  id="frmtaskselect" method="POST" class="form-horizontal" role="form">
		<input type="hidden" name="asset_basic_failure_id" id="asset_basic_failure_id" value="{{$func_failure->id}}" >
		<input type="hidden" name="task_selection_id" id="task_selection_id" value="" placeholder="">
		<input type="hidden" name="node_id" id="node_id" value="{{$node_id}}">
		<div class="col-lg-6">
			<div class="form-group">
				<label for="" class="control-label col-lg-6">{{ $assets->level_desc}}</label>
				<div class="col-lg-6">
					<input type="text" class="form-control" readonly value="{{ $assets->asset_name}}">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-lg-6">Failure Mode</label>
				<div class="col-lg-6">
					<input type="text" class="form-control" readonly value="{{$func_failure->mode}}">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-lg-6">Evident</label>
				<div class="col-lg-6">
					{!! Form::select('evident_id', ['' => 'Select one'] + $evident,null,['class'=>'form-control select2','id' => 'evident_id']) !!}
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-lg-6">Type of Task</label>
				<div class="col-lg-6" id="task_type_select">
					{!! Form::select('task_type',$types,null,['class'=>'form-control','id' => 'task_type']) !!}
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label for="" class="control-label col-lg-4">Criticality Status</label>
				<div class="col-lg-6">
					<input type="text" style="background-color:{{$func_failure->color}};" class="form-control" readonly value="{{$func_failure->failure_effect}}">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-lg-4">Failure Cause</label>
				<div class="col-lg-6">
					<input type="text" class="form-control" readonly value="{{$func_failure->cause}}">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-lg-4">Worst Case</label>
				<div class="col-lg-6">
					<input type="text" class="form-control" readonly value="{{$func_failure->worst_case}}">
				</div>
			</div>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label for="" class="control-label col-lg-4">Failure Effect</label>
				<div class="col-lg-6">
					{!! Form::select('failure_effect_id', ['' => 'Select one'] + $failure_effect,null,['class'=>'form-control select2','id' => 'failure_effect_id']) !!}
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label col-lg-4">Order Type</label>
				<div class="col-lg-6">
					{!! Form::select('order_type_id', ['' => 'Select one'] + $order_type,null,['class'=>'form-control select2','id' => 'order_type_id']) !!}
				</div>
			</div>
		</div>
		<div class="col-lg-12">
			<legend>Maintenance Activity</legend>
			<div class="form-group">
				<label for="" class="col-lg-3">Interval</label>
				<div class="col-lg-3">
					<input type="number" class="form-control" id="interval_num" name="interval_num">
				</div>
				<label for="" class="col-lg-3">Task Interval Unit</label>
				<div class="col-lg-3">
					{!! Form::select('interval', ['' => 'Select one'] + $taskinterval,null,['class'=>'form-control select2','id' => 'interval']) !!}
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-lg-3">Type List</label>
				<div class="col-lg-4" id="type_list_select">
					<select class="form-control">
						<option value="">Select one</option>
					</select>
				</div>
			</div>
	</div>
	<div class="col-lg-12">
			<legend>Activity</legend>
			<div class="form-group">
				<label for="" class="col-lg-3">Status</label>
				<div class="col-lg-3">
					{!! Form::select('activity_status_id', ['' => 'Select one'] + $statusactivity,null,['class'=>'form-control select2','id' => 'activity_status_id']) !!}
				</div>
			</div>
			<div class="form-group">
				<label for="" class="col-lg-3">Maintenance Activity Detail (40 Char)</label>
				<div class="col-lg-6">
					<textarea name="activity_detail" maxlength="40" id="activity_detail" class="form-control" cols="60" rows="4"></textarea>
				</div>
			</div>
	</div>
	<legend></legend>
	<div class="col-lg-6" align="left">
		<button class="btn btn-success" type="button" onclick="saveTaskSelect();"><i class="fa fa-save"></i> Save</button>
	</div>
	<div class="col-lg-6" align="right">
		<button class="btn btn-danger" type="button" id="btndelete" disabled>Delete</button>
	</div>
	<div class="col-sm-12" id="display_table" style="margin-top:25px;overflow: scroll;" >
		
	</div>
</form>
<script type="text/javascript">
	var asset_id = null;
	$(function() {
		loadtabletask();

		var table = $("#tb_failure_task").DataTable();
		$('#tb_failure_task tbody').on( 'click', 'tr', function () {
        	if ($(this).hasClass('selected') ) {
            	$(this).removeClass('selected');
            	// $("#asset_basic_failure_id").val('');
            	// asset_id = null;
        	}else{
            	table.$('tr.selected').removeClass('selected');
            	$(this).addClass('selected');
        	}
        	var d = new Array();
      		d = table.rows('.selected').data().toArray();
      		asset_id = d[0][0];
      		// $("#asset_basic_failure_id").val(asset_id);
        	// getbasictask(asset_id);
    	});

    	$('#task_type').change(function() {
      		getbasictaskfinal($(this).val(),asset_id);
    	});

    	$("#btndelete").click(function(event) {
    		if (confirm('Confirm delete task selection ?')) {
    			$.ajax({
    			url: '{{url()}}/asset-register/deletetaskselection',
    			type: 'POST',
    			data: {
    				task_selection_id: $("#task_selection_id").val(),
    			},
    			success:function(data){
    				if (data === 'success') {
    					loadtabletask();
    				}else if(data === 'fail'){
    					alert('Delete task selection fail!');
    				}
    			}
    			});
    		};
    	});

    	$("#task_type").change(function(event) {
    		if ($(this).val()!='') {
				getbasictaskfinal($(this).val(),$("#asset_basic_failure_id").val());
			}else{
				$("#type_list_select").html('<select class="form-control"><option value="">Select one</option></select>');
			}
    	});


    	if ($("#task_type").val()!='') {
			getbasictaskfinal($("#task_type").val(),$("#asset_basic_failure_id").val());
		}

	});

	function loadtabletask(){
		$("#display_table").load("{{url()}}/asset-register/taskselectiondata?asset_basic_failure_id="+$("#asset_basic_failure_id").val()+"&node_id="+$("#node_id").val());
	}

	function saveTaskSelect(){
		if (validateform()) {
			$("#frmtaskselect").ajaxForm({
    			success: function(data){
        			if (data == 'success') {
        				alert('Task selection saved successfuly.');
        				loadtabletask();
        			}else if(condition){
        				alert('Save Task Selection Fail!');
        			}
      			}
    		}).submit();
		}
	}

	function validateform(){

		if($("#evident_id").val()==''){
			alert('Evident invalid!');
			$("#evident_id").focus();
			return false;
		}else if($("#failure_effect_id").val()==''){
			alert('Failure Effect invalid!');
			$("#failure_effect_id").focus();
			return false;
		}else if($("#task_type").val()==''){
			alert('Type of Task invalid!');
			$("#task_type").focus();
			return  false;
		}
		else if($("#order_type").val()==''){
			alert('Order Type invalid!');
			$("#order_type").focus();
			return  false;
		}
		else if($("#interval_num").val()==''){
			alert('Interval invalid!');
			$("#interval_num").focus();
			return  false;
		}
		else if($("#interval").val()==''){
			alert('Task Interval Unit invalid!');
			$("#interval").focus();
			return  false;
		}
		else if($("#basic_task_id").val()==''){
			alert('Type List invalid!');
			$("#basic_task_id").focus();
			return  false;
		}
		else if($("#activity_status_id").val()==''){
			alert('Status invalid!');
			$("#activity_status_id").focus();
			return  false;
		}
		else if($("#activity_detail").val()==''){
			alert('Maintenance Activity Detail invalid!');
			$("#activity_detail").focus();
			return  false;
		}
		else{
			return true;
		}
	}


	function getbasictask(id){
		$.ajax({
			url: '{{url()}}/asset-register/basictask',
			type: 'GET',
			data: {id: id},
			success:function(data){
				$("#task_type_select").html(data);
				if ($("#task_type").val()!='') {
					getbasictaskfinal($("#task_type").val(),asset_id);
				}
			}
		});
	}

	function getbasictaskfinal(id,asset){
		$.ajax({
			url: '{{url()}}/asset-register/basictaskfinal',
			type: 'GET',
			data: {
				id: asset,
				type_id:id,
			},
			success:function(data){
				$("#type_list_select").html(data);
			}
		});
	}
</script>