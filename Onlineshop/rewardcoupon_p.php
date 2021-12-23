<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
extract($_POST);
include("database.php");

if(isset($_POST["chooserewardsubmit"])) {
    $userid = $_SESSION['User.ID'];
    $rewardid = $choosereward;
    $array_reward = $_SESSION['array_reward'];
    $remain_point = $_SESSION['Reward.Point.Own'] - $array_reward[$rewardid-1]['Reward.Price'];
    if($remain_point < 0){
        echo "<h2><p>You don't have enough points</p></h2>";
    }
    else{
        $sql_usercheck = mysqli_query($conn, "SELECT * FROM coupon WHERE `User.ID`='$userid' AND `Reward.ID`='$rewardid';");
        if(mysqli_num_rows($sql_usercheck)==0){ #Create new row in coupon
            #Generate Coupon Code
            $sql_rewardcheck = mysqli_query($conn, "SELECT COUNT(*) FROM coupon WHERE `Reward.ID`='$rewardid';");
            $row_rewardcheck = mysqli_fetch_array($sql_rewardcheck);
            $count_rewardcheck = $row_rewardcheck[0];
            if($rewardid==1) $couponcode="TWXAZF0".$count_rewardcheck+1;
            elseif($rewardid==2) $couponcode="TSCZSGQ".$count_rewardcheck+1;
            elseif($rewardid==3) $couponcode="XCBDHWE".$count_rewardcheck+1;
            elseif($rewardid==4) $couponcode="JBHXON0".$count_rewardcheck+1;
            elseif($rewardid==5) $couponcode="BVCXCDZ".$count_rewardcheck+1;
            elseif($rewardid==6) $couponcode="GSDFEGL".$count_rewardcheck+1;
            $coupondesc = $array_reward[$rewardid-1]['Reward.Description'];
            $coupontype = $array_reward[$rewardid-1]['Reward.Type'];
            $couponvalue = $array_reward[$rewardid-1]['Reward.Value'];
            $query_coupon_insertnew =
            "INSERT INTO coupon
            VALUES ('$userid','$rewardid','$couponcode','$coupondesc',1,'$coupontype','$couponvalue')
            ";
            
            $query_user_updatepoint = 
            "UPDATE users
            SET `Reward.Point.Own`='$remain_point'
            WHERE `User.ID`='$userid';";

            $query_reward_updatestock =
            "UPDATE reward
            SET `Reward.Stock`=`Reward.Stock`-1
            WHERE `Reward.ID`='$rewardid';";

            if (mysqli_query($conn, $query_user_updatepoint)) {
                echo "Record Updated in [Users] successfully.<br>";
                
            }
            else {
                echo "Error: " . $query_user_updatepoint . "<br>" . mysqli_error($conn);
            }
            if (mysqli_query($conn, $query_reward_updatestock)) {
                echo "Record Updated in [Reward] successfully.<br>";
                
            }
            else {
                echo "Error: " . $query_reward_updatestock . "<br>" . mysqli_error($conn);
            }
            if (mysqli_query($conn, $query_coupon_insertnew)) {
                echo "New Record added to [Coupon] successfully.<br>";
                
            }
            else {
                echo "Error: " . $query_coupon_insertnew . "<br>" . mysqli_error($conn);
            }
        }
        else{ #Change stock, usage, pointOwn
            $query_user_updatepoint = 
            "UPDATE users
            SET `Reward.Point.Own`='$remain_point'
            WHERE `User.ID`='$userid';";
            $query_coupon_updateusage =
            "UPDATE coupon
            SET `Coupon.Usage`=`Coupon.Usage`+1
            WHERE `User.ID`='$userid' AND `Reward.ID`='$rewardid';";
            $query_reward_updatestock =
            "UPDATE reward
            SET `Reward.Stock`=`Reward.Stock`-1
            WHERE `Reward.ID`='$rewardid';";

            if (mysqli_query($conn, $query_user_updatepoint)) {
                echo "Record Updated in [Users] successfully.<br>";
                
            }
            else {
                echo "Error: " . $query_user_updatepoint . "<br>" . mysqli_error($conn);
            }
            if (mysqli_query($conn, $query_coupon_updateusage)) {
                echo "Record Updated in [Coupon] successfully.<br>";
                
            }
            else {
                echo "Error: " . $query_coupon_updateusage . "<br>" . mysqli_error($conn);
            }
            if (mysqli_query($conn, $query_reward_updatestock)) {
                echo "Record Updated in [Reward] successfully.<br>";
                
            }
            else {
                echo "Error: " . $query_reward_updatestock . "<br>" . mysqli_error($conn);
            }
        }
    }
    echo "<h1><a href='rewardcoupon.php'>Go back</a></h1>";
    mysqli_close($conn);
}
?>