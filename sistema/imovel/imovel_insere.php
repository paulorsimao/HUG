<?php
//Dados do banco
require_once 'postgres.php';

//INSERT
if (!empty($_POST)) {
  try {
    // Obtém o valor enviado pelo formulário
    $endereco    = $_POST['endereco'];
    $tipo_imovel = $_POST['tipo_imovel'];
    $valor       = $_POST['valor'];

    // Prepara a query SQL para inserção
    $sql = "INSERT INTO imovel (endereco, tipo_imovel, valor) VALUES (:endereco, :tipo_imovel, :valor)";

    // Preparar a SQL (pdo)
    $stmt = $pdo->prepare($sql);

    // Definir/organizar os dados p/ SQL
    $dados = array(
    ':endereco' => $endereco,
    ':tipo_imovel' => $tipo_imovel,
    ':valor' => $valor
    );

      // Tentar Executar a SQL (INSERT)
      // Realizar a inserção das informações no BD (com o PHP)
      if ($stmt->execute($dados)) {
        header("Location: imovel.php?msgSucesso=Cadastro realizado com sucesso!");
      }
  } catch (PDOException $e) {
      //die($e->getMessage());
      header("Location: imovel.php?msgErro=Falha ao cadastrar...");
  }
}

  else {
    header("Location: imovel.php?msgErro=Erro de acesso.");
  }

die();

 ?>
