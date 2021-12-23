<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
extract($_POST);
include("database.php");

if(isset($_POST["save_promotion"])) {
    $promotionid = $_SESSION['Promotion.ID'];
    $promotion_type = mysqli_real_escape_string($conn, $promotion_type);
    $promotion_value = mysqli_real_escape_string($conn, $promotion_value);
    $promotion_expire = date("Y-m-d H:i:s",strtotime($promotion_expire));

    $query_promotion = "
    UPDATE promotion
    SET `Promotion.Type`='$promotion_type',`Promotion.Value`='$promotion_value',`Promotion.Expire`='$promotion_expire'
    WHERE `Promotion.ID`=$promotionid;
    ";
    if (mysqli_query($conn, $query_promotion)) {
        echo "Record updated in [Promotion] successfully.<br>";
        echo "<h1><a href='promotionlist.php'>Go back</a></h1>";
    }
    else {
        echo "Error: " . $query_promotion . "<br>" . mysqli_error($conn);
        echo "<h1><a href='promotionlist.php'>Go back</a></h1>";
    }
    mysqli_close($conn);
}
?>