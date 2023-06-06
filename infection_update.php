<?php
include('config.php');

$InfectionType = $_GET['updateInfectionType'];

$sql = "SELECT * from Infections where InfectionType = '$InfectionType'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$InfectionType = $row["InfectionType"];

if(isset($_POST["submit"])){
    $NewInfectionType = $_POST["InfectionType"];

    $sql_update = "UPDATE Infections SET 
                    InfectionType = '$NewInfectionType' 
                    WHERE InfectionType = '$InfectionType'";
    $result = mysqli_query($con,$sql_update);

    if ($result) {
        echo"<script type='text/javascript'>alert('Infection Type is successfully updated');window.location.href='infection.php';</script>";
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

    <title>Update Infection Type</title>
</head>

<body>
    <div class = "container my-5">
        <form method = "post">
            <div class="form-group">    
                <label>Infection Type:</label>
                <input type="text" class = "form-control" name = "InfectionType" value = "<?php echo $InfectionType; ?>">
            </div>

            <div class = "row mb-3 my-5">
                <div class = "offset-sm-3 col-sm-3 d-grid">
                <button type = "submit" class ="btn btn-primary" name = "submit">Update the information</button>
                </div>
                <div class = "col-sm-3 d-grid">
                    <a class ="btn btn-outline-primary" href="infection.php" role = "button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

