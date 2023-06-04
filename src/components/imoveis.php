<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Seguro de Imóveis - Imóveis</title>
</head>
<body>
    <h1>Imóveis</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Endereço</th>
            <th>Tipo de Imóvel</th>
            <th>Valor</th>
        </tr>
        <?php
        // Conexão com o banco de dados PostgreSQL
        $conn = pg_connect("host=seu_host dbname=seu_banco_de_dados user=seu_usuario password=sua_senha");

        // Consulta para obter os imóveis
        $query = "SELECT * FROM imoveis";
        $result = pg_query($conn, $query);

        // Loop para exibir os imóveis na tabela
        while ($row = pg_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['imovel_id'] . "</td>";
            echo "<td>" . $row['endereco'] . "</td>";
            echo "<td>" . $row['tipo_imovel'] . "</td>";
            echo "<td>" . $row['valor_imovel'] . "</td>";
            echo "</tr>";
        }

        // Fechamento da conexão com o banco de dados
        pg_close($conn);
        ?>
    </table>
    <!-- Adicione aqui os botões e formulários para adicionar, editar e excluir imóveis -->
</body>
</html>
