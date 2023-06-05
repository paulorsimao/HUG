<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Seguro de Imóveis - Clientes</title>
</head>
<body>
    <h1>Clientes</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Endereço</th>
            <th>Telefone</th>
        </tr>
        <?php
        // Conexão com o banco de dados PostgreSQL
        $conn = pg_connect("host=seu_host dbname=seu_banco_de_dados user=seu_usuario password=sua_senha");

        // Consulta para obter os clientes
        $query = "SELECT * FROM clientes";
        $result = pg_query($conn, $query);

        // Loop para exibir os clientes na tabela
        while ($row = pg_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['cliente_id'] . "</td>";
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['endereco'] . "</td>";
            echo "<td>" . $row['telefone'] . "</td>";
            echo "</tr>";
        }

        // Fechamento da conexão com o banco de dados
        pg_close($conn);
        ?>
    </table>
    <!-- Adicione aqui os botões e formulários para adicionar, editar e excluir clientes -->
</body>
</html>
