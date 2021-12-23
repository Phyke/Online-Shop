<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
else {
    include("database.php");
    $shopname = $_SESSION["Shop.Name"];
    $sql_allpromotion = mysqli_query($conn,"SELECT * FROM promotion where `Shop.Name`='$shopname';");
    $allpromotion_count = mysqli_num_rows($sql_allpromotion);
    $array_allpromotion = array();
    while($row_allpromotion = mysqli_fetch_assoc($sql_allpromotion)){
        array_push($array_allpromotion,$row_allpromotion);
    }
    $targetpromotion = $_POST["editpromotion"] - 1;
    $_SESSION["Promotion.ID"] = $array_allpromotion[$targetpromotion]['Promotion.ID'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit promotion</title>
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
            <button class="btn btn-outline-danger" onclick="document.location='promotionlist.php'">Discard Changes</button>
            <hr>
            <p class="h1 text-center">Edit a Promotion Form</p>
            <hr>
        </header>
        <p class="h2">Promotion Info</p>
        <form action="editpromotion_p.php" method='post'>
            <div class="row mb-1">
                <label for="promotion_type" class="col-sm-3 col-form-label">Promotion Type</label>
                <div class="col-auto">
                    <select name="promotion_type" class="form-select" required>
                        <option <?php if($array_allpromotion[$targetpromotion]['Promotion.Type']=='percent discount'){echo "selected='selected'";}?> value='percent discount'>Percent Discount</option>
                        <option <?php if($array_allpromotion[$targetpromotion]['Promotion.Type']=='cost discount'){echo "selected='selected'";}?> value='cost discount'>Cost Discount</option>
                    </select>
                </div>
            </div>
            <div class="row mb-1">
                <label for="promotion_value" class="col-sm-3 col-form-label">Promotion Value</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="promotion_value" required value="<?php echo $array_allpromotion[$targetpromotion]['Promotion.Value'];?>">
                </div>
            </div>
            <div class="row mb-1">
                <label for="promotion_expire" class="col-sm-3 col-form-label">Promotion Expire Date</label>
                <div class="col-auto">
                    <input type="date" class="form-control" name="promotion_expire" required>
                    <p>Current expire date (YYYY/MM/DD) :<br>
                    <?php echo $array_allpromotion[$targetpromotion]['Promotion.Expire'];?></p>
                </div>
                
            </div>
            <div class="row mb-auto">
                <div class="col-auto">
                    <button type="submit" name='save_promotion' class="btn btn-primary">Update</button>
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