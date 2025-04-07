<?php
$host = 'localhost';
$dbname = 'cadastro_imoveis_data';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
    exit;
}

// Função para validar CPF
function validaCPF($cpf) {
    $cpf = preg_replace('/\D/', '', $cpf);
    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) return false;
    for ($t = 9; $t < 11; $t++) {
        $d = 0;
        for ($c = 0; $c < $t; $c++) $d += $cpf[$c] * (($t + 1) - $c);
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$t] != $d) return false;
    }
    return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = htmlspecialchars(trim($_POST['nome']));
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = htmlspecialchars(trim($_POST['cpf']));
    $sexo = $_POST['sexo'];
    $telefone = htmlspecialchars(trim($_POST['telefone']));
    $email = htmlspecialchars(trim($_POST['email']));
    $endereco = htmlspecialchars(trim($_POST['endereco']));
    $cidade = htmlspecialchars(trim($_POST['cidade']));
    $estado = htmlspecialchars(trim($_POST['estado']));
    $cep = htmlspecialchars(trim($_POST['cep']));

    if (!validaCPF($cpf)) {
        echo "CPF inválido. Por favor, verifique o CPF informado.";
        exit;
    }

    try {
        $sql = "INSERT INTO pessoas (nome, data_nascimento, cpf, sexo, telefone, email, endereco, cidade, estado, cep) 
                VALUES (:nome, :data_nascimento, :cpf, :sexo, :telefone, :email, :endereco, :cidade, :estado, :cep)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':data_nascimento', $data_nascimento);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->bindValue(':sexo', $sexo);
        $stmt->bindValue(':telefone', $telefone);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':endereco', $endereco);
        $stmt->bindValue(':cidade', $cidade);
        $stmt->bindValue(':estado', $estado);
        $stmt->bindValue(':cep', $cep);
        $stmt->execute();

        echo "Cadastro realizado com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao cadastrar pessoa: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pessoa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #2c3e50, #3498db);
            color: #fff;
            text-align: center;
        }
        form {
            background-color: rgba(255, 255, 255, 0.9);
            max-width: 600px;
            margin: 20px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
            color: #333;
            display: block;
            margin-top: 10px;
        }
        input, select {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 2px solid #3498db;
            border-radius: 8px;
            background-color: #f8f9fa;
            box-sizing: border-box;
        }
        button {
            background-color: #2980b9;
            color: white;
            font-size: 1.2em;
            padding: 15px;
            width: 100%;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 15px;
        }
        button:hover {
            background-color: #1c5980;
        }
    </style>
</head>
<body>
    <h2>Cadastrar Pessoa</h2>
    <form method="POST" action="cadastro_pessoa.php">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required>

        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" required>
            <option value="masculino">Masculino</option>
            <option value="feminino">Feminino</option>
        </select>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone">

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email">

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" required>

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" required>

        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" required>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>