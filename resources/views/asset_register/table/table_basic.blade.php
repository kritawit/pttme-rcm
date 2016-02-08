<table class="display" id="tablebc">
	<thead>
		<tr>
			<td>Part</td>
			<td>Failure Mode</td>
			<td>Failure Cause</td>
			<td>Failure Effect</td>
			<td>RPN No.</td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody>
		@foreach ($basic as $bs)
			<tr>
				<td>{{$bs->parts}}</td>
				<td>{{$bs->failure_mode}}</td>
				<td>{{$bs->failure_cause}}</td>
				<td bgcolor="{{$bs->color}}">{{$bs->failure_effect}}</td>
				<td>{{$bs->rpn}}</td>
				<td>
					<a href="#" onclick="getformdetail({{$bs->id}},{{$bs->node}});return false;">FMECA</a> /
					<a href="#" onclick="getTaskSelection({{$bs->id}});return false;">Task Selection</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
<hr>
<div class="form-group">
	<label for="" class="control-label col-lg-2">Max RPN No.</label>
	<div class="col-lg-4">
		<input type="text" readonly name="max_rpn" id="max_rpn" class="form-control">
	</div>
</div>
<hr>
<script type="text/javascript">
	$(function() {
		$("#tablebc").DataTable();
		getMaxRPN();
	});
</script>