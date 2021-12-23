<?php
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
    <title>Search</title>
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
          <p class="h1 text-center">Search Product Name</p>
          <hr>
        </header>
        <form method='post'>
            <div class="row mb-1">
                <label for="searchword" class="col-sm-2 col-form-label">Word to search</label>
                <div class="col-auto">
                    <input type="text" class="form-control" name="searchword" required>
                </div>
                <div class="col-auto">
                    <button type="submit" name='searchsubmit' class="btn btn-primary">Search</button>
                </div>
                <div class="col-auto">
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
        <hr>
        <p class="h2">Search Result:</p>
        <p class="h6">(Only First 5 Matching)</p>
        <table class="table table-hover table-striped table-bordered align-middle" style="width: auto;">
            <thead class="table-dark">
                <tr>
                <th scope="col">Number</th>
                <th scope="col">Shop Name</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Description</th>
                <th scope="col">Product Price</th>
                <th scope="col">Product Stock</th>
                <th scope="col">Promotion Status</th>
                <th scope="col">Link to the Shop</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($_POST['searchsubmit'])){
                    include("database.php");
                    $word = $_POST['searchword'];
                    $sql_result = mysqli_query($conn,"SELECT * FROM product WHERE `Product.Name` LIKE '%$word%'");
                    $count_result = mysqli_num_rows($sql_result);
                    $array_result = array();
                    while($row_result = mysqli_fetch_array($sql_result)){
                        array_push($array_result,$row_result);
                    }
                    for($i=0;$i<5&&$i<$count_result;$i++){
                        $num=$i+1;
                        
                        echo '<tr>';
                        echo '<td>'.$num.'</td>';
                        echo '<td>'.$array_result[$i]['Shop.Name'].'</td>';
                        echo '<td>'.$array_result[$i]['Product.Name'].'</td>';
                        echo '<td>'.$array_result[$i]['Product.Description'].'</td>';
                        echo '<td>'.$array_result[$i]['Product.Price'].'</td>';
                        echo '<td>'.$array_result[$i]['Product.Stock'].'</td>';
                        if($array_result[$i]['Promotion.ID']!=''){
                            echo '<td>Have Promo</td>';
                        }
                        else{
                            echo '<td>NO</td>';
                        }
                        $shopname = $array_result[$i]['Shop.Name'];
                        echo '<td><a href="shoppage.php?shoptarget='.$shopname.'">Shop Page</a></td>';
                        echo '</tr>';
                    }
                    if($count_result>0){
                        $userid = $_SESSION['User.ID'];
                        $productid_target = $array_result[rand(0,$count_result-1)]['Product.ID'];
                        $query_search="
                        INSERT INTO searching
                        VALUES ('$userid','$word',NULL,'$productid_target');
                        ";
    
                        if (mysqli_query($conn, $query_search)) {
                            #echo "Record Added to [Searching] successfully.<br>";
                        }
                        else {
                            echo "Error: " . $query_search . "<br>" . mysqli_error($conn);
                        }
                    }
                    mysqli_close($conn);
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>