<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
else {
    include("database.php");
    $userid = $_SESSION['User.ID'];
    $shoptarget = $_GET["shoptarget"];

    $sql_product = mysqli_query($conn,"SELECT * FROM product where `Shop.Name`='$shoptarget';");
    $sql_address = mysqli_query($conn,"SELECT * FROM address WHERE `User.ID`='$userid';");
    $sql_payment = mysqli_query($conn,"SELECT * FROM payment WHERE `User.ID`='$userid';");
    $sql_delivery = mysqli_query($conn,"SELECT * FROM delivery");
    $sql_coupon = mysqli_query($conn,"SELECT * FROM coupon WHERE `User.ID`='$userid';");

    $count_product = mysqli_num_rows($sql_product);
    $count_address = mysqli_num_rows($sql_address);
    $count_payment = mysqli_num_rows($sql_payment);
    $count_delivery = mysqli_num_rows($sql_delivery);
    $count_coupon = mysqli_num_rows($sql_coupon);

    $array_product = array();
    $array_address = array();
    $array_payment = array();
    $array_delivery = array();
    $array_coupon = array();

    while($row_product = mysqli_fetch_assoc($sql_product)) {
        array_push($array_product,$row_product);
    }
    while($row_address = mysqli_fetch_assoc($sql_address)) {
        array_push($array_address,$row_address);
    }
    while($row_payment = mysqli_fetch_assoc($sql_payment)) {
        array_push($array_payment,$row_payment);
    }
    while($row_delivery = mysqli_fetch_assoc($sql_delivery)) {
        array_push($array_delivery,$row_delivery);
    }
    while($row_coupon = mysqli_fetch_assoc($sql_coupon)) {
        array_push($array_coupon,$row_coupon);
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
    <title>Shop Page</title>
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
          <button class="btn btn-outline-danger" onclick="document.location='search.php'">Back to Search</button>
          <hr>
          <p class="h1 text-center">Shop Name : <?php echo $shoptarget?></p>
          <hr>
        </header>
        <p class="h2">Choose anything you want:</p>
        <form method='post'>
        <table class="table table-hover table-striped table-bordered align-middle" style="width: auto;">
            <thead class="table-dark">
                <tr>
                <th scope="col">Number</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Description</th>
                <th scope="col">Product Price</th>
                <th scope="col">Product Stock</th>
                <th scope="col">Promotion Status</th>
                <th scope="col">Buy?</th>
                <th scope="col md-1">Amount?</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0;$i<$count_product;$i++){
                    $num=$i+1;
                    if($array_product[$i]['Product.Stock']>0){
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
                        echo '<td><input class="form-check-input" type="checkbox" name="cartindex[]" value="'.$i.'"></td>';
                        echo '<td><input class="form-control" type="number" name="amount[]" min="0" max="'.$array_product[$i]['Product.Stock'].'" value="0" style="width: 70px;"></td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
        <div class="row mb-1">
            <label for="useaddress" class="col-sm-2 col-form-label">Choose an Address:</label>
            <div class="col-auto">
                <?php
                if($count_address==0){
                    echo "You don't have any address.";
                }
                else{
                    echo '<select class="form-select" name="useaddress">';
                    for ($i=0 ; $i<$count_address ; $i++){
                        echo "<option value=".$array_address[$i]['Address.ID'].">".$array_address[$i]['Address']." ".$array_address[$i]['Postal.Code']."</option>";
                    }
                    echo '</select>';
                }
                ?>
            </div>
        </div>
        <div class="row mb-1">
            <label for="usepayment" class="col-sm-2 col-form-label">Choose a Payment Method:</label>
            <div class="col-auto">
                <?php
                if($count_payment==0){
                    echo "You don't have any payment method.";
                }
                else{
                    echo '<select class="form-select" name="usepayment">';
                    for ($i=0 ; $i<$count_payment ; $i++){
                        echo "<option value=".$array_payment[$i]['Payment.ID'].">".$array_payment[$i]['Payment.Partner']." - ".$array_payment[$i]['Payment.Method']."</option>";
                    }
                    echo '</select>';
                }
                ?>
            </div>
        </div>
        <div class="row mb-1">
            <label for="usedelivery" class="col-sm-2 col-form-label">Choose a Delivery Method:</label>
            <div class="col-auto">
                <?php
                echo '<select class="form-select" name="usedelivery">';
                for ($i=0 ; $i<$count_delivery ; $i++){
                    echo "<option value=".$array_delivery[$i]['Delivery.Method.ID'].">ค่าส่ง ".$array_delivery[$i]['Delivery.Fee']." บาท - ".$array_delivery[$i]['Delivery.Detail']."</option>";
                }
                echo '</select>';
                ?>
            </div>
        </div>
        <div class="row mb-1">
            <label for="usecoupon" class="col-sm-2 col-form-label">Choose a Coupon:</label>
            <div class="col-auto">
                <?php
                if($count_coupon==0){
                    echo "You don't have any coupon.";
                }
                else{
                    echo '<select class="form-select" name="usecoupon">';
                    echo '<option value="none">None</option>';
                    for ($i=0 ; $i<$count_coupon ; $i++){
                        echo "<option value=".$array_coupon[$i]['Coupon.Code'].">".$array_coupon[$i]['Coupon.Code']." - ".$array_coupon[$i]['Coupon.Description']."</option>";
                    }
                    echo '</select>';
                }
                ?>
                
            </div>
            <p class='text-danger'>***ถ้าใช้ Coupon ที่ลดราคา (บาท) มากกว่าราคาสินค้าทั้งหมด คุณจะไม่ได้รับเงินส่วนต่างคืน</p>
        </div>
        <hr>
        <div class="row mb-1">
            <div class="col-auto">
                <button type="submit" name='ordersubmit' class="btn btn-warning">Check if everything is correct</button>
            </div>
        </div>
        </form>
        <hr>
        <?php
        if(isset($_POST['ordersubmit'])){
            $errorcode = 0;
            if(!isset($_POST['cartindex'])) $errorcode = 1; #No checkbox is checked 
            elseif(!isset($_POST['useaddress'])) $errorcode = 2; #No address
            elseif(!isset($_POST['usepayment'])) $errorcode = 3; #No payment
            else{
                $cartindex = $_POST['cartindex'];
                $amount = $_POST['amount'];
                $cartproductid = array();
                $cartbuyamount = array();
                foreach($cartindex as $index){
                    array_push($cartproductid,$array_product[$index]['Product.ID']);
                    array_push($cartbuyamount,$amount[$index]);
                }
                foreach($cartbuyamount as $val){
                    if($val == 0){ #if checked but amount == 0
                        $errorcode = 4;
                        break;
                    }
                }
            }

            if($errorcode != 0){
                echo "<h3>Something went wrong.<br>";
                if($errorcode == 1) echo "You need to buy something!!<br>";
                elseif($errorcode == 2) echo "You have No Address";
                elseif($errorcode == 3) echo "You have No Payment";
                elseif($errorcode == 4) echo "You need to buy something with the amount more than 0<br>";
                else echo "Unidentified Error<br>";
                echo "</h3>";
            }
            else{
                #echo "user id = ".$userid."<br>";
                #echo "shop name = ".$shoptarget."<br>";
                #echo "address id = ".$_POST['useaddress']."<br>";
                #echo "payment id = ".$_POST['usepayment']."<br>";
                #echo "delivery id = ".$_POST['usedelivery']."<br>";
                #echo "coupon code = ".$_POST['usecoupon']."<br>";
                #echo "cart product id : ";
                #echo "<pre>";
                #print_r($cartproductid);
                #echo "cart buy amount : ";
                #print_r($cartbuyamount);
                #echo "</pre>";
                
                $_SESSION['order_userid'] = $userid;
                $_SESSION['order_shoptarget'] = $shoptarget;
                $_SESSION['order_addressid'] = $_POST['useaddress'];
                $_SESSION['order_paymentid'] = $_POST['usepayment'];
                $_SESSION['order_deliveryid'] = $_POST['usedelivery'];
                if(isset($_POST['usecoupon'])) $_SESSION['order_couponcode'] = $_POST['usecoupon'];
                else $_SESSION['order_couponcode'] = "none";
                $_SESSION['order_cartproductid'] = $cartproductid;
                $_SESSION['order_cartbuyamount'] = $cartbuyamount;

                echo "Everything is fine.";
                echo "<button class=\"btn btn-primary\" onclick=\"document.location='orderconfirm.php'\">Go to the Next Page</button>";
            }
        }
        ?>
        <hr>
    </div>
</body>
</html>