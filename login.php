<!-- filepath: d:\xampp\htdocs\cadastro_imoveis\login.php -->
<?php
session_start();
require_once('conexao.php');

$error = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['senha'])) {
        $email = htmlspecialchars(trim($_POST['email']));
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            
            if (password_verify($senha, $usuario['senha'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];

                header("Location: cadastro_imoveis/index.php");
                exit();
            } else {
                $error = "Senha incorreta!";
            }
        } else {
            $error = "Usuário não encontrado!";
        }

        $stmt->close();
    } else {
        $error = "Preencha todos os campos!";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Cadastro</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            color: #fff;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
        }

        .login-container h2 {
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            outline: none;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
            transition: 0.3s;
        }

        .input-group input:focus {
            background: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 8px #007BFF;
        }

        .input-group i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #ccc;
        }

        .error-message {
            color: #ff4d4d;
            font-size: 14px;
            margin-bottom: 1rem;
            display: block;
        }

        .login-btn {
            background: #007BFF;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 0 8px #007BFF;
        }

        .login-btn:hover {
            background: #0056b3;
            box-shadow: 0 0 15px #007BFF;
        }

        .login-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .extra-links {
            margin-top: 1rem;
        }

        .extra-links a {
            text-decoration: none;
            color: #00c3ff;
            font-size: 14px;
        }

        .extra-links a:hover {
            text-decoration: underline;
        }

        .fade-in {
            animation: fade 1s ease-in-out;
        }

        @keyframes fade {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background: none;
            border: none;
            color: #fff;
            font-size: 18px;
            cursor: pointer;
            transition: color 0.3s;
        }

        .back-button:hover {
            color: #ccc;
        }
    </style>
</head>
<body>

<div class="login-container fade-in">
    <button class="back-button" onclick="window.history.back();">&larr;</button>
    <h2>Bem-vindo</h2>
    <p>Faça login para acessar sua conta</p>

    <form action="" method="POST">
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="senha" placeholder="Senha" required>
        </div>

        <?php if (!empty($error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <button type="submit" class="login-btn">Entrar</button>
    </form>

    <div class="extra-links">
       <a href="esqueci_senha.php">Esqueci minha senha</a>
    </div>
</div>

</body>
</html>