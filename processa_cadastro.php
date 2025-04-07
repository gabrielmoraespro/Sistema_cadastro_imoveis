<?php
require_once('conexao.php'); // Certifique-se de que o arquivo de conexão está correto

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitização e validação dos dados de entrada
    $nome = htmlspecialchars(trim($_POST['nome']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $senha = trim($_POST['senha']);
    $confirmar_senha = trim($_POST['confirmar_senha']);

    // Validações básicas
    if (empty($nome) || empty($email) || empty($senha) || empty($confirmar_senha)) {
        $_SESSION['error'] = "Todos os campos são obrigatórios!";
        header("Location: cadastro.php");
        exit();
    }

    if (!$email) {
        $_SESSION['error'] = "E-mail inválido!";
        header("Location: cadastro.php");
        exit();
    }

    if ($senha !== $confirmar_senha) {
        $_SESSION['error'] = "As senhas não coincidem!";
        header("Location: cadastro.php");
        exit();
    }

    try {
        // Verifica se o e-mail já existe no banco de dados
        $sql_check = "SELECT id FROM usuarios WHERE email = :email";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bindValue(':email', $email);
        $stmt_check->execute();

        if ($stmt_check->rowCount() > 0) {
            $_SESSION['error'] = "E-mail já cadastrado!";
            header("Location: cadastro.php");
            exit();
        }

        // Hash da senha para segurança
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        // Insere o novo usuário no banco de dados
        $sql_insert = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bindValue(':nome', $nome);
        $stmt_insert->bindValue(':email', $email);
        $stmt_insert->bindValue(':senha', $senha_hash);
        $stmt_insert->execute();

        $_SESSION['success'] = "Cadastro realizado com sucesso!";
        header("Location: cadastro.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error'] = "Erro ao processar o cadastro: " . $e->getMessage();
        header("Location: cadastro.php");
        exit();
    }
} else {
    header("Location: cadastro.php");
    exit();
}
?>
