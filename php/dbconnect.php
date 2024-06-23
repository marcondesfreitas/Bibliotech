<?php
$host = "localhost";
$user = "root";
$psw = "";
$dbname = "biblioteca";

$conexao = mysqli_connect($host, $user, $psw, $dbname);

if(!$conexao){
	die("Falha".mysqli_connect_error());
}else{
}
return $conexao;
?>