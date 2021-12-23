<?php 
$dummy="dummy value";
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new address</title>
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
            <p class="h1 text-center">Add Address Info Form</p>
            <hr>
        </header>
        <p class="h2">Address</p>
        <form action="addnewaddress_p.php" method='post'>
            <div class="row mb-1">
                <label for="addrt" class="col-sm-3 col-form-label">Address Type</label>
                <div class="col-auto">
                    <select name="addrt" class="form-select" required>
                        <option value='House'>House</option>
                        <option value='Condo'>Condo</option>
                    </select>
                </div>
            </div>
            <div class="row mb-1">
                <label for="postal" class="col-sm-3 col-form-label">Postal Code</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="postal" required value="">
                </div>
            </div>
            <div class="row mb-1">
                <label for="addr" class="col-sm-3 col-form-label">Address Detail</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="addr" required value="">
                </div>
            </div>
            <div class="row mb-auto">
                <div class="col-auto">
                    <button type="submit" name='add_address' class="btn btn-primary">Add</button>
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