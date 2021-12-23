<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
else {
    include("database.php");
    $shopname = $_SESSION["Shop.Name"];

    $sql_product = mysqli_query($conn,"SELECT * FROM product where `Shop.Name`='$shopname';");
    $sql_allpromotion = mysqli_query($conn,"SELECT * FROM promotion where `Shop.Name`='$shopname';");

    $product_count = mysqli_num_rows($sql_product);
    $allpromotion_count = mysqli_num_rows($sql_allpromotion);

    $array_product = array();
    while($row_product = mysqli_fetch_assoc($sql_product)) {
        array_push($array_product,$row_product);
    }

    $array_allpromotion = array();
    while($row_allpromotion = mysqli_fetch_assoc($sql_allpromotion)){
        array_push($array_allpromotion,$row_allpromotion);
    }

    $targetproduct = $_POST["editproduct"] - 1;
    $_SESSION['Product.ID'] = $array_product[$targetproduct]['Product.ID'];
    $currentpromotionid = $array_product[$targetproduct]['Promotion.ID'];
    $x=0;
    while($x<$allpromotion_count){
        if($currentpromotionid == $array_allpromotion[$x]['Promotion.ID']){
            break;
        }
        $x++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit product</title>
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
            <p class="h1 text-center">Edit a Product Form</p>
            <hr>
        </header>
        <p class="h2">Product Info</p>
        <form action="editproduct_p.php" method='post'>
            <div class="row mb-1">
                <label for="productname" class="col-sm-3 col-form-label">Product Name</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="productname" required value="<?php echo $array_product[$targetproduct]['Product.Name'];?>">
                </div>
            </div>
            <div class="row mb-1">
                <label for="productdesc" class="col-sm-3 col-form-label">Product Description</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="productdesc" required value="<?php echo $array_product[$targetproduct]['Product.Description'];?>">
                </div>
            </div>
            <div class="row mb-1">
                <label for="productprice" class="col-sm-3 col-form-label">Product Price</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="productprice" required value="<?php echo $array_product[$targetproduct]['Product.Price'];?>">
                </div>
            </div>
            <div class="row mb-1">
                <label for="productstock" class="col-sm-3 col-form-label">Product Stock</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="productstock" required value="<?php echo $array_product[$targetproduct]['Product.Stock'];?>">
                </div>
            </div>
            <hr>
            <div class="row mb-1">
                <label for="choosepromotion" class="col-sm-3 col-form-label">Current Promotion</label>
                <div class="col-auto">
                    <?php
                    echo "<select name='choosepromotion'>";
                    if($currentpromotionid==''){
                        echo "<option selected='selected' value='-1'>None</option>";
                    }
                    else{
                        echo "<option value='-1'>None</option>";
                    }
                    for ($i=0 ; $i<$allpromotion_count ; $i++){
                        $j = $i+1;
                        if($i==$x){
                            echo "<option selected='selected' value='$j'>Promotion $j</option>";
                        }
                        else{
                            echo "<option value='$j'>Promotion $j</option>";
                        }
                    }
                    echo "</select>";
                    ?>
                </div>
            </div>
            <hr>
            <div class="row mb-auto">
                <div class="col-auto">
                    <button type="submit" name='save_product' class="btn btn-primary">Update</button>
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