<?php
include_once "../../php/dbconnect.php";

if (!isset($_SESSION)) session_start();

$id_usu = $_SESSION['UsuarioID'];

$out_sql = "SELECT * FROM reservas WHERE cod_reserva = 1 OR cod_aluno = ?";
$stmt = mysqli_prepare($conexao, $out_sql);
mysqli_stmt_bind_param($stmt, 'i', $id_usu);
mysqli_stmt_execute($stmt);
$querryy = mysqli_stmt_get_result($stmt);

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
        if ($total > 0) {
            while ($valor = mysqli_fetch_array($querryy)) {
                // Use prepared statements for the second query as well
                $sql = "SELECT * FROM livros WHERE cod_livro = ?";
                $stmt2 = mysqli_prepare($conexao, $sql);
                mysqli_stmt_bind_param($stmt2, 'i', $valor['cod_livro']);
                mysqli_stmt_execute($stmt2);
                $query = mysqli_stmt_get_result($stmt2);
                $lista2 = mysqli_fetch_array($query);

                if ($lista2) {
        ?>
                    <tr>
                        <td style="font-weight: bold;"><?php echo htmlspecialchars($lista2['nome']); ?></td>
                        <td><?php echo htmlspecialchars($valor['cod_reserva']); ?></td>
                        <td><?php echo htmlspecialchars($valor['data_reserva']); ?></td>
                        <td><?php
                            switch ($valor['estado_reserva']) {
                                case 1:
                                    echo "Pedido de reserva em andamento";
                                    break;
                                case 2:
                                    echo "Reserva feita, aproveite o livro!";
                                    break;
                                case 3:
                                    echo "Livro atrasado, faça a devolução!";
                                    break;
                                default:
                                    echo "Livro entregue";
                            }
                            ?></td>
                    </tr>
        <?php
                }
            }
        }
        ?>
    </table>
</body>

</html>