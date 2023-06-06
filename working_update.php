<?php
include('config.php');

$MedicareCardNumber = $_GET['updateMnum'];

// $MedicareCardNumber = str_replace('%20', ' ', $row["MedicareCardNumber"]); // remove spaces

$sql = "SELECT * from working where MedicareCardNumber = '$MedicareCardNumber'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$fName = $row['fName'];
$fAddress = $row["fAddress"];
$MedicareCardNumber = $row["MedicareCardNumber"];
$startDate = $row["startDate"];
$endDate = $row["endDate"];
$role = $row["role"];

if (isset($_POST["submit"])) {

    $fName = $_POST['fName'];
    $fAddress = $_POST["fAddress"];
    $MedicareCardNumber = $_POST["MedicareCardNumber"];
    $startDate = $_POST["startDate"];
    $endDate = $_POST["endDate"];
    $role = $_POST["role"];


    //when end date is empty
    if (empty($endDate)) {
        $sql_update = "UPDATE working set 
                    fName= '$fName', fAddress= '$fAddress', MedicareCardNumber= '$MedicareCardNumber',
                    startDate= '$startDate', endDate= null, `role`= '$role'
                    WHERE MedicareCardNumber = '$MedicareCardNumber'";
        $result = mysqli_query($con, $sql_update);

        if ($result) {
            echo "<script>alert('working status is successfully updated')</script>";
        } else {
            echo $endDate . "==========";

            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    } else {
        $sql_update = "UPDATE working set 
                    fName= '$fName', fAddress= '$fAddress', MedicareCardNumber= '$MedicareCardNumber',
                    startDate= '$startDate', endDate= '$endDate', `role`= '$role'
                    WHERE MedicareCardNumber = '$MedicareCardNumber'";
        $result = mysqli_query($con, $sql_update);

        if ($result) {
            echo "<script>alert('working status is successfully updated')</script>";
        } else {
            echo $endDate . "==========";

            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
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

    <title>Update working</title>
</head>

<body>
    <div class="container my-5">
        <form method="post">
            <div class="form-group">
                <label>Facility Name:</label>
                <input type="text" class="form-control" name="fName" value="<?php echo $fName; ?>">
            </div>
            <div class="form-group">
                <label>Address: </label>
                <input type="text" class="form-control" name="fAddress" value="<?php echo $fAddress; ?>">
            </div>
            <div class="form-group">
                <label>Medicare Card Number: </label>
                <input type="text" class="form-control" name="MedicareCardNumber" value="<?php echo $MedicareCardNumber; ?>">
            </div>
            <div class="form-group">
                <label>Start date: </label>
                <input type="date" class="form-control" name="startDate" value="<?php echo $startDate; ?>" placeholder= "YYYY-MM-DD">
            </div>
            <div class="form-group">
                <label>End date: </label>
                <input type="date" class="form-control" name="endDate" value="<?php echo $endDate; ?>" placeholder = "YYYY-MM-DD / Leave as blank if currently working">
            </div>
            <div class="form-group">
                <label>Role: </label>
                <input type="text" class="form-control" name="role" value="<?php echo $role; ?>">
            </div>

            <div class="row mb-3 my-5">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" name="submit">Update the information</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="working.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>