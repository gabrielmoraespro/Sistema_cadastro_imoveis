<?php
// Conectar ao banco de dados
include('../config/db_connect.php');

// Verificar se o ID da pessoa foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar os dados da pessoa no banco de dados
    $sql = "SELECT * FROM pessoas WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $pessoa = mysqli_fetch_assoc($result);
}

// Verificar se o formulário foi submetido
if (isset($_POST['submit'])) {
    // Coletar os dados do formulário
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];
    $sexo = $_POST['sexo'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    // Atualizar os dados no banco de dados
    $sql = "UPDATE pessoas SET nome = '$nome', data_nascimento = '$data_nascimento', cpf = '$cpf', sexo = '$sexo', telefone = '$telefone', email = '$email' WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: consultar_pessoas.php'); // Redirecionar para a página de consulta
    } else {
        echo "Erro ao atualizar dados: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pessoa</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Editar Pessoa</h2>
    <form action="editar_pessoa.php?id=<?php echo $pessoa['id']; ?>" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $pessoa['nome']; ?>" required><br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $pessoa['data_nascimento']; ?>" required><br>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" value="<?php echo $pessoa['cpf']; ?>" required><br>

        <label for="sexo">Sexo:</label>
        <input type="text" id="sexo" name="sexo" value="<?php echo $pessoa['sexo']; ?>" required><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" value="<?php echo $pessoa['telefone']; ?>"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $pessoa['email']; ?>"><br>

        <button type="submit" name="submit">Atualizar</button>
    </form>
</body>
</html>
