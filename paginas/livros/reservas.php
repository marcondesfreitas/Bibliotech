<?php
include_once "../../php/dbconnect.php";

if (!isset($_SESSION)) session_start();

$id_usu = $_SESSION['UsuarioID'];

$out_sql = "SELECT * FROM reservas where cod_reserva = 1 or cod_aluno = $id_usu";
$querryy = mysqli_query($conexao, $out_sql);
$lista = mysqli_fetch_array($querryy);
$total = mysqli_num_rows($querryy);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap/bootstrap.min.css">
    <title>Reservas</title>
</head>
<body>
    <a href="../../index.php">Voltar</a>
    <table border="1" class="table table-striped">
        <tr>
            <td>Nome do Livro</td>
            <td>Código da Reserva</td>
            <td>Data da Reserva</td>
            <td>Estado da Reserva</td>
        </tr>
    <?php 
        if($total > 0){
            while($valor = mysqli_fetch_array($querryy)){ 
                $sql = "SELECT * FROM livros where cod_livro = ". $valor['cod_livro'];
                $query = mysqli_query($conexao, $sql);
                $lista2 = mysqli_fetch_array($query);
                                
    ?>
        <tr>
            <td style="font-weight: bold;"><?php echo $lista2['nome'];?></td>
            <td><?php echo $valor['cod_reserva'];?></td>
            <td><?php echo $valor['data_reserva'];?></td>
            <td><?php 
                if($valor['estado_reserva'] == 1){
                    echo "Pedido de reserva em andamento";
                }else if($valor['estado_reserva'] == 2){
                    echo "Reserva feita, aproveite o livro!";
                }else if($valor['estado_reserva'] == 3){
                    echo "Livro atrasado, faça a devolução!";
                }else{
                    echo "Livro entregue";
                }
                ?></td>
        </tr>
    <?php
            }
        }
    ?>
    </table>
</body>
</html>