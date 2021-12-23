<?php 
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
else {
    include("database.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new promotion</title>
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
            <button class="btn btn-outline-danger" onclick="document.location='promotionlist.php'">Discard Changes</button>
            <hr>
            <p class="h1 text-center">Add a new Promotion Form</p>
            <hr>
        </header>
        <p class="h2">Promotion Info</p>
        <form action="addnewpromotion_p.php" method='post'>
            <div class="row mb-1">
                <label for="newpromotion_type" class="col-sm-3 col-form-label">Promotion Type</label>
                <div class="col-auto">
                    <select name="newpromotion_type" class="form-select" required>
                        <option value='percent discount'>Percent Discount</option>
                        <option value='cost discount'>Cost Discount</option>
                    </select>
                </div>
            </div>
            <div class="row mb-1">
                <label for="newpromotion_value" class="col-sm-3 col-form-label">Promotion Value</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="newpromotion_value" required>
                </div>
            </div>
            <div class="row mb-1">
                <label for="newpromotion_expire" class="col-sm-3 col-form-label">Promotion Expire Date</label>
                <div class="col-auto">
                    <input type="date" class="form-control" name="newpromotion_expire" required>
                </div>
            </div>
            <div class="row mb-auto">
                <div class="col-auto">
                    <button type="submit" name='add_promotion' class="btn btn-primary">Add</button>
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