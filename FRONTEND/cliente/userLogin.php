<?php
session_start();
$msg = "";

if (!empty($_SESSION['cod_usuario'])) {
    header("Location: usuario.php");
    exit();
}

if (isset($_GET['erro'])) {
    if ($_GET['erro'] == "4") {
        $msg = "Email ou senha inválidos.";
    } else {
        $msg = "Ocorreu um erro no login. Tente novamente.";
    }
}

if (isset($_GET['success']) && $_GET['success'] == "1") {
    $msg = "Cadastro realizado com sucesso! Faça login para continuar.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de usuario</title>
    <link rel="stylesheet" href="../UI/global.css">
</head>

<body class="auth-wrapper">

    <div class="auth-container">

        <div>
            <img src="../img/logo.png" alt="imagem de login" class="auth-logo">
        </div>

        <h3 class="auth-title">Login do Cliente</h3>

        <form method="POST" action="../../BACKEND/PDO/CONTROLLER/UsuarioController.php">

            <label class="auth-label">E-mail:</label>
            <input type="email" name="email" class="auth-input" placeholder="seu@email.com" required>

            <label class="auth-label">Senha:</label>
            <input type="password" name="senha" id="senha" class="auth-input" placeholder="Sua senha" required>

            <div class="auth-botoes">
                <button type="submit" name="acao" value="Logar" class="auth-btn auth-btn-submit">Entrar</button>
                <button type="reset" class="auth-btn auth-btn-reset">Cancelar</button>
            </div>
        </form>

        <div class="auth-message">
            <?php 
                if ($msg != "") {
                    echo '<span style="color: ' . (isset($_GET['success']) ? 'green' : 'red') . ';">' . $msg . '</span>';
                }
            ?>
        </div>

        <div class="auth-link-container">
            <a href="userCadastro.php" class="auth-link">Não tem uma conta? Faça seu cadastro.</a>
        </div>

    </div>

    <script src="../UI/global.js"></script>

</body>

</html>