<?php
include_once "../php/dbconnect.php";

$sql = "SELECT * FROM livros";
$query = mysqli_query($conexao, $sql);
$total = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/listar_livros.css">
    <title>Listar Livros</title>
</head>

<body>
    <div class="container">
        <h1>Listagem de Livros</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Autor</th>
                    <th>Editora</th>
                    <th>Ano</th>
                    <th>Sinopse</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($total > 0) {
                    while ($livro = mysqli_fetch_assoc($query)) {
                        echo "<tr>";
                        echo "<td>{$livro['cod_livro']}</td>";
                        echo "<td>{$livro['nome']}</td>";
                        echo "<td>{$livro['autor']}</td>";
                        echo "<td>{$livro['editora']}</td>";
                        echo "<td>{$livro['ano']}</td>";
                        echo "<td>{$livro['sinopse']}</td>";
                        echo "<td>{$livro['quantidade']}</td>";
                        echo "<td>";
                        echo "<a href='editar_livro.php?cod_livro={$livro['cod_livro']}' class='btn btn-primary'>Editar</a> ";
                        echo "<a href='excluir_livro.php?cod_livro={$livro['cod_livro']}' class='btn btn-danger btn-excluir'>Excluir</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Nenhum livro encontrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="../index.php" class="btn btn-secondary">Voltar</a>
    </div>
</body>

</html>
