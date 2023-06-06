<?php
include_once('config.php');
$sql = "select MedicareCardNumber from Employee";
$result = mysqli_query($con, $sql);
if ($result === false) {
    $errorMsg = "Invalid Query: " . mysqli_error($con);
} else {
    $articles = mysqli_fetch_all($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $editEmployee = 'UPDATE Employee SET';
    $querypart = array();
    if (!empty($_POST['firstName'])) {
        $querypart[] = "firstName = '" . $_POST['firstName'] . "'";
    }
    if (!empty($_POST['lastName'])) {
        $querypart[] = "lastName = '" . $_POST['lastName'] . "'";
    }
    if (!empty($_POST['birthDate'])) {
        $querypart[] = "birthDate = '" . $_POST['birthDate'] . "'";
    }
    if (!empty($_POST['telephoneNumber'])) {
        $querypart[] = "telephoneNumber = '" . $_POST['telephoneNumber'] . "'";
    }
    if (!empty($_POST['address'])) {
        $querypart[] = "address = '" . $_POST['address'] . "'";
    }
    if (!empty($_POST['city'])) {
        $querypart[] = "city = '" . $_POST['city'] . "'";
    }
    if (!empty($_POST['province'])) {
        $querypart[] = "province = '" . $_POST['province'] . "'";
    }
    if (!empty($_POST['postalCode'])) {
        $querypart[] = "postalCode = '" . $_POST['postalCode'] . "'";
    }
    if (!empty($_POST['citizenship'])) {
        $querypart[] = "citizenship = '" . $_POST['citizenship'] . "'";
    }
    if (!empty($_POST['email'])) {
        $querypart[] = "email = '" . $_POST['email'] . "'";
    }

    if (!empty($querypart)) {
        $editEmployee .= ' ' . implode(", ", $querypart) . ' WHERE MedicareCardNumber = "' . $_POST['MedicareCardNumber'] . '"';
    } else {
        echo "<script>alert('No information provided. Please try again.')</script>";
    }

    $result = mysqli_query($con, $editEmployee);
    $affectedRows = mysqli_affected_rows($con);

    if ($affectedRows === -1) {
        $errorMsg = "Invalid Query: " . mysqli_error($con);
        echo $errorMsg;
    } elseif ($affectedRows == 0) {
        echo '<script>alert("No employee found with the given Medicare card number")</script>';
    } else {
        echo '<script>alert("Employee information is successfully updated")</script>';
    }
}
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>Edit Employee</title>
</head>

<body>
    <div class = "container my-3">
        <h3>
            Edit Employee Information
        </h3>
        <form method="post">
            <label for="employee"> Choose an employee: </label>
            <select name="MedicareCardNumber">
                <?php
                foreach ($articles as $article) {
                    echo "<option value='" . $article[0] . "'>" . $article[0] . "</option>";
                }
                ?>
            </select>
            <br />
            <label class="col-md-6 col-form-label">First Name: </label> <input type="text" class="form-control" name="firstName"><br />
            <label class="col-md-6 col-form-label">Last Name: </label><input type="text" class="form-control" name="lastName"><br />
            <label class="col-md-6 col-form-label">Date of Birth: </label> <input type="text" class="form-control" name="birthDate" placeholder="YYYY-MM-DD"><br />
            <label class="col-md-6 col-form-label">Phone Number: </label><input type="text" class="form-control" name="telephoneNumber"><br />
            <label class="col-md-6 col-form-label">Address: </label><input type="text" class="form-control" name="address"><br />
            <label class="col-md-6 col-form-label">City: </label><input type="text" class="form-control" name="city"><br />
            <label class="col-md-6 col-form-label">Province: </label> <input type="text" class="form-control" name="province"><br />
            <label class="col-md-6 col-form-label">Postal Code: </label><input type="text" class="form-control" name="postalCode"><br />
            <label class="col-md-6 col-form-label">Citizenship: </label><input type="text" class="form-control" name="citizenship"><br />
            <label class="col-md-6 col-form-label">Email: </label> <input type="text" class="form-control" name="email"><br />
            
            <div class="row mb-3 my-5">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="Employee_Display.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <a href="Employee_Display.php">Go back to List</a>
</body>

</html>