<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report - Delivery</title>
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
          <button class="btn btn-secondary" onclick="document.location='index.php'">Back to Index</button>
          <hr>
          <p class="h1 text-center">Analysis Report: Delivery Count</p>
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
            include("database.php");
            $startdate = date("Y-m-d",strtotime($_POST['startdate']));
            $enddate = date("Y-m-d",strtotime($_POST['enddate']));
            $query_report_delivery = "
            SELECT `Delivery.Method.ID`, COUNT(*) AS `Delivery.Count`
            FROM orderdetail
            WHERE `Order.Date.Time` BETWEEN '$startdate' AND '$enddate'
            GROUP BY `Delivery.Method.ID`;
            ";
            $sql_report_delivery = mysqli_query($conn, $query_report_delivery);
            $count_report_delivery = mysqli_num_rows($sql_report_delivery);
            $array_report_delivery = array();
            while($row_report_delivery = mysqli_fetch_array($sql_report_delivery)){
                array_push($array_report_delivery,$row_report_delivery);
            }
            echo '<p class="h2">Result:</p>';
            echo '<table class="table table-hover table-striped table-bordered align-middle" style="width: auto;">';
            echo '<thead class="table-dark">';
            echo '<tr>';
            echo '<th scope="col">Delivery Method ID</th>';
            echo '<th scope="col">Count</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            for($i=0;$i<$count_report_delivery;$i++){
                echo '<tr>';
                echo '<td>'.$array_report_delivery[$i]['Delivery.Method.ID'].'</td>';
                echo '<td>'.$array_report_delivery[$i]['Delivery.Count'].'</td>';
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