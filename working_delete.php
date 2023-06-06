<?php
include_once 'config.php';
if(isset($_GET['deleteMnum'])){
    $deleteMnum = $_GET['deleteMnum'];

    $sql = "DELETE from working WHERE MedicareCardNumber= '" . $deleteMnum ."'";
    $result = mysqli_query($con,$sql);
    if($result){
        header('location:working.php');
    }else{
        die(mysqli_error($con));
    }
}
?>