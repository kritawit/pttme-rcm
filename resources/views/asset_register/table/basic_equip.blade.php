<table class="table table-hover" id="servoccdec">
	<thead>
		<tr>
			<th>Category</th>
			<th>Type</th>
			<th>Part</th>
		</tr>
	</thead>
	<tbody>
	@if (!empty($assets->category)||($assets->category != 0))
		<tr>
			<td>{{$assets->category}}</td>
			<td>{{$assets->type}}</td>
			<td>{{$assets->part}}</td>
		</tr>
	@else
		<tr>
			<td colspan="3">not found or emptry</td>
		</tr>
	@endif
	</tbody>
</table>