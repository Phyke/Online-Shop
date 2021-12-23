<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
else {
    include("database.php");
    $userid = $_SESSION["User.ID"];
    $sql = mysqli_query($conn,"SELECT * FROM users where `User.ID`='$userid';");
	$row = mysqli_fetch_array($sql);
    $userfirstname = $row['User.First.Name'];
    $userlastname = $row['User.Last.Name'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Homepage</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <style>
        body{
            background-color:lightblue;
        }
    </style>
</head>
<body>
    <div class="container bg-light">
        <header>
          <button class="btn btn-secondary" onclick="document.location='index.php'">Back to Index</button>
          <hr>
          <p class="h1 text-center">Homepage</p>
          <hr>
        </header>
        
        <button class="btn btn-primary" onclick="document.location='account.php'">My account</button>
        <button class="btn btn-primary" onclick="document.location='shoplist.php'">My shop</button>
        <button class="btn btn-primary" onclick="document.location='rewardcoupon.php'">Reward & Coupon</button>
        <button class="btn btn-primary" onclick="document.location='search.php'">Go Shopping</button>
        <button class="btn btn-danger" onclick="document.location='logout.php'">Logout</button>
        <hr>
        <p class="h2">You are logged in as "<?php echo $userfirstname.' '.$userlastname;?>"</p>
    </div>
</body>
</html>