<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO DE VENDEDOR</title>
    <link rel="stylesheet" href="../UI/global.css">

</head>

<?php session_start(); ?>

<body class="auth-wrapper">

    <div class="auth-container">

        <div>
            <img src="../img/logo.png" alt="imagem de login" class="auth-logo">
        </div>

        <h3 class="auth-title">Cadastrar-se</h3>

        <form method="POST" action="../../BACKEND/PDO/CONTROLLER/UsuarioController.php">

            <label class="auth-label">Nome:</label>
            <input type="text" name="nome" class="auth-input" placeholder="Seu nome completo" required>

            <label class="auth-label">E-mail:</label>
            <input type="email" name="email" class="auth-input" placeholder="seu@email.com" required>

            <label class="auth-label">Senha:</label>
            <input type="password" name="senha" class="auth-input" placeholder="Sua senha" required>

            <label class="auth-label">Confirmar Senha:</label>
            <input type="password" name="confirmar_senha" class="auth-input" placeholder="Confirme sua senha" required>

            <label class="auth-label">Telefone:</label>
            <input type="text" name="telefone" id="telefone" class="auth-input mask-phone" placeholder="(00)00000-0000" required>

            <label class="auth-label">CPF:</label>
            <input type="text" name="CPF" id="cpf" class="auth-input mask-cpf" placeholder="000.000.000-00" required maxlength="14">

            <input type="hidden" name="tipo" value="vendedor">
            <div class="auth-botoes">
                <button type="submit" name="acao" value="tornarVendedor" class="auth-btn auth-btn-submit">Cadastrar</button>
                <button type="reset" class="auth-btn auth-btn-reset">Limpar</button>
            </div>
        </form>

        <div class="auth-link-container">
            <a href="loginVend.php" class="auth-link">Já tem uma conta? Faça login.</a>
        </div>
    </div>


    <script src="../UI/global.js"></script>

</body>

</html>