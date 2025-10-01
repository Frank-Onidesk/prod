<?php
header('Content-Type: application/json');

// Ligar à BD
$mysqli = new mysqli("localhost", "root", "", "picagens");

if ($mysqli->connect_errno) {
    echo json_encode(["error" => "Erro na ligação à BD: " . $mysqli->connect_error]);
    exit;
}

// Receber variáveis do AJAX
$varX = $_POST['varX'] ?? 'function';
$varY = $_POST['varY'] ?? 'COUNT(*)';

// Mapear colunas permitidas
$colunasPermitidas = ['function', 'id_oficina', 'status'];
$metricasPermitidas = ['COUNT(*)', 'SUM(horas)', 'AVG(horas)'];

// Validar variáveis
if (!in_array($varX, $colunasPermitidas)) $varX = 'function';
if (!in_array($varY, $metricasPermitidas)) $varY = 'COUNT(*)';

// Escapar colunas permitidas (precaução extra)
$varX = $mysqli->real_escape_string($varX);

// Construir query dinâmica
$sql = "SELECT `$varX` AS categoria, {$varY} AS valor
        FROM funcionarios
        GROUP BY `$varX`";

$result = $mysqli->query($sql);

if (!$result) {
    echo json_encode(["error" => "Erro na query: " . $mysqli->error]);
    exit;
}

$labels = [];
$values = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['categoria'];
    $values[] = $row['valor'];
}

echo json_encode([
    "labels" => $labels,
    "values" => $values
]);

$mysqli->close();
