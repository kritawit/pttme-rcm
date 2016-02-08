<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Report By Failure Mode</title>
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
	<div align="center">
		<h3>Report By Failure Mode</h3>
		<table width="80%" align="center">
			<thead>
				<tr bgcolor="#F2F5A9">
					<th>Failure Mode</th>
					<th>Name</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($data as $mode)
					<tr>
						<td>{{$mode->mode}}</td>
						<td>{{$mode->asset_name}}</td>
						<td>{{$mode->description}}</td>
					</tr>
				@endforeach
				<tr>
					<td bgcolor="#A9BCF5" colspan="3"><b>Total : {{$total}} Units</b></td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>