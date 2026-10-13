<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f0f0f0;
            margin: 0;
            padding: 40px 0;
            min-height: 100vh;
        }

        form {
            max-width: 350px;
            margin: 0 auto;
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 24px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 16px;
            outline: none;
            font-size: 0.9em;
            background: #fafafa;
            margin-top: 4px;
        }

        input[type="text"]:focus {
            border-color: #999;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #666;
            color: white;
            border: none;
            border-radius: 16px;
            cursor: pointer;
            font-size: 0.9em;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background: #444;
        }

        .welcome-img {
            display: block;
            max-width: 300px;
            width: 100%;
            margin: 0 auto 15px auto;
        }

        .titulo-login {
            max-width: 350px;
            margin: 0 auto 15px auto;
            text-align: center;
            color: #555;
            letter-spacing: 1px;
        }

        p {
            color: #cc4444;
            max-width: 350px;
            margin: 0 auto 15px auto;
            text-align: center;
            font-size: 0.9em;
        }

        p:last-child {
            color: #666;
            margin-top: 15px;
        }

        p:last-child a {
            color: #444;
            font-weight: 600;
            text-decoration: none;
        }

        p:last-child a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form action="verificar_login.php" method="post">
        E-mail: <br>
        <input type="text" name="email"> <br><br>
        Senha: <br>
        <input type="text" name="senha"> <br><br>

        <input type="submit" value="Logar">

        <a href="form_usuario.php">Não tem conta? Crie agora!</a>
    </form>
</body>
</html>