<?php
$host = "localhost";
$db   = "picagens";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) { die("Erro: " . $conn->connect_error); }

$tipo = $_GET['tipo'] ?? 'status';
$labels = [];
$valores = [];

if ($tipo === 'status') {
    $sql = "SELECT status, COUNT(*) as total FROM ors GROUP BY status";
} elseif ($tipo === 'funcionario') {
    $sql = "SELECT f.name, COUNT(o.id_picagens) as total
            FROM funcionarios f
            JOIN ors o ON f.id = o.id_funcionario
            GROUP BY f.name";
} elseif ($tipo === 'oficina') {
    $sql = "SELECT g.location, COUNT(o.id_picagens) as total
            FROM garages g
            JOIN ors o ON g.id_garage = o.id_oficina
            GROUP BY g.location";
}

$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $labels[] = $row[array_key_first($row)];
    $valores[] = $row['total'];
}
$conn->close();

echo json_encode(["labels" => $labels, "valores" => $valores]);
?>
