<?php
//Dados do banco
require_once '../postgres.php';

//UPDATE
if (!empty($_POST)) {
    try {
      // Obtém o valor enviado pelo formulário
      $id_imovel   = $_POST['id_imovel'];
      $descricao    = $_POST['descricao'];
      $tipo         = $_POST['tipo'];
      $valor       = $_POST['valor'];
  
      // Prepara a query SQL para inserção
      $sql = "UPDATE imovel SET descricao = :descricao, tipo = :tipo, valor = :valor WHERE id_imovel = :id_imovel";
  
      // Preparar a SQL (pdo)
      $stmt = $pdo->prepare($sql);
  
      // Definir/organizar os dados p/ SQL
      $dados = array(
      ':id_imovel' => $id_imovel,
      ':descricao' => $descricao,
      ':tipo' => $tipo,
      ':valor' => $valor
      );
  
        // Tentar Executar a SQL (INSERT)
        // Realizar a inserção das informações no BD (com o PHP)
        if ($stmt->execute($dados)) {
          header("Location: imovel.php?msgSucesso=Atualização realizado com sucesso!");
        }
    } catch (PDOException $e) {
        //die($e->getMessage());
        header("Location: imovel.php?msgErro=Falha ao atualizar...");
    }
  }

  else {
    header("Location: imovel.php?msgErro=Erro de acesso - Atualizar.");
  }

die();

 ?>
