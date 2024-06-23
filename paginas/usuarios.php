<?php
include_once "../php/dbconnect.php";

$sql = "SELECT * FROM `usuario` where ativo = 1";
$query = mysqli_query($conexao, $sql);
$lista = mysqli_fetch_array($query);
$total = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <a href="../index.php">Voltar</a>
    <table border="1" class="table table-striped">
        <tr>
            <td>Nome</td>
            <td>Serie</td>
            <td>Email</td>
            <td>Telefone</td>
            <td>Id</td>
            <td>Ação</td>
        </tr>
    <?php 
        if($total > 0){
            while($valor = mysqli_fetch_array($query)){ 
                
    ?>
        <tr>
            <td style="font-weight: bold;"><?php echo $valor['nome'];?></td>
            <td><?php echo $valor['serie'];?></td>
            <td><?php echo $valor['email'];?></td>
            <td><?php echo $valor['telefone'];?></td>
            <td><?php echo $valor['id'];?></td>
            <td><a href="editar.php?codigo=<?php echo $valor['id'];?>">Editar</a> 
            <a href="excluir.php?codigo=<?php echo $valor['id'];?>" onclick="certeza()">Excluir</a></td>
        </tr>
    <?php
            }
        }
    ?>
    </table>
</body>
</html>