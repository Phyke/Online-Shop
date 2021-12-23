<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
extract($_POST);
include("database.php");

if(isset($_POST["add_address"])) {
    $userid = $_SESSION['User.ID'];
    $addrt = mysqli_real_escape_string($conn, $addrt);
    $postal = mysqli_real_escape_string($conn, $postal);
    $addr = mysqli_real_escape_string($conn, $addr);

    $query_address = "
    INSERT INTO address
    VALUES (NULL,'$userid','$addr','$addrt','$postal');
    ";
    if (mysqli_query($conn, $query_address)) {
        echo "New record added in [Address] successfully.<br>";
        echo "<h1><a href='account.php'>Go back</a></h1>";
    }
    else {
        echo "Error: " . $query_address . "<br>" . mysqli_error($conn);
        echo "<h1><a href='account.php'>Go back</a></h1>";
    }
    mysqli_close($conn);
}
?>