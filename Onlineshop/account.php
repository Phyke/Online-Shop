<?php 
$dummy="get value from DB by php and insert here";
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
else {
    include("database.php");
    $userid = $_SESSION["User.ID"];
    $sql_user = mysqli_query($conn,"SELECT * FROM users where `User.ID`='$userid';");
    $sql_address = mysqli_query($conn,"SELECT * FROM address where `User.ID`='$userid';");
    $sql_payment = mysqli_query($conn,"SELECT * FROM payment where `User.ID`='$userid';");
	$row_user = mysqli_fetch_array($sql_user);
    $row_address = mysqli_fetch_array($sql_address);
    $row_payment = mysqli_fetch_array($sql_payment);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <style>
        body{
            background-color:lightblue;
        }
    </style>
</head>
<body>
    <div class="container bg-light">
        <header>
          <button class="btn btn-secondary" onclick="document.location='homepage.php'">Back to Homepage</button>
          <hr>
          <p class="h1 text-center">My Account</p>
          <hr>
        </header>
        
        
        <p class="h2">User Info</p>
        <table class="table table-hover table-striped" style="width: auto;">
            <thead class="table-dark">
                <tr>
                <th scope="col">Information</th>
                <th scope="col">Detail</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">First Name</th>
                    <td><?php echo $row_user["User.First.Name"];?></td>
                </tr>
                <tr>
                    <th scope="row">Last Name</th>
                    <td><?php echo $row_user["User.Last.Name"];?></td>
                </tr>
                <tr>
                    <th scope="row">Phone No.</th>
                    <td><?php echo $row_user["User.Phone"];?></td>
                </tr>
                <tr>
                    <th scope="row">Email Address</th>
                    <td><?php echo $row_user["User.Email"];?></td>
                </tr>
                <tr>
                    <th scope="row">Password</th>
                    <td>********</td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-outline-primary" onclick="document.location='edituser.php'">Edit</button>
        <hr>
        <p class="h2">Address Info</p>
        <form action="editaddress.php" method="post">
            <label for="chooseaddress">Choose an Address:</label>
            <?php
            $address_count = mysqli_num_rows($sql_address);
            if($address_count==0){
                echo "You don't have any address.";
            }
            else{
                echo '<select name="chooseaddress">';
                for ($i=0 ; $i<$address_count ; $i++){
                    $j = $i+1;
                    echo "<option value='$j'>Address $j</option>";
                }
                echo '</select>';
                echo '<button type="submit" name="submitaddress" class="btn btn-outline-primary">Edit</button>';
            }
            ?>
        </form>
        <p>Or add a new address</p>
        <button class="btn btn-outline-primary" onclick="document.location='addnewaddress.php'">Add</button>
        <hr>
        <p class="h2">Payment Info</p>
        <form action="editpayment.php" method="post">
            <label for="choosepayment">Choose a Payment Method:</label>
            <?php
            $payment_count = mysqli_num_rows($sql_payment);
            if($payment_count==0){
                echo "You don't have any payment method.";
            }
            else{
                echo '<select name="choosepayment">';
                for ($i=0 ; $i<$payment_count ; $i++){
                    $j = $i+1;
                    echo "<option value='$j'>Payment $j</option>";
            }
            echo '</select>';
            echo '<button type="submit" name="submitpayment" class="btn btn-outline-primary">Edit</button>';
            }
            ?>
        </form>
        <p>Or add a new payment method</p>
        <button class="btn btn-outline-primary" onclick="document.location='addnewpayment.php'">Add</button>
    </div>
</body>
</html>
