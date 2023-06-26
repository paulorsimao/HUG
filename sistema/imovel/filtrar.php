<?php
require_once '../postgres.php';

// Obtenha os valores de data
$dataInicial = $_POST['dataInicial'];
$dataFinal = $_POST['dataFinal'];

// Converta as datas para o formato desejado (yyyy-mm-dd)
$dataInicialFormatted = date('Y-m-d', strtotime($dataInicial));
$dataFinalFormatted = date('Y-m-d', strtotime($dataFinal));

// Realize a consulta SQL
$query = "SELECT * FROM relatorio_imovel(:dataInicial, :dataFinal) ORDER BY id_imovel";

// Prepare a consulta
$stmt = $pdo->prepare($query);
$stmt->bindValue(':dataInicial', $dataInicialFormatted);
$stmt->bindValue(':dataFinal', $dataFinalFormatted);

// Execute a consulta
$stmt->execute();

// Obtenha os resultados em um array
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Converta o array em JSON
$jsonData = json_encode($results);

// Retorne o JSON
header('Content-Type: application/json');
echo $jsonData;
?>
