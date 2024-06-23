
<html>
	<head>
		<style>
			
			.sla{
				border-style: double;
				border-color: #fff;
				background: #111;
				color: #fff;
				text-align: center;
				border-radius: 10px;
				font-size: 18px;

			}

		</style>
	</head>


<body>
 <div class="sla">
<?php
$email = $_POST['email'];
$senha = $_POST['senha'];

echo "Email: ", $email, "<br>";
echo "Senha: ", $senha, "<br>";
$arquivo = fopen("cadastro.txt", "w");

fwrite($arquivo, $email);
fwrite($arquivo, "");
fwrite($arquivo, $senha);

fclose($arquivo);

?>
</div>
</body>
</html>