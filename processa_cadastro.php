<?php
require_once('conexao.php'); // Certifique-se de que a conexão está correta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    $confirmar_senha = trim($_POST['confirmar_senha']);

    // Validações básicas
    if (empty($nome) || empty($email) || empty($senha) || empty($confirmar_senha)) {
        echo "Todos os campos são obrigatórios!";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "E-mail inválido!";
        exit;
    }

    if ($senha !== $confirmar_senha) {
        echo "As senhas não coincidem!";
        exit;
    }

    // Verificar se o e-mail já existe no banco
    $sql_check = "SELECT id FROM usuarios WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        echo "Este e-mail já está cadastrado. Tente outro!";
        $stmt_check->close();
        exit;
    }
    $stmt_check->close();

    // Hash da senha antes de armazenar
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Inserir no banco de dados
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senha_hash);

    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
        header("Location: ../app/login.php"); // Redireciona para o login após o cadastro
        exit;
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
