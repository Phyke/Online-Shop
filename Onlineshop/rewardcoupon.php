<?php 
$dummy="get value from DB by php and insert here";
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
else {
    include("database.php");
    $userid = $_SESSION["User.ID"];
    $sql_userreward = mysqli_query($conn,"SELECT `Reward.Point.Own` FROM users where `User.ID`='$userid';");
    $row_userreward = mysqli_fetch_array($sql_userreward);
    $userreward = $row_userreward[0];
    $sql_reward = mysqli_query($conn,"SELECT * FROM Reward;");
    $count_reward = mysqli_num_rows($sql_reward);
    $array_reward = array();
    while($row_reward = mysqli_fetch_array($sql_reward)){
        array_push($array_reward,$row_reward);
    }
    $sql_usercoupon = mysqli_query($conn,"SELECT * FROM Coupon WHERE `User.ID`='$userid';");
    $count_usercoupon = mysqli_num_rows($sql_usercoupon);
    $array_usercoupon = array();
    while($row_usercoupon = mysqli_fetch_array($sql_usercoupon)){
        array_push($array_usercoupon,$row_usercoupon);
    }

    $_SESSION['Reward.Point.Own'] = $userreward;
    $_SESSION['array_reward'] = $array_reward;
    $_SESSION['array_usercoupon'] = $array_usercoupon;
    #echo "<pre>";
    #print_r($array_usercoupon);
    #echo "</pre>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redeem Coupon</title>
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
          <p class="h1 text-center">Get Coupon</p>
          <hr>
        </header>
        <p class="h2">Your currently own Coupon list:</p>
        <table class="table table-hover table-striped table-bordered align-middle" style="width: auto;">
            <thead class="table-dark">
                <tr>
                <th scope="col">Number</th>
                <th scope="col">Coupon Code</th>
                <th scope="col">Description</th>
                <th scope="col">Usage (Use left)</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0;$i<$count_usercoupon;$i++){
                    $num=$i+1;
                    echo '<tr>';
                    echo '<td>'.$num.'</td>';
                    echo '<td>'.$array_usercoupon[$i]['Coupon.Code'].'</td>';
                    echo '<td>'.$array_usercoupon[$i]['Coupon.Description'].'</td>';
                    echo '<td>'.$array_usercoupon[$i]['Coupon.Usage'].'</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <hr>
        <p class="h2">Coupon you can redeem with your reward points</p>
        <p class="h3">Your reward points : <?php echo $userreward; ?></p>
        <form action="rewardcoupon_p.php" method="post">
        <label for="choosereward">Choose which one you want:</label>
        <?php
        if($count_reward==0){
            echo "There is no coupon you can redeem currently.";
        }
        else{
            echo "<select name='choosereward'>";
            for ($i=0 ; $i<$count_reward ; $i++){
                $j = $array_reward[$i]['Reward.ID'];
                if($array_reward[$i]['Reward.Stock']>0){
                    echo "<option value='$j'>Reward ID : $j</option>";
                }
            }
            echo "</select>";
            echo '<button type="submit" name="chooserewardsubmit" class="btn btn-primary">Redeem</button>';
        }
        ?>
        </form>
        <table class="table table-hover table-striped table-bordered align-middle" style="width: auto;">
            <thead class="table-dark">
                <tr>
                <th scope="col">Reward ID</th>
                <th scope="col">Description</th>
                <th scope="col">Count in Stock</th>
                <th scope="col">Reward Points cost</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=0;$i<$count_reward;$i++){
                    if($array_reward[$i]['Reward.Stock']>0){
                        echo '<tr>';
                        echo '<td>'.$array_reward[$i]['Reward.ID'].'</td>';
                        echo '<td>'.$array_reward[$i]['Reward.Description'].'</td>';
                        echo '<td>'.$array_reward[$i]['Reward.Stock'].'</td>';
                        echo '<td>'.$array_reward[$i]['Reward.Price'].'</td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>