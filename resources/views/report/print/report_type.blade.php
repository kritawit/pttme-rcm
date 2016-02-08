<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Report By Equipment Type</title>
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
		<h3>Report By Equipment Type</h3>
		<table width="80%" align="center">
			<thead>
				<tr bgcolor="#F2F5A9">
					<th>Equipment Type</th>
					<th>Name</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($data as $type)
					<tr>
						<td>{{$type->type}}</td>
						<td>{{$type->asset_name}}</td>
						<td>{{$type->description}}</td>
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