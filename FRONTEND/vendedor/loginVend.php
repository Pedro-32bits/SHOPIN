<?php
//require "../CONTROLLER/VendedorController.php";
//require "../PDO/conexao.php";
$msg = "";

if (isset($_POST['acao']) && $_POST['acao'] == "Logar") {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if ($email == "vendedor@email.com" && $senha == "12345") {
        $msg = "Login realizado com sucesso!";
    } else {
        $msg = "Email ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Vendedor</title>

    <style>
        body {
            background: #E6DED3;
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: #b30000;
            padding: 30px;
            width: 350px;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
        }

        img {
            width: 120px;
            margin-bottom: 15px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            width: 90%;
            text-align: left;
            margin-top: 10px;
            font-weight: bold;
        }

        input {
            width: 90%;
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 8px;
            outline: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        /* CAMPO DE SENHA COM OLHO */
        .input-senha {
            width: 90%;
            display: flex;
            align-items: center;
            background: white;
            border-radius: 8px;
            padding: 0 10px;
            margin-top: 5px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .input-senha input {
            border: none;
            flex: 1;
            padding: 10px;
            outline: none;
        }

        .toggle {
            cursor: pointer;
            font-size: 18px;
            color: black;
        }

        .botoes {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 10px;
            width: 100%;
        }

        button {
            width: 45%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        button[type="submit"] {
            background: white;
            color: #b30000;
        }

        button[type="submit"]:hover {
            background: #ffe5e5;
        }

        button[type="reset"] {
            background: #800000;
            color: white;
        }

        button[type="reset"]:hover {
            background: #660000;
        }

        .msg {
            margin-top: 15px;
            font-size: 14px;
            font-weight: bold;
        }

        .link-footer {
            margin-top: 20px;
            font-size: 14px;
        }

        .link-footer a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .link-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">

        <div >
            <img src="../img/logo.png" alt="imagem de login" class="img-fluid rounded-circle" style="max-width:120px;">
        </div>

        <h3>Login Vendedor</h3>

        <form method="POST" action="../../BACKEND/PDO/CONTROLLER/VendedorController.php">

            <label>E-mail:</label>
            <input type="text" name="email" placeholder="user@gmail.com" required>

            <label>Senha:</label>
            <div class="input-senha">
                <input type="password" name="senha" id="senha" placeholder="User12345..." required>
                <span class="toggle" onclick="mostrarSenha()">👁</span>
            </div>

            <label>CPF:</label>
            <input type="text" name="cpf" class="cpf" placeholder="000.000.000-00" required>

            <label>Telefone:</label>
            <input type="text" name="telefone" placeholder="(00)00000-0000" required>

            <div class="botoes">
                <button type="submit" name="acao" value="Logar">Entrar</button>
                <button type="reset">Cancelar</button>
            </div>
        </form>

        <div class="msg">
            <?php echo $msg; ?>
        </div>

        <div class="link-footer" >
            <a href="cadastroVend.php" class="text-decoration-none">não tem uma conta? Faça seu cadastro.</a>
        </div>

    </div>

    <script>
        function mostrarSenha() {
            var input = document.getElementById("senha");
            if (input.type === "password") {
                input.type = "text";
            } else {
                input.type = "password";
            }
        }
    </script>

</body>

</html>