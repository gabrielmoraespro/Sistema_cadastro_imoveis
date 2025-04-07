<?php
require_once('conexao.php');

$erro = "";
$sucesso = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email'])) {
        $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);

        if (!$email) {
            $erro = "E-mail inválido.";
        } else {
            try {
                // Verifica se o e-mail existe no banco de dados
                $sql = "SELECT * FROM usuarios WHERE email = :email";
                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':email', $email);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    // Gera o token e define o tempo de expiração
                    $token = bin2hex(random_bytes(50));
                    $expira_em = date("Y-m-d H:i:s", strtotime("+1 hour"));

                    // Atualiza o token no banco de dados
                    $sql_update = "UPDATE usuarios SET token = :token, token_expira_em = :expira_em WHERE email = :email";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bindValue(':token', $token);
                    $stmt_update->bindValue(':expira_em', $expira_em);
                    $stmt_update->bindValue(':email', $email);
                    $stmt_update->execute();

                    // Envia o e-mail com o link de redefinição
                    $link = "http://localhost/cadastro_imoveis/nova_senha.php?token=" . $token;
                    $mensagem = "Clique no link para redefinir sua senha: " . $link;

                    // Substitua por uma função de envio de e-mail real
                    mail($email, "Redefinição de Senha", $mensagem);

                    $sucesso = "Um link para redefinir sua senha foi enviado para o seu e-mail.";
                } else {
                    $erro = "E-mail não encontrado.";
                }
            } catch (PDOException $e) {
                $erro = "Erro ao processar a solicitação: " . $e->getMessage();
            }
        }
    } else {
        $erro = "Por favor, insira um e-mail.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci minha senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            position: relative;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
        }
        .success-message {
            color: green;
            font-size: 0.9em;
        }
        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background: none;
            border: none;
            color: #666;
            font-size: 18px;
            cursor: pointer;
            transition: color 0.3s;
        }
        .back-button:hover {
            color: #333;
        }
    </style>
</head>
<body>

<div class="login-container text-center">
    <button class="back-button" onclick="window.history.back();">&larr;</button>
    <h2>Redefinir Senha</h2>
    <p>Informe seu e-mail para receber as instruções de redefinição de senha.</p>

    <form action="esqueci_senha.php" method="POST">
        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Seu e-mail" required>
        </div>

        <?php if (!empty($erro)): ?>
            <p class="error-message"> <?= htmlspecialchars($erro) ?> </p>
        <?php endif; ?>

        <?php if (!empty($sucesso)): ?>
            <p class="success-message"> <?= htmlspecialchars($sucesso) ?> </p>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary w-100">Enviar instruções</button>
    </form>
</div>

</body>
</html>