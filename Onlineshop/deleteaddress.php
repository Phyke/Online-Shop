<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
include("database.php");

if(isset($_POST["delete_address"])) {
    $addressid = $_SESSION['Address.ID'];

    $query_address = "
    DELETE FROM address
    WHERE `Address.ID`=$addressid;
    ";
    if (mysqli_query($conn, $query_address)) {
        echo "Record deleted from [Address] successfully.<br>";
        echo "<h1><a href='account.php'>Go back</a></h1>";
    }
    else {
        echo "Error: " . $query_address . "<br>" . mysqli_error($conn);
        echo "<h1><a href='account.php'>Go back</a></h1>";
    }
    mysqli_close($conn);
}
?>