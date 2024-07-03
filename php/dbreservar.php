<?php
include_once "dbconnect.php";

if (!isset($_SESSION)) session_start();

$url = substr($_SERVER['REQUEST_URI'], -3);
$string = strval($url);
if (substr($string, -2, 1) === "=") {
    $string = substr($_SERVER['REQUEST_URI'], -1);
} else if (substr($string, -3, 1) === "=") {
    $string = substr($_SERVER['REQUEST_URI'], -2);
}

$quant = "SELECT * FROM livros where cod_livro = " . $string;
$que = mysqli_query($conexao, $quant);
$lista = mysqli_fetch_array($que);

$n = ($lista['quantidade']) - 1;

$id_usu = $_SESSION['UsuarioID'];

$out_sql = "SELECT * FROM reservas where estado_reserva < 4 and cod_aluno = " . $id_usu;
$querryy = mysqli_query($conexao, $out_sql);
$total = mysqli_num_rows($querryy);

if ($total > 0) {
    echo "
    <script>
        alert('Você já fez uma reserva');
        window.location = '../index.php';
    </script>
    ";
} else {
    $sql_res = "INSERT INTO reservas values (null, '$id_usu', '$string', 1, now());";
    $query2 = mysqli_query($conexao, $sql_res);

    $sql2 = "UPDATE livros SET quantidade = '$n' where cod_livro = " . $string;
    $query3 = mysqli_query($conexao, $sql2);

    echo "
    <script>
        alert('Pedido de Reserva feito');
        window.location = '../index.php';
    </script>
    ";
}
