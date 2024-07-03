<?php
$path_to_dbconnect = "../php/dbconnect.php";

if (file_exists($path_to_dbconnect)) {
    include_once $path_to_dbconnect;
} else {
    die("Erro: Arquivo dbconnect.php não encontrado.");
}

if (!isset($_SESSION)) session_start();

if (!$conexao) {
    die("Erro: Conexão com o banco de dados falhou.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cod_reserva']) && isset($_POST['estado_reserva'])) {
    $cod_reserva = $_POST['cod_reserva'];
    $estado_reserva = $_POST['estado_reserva'];

    $reserva_sql = "SELECT cod_livro, estado_reserva FROM reservas WHERE cod_reserva = ?";
    $stmt = mysqli_prepare($conexao, $reserva_sql);
    mysqli_stmt_bind_param($stmt, 'i', $cod_reserva);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $reserva = mysqli_fetch_assoc($result);

    if ($reserva && $reserva['estado_reserva'] != $estado_reserva) {
        $update_sql = "UPDATE reservas SET estado_reserva = ? WHERE cod_reserva = ?";
        $stmt = mysqli_prepare($conexao, $update_sql);
        mysqli_stmt_bind_param($stmt, 'ii', $estado_reserva, $cod_reserva);
        mysqli_stmt_execute($stmt);

        if ($estado_reserva == 4) {
            $cod_livro = $reserva['cod_livro'];
            $increment_sql = "UPDATE livros SET quantidade = quantidade + 1 WHERE cod_livro = ?";
            $stmt = mysqli_prepare($conexao, $increment_sql);
            mysqli_stmt_bind_param($stmt, 'i', $cod_livro);
            mysqli_stmt_execute($stmt);
        }
    }
}

$out_sql = "SELECT r.*, u.nome AS usuario_nome, l.nome AS livro_nome 
            FROM reservas r 
            JOIN usuario u ON r.cod_aluno = u.id 
            JOIN livros l ON r.cod_livro = l.cod_livro";
$querryy = mysqli_query($conexao, $out_sql);
$total = mysqli_num_rows($querryy);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/ver_reservas.css">
    <title>Reservas</title>
</head>

<body>
    <div class="container">
        <h1>Lista de Reservas</h1>
        <table>
            <thead>
                <tr>
                    <th>Nome do Livro</th>
                    <th>Nome do Usuário</th>
                    <th>Código da Reserva</th>
                    <th>Data da Reserva</th>
                    <th>Estado da Reserva</th>
                    <th>Alterar Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($total > 0): ?>
                    <?php while ($valor = mysqli_fetch_array($querryy)): ?>
                        <?php
                        $data_reserva = new DateTime($valor['data_reserva']);
                        $hoje = new DateTime();
                        $dias_passados = $data_reserva->diff($hoje)->days;
                        $overdue = $dias_passados > 7 ? 'overdue' : '';
                        ?>
                        <tr class="<?php echo $overdue; ?>">
                            <td style="font-weight: bold;"><?php echo htmlspecialchars($valor['livro_nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($valor['usuario_nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($valor['cod_reserva'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($valor['data_reserva'], ENT_QUOTES, 'UTF-8'); ?></td>
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
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="cod_reserva" value="<?php echo $valor['cod_reserva']; ?>">
                                    <select name="estado_reserva" class="form-control">
                                        <option value="1" <?php if ($valor['estado_reserva'] == 1) echo 'selected'; ?>>Pedido de reserva em andamento</option>
                                        <option value="2" <?php if ($valor['estado_reserva'] == 2) echo 'selected'; ?>>Reserva feita, aproveite o livro!</option>
                                        <option value="3" <?php if ($valor['estado_reserva'] == 3) echo 'selected'; ?>>Livro atrasado, faça a devolução!</option>
                                        <option value="4" <?php if ($valor['estado_reserva'] == 4) echo 'selected'; ?>>Livro entregue</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary mt-2">Atualizar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Nenhuma reserva encontrada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="../index.php" class="btn btn-secondary">Voltar</a>
    </div>
</body>

</html>