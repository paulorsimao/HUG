<?php

//Dados do banco
require_once 'postgres.php';

$imoveis = array();

$sql = "SELECT * FROM imovel ORDER BY id_imovel ASC";

try {
  $stmt = $pdo->prepare($sql);
  if ($stmt->execute()) {
    $imoveis = $stmt->fetchAll();
  }
  else {
    die("Falha na execução do SQL");
  }
}
catch (PDOException $e) {
  die($e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>HUG - House Unforeseens Guardian</title>

</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="http://localhost:8000/index.php">HUG</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link text-light" href="http://localhost:8000/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost:8000/imovel.php">Imóvel <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost:8000/mobilia.php">Mobília</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost:8000/cliente.php">Cliente</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost:8000/apolice.php">Apólice</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost:8000/sinistro.php">Sinistro</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost:8000/vistoria.php">Vistoria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost:8000/corretor.php">Corretor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost:8000/historico.php">Histórico de operações</a>
        </li>
      </ul>
    </div>
  </nav>

  <br>

  <div class="container">
    <h1>Lista de Imóveis</h1>
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Endereço</th>
          <th>Tipo do imóvel</th>
          <th>Valor</th>
        </tr>
      </thead>
      <tbody>

      <?php if (!empty($imoveis)) { 
        foreach ($imoveis as $i) {
      ?>

        <tr data-id="<?= $i['id_imovel'] ?>"
            data-endereco="<?= $i['endereco'] ?>"
            data-tipo="<?= $i['tipo_imovel'] ?>"
            data-valor="<?= $i['valor'] ?>"
        >
          <td><?php echo $i['id_imovel'] ?></td>
          <td><?php echo $i['endereco'] ?></td>
          <td><?php if ($i['tipo_imovel'] === 1) {
                       echo "Casa";
                    } 
                    else {
                      echo "Apartamento";
                    }  ?></td>
          <td><?php echo $i['valor'] ?></td>
          <td>
            <a href="#" class="btn btn-primary btn-sm edit-btn" data-toggle="modal" data-target="#editModal">Editar</a>
            <a href="#" class="btn btn-danger btn-sm delete-btn" data-toggle="modal" data-target="#deleteModal">Excluir</a>
          </td>
        </tr>

        <?php 
          }} 
        ?>

      </tbody>
    </table>

    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addModal">Novo Item</a>
  </div>

  <!-- Modal de Adição -->
  <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Adicionar Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Formulário de Adição -->
          <form method="POST" action="imovel_insere.php">
            <div class="form-group">
              <label for="lendereco">Endereço</label>
              <input type="text" class="form-control" id="endereco" name="endereco" required>
            </div>
            <div class="form-group">
              <label for="ltipo_imovel">Tipo do imóvel</label>
                <select class="form-control" id="tipo_imovel" name="tipo_imovel" rows="3" required>
                    <option value="1">Casa</option>
                    <option value="2">Apartamento</option>
                </select>
            </div>
            <div class="form-group">
              <label for="lvalor">Valor</label>
              <input type="number" step="0.01" min="0" class="form-control" id="valor" name="valor" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de Edição -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Editar Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Formulário de Edição -->
          <form method="POST" action="imovel_atualiza.php">
            <div class="form-group">
              <label for="lid_imovel">ID</label>
              <input type="number" class="form-control" id="id_imovel" name="id_imovel" required readonly>
            </div>
            <div class="form-group">
              <label for="lendereco">Endereço</label>
              <input type="text" class="form-control" id="endereco" name="endereco" required>
            </div>
            <div class="form-group">
              <label for="ltipo_imovel">Tipo do imóvel</label>
                <select class="form-control" id="tipo_imovel" name="tipo_imovel" rows="3" required>
                    <option value="1">Casa</option>
                    <option value="2">Apartamento</option>
                </select>
            </div>
            <div class="form-group">
              <label for="lvalor">Valor</label>
              <input type="number" step="0.01" min="0" class="form-control" id="valor" name="valor" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal de Exclusão -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Excluir Item</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="POST" action="imovel_deleta.php">
        <input type="hidden" id="id_imovel" name="id_imovel">
          <p>Deseja realmente excluir este item?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Excluir</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <footer class="footer bg-primary text-light" style="width: 100%; bottom: 0; position: fixed;">
    <div class="container-fluid text-center">
      <span>&copy; 2023 hug.com, Inc. ou suas afiliadas</span>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
   $(document).ready(function() {
    // Captura o evento de clique no botão de editar
    $('.edit-btn').on('click', function() {
        // Obtém o ID do item a ser editado
        var id = $(this).closest('tr').data('id');

        // Obtém os dados da linha correspondente na tabela
        var endereco = $(this).closest('tr').data('endereco');
        var tipoImovel = $(this).closest('tr').data('tipo');
        var valor = $(this).closest('tr').data('valor');

        // Preenche os campos do formulário de edição com os dados obtidos
        $('#editModal input[name="id_imovel"]').val(id);
        $('#editModal input[name="endereco"]').val(endereco);
        $('#editModal select[name="tipo_imovel"]').val(tipoImovel);
        $('#editModal input[name="valor"]').val(valor);
    });
});

$(document).ready(function() {
    // Captura o evento de clique no botão de editar
    $('.delete-btn').on('click', function() {
        // Obtém o ID do item a ser editado
        var id = $(this).closest('tr').data('id');

        // Preenche os campos do formulário de edição com os dados obtidos
        $('#deleteModal input[name="id_imovel"]').val(id);
    });
});
</script>

</body>
</html>

