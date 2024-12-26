<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "site_portfolio";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmacao_senha = $_POST['confirmacao_senha'];

    // Verificar se as senhas coincidem
    if ($senha !== $confirmacao_senha) {
        echo "<script>alert('As senhas não coincidem!');</script>";
    } else {
        // Verificar a força da senha
        if (strlen($senha) < 8 || !preg_match('/[A-Z]/', $senha) || !preg_match('/[0-9]/', $senha)) {
            echo "<script>alert('A senha é muito fraca. Deve ter pelo menos 8 caracteres, uma letra maiúscula e um número!');</script>";
        } else {
            // Criptografar a senha antes de salvar
            $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

            // Inserir usuário no banco de dados
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha_criptografada')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Conta criada com sucesso!');</script>";
            } else {
                echo "<script>alert('Erro: " . $conn->error . "');</script>";
            }
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        /* Resetando o estilo padrão */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212; /* Fundo escuro */
            color: #f5f5f5; /* Texto claro */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        .registro-container {
            background-color: #1e1e1e; /* Fundo escuro do formulário */
            border-radius: 10px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            color: rgb(54, 135, 167); /* Título vibrante */
            font-size: 24px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #444;
            background-color: #333;
            color: #f5f5f5;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus {
            background-color: #444;
            border: 1px solid rgb(103, 194, 255);
            outline: none;
        }

        .password-strength {
            width: 100%;
            height: 6px;
            margin: 10px 0;
            background-color: #444;
            border-radius: 3px;
        }

        .strength-bar {
            height: 100%;
            border-radius: 3px;
            transition: width 0.3s ease;
        }

        .weak {
            background-color: #ff3d3d;
            width: 33%;
        }

        .medium {
            background-color: #ffb300;
            width: 66%;
        }

        .strong {
            background-color: #00e676;
            width: 100%;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: rgb(83, 170, 173);
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            opacity: 0.7;
        }

        button[type="submit"]:hover {
            background-color: rgb(92, 210, 214);
        }

        button[type="submit"]:disabled {
            background-color: rgb(145, 180, 190);
            cursor: not-allowed;
        }

        .footer {
            margin-top: 20px;
        }

        .footer p {
            font-size: 14px;
            color: #bbb;
        }

        .footer a {
            color: rgb(82, 134, 143);
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: rgb(96, 182, 216);
        }

        /* Efeitos responsivos */
        @media (max-width: 600px) {
            .registro-container {
                padding: 30px;
            }

            h2 {
                font-size: 20px;
            }

            input[type="text"], input[type="email"], input[type="password"], button[type="submit"] {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="registro-container">
        <h2>Registro</h2>
        <form action="registro.php" method="POST">
            <input type="text" name="nome" placeholder="Nome Completo" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="senha" id="senha" placeholder="Senha" required onkeyup="verificarForcaSenha()">
            <input type="password" name="confirmacao_senha" placeholder="Confirmar Senha" required>
            <div class="password-strength" id="strengthBar">
                <div class="strength-bar" id="strengthBarColor"></div>
            </div>
            <button type="submit" id="btnSubmit" disabled>Registrar</button>
        </form>
        <div class="footer">
            <p>Já tem uma conta? <a href="login.php">Login</a></p>
        </div>
    </div>

    <script>
        // Função para verificar a força da senha
        function verificarForcaSenha() {
            var senha = document.getElementById("senha").value;
            var strengthBar = document.getElementById("strengthBarColor");
            var submitButton = document.getElementById("btnSubmit");
            var strength = 0;

            // Verificando a força da senha
            if (senha.length >= 8) {
                strength += 1;
                if (/[A-Z]/.test(senha)) {
                    strength += 1;
                }
                if (/[0-9]/.test(senha)) {
                    strength += 1;
                }
            }

            // Alterando a barra de força da senha
            if (strength == 0) {
                strengthBar.className = "strength-bar weak";
                submitButton.disabled = true;
            } else if (strength == 1) {
                strengthBar.className = "strength-bar weak";
                submitButton.disabled = true;
            } else if (strength == 2) {
                strengthBar.className = "strength-bar medium";
                submitButton.disabled = false;
            } else if (strength == 3) {
                strengthBar.className = "strength-bar strong";
                submitButton.disabled = false;
            }
        }
    </script>
</body>
</html>
