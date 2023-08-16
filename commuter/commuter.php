<?php
include('../php/session_commuter.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TriSakay | Commuter</title>
    <?php
    include '../php/dependencies.php';
    ?>
    <link rel="stylesheet" href="../css/commuter.css">
    <?php
    include('../php/icon.php');
    ?>
</head>

<body>
    <?php
    include('../php/navbar_commuter.php');
    ?>
    <?php
    $imagePath = "../img/Logo_Nobg.png";
    ?>
    <div class="center-image">
        <img src="<?php echo $imagePath; ?>" alt="Image Description">
    </div>
    <?php

    $imagePath = "../img/Logo_Nobg.png";
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
                echo "<h5>We hope you enjoy your next ride with <strong>TriSakay</strong>, $username.</h5>";
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


    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-2">
                <button type="submit" class="btn btn-default custom-btn" onclick="redirectToMyLocation()">
                    <i class="fa-solid fa-map-pin fa-lg" style="color: #000000;"></i> My Location
                </button>
            </div>
            <div class="col-md-6 mb-2">
                <button type="submit" class="btn btn-default custom-btn" onclick="redirectToScan()">
                    <i class="fa-solid fa-qrcode fa-lg" style="color: #000000;"></i> Scan Code
                </button>
            </div>
        </div>
    </div>

    <script src="../js/commuter_hover.js"></script>
    <script src="../js/button.js"></script>
</body>

</html>