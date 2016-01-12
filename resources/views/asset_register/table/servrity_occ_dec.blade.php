<table class="table table-hover" id="servoccdec">
	<thead>
		<tr>
			<th>Severity</th>
			<th>Occurrence</th>
			<th>Detection</th>
		</tr>
	</thead>
	<tbody>
	@if (!empty($assets->sev_desc)||($assets->severity != 0))
		<tr>
			<td>{{$assets->sev_desc}}</td>
			<td>{{$assets->occur}}</td>
			<td>{{$assets->detect}}</td>
		</tr>
	@else
		<tr>
			<td colspan="3">not found or emptry</td>
		</tr>
	@endif
	</tbody>
</table>