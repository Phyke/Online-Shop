<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
            <p class="h1 text-center">Login Form</p>
            <hr>
        </header>
        <form action="login_p.php" method="post">
            <div class="row mb-1">
                <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                <div class="col-auto">
                    <input type="email" class="form-control" name="email" required>
                </div>
            </div>
            <div class="row mb-1">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-auto">
                    <input type="password" class="form-control" name="password" required>
                </div>
            </div>
            <div class="row mb-auto">
                <div class="col-auto">
                    <button type="submit" name="loginbutton" class="btn btn-primary">Login</button>
                </div>
                <div class="col-auto">
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
        <p>If you don't have an account -> <a href="register.php">Register</a></p>
    </div>
</body>
</html>