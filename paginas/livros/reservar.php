<?php
include_once "../../php/dbconnect.php";

$url = substr($_SERVER['REQUEST_URI'], -3);
$string = strval($url);
if(substr($string, -2, 1) === "="){
	$string = substr($_SERVER['REQUEST_URI'], -1);
}else if(substr($string, -3, 1) === "="){
	$string = substr($_SERVER['REQUEST_URI'], -2);
}
$sql = "SELECT * FROM livros where cod_livro = ". $string;
$query = mysqli_query($conexao, $sql);
$lista = mysqli_fetch_array($query);

$sql3 = mysqli_query($conexao, "SELECT imagem, tipo_imagem, id FROM foto_livro WHERE id = ".$lista['cod_livro']."");
$row = mysqli_fetch_array($sql3, MYSQLI_ASSOC); 
$id = $row['id'];
$tipo = $row["tipo_imagem"]; 
$bytes = $row["imagem"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../../styles/reservar.css">
    <title>Reservar</title>
</head>
<body>
	<a href="../../index.php">Voltar</a>
	<div id="tudo">
		<div id="imagem">
			<?php echo "<img src=data:image/jpg;base64,". base64_encode($bytes) ." />;"?>
		</div>
		<div id="corpo">
			<div id="titulo">
				<h1><?php echo $lista['nome'];?></h1>
			</div>
			<div id="autor">
				<h3><?php echo $lista['autor'];?></h3>
			</div>
			<div id="editor">
				<h3><?php echo $lista['editora'];?></h3>
			</div>
			<div id="ano">
				<h4><?php echo $lista['ano'];?></h4>
			</div>
			<div id="sinopse">
				<p><?php echo $lista['sinopse'];?></p>
			</div>
			<button><a href="../../php/dbreservar.php?livro=<?php echo $string;?>">Reservar</a></button>
		</div>
	</div>
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../scripts/mudar.js"></script>
</body>
</html>