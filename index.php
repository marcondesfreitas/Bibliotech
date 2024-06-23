<?php
include_once "php/dbconnect.php";

if (!isset($_SESSION)) session_start();

if ($_SESSION['Pesquisa'] != null) {
    $sql_pe = $_SESSION['Pesquisa'];
    $query = mysqli_query($conexao, $sql_pe);
    $lista = mysqli_fetch_array($query);
    $total = mysqli_num_rows($query);
    $_SESSION['Pesquisa'] = null;
} else {
    $sql = "SELECT * FROM livros";
    $query = mysqli_query($conexao, $sql);
    $lista = mysqli_fetch_array($query);
    $total = mysqli_num_rows($query);
    $_SESSION['Pesquisa'] = null;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <title>Bibliotech</title>
</head>

<body>
    <?php
    if (!isset($_SESSION)) session_start();

    $adm = 1;
    $logado = 0;
    $nivel_necessario = 2;

    if (!isset($_SESSION['UsuarioID']) || !isset($_SESSION['UsuarioNome'])) {
        $_SESSION['UsuarioID'] = null;
        $_SESSION['UsuarioNome'] = null;
        $_SESSION['UsuarioEmail'] = null;
        $_SESSION['UsuarioSenha'] = null;
        $_SESSION['UsuarioTel'] = null;
        $_SESSION['UsuarioNivel'] = null;
        $adm = 1;
        $logado = 0;
    }
    if (($_SESSION['UsuarioID'] != null) && ($_SESSION['UsuarioNivel'] < $nivel_necessario)) {
        $logado = 1;
        $adm = 1;
    } else if (($_SESSION['UsuarioID'] != null) && ($_SESSION['UsuarioNivel'] = $nivel_necessario)) {
        $logado = 1;
        $adm = 0;
    }
    ?>
    <header>
        <div id="logo">
            <img src="imagens/mod_icone.png" alt="">
        </div>
        <div class="pesquisa">
            <form action="php/dbpesquisa.php" style="display:flex;" method="post">
                <input type="text" class="inpu" id="input" placeholder="pesquisar (livro ou autor)" name="pesquisa" onkeyup="procurar()">
                <button id="button" class="botao_pes" onclick="eitapeste()">
                    <img src="./imagens/lupa.svg" alt="" class="lupa">
                </button>
            </form>
        </div>
        <div id="login">
            <?php
            if ($logado == 1) {
                echo "<div id=conta>";
                echo "<img src=imagens/icone.png id=perfil>";
                echo "<a href=paginas/conta.php>" . $_SESSION['UsuarioNome'] . "</a><br>";
                echo "<div id=abrir onclick=seta()><a href=#><img src=imagens/seta.png id=stn></a></div>";
                echo "</div>";
                if ($adm == 0) {
                    echo "<div id=func>";
                    echo "<div id=j1><a href=paginas/usuarios.php>Tabela Usuarios</a></div><hr>";
                    echo "<div id=j2><a href=paginas/livros/cadastrar_livro.html>Cadastrar Livro</a></div><hr>";
                    echo "<div id=j2><a href=paginas/livros/ver_registro.php>Ver Registros</a></div><hr>";
                    echo "<div id=j3><a href=paginas/logout.php>Logout</a><br></div>";
                    echo "</div>";
                } else if ($adm == 1) {
                    echo "<div id=func>";
                    echo "<div id=j1><a href=paginas/livros/reservas.php>Reservasㅤㅤ</a></div><hr>";
                    echo "<div id=j3><a href=paginas/logout.php>Logout</a><br></div>";
                    echo "</div>";
                }
            } else {
                echo "<a href=paginas/Login/index.html>Logar</a>";
            }
            ?>

        </div>
    </header>
    <aside>

    </aside>
    <div id="article">
        <?php
        if ($total > 0) {
            $n = 0;
            while ($valor = mysqli_fetch_array($query)) {
                $n = $valor['cod_livro'] + 1;
                if ($valor['quantidade'] == 0) {
                    echo "<span class=uepa id=black" . $valor['cod_livro'] . " style=display:none;>00" . $valor['cod_livro'] . "</span>";
                }
                echo "<div class=bloco id='n" . $n . "'>";
        ?>

                <div id="foto">
                    <?php
                    $sql3 = mysqli_query($conexao, "SELECT imagem, tipo_imagem, id FROM foto_livro WHERE id = " . $valor['cod_livro'] . "");
                    $row = mysqli_fetch_array($sql3, MYSQLI_ASSOC);
                    $id = $row['id'];
                    $tipo = $row["tipo_imagem"];
                    $bytes = $row["imagem"];

                    echo '<img src="data:image/jpg;base64,' . base64_encode($bytes) . '" />';
                    ?>
                </div>
                <div id="titulo">
                    <p id="nome"><?php echo $valor['nome']; ?> (<?php echo $valor['ano']; ?>) - <?php echo $valor['autor']; ?></p>
                </div>
                <div id="acessar">
                    <button><a href="<?php echo "paginas/livros/reservar.php?livro=" . $valor['cod_livro'] . ""; ?>">Reservar(Saber mais)</a></button>
                </div>
    </div>

<?php
                echo "
                <script src=https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js></script>   
                <script>
                    var quant = $('.bloco').length;
                    var outro = $('.uepa').text();
                    var mds = outro.toString();
                    var aqui = mds.substr(-3);
                    var rapaz = aqui.replace('00', '');
                    var uepa = rapaz.toString();
                    var rapaz2 = uepa.replace('0', '');
                    var sl = rapaz2.toString();

                    var mano = $('#black' + sl).text();
                    var texto = mano.replace('0', '');
                    var numb = parseInt(texto);
                    var string = (numb+1).toString(); 

                    var span = document.createElement('p');
                    var conteudo = document.createTextNode('Reservado');
                    span.appendChild(conteudo);
                    span.classList.toggle('span'); 
                    span.id = 'span' + sl;

                    var eita2 = document.getElementById('n' + string);
                    var botao = document.getElementById('acessar');

                    var el = document.getElementById('span' + sl);

                    if (el != null){
                    }else{
                        eita2.style.cssText = 'filter: grayscale(100%);';
                        eita2.appendChild(span);
                    }
                </script>
                ";
            }
        }
?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="scripts/script.js"></script>
</body>

</html>