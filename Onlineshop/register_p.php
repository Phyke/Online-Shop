<?php
extract($_POST);
include("database.php");

$email = mysqli_real_escape_string($conn, $email);
$query_check = "SELECT * FROM users WHERE `User.Email`='$email';";
$sql=mysqli_query($conn, $query_check);
if(mysqli_num_rows($sql)>0) {
    echo "<h1>Email is Already Existed!<br>";
    echo "<a href='login.php'>Go back</a></h1>";
	exit;
}
else if(isset($_POST["save_register"])) {
    $fname = mysqli_real_escape_string($conn, $fname);
    $lname = mysqli_real_escape_string($conn, $lname);
    $phone = mysqli_real_escape_string($conn, $phone);
    $password = mysqli_real_escape_string($conn, $password);
    $addrt = mysqli_real_escape_string($conn, $addrt);
    $postal = mysqli_real_escape_string($conn, $postal);
    $addr = mysqli_real_escape_string($conn, $addr);
    $pmethod = mysqli_real_escape_string($conn, $pmethod);
    $partner = mysqli_real_escape_string($conn, $partner);
    $refno = mysqli_real_escape_string($conn, $refno);

    $query_users = "
    INSERT INTO users
    VALUES (NULL,'$fname','$lname','$phone','$email','$password',NULL,0);";
    if (mysqli_query($conn, $query_users)) {
        $last_userid = mysqli_insert_id($conn);
        echo "New record added to [Users] successfully. Last inserted ID is: ".$last_userid ."<br>";
    }
    else {
        echo "Error: " . $query_users . "<br>" . mysqli_error($conn);
    }

    $query_address = "
    INSERT INTO address
    VALUES (NULL,'$last_userid','$addr','$addrt','$postal');";
    if (mysqli_query($conn, $query_address)) {
        echo "New record added to [Address] and successfully.<br>";
    }
    else {
        echo "Error: " . $query_address . "<br>" . mysqli_error($conn);
    }
    
    $query_payment = "
    INSERT INTO payment
    VALUES (NULL,'$last_userid','$pmethod','$partner','$refno');";
    if (mysqli_query($conn, $query_payment)) {
        echo "New record added to [Payment] and successfully.<br>";
    }
    else {
        echo "Error: " . $query_payment . "<br>" . mysqli_error($conn);
    }
    echo "<h1><a href='login.php'>Go Back</a></h1>";
    mysqli_close($conn);
}
?>