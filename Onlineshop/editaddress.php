<?php 
$dummy="dummy value";
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
else {
    include("database.php");
    $userid = $_SESSION["User.ID"];
    $sql_address = mysqli_query($conn,"SELECT * FROM address where `User.ID`='$userid';");
    $i = 0;
    while($i < $_POST['chooseaddress']){
    $row_address = mysqli_fetch_array($sql_address);
    $_SESSION['Address.ID'] = $row_address['Address.ID'];
    $current_address = $row_address['Address'];
    $current_addresstype = $row_address['Address.Type'];
    $current_postal = $row_address['Postal.Code'];
    $i++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit address</title>
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
            <p class="h1 text-center">Edit Address Info Form</p>
            <hr>
        </header>
        <p class="h2">Address</p>
        <form action="editaddress_p.php" method='post'>
            <div class="row mb-1">
                <label for="addrt" class="col-sm-3 col-form-label">Address Type</label>
                <div class="col-auto">
                        <select name="addrt" class="form-select" required>
                        <option <?php if($current_addresstype=='House') {echo "selected='selected'";}?> value='House'>House</option>
                        <option <?php if($current_addresstype=='Condo') {echo "selected='selected'";}?> value='Condo'>Condo</option>
                    </select>
                </div>
            </div>
            <div class="row mb-1">
                <label for="postal" class="col-sm-3 col-form-label">Postal Code</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="postal" required value="<?php echo $current_postal;?>">
                </div>
            </div>
            <div class="row mb-1">
                <label for="addr" class="col-sm-3 col-form-label">Address Detail</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="addr" required value="<?php echo $current_address;?>">
                </div>
            </div>
            <div class="row mb-auto">
                <div class="col-auto">
                    <button type="submit" name='save_address' class="btn btn-primary">Update</button>
                </div>
                <div class="col-auto">
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
        <hr>
        <form action='deleteaddress.php' method='post'>
            <button type="submit" name='delete_address' class="btn btn-danger">Delete this Address</button>
        </form>
        <hr>
    </div>
</body>
</html>