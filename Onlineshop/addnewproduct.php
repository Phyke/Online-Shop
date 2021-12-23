<?php 
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
else {
    include("database.php");
    $shopname = $_SESSION["Shop.Name"];
    $sql_oldpromotion = mysqli_query($conn,"SELECT * FROM promotion where `Shop.Name`='$shopname';");
    $oldpromotion_count = mysqli_num_rows($sql_oldpromotion);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new product</title>
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
            <button class="btn btn-outline-danger" onclick="document.location='productlist.php'">Discard Changes</button>
            <hr>
            <p class="h1 text-center">Add a new Product Form</p>
            <hr>
        </header>
        <p class="h2">Product Info</p>
        <form action="addnewproduct_p.php" method='post'>
            <div class="row mb-1">
                <label for="productname" class="col-sm-3 col-form-label">Product Name</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="productname" required>
                </div>
            </div>
            <div class="row mb-1">
                <label for="productdesc" class="col-sm-3 col-form-label">Product Description</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="productdesc" required>
                </div>
            </div>
            <div class="row mb-1">
                <label for="productprice" class="col-sm-3 col-form-label">Product Price</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="productprice" required>
                </div>
            </div>
            <div class="row mb-1">
                <label for="productstock" class="col-sm-3 col-form-label">Product Stock</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="productstock" required>
                </div>
            </div>
            <hr>
            <div class="row mb-1">
                <label for="whichpromo" class="col-sm-3 col-form-label">Use Old or New Promotion</label>
                <div class="col-auto">
                    <select name="whichpromo" class="form-select">
                        <option value='none'>None</option>
                        <option value='old'>Old Promotion</option>
                        <option value='new'>New Promotion</option>
                    </select>
                </div>
            </div>
            <hr>
            <div class="row mb-1">
                <label for="oldpromotion" class="col-sm-3 col-form-label">Use Old Promotion</label>
                <div class="col-auto">
                    <?php
                    if($oldpromotion_count==0){
                        echo "You have not created a promotion yet.";
                    }
                    else{
                        echo "<select name='oldpromotion' class='form-select'>";
                        for ($i=0 ; $i<$oldpromotion_count ; $i++){
                            $j = $i+1;
                            echo "<option value='$j'>Promotion $j</option>";
                        }
                        echo "</select>";
                    }
                    ?>
                </div>
            </div>
            <hr>
            <p>Use New Promotion</p>
            <p>(By creating a new promotion and apply on this product.)</p>
            <div class="row mb-1">
                <label for="newpromotion_type" class="col-sm-3 col-form-label">Promotion Type</label>
                <div class="col-auto">
                    <select name="newpromotion_type" class="form-select">
                        <option value='percent discount'>Percent Discount</option>
                        <option value='cost discount'>Cost Discount</option>
                    </select>
                </div>
            </div>
            <div class="row mb-1">
                <label for="newpromotion_value" class="col-sm-3 col-form-label">Promotion Value</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="newpromotion_value">
                </div>
            </div>
            <div class="row mb-1">
                <label for="newpromotion_expire" class="col-sm-3 col-form-label">Promotion Expire Date</label>
                <div class="col-auto">
                    <input type="date" class="form-control" name="newpromotion_expire">
                </div>
            </div>
            <div class="row mb-auto">
                <div class="col-auto">
                    <button type="submit" name='add_product' class="btn btn-primary">Add</button>
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