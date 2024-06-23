<?php
include_once "dbconnect.php";

$pesquisa = $_POST['pesquisa'];

$sql = "SELECT * FROM livros where cod_livro = 1 or nome like '%$pesquisa%' or autor like '%$pesquisa%';";
$pesq = mysqli_query($conexao, $sql);

if (!isset($_SESSION)) session_start();

$_SESSION['Pesquisa'] = $sql;

echo "
    <script>
        window.location = '../index.php';
    </script>
";
?>