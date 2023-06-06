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

    <title>Add Infection</title>
</head>

<body>
    <div class = "container my-5">
        <form method = "post">
            <div class="row mb-3">
                <label class = "col-sm-3 col-form-label">Infection Type: </label>
                <input type="text" class = "form-control" name = "InfectionType">
            </div>

            <div class = "row mb-3 my-5">
                <div class = "offset-sm-3 col-sm-3 d-grid">
                <button type = "submit" class ="btn btn-primary" name = "submit" style="text-decoration:none;">Add a new Infection Type</button>
                </div>
                <div class = "col-sm-3 d-grid">
                    <a class ="btn btn-outline-primary" href="infection.php" role = "button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <?php
    if(isset($_POST['submit']))

        $InfectionType = $_POST["InfectionType"];

        //check if any of the values are empty or null before constructing the SQL query
        if (!empty($InfectionType)) {
            $sql = "INSERT INTO Infections
                    VALUES ('$InfectionType')";

            if (mysqli_query($con, $sql)) {
                echo"<script type='text/javascript'>alert('New Infection is Successfully Added');window.location.href='infection.php';</script>";
            } 
            else {
                die(mysqli_error($con));
            }   
 
        }         
    ?>
</body>
</html>

