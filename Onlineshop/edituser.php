<?php 
$dummy="dummy value";
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
else {
    include("database.php");
    $userid = $_SESSION["User.ID"];
    $sql_user = mysqli_query($conn,"SELECT * FROM users where `User.ID`='$userid';");
    $row_user = mysqli_fetch_array($sql_user);
    $current_fname = $row_user['User.First.Name'];
    $current_lname = $row_user['User.Last.Name'];
    $current_phone = $row_user['User.Phone'];
    $current_email = $row_user['User.Email'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user info</title>
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
            <button class="btn btn-secondary" onclick="document.location='homepage.php'">Back to Homepage</button>
            <button class="btn btn-outline-danger" onclick="document.location='account.php'">Discard Changes</button>
            <hr>
            <p class="h1 text-center">Edit User Info Form</p>
            <hr>
        </header>
        <form action="edituser_p.php" method='post'>
            <div class="row mb-1">
                <label for="fname" class="col-sm-3 col-form-label">First Name</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="fname" required value="<?php echo $current_fname;?>">
                </div>
            </div>
            <div class="row mb-1">
                <label for="lname" class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="lname" required value="<?php echo $current_lname;?>">
                </div>
            </div>
            <div class="row mb-1">
                <label for="phone" class="col-sm-3 col-form-label">Phone No.</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="phone" required value="<?php echo $current_phone;?>">
                </div>
            </div>
            <div class="row mb-1">
                <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                <div class="col-auto">
                    <input type="email" class="form-control" name="email" required value="<?php echo $current_email;?>">
                </div>
            </div>
            <div class="row mb-1">
                <label for="password" class="col-sm-3 col-form-label">New Password</label>
                <div class="col-auto">
                    <input type="password" class="form-control" name="password" required value="">
                </div>
            </div>
            <div class="row mb-auto">
                <div class="col-auto">
                    <button type="submit" name="save_user" class="btn btn-primary">Update</button>
                </div>
                <div class="col-auto">
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
        <hr>
    </div>
</body>
</html>