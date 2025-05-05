<?php
header("Content-Type: application/json");

// Database connection
$conn = new mysqli("localhost", "root", "", "test1");

if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed: " . $conn->connect_error]);
    exit();
}

// SQL: return all stores with employee count
$sql = "
    SELECT k.kodikos, k.poli, k.emvadon, k.tilefono, k.hmer_rydrisis,
           COUNT(y.ar_tautotitas) AS synolikoi_ypalliloi
    FROM KATASTHMA k
    LEFT JOIN YPALLHLOS y ON k.kodikos = y.kodikos_katasthmatos
    GROUP BY k.kodikos, k.poli, k.emvadon, k.tilefono, k.hmer_rydrisis
";

$result = $conn->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
$conn->close();
?>
