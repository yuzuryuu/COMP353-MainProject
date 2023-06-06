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

    <title>Query 12</title>
</head>

<body>
    <div class="container my-3">

        <button class="btn btn-light">
            <a href="index.php">Go back to home</a>
        </button><br /><br />
        <h3>12. For a given facility, give the total hours scheduled for every role during a specific period. </h3>

        <form method="post">

            <label for="employee"> Choose a facility: </label>
            <select name="name">
                <?php
                $sql = "select name from facility";
                $result = mysqli_query($con, $sql);
                $articles_1 = mysqli_fetch_all($result);

                foreach ($articles_1 as $article) {
                    echo "<option value='" . $article[0] . "'>" . $article[0] . "</option>";
                }
                ?>
            </select>
            <br /><br />
            <label>Start Date: </label> <input type="date" , name="startDate"><br />
            <label>End Date: </label><input type="date" , name="endDate"><br />
            <div class="col-sm-3">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
            <br /><br />

        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $sql12 = "SELECT f.name, w.role, sum(floor(timediff(endTime, startTime))) / 10000 as Total_Hour
            from facility f, working w, schedule s
            where f.name = w.fName 
                and w.fName = s.Fname
                and w.MedicareCardNumber = s.MedicareCardNumber
                and f.name = '" . $_POST['name'] . "'
                and s.Date between '" . $_POST['startDate'] . "' AND '" . $_POST['endDate'] . "'
            group by w.role
            order by w.role ASC;
                ";

            $result = mysqli_query($con, $sql12);
            if ($result === false) {
                $errorMsg = "Invalid Query: " . mysqli_error($con);
                echo $errorMsg;
            } else {
                echo "Facility: " . $_POST['name'] ." <br>"; 
                echo "Period: from " . $_POST['startDate'] . " to " .$_POST['endDate'];
                $articles_2 = mysqli_fetch_all($result);
                echo "<table class = \"table-primary\">";
                echo "<tr>";
                echo "<th>Facility Name</th>";
                echo "<th>Role</th>";
                echo "<th>Total_Hour</th>";
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
    </div>
</body>

</html>