<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
else {
    include("database.php");
    $shopname = $_SESSION["Shop.Name"];
    $sql_product = mysqli_query($conn,"SELECT * FROM product where `Shop.Name`='$shopname';");
    $product_count = mysqli_num_rows($sql_product);
    $array_product = array();
    while($row_product = mysqli_fetch_assoc($sql_product)) {
        array_push($array_product,$row_product);
    }
    #echo "<pre>";
    #print_r($array_product);
    #echo "</pre>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product list</title>
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
          <button class="btn btn-outline-danger" onclick="document.location='shoplist.php'">Back to Shop list</button>
          <hr>
          <p class="h1 text-center">My Product list</p>
          <hr>
        </header>
        <p class="h2">Shop Name : <?php echo $shopname?></p>
        <hr>
        <button class="btn btn-primary" onclick="document.location='addnewproduct.php'">Add new Product</button>
        <form action="editproduct.php" method="post">
        <label for="editproduct">Choose a Product to edit:</label>
            <?php
            if($product_count==0){
                echo "You have not created a product yet.";
            }
            else{
                echo "<select name='editproduct'>";
                for ($i=0 ; $i<$product_count ; $i++){
                    $j = $i+1;
                    echo "<option value='$j'>Product $j</option>";
                }
                echo "</select>";
                echo '<button type="submit" name="editproductsubmit" class="btn btn-primary">Edit</button>';
            }
            ?>
        </form>
        <form action="deleteproduct.php" method="post">
        <label for="deleteproduct">Choose a Product to delete:</label>
            <?php
            if($product_count==0){
                echo "You have not created a product yet.";
            }
            else{
                echo "<select name='deleteproduct'>";
                for ($i=0 ; $i<$product_count ; $i++){
                    $j = $i+1;
                    echo "<option value='$j'>Product $j</option>";
                }
                echo "</select>";
                echo '<button type="submit" name="deleteproductsubmit" class="btn btn-danger">Delete</button>';
            }
            ?>
        </form>
        <hr>
        <p class="h2">Your product list:</p>
        <table class="table table-hover table-striped table-bordered align-middle" style="width: auto;">
            <thead class="table-dark">
                <tr>
                <th scope="col">Number</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Description</th>
                <th scope="col">Product Price</th>
                <th scope="col">Product Stock</th>
                <th scope="col">Promotion Status</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0;$i<$product_count;$i++){
                    $num=$i+1;
                    echo '<tr>';
                    echo '<td>'.$num.'</td>';
                    echo '<td>'.$array_product[$i]['Product.Name'].'</td>';
                    echo '<td>'.$array_product[$i]['Product.Description'].'</td>';
                    echo '<td>'.$array_product[$i]['Product.Price'].'</td>';
                    echo '<td>'.$array_product[$i]['Product.Stock'].'</td>';
                    if($array_product[$i]['Promotion.ID']!=''){
                        echo '<td>Have Promo</td>';
                    }
                    else{
                        echo '<td>NO</td>';
                    }
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>