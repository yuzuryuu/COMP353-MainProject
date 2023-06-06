<?php

include_once('config.php');
$sql = "select * from schedule";
$result = mysqli_query($con, $sql);
$articles = mysqli_fetch_all($result);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>Schedule</title>

    <script>
		function confirmDelete(item_name1,item_name2,item_name3) {
			return confirm("Are you sure you want to delete schedule for\"" + item_name2 + "\" working at \"" + item_name1 + "\" on \"" + item_name3 + "\"?");
		}
	</script>

</head>

<body>
    <div class="container my-3">
        <h1>Schedules</h1>

        <button class="btn btn-light">
            <a href="index.php">Go back to home</a>
        </button>
        <br><br>
        <button class="btn btn-primary">
            <a href="schedule_add.php" class='text-light'>Add a schedule</a>
        </button>
        <form method="post">
            <h3>Check Schedule</h3>
            <label for="employee"> Choose an employee: </label>
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
            <br />
            <label>Start Date: </label> <input type="date" , name="startDate"><br />
            <label>End Date: </label><input type="date" , name="endDate"><br />
            <div class="col-sm-3">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>

        </form>
        <br><br>
        <?php
        //Query 8 Implementation

        // $sql8 = "select MedicareCardNumber from Employee";
        // $result = mysqli_query($con, $sql8);
        // $articles_1 = mysqli_fetch_all($result);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $sql8_1 = "select schedule.Fname, schedule.Date, schedule.startTime, schedule.endTime  
                        from schedule where MedicareCardNumber = '" . $_POST['MedicareCardNumber'] . "' 
                        AND Date between '" . $_POST['startDate'] . "' AND '" . $_POST['endDate'] . "'
                        ORDER BY Fname ASC, Date ASC, startTime ASC;";

            $result = mysqli_query($con, $sql8_1);
            if ($result === false) {
                $errorMsg = "Invalid Query: " . mysqli_error($con);
                echo $errorMsg;
            } else {
                $articles_2 = mysqli_fetch_all($result);
                echo "<table class = \"table\">";
                echo "<tr>";
                echo "<th>Facility Name</th>";
                echo "<th>Date</th>";
                echo "<th>Start Time</th>";
                echo "<th>End Time</th>";              
                echo "</tr>";
                foreach ($articles_2 as $article) {
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
        <br><br>
        <table class="table">
            <tr>
                <th>Facility Name</th>
                <th>Facility Address</th>
                <th>Medicare Card Number</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($articles as $article) : ?>
                <tr>
                    <td><?php echo $article[0] ?></td>
                    <td><?php echo $article[1] ?></td>
                    <td><?php echo $article[2] ?></td>
                    <td><?php echo $article[3] ?></td>
                    <td><?php echo $article[4] ?></td>
                    <td><?php echo $article[5] ?></td>
                    <td><?php echo 	'<button class ="btn btn-primary"><a href="schedule_update.php?updateFname=' . $article[0] . '&updateMedicareNum=' . $article[2] . '&updateScheduleDate=' . $article[3] . '" class="text-light">Update</a></button>
                                <button class ="btn btn-danger" ><a href="schedule_delete.php?deleteFname=' . $article[0] . '&deleteMedicareNum=' . $article[2] . '&deleteSchduleDate=' . $article[3] . '" class="text-light" 
            onclick="return confirmDelete(\'' . $article[0] . '\',\''. $article[2] . '\',\''. $article[3] . '\')">Delete</a></button> ';
 ?></td>
                </tr>
            <?php endforeach ?>
        </table>

        <a href="index.php">Home</a>
    </div>
</body>

</html>