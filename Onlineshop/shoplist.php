<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
else {
    include("database.php");
    $userid = $_SESSION["User.ID"];
    $sql_shop = mysqli_query($conn,"SELECT * FROM shop where `User.ID`='$userid';");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop list</title>
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
          <hr>
          <p class="h1 text-center">My Shop list</p>
          <hr>
        </header>
        <p class="h2">Your shop</p>
        <form action="editshop.php" method="post">
            <label for="chooseshop">Choose a Shop:</label>
            <?php
            $shop_count = mysqli_num_rows($sql_shop);
            if($shop_count==0){
                echo "You have not created a shop yet.";
            }
            else{
                echo "<select name='chooseshop'>";
                for ($i=0 ; $i<$shop_count ; $i++){
                    $j = $i+1;
                    echo "<option value='$j'>Shop $j</option>";
                }
                echo "</select>";
                echo '<button type="submit" name="submitshop" class="btn btn-outline-primary">Edit</button>';
            }
            ?>
        </form>
        <p>Or add a new shop</p>
        <button class="btn btn-outline-primary" onclick="document.location='addnewshop.php'">Add</button>
        <hr>
        <button class="btn btn-info" onclick="document.location='report_product_rating.php'">Your Average Product Rating</button>
        <hr>
    </div>
</body>
</html>