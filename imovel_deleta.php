<?php
//Dados do banco
require_once 'postgres.php';

//UPDATE
if (!empty($_POST)) {
    try {
      // Obtém o valor enviado pelo formulário
      $id_imovel = $_POST['id_imovel'];
  
      // Prepara a query SQL para inserção
      $sql = "DELETE FROM imovel WHERE id_imovel = :id_imovel";
  
      // Preparar a SQL (pdo)
      $stmt = $pdo->prepare($sql);
  
      // Definir/organizar os dados p/ SQL
      $dados = array(
      ':id_imovel' => $id_imovel
      );
  
        // Tentar Executar a SQL (INSERT)
        // Realizar a inserção das informações no BD (com o PHP)
        if ($stmt->execute($dados)) {
          header("Location: imovel.php?msgSucesso=Exclusão realizado com sucesso!");
        }
    } catch (PDOException $e) {
        //die($e->getMessage());
        header("Location: imovel.php?msgErro=Falha ao Excluir...");
    }
  }

  else {
    header("Location: imovel.php?msgErro=Erro de acesso - Excluir.");
  }

die();

 ?>