<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
extract($_POST);
include("database.php");

if(isset($_POST["save_user"])) {
    $userid = $_SESSION['User.ID'];
    $fname = mysqli_real_escape_string($conn, $fname);
    $lname = mysqli_real_escape_string($conn, $lname);
    $phone = mysqli_real_escape_string($conn, $phone);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $query_user = "
    UPDATE users
    SET `User.First.Name`='$fname', `User.Last.Name`='$lname', `User.Phone`='$phone', `User.Email`='$email', `User.Password`='$password'
    WHERE `User.ID` = $userid;
    ";
    if (mysqli_query($conn, $query_user)) {
        echo "Record Updated in [Users] successfully.<br>";
        echo "<h1><a href='account.php'>Go back</a></h1>";
    }
    else {
        echo "Error: " . $query_user . "<br>" . mysqli_error($conn);
        echo "<h1><a href='account.php'>Go back</a></h1>";
    }
    mysqli_close($conn);
}
?>