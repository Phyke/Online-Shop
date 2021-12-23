<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
extract($_POST);
include("database.php");

if(isset($_POST["save_payment"])) {
    $paymentID = $_SESSION['Payment.ID'];
    $pmethod = mysqli_real_escape_string($conn, $pmethod);
    $partner = mysqli_real_escape_string($conn, $partner);
    $refno = mysqli_real_escape_string($conn, $refno);

    $query_payment = "
    UPDATE payment
    SET `Payment.Method`='$pmethod', `Payment.Partner`='$partner', `Reference.No`='$refno'
    WHERE `Payment.ID` = $paymentID;
    ";
    if (mysqli_query($conn, $query_payment)) {
        echo "Record Updated in [Payment] successfully.<br>";
        echo "<h1><a href='account.php'>Go back</a></h1>";
    }
    else {
        echo "Error: " . $query_payment . "<br>" . mysqli_error($conn);
        echo "<h1><a href='account.php'>Go back</a></h1>";
    }
    mysqli_close($conn);
}
?>