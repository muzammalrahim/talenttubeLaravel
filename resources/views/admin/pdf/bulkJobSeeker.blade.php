
<!DOCTYPE html>
<html lang="es-co">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>JobSeeker export</title>
    <link type="text/css" rel="stylesheet"/>
    <meta name="description" content="PDF de una fotomulta">
    <meta name="keywords" content="">

  <style type="text/css">
    table{width: 100%;}	
  </style>

</head>



<table  width="100%">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Surname</th>
			<th>Email</th>
			<th>Username</th>
			<th>Phone</th>
			<th>Country</th>
			<th>State</th>
			<th>City</th>
			<th>About Me</th>
			<th>Interested In</th>
			<th>Recent Job</th>
			<th>Salary Range</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($users as $user)
			<tr>
				<td>{{$user->id}}</td>
				<td>{{$user->name}}</td>
				<td>{{$user->email}}</td>
				<td>{{$user->username}}</td>
				<td>{{$user->phone}}</td>
				<td>{{$user->country}}</td>
				<td>{{$user->state}}</td>
				<td>{{$user->city}}</td>
				<td>{{$user->about_me}}</td>
				<td>{{$user->interested_in}}</td>
				<td>{{$user->recentJob}}</td>
				<td>{{$user->salaryRange}}</td>
			</tr>
		@endforeach
	</tbody>
</table>



</body>

</html>