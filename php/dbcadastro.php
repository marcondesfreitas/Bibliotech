<?php
include_once "dbconnect.php";

$nome = $_POST['nome'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$serie = $_POST['serie'];
$logado = null;

$confir = "SELECT email FROM `usuario` where email = '$email' and ativo = 1";
$query = mysqli_query($conexao, $confir);

if(mysqli_num_rows($query) > 0){
	echo "
		<script>
			alert('Email já cadastrado');
			window.location = '../paginas/cadastro/index.html';
		</script>
	";
	exit;
}


$sql= "INSERT INTO usuario values(null, '$nome', '$serie', '$email', sha1('$senha'), '$tel', 1, 1, now())";

mysqli_query($conexao, $sql);
echo "
<script>
	alert('Cadastrado');
	window.location = '../paginas/Login/index.html';
</script>
";

?>

