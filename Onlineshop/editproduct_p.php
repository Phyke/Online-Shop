<?php 
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
else {
    include("database.php");
    extract($_POST);
    $shopname = $_SESSION['Shop.Name'];
    $productid = $_SESSION['Product.ID'];
    $sql_allpromotion = mysqli_query($conn, "SELECT * FROM promotion WHERE `Shop.Name`='$shopname';");
    $allpromotion_count = mysqli_num_rows($sql_allpromotion);
    $array_allpromotion = array();
    while($row_allpromotion = mysqli_fetch_assoc($sql_allpromotion)){
        array_push($array_allpromotion,$row_allpromotion);
    }

    if(isset($_POST["save_product"])){
        $productname = mysqli_real_escape_string($conn, $productname);
        $productdesc = mysqli_real_escape_string($conn, $productdesc);
        $productprice = mysqli_real_escape_string($conn, $productprice);
        $productstock = mysqli_real_escape_string($conn, $productstock);

        if($choosepromotion == '-1' || $choosepromotion == ''){
            $query_product = "
            UPDATE product
            SET `Product.Name`='$productname',`Product.Description`='$productdesc',`Product.Price`='$productprice',`Product.Stock`='$productstock',`Promotion.ID`=NULL
            WHERE `Product.ID`='$productid';
            ";
        }
        else{
            $newpromoid = $array_allpromotion[$choosepromotion-1]['Promotion.ID'];
            $query_product = "
            UPDATE product
            SET `Product.Name`='$productname',`Product.Description`='$productdesc',`Product.Price`='$productprice',`Product.Stock`='$productstock',`Promotion.ID`='$newpromoid'
            WHERE `Product.ID`='$productid';
            ";
        }

        
        if (mysqli_query($conn, $query_product)) {
            echo "Update record in [Product] successfully.<br>";
            echo "<h1><a href='productlist.php'>Go back</a></h1>";
        }
        else {
            echo "Error: " . $query_product . "<br>" . mysqli_error($conn);
            echo "<h1><a href='productlist.php'>Go back</a></h1>";
        }
    }
}