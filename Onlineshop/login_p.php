<?php
session_start();
if(isset($_POST["loginbutton"]))
{
    extract($_POST);
    include "database.php";
    $query_login = "SELECT * FROM users WHERE `User.Email`='$email' AND `User.Password`='$password';";
    $sql = mysqli_query($conn,$query_login);
    $row = mysqli_fetch_array($sql);
    if(is_array($row))
    {
        $_SESSION["User.ID"] = $row['User.ID'];
        header("Location: homepage.php"); 
    }
    else
    {
        echo "<h1>Invalid Email ID/Password<br>";
        echo "<a href='login.php'>Go back</a></h1>";
    }
}
?>