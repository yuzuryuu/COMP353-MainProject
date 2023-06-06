<?php
include_once 'config.php';
if(isset($_GET['deleteMedicareCardNumber'])){
    $MedicareCardNumber = $_GET['deleteMedicareCardNumber'];

    $sql = "DELETE from Infected WHERE MedicareCardNumber = '" . $MedicareCardNumber ."'";
    $result = mysqli_query($con,$sql);
    if($result){
        //header('location:infected.php');
        echo"<script type='text/javascript'>alert('Successfully Deleted!');window.location.href='infected.php';</script>";
    }else{
        die(mysqli_error($con));
    }
}
?>