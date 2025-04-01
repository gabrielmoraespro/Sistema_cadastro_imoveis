<?php
// Incluindo a conexão com o banco de dados
require_once('conexao.php');

$erro = "";
$sucesso = "";

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar se o token existe e não expirou
    $sql = "SELECT * FROM usuarios WHERE token = ? AND token_expira_em > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Se o token for válido, permite o reset da senha
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST['senha'])) {
                $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

                // Atualizar a senha no banco
                $sql_update = "UPDATE usuarios SET senha = ?, token = NULL, token_expira_em = NULL WHERE token = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("ss", $senha, $token);
                $stmt_update->execute();

                $sucesso = "Sua senha foi redefinida com sucesso!";
            } else {
                $erro = "Por favor, insira uma nova senha.";
            }
        }
    } else {
        $erro = "Token inválido ou expirado.";
    }

    $stmt->close();
    $conn->close();
} else {
    $erro = "Token não fornecido.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="login-container">
    <h2>Redefinir Senha</h2>

    <?php if (!empty($erro)): ?>
        <p class="error-message"><?= htmlspecialchars($erro) ?></p>
    <?php endif; ?>

    <?php if (!empty($sucesso)): ?>
        <p class="success-message"><?= htmlspecialchars($sucesso) ?></p>
    <?php else: ?>
        <form action="resetar_senha.php?token=<?= $token ?>" method="POST">
            <div class="input-group">
                <input type="password" name="senha" placeholder="Nova senha" required>
            </div>

            <button type="submit">Redefinir senha</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
