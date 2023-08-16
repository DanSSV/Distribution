<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit;
}

include('../db/dbconn.php');

$user_id = $_SESSION['user_id'];
$query = "SELECT role FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $user_role = $row['role'];

    if ($user_role !== 'admin') {
        header("Location: ../index.php");
        exit;
    }
} else {

}
?>