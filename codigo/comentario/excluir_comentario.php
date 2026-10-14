<?php
require_once "verificar_sessao.php";
require_once "conexao.php";

$idcomentario = $_GET['idcomentario'];

$sql = "DELETE FROM comentario
WHERE idcomentario = $idcomentario";

mysqli_query($conexao, $sql);

header("Location: listar_postagem.php");
?>