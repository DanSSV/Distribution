<?php
include('../php/session_driver.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/e96c3f3ee3.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <title>TriSakay | Driver</title>
    <link rel="stylesheet" href="../css/style3.css" />
    <?php
    include('../php/icon.php');
    ?>
    <style>
        .navbar {
            background-color: #2c5746 !important;
        }
    </style>
    <style>
        .chart-container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <?php
    
    include('../php/navbar_driver.php');
    include('../db/dbconn.php'); 
    $sessionId = session_id();
    $query = "SELECT username FROM users WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $sessionId);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $username = $row['username'];
                echo "<h1>We're glad to see you back!, $username.</h1>";
            } else {
                echo "<h1>User not found.</h1>";
            }
        } else {
            echo "<h1>Error querying the database.</h1>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<h1>Error preparing the statement.</h1>";
    }
    ?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", { packages: ['corechart'] });
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            var dataPassengers = google.visualization.arrayToDataTable([
                ["Day", "Passenger", { role: "style" }],
                ["Sunday", 15, "#b87333"],
                ["Monday", 8, "silver"],
                ["Tuesday", 20, "gold"],
                ["Wednesday", 12, "#e5e4e2"],
                ["Thursday", 6, "green"],
                ["Friday", 18, "blue"],
                ["Saturday", 9, "purple"]
            ]);

            var viewPassengers = new google.visualization.DataView(dataPassengers);
            viewPassengers.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2]);

            var optionsPassengers = {
                title: "Number of Passengers by Day",
                width: 400,
                height: 300,
                bar: { groupWidth: "70%" },
                legend: { position: "none" },
            };
            var chartPassengers = new google.visualization.ColumnChart(document.getElementById("columnchart_values_passengers"));
            chartPassengers.draw(viewPassengers, optionsPassengers);

            var dataDistance = google.visualization.arrayToDataTable([
                ["Day", "Distance Traveled (km)", { role: "style" }],
                ["Sunday", 50, "#b87333"],
                ["Monday", 30, "silver"],
                ["Tuesday", 75, "gold"],
                ["Wednesday", 40, "#e5e4e2"],
                ["Thursday", 20, "green"],
                ["Friday", 60, "blue"],
                ["Saturday", 35, "purple"]
            ]);

            var viewDistance = new google.visualization.DataView(dataDistance);
            viewDistance.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2]);

            var optionsDistance = {
                title: "Distance Traveled by Day",
                width: 400,
                height: 300,
                bar: { groupWidth: "70%" },
                legend: { position: "none" },
            };
            var chartDistance = new google.visualization.ColumnChart(document.getElementById("columnchart_values_distance"));
            chartDistance.draw(viewDistance, optionsDistance);
        }
        function drawFareChart() {
            var dataFare = google.visualization.arrayToDataTable([
                ["Day", "Fare", { role: "style" }],
                ["Sunday", 500, "#b87333"],
                ["Monday", 350, "silver"],
                ["Tuesday", 700, "gold"],
                ["Wednesday", 380, "#e5e4e2"],
                ["Thursday", 200, "green"],
                ["Friday", 350, "blue"],
                ["Saturday", 150, "purple"]
            ]);

            var viewFare = new google.visualization.DataView(dataFare);
            viewFare.setColumns([0, 1,
                {
                    calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"
                },
                2]);

            var optionsFare = {
                title: "Fare Amount by Day",
                width: 400,
                height: 300,
                bar: { groupWidth: "70%" },
                legend: { position: "none" },
            };
            var chartFare = new google.visualization.ColumnChart(document.getElementById("columnchart_values_fare"));
            chartFare.draw(viewFare, optionsFare);
        }

        google.charts.setOnLoadCallback(drawFareChart);

    </script>




    <div class="container">
        <div class="row justify-content-center"> 
            <div class="col-md-6">
                <div class="chart-container mb-4">
                    <div id="columnchart_values_passengers" style="width: 100%; height: 300px;"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container mb-4">
                    <div id="columnchart_values_distance" style="width: 100%; height: 300px;"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="chart-container">
                    <div id="columnchart_values_fare" style="width: 100%; height: 300px;"></div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>