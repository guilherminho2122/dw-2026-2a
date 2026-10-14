<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .postagens {
            max-width: 500px;
            margin: 0 auto;
        }

        .postagem {
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 15px;
        }

        .postagem img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .comentarios {
            border-top: 1px solid #ddd;
            margin-top: 12px;
            padding-top: 10px;
        }

        .comentarios img {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            margin-right: 8px;
        }

        .comentario {
            background: #f0f0f0;
            border-radius: 10px;
            padding: 8px 12px;
            margin: 6px 0;
        }

        .sem-comentarios {
            color: #aaa;
            font-style: italic;
            border-top: 1px solid #ddd;
            margin-top: 20px;
            padding-top: 10px;
        }

        .comentarios form {
            margin-top: 10px;
        }

        .comentarios input[type="text"] {
            width: 70%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 15px;
        }

        .comentarios input[type="submit"] {
            padding: 8px 15px;
            background: #666;
            color: white;
            border: none;
            border-radius: 15px;
            cursor: pointer;
        }

        .comentarios input[type="submit"]:hover {
            background: #444;
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
                echo "<div class='sem-comentarios'>Essa postagem não possui comentários.</div>";
            }

            echo "<div class='comentarios'>";

            // listar comentários aqui
            while ($comentario = mysqli_fetch_array($comentarios)) {
                $idcomentario = $comentario['idcomentario'];
                $idusuario_comentario = $comentario['idusuario'];
                $texto_comentario = $comentario['texto'];

                $foto_usuario_comentario = $comentario['foto'];

                echo "<div class='comentario'>";
                echo "<img src='imagem_usuario/$foto_usuario_comentario'>";
                echo $texto_comentario;
                echo "</div>";
                echo "<a href='excluir_comentario.php?idcomentario=$idcomentario'>Excluir</a>";
            }
        ?>
            <form action="salvar_comentario.php" method="post">
                <input type="hidden" name="idpostagem" value="<?php echo $idpostagem; ?>">
                <input type="text" name="texto" placeholder="Escreva um comentário...">
                <input type="submit" value="Comentar">
            </form>

        <?php
            echo "</div>"; // fecha comentarios
            echo "</div>"; // fecha postagem
        }
        ?>
    </div>
</body>

</html>