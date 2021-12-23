<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report - Product Rating</title>
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
          <button class="btn btn-secondary" onclick="document.location='shoplist.php'">Back to Shop list</button>
          <hr>
          <p class="h1 text-center">Analysis Report: Average Product Rating</p>
          <hr>
        </header>
        <p class="h2">Your average product rating:</p>
        <?php
        session_start();
        if(!isset($_SESSION['User.ID'])){
            header("Location: index.php"); 
        }
        else{
            include("database.php");
            $userid = $_SESSION['User.ID'];
            $query_report_rating = "
            SELECT p.`Shop.Name`, AVG(`Product.Rating`) as `Average.Rating`
            FROM product p
            LEFT JOIN shop s
            ON p.`Shop.Name` = s.`Shop.Name`
            WHERE s.`User.ID` = '$userid'
            GROUP BY `Shop.Name`;
            ";
            $sql_report_rating = mysqli_query($conn, $query_report_rating);
            $count_report_rating = mysqli_num_rows($sql_report_rating);
            $array_report_rating = array();
            while($row_report_rating = mysqli_fetch_array($sql_report_rating)){
                array_push($array_report_rating,$row_report_rating);
            }
            echo '<table class="table table-hover table-striped table-bordered align-middle" style="width: auto;">';
            echo '<thead class="table-dark">';
            echo '<tr>';
            echo '<th scope="col">Shop Name</th>';
            echo '<th scope="col">Average Product Rating</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            for($i=0;$i<$count_report_rating;$i++){
                echo '<tr>';
                echo '<td>'.$array_report_rating[$i]['Shop.Name'].'</td>';
                echo '<td>'.round($array_report_rating[$i]['Average.Rating'],2).'</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        }
        ?>
        <hr>
    </div>
</body>
</html>