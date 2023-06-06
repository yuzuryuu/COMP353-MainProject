<?php
include_once('config.php');

$sql = "SELECT DISTINCT facilityName FROM log";
$result = mysqli_query($con, $sql);
if ($result === false) {
    $errorMsg = "Invalid Query: " . mysqli_error($con);
} else {
    $articles = mysqli_fetch_all($result);
    // var_dump($articles);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>Email Log - Facility</title>
    </style>
</head>

<body>
    <div class="container my-3">
        <h1>List the email log for facilitiy</h1>
        <br>
        <a href="index.php">Home</a> <br>
        <br/>
        <!-- <button class ="btn btn-primary"><a href="EmailSchedule.php" class="text-light">Send schedule through email</a></button>
        <br/><br/> -->
        <form method="post">
            <label for="facility" class="col-sm-3 col-form-label"> Choose a facility: </label>
            <select name="facilityName">
                <?php
                foreach ($articles as $article) {
                    echo "<option value='" . $article[0] . "'>" . $article[0] . "</option>";
                }
                ?>
            </select>
            <div class="row mb-3 my-5">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" name="submit">show</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql7 = "SELECT * FROM log 
        WHERE facilityName ='" . $_POST['facilityName'] . "' 
        ORDER BY sendDate ASC;";
        $result = mysqli_query($con, $sql7);

        if ($result === false) {
            $errorMsg = "Invalid Query: " . mysqli_error($con);
        } else {
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