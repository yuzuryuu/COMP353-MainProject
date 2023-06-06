<!DOCTYPE html>
<?php
include_once('config.php');
?>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


</head>

<body>

	<div class="container my-3">

		<button class="btn btn-light">
			<a href="index.php">Go back to home</a>
		</button>
		<h3>write query below. Don't forget to add ";" at the end</h3>

		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<div class="form-floating">
				<textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name ='query'></textarea><br>
				<label for="floatingTextarea2"></label>
			</div>
			<button class="btn btn-primary">Submit</button>
		</form>

		<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$sql = $_POST['query'];
			$result = mysqli_query($con, $sql);

			$all_property = array();

			echo $sql;

			//showing schema
			echo '<table class="data-table" style="border: 1px solid black;">
	        <tr class="data-heading" style= "font-weight: bold;">';
			while ($property = mysqli_fetch_field($result)) {
				echo '<td style="border: 1px solid black;">' . $property->name . '</td>';  //get schema name for header
				$all_property[] = $property->name;
			}
			echo '</tr>';

			//showing all data
			while ($row = mysqli_fetch_array($result)) {
				echo "<tr>";
				foreach ($all_property as $item) {
					echo '<td style="border: 1px solid black;">' . $row[$item] . '</td>';
				}
				echo '</tr>';
			}
			echo "</table>";
		} else {
			echo "0 results";
		}
		$con->close();

		?>

	</div>
</body>

</html>