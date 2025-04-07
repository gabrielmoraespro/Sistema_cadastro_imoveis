<?php
// filepath: /Applications/XAMPP/xamppfiles/htdocs/cadastro_imoveis/login.php
session_start();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['senha'])) {
        $email = htmlspecialchars(trim($_POST['email']));
        $senha = $_POST['senha'];

        try {
            // Conexão com o banco de dados
            $host = 'localhost';
            $dbname = 'cadastro_imoveis_data';
            $username = 'root';
            $password = '';
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consulta para buscar o usuário pelo e-mail
            $sql = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

                // Verifica a senha
                if (password_verify($senha, $usuario['senha'])) {
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['usuario_nome'] = $usuario['nome'];

                    // Redireciona para o index.php
                    header("Location: ../cadastro_imoveis/index.php");
                    exit();
                } else {
                    $error = "Senha incorreta!";
                }
            } else {
                $error = "Usuário não encontrado!";
            }
        } catch (PDOException $e) {
            $error = "Erro ao processar o login: " . $e->getMessage();
        }
    } else {
        $error = "Preencha todos os campos!";
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
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #2c3e50, #3498db);
            color: #fff;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: rgba(255, 255, 255, 0.9);
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #3498db;
            border-radius: 8px;
            background-color: #f8f9fa;
            box-sizing: border-box;
        }
        button {
            background-color: #2980b9;
            color: white;
            font-size: 1.2em;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 15px;
        }
        button:hover {
            background-color: #1c5980;
        }
        .link {
            display: block;
            margin-top: 15px;
            color: #3498db;
            text-decoration: none;
        }
        .link:hover {
            text-decoration: underline;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
            <a href="esqueci_senha.php" class="link">Esqueceu a senha?</a>
        </form>
        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
    </div>
</body>
</html>