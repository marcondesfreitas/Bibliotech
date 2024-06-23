<?php
include_once "dbconnect.php";

$nome = $_POST['nome_livro'];
$autor = $_POST['autor'];
$editora = $_POST['editora'];
$ano = $_POST['ano'];
$sinopse = $_POST['sinopse'];
$quantidade = $_POST['quant'];
$imagem = $_FILES['imagem']['tmp_name'];
$tamanho = $_FILES['imagem']['size'];
$tipo = $_FILES['imagem']['type'];
$name = $_FILES['imagem']['name'];

$sql= "INSERT INTO livros values(null, '$nome', '$autor', '$editora', '$ano', '$sinopse', '$quantidade')";
$query = mysqli_query($conexao, $sql);

if (!isset($_SESSION)) session_start();

$_SESSION['LivroNome'] = $nome;

if ( $imagem != "none" ){
    $fp = fopen($imagem, "rb");
    $conteudo = fread($fp, $tamanho);
    $conteudo = addslashes($conteudo);
    fclose($fp);

    $sql2 = "SELECT cod_livro from livros where nome = '$nome'";
    $query2 = mysqli_query($conexao, $sql2);
    $lista = mysqli_fetch_array($query2);
    $cod = $lista['cod_livro'];

    $queryInsercao = "INSERT INTO foto_livro VALUES (null, $cod, '$name','$tamanho', '$tipo','$conteudo')";

    mysqli_query($conexao, $queryInsercao);
    echo 'Registro inserido com sucesso!';
    if(mysqli_affected_rows($conexao) > 0)
        echo "
        <script>
            alert ('Livro Cadastrado');
            window.location = '../paginas/livros/cadastrar_livro.html';
        </script>
        ";
    else
        print "Não foi possível salvar a imagem na base de dados.";
}
else
    print "Não foi possível carregar a imagem.";

?>