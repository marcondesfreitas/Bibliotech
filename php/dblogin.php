<?php
include_once "dbconnect.php";

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM `usuario` WHERE (`email` = '".$email ."') AND (`senha` = '". sha1($senha) ."') AND (`ativo` = 1) LIMIT 1";
$query = mysqli_query($conexao, $sql);

if (mysqli_num_rows($query) != 1) {
	echo "<script>alert('Conta inexistente');
	window.location = '../paginas/Login/index.html';</script>"; 
}else {
	$resultado = mysqli_fetch_assoc($query);

	if (!isset($_SESSION)) session_start();

	$_SESSION['UsuarioID'] = $resultado['id'];
	$_SESSION['UsuarioNome'] = $resultado['nome'];
	$_SESSION['UsuarioEmail'] = $resultado['email'];
	$_SESSION['UsuarioSerie'] = $resultado['serie'];
	$_SESSION['UsuarioSenha'] = $resultado['senha'];
	$_SESSION['UsuarioTel'] = $resultado['telefone'];
	$_SESSION['UsuarioNivel'] = $resultado['nivel'];

	echo "<script>alert('login feito');
	window.location = '../index.php';</script>";
}
?>