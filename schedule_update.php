<?php
include_once('config.php');

$updateFname= $_GET['updateFname'];
$updateMedicareNum= $_GET['updateMedicareNum'];
$updateScheduleDate= $_GET['updateScheduleDate'];

$sql = "SELECT * from schedule where Fname = '$updateFname' and MedicareCardNumber = '$updateMedicareNum' and Date = '$updateScheduleDate'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$Fname = $row['Fname'];
$Faddress = $row["Faddress"];
$MedicareCardNumber = $row["MedicareCardNumber"];
$Date = $row["Date"];
$startTime = $row["startTime"];
$endTime = $row["endTime"];

$oldDate = $_POST["Date"];

if (isset($_POST["submit"])) {

    $Fname = $_POST['Fname'];
    $Faddress = $_POST["Faddress"];
    $MedicareCardNumber = $_POST["MedicareCardNumber"];
    $Date = $_POST["Date"];
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];                                         


    //when end date is empty
    if (empty($endDate)) {
        $sql_update = "UPDATE schedule set 
                    Fname= '$Fname', Faddress= '$Faddress', MedicareCardNumber= '$MedicareCardNumber',`Date`= '$Date',
                    startTime= '$startTime', endTime= '$endTime' 
                    WHERE Fname = '$updateFname' and MedicareCardNumber = '$updateMedicareNum' and Date = '$oldDate'";
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
                <input type="text" class="form-control" name="Fname" value="<?php echo $Fname; ?>">
            </div>
            <div class="form-group">
                <label>Address: </label>
                <input type="text" class="form-control" name="Faddress" value="<?php echo $Faddress; ?>">
            </div>
            <div class="form-group">
                <label>Medicare Card Number: </label>
                <input type="text" class="form-control" name="MedicareCardNumber" value="<?php echo $MedicareCardNumber; ?>">
            </div>
            <div class="form-group">
                <label>Date: </label>
                <input type="date" class="form-control" name="Date" value="<?php echo $Date; ?>">
            </div>
            <div class="form-group">
                <label>Start time: </label>
                <input type="time" class="form-control" name="startTime" value="<?php echo $startTime; ?>">
            </div>
            <div class="form-group">
                <label>End time: </label>
                <input type="time" class="form-control" name="endTime" value="<?php echo $endTime; ?>">
            </div>

            <div class="row mb-3 my-5">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary" name="submit">Update the information</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="schedule.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>