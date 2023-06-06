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

	<title>Infections</title>

</head>

<body>
	<div class="container my-5">
		<h1>Infection</h1>
		<button class="btn btn-light">
			<a href="index.php">Go back to home</a>
		</button>
		<br><br>
		<button class="btn btn-primary">
			<a href="infection_add.php" class='text-light'>Add New Infection Type</a>
		</button>

		<table class="table">
			<thead>
				<tr>
					<th scope="col">Infection Type</th>
					<th scope="col">Actions</th>
				</tr>
			</thead>

			<?php
			$sql = "select * from Infections";
			$result = mysqli_query($con, $sql);

			if ($result) {
				while ($row = mysqli_fetch_assoc($result)) {
					$InfectionType = $row["InfectionType"];
					echo ' <tr>
			<td>' . $InfectionType . '</td>
			<td>
				<button class ="btn btn-primary"><a href="infection_update.php?updateInfectionType=' . $InfectionType . '"" class="text-light">Update</a></button>
				<button class ="btn btn-danger" ><a href="infection_delete.php?deleteInfection=' . $InfectionType . '" class="text-light" 
										onclick="return confirmDelete(\'' . $InfectionType . '\')">Delete</a></button>	
			</td>
			</tr>';
				}
			}
			mysqli_close($con);
			?>
	</div>

</body>

</html>