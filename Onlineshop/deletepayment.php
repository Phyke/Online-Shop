<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
include("database.php");

if(isset($_POST["delete_payment"])) {
    $paymentid = $_SESSION['Payment.ID'];

    $query_payment = "
    DELETE FROM payment
    WHERE `Payment.ID`=$paymentid;
    ";
    if (mysqli_query($conn, $query_payment)) {
        echo "Record deleted from [Payment] successfully.<br>";
        echo "<h1><a href='account.php'>Go back</a></h1>";
    }
    else {
        echo "Error: " . $query_payment . "<br>" . mysqli_error($conn);
        echo "<h1><a href='account.php'>Go back</a></h1>";
    }
    mysqli_close($conn);
}
?>