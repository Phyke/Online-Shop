<?php 
$dummy="dummy value";
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add new payment</title>
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
            <p class="h1 text-center">Add Payment Info Form</p>
            <hr>
        </header>
        <p class="h2">Payment</p>
        <form action="addnewpayment_p.php" method='post'>
        <div class="row mb-1">
                <label class="col-sm-3 col-form-label">Payment Method</label>
                <div class="col-auto">
                    <select name="pmethod" class="form-select" required>
                        <option value='ชำระผ่านบัญชีธนาคาร'>ชำระผ่านบัญชีธนาคาร</option>
                        <option value='ชำระผ่านบัตรเครดิต'>ชำระผ่านบัตรเครดิต</option>
                        <option value='ชำระผ่านตู้ ATM'>ชำระผ่านตู้ ATM</option>
                    </select>
                </div>
            </div>
            <div class="row mb-1">
                <label for="partner1" class="col-sm-3 col-form-label">Payment Partner</label>
                <div class="col-auto">
                    <select name="partner" class="form-select" required>
                        <option value='SCB'>SCB</option>
                        <option value='BBL'>BBL</option>
                        <option value='KBANK'>KBANK</option>
                        <option value='UOB'>UOB</option>
                        <option value='BAY'>BAY</option>
                        <option value='KTB'>KTB</option>
                        <option value='TBANK'>TBANK</option>
                        <option value='LH'>LH</option>
                    </select>
                </div>
            </div>
            <div class="row mb-1">
                <label for="refno1" class="col-sm-3 col-form-label">Reference No.</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="refno" required value="">
                </div>
            </div>
            <div class="row mb-auto">
                <div class="col-auto">
                    <button type="submit" name="add_payment" class="btn btn-primary">Add</button>
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