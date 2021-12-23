<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
extract($_POST);
include("database.php");

if(isset($_POST["deleteproductsubmit"])) {
    $shopname = $_SESSION["Shop.Name"];
    $sql_product = mysqli_query($conn,"SELECT * FROM product where `Shop.Name`='$shopname';");

    $array_product = array();
    while($row_product = mysqli_fetch_assoc($sql_product)) {
        array_push($array_product,$row_product);
    }
    $targetproduct = $_POST["deleteproduct"] - 1;
    $deleteproductid = $array_product[$targetproduct]['Product.ID'];

    $query_product = "
    DELETE FROM product
    WHERE `Product.ID` = $deleteproductid;
    ";
    if (mysqli_query($conn, $query_product)) {
        echo "Record Deleted from [Product] successfully.<br>";
        echo "<h1><a href='productlist.php'>Go back</a></h1>";
    }
    else {
        echo "Error: " . $query_product . "<br>" . mysqli_error($conn);
        echo "<h1><a href='productlist.php'>Go back</a></h1>";
    }
    mysqli_close($conn);
}
?>


