<?php

include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $deleteEmployee = "DELETE FROM Employee WHERE MedicareCardNumber = '" . $_POST['MedicareCardNumber'] . "'";
    $result = mysqli_query($con, $deleteEmployee);
    $affectedRows = mysqli_affected_rows($con);

    if ($affectedRows === -1) {
        $errorMsg = "Invalid Query: " . mysqli_error($con);
        echo $errorMsg;
    } elseif ($affectedRows == 0) {
        echo '<script>alert("No employee found with the given Medicare card number")</script>';
    } else {
        echo '<script>alert("Employee is successfully deleted")</script>';
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

    <title>Delete Employee</title>
</head>

<body>
    <div class="container my-5">
        <h3>Put the medicare Card Number of the employee you wish to delete</h3>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Medicare Card Number: </label>
                <input type="text" class="form-control" name="MedicareCardNumber" placeholder="ABCD 0123 4567">
            </div>

            <div class="row mb-3 my-5">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-danger" name="submit">Delete</button>
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