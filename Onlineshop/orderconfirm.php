<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
else{
    include("database.php");
    $order_userid = $_SESSION['order_userid'];
    $order_shoptarget = $_SESSION['order_shoptarget'];
    $order_addressid = $_SESSION['order_addressid'];
    $order_paymentid = $_SESSION['order_paymentid'];
    $order_deliveryid = $_SESSION['order_deliveryid'];
    $order_couponcode = $_SESSION['order_couponcode'];
    $order_cartproductid = $_SESSION['order_cartproductid'];
    $order_cartbuyamount = $_SESSION['order_cartbuyamount'];
    
    $row_address = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM address WHERE `Address.ID`='$order_addressid';"));
    $row_payment = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM payment WHERE `Payment.ID`='$order_paymentid';"));
    $row_delivery = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM delivery WHERE `Delivery.Method.ID`='$order_deliveryid';"));
    $row_couponcode = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM coupon WHERE `Coupon.Code`='$order_couponcode';"));

    $cartsize = count($order_cartproductid);
    $array_cart_productinfo = array();
    for($i=0;$i<$cartsize;$i++){
        $productid = $order_cartproductid[$i];
        $sql_cart_productinfo = mysqli_query($conn, "SELECT * FROM product WHERE `Product.ID`='$productid';");
        while($row_cart_productinfo = mysqli_fetch_array($sql_cart_productinfo)){
            array_push($array_cart_productinfo,$row_cart_productinfo);
        }
    }
    #echo "<pre>";
    #print_r($array_cart_productinfo);
    #echo "</pre>";

    $price_after_promo = array();
    for($i=0;$i<$cartsize;$i++){
        if(isset($array_cart_productinfo[$i]['Promotion.ID'])){ #Have Promo
            $promoid = $array_cart_productinfo[$i]['Promotion.ID'];
            $sql_cart_promoinfo = mysqli_query($conn, "SELECT * FROM promotion WHERE `Promotion.ID`='$promoid';");
            $row_cart_promoinfo = mysqli_fetch_array($sql_cart_promoinfo);
            
            if($row_cart_promoinfo['Promotion.Type']=='percent discount'){
                $finalprice = ceil($array_cart_productinfo[$i]['Product.Price'] * (100 - $row_cart_promoinfo['Promotion.Value']) / 100);
                array_push($price_after_promo,$finalprice);
            }
            else if($row_cart_promoinfo['Promotion.Type']=='cost discount'){
                $finalprice = $array_cart_productinfo[$i]['Product.Price'] - $row_cart_promoinfo['Promotion.Value'];
                array_push($price_after_promo,$finalprice);
            }
        }
        else{ #No Promo
            array_push($price_after_promo,$array_cart_productinfo[$i]['Product.Price']);
        }
    }
    
    $product_totalprice = array();
    for($i=0;$i<$cartsize;$i++){
        array_push($product_totalprice,$price_after_promo[$i]*$order_cartbuyamount[$i]);
    }

    $total_price = array_sum($product_totalprice);
    if($row_couponcode==''){ #No Coupon
        $total_price_coupon = $total_price;
    }
    else{
        if($row_couponcode['Coupon.Type'] == 'percent discount'){
            $total_price_coupon = ceil($total_price * (100-$row_couponcode['Coupon.Value']) / 100);
        }
        elseif($row_couponcode['Coupon.Type'] == 'cost discount'){
            $total_price_coupon = $total_price - $row_couponcode['Coupon.Value'];
        }
    }
    $total_price_coupon_delivery = $total_price_coupon + $row_delivery['Delivery.Fee'];
    $rewardgain = ceil($total_price_coupon_delivery / 2);

    #echo "<pre>";
    #print_r($row_address);
    #print_r($row_payment);
    #print_r($row_delivery);
    #print_r($row_couponcode);
    #print_r($array_cart_productinfo);
    #print_r($price_after_promo);
    #echo "</pre>";
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order confirmation</title>
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
          <button class="btn btn-outline-danger" onclick="document.location='shoppage.php?shoptarget=<?php echo $order_shoptarget;?>'">Back to Shop page</button>
          <hr>
          <p class="h1 text-center">Order Confirmation</p>
          <hr>
        </header>
        <p class="h3">Please check your information</p>
        <hr>
        <p class="h4">Shop Name: <?php echo $order_shoptarget;?></p>
        <p class="h4">Your Cart:</p>
        <table class="table table-hover table-striped table-bordered align-middle" style="width: auto;">
            <thead class="table-dark">
                <tr>
                <th scope="col">Number</th>
                <th scope="col">Product Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price per 1ea</th>
                <th scope="col">Price After Promo</th>
                <th scope="col">Buy Amount</th>
                <th scope="col">Total Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for($i=0;$i<$cartsize;$i++){
                    $num=$i+1;
                    echo '<tr>';
                    echo '<td>'.$num.'</td>';
                    echo '<td>'.$array_cart_productinfo[$i]['Product.Name'].'</td>';
                    echo '<td>'.$array_cart_productinfo[$i]['Product.Description'].'</td>';
                    echo '<td>'.$array_cart_productinfo[$i]['Product.Price'].'</td>';
                    echo '<td>'.$price_after_promo[$i].'</td>';
                    echo '<td>'.$order_cartbuyamount[$i].'</td>';
                    echo '<td>'.$product_totalprice[$i].'</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <hr>
        <p class="h4">Your Address:</p>
        Address Type: <?php echo $row_address['Address.Type'];?><br>
        Address Detail: <?php echo $row_address['Address'].' '.$row_address['Postal.Code'];?>
        <hr>
        <p class="h4">Your Payment Method:</p>
        Payment Method: <?php echo $row_payment['Payment.Partner'].' - '.$row_payment['Payment.Method'];?><br>
        Reference No. : <?php echo $row_payment['Reference.No'];?><br>
        <hr>
        <p class="h4">Your Delivery Method:</p>
        Delivery Method: <?php echo $row_delivery['Delivery.Fee'].' บาท - '.$row_delivery['Delivery.Detail'];?><br>
        <hr>
        <p class="h4">Your Coupon:</p>
        Coupon Code: <?php
        if ($row_couponcode==''){
            echo "None<br>";
        }
        else{
            echo $row_couponcode['Coupon.Code'].' - '.$row_couponcode['Coupon.Description'];
        }
        ?>
        <hr>
        <p class="h4">Price Summary:</p>
        <table class="table table-hover table-striped table-bordered align-middle" style="width: auto;">
            <thead class="table-dark">
            <tr>
                <th scope="col">Total Product Price</th>
                <th scope="col">After Coupon</th>
                <th scope="col">After Delivery Fee (Final Price)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo $total_price;?> บาท</td>
                <td><?php echo $total_price_coupon;?> บาท</td>
                <td><?php echo $total_price_coupon_delivery;?> บาท</td>
            </tr>
            </tbody>
        </table>
        <hr>
        <form method = "post">
            <button type="submit" name='orderconfirmsubmit' class="btn btn-success">Confirm Order</button>
        </form>
    </div>
</body>
</html>

<?php
if(isset($_POST['orderconfirmsubmit'])){

    #========== Update user's reward point in users table ==========
    $query_update_userpoint = "
    UPDATE users
    SET `Reward.Point.Own`= `Reward.Point.Own` + '$rewardgain'
    WHERE `User.ID`='$order_userid';";

    if (mysqli_query($conn, $query_update_userpoint)) {
        echo "Record Updated in [users] successfully.<br>";
    }
    else {
        echo "Error: " . $query_update_userpoint . "<br>" . mysqli_error($conn);
    }
    
    #========== Add a record to orderdetail table ==========
    if($order_couponcode=='none'){
        $query_orderdetail = "
        INSERT INTO orderdetail
        VALUES (NULL,NULL,'$order_userid','$order_addressid','$order_shoptarget','$order_paymentid','$order_deliveryid',NULL);";
    }
    else{
        $query_orderdetail = "
        INSERT INTO orderdetail
        VALUES (NULL,NULL,'$order_userid','$order_addressid','$order_shoptarget','$order_paymentid','$order_deliveryid','$order_couponcode');";
    }

    if (mysqli_query($conn, $query_orderdetail)) {
        $last_orderid = mysqli_insert_id($conn);
        echo "Record Added to [orderdetail] successfully.<br>";
    }
    else {
        echo "Error: " . $query_orderdetail . "<br>" . mysqli_error($conn);
    }

    #========== Update coupon stock in coupon table ==========
    if($order_couponcode!='none'){
        $query_coupon ="
        UPDATE coupon
        SET `Coupon.Usage` = `Coupon.Usage` - 1
        WHERE `User.ID` = '$order_userid' AND `Coupon.Code` = '$order_couponcode';";
        if (mysqli_query($conn, $query_coupon)) {
            echo "Record Updated in [coupon] successfully.<br>";
        }
        else {
            echo "Error: " . $query_coupon . "<br>" . mysqli_error($conn);
        }
    }

    #========== Add new records to orderproduct and update stock in product ==========
    for($i=0;$i<$cartsize;$i++){
        $insert_productid = $order_cartproductid[$i];
        $insert_amount = $order_cartbuyamount[$i];

        $query_orderproduct ="
        INSERT INTO orderproduct
        VALUES ('$last_orderid','$insert_productid','$insert_amount');";
        if (mysqli_query($conn, $query_orderproduct)) {
            echo "Record Added in [orderproduct] successfully.<br>";
        }
        else {
            echo "Error: " . $query_orderproduct . "<br>" . mysqli_error($conn);
        }

        $query_update_product_stock ="
        UPDATE product
        SET `Product.Stock` = `Product.Stock` - '$insert_amount'
        WHERE `Product.ID` = '$insert_productid';";
        if (mysqli_query($conn, $query_update_product_stock)) {
            echo "Record Updated in [product] successfully.<br>";
        }
        else {
            echo "Error: " . $query_update_product_stock . "<br>" . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
    echo "<a href='homepage.php'>Back to Homepage</a>";
}
?>