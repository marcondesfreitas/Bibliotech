<?
include_once "../php/dbconnect.php";

$sql = mysqli_query($conexao, "SELECT foto,tipo, id FROM fotos");

$row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
$id = $row["id"];
$tipo = $row["tipo"];
$bytes = $row["foto"];

header("Content-type: " . $tipo . "");

echo $bytes;
