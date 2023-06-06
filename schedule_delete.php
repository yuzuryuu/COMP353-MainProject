<?php
include_once 'config.php';

if(isset($_GET['deleteFname']) && isset($_GET['deleteMedicareNum']) && isset($_GET['deleteSchduleDate'])){
    $deleteFname= $_GET['deleteFname'];
    $deleteMedicareNum= $_GET['deleteMedicareNum'];
    $deleteSchduleDate= $_GET['deleteSchduleDate'];
    
    $sql = "DELETE FROM schedule WHERE Fname= '" . $deleteFname. "' 
    AND MedicareCardNumber= '". $deleteMedicareNum ."' AND Date= '". $deleteSchduleDate ."'";
    $result = mysqli_query($con,$sql);
    if($result){
        header('location:schedule.php');
    }else{
        die(mysqli_error($con));
    }
}
?>
