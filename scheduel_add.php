<!DOCTYPE html>
<?php
include_once('config.php');
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>Add schedule</title>
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="info-fill" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
    </svg>

    <div class="container my-5">
        <h1>Add schedule</h1>

        <div class="alert alert-primary d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:" style="width: 1em; height: 1em;">
                <use xlink:href="#info-fill" />
            </svg>
            <div>
                Make sure the corresoponding employee is in "working" BEFORE adding into schedule
            </div>
        </div>

        <form method="post">
            <div class="row mb-3">
                <label class="col-md-6 col-form-label">Facility Name:</label>
                <!-- <div class="col-sm-6"> -->
                <select name="Fname">
                    <?php
                    $sql1 = "select name from facility";
                    $result1 = mysqli_query($con, $sql1);
                    $articles_1 = mysqli_fetch_all($result1);

                    foreach ($articles_1 as $article) {
                        echo "<option value='" . $article[0] . "'>" . $article[0] . "</option>";
                    }
                    ?>
                </select> <!-- </div> -->
            </div>
            <div class="row mb-3 col-sm-7">
                <label class="col-sm-3 col-form-label">Address: </label>
                <select name="Faddress">
                    <?php
                    $sql2 = "select address from facility";
                    $result2 = mysqli_query($con, $sql2);
                    $articles_1 = mysqli_fetch_all($result2);

                    foreach ($articles_1 as $article) {
                        echo "<option value='" . $article[0] . "'>" . $article[0] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="row mb-3 w-25">
                <label class="col col-form-label">Medicare Card Number: </label>
                <select name="MedicareCardNumber">
                    <?php
                    $sql8 = "select MedicareCardNumber from Employee";
                    $result = mysqli_query($con, $sql8);
                    $articles_1 = mysqli_fetch_all($result);

                    foreach ($articles_1 as $article) {
                        echo "<option value='" . $article[0] . "'>" . $article[0] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="row mb-3 w-50">
                <label class="col-sm-3 col-form-label">Date: </label>
                <input type="date" class="form-control" name="Date">
            </div>
            <div class="row mb-3 w-50">
                <label class="col-sm-3 col-form-label">Start Time: </label>
                <input type="time" class="form-control" name="startTime">
            </div>
            <div class="row mb-3 w-50">
                <label class="col col-form-label">End Time: </label>
                <input type="time" class="form-control " name="endTime" size="10">
            </div>

            <div class="row mb-3 my-5">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" name="submit">Add a schedule</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="schedule.php" role="button">Cancel</a>
                </div>
            </div>

        </form>
    </div>
    <?php
    if (isset($_POST['submit'])) {

        $fName = $_POST["Fname"];
        $fAddress =  $_POST["Faddress"];
        $Date =  $_POST["Date"];
        $MedicareCardNumber = $_POST["MedicareCardNumber"];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];

        //check if any of the values are empty or null before constructing the SQL query

        if (!empty($fName) && !empty($fAddress) && !empty($MedicareCardNumber) && !empty($startTime) && !empty($endTime) && !empty($Date)) {
            $sql = "INSERT INTO schedule
                    VALUES ('$fName','$fAddress','$MedicareCardNumber','$Date','$startTime','$endTime')";

            if (mysqli_query($con, $sql)) {
                echo "<script>alert('New schedule is successfully added')</script>";
            } else {
                echo mysqli_error($con);
            }
        }
    }
    ?>
</body>

</html>