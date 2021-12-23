<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report - Keywords</title>
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
          <p class="h1 text-center">Analysis Report: Searching keywords</p>
          <hr>
        </header>
        <p class="h2">Please input date range:</p>
        <form method="post">
            <div class="row mb-1">
                <label for="startdate" class="col-sm-3 col-form-label">Start Date</label>
                <div class="col-auto">
                    <input type="date" class="form-control" name="startdate" required>
                </div>
            </div>
            <div class="row mb-1">
                <label for="enddate" class="col-sm-3 col-form-label">End Date</label>
                <div class="col-auto">
                    <input type="date" class="form-control" name="enddate" required>
                </div>
            </div>
            <div class="row mb-auto">
                <div class="col-auto">
                    <button type="submit" name='daterange_submit' class="btn btn-primary">Submit</button>
                </div>
                <div class="col-auto">
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </div>
        </form>
        <hr>
        <?php
        if(isset($_POST['daterange_submit'])){
            session_start();
            if(!isset($_SESSION['User.ID'])){
                header("Location: index.php"); 
            }
            else{
                
                include("database.php");
                $shopname = $_SESSION['Shop.Name'];
                $startdate = date("Y-m-d",strtotime($_POST['startdate']));
                $enddate = date("Y-m-d",strtotime($_POST['enddate']));
                $query_report_keyword = "
                SELECT s.`Searching.Word`, COUNT(*) AS `Searching.Count`
                FROM searching s
                LEFT JOIN product p
                ON s.`Searching.Destination.Product` = p.`Product.ID`
                WHERE p.`Shop.Name` = '$shopname' AND s.`Searching.Date.Time` BETWEEN '$startdate' AND '$enddate'
                GROUP BY s.`Searching.Word`;
                ";
                $sql_report_keyword = mysqli_query($conn, $query_report_keyword);
                $count_report_keyword = mysqli_num_rows($sql_report_keyword);
                $array_report_keyword = array();
                while($row_report_keyword = mysqli_fetch_array($sql_report_keyword)){
                    array_push($array_report_keyword,$row_report_keyword);
                }
                echo '<p class="h2">Keywords point to your shop:</p>';
                echo '<table class="table table-hover table-striped table-bordered align-middle" style="width: auto;">';
                echo '<thead class="table-dark">';
                echo '<tr>';
                echo '<th scope="col">Searching Word</th>';
                echo '<th scope="col">Searching Count</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                for($i=0;$i<$count_report_keyword;$i++){
                    echo '<tr>';
                    echo '<td>'.$array_report_keyword[$i]['Searching.Word'].'</td>';
                    echo '<td>'.round($array_report_keyword[$i]['Searching.Count'],2).'</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            }
        }
        ?>
        <hr>
    </div>
</body>
</html>