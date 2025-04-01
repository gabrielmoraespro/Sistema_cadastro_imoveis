<?php
// Conectar ao banco de dados
include('../config/db_connect.php');

// Verificar se o ID do imóvel foi passado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buscar os dados do imóvel no banco de dados
    $sql = "SELECT * FROM imoveis WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $imovel = mysqli_fetch_assoc($result);
}

// Verificar se o formulário foi submetido
if (isset($_POST['submit'])) {
    // Coletar os dados do formulário
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $complemento = $_POST['complemento'];
    $contribuinte = $_POST['contribuinte'];

    // Atualizar os dados no banco de dados
    $sql = "UPDATE imoveis SET logradouro = '$logradouro', numero = '$numero', bairro = '$bairro', complemento = '$complemento', contribuinte = '$contribuinte' WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: consultar_imoveis.php'); // Redirecionar para a página de consulta
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
    <title>Editar Imóvel</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h2>Editar Imóvel</h2>
    <form action="editar_imovel.php?id=<?php echo $imovel['id']; ?>" method="POST">
        <label for="logradouro">Logradouro:</label>
        <input type="text" id="logradouro" name="logradouro" value="<?php echo $imovel['logradouro']; ?>" required><br>

        <label for="numero">Número:</label>
        <input type="text" id="numero" name="numero" value="<?php echo $imovel['numero']; ?>" required><br>

        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro" value="<?php echo $imovel['bairro']; ?>" required><br>

        <label for="complemento">Complemento:</label>
        <input type="text" id="complemento" name="complemento" value="<?php echo $imovel['complemento']; ?>"><br>

        <label for="contribuinte">Contribuinte (Proprietário):</label>
        <select id="contribuinte" name="contribuinte" required>
            <?php
                // Buscar as pessoas cadastradas para serem selecionadas
                $sql_pessoas = "SELECT * FROM pessoas";
                $result_pessoas = mysqli_query($conn, $sql_pessoas);
                while ($pessoa = mysqli_fetch_assoc($result_pessoas)) {
                    $selected = ($pessoa['id'] == $imovel['contribuinte']) ? 'selected' : '';
                    echo "<option value='" . $pessoa['id'] . "' $selected>" . $pessoa['nome'] . "</option>";
                }
            ?>
        </select><br>

        <button type="submit" name="submit">Atualizar</button>
    </form>
</body>
</html>
