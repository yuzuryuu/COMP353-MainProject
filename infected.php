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

	<title>
		Infected
	</title>

</head>

<body>
	<div class="container my-5">
		<h1>Infected</h1>
		<button class="btn btn-light">
			<a href="index.php">Go back to Home</a>
		</button>
		<br><br>
		<button class="btn btn-primary">
			<a href="infected_add.php" class='text-light'>Report Infection</a>
		</button>

		<table class="table">
			<thead>
				<tr>
					<th scope="col">Medicare Card Number</th>
					<th scope="col">Infection Type</th>
					<th scope="col">Date Infected</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>

			<?php
			$sql = "select * from Infected";
			$result = mysqli_query($con, $sql);

			if ($result) {
				while ($row = mysqli_fetch_assoc($result)) {
					$MedicareCardNumber = $row['MedicareCardNumber'];
					$InfectionType = $row["InfectionType"];
					$Date = $row["Date"];
					echo ' <tr>
			<td>' . $MedicareCardNumber . '</td>
			<td>' . $InfectionType . '</td>
			<td>' . $Date . '</td>
			<td>
				<button class ="btn btn-primary"><a href="infected_update.php?updateMedicareCardNumber=' . $MedicareCardNumber . '"" class="text-light">Update</a></button>
				<button class ="btn btn-danger" ><a href="infected_delete.php?deleteMedicareCardNumber=' . $MedicareCardNumber . '" class="text-light" 
										onclick="return confirmDelete(\'' . $MedicareCardNumber . '\')">Delete</a></button>	
			</td>
			</tr>';
				}
			}
			mysqli_close($con);
			?>
	</div>

</body>

</html>