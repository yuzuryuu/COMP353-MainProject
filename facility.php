<!DOCTYPE html>
<?php
include_once('config.php');
?>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

	<script>
		function confirmDelete(item_name) {
			return confirm("Are you sure you want to delete \"" + item_name + "\"?");
		}
	</script>

</head>

<body>
	<div class="container my-5">
		<h1>Facility</h1>
		<button class="btn btn-light">
			<a href="index.php">Go back to home</a>
		</button>
		<br><br>
		<button class="btn btn-primary">
			<a href="facility_Add.php" class='text-light'>Add new facility</a>
		</button>

		<table class="table">
			<thead>
				<tr>
					<th scope="col">Facility name</th>
					<th scope="col">Facility address</th>
					<th scope="col">City</th>
					<th scope="col">province</th>
					<th scope="col">postal code</th>
					<th scope="col">phone number</th>
					<th scope="col">web address</th>
					<th scope="col">type</th>
					<th scope="col">capacity</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>

			<?php
			$sql = "select * from facility";
			$result = mysqli_query($con, $sql);

			if ($result) {
				while ($row = mysqli_fetch_assoc($result)) {
					$name = $row['name'];
					$address = $row["address"];
					$city = $row["city"];
					$province = $row["province"];
					$postalCode = $row["postalCode"];
					$phoneNumber = $row["phoneNumber"];
					$webAddress = $row["webAddress"];
					$type =  $row["type"];
					$capacity = $row["capacity"];
					echo ' <tr>
			<td>' . $name . '</td>
			<td>' . $address . '</td>
			<td>' . $city . '</td>
			<td>' . $province . '</td>
			<td>' . $postalCode . '</td>
			<td>' . $phoneNumber . '</td>
			<td>' . $webAddress . '</td>
			<td>' . $type . '</td>
			<td>' . $capacity . '</td>
			<td>
				<button class ="btn btn-primary"><a href="facility_update.php?updateName=' . $name . '" class="text-light">Update</a></button>
				<button class ="btn btn-danger" ><a href="facility_delete.php?deleteName=' . $name . '" class="text-light" 
										onclick="return confirmDelete(\'' . $name . '\')">Delete</a></button>	
			</td>
			</tr>';
				}
			}
			mysqli_close($con);
			?>
	</div>

</body>

</html>