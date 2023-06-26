<?php

//Dados do banco
require_once '../postgres.php';

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
    <a class="navbar-brand" href="http://localhost:8000/sistema/index.php">HUG</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link text-light" href="http://localhost:8000/sistema/index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost:8000/sistema/imovel/imovel.php">Imóvel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost:8000/sistema/index.php">Mobília</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost:8000/sistema/index.php">Cliente</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost:8000/sistema/index.php">Apólice</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost:8000/sistema/index.php">Sinistro</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost:8000/sistema/index.php">Vistoria</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost:8000/sistema/index.php">Corretor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-light" href="http://localhost:8000/sistema/index.php">Histórico de operações</a>
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
            data-descricao="<?= $i['descricao'] ?>"
            data-tipo="<?= $i['tipo'] ?>"
            data-valor="<?= $i['valor'] ?>"
        >
          <td><?php echo $i['id_imovel'] ?></td>
          <td><?php echo $i['descricao'] ?></td>
          <td><?php echo $i['tipo'] ?></td>
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

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#relatorioModal">Abrir Relatório</button>
  </div>


<!-- Modal relatório-->
<div class="modal fade" id="relatorioModal" tabindex="-1" aria-labelledby="relatorioModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="relatorioModalLabel">Relatório de Imóveis</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="filtroDataInicial">Data Inicial:</label>
          <input type="date" class="form-control" id="filtroDataInicial">
        </div>
        <div class="form-group">
          <label for="filtroDataFinal">Data Final:</label>
          <input type="date" class="form-control" id="filtroDataFinal">
        </div>
        <button type="button" class="btn btn-primary" id="btnFiltrar">Filtrar</button>
        <hr>
        <div class="table-responsive">
          <table class="table d-none">
            <thead>
              <tr>
                <th style="width: 10%;">ID Imóvel</th>
                <th style="width: 15%;">Descrição</th>
                <th style="width: 10%;">ID Cliente</th>
                <th style="width: 15%;">Nome Cliente</th>
                <th style="width: 10%;">ID Corretor</th>
                <th style="width: 15%;">Nome Corretor</th>
                <th style="width: 10%;">ID Seguradora</th>
                <th style="width: 15%;">Nome Seguradora</th>
                <th style="width: 5%;">Qtd Apólices</th>
                <th style="width: 5%;">Valor Apólices</th>
                <th style="width: 5%;">Qtd Sinistros</th>
                <th style="width: 5%;">Valor Sinistros</th>
              </tr>
            </thead>
            <tbody>
              <!-- Conteúdo da tabela (será preenchido dinamicamente) -->
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('btnFiltrar').addEventListener('click', function() {
  var filtroDataInicial = document.getElementById('filtroDataInicial').value;
  var filtroDataFinal = document.getElementById('filtroDataFinal').value;

  // Verificar se as datas foram preenchidas
  if (filtroDataInicial && filtroDataFinal) {
    // Exibir a tabela
    var table = document.querySelector('#relatorioModal table');
    table.classList.remove('d-none');

    // Fazer a solicitação AJAX
    $.ajax({
      url: 'filtrar.php', // Arquivo PHP com a consulta ao banco de dados
      type: 'POST',
      data: {
        dataInicial: filtroDataInicial,
        dataFinal: filtroDataFinal
      },
      dataType: 'json', // Especificar o tipo de dados esperado na resposta

      success: function(response) {
        // Preencher a tabela com os dados retornados
        var tbody = table.querySelector('tbody');
        tbody.innerHTML = '';

        alert (response.length);

        for (var i = 0; i < response.length; i++) {
          var row = response[i];
          var newRow = document.createElement('tr');

          // Preencher cada célula da linha com os valores retornados
          var idImovelCell = document.createElement('td');
          idImovelCell.textContent = row.id_imovel;
          newRow.appendChild(idImovelCell);

          var descricaoCell = document.createElement('td');
          descricaoCell.textContent = row.descricao_imovel;
          newRow.appendChild(descricaoCell);

          var idClienteCell = document.createElement('td');
          idClienteCell.textContent = row.id_cliente;
          newRow.appendChild(idClienteCell);

          var nomeClienteCell = document.createElement('td');
          nomeClienteCell.textContent = row.nome_cliente;
          newRow.appendChild(nomeClienteCell);

          var idCorretorCell = document.createElement('td');
          idCorretorCell.textContent = row.id_corretor;
          newRow.appendChild(idCorretorCell);

          var nomeCorretorCell = document.createElement('td');
          nomeCorretorCell.textContent = row.nome_corretor;
          newRow.appendChild(nomeCorretorCell);

          var idSeguradoraCell = document.createElement('td');
          idSeguradoraCell.textContent = row.id_seguradora;
          newRow.appendChild(idSeguradoraCell);

          var nomeSeguradoraCell = document.createElement('td');
          nomeSeguradoraCell.textContent = row.nome_seguradora;
          newRow.appendChild(nomeSeguradoraCell);

          var qtdApolicesCell = document.createElement('td');
          qtdApolicesCell.textContent = row.qtd_apolices;
          newRow.appendChild(qtdApolicesCell);

          var valorApolicesCell = document.createElement('td');
          valorApolicesCell.textContent = row.valor_apolices;
          newRow.appendChild(valorApolicesCell);

          var qtdSinistrosCell = document.createElement('td');
          qtdSinistrosCell.textContent = row.qtd_sinistros;
          newRow.appendChild(qtdSinistrosCell);

          var valorSinistrosCell = document.createElement('td');
          valorSinistrosCell.textContent = row.valor_sinistros;
          newRow.appendChild(valorSinistrosCell);

          tbody.appendChild(newRow);
        }
      },
      error: function(xhr, status, error) {
        alert('Ocorreu um erro ao consultar os dados: ' + error);
      }
    });
  } else {
    // Ocultar a tabela
    document.querySelector('#relatorioModal table').classList.add('d-none');
  }
});


</script>





  <br><br><br>

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
              <label for="ldescricao">Endereço</label>
              <input type="text" class="form-control" id="descricao" name="descricao" required>
            </div>
            <div class="form-group">
              <label for="ltipo">Tipo do imóvel</label>
                <select class="form-control" id="tipo" name="tipo" rows="3" required>
                    <option value="Casa">Casa</option>
                    <option value="Apartamento">Apartamento</option>
                    <option value="Terreno">Terreno</option>
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
              <label for="ldescricao">Endereço</label>
              <input type="text" class="form-control" id="descricao" name="descricao" required>
            </div>
            <div class="form-group">
              <label for="ltipo">Tipo do imóvel</label>
                <select class="form-control" id="tipo" name="tipo" rows="3" required>
                    <option value="Casa">Casa</option>
                    <option value="Apartamento">Apartamento</option>
                    <option value="Terreno">Terreno</option>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <script>
   $(document).ready(function() {
    // Captura o evento de clique no botão de editar
    $('.edit-btn').on('click', function() {
        // Obtém o ID do item a ser editado
        var id = $(this).closest('tr').data('id');

        // Obtém os dados da linha correspondente na tabela
        var descricao = $(this).closest('tr').data('descricao');
        var tipoImovel = $(this).closest('tr').data('tipo');
        var valor = $(this).closest('tr').data('valor');

        // Preenche os campos do formulário de edição com os dados obtidos
        $('#editModal input[name="id_imovel"]').val(id);
        $('#editModal input[name="descricao"]').val(descricao);
        $('#editModal select[name="tipo"]').val(tipoImovel);
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

