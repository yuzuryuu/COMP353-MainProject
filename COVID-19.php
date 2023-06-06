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

    <title>COVID-19 INFO</title>

</head>

<body>
    
    <div class="container my-3">
    <button class="btn btn-primary">
			<a href="index.php" class='text-light'>Home</a>
	</button>
    <br><br>
    <?php

        //Query 17 Implementation
        $sql17 = "select e.firstName, e.lastName, w.startDate, w.role, e.birthDate, e.email, 
    SUM(endTime - startTime) / 10000  as  total
    from working AS w, Employee as e, schedule as s
    WHERE e.MedicareCardNumber NOT IN (select MedicareCardNumber from Infected WHERE InfectionType = 'COVID-19')
    AND w.MedicareCardNumber = e.MedicareCardNumber
    AND s.MedicareCardNumber = e.MedicareCardNumber
    AND (w.role = 'doctor' or w.role = 'nurse')
    AND w.endDate IS NULL
    GROUP BY e.MedicareCardNumber
    ORDER BY w.role ASC, e.firstName ASC, e.lastName ASC;";

        $result = mysqli_query($con, $sql17);

        if ($result === false) {
            $errorMsg = "Invalid Query: " . mysqli_error($con);
            echo $errorMsg;
        } else {
            $articles = mysqli_fetch_all($result);
        }
        ?>

        <div>
            <h3>List of Doctor/Nurse Never Infected </h3>
            <table class="table">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Start Date</th>
                    <th>Role</th>
                    <th>Date of Birth</th>
                    <th>Email</th>
                    <th>Total Scheduled Hours</th>
                </tr>
                <?php foreach ($articles as $article) : ?>
                    <tr>

                        <td><?php echo $article[0]; ?></td>
                        <td><?php echo $article[1]; ?></td>
                        <td><?php echo $article[2]; ?></td>
                        <td><?php echo $article[3]; ?></td>
                        <td><?php echo $article[4]; ?></td>
                        <td><?php echo $article[5]; ?></td>
                        <?php $article6beta = explode(".", $article[6]);
                        ?>
                        <td><?php echo $article6beta[0] . " hrs"; ?></td>


                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <br>
        <div class="container my-3">
        <?php

        //Query 16 Implementation
        $sql16 = "SELECT e.firstName, e.lastName, e.birthDate, e.email, w.startDate, w.role, SUM(TIMESTAMPDIFF(HOUR, s.startTime, s.endTime)) AS totalScheduledHours
                    FROM Employee e, working w, schedule s
                    WHERE e.MedicareCardNumber = w.MedicareCardNumber AND w.fName = s.fName AND w.MedicareCardNumber = s.MedicareCardNumber AND w.role IN ('nurse', 'doctor') AND e.MedicareCardNumber IN (
                    SELECT MedicareCardNumber
                    FROM Infected
                    WHERE InfectionType = 'COVID-19'
                    GROUP BY MedicareCardNumber
                    HAVING COUNT(*) >= 3
                    )
                    GROUP BY e.MedicareCardNumber
                    ORDER BY w.role ASC, e.firstName ASC, e.lastName ASC;";

        $result = mysqli_query($con, $sql16);

        if ($result === false) {
            $errorMsg = "Invalid Query: " . mysqli_error($con);
            echo $errorMsg;
        } else {
            $articles = mysqli_fetch_all($result);
        }
        ?>

        <div>
            <h3>Details of the nurse(s) or the doctor(s) who are currently working and has been infected by COVID-19 at least three times.</h3>
            <table class="table">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Email</th>
                    <th>Start Date</th>
                    <th>Role</th>
                    <th>Total Scheduled Hours</th>
                </tr>
                <?php foreach ($articles as $article) : ?>
                    <tr>

                        <td><?php echo $article[0]; ?></td>
                        <td><?php echo $article[1]; ?></td>
                        <td><?php echo $article[2]; ?></td>
                        <td><?php echo $article[3]; ?></td>
                        <td><?php echo $article[4]; ?></td>
                        <td><?php echo $article[5]; ?></td>
                        <?php $article6beta = explode(".", $article[6]);
                        ?>
                        <td><?php echo $article6beta[0] . " hrs"; ?></td>


                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        
    </div>
</body>

</html>