<?php
    if (!isset($_SESSION)) session_start();
        
    $adm = 0;
    $logado = 0;
    $nivel_necessario = 2;
    if (!isset($_SESSION['UsuarioID']) OR ($_SESSION['UsuarioNivel'] < $nivel_necessario)) {
        $logado = 1;
        $adm = 1;
    }
    if($_SESSION['UsuarioNivel'] > $nivel_necessario){
        $logado = 1;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">
    <title>Conta</title>
</head>
<body>
    <a href="../index.php">Voltar</a>
    <br>    
    <table border="1" class="table table-striped">
        <tr>
            <td>Nome</td>
            <td>Serie</td>
            <td>Email</td>
            <td>Telefone</td>
        </tr>
        <tr>
            <td><?php echo $_SESSION['UsuarioNome'];?></td>
            <td><?php echo $_SESSION['UsuarioSerie'];?></td>
            <td><?php echo $_SESSION['UsuarioEmail'];?></td>
            <td><?php echo $_SESSION['UsuarioTel'];?></td>
        </tr>
    </table>
</body>
</html>