<?php 
$dummy="dummy value";
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
else {
    include("database.php");
    $userid = $_SESSION["User.ID"];
    $sql_payment = mysqli_query($conn,"SELECT * FROM payment where `User.ID`='$userid';");
    $i = 0;
    while($i < $_POST['choosepayment']){
    $row_payment = mysqli_fetch_array($sql_payment);
    $_SESSION['Payment.ID'] = $row_payment['Payment.ID'];
    $current_method = $row_payment['Payment.Method'];
    $current_partner = $row_payment['Payment.Partner'];
    $current_refno = $row_payment['Reference.No'];
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
    <title>Edit payment</title>
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
            <button class="btn btn-outline-danger" onclick="document.location='account.php'">Discard Changes</button>
            <hr>
            <p class="h1 text-center">Edit Payment Info Form</p>
            <hr>
        </header>
        <p class="h2">Payment</p>
        <form action="editpayment_p.php" method='post'>
            <div class="row mb-1">
                <label class="col-sm-3 col-form-label">Payment Method</label>
                <div class="col-auto">
                    <select name="pmethod" class="form-select" required>
                        <option <?php if($current_method=='ชำระผ่านบัญชีธนาคาร'){echo "selected='selected'";}?> value='ชำระผ่านบัญชีธนาคาร'>ชำระผ่านบัญชีธนาคาร</option>
                        <option <?php if($current_method=='ชำระผ่านบัตรเครดิต'){echo "selected='selected'";}?> value='ชำระผ่านบัตรเครดิต'>ชำระผ่านบัตรเครดิต</option>
                        <option <?php if($current_method=='ชำระผ่านตู้ ATM'){echo "selected='selected'";}?> value='ชำระผ่านตู้ ATM'>ชำระผ่านตู้ ATM</option>
                    </select>
                </div>
            </div>
            <div class="row mb-1">
                <label for="partner1" class="col-sm-3 col-form-label">Payment Partner</label>
                <div class="col-auto">
                <select name="partner" class="form-select" required>
                        <option <?php if($current_partner=='SCB') {echo "selected='selected'";}?> value='SCB'>SCB</option>
                        <option <?php if($current_partner=='BBL') {echo "selected='selected'";}?> value='BBL'>BBL</option>
                        <option <?php if($current_partner=='KBANK') {echo "selected='selected'";}?> value='KBANK'>KBANK</option>
                        <option <?php if($current_partner=='UOB') {echo "selected='selected'";}?> value='UOB'>UOB</option>
                        <option <?php if($current_partner=='BAY') {echo "selected='selected'";}?> value='BAY'>BAY</option>
                        <option <?php if($current_partner=='KTB') {echo "selected='selected'";}?> value='KTB'>KTB</option>
                        <option <?php if($current_partner=='TBANK') {echo "selected='selected'";}?> value='TBANK'>TBANK</option>
                        <option <?php if($current_partner=='LH') {echo "selected='selected'";}?> value='LH'>LH</option>
                    </select>
                </div>
            </div>
            <div class="row mb-1">
                <label for="refno1" class="col-sm-3 col-form-label">Reference No.</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="refno" required value="<?php echo $current_refno;?>">
                </div>
            </div>
            <div class="row mb-auto">
                <div class="col-auto">
                    <button type="submit" name="save_payment" class="btn btn-primary">Update</button>
                </div>
                <div class="col-auto">
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
        <hr>
        <form action='deletepayment.php' method='post'>
            <button type="submit" name='delete_payment' class="btn btn-danger">Delete this Payment</button>
        </form>
        <hr>
    </div>
</body>
</html>