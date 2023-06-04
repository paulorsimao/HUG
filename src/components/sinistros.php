<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Seguro de Imóveis - Sinistros</title>
</head>
<body>
    <h1>Sinistros</h1>
    <table>
        <tr>
            <th>ID do Sinistro</th>
            <th>ID do Seguro</th>
            <th>Data do Sinistro</th>
            <th>Descrição</th>
            <th>Valor do Prejuízo</th>
        </tr>
        <?php
        // Conexão com o banco de dados PostgreSQL
        $conn = pg_connect("host=seu_host dbname=seu_banco_de_dados user=seu_usuario password=sua_senha");

        // Consulta para obter os sinistros
        $query = "SELECT * FROM sinistros";
        $result = pg_query($conn, $query);

        // Loop para exibir os sinistros na tabela
        while ($row = pg_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['sinistro_id'] . "</td>";
            echo "<td>" . $row['seguro_id'] . "</td>";
            echo "<td>" . $row['data_sinistro'] . "</td>";
            echo "<td>" . $row['descricao'] . "</td>";
            echo "<td>" . $row['valor_prejuizo'] . "</td>";
            echo "</tr>";
        }

        // Fechamento da conexão com o banco de dados
        pg_close($conn);
        ?>
    </table>
    <!-- Adicione aqui os botões e formulários para adicionar, editar e excluir sinistros -->
</body>
</html>
