<?php
include_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // check if Medicare Card Number is empty or not. 
    //if the user does not put anything, MySQL will still accept it because it is ''.
    if (empty($_POST['MedicareCardNumber'])) {
        echo "<script>alert('Error: Missing Medicare Card Number. Please try again.')</script>";
    }

    $addEmployee = "INSERT INTO Employee VALUES ('" . $_POST['firstName'] . "',"
        . "'" . $_POST['lastName'] . "'" . ","
        . "'" . $_POST['birthDate'] . "'" . ","
        . "'" . $_POST['MedicareCardNumber'] . "'" . ","
        . "'" . $_POST['telephoneNumber'] . "'" . ","
        . "'" . $_POST['address'] . "'" . ","
        . "'" . $_POST['city'] . "'" . ","
        . "'" . $_POST['province'] . "'" . ","
        . "'" . $_POST['postalCode'] . "'" . ","
        . "'" . $_POST['citizenship'] . "'" . ","
        . "'" . $_POST['email'] . "'" . ")";

    $addresults = mysqli_query($con, $addEmployee);

    if ($addresults === false) {
        echo "Error, try again.";
        echo mysqli_error($con);
    } else {
        echo "<script>alert('Employee information is successfully added')</script>";
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

    <title>Add Employee</title>
</head>

<body>
    <div class = "container my-5">
        <h3>Add Employee</h3>
        <form method="post">
            <div class="form-group"><label>Medicare Card Number: </label><input type="text" class = "form-control" name="MedicareCardNumber" placeholder="ABCD 0123 4567"><br /></div>
            <div class="form-group"><label>First Name: </label> <input type="text" class = "form-control" name="firstName"><br /></div>
            <div class="form-group"><label>Last Name: </label><input type="text" class = "form-control" name="lastName"><br /></div>
            <div class="form-group"><label>Date of Birth: </label> <input type="text" class = "form-control" name="birthDate" placeholder="YYYY-MM-DD"><br /></div>
            <div class="form-group"><label>Phone Number: </label><input type="text" class = "form-control" name="telephoneNumber"><br /></div>
            <div class="form-group"><label>Address: </label><input type="text" class = "form-control" name="address"><br /></div>
            <div class="form-group"><label>City: </label><input type="text" class = "form-control" name="city"><br /></div>
            <div class="form-group"><label>Province: </label> <input type="text" class = "form-control" name="province"><br /></div>
            <div class="form-group"><label>Postal Code: </label><input type="text" class = "form-control" name="postalCode"><br /></div>
            <div class="form-group"><label>Citizenship: </label><input type="text" class = "form-control" name="citizenship"><br /></div>
            <div class="form-group"><label>Email: </label> <input type="email" class = "form-control" name="email"><br /></div>
            
            <div class="row mb-3 my-5">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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