<?php
session_start();
$msg = "";

if (!empty($_SESSION['cod_vendedor'])) {
    header("Location: vendedor.php");
    exit();
}

if (isset($_GET['erro'])) {
    if ($_GET['erro'] == "4") {
        $msg = "Email ou senha inválidos.";
    } else {
        $msg = "Ocorreu um erro no login. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Vendedor</title>
    <link rel="stylesheet" href="../UI/global.css">
</head>

<body class="auth-wrapper">

    <div class="auth-container">

        <div>
            <img src="../img/logo.png" alt="imagem de login" class="auth-logo">
        </div>

        <h3 class="auth-title">Login Vendedor</h3>

        <form method="POST" action="../../BACKEND/PDO/CONTROLLER/UsuarioController.php">

            <label class="auth-label">Nome:</label>
            <input type="text" name="nome" class="auth-input" placeholder="Seu nome completo" required>

            <label class="auth-label">E-mail:</label>
            <input type="text" name="email" class="auth-input" placeholder="user@gmail.com" required>

            <label class="auth-label">Senha:</label>
            <input type="password" name="senha" id="senha" class="auth-input" placeholder="User12345..." required>

            <label class="auth-label">CPF:</label>
            <input type="text" name="cpf" class="auth-input mask-cpf" placeholder="000.000.000-00" required>

            <label class="auth-label">Telefone:</label>
            <input type="text" name="telefone" class="auth-input mask-phone" placeholder="(00)00000-0000" required>

            <div class="auth-botoes">
                <button type="submit" name="acao" value="Logar" class="auth-btn auth-btn-submit">Entrar</button>
                <button type="reset" class="auth-btn auth-btn-reset">Cancelar</button>
            </div>
        </form>

        <div class="auth-message">
            <?php echo $msg; ?>
        </div>

        <div class="auth-link-container">
            <a href="cadastroVend.php" class="auth-link">não tem uma conta? Faça seu cadastro.</a>
        </div>

    </div>

    <script src="../UI/global.js"></script>

</body>

</html>