<?php
header("Content-Type: application/json");
$conn = new mysqli("localhost", "root", "", "test1");

if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit();
}

$sql = "SELECT * FROM GEYMA ORDER BY kathgoria, timi DESC";
$result = $conn->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
$conn->close();
?>
