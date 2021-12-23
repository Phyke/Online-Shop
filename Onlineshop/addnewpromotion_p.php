<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
extract($_POST);
include("database.php");

if(isset($_POST["add_promotion"])) {
    $shopname = $_SESSION['Shop.Name'];
    $newpromotion_type = mysqli_real_escape_string($conn, $newpromotion_type);
    $newpromotion_value = mysqli_real_escape_string($conn, $newpromotion_value);
    $newpromotion_expire = date("Y-m-d H:i:s",strtotime($newpromotion_expire));

    $query_promotion = "
    INSERT INTO promotion
    VALUES (NULL,'$shopname','$newpromotion_expire','$newpromotion_type','$newpromotion_value');
    ";
    if (mysqli_query($conn, $query_promotion)) {
        echo "New record added in [Promotion] successfully.<br>";
        echo "<h1><a href='promotionlist.php'>Go back</a></h1>";
    }
    else {
        echo "Error: " . $query_promotion . "<br>" . mysqli_error($conn);
        echo "<h1><a href='promotionlist.php'>Go back</a></h1>";
    }
    mysqli_close($conn);
}
?>