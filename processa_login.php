<?php
require_once('conexao.php');

session_start();

if (isset($_SESSION['error'])) {
    echo "<p class='error-message'>" . htmlspecialchars($_SESSION['error']) . "</p>";
    unset($_SESSION['error']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitização e validação dos dados de entrada
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $senha = trim($_POST['senha']);

    if (!$email || empty($senha)) {
        $_SESSION['error'] = "E-mail ou senha inválidos.";
        header("Location: login.php");
        exit();
    }

    // Verifica se a conexão com o banco foi estabelecida
    if (!$conn) {
        $_SESSION['error'] = "Erro ao conectar ao banco de dados.";
        header("Location: login.php");
        exit();
    }

    // Consulta ao banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            // Verifica a senha
            if (password_verify($senha, $user['senha'])) {
                // Login bem-sucedido
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nome'];
                header("Location: dashboard.php");
                exit();
            } else {
                $_SESSION['error'] = "Senha incorreta.";
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "E-mail não encontrado.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Erro ao preparar a consulta.";
        header("Location: login.php");
        exit();
    }
}
?>
