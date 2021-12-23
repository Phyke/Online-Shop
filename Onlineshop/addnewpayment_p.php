<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
extract($_POST);
include("database.php");

if(isset($_POST["add_payment"])) {
    $userid = $_SESSION['User.ID'];
    $pmethod = mysqli_real_escape_string($conn, $pmethod);
    $partner = mysqli_real_escape_string($conn, $partner);
    $refno = mysqli_real_escape_string($conn, $refno);

    $query_payment = "
    INSERT INTO payment
    VALUES (NULL,'$userid','$pmethod','$partner','$refno');
    ";
    if (mysqli_query($conn, $query_payment)) {
        echo "New record added in [Payment] successfully.<br>";
        echo "<h1><a href='account.php'>Go back</a></h1>";
    }
    else {
        echo "Error: " . $query_payment . "<br>" . mysqli_error($conn);
        echo "<h1><a href='account.php'>Go back</a></h1>";
    }
    mysqli_close($conn);
}
?>