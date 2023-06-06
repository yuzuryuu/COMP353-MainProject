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

    <title>Query 11</title>
</head>

<body>
    <div class="container my-3">

        <button class="btn btn-light">
            <a href="index.php">Go back to home</a>
        </button><br /><br />
        <h3>11. For a given facility, generate a list of all the doctors and nurses who have been on schedule to work in the last two weeks. </h3>
        <p style="color: red">from 2023-03-13 to 2023-03-27</p>


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
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
                <br /><br />

            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $sql11 = "SELECT f.name, e.FirstName, e.LastName, w.role 
            from facility f, schedule s, working w, Employee e 
            where e.MedicareCardNumber = w.MedicareCardNumber 
                AND e.MedicareCardNumber = s. MedicareCardNumber 
                AND s.Fname = '" . $_POST['name'] . "'
                AND (w.role = 'doctor' OR w.role = 'nurse')
                AND s.Faddress = f.address and (s.date between  '2023-03-27' - INTERVAL 14 DAY and '2023-03-27')
            group by s.MedicareCardNumber
            order by w.role, e.FirstName ASC
            ";

                $result = mysqli_query($con, $sql11);
                if ($result === false) {
                    $errorMsg = "Invalid Query: " . mysqli_error($con);
                    echo $errorMsg;
                } else if(mysqli_num_rows($result) == 0){
                        echo "There are no doctors or nurses working in this facility.";
                } else{

                    $articles_2 = mysqli_fetch_all($result);
                    echo "<table class = \"table-primary\">";
                    echo "<tr>";
                    echo "<th>Facility Name</th>";
                    echo "<th>First Name</th>";
                    echo "<th>Last Name</th>";
                    echo "<th>Role</th>";
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