<?php
include_once('config.php');
// $addEmployee2 = "INSERT INTO Employee VALUES ('" . $_POST['firstName'] . "',"
//     . "'" . $_POST['lastName'] . "'" . ","
//     . "'" . $_POST['birthDate'] . "'" . ","
//     . "'" . $_POST['MedicareCardNumber'] . "'" . ","
//     . "'" . $_POST['telephoneNumber'] . "'" . ","
//     . "'" . $_POST['address'] . "'" . ","
//     . "'" . $_POST['city'] . "'" . ","
//     . "'" . $_POST['province'] . "'" . ","
//     . "'" . $_POST['postalCode'] . "'" . ","
//     . "'" . $_POST['citizenship'] . "'" . ","
//     . "'" . $_POST['email'] . "'" . ")";

echo $addEmployee2;
//insert into log
// $MedicareCardNumber = 'LAVA 8459 2731';
// $colleagues = "SELECT s.Fname, s.Faddress, s.MedicareCardNumber, e.email 
//             FROM schedule AS s, Employee AS e
//             WHERE s.MedicareCardNumber = e.MedicareCardNumber
//             AND Fname = (SELECT fName FROM working WHERE MedicareCardNumber = '" . $MedicareCardNumber . "')
//             AND Faddress = (SELECT fAddress FROM working WHERE MedicareCardNumber = '" . $MedicareCardNumber . "')
//             AND Date IN (SELECT Date from schedule WHERE MedicareCardNumber = '" . $MedicareCardNumber . "')
//             AND Date BETWEEN '2023-03-01' AND (SELECT Date FROM Infected WHERE Date BETWEEN '2023-03-01' AND
//             '2023-03-31' AND MedicareCardNumber = '" . $MedicareCardNumber . "')
//             AND s.MedicareCardNumber <>'" . $MedicareCardNumber . "'
//             GROUP BY MedicareCardNumber";
// echo $colleagues;
// echo "<br/>";
// $result = mysqli_query($con, $colleagues);
// if ($result === false) {
//     $errorMsg = "Invalid Query: " + mysqli_error($con);
//     echo $errorMsg;
// } else {
//     $articles = mysqli_fetch_all($result);

//     foreach ($articles as $article) {
//         echo $article[0];
//     }
// }

// $Date = '2023-03-14';
// foreach ($articles as $article) {
//     $log = "INSERT INTO log VALUES ('" . $Date . "', '" . $article[0] . "', '" . $article[1] . "', '"
//         . $article[2] . "', '" . $article[3] . "', 'WARNING', 
//                 'One of your colleagues that you have worked with in the past two weeks have been infected with COVID-19')";
//     echo "<br/>";
//     echo $log;
//     $result = mysqli_query($con, $log);
//     if ($result === false) {
//         $errorMsg = "Invalid Query: " + mysqli_error($con);
//         echo $errorMsg;
//     }
// }
// if ($result === false) {
//     $errorMsg = "Invalid Query: " + mysqli_error($con);
//     echo $errorMsg;
// } else {
//     echo "<script>alert('WARNING email logged')</script>";
// }
