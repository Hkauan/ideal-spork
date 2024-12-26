<?php
// Configuração de tempo de expiração da sessão (3 dias)
session_cache_expire(180720);
session_start();

// Função para conectar ao banco de dados MySQL
function conectarBanco() {
    $host = 'localhost';
    $dbname = 'site_portfolio';
    $user = 'root'; // Usuário padrão do MySQL no XAMPP
    $password = ''; // Senha padrão (em branco) no XAMPP

    try {
        // Conectar com MySQL usando mysqli
        $conn = new mysqli($host, $user, $password, $dbname);

        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

        return $conn;
    } catch (Exception $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
}

// Função para verificar a força da senha
function verificaNivelSenha($senha) {
    if (strlen($senha) < 6 || preg_match('/^[A-Za-z0-9]+$/', $senha)) {
        return 'fraca';
    } elseif (preg_match('/[A-Za-z]/', $senha) && preg_match('/[0-9]/', $senha)) {
        return 'media';
    } elseif (preg_match('/[A-Za-z]/', $senha) && preg_match('/[0-9]/', $senha) && preg_match('/[@$!%*?&]/', $senha)) {
        return 'forte';
    }
    return 'fraca';
}

// Função para registrar tentativa de login
function registrarTentativa($usuario, $status, $conn) {
    $stmt = $conn->prepare("INSERT INTO log_tentativas (usuario, status, data_hora) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $usuario, $status);
    $stmt->execute();
}

// Lógica de login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = trim($_POST['usuario']);
    $senha = trim($_POST['senha']);

    // Validação de campos obrigatórios
    if (empty($usuario) || empty($senha)) {
        echo "Usuário e senha são obrigatórios.";
        exit();
    }

    try {
        // Conectar ao banco de dados
        $conn = conectarBanco();

        // Prevenir SQL Injection com prepared statements
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar se o usuário existe
        $user = $result->fetch_assoc();

        if ($user && password_verify($senha, $user['senha'])) {
            // Verificar o nível de segurança da senha
            $nivelSenha = verificaNivelSenha($senha);

            if ($nivelSenha === 'fraca' || $nivelSenha === 'media') {
                registrarTentativa($usuario, 'senha_fraca', $conn);
                header("Location: trocasenha.php");
                exit();
            } else {
                $_SESSION['usuario'] = $usuario;
                registrarTentativa($usuario, 'sucesso', $conn);
                header("Location: index.php");
                exit();
            }
        } else {
            registrarTentativa($usuario, 'falha', $conn);
            echo "Usuário ou senha inválidos.";
        }
    } catch (Exception $e) {
        die("Erro ao processar login: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            height: 100vh;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: rgba(224, 224, 224, 0.87);
            background: linear-gradient(135deg, #0f0f0f, #2a2a2a, #1a1a1a);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
            overflow: hidden;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .geral {
            background-color: rgba(46, 46, 46, 0.85);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4);
            text-align: center;
            width: 400px;
            border: 1px solid #444;
        }

        #logo {
            max-width: 250px;
            height: 150px;
            border: none;
            margin-bottom: 5px;
            transform: translateY(-50%);
        }

        fieldset {
            border: none;
            margin-bottom: 20px;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
            color: #cccccc;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #444;
            border-radius: 8px;
            background-color: #333;
            color: #fff;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #666;
            outline: none;
            box-shadow: 0 0 5px #666;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 40px;
        }

        .toggle-password {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .botao {
            width: 100%;
            padding: 12px;
            background-color: #444;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .botao:hover {
            background-color: #555;
        }

        .toggle-password svg {
            fill: #444;
            width: auto;
            height: 24px;
        }

        .toggle-password:hover svg {
            fill: #fff;
        }

        p {
            color: #bbb;
            margin-top: 15px;
        }

        #forgot-password a {
            color: #00f;
            text-decoration: none;
        }

        #forgot-password a:hover {
            text-decoration: underline;
        }

        p {
        font-family: 'Arial', sans-serif;
        font-size: 16px;
        color: #fff;
        text-align: center;
        margin-top: 30px;
        letter-spacing: 0.5px;
    }

    a {
        color:rgb(54, 135, 167); /* Cor vibrante do link */
        text-decoration: none;
        font-weight: bold;
        position: relative;
        padding-bottom: 2px;
    }

    a:hover {
        color:rgb(84, 186, 255); /* Cor do link quando passar o mouse */
    }

    a::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 2px;
        background-color:rgb(94, 159, 196);
        bottom: 0;
        left: 0;
        transform: scaleX(0);
        transform-origin: bottom right;
        transition: transform 0.3s ease-out;
    }

    a:hover::after {
        transform: scaleX(1);
        transform-origin: bottom left;
    }

    p a {
        transition: color 0.3s ease;
    }

    @media (max-width: 600px) {
        p {
            font-size: 14px;
        }

        a {
            font-size: 16px;
        }
    }
    </style>
</head>
<body>
    <section class="container">
        <div class="row">
            <div class="geral">
                <form method="post" action="validalogin.php" id="login-form">
                    <fieldset>
                        <img id="logo" src="./img/profile.png" alt="CENTURY"/>
                        <label for="login">Login</label>
                        <input type="text" name="usuario" id="usuario" maxlength="20" tabindex="1" required>

                        <label for="password">Senha</label>
                        <div class="password-wrapper">
                            <input type="password" name="senha" id="senha" maxlength="20" tabindex="2" required>
                            <span class="toggle-password" onclick="togglePassword()">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 2C5.94 2 2.5 5 2.5 10S5.94 18 10 18s7.5-3 7.5-8S14.06 2 10 2zm0 3c2.06 0 4 1.94 4 4s-1.94 4-4 4-4-1.94-4-4 1.94-4 4-4zm0 2a2 2 0 100 4 2 2 0 000-4z"/>
                                </svg>
                            </span>
                        </div>
                    </fieldset>
                    <input type="submit" value="Entrar" class="botao">
                </form>
                <p>Não tem uma conta? <a href="registro.php">Registrar-se</a></p>
                <p id="forgot-password" style="display:none;">Esqueceu sua senha? <a href="./reset-password.php">Redefinir senha</a></p>
            </div>
        </div>
    </section>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('senha');
            const toggleIcon = document.querySelector('.toggle-password svg');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.setAttribute('fill', '#fff'); // Cor ao mostrar
            } else {
                passwordInput.type = 'password';
                toggleIcon.setAttribute('fill', '#bbb'); // Cor padrão
            }
        }
    </script>
</body>
</html>
