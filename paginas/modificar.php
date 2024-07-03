<?php
include_once "../php/dbconnect.php";

$url = substr($_SERVER['REQUEST_URI'], -3);
$string = strval($url);
if (substr($string, -2, 1) === "=") {
    $string = substr($_SERVER['REQUEST_URI'], -1);
} else if (substr($string, -3, 1) === "=") {
    $string = substr($_SERVER['REQUEST_URI'], -2);
}
$sql = "SELECT * FROM `usuario` where id = " . $string;
$query = mysqli_query($conexao, $sql);
$lista = mysqli_fetch_array($query);

$nome = $_POST['nome'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$serie = $_POST['serie'];

if ($nome == null) {
    $nome = $lista['nome'];
}
if ($tel == null) {
    $tel = $lista['telefone'];
}
if ($email == null) {
    $email = $lista['email'];
}
if ($serie == null) {
    $serie = $lista['serie'];
}

$sql2 = "UPDATE `usuario` SET `nome`='$nome',`serie`='$serie',`email`='$email',`telefone`='$tel' where id = " . $string;
$query2 = mysqli_query($conexao, $sql2);
echo "
<script>
	alert('Modificado');
	window.location = 'usuarios.php';
</script>
";
