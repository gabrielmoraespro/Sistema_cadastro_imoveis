<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir arquivo de conexão com o banco de dados
require_once('conexao.php');

session_start();

if (isset($_SESSION['error'])) {
    echo "<p class='error-message'>" . htmlspecialchars($_SESSION['error']) . "</p>";
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    echo "<p class='success-message'>" . htmlspecialchars($_SESSION['success']) . "</p>";
    unset($_SESSION['success']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Prefeitura de São Leopoldo</title>

    <!-- Incluir Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Fonte Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #2b1055, #7597de);
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            color: white;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            padding: 20px;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }

        .form-container h2 {
            font-size: 26px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.3);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: 0.3s;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.5);
            color: black;
            border-color: #7597de;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.8);
        }

        .btn-primary {
            background: linear-gradient(135deg, #5a189a, #4361ee);
            border: none;
            transition: all 0.3s ease-in-out;
            padding: 12px;
            font-size: 16px;
            font-weight: 500;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #4361ee, #5a189a);
            transform: scale(1.05);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        .btn-back {
            display: inline-block;
            margin-bottom: 15px;
            color: white;
            text-decoration: none;
            font-size: 16px;
            transition: 0.3s;
        }

        .btn-back:hover {
            text-decoration: underline;
            transform: translateX(-5px);
        }

        footer {
            margin-top: auto;
            background: rgba(0, 0, 0, 0.6);
            padding: 15px;
            text-align: center;
            color: white;
        }

        /* Social Login Buttons */
        .social-login {
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
        }

        .google-btn, .facebook-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            width: 100%;
        }

        .google-btn {
            background:rgb(55, 53, 53);
            color: white;
            box-shadow: 0 0 8px rgba(239, 239, 239, 0.5);
        }

        .google-btn:hover {
            background: #c23321;
            box-shadow: 0 0 15px rgba(219, 68, 55, 0.7);
        }

        .facebook-btn {
            background: #4267B2;
            color: white;
            box-shadow: 0 0 8px rgba(66, 103, 178, 0.5);
        }

        .facebook-btn:hover {
            background: #365899;
            box-shadow: 0 0 15px rgba(66, 103, 178, 0.7);
        }

        .google-btn img, .facebook-btn img {
            width: 24px; /* Ajuste o tamanho conforme necessário */
            height: 24px;
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <a href="javascript:history.back()" class="btn-back">&larr; Voltar</a>
            <h2>Cadastro de Novo Usuário</h2>
            <form action="processa_cadastro.php" method="POST">
                <div class="mb-3">
                    <input type="text" name="nome" class="form-control" placeholder="Nome Completo" required>
                </div>
                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="senha" class="form-control" placeholder="Senha" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="confirmar_senha" class="form-control" placeholder="Confirmar Senha" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
            </form>
            <div class="social-login mt-3">
                <button class="google-btn w-100 mb-2">
                    <img src="images/google-logo.png" alt="Google Logo"> Continuar com Google
                </button>
                <button class="facebook-btn w-100">
                    <img src="images/facebook-logo.png" alt="Facebook Logo"> Continuar com Facebook
                </button>
            </div>
            <p class="mt-3 text-center">Já tem uma conta? <a href="login.php" style="color: #00c3ff; text-decoration: none;">Faça login aqui</a></p>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 Prefeitura Municipal de São Leopoldo | Todos os direitos reservados</p>
    </footer>

    <!-- Scripts do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
