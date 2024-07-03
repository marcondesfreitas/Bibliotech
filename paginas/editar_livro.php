<?php
include_once "../php/dbconnect.php";

if (isset($_GET['cod_livro'])) {
    $cod_livro = $_GET['cod_livro'];

    $sql = "SELECT * FROM livros WHERE cod_livro = ?";
    $stmt = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $cod_livro);
    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);
    $livro = mysqli_fetch_assoc($query);

    if (!$livro) {
        die("Livro não encontrado.");
    }
} else {
    die("Código do livro não especificado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome_livro'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $ano = $_POST['ano'];
    $sinopse = $_POST['sinopse'];
    $quantidade = $_POST['quant'];

    $sql_update = "UPDATE livros SET nome = ?, autor = ?, editora = ?, ano = ?, sinopse = ?, quantidade = ? WHERE cod_livro = ?";
    $stmt_update = mysqli_prepare($conexao, $sql_update);
    mysqli_stmt_bind_param($stmt_update, 'ssssssi', $nome, $autor, $editora, $ano, $sinopse, $quantidade, $cod_livro);
    mysqli_stmt_execute($stmt_update);

    if (mysqli_affected_rows($conexao) > 0) {
        echo "<script>alert('Livro atualizado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao atualizar livro.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/editar_livro.css">

    <title>Editar Livro</title>
</head>

<body>
    <div class="container">
        <h1>Editar Livro</h1>
        <form action="" method="post">
            <div class="mb-3">
                <label for="nome_livro" class="form-label">Título do Livro</label>
                <input type="text" class="form-control" id="nome_livro" name="nome_livro" value="<?php echo htmlspecialchars($livro['nome']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" id="autor" name="autor" value="<?php echo htmlspecialchars($livro['autor']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="editora" class="form-label">Editora</label>
                <input type="text" class="form-control" id="editora" name="editora" value="<?php echo htmlspecialchars($livro['editora']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="ano" class="form-label">Ano</label>
                <input type="number" class="form-control" id="ano" name="ano" value="<?php echo htmlspecialchars($livro['ano']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="sinopse" class="form-label">Sinopse</label>
                <textarea class="form-control" id="sinopse" name="sinopse" rows="3" required><?php echo htmlspecialchars($livro['sinopse']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="quant" class="form-label">Quantidade</label>
                <input type="number" class="form-control" id="quant" name="quant" value="<?php echo htmlspecialchars($livro['quantidade']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="listar_livros.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>

</html>