<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO DE USUÁRIO</title>
    <link rel="stylesheet" href="../UI/global.css">
</head>
<body class="auth-wrapper">

    <div class="auth-container">

          <div>
            <img src="../img/logo.png" alt="imagem de login" class="auth-logo">
        </div>

        <h3 class="auth-title">Cadastrar-se</h3>

       <form method="POST" action="../../BACKEND/PDO/CONTROLLER/UsuarioController.php" enctype="multipart/form-data">

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

 

            <div class="auth-botoes">
                <button type="submit" name="acao" value="Inserir" class="auth-btn auth-btn-submit">Cadastrar</button>
                <button type="reset" class="auth-btn auth-btn-reset">Limpar</button>
            </div>
        </form>

        <div class="auth-link-container">
            <a href="userLogin.php" class="auth-link">Já tem uma conta? Faça login.</a>
        </div>
    </div>

    <script src="../UI/global.js"></script>
    <script>
        function handleDragOver(e) {
            e.preventDefault();
            e.stopPropagation();
            document.getElementById('uploadArea').classList.add('bg-[#fff5f0]');
        }

        function handleDragLeave(e) {
            e.preventDefault();
            document.getElementById('uploadArea').classList.remove('bg-[#fff5f0]');
        }

        function handleDrop(e) {
            e.preventDefault();
            e.stopPropagation();
            document.getElementById('uploadArea').classList.remove('bg-[#fff5f0]');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                document.getElementById('fotoInput').files = files;
                handleFileSelect({ target: { files: files } });
            }
        }

        function handleFileSelect(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    document.getElementById('previewImg').src = event.target.result;
                    document.getElementById('photoPreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        function removerFoto() {
            document.getElementById('fotoInput').value = '';
            document.getElementById('photoPreview').style.display = 'none';
        }
    </script>
</html>