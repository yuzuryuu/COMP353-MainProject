<?php
include_once('config.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>Query 15</title>
</head>

<body>
    <div class="container my-3">

        <button class="btn btn-light">
            <a href="index.php">Go back to home</a>
        </button><br /><br />
        <h3>Details of the Nurse(s) Who is/are Currently Working and has the Highest Number of Hours Scheduled</h3>

            <div class="container my-3">
        <?php

        $sql15 = "SELECT e.firstName, e.lastName, e.birthDate, e.email, w.startDate, SUM(TIMESTAMPDIFF(HOUR, s.startTime, s.endTime)) AS totalScheduledHours
                    FROM Employee e, working w, schedule s
                    WHERE e.MedicareCardNumber = w.MedicareCardNumber 
                    AND w.fName = s.fName 
                    AND w.fAddress = s.fAddress 
                    AND w.MedicareCardNumber = s.MedicareCardNumber 
                    AND role = 'nurse' AND w.endDate IS NULL
                    GROUP BY w.fName, w.fAddress, w.MedicareCardNumber
                    ORDER BY totalScheduledHours DESC;";

        $result = mysqli_query($con, $sql15);

        if ($result === false) {
            $errorMsg = "Invalid Query: " . mysqli_error($con);
            echo $errorMsg;
        } else {
            $articles = mysqli_fetch_all($result);
        }
        ?>

        <div>
            <table class="table">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Email</th>
                    <th>Start Date</th>
                    <th>Total Scheduled Hours</th>
                </tr>
                <?php foreach ($articles as $article) : ?>
                    <tr>

                        <td><?php echo $article[0]; ?></td>
                        <td><?php echo $article[1]; ?></td>
                        <td><?php echo $article[2]; ?></td>
                        <td><?php echo $article[3]; ?></td>
                        <td><?php echo $article[4]; ?></td>
                        <?php $article5beta = explode(".", $article[5]);
                        ?>
                        <td><?php echo $article5beta[0] . " hrs"; ?></td>


                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        
    </div>
</body>

</html>