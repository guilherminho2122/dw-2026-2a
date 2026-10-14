<?php
require_once "verificar_sessao.php";
require_once "conexao.php";

$texto = $_POST['texto'];
$idpostagem = $_POST['idpostagem'];
$idusuario = $_SESSION['idusuario'];

$sql = "INSERT INTO comentario (texto, idpostagem, idusuario)
VALUES ('$texto', $idpostagem, $idusuario)";

mysqli_query($conexao, $sql);

header("Location: listar_postagem.php");
?>