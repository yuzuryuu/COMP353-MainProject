<?php
include_once 'config.php';
if(isset($_GET['deleteInfection'])){
    $InfectionType = $_GET['deleteInfection'];

    $sql = "DELETE from Infections WHERE InfectionType= '" . $InfectionType ."'";
    $result = mysqli_query($con,$sql);
    if($result){
        header('location:infection.php');
    }else{
        die(mysqli_error($con));
    }
}
?>