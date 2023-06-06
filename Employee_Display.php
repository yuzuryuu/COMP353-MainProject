<!DOCTYPE html>
<html lang="en">
<?php
include_once('config.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <title>HFESTS Employees</title>

</head>

<?php
$sql = 'select * from Employee';
$result = mysqli_query($con, $sql);

if ($result === false) {
    $errorMsg = "Invalid Query: " + mysqli_error($con);
} else {
    $articles = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<body>
    <div class="container my-3">
        <h1>Employees</h1>
        <button class="btn btn-light">
            <a href="index.php">Go back to home</a>
        </button>
        <br><br>
        <button class="btn btn-primary my-1 mx-2"><a href="Employee_Add.php" class='text-light'>Add Employee</a></button>
        <button class="btn btn-primary my-1 mx-2"><a href="Employee_Delete.php" class='text-light'>Delete Employee</a></button>
        <button class="btn btn-primary my-1 mx-2"><a href="Employee_Edit.php" class='text-light'>Edit Employee</a></button>
        <button class="btn btn-primary my-1 mx-2"><a href="Employee_Display_perFacility.php" class='text-light'>Employee Per Facility</a></button>

        <table class="table my-3">
            <tr>
                <th>Medicare Card Number</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>City</th>
                <th>Province</th>
                <th>Postal Code</th>
                <th>Citizenship</th>
                <th>Email</th>
            </tr>
            <?php foreach ($articles as $article) : ?>
                <tr>
                    <td><?php echo $article['MedicareCardNumber']; ?></td>
                    <td><?php echo $article['firstName']; ?></td>
                    <td><?php echo $article['lastName']; ?></td>
                    <td><?php echo $article['birthDate']; ?></td>
                    <td><?php echo $article['telephoneNumber']; ?></td>
                    <td><?php echo $article['address']; ?></td>
                    <td><?php echo $article['city']; ?></td>
                    <td><?php echo $article['province']; ?></td>
                    <td><?php echo $article['postalCode']; ?></td>
                    <td><?php echo $article['citizenship']; ?></td>
                    <td><?php echo $article['email']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php mysqli_close($con); ?>
        <a href="index.php">Home</a>
    </div>
</body>

</html>