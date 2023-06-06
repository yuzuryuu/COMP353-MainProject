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
        <h1>Working</h1>
        <button class="btn btn-light">
            <a href="index.php">Go back to home</a>
        </button>
        <br><br>
        <button class="btn btn-primary">
            <a href="working_add.php" class='text-light'>Add a new worker</a>
        </button>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Facility name</th>
                    <th scope="col">Facility address</th>
                    <th scope="col">Medicare Card Number</th>
                    <th scope="col">Start date</th>
                    <th scope="col">End date</th>
                    <th scope="col">role</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <?php
            $sql = "select * from working";
            $result = mysqli_query($con, $sql);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $fName = $row['fName'];
                    $fAddress = $row["fAddress"];
                    $MedicareCardNumber = $row["MedicareCardNumber"];
                    $startDate = $row["startDate"];
                    $endDate = $row["endDate"];
                    $role = $row["role"];

                    echo ' <tr>
			<td>' . $fName . '</td>
			<td>' . $fAddress . '</td>
			<td>' . $MedicareCardNumber . '</td>
			<td>' . $startDate . '</td>
			<td>' . $endDate . '</td>
			<td>' . $role . '</td>
			<td>
				<button class ="btn btn-primary"><a href="working_update.php?updateMnum=' . $MedicareCardNumber . '"" class="text-light">Update</a></button>
				<button class ="btn btn-danger" ><a href="working_delete.php?deleteMnum=' . $MedicareCardNumber . '" class="text-light" 
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