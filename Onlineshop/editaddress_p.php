<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
extract($_POST);
include("database.php");

if(isset($_POST["save_address"])) {
    $addressID = $_SESSION['Address.ID'];
    $addrt = mysqli_real_escape_string($conn, $addrt);
    $postal = mysqli_real_escape_string($conn, $postal);
    $addr = mysqli_real_escape_string($conn, $addr);

    $query_address = "
    UPDATE address
    SET `Address`='$addr', `Address.Type`='$addrt', `Postal.Code`='$postal'
    WHERE `Address.ID` = $addressID;
    ";
    if (mysqli_query($conn, $query_address)) {
        echo "Record Updated in [Address] successfully.<br>";
        echo "<h1><a href='account.php'>Go back</a></h1>";
    }
    else {
        echo "Error: " . $query_address . "<br>" . mysqli_error($conn);
        echo "<h1><a href='account.php'>Go back</a></h1>";
    }
    mysqli_close($conn);
}
?>