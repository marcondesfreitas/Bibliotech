<?php
include_once "../php/dbconnect.php";

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['cod_livro'])) {
    $cod_livro = $_GET['cod_livro'];

    // Query para deletar o livro
    $delete_sql = "DELETE FROM livros WHERE cod_livro = ?";
    $stmt = mysqli_prepare($conexao, $delete_sql);
    mysqli_stmt_bind_param($stmt, 'i', $cod_livro);
    mysqli_stmt_execute($stmt);

    // Verifica se a deleção foi bem sucedida
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Redireciona de volta para a página de listagem de livros após a exclusão
        header("Location: listar_livros.php");
        exit();
    } else {
        echo "Erro ao excluir o livro.";
    }
} else {
    echo "Requisição inválida.";
}
?>
