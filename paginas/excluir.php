<?php
include_once "../php/dbconnect.php";

$url = substr($_SERVER['REQUEST_URI'], -3);
$string = strval($url);
if(substr($string, -2, 1) === "="){
	$string = substr($_SERVER['REQUEST_URI'], -1);
}else if(substr($string, -3, 1) === "="){
	$string = substr($_SERVER['REQUEST_URI'], -2);
}
$sql = "UPDATE usuario set ativo = '0' where id = ". $string;
$query = mysqli_query($conexao, $sql);
echo"
<script>
	alert('Usuario excluido');
	window.location = 'usuarios.php';
</script>
"; 

?>