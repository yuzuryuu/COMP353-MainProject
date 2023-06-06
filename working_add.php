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

    <title>Document</title>
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="info-fill" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
    </svg>

    <div class="container my-5">
        <h1>Add working status</h1>

        <div class="alert alert-primary d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:" style="width: 1em; height: 1em;">
                <use xlink:href="#info-fill" />
            </svg>
            <div>
                Make sure the corresoponding employee is in "Employee" BEFORE adding into working status
            </div>
        </div>

        <form method="post">
            <div class="row mb-3">
                <label class="col-md-6 col-form-label">Facility Name:</label>
                <!-- <div class="col-sm-6"> -->
                <select name="fName">
                    <?php
                    $sql = "select name from facility";
                    $result = mysqli_query($con, $sql);
                    $articles_1 = mysqli_fetch_all($result);

                    foreach ($articles_1 as $article) {
                        echo "<option value='" . $article[0] . "'>" . $article[0] . "</option>";
                    }
                    ?>
                </select> <!-- </div> -->
            </div>
            <div class="row mb-3 col-sm-7">
                <label class="col-sm-3 col-form-label">Address: </label>
                <select name="fAddress">
                    <?php
                    $sql = "select address from facility";
                    $result = mysqli_query($con, $sql);
                    $articles_1 = mysqli_fetch_all($result);

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
                </select>            </div>
            <div class="row mb-3 w-50">
                <label class="col-sm-3 col-form-label">Start date: </label>
                <input type="date" class="form-control" name="startDate" placeholder="YYYY-MM-DD">
            </div>
            <div class="row mb-3 w-50">
                <!-- <label class="col col-form-label">End date: (Leave as blank if you are currenetly working) </label> -->
                End date: (Leave as blank if you are currenetly working)
                <input type="date" class="form-control " name="endDate" placeholder="YYYY-MM-DD / Leave as blank if you are currenetly working" size="10">
            </div>
            <div class="row mb-3 w-50">
                <label class="col-sm-3 col-form-label">Role: </label>
                <input type="text" class="form-control" name="role" size="20">
            </div>

            <div class="row mb-3 my-5">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" name="submit">Add a new working status</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="working.php" role="button">Cancel</a>
                </div>
            </div>

        </form>
    </div>
    <?php
    if (isset($_POST['submit'])) {

        $fName = $_POST["fName"];
        $fAddress =  $_POST["fAddress"];
        $MedicareCardNumber = $_POST["MedicareCardNumber"];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $role =  $_POST["role"];

        //check if any of the values are empty or null before constructing the SQL query

        if (!empty($fName) && !empty($fAddress) && !empty($MedicareCardNumber) && !empty($startDate) && !empty($endDate) && !empty($role)) {
            $sql = "INSERT INTO working
                    VALUES ('$fName','$fAddress','$MedicareCardNumber','$startDate','$endDate','$role')";

            if (mysqli_query($con, $sql)) {
                echo "<script>alert('New working status is successfully added')</script>";
            } else {
                echo mysqli_error($con);
            }
        } else if (empty($endDate)) {
            $sql = "INSERT INTO working
                    VALUES ('$fName','$fAddress','$MedicareCardNumber','$startDate',null,'$role')";

            if (mysqli_query($con, $sql)) {
                echo "<script>alert('New working status is successfully added')</script>";
            } else {
                echo mysqli_error($con);
            }
        }
    }
    ?>
</body>

</html>