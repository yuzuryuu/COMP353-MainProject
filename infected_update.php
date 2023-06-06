<?php
include('config.php');

$updateMedicareCardNumber = $_GET['updateMedicareCardNumber'];
$sql = "SELECT * from Infected where MedicareCardNumber = '$updateMedicareCardNumber'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$MedicareCardNumber = $row["MedicareCardNumber"];
$InfectionType = $row["InfectionType"];
$Date = $row["Date"];

if(isset($_POST["submit"])){
    
    $MedicareCardNumber = $_POST["MedicareCardNumber"];
    $InfectionType =  $_POST["InfectionType"];
    $Date = $_POST["Date"];

    $sql_update = "UPDATE Infected SET 
                    InfectionType= '$InfectionType', Date = '$Date'
                    WHERE MedicareCardNumber = '$updateMedicareCardNumber'";
    $result = mysqli_query($con,$sql_update);

    if ($result) {
        //header('location:infected.php');
        echo"<script type='text/javascript'>alert('Successfully Updated');window.location.href='infected.php';</script>";
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

    <title>Update Information</title>
</head>

<body>
    <div class = "container my-5">
        <form method = "post">
            <div class="form-group">    
                <label>Medicare Card Number:</label>
                <input type="text" class = "form-control" name = "MedicareCardNumber" value = "<?php echo $MedicareCardNumber;?>">
            </div>
            <div class="form-group">
                <label>Infection Type: </label>
                <select name="InfectionType">
                    <?php
                    $sql8 = "select InfectionType from Infections";
                    $result = mysqli_query($con, $sql8);
                    $articles_1 = mysqli_fetch_all($result);

                    foreach ($articles_1 as $article) {
                        echo "<option value='" . $article[0] . "'>" . $article[0] . "</option>";
                    }
                    ?>
                </select>            </div>
            <div class="form-group">
                <label>Date Infected: </label>
                <input type="date" class = "form-control" name = "Date" value = "<?php echo $Date;?>">
            </div>

            <div class = "row mb-3 my-5">
                <div class = "offset-sm-3 col-sm-3 d-grid">
                <button type = "submit" class ="btn btn-primary" name = "submit">Update the Information</button>
                </div>
                <div class = "col-sm-3 d-grid">
                    <a class ="btn btn-outline-primary" href="infected.php" role = "button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

