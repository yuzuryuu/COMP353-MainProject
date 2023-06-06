
<?php
include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UFT-8">
    <meta name = "viewport" content= " width=devide-width, initial-scale = 1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<title> Email Log </title>
	</style>
</head>

<body>
	<div class="container my-5">
		<h1>Email Log </h1>
		<button class="btn btn-light">
			<a href="index.php"> Home </a>
		</button>
		<br>
        <br>
        <button class="btn btn-primary my-1 mx-2"><a href="log_given_facility.php" class='text-light'>Email Log Per Facility</a></button>

		<form method="post">
		
	</div>

	<?php

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$sql7 = "SELECT * FROM log  
		ORDER BY sendDate ASC;";
		$result = mysqli_query($con, $sql7);

		if ($result === false) {
			$errorMsg = "Invalid Query: " . mysqli_error($con);
		}else {
			$articles = mysqli_fetch_all($result);

			echo "<table class = \"table\">";
			echo "<tr>";
			echo "<th>Send Date</th>";
			echo "<th>Facility Name </th>";
			echo "<th>Facility Address </th>";
			echo "<th>Medicare Card Number </th>";
			echo "<th>Receiver</th>";
			echo "<th>Subject</th>";
			echo "<th>Contents</th>";
			echo "</tr>";

			foreach ($articles as $article) {
				echo "<tr>";
				for ($i = 0; $i < count($article); $i++) {
					echo "<td>";
					echo $article[$i];
					echo "</td>";
				}
				echo "</tr>";
			}

			echo "</table>";
		}
	}

	?>


</body>

</html>


