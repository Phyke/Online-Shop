<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Page</title>
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
            <br>
            <p class="h1 text-center">Welcome to Online Shop (CPE231 Database System)</p>
            <hr>
        </header>
        <p class="h4"><b>Group members:</b></p>
        <p class="h6">62070501043 นายพรภวิษย์ ปรีชาติวงศ์</p>
        <p class="h6">62070501045 นายพรหมบุศย์ เชิดชู</p>
        <p class="h6">62070501058 นายวัณณะ วรรณศิลป์</p>
        <p class="h6">62070501059 นายวิชญ์ องคนิกูล</p>
        <hr>
        <button class="btn btn-primary" onclick="document.location='login.php'">Login</button>
        <button class="btn btn-primary" onclick="document.location='register.php'">Register</button>
        <button class="btn btn-success" onclick="document.location='homepage.php'">Homepage (Login First!)</button>
        <hr>
        <p class="h4"><b>Analysis reports:</b></p>
        <button class="btn btn-info" onclick="document.location='report_delivery.php'">Delivery Count</button>
        <button class="btn btn-info" onclick="document.location='report_payment.php'">Payment Method Count</button>
        <hr>
    </div>
</body>
</html>