<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
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
            <button class="btn btn-secondary" onclick="document.location='index.php'">Back to Index</button>
            <hr>
            <p class="h1 text-center">Registration Form</p>
            <hr>
        </header>
        
        
        <p class="h1">User Info</p>
        <form action="register_p.php" method="post">
            <div class="row mb-1">
                <label for="fname" class="col-sm-3 col-form-label">First Name</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="fname" required>
                </div>
            </div>
            <div class="row mb-1">
                <label for="lname" class="col-sm-3 col-form-label">Last Name</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="lname" required>
                </div>
            </div>
            <div class="row mb-1">
                <label for="phone" class="col-sm-3 col-form-label">Phone No.</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="phone" required>
                </div>
            </div>
            <div class="row mb-1">
                <label for="email" class="col-sm-3 col-form-label">Email Address</label>
                <div class="col-auto">
                    <input type="email" class="form-control" name="email" required>
                </div>
            </div>
            <div class="row mb-1">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-auto">
                    <input type="password" class="form-control" name="password" required>
                </div>
            </div>
            <hr>
            <p class="h1">Address Info</p>
            <div class="row mb-1">
                <label for="addrt" class="col-sm-3 col-form-label">Address Type</label>
                <div class="col-auto">
                    <select name="addrt" class="form-select" required>
                        <option value='House'>House</option>
                        <option value='Condo'>Condo</option>
                    </select>
                </div>
            </div>
            <div class="row mb-1">
                <label for="postal" class="col-sm-3 col-form-label">Postal Code</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="postal" required>
                </div>
            </div>
            <div class="row mb-1">
                <label for="addr" class="col-sm-3 col-form-label">Address Detail</label>
                <div class="col-md-3">
                    <textarea class="form-control" name="addr" rows="3" required></textarea>
                </div>
            </div>
            <hr>
            <p class="h1">Payment Info</p>
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
                <label for="partner" class="col-sm-3 col-form-label">Payment Partner</label>
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
                <label for="refno" class="col-sm-3 col-form-label">Reference No.</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="refno" required>
                </div>
            </div>
            <hr>
            <div class="row mb-auto">
                <div class="col-auto">
                    <button type="submit" name='save_register' class="btn btn-primary">Register</button>
                </div>
                <div class="col-auto">
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
        <br>
    </div>
</body>
</html>