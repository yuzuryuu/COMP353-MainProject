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

    <title>Query 14</title>
</head>

<body>
    <div class="container my-3">

        <button class="btn btn-light">
            <a href="index.php">Go back to home</a>
        </button><br /><br />
        <h3>Doctors currently working in a Province</h3>

            <form method="post">

                <label for="province"> Choose a Province: </label>
                <select name="province">
                    <?php
                    $sql = "select distinct province from facility";
                    $result = mysqli_query($con, $sql);
                    $articles_1 = mysqli_fetch_all($result);

                    foreach ($articles_1 as $article) {
                        echo "<option value='" . $article[0] . "'>" . $article[0] . "</option>";
                    }
                    ?>
                </select>
                <br /><br />
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
                <br /><br />

            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $sql14 = "SELECT e.firstName, e.lastName, e.city, COUNT(*) AS numFacilities
                            FROM Employee e, working w, facility f
                            WHERE e.MedicareCardNumber = w.MedicareCardNumber 
                            AND w.fAddress = f.address
                            AND w.fName = f.name
                            AND f.province = '" . $_POST['province'] . "' AND w.role = 'doctor' 
                            AND w.endDate IS NULL
                            GROUP BY e.MedicareCardNumber, e.firstName, e.lastName, e.city
                            ORDER BY e.city ASC, numFacilities DESC;";

                $result = mysqli_query($con, $sql14);
                if ($result === false) {
                    $errorMsg = "Invalid Query: " . mysqli_error($con);
                    echo $errorMsg;
                } else if(mysqli_num_rows($result) == 0){
                        echo "There are no doctors currently working in this province";
                } else{

                    $articles_2 = mysqli_fetch_all($result);
                    echo "<table class = \"table\">";
                    echo "<tr>";
                    echo "<th>First Name</th>";
                    echo "<th>Last Name</th>";
                    echo "<th>City of Residence</th>";
                    echo "<th>Number of Facilities Working</th>";
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