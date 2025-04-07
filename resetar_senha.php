<?php
// Incluindo a conexão com o banco de dados
require_once('conexao.php');

$erro = "";
$sucesso = "";

// Verifica se o token foi fornecido
if (isset($_GET['token'])) {
    $token = htmlspecialchars(trim($_GET['token'])); // Sanitiza o token

    // Verificar se o token existe e não expirou
    if ($conn) {
        $sql = "SELECT * FROM usuarios WHERE token = ? AND token_expira_em > NOW()";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
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

                        if ($stmt_update) {
                            $stmt_update->bind_param("ss", $senha, $token);
                            $stmt_update->execute();

                            if ($stmt_update->affected_rows > 0) {
                                $sucesso = "Sua senha foi redefinida com sucesso!";
                            } else {
                                $erro = "Erro ao redefinir a senha. Tente novamente.";
                            }
                        } else {
                            $erro = "Erro ao preparar a consulta de atualização.";
                        }
                    } else {
                        $erro = "Por favor, insira uma nova senha.";
                    }
                }
            } else {
                $erro = "Token inválido ou expirado.";
            }

            $stmt->close();
        } else {
            $erro = "Erro ao preparar a consulta.";
        }
    } else {
        $erro = "Erro ao conectar ao banco de dados.";
    }

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
        <form action="resetar_senha.php?token=<?= urlencode($token) ?>" method="POST">
            <div class="input-group">
                <input type="password" name="senha" placeholder="Nova senha" required>
            </div>

            <button type="submit">Redefinir senha</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
