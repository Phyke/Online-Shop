<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
extract($_POST);
include("database.php");

if(isset($_POST["add_shop"])) {
    $userid = $_SESSION['User.ID'];
    $shopname = mysqli_real_escape_string($conn, $shopname);
    $shoptype = mysqli_real_escape_string($conn, $shoptype);
    $shopaddr = mysqli_real_escape_string($conn, $shopaddr);
    $bankcode = mysqli_real_escape_string($conn, $bankcode);
    $banknumber = mysqli_real_escape_string($conn, $banknumber);

    $query_shop = "
    INSERT INTO shop
    VALUES ('$userid','$shopname','$shopaddr',NULL,'$shoptype','$bankcode','$banknumber');
    ";
    if (mysqli_query($conn, $query_shop)) {
        echo "New record added in [Shop] successfully.<br>";
        echo "<h1><a href='shoplist.php'>Go back</a></h1>";
    }
    else {
        echo "Error: " . $query_shop . "<br>" . mysqli_error($conn);
        echo "<h1><a href='shoplist.php'>Go back</a></h1>";
    }
    mysqli_close($conn);
}
?>