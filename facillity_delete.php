<?php
include_once 'config.php';
if(isset($_GET['deleteName'])){
    $name = $_GET['deleteName'];

    $sql = "DELETE from facility WHERE name= '" . $name ."'";
    $result = mysqli_query($con,$sql);
    if($result){
        header('location:facility.php');
    }else{
        die(mysqli_error($con));
    }
}
?>