<?php
// Incluir arquivo de conexão com o banco de dados
require_once('conexao.php');

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obter os dados do formulário
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = $_POST['senha'];

    // Verificar se o e-mail existe no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        // E-mail encontrado, agora verificar a senha
        $user = mysqli_fetch_assoc($result);
        
        // Usar a função password_verify para comparar a senha hashada
        if (password_verify($senha, $user['senha'])) {
            // Login bem-sucedido, iniciar sessão
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nome'];

            // Redirecionar para a página protegida ou área administrativa
            header("Location: ../app/dashboard.php");
            exit();
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "E-mail não encontrado!";
    }
}
?>
