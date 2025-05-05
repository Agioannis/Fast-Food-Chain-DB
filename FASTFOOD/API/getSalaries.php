<?php
header("Content-Type: application/json");
$conn = new mysqli("localhost", "root", "", "test1");

if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit();
}

$sql = "
    SELECT k.poli, AVG(y.misthos) AS mesos_misthos
    FROM YPALLHLOS y
    JOIN KATASTHMA k ON y.kodikos_katasthmatos = k.kodikos
    GROUP BY k.poli
";
$result = $conn->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
$conn->close();
?>
