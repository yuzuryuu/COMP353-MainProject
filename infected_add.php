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

    <title>Report Infected</title>
</head>

<body>
    <div class="container my-5">
        <h1>Report New Infected</h1>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Medicare Card Number:</label>
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
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Infection Type: </label>
                <select name="InfectionType">
                    <?php
                    $sql8 = "select InfectionType from Infections";
                    $result = mysqli_query($con, $sql8);
                    $articles_1 = mysqli_fetch_all($result);

                    foreach ($articles_1 as $article) {
                        echo "<option value='" . $article[0] . "'>" . $article[0] . "</option>";
                    }
                    ?>
                </select>            
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date of Infection: </label>
                <input type="date" class="form-control" name="Date">
            </div>

            <div class="row mb-3 my-5">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" name="submit">Report Infected</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="infected.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST['submit']))

        $MedicareCardNumber = $_POST["MedicareCardNumber"];
        $InfectionType =  $_POST["InfectionType"];
        $Date = $_POST["Date"];

        //check if any of the values are empty or null before constructing the SQL query
        if (!empty($MedicareCardNumber) && !empty($InfectionType) && !empty($Date)) {
            $sql = "INSERT INTO Infected
                    VALUES ('$MedicareCardNumber','$InfectionType', '$Date')";

            if (mysqli_query($con, $sql)) {
                echo"<script type='text/javascript'>alert('Reported Successfully!');window.location.href='infected.php';</script>";
            } else {
                die(mysqli_error($con));
            }

        //insert into log
        $colleagues = "SELECT s.Fname, s.Faddress, s.MedicareCardNumber, e.email 
            FROM schedule AS s, Employee AS e
            WHERE s.MedicareCardNumber = e.MedicareCardNumber
            AND Fname = (SELECT fName FROM working WHERE MedicareCardNumber = '" . $MedicareCardNumber . "')
            AND Faddress = (SELECT fAddress FROM working WHERE MedicareCardNumber = '" . $MedicareCardNumber . "')
            AND Date IN (SELECT Date from schedule WHERE MedicareCardNumber = '" . $MedicareCardNumber . "')
            AND Date BETWEEN '2023-03-01' AND (SELECT Date FROM Infected WHERE Date BETWEEN '2023-03-01' AND
            '2023-03-31' AND MedicareCardNumber = '" . $MedicareCardNumber . "')
            AND s.MedicareCardNumber <>'" . $MedicareCardNumber . "'
            GROUP BY MedicareCardNumber";

        $result = mysqli_query($con, $colleagues);
        if ($result === false) {
            $errorMsg = "Invalid Query: " + mysqli_error($con);
            echo $errorMsg;
        } else {
            $articles = mysqli_fetch_all($result);
            foreach ($articles as $article) {
                $log = "INSERT INTO log VALUES ('" . $Date . "', '" . $article[0] . "', '" . $article[1] . "', '"
                    . $article[2] . "', '" . $article[3] . "', 'WARNING', 
                'One of your colleagues that you have worked with in the past two weeks have been infected with COVID-19')";
                $result = mysqli_query($con, $log);
                if ($result === false) {
                    $errorMsg = "Invalid Query: " + mysqli_error($con);
                    echo $errorMsg;
                }
            }
            if ($result === false) {
                $errorMsg = "Invalid Query: " + mysqli_error($con);
                echo $errorMsg;
            } else {
                echo "<script>alert('WARNING email logged')</script>";
            }
        }
    }
    ?>
</body>

</html>