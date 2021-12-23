<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
else {
    include("database.php");
    $shopname = $_SESSION["Shop.Name"];
    $sql_promotion = mysqli_query($conn,"SELECT * FROM promotion where `Shop.Name`='$shopname';");
    $promotion_count = mysqli_num_rows($sql_promotion);
    $array_promotion = array();
    while($row_promotion = mysqli_fetch_assoc($sql_promotion)) {
        array_push($array_promotion,$row_promotion);
    }
    #echo "<pre>";
    #print_r($array_promotion);
    #echo "</pre>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promotion list</title>
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
          <button class="btn btn-outline-danger" onclick="document.location='shoplist.php'">Back to Shop list</button>
          <hr>
          <p class="h1 text-center">My Promotion list</p>
          <hr>
        </header>
        <p class="h2">Shop Name : <?php echo $shopname?></p>
        <hr>
        <button class="btn btn-primary" onclick="document.location='addnewpromotion.php'">Add new Promotion</button>
        <form action="editpromotion.php" method="post">
        <label for="editpromotion">Choose a Promotion to edit:</label>
            <?php
            if($promotion_count==0){
                echo "You have not created a Promotion yet.";
            }
            else{
                echo "<select name='editpromotion'>";
                for ($i=0 ; $i<$promotion_count ; $i++){
                    $j = $i+1;
                    echo "<option value='$j'>Promotion $j</option>";
                }
                echo "</select>";
                echo '<button type="submit" name="editpromotionsubmit" class="btn btn-primary">Edit</button>';
            }
            ?>
        </form>
        <form action="deletepromotion.php" method="post">
        <label for="deletepromotion">Choose a Promotion to delete:</label>
            <?php
            if($promotion_count==0){
                echo "You have not created a promotion yet.";
            }
            else{
                echo "<select name='deletepromotion'>";
                for ($i=0 ; $i<$promotion_count ; $i++){
                    $j = $i+1;
                    echo "<option value='$j'>Promotion $j</option>";
                }
                echo "</select>";
                echo '<button type="submit" name="deletepromotionsubmit" class="btn btn-danger">Delete</button>';
            }
            ?>
        </form>
        <hr>
        <p class="h2">Your promotion list:</p>
        <table class="table table-hover table-striped table-bordered align-middle" style="width: auto;">
            <thead class="table-dark">
                <tr>
                <th scope="col">Number</th>
                <th scope="col">Promotion Type</th>
                <th scope="col">Promotion Value</th>
                <th scope="col">Promotion Expire</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0;$i<$promotion_count;$i++){
                    $num=$i+1;
                    echo '<tr>';
                    echo '<td>'.$num.'</td>';
                    echo '<td>'.$array_promotion[$i]['Promotion.Type'].'</td>';
                    echo '<td>'.$array_promotion[$i]['Promotion.Value'].'</td>';
                    echo '<td>'.$array_promotion[$i]['Promotion.Expire'].'</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>