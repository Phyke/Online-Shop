<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
include("database.php");

if(isset($_POST["delete_shop"])) {
    $shopname = $_SESSION['Shop.Name'];

    $query_shop = "
    DELETE FROM shop
    WHERE `Shop.Name`='$shopname';
    ";
    if (mysqli_query($conn, $query_shop)) {
        echo "Record deleted from [Shop] successfully.<br>";
        echo "<h1><a href='shoplist.php'>Go back</a></h1>";
    }
    else {
        echo "Error: " . $query_shop . "<br>" . mysqli_error($conn);
        echo "<h1><a href='shoplist.php'>Go back</a></h1>";
    }
    mysqli_close($conn);
}
?>