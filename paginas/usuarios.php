<?php
include_once "../php/dbconnect.php";

$sql = "SELECT * FROM `usuario` where ativo = 1";
$query = mysqli_query($conexao, $sql);
$total = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap.min.css">
    <title>Usuários Ativos</title>
    <link rel="stylesheet" href="../styles/usuarios.css">
</head>

<body>
    <div class="container">
        <h1>Usuários Ativos</h1>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Série</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>ID</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($total > 0): ?>
                    <?php while ($valor = mysqli_fetch_array($query)): ?>
                        <tr>
                            <td style="font-weight: bold;"><?php echo htmlspecialchars($valor['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($valor['serie'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($valor['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($valor['telefone'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($valor['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a href="editar.php?codigo=<?php echo $valor['id']; ?>" class="btn btn-primary">Editar</a>
                                <a href="excluir.php?codigo=<?php echo $valor['id']; ?>" class="btn btn-secondary" onclick="return confirm('Você tem certeza que deseja excluir?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Nenhum usuário ativo encontrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="../index.php" class="btn btn-secondary">Voltar</a>
    </div>
</body>

</html>