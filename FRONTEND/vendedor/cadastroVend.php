<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CADASTRO DE USUÁRIO</title>
    
    <style>
        /* Estilização idêntica ao loginVend.php */
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
            width: 350px; /* Aumentado levemente para caber os campos de cadastro */
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
        }

        img {
            width: 120px;
            margin-bottom: 15px;
        }

        h3 {
            margin-bottom: 20px;
            font-size: 24px;
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
            box-sizing: border-box; /* Garante que o padding não quebre a largura */
        }

        .botoes {
            margin-top: 25px;
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

        <h3>Cadastrar-se</h3>

       <form method="POST" action="../../BACKEND/PDO/CONTROLLER/VendedorController.php">
            
            <label>E-mail:</label>
            <input type="email" name="email" placeholder="seu@email.com" required>

            <label>Senha:</label>
            <input type="password" name="senha" placeholder="Sua senha"  placeholder="insira sua senha" required>

            <label>Confirmar Senha:</label>
            <input type="password" name="confirmar_senha" placeholder="Confirme sua senha" required>

            <label>Telefone:</label>
            <input type="text" name="telefone" id="telefone" placeholder="(00)00000-0000" required>

            <label>CPF:</label>
            <input type="text" name="CPF" class="CPF"  id="cpf"placeholder="000.000.000-00" required maxlength="14">

            <div class="botoes">
                <button type="submit" name="acao" value="Inserir">Cadastrar</button>
                <button type="reset">Limpar</button>
            </div>
        </form>

        <div class="link-footer">
            <a href="loginVend.php">Já tem uma conta? Faça login.</a>
        </div>
    </div>


     <script>
    document.getElementById('cpf').addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, '');
      value = value.substring(0, 11);
      if (value.length > 3) value = value.replace(/(\d{3})(\d)/, '$1.$2');
      if (value.length > 7) value = value.replace(/(\d{3})(\d{3})(\d)/, '$1.$2-$3');
      e.target.value = value;
    });

     // Máscara para o telefone
  document.getElementById('telefone').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é número
    value = value.substring(0, 11); // Limita a 11 dígitos (2 DDD + 9 celular)

    // Aplica a máscara: (00) 00000-0000
    if (value.length > 2) {
      value = value.replace(/(\d{2})(\d)/, '($1) $2');
    }
    if (value.length > 7) {
      value = value.replace(/(\d{5})(\d)/, '$1-$2');
    }

    e.target.value = value;
    });
  </script>


</body>
</html>