<!DOCTYPE html>
<?php
include_once('config.php');
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <div class = "container my-5">
        <form method = "post">
            <div class="row mb-3">
                <label class = "col-sm-3 col-form-label">Facility Name:</label>
                <input type="text" class = "form-control" name = "name">
            </div>
            <div class="row mb-3">
                <label class = "col-sm-3 col-form-label">Address: </label>
                <input type="text" class = "form-control" name = "address">
            </div>
            <div class="row mb-3">
                <label class = "col-sm-3 col-form-label">city: </label>
                <input type="text" class = "form-control" name = "city">
            </div>
            <div class="row mb-3">
                <label class = "col-sm-3 col-form-label">province: </label>
                <input type="text" class = "form-control" name = "province">
            </div>
            <div class="row mb-3">
                <label class = "col-sm-3 col-form-label">postal code: </label>
                <input type="text" class = "form-control" name = "postalCode" placeholder = "A1B 1A1">
            </div>
            <div class="row mb-3">
                <label class = "col-sm-3 col-form-label">phone number: </label>
                <input type="nu" class = "form-control" name = "phoneNumber" placeholder = "000-000-0000">
            </div>
            <div class="row mb-3">
                <label class = "col-sm-3 col-form-label">web address: </label>
                <input type="text" class = "form-control" name = "webAddress">   
            </div>
            <div class="row mb-3">
                <label class = "col-sm-3 col-form-label">type: </label>
                <input type="text" class = "form-control" name = "type"> 
            </div>
            <div class="row mb-3">
                <label class = "col-sm-3 col-form-label">capacity: </label>
                <input type="text" class = "form-control" name = "capacity"> 
            </div>

            <div class = "row mb-3 my-5">
                <div class = "offset-sm-3 col-sm-3 d-grid">
                <button type = "submit" class ="btn btn-primary" name = "submit">Add a new facility</button>
                </div>
                <div class = "col-sm-3 d-grid">
                    <a class ="btn btn-outline-primary" href="facility.php" role = "button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <?php
    if(isset($_POST['submit']))

        $name = $_POST["name"];
        $address =  $_POST["address"];
        $city = $_POST["city"];
        $province = $_POST["province"];
        $postalCode = $_POST["postalCode"] ;
        $phoneNumber =  $_POST["phoneNumber"];
        $webAddress = $_POST["webAddress"];
        $type =  $_POST["type"];
        $capacity = $_POST["capacity"];

        //check if any of the values are empty or null before constructing the SQL query
        if (!empty($name) && !empty($address) && !empty($city) && !empty($province) && !empty($postalCode) && !empty($phoneNumber) && !empty($type) && isset($capacity)) {
            $sql = "INSERT INTO facility
                    VALUES ('$name','$address','$city','$province','$postalCode',
                    '$phoneNumber','$webAddress','$type', $capacity)";

            if (mysqli_query($con, $sql)) {
                echo "<script>alert('Facility is successfully added')</script>";
            } 
            else {
                die(mysqli_error($con));
            }   
 
        }         
    ?>
</body>
</html>

