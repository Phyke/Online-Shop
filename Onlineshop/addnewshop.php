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
    <title>Add new shop</title>
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
            <button class="btn btn-outline-danger" onclick="document.location='shoplist.php'">Discard Changes</button>
            <hr>
            <p class="h1 text-center">Add New Shop Form</p>
            <hr>
        </header>
        <p class="h2">Shop Info</p>
        <form action="addnewshop_p.php" method='post'>
            <div class="row mb-1">
                <label for="shopname" class="col-sm-3 col-form-label">Shop Name</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="shopname" required>
                </div>
            </div>
            <div class="row mb-1">
                <label for="shoptype" class="col-sm-3 col-form-label">Shop Type</label>
                <div class="col-auto">
                    <select name="shoptype" class="form-select" required>
                        <option value='Official'>Official</option>
                        <option value='มีหน้าร้าน'>มีหน้าร้าน</option>
                        <option value='ไม่มีหน้าร้าน'>ไม่มีหน้าร้าน</option>
                    </select>
                </div>
            </div>
            <div class="row mb-1">
                <label for="shopaddr" class="col-sm-3 col-form-label">Shop Address</label>
                <div class="col-3">
                    <textarea class="form-control" name="shopaddr" rows="3" required></textarea>
                </div>
            </div>
            <div class="row mb-1">
                <label for="bankcode" class="col-sm-3 col-form-label">Bank Code</label>
                <div class="col-auto">
                    <select name="bankcode" class="form-select" required>
                        <option value='SCB'>SCB</option>
                        <option value='BBL'>BBL</option>
                        <option value='KBANK'>KBANK</option>
                        <option value='UOB'>UOB</option>
                        <option value='BAY'>BAY</option>
                        <option value='KTB'>KTB</option>
                        <option value='TBANK'>TBANK</option>
                        <option value='LH'>LH</option>
                    </select>
                </div>
            </div>
            <div class="row mb-1">
                <label for="banknumber" class="col-sm-3 col-form-label">Bank Account Number</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="banknumber" required>
                </div>
            </div>
            <div class="row mb-auto">
                <div class="col-auto">
                    <button type="submit" name='add_shop' class="btn btn-primary">Add</button>
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