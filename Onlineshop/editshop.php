<?php 
$dummy="dummy value";
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
else {
    include("database.php");
    $userid = $_SESSION["User.ID"];
    $sql_shop = mysqli_query($conn,"SELECT * FROM shop where `User.ID`='$userid';");
    $i = 0;
    while($i < $_POST['chooseshop']){
    $row_shop = mysqli_fetch_array($sql_shop);
    $_SESSION['Shop.Name'] = $row_shop['Shop.Name'];
    $current_shopname = $row_shop['Shop.Name'];
    $current_shoptype = $row_shop['Shop.Type'];
    $current_shopaddr = $row_shop['Shop.Address'];
    $current_bankcode = $row_shop['Bank.Code'];
    $current_banknumber = $row_shop['Bank.Account.Number'];
    $i++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit shop</title>
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
            <p class="h1 text-center">Edit Shop Form</p>
            <hr>
        </header>
        <p class="h2">Shop Info</p>
        <form action="editshop_p.php" method='post'>
            <div class="row mb-1">
                <label for="shopname" class="col-sm-3 col-form-label">Shop Name</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="shopname" required value='<?php echo $current_shopname;?>'>
                </div>
            </div>
            <div class="row mb-1">
                <label for="shoptype" class="col-sm-3 col-form-label">Shop Type</label>
                <div class="col-auto">
                    <select name="shoptype" class="form-select" required>
                        <option <?php if($current_shoptype=='Official') {echo "selected='selected'";}?> value='Official'>Official</option>
                        <option <?php if($current_shoptype=='มีหน้าร้าน') {echo "selected='selected'";}?> value='มีหน้าร้าน'>มีหน้าร้าน</option>
                        <option <?php if($current_shoptype=='ไม่มีหน้าร้าน') {echo "selected='selected'";}?> value='ไม่มีหน้าร้าน'>ไม่มีหน้าร้าน</option>
                    </select>
                </div>
            </div>
            <div class="row mb-1">
                <label for="shopaddr" class="col-sm-3 col-form-label">Shop Address</label>
                <div class="col-3">
                    <textarea class="form-control" name="shopaddr" rows="3" required><?php echo $current_shopaddr;?></textarea>
                </div>
            </div>
            <div class="row mb-1">
                <label for="bankcode" class="col-sm-3 col-form-label">Bank Code</label>
                <div class="col-auto">
                    <select name="bankcode" class="form-select" required>
                        <option <?php if($current_bankcode=='SCB') {echo "selected='selected'";}?> value='SCB'>SCB</option>
                        <option <?php if($current_bankcode=='BBL') {echo "selected='selected'";}?> value='BBL'>BBL</option>
                        <option <?php if($current_bankcode=='KBANK') {echo "selected='selected'";}?> value='KBANK'>KBANK</option>
                        <option <?php if($current_bankcode=='UOB') {echo "selected='selected'";}?> value='UOB'>UOB</option>
                        <option <?php if($current_bankcode=='BAY') {echo "selected='selected'";}?> value='BAY'>BAY</option>
                        <option <?php if($current_bankcode=='KTB') {echo "selected='selected'";}?> value='KTB'>KTB</option>
                        <option <?php if($current_bankcode=='TBANK') {echo "selected='selected'";}?> value='TBANK'>TBANK</option>
                        <option <?php if($current_bankcode=='LH') {echo "selected='selected'";}?> value='LH'>LH</option>
                    </select>
                </div>
            </div>
            <div class="row mb-1">
                <label for="banknumber" class="col-sm-3 col-form-label">Bank Account Number</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="banknumber" required value='<?php echo $current_banknumber;?>'>
                </div>
            </div>
            <div class="row mb-auto">
                <div class="col-auto">
                    <button type="submit" name='save_shop' class="btn btn-primary">Update</button>
                </div>
                <div class="col-auto">
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
        <hr>
        <button class="btn btn-primary" onclick="document.location='productlist.php'">Manage Product</button>
        <button class="btn btn-primary" onclick="document.location='promotionlist.php'">Manage Promotion</button>
        <br><br>
        <button class="btn btn-info" onclick="document.location='report_searchkeyword.php'">Searching Keywords which point to this shop</button>
        <hr>
        <form action='deleteshop.php' method='post'>
            <button type="submit" name='delete_shop' class="btn btn-danger">Delete this Shop</button>
        </form>
        <hr>
    </div>
</body>
</html>