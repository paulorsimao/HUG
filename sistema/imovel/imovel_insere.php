<?php
//Dados do banco
require_once '../postgres.php';

//INSERT
if (!empty($_POST)) {
  try {
    // Obtém o valor enviado pelo formulário
    $descricao    = $_POST['descricao'];
    $tipo        = $_POST['tipo'];
    $valor       = $_POST['valor'];

    // Prepara a query SQL para inserção
    $sql = "INSERT INTO imovel (descricao, tipo, valor, id_seguradora, id_cliente) VALUES (:descricao, :tipo, :valor, 1, 1)";

    // Preparar a SQL (pdo)
    $stmt = $pdo->prepare($sql);

    // Definir/organizar os dados p/ SQL
    $dados = array(
    ':descricao' => $descricao,
    ':tipo' => $tipo,
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
