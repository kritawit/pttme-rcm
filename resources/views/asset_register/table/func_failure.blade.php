<table class="table table-hover" id="tb_func_failure">
	<thead>
		<tr>
			<th>Failure Mode</th>
			<th>Failure Cause</th>
			<th>Worst Case</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	@foreach ($func_failure as $func)
		<tr>
			<td>{{$func->mode}}</td>
			<td>{{$func->cause}}</td>
			<td>{{$func->worst_case}}</td>
			<td>
				<button class="btn btn-warning" onclick="editfunc({{$func->id}});"><i class="fa fa-edit"></i></button>
				<button class="btn btn-danger" onclick="deletefunc({{$func->id}});"><i class="fa fa-remove"></i></button>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
<script type="text/javascript">
	$(function() {
		$("#tb_func_failure").DataTable();
	});
</script>