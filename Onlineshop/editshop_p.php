<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
extract($_POST);
include("database.php");

if(isset($_POST["save_shop"])) {
    $shopname_target = $_SESSION['Shop.Name'];

    $shopname = mysqli_real_escape_string($conn, $shopname);
    $shoptype = mysqli_real_escape_string($conn, $shoptype);
    $shopaddr = mysqli_real_escape_string($conn, $shopaddr);
    $bankcode = mysqli_real_escape_string($conn, $bankcode);
    $banknumber = mysqli_real_escape_string($conn, $banknumber);

    $query_shop = "
    UPDATE shop
    SET `Shop.Name`='$shopname', `Shop.Type`='$shoptype', `Shop.Address`='$shopaddr', `Bank.Code`='$bankcode', `Bank.Account.Number`='$banknumber'
    WHERE `Shop.Name` = '$shopname_target';
    ";
    if (mysqli_query($conn, $query_shop)) {
        echo "Record Updated in [Shop] successfully.<br>";
        echo "<h1><a href='shoplist.php'>Go back</a></h1>";
    }
    else {
        echo "Error: " . $query_shop . "<br>" . mysqli_error($conn);
        echo "<h1><a href='shoplist.php'>Go back</a></h1>";
    }
    mysqli_close($conn);
}
?>