<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
        div {
            border-style: solid;
            padding: 10px;
        }

        .postagens {
            border-color: blue;
        }

        .postagem {
            border-color: black;
            margin: 10px;
        }

        .comentarios {
            border-color: green;
        }
    </style>
</head>

<body>
    <h2>Lista de postagens</h2>

    <!-- tabela -->
    <div class="postagens">
        <?php
        require_once "conexao.php";

        $sql = "SELECT postagem.idpostagem, postagem.texto, postagem.data_hora, usuario.idusuario, usuario.nome, usuario.apelido, usuario.foto
        FROM postagem, usuario
        WHERE postagem.idusuario = usuario.idusuario;";

        $resultados = mysqli_query($conexao, $sql);

        while ($linha = mysqli_fetch_array($resultados)) {
            $idpostagem = $linha['idpostagem'];
            $texto = $linha['texto'];
            $data_hora = $linha['data_hora'];
            $idusuario = $linha['idusuario'];

            $foto = $linha['foto'];
            $nome = $linha['nome'];
            $apelido = $linha['apelido'];

            echo "<div class='postagem'>";

            echo "<div>";
            echo "<img src='$foto'>";
            echo "$nome";
            echo $data_hora;
            echo "</div>";

            echo $texto;

            //caixa dos comentarios
            $sql3 = "SELECT comentario.idcomentario, comentario.idpostagem, comentario.texto, usuario.idusuario, usuario.nome, usuario.apelido, usuario.foto
            FROM comentario, usuario
            WHERE idpostagem = $idpostagem
            AND comentario.idusuario = usuario.idusuario
            ORDER BY comentario.idcomentario ASC;";

            $comentarios = mysqli_query($conexao, $sql3);

            if (mysqli_num_rows($comentarios) == 0) {
                echo "<br>Essa postagem não possui comentários.";
            } else {
                echo "<div class='comentarios'>";
                // listar comentários aqui

                while ($comentario = mysqli_fetch_array($comentarios)) {
                $idcomentario = $comentario['idcomentario'];    
                $idusuario_comentario = $comentario['idusuario'];
                    $texto_comentario = $comentario['texto'];

                    $foto_usuario_comentario = $comentario['foto'];

                    echo "<div>";
                    echo "<img src='imagem_usuario/$foto_usuario_comentario'>";
                    echo $texto_comentario;
                    echo "</div>";
                    echo "<a href='excluir_comentario.php?idcomentario=$idcomentario'>Excluir</a>";
                }
        ?>
                <form action="salvar_comentario.php" method="post">
                    <input type="hidden" name="idpostagem" value="<?php echo $idpostagem; ?>">
                    <input type="text" name="texto" placeholder="Escreva um comentário..." required>
                    <input type="submit" value="Comentar">
                </form>

        <?php
                echo "</div>";
            }
            echo "</div>";
        }
        ?>
    </div>
</body>

</html>
