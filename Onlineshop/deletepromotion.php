<?php
session_start();
if(!isset($_SESSION['User.ID'])){
    header("Location: index.php"); 
}
extract($_POST);
include("database.php");

if(isset($_POST["deletepromotionsubmit"])) {
    $shopname = $_SESSION["Shop.Name"];
    $sql_allpromotion = mysqli_query($conn,"SELECT * FROM promotion where `Shop.Name`='$shopname';");
    $allpromotion_count = mysqli_num_rows($sql_allpromotion);
    $array_allpromotion = array();
    while($row_allpromotion = mysqli_fetch_assoc($sql_allpromotion)){
        array_push($array_allpromotion,$row_allpromotion);
    }
    $targetpromotion = $_POST["deletepromotion"] - 1;
    $deletepromotionid = $array_allpromotion[$targetpromotion]['Promotion.ID'];

    $query_promotion = "
    DELETE FROM promotion
    WHERE `Promotion.ID` = $deletepromotionid;
    ";
    if (mysqli_query($conn, $query_promotion)) {
        echo "Record Deleted from [Promotion] successfully.<br>";
        echo "<h1><a href='promotionlist.php'>Go back</a></h1>";
    }
    else {
        echo "Error: " . $query_promotion . "<br>" . mysqli_error($conn);
        echo "<h1><a href='promotionlist.php'>Go back</a></h1>";
    }
    mysqli_close($conn);
}
?>