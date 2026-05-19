<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Vendedor</title>
    
    <link rel="stylesheet" href="../assets/css/global.css">
</head>
<body class="auth-wrapper"> <div class="auth-container">
        <div>
            <img src="../img/logo.png" alt="logo" class="auth-logo rounded-circle">
        </div>

        <h3>Login Vendedor</h3>

        <form method="POST" action="../../BACKEND/PDO/CONTROLLER/VendedorController.php">
            <label class="auth-label">E-mail:</label>
            <input type="text" name="email" class="auth-input" placeholder="user@gmail.com" required>

            <label class="auth-label">Senha:</label>
            <div class="auth-input-group">
                <input type="password" name="senha" id="senha" placeholder="User12345..." required>
                <span class="auth-toggle" id="toggle-senha">👁</span>
            </div>

            <label class="auth-label">CPF:</label>
            <input type="text" name="cpf" id="cpf" class="auth-input" placeholder="000.000.000-00" required>

            <label class="auth-label">Telefone:</label>
            <input type="text" name="telefone" id="telefone" class="auth-input" placeholder="(00)00000-0000" required>

            <div class="auth-botoes">
                <button type="submit" name="acao" value="Logar" class="auth-btn auth-btn-submit">Entrar</button>
                <button type="reset" class="auth-btn auth-btn-reset">Cancelar</button>
            </div>
        </form>

        <div class="msg"><?php echo $msg; ?></div>

        <div style="margin-top: 20px;">
            <a href="cadastroVend.php" class="auth-link">Não tem uma conta? Faça seu cadastro.</a>
        </div>
    </div>

    <script src="../assets/js/global.js"></script>
</body>
</html>