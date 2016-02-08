<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Report By Category</title>
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
	<div class="container" align="center">
	<h3>Report By Equipment Category</h3>
		<table width="80%" align="center">
			<thead>
				<tr bgcolor="#F2F5A9">
					<th>Equipment Category</th>
					<th>Name</th>
					<th>Description</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($data as $cat)
					<tr>
						<td>{{$cat->category}}</td>
						<td>{{$cat->asset_name}}</td>
						<td>{{$cat->description}}</td>
					</tr>
				@endforeach
				<tr bgcolor="#A9BCF5">
					<td colspan="3"><b>Total : {{$total}} Units</b></td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>