<?php
header("Content-Type: application/json");
$conn = new mysqli("localhost", "root", "", "test1");

if ($conn->connect_error) {
    echo json_encode(["error" => "Connection failed"]);
    exit();
}

// DELETE offer
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_method'] === 'DELETE') {
    $store = $_POST['store'];
    $meal = $_POST['meal'];
    $stmt = $conn->prepare("DELETE FROM PROSFORA WHERE kodikos_katasthmatos = ? AND kodikos_geymatos = ?");
    $stmt->bind_param("ss", $store, $meal);
    $success = $stmt->execute();
    echo json_encode(["success" => $success]);
    $stmt->close();
    $conn->close();
    exit();
}

// UPDATE offer
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_method'] === 'PUT') {
    $oldStore = $_POST['oldStore'];
    $oldMeal = $_POST['oldMeal'];
    $newStore = $_POST['newStore'];
    $newMeal = $_POST['newMeal'];

    // Check if new pair already exists
    $check = $conn->prepare("SELECT * FROM PROSFORA WHERE kodikos_katasthmatos = ? AND kodikos_geymatos = ?");
    $check->bind_param("ss", $newStore, $newMeal);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Η προσφορά υπάρχει ήδη."]);
        $check->close();
        $conn->close();
        exit();
    }
    $check->close();

    // Perform update
    $stmt = $conn->prepare("UPDATE PROSFORA SET kodikos_katasthmatos = ?, kodikos_geymatos = ? WHERE kodikos_katasthmatos = ? AND kodikos_geymatos = ?");
    $stmt->bind_param("ssss", $newStore, $newMeal, $oldStore, $oldMeal);
    $success = $stmt->execute();
    echo json_encode(["success" => $success]);
    $stmt->close();
    $conn->close();
    exit();
}

// ADD offer
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['store']) && isset($_POST['meal']) && !isset($_POST['_method'])) {
    $store = $_POST['store'];
    $meal = $_POST['meal'];

    $check = $conn->prepare("SELECT * FROM PROSFORA WHERE kodikos_katasthmatos = ? AND kodikos_geymatos = ?");
    $check->bind_param("ss", $store, $meal);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Η προσφορά υπάρχει ήδη."]);
        $check->close();
        $conn->close();
        exit();
    }
    $check->close();

    $stmt = $conn->prepare("INSERT INTO PROSFORA (kodikos_katasthmatos, kodikos_geymatos) VALUES (?, ?)");
    $stmt->bind_param("ss", $store, $meal);
    $success = $stmt->execute();
    echo json_encode(["success" => $success]);
    $stmt->close();
    $conn->close();
    exit();
}

// GET all offers
$sql = "
    SELECT k.kodikos, k.poli, g.kodikos AS geyma_kodikos, g.onomasia AS geyma, g.timi
    FROM KATASTHMA k
    JOIN PROSFORA p ON k.kodikos = p.kodikos_katasthmatos
    JOIN GEYMA g ON p.kodikos_geymatos = g.kodikos
";

$result = $conn->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
$conn->close();
?>
