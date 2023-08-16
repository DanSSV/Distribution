<?php
require_once "db/dbconn.php"; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST["username"];
    $input_password = $_POST["password"];
    $stmt = $conn->prepare("SELECT user_id, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($user_id, $password, $role);
    $stmt->fetch();
    if ($stmt->num_rows == 1 && $input_password == $password) {
        session_id($user_id);
        session_start();

        $_SESSION["user_id"] = $user_id;
    
        if ($role == "driver") {
            header("Location: driver/driver.php");
        } elseif ($role == "commuter") {
            header("Location: commuter/commuter.php"); 
        } elseif ($role == "admin") {
            header("Location: admin/admin.php");
        } else {
        }

        $stmt->close();
        exit();
    } else {
        $stmt->close(); 

        header("Location: index.php?error=true"); 
        exit();
    }
}

$conn->close();
?>