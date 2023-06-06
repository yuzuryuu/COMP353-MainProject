<?php
include_once('config.php');

$sql = "select Distinct fName, fAddress from working";
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

    <title>Employee-Facility</title>
    </style>
</head>

<body>
    <div class="container my-3">
        <h1>Display Employees per facilitiy</h1>
        <br/><br/>

        <form method="post">
            <label for="facility" class="col-sm-3 col-form-label"> Choose a facility: </label>
            <select name="fName">
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
                    <a class="btn btn-outline-primary" href="Employee_Display.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <?php
    //Query 7 Implmentation
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sql7 = "select Employee.firstName, Employee.lastName, working.startDate, Employee.birthDate,
        Employee.MedicareCardNumber, Employee.telephoneNumber, Employee.city,
        Employee.province, Employee.postalCode, Employee.citizenship, Employee.email
        from Employee, working WHERE working.fName = '" . $_POST['fName'] . "' 
        AND Employee.MedicareCardNumber = working.MedicareCardNumber
        ORDER BY firstName ASC, lastName ASC;";
        $result = mysqli_query($con, $sql7);

        if ($result === false) {
            $errorMsg = "Invalid Query: " . mysqli_error($con);
        } else {
            $articles = mysqli_fetch_all($result);

            echo "<table class = \"table\">";
            echo "<tr>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Start Date</th>";
            echo "<th>Date of Birth</th>";
            echo "<th>Medicare Card Number</th>";
            echo "<th>Telephone</th>";
            echo "<th>City</th>";
            echo "<th>Province</th>";
            echo "<th>Postal Code</th>";
            echo "<th>Citizenship</th>";
            echo "<th>email</th>";
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
    <a href="index.php">Home</a> <br>
    <a href="Employee_Display.php">Go back to List</a>
</body>

</html>