<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f0f0f0;
            margin: 0;
            padding: 30px 0;
        }

        h2 {
            text-align: center;
            color: #333;
            font-weight: 600;
            margin-bottom: 25px;
        }

        div {
            border-style: solid;
            padding: 10px;
        }

        .postagens {
            border: none;
            max-width: 500px;
            margin: 0 auto;
            background: transparent;
            padding: 0;
        }

        .postagem {
            border: 1px solid #e0e0e0;
            margin: 0 0 15px 0;
            background: white;
            border-radius: 8px;
            padding: 16px;
        }

        .postagem img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
            border: 1px solid #ddd;
            object-fit: cover;
        }

        .nome-autor {
            font-weight: 600;
            color: #333;
        }

        .horario {
            border: none;
            padding: 0;
            font-size: 0.8em;
            color: #999;
            margin-top: 8px;
        }

        .comentarios {
            border: none;
            border-top: 1px solid #eee;
            margin-top: 12px;
            padding: 10px 0 0 0;
            background: transparent;
        }

        .comentarios img {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 8px;
            border: 1px solid #ddd;
            object-fit: cover;
        }

        .comentarios > div {
            border: none;
            background: #f5f5f5;
            border-radius: 16px;
            padding: 8px 12px;
            margin: 6px 0;
            display: block;
            color: #555;
            font-size: 0.9em;
        }

        .sem-comentarios {
            border: none;
            color: #aaa;
            background: transparent;
            font-style: italic;
            font-size: 0.85em;
            margin-top: 12px;
            padding: 0;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }

        .comentarios form {
            border: none;
            padding: 0;
            margin-top: 10px;
            display: flex;
            gap: 8px;
        }

        .comentarios input[type="text"] {
            flex: 1;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 16px;
            outline: none;
            font-size: 0.85em;
            background: #fafafa;
        }

        .comentarios input[type="text"]:focus {
            border-color: #999;
        }

        .comentarios input[type="submit"] {
            padding: 8px 16px;
            background: #666;
            color: white;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            font-size: 0.85em;
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
                echo "<br>Essa postagem não possui comentários.";
            } else {
                echo "<div class='comentarios'>";
                // listar comentários aqui

                while ($comentario = mysqli_fetch_array($comentarios)) {
                    $idusuario_comentario = $comentario['idusuario'];
                    $texto_comentario = $comentario['texto'];

                    $foto_usuario_comentario = $comentario['foto'];

                    echo "<div>";
                    echo "<img src='imagem_usuario/$foto_usuario_comentario'>";
                    echo $texto_comentario;
                    echo "</div>";
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
