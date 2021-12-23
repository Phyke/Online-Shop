<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
else{
    extract($_POST);
    include("database.php");
    $shopname = $_SESSION["Shop.Name"];
    $sql_oldpromotion = mysqli_query($conn,"SELECT * FROM promotion where `Shop.Name`='$shopname';");
    $oldpromotion_count = mysqli_num_rows($sql_oldpromotion);
    

    if(isset($_POST["add_product"])) {
        if($whichpromo=='old' && $oldpromotion_count==0){
            echo "<h1>You want to use 'Old Promotion' but you don't have any old promotion.<br>";
            echo "<a href='addnewproduct.php'>Go Back</a>";
        }
        elseif($whichpromo=='none'){
            $productname = mysqli_real_escape_string($conn, $productname);
            $productdesc = mysqli_real_escape_string($conn, $productdesc);
            $productprice = mysqli_real_escape_string($conn, $productprice);
            $productstock = mysqli_real_escape_string($conn, $productstock);

            $query_product_nopromo = "
            INSERT INTO product
            VALUES (NULL,'$shopname','$productname','$productdesc','$productprice','$productstock',NULL,NULL);
            ";
            if (mysqli_query($conn, $query_product_nopromo)) {
                echo "New record added in [Product] successfully.<br>";
                echo "<h1><a href='productlist.php'>Go back</a></h1>";
            }
            else {
                echo "Error: " . $query_product_nopromo . "<br>" . mysqli_error($conn);
                echo "<h1><a href='productlist.php'>Go back</a></h1>";
            }
        }
        elseif($whichpromo=='old' && $oldpromotion_count!=0){
            $productname = mysqli_real_escape_string($conn, $productname);
            $productdesc = mysqli_real_escape_string($conn, $productdesc);
            $productprice = mysqli_real_escape_string($conn, $productprice);
            $productstock = mysqli_real_escape_string($conn, $productstock);
            $array_oldpromotion = array();
            while($row_oldpromotion = mysqli_fetch_assoc($sql_oldpromotion)){
                array_push($array_oldpromotion,$row_oldpromotion);
            }
            $oldpromotion_id = $array_oldpromotion[$oldpromotion-1]['Promotion.ID'];

            $query_product_oldpromo = "
            INSERT INTO product
            VALUES (NULL,'$shopname','$productname','$productdesc','$productprice','$productstock',NULL,$oldpromotion_id);
            ";
            if (mysqli_query($conn, $query_product_oldpromo)) {
                echo "New record added in [Product] successfully.<br>";
                echo "<h1><a href='productlist.php'>Go back</a></h1>";
            }
            else {
                echo "Error: " . $query_product_oldpromo . "<br>" . mysqli_error($conn);
                echo "<h1><a href='productlist.php'>Go back</a></h1>";
            }
        }
        elseif($newpromotion_value == '' || $newpromotion_expire == ''){
            echo "<h1>Some value is missing.<br>";
            echo "<a href='addnewproduct.php'>Go Back</a>";
        }
        elseif($whichpromo=='new' && $newpromotion_value != '' && $newpromotion_expire != ''){
            $productname = mysqli_real_escape_string($conn, $productname);
            $productdesc = mysqli_real_escape_string($conn, $productdesc);
            $productprice = mysqli_real_escape_string($conn, $productprice);
            $productstock = mysqli_real_escape_string($conn, $productstock);
            
            $promotiontype = mysqli_real_escape_string($conn, $newpromotion_type);
            $promotionvalue = mysqli_real_escape_string($conn, $newpromotion_value);
            $promotionexpire = date("Y-m-d H:i:s",strtotime($newpromotion_expire));

            $query_newpromo = "
            INSERT INTO promotion
            VALUES (NULL,'$shopname','$promotionexpire','$promotiontype','$promotionvalue');
            ";
            if (mysqli_query($conn, $query_newpromo)) {
                $last_promoid = mysqli_insert_id($conn);
                echo "New record added in [Promotion] successfully.<br>";
                echo "<h1><a href='productlist.php'>Go back</a></h1>";
            }
            else {
                echo "Error: " . $query_newpromo . "<br>" . mysqli_error($conn);
                echo "<h1><a href='productlist.php'>Go back</a></h1>";
            }

            $query_product_newpromo = "
            INSERT INTO product
            VALUES (NULL,'$shopname','$productname','$productdesc','$productprice','$productstock',NULL,$last_promoid);
            ";
            if (mysqli_query($conn, $query_product_newpromo)) {
                echo "New record added in [Product] successfully.<br>";
                echo "<h1><a href='productlist.php'>Go back</a></h1>";
            }
            else {
                echo "Error: " . $query_product_newpromo . "<br>" . mysqli_error($conn);
                echo "<h1><a href='productlist.php'>Go back</a></h1>";
            }
        }
    }
    mysqli_close($conn);
}
?>