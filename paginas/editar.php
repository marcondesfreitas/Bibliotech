<?php
include_once "../php/dbconnect.php";

$url = substr($_SERVER['REQUEST_URI'], -3);
$string = strval($url);
if (substr($string, -2, 1) === "=") {
    $string = substr($_SERVER['REQUEST_URI'], -1);
} else if (substr($string, -3, 1) === "=") {
    $string = substr($_SERVER['REQUEST_URI'], -2);
}
$sql = "SELECT * FROM `usuario` where id = " . $string;
$query = mysqli_query($conexao, $sql);
$lista = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/editar_usuario.css">
    <title>Modificar Usuário</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .edit-input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .edit-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 12px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .edit-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Modificar Usuário</h1>
        <p>Clique nos campos abaixo para alterar:</p>
        <table>
            <tr>
                <th>Nome</th>
                <th>Série</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>ID</th>
            </tr>
            <tr>
                <td class="edit-field" onclick="mudar('nome')"><?php echo $lista['nome']; ?></td>
                <td class="edit-field" onclick="mudar('serie')"><?php echo $lista['serie']; ?></td>
                <td class="edit-field" onclick="mudar('email')"><?php echo $lista['email']; ?></td>
                <td class="edit-field" onclick="mudar('telefone')"><?php echo $lista['telefone']; ?></td>
                <td><?php echo $lista['id']; ?></td>
            </tr>
        </table>
        <br>
        <div>
            <form action="modificar.php?codigo=<?php echo $lista['id']; ?>" method="post" name="form" id="form">
                <input type="text" placeholder="Novo Nome" id="nome" name="nome" class="edit-input">
                <br>
                <select name="serie" id="serie" class="edit-input">
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
                <input type="text" placeholder="Novo Email" id="email" name="email" class="edit-input">
                <br>
                <input type="text" name="tel" id="tel" placeholder="Novo Telefone" class="edit-input">
                <br>
                <button class="edit-button" id="but" type="submit">Mudar</button>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../scripts/mudar.js"></script>
</body>

</html>
