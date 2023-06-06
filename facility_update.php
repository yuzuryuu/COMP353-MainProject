<?php
include('config.php');

$name = $_GET['updateName'];
$sql = "SELECT * from facility where name = '$name '";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$name = $row["name"];
$address = $row["address"];
$city = $row["city"];
$province = $row["province"];
$postalCode = $row["postalCode"] ;
$phoneNumber = $row["phoneNumber"];
$webAddress =$row["webAddress"];
$type =  $row['type'];
$capacity = $row['capacity'];

$oldname = $_POST["name"];

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $address =  $_POST["address"];
    $city = $_POST["city"];
    $province = $_POST["province"];
    $postalCode = $_POST["postalCode"] ;
    $phoneNumber =  $_POST["phoneNumber"];
    $webAddress = $_POST["webAddress"];
    $type =  $_POST["type"];
    $capacity = $_POST["capacity"];

    $sql_update = "UPDATE facility set 
                    name= '$name', address= '$address', city= '$city', province= '$province',
                    postalCode= '$postalCode',phoneNumber= '$phoneNumber',
                    webAddress= '$webAddress', type= '$type', capacity= $capacity 
                    WHERE name = '$oldname'";
    $result = mysqli_query($con,$sql_update);

    if ($result) {
        header('location:facility.php');
    } 
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }  
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>Update Facility</title>
</head>

<body>
    <div class = "container my-5">
        <form method = "post">
            <div class="form-group">    
                <label>Facility Name:</label>
                <input type="text" class = "form-control" name = "name" value = "<?php echo $name;?>">
            </div>
            <div class="form-group">
                <label>Address: </label>
                <input type="text" class = "form-control" name = "address" value = "<?php echo $address;?>">
            </div>
            <div class="form-group">
                <label>city: </label>
                <input type="text" class = "form-control" name = "city" value = "<?php echo $city;?>">
            </div>
            <div class="form-group">
                <label>province: </label>
                <input type="text" class = "form-control" name = "province" value = "<?php echo $province;?>">
            </div>
            <div class="form-group">
                <label>postal code: </label>
                <input type="text" class = "form-control" name = "postalCode" value = "<?php echo $postalCode;?>">
            </div>
            <div class="form-group">
                <label>phone number: </label>
                <input type="text" class = "form-control" name = "phoneNumber" value = "<?php echo $phoneNumber;?>">
            </div>
            <div class="form-group">
                <label>web address: </label>
                <input type="text" class = "form-control" name = "webAddress" value = "<?php echo $webAddress;?>">   
            </div>
            <div class="form-group">
                <label>type: </label>
                <input type="text" class = "form-control" name = "type" value = "<?php echo $type;?>"> 
            </div>
            <div class="form-group">
                <label>capacity: </label>
                <input type="text" class = "form-control" name = "capacity" value = "<?php echo $capacity;?>"> 
            </div>

            <div class = "row mb-3 my-5">
                <div class = "offset-sm-3 col-sm-3 d-grid">
                <button type = "submit" class ="btn btn-primary" name = "submit">Update the information</button>
                </div>
                <div class = "col-sm-3 d-grid">
                    <a class ="btn btn-outline-primary" href="facility.php" role = "button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

