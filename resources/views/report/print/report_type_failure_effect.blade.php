<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Report By Equipment Type And Failure Effect</title>
	<style>
table, td, th {
    border: 1px solid black;
}

table {
    border-collapse: collapse;
}

th {
    height: 30px;
}
</style>
</head>
<body>
{{-- style="page-break-after:always;" สำหรับ new page --}}
	<div align="center">
		<h3>Report By Equipment Type And Failure Effect : <?php print_r($type['title']); ?></h3>
		<table width="80%" align="center">
			<thead>
				<tr bgcolor="#F2F5A9">
					<th>Equipment Type</th>
					<th>Non Critical</th>
					<th>Critical</th>
				</tr>
			</thead>
			<tbody>
				<?php $t = 0; ?>
				@foreach ($data as $d)
					<tr>
						<td>{{$d->type}}</td>
						<td align="center">{{$d->non_critical}}</td>
						<td align="center">{{$d->critical}}</td>
					</tr>
					<?php $t++; ?>
				@endforeach
				<tr>
					<td bgcolor="#A9BCF5" colspan="3"><b>Total : <?php echo $t; ?> Units</b></td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>