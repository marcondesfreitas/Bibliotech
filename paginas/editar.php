<?php
include_once "../php/dbconnect.php";

$url = substr($_SERVER['REQUEST_URI'], -3);
$string = strval($url);
if(substr($string, -2, 1) === "="){
	$string = substr($_SERVER['REQUEST_URI'], -1);
}else if(substr($string, -3, 1) === "="){
	$string = substr($_SERVER['REQUEST_URI'], -2);
}
$sql = "SELECT * FROM `usuario` where id = ". $string;
$query = mysqli_query($conexao, $sql);
$lista = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Clique em cima para alterar<br></p>
    <table border="1">
        <tr>
            <td>Nome</td>
            <td>Serie</td>
            <td>Email</td>
            <td>Telefone</td>
            <td>Id</td>
        </tr>
        <tr>
            <td onclick="mudar('nome')"><?php echo $lista['nome'];?></td>
            <td onclick="mudar('serie')"><?php echo $lista['serie'];?></td>
            <td onclick="mudar('email')"><?php echo $lista['email'];?></td>
            <td onclick="mudar('telefone')"><?php echo $lista['telefone'];?></td>
            <td><?php echo $lista['id'];?></td>
        </tr>
    </table>
    <br>
    <div>
        <form action="modificar.php?codigo=<?php echo $lista['id'];?>" method="post" name="form" id="form">
            <input type="text" placeholder="Novo Nome" id="nome" name="nome" class="eita">
            <br>
            <select name="serie" id="serie" class="eita">
                <option value="1°A">1°A</option>
                <option value="1°B">1°B</option>
                <option value="1°C">1°C</option>
                <option value="1°D">1°D</option>
                <option value="2°A">2°A</option>
                <option value="2°B">2°B</option>
                <option value="2°C">2°C</option>
                <option value="2°D">2°D</option>
                <option value="3°A">3°A</option>
                <option value="3°B">3°B</option>
                <option value="3°C">3°C</option>
                <option value="3°D">3°D</option>
            </select>
            <br>
            <input type="text" placeholder="Novo Email" id="email" name="email" class="eita">
            <br>
            <input type="telefone" name="tel" id="tel" placeholder="Novo Telefone" class="eita">
            <br>
            <button class="eita" id="but" type="submit">Mudar</button>
        </form>
    </div>
    <style>
        .eita{
            display: none;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../scripts/mudar.js"></script>
</body>
</html>