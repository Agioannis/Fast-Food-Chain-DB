<?php
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "test1");
if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed"]);
    exit();
}

$sql = "
    SELECT k.kodikos, k.poli, COUNT(p.id) AS total_orders
    FROM KATASTHMA k
    LEFT JOIN PARAGGELIA p ON k.kodikos = p.kodikos_katasthmatos
    GROUP BY k.kodikos, k.poli
";

$result = $conn->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
$conn->close();
?>
