<?php
require_once 'db/dbconn.php';

$plateNumber = $_POST['plate_number'];

$query = "SELECT COUNT(*) AS count FROM driver WHERE plate_number = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $plateNumber);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();


$response = array("exists" => $data["count"] > 0);
echo json_encode($response);

$stmt->close();
$conn->close();
?>