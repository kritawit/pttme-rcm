<table class="display" id="table_task_select" width="100%">
	<thead>
		<tr>
			<th>ID</th>
			<th>Evident</th>
			<th>Failure Efftect</th>
			<th>Type of Task</th>
			<th>Maintenance Activity</th>
			<th>Order Type</th>
			<th>Work center description</th>
			<th>Interval</th>
			<th>Task interval unit</th>
			<th>Activity Status</th>
			<th>Maintenance Activity Detail (40 Char)</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($taskselection as $task)
			<tr>
				<td>{{$task->task_selection_id}}</td>
				<td>{{$task->evident}}</td>
				<td>{{$task->failure_effect}}</td>
				<td>{{$task->type}}</td>
				<td>{{$task->interval_num.$task->interval.'-'.$task->list}}</td>
				<td>{{$task->order_type}}</td>
				<td>{{$task->work_center_description}}</td>
				<td>{{$task->interval_num}}</td>
				<td>{{$task->interval}}</td>
				<td>{{$task->activity_status}}</td>
				<td>{{$task->activity_detail}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
<script type="text/javascript">
	var task_selection_id = null;
	$(function() {
		var table = $("#table_task_select").DataTable();
		$('#table_task_select tbody').on( 'click', 'tr', function () {
        	if ($(this).hasClass('selected') ) {
            	$(this).removeClass('selected');
            	$("#task_selection_id").val('');
            	document.getElementById("btndelete").disabled = true;
        	}else{
            	table.$('tr.selected').removeClass('selected');
            	$(this).addClass('selected');
            	document.getElementById("btndelete").disabled = false;
        	}
        	var d = new Array();
      		d = table.rows('.selected').data().toArray();
      		task_selection_id = d[0][0];
      		$("#task_selection_id").val(task_selection_id);
    	});
	});
</script>