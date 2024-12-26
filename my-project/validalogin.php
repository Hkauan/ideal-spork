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
    // Preparando a consulta SQL
    $stmt = $conn->prepare("INSERT INTO log_tentativas (usuario, status, data_hora) VALUES (?, ?, NOW())");

    // Verificar se a consulta foi preparada corretamente
    if ($stmt === false) {
        die("Erro ao preparar a consulta: " . $conn->error);
    }

    // Ligando os parâmetros e executando a consulta
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
        
        // Verificar se a consulta foi preparada corretamente
        if ($stmt === false) {
            die("Erro ao preparar a consulta: " . $conn->error);
        }

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
                $_SESSION['tipo_usuario'] = $user['tipo_usuario']; // Armazenar o tipo de usuário (admin ou normal)
                registrarTentativa($usuario, 'sucesso', $conn);

                // Redirecionar baseado no tipo de usuário
                if ($user['tipo_usuario'] == 'admin') {
                    header("Location: navbar2.php"); // Redirecionar para o painel de admin
                } else {
                    header("Location: navbar.php"); // Redirecionar para a página normal
                }
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
