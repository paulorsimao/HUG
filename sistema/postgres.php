<?php
include('load_env.php');
try {
  $pdo = new PDO("pgsql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

} catch (PDOException $e) {
  echo "Falha ao conectar ao banco de dados. <br/>" . $e;
  die($e->getMessage());
}

?>