<?php
// Conexão com o banco de dados
$host = 'localhost';
$dbname = 'seu_banco_de_dados';
$username = 'root';
$password = '';

try {
    // Criando a conexão com PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Exibindo erro de conexão
    echo 'Erro de conexão: ' . $e->getMessage();
    exit;
}

// Função para validar CPF
function validaCPF($cpf) {
    // Remove caracteres não numéricos
    $cpf = preg_replace('/\D/', '', $cpf);

    if (strlen($cpf) != 11) return false;

    // Verifica se todos os números são iguais
    if (preg_match('/(\d)\1{10}/', $cpf)) return false;

    // Valida CPF utilizando o algoritmo
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - ($c + 1)); // Correção aqui
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) return false; // Correção aqui
    }

    return true;
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $cpf = $_POST['cpf'];
    $sexo = $_POST['sexo'];
    $telefone = $_POST['telefone'] ?? null;  // opcional
    $email = $_POST['email'] ?? null;        // opcional

    // Valida CPF
    if (!validaCPF($cpf)) {
        echo "CPF inválido. Por favor, verifique o CPF informado.";
        exit;
    }

    // Valida e-mail
    if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "E-mail inválido. Por favor, insira um e-mail válido.";
        exit;
    }

    // Prepara o comando SQL para inserir os dados
    $sql = "INSERT INTO pessoas (nome, data_nascimento, cpf, sexo, telefone, email) 
            VALUES (:nome, :data_nascimento, :cpf, :sexo, :telefone, :email)";
    
    try {
        $stmt = $pdo->prepare($sql);

        // Executa a inserção no banco de dados
        if ($stmt->execute([
            ':nome' => $nome,
            ':data_nascimento' => $data_nascimento,
            ':cpf' => $cpf,
            ':sexo' => $sexo,
            ':telefone' => $telefone,
            ':email' => $email
        ])) {
            echo "Pessoa cadastrada com sucesso!";
        } else {
            echo "Erro ao cadastrar pessoa!";
        }
    } catch (PDOException $e) {
        echo 'Erro ao inserir dados: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pessoa</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #2c3e50, #3498db);
            color: #fff;
        }

        h2 {
            text-align: center;
            font-size: 2.5em;
            margin-top: 50px;
            color: #ecf0f1;
        }

        form {
            background-color: rgba(255, 255, 255, 0.9);
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input[type="text"], input[type="date"], input[type="email"], select {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: 2px solid #3498db;
            border-radius: 8px;
            background-color: #f8f9fa;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus, input[type="date"]:focus, input[type="email"]:focus, select:focus {
            border-color: #2980b9;
            background-color: #eaf1f7;
        }

        button {
            background-color: #2980b9;
            color: white;
            font-size: 1.2em;
            padding: 15px 30px;
            width: 100%;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1c5980;
        }

        .error {
            color: red;
            text-align: center;
            font-size: 1.2em;
        }
    </style>
</head>
<body>

    <h2>Cadastro de Pessoa</h2>
    
    <form action="cadastrar_pessoa.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required><br>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" required><br>

        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" required>
            <option value="masculino">Masculino</option>
            <option value="feminino">Feminino</option>
        </select><br>

        <label for="telefone">Telefone (opcional):</label>
        <input type="text" id="telefone" name="telefone"><br>

        <label for="email">E-mail (opcional):</label>
        <input type="email" id="email" name="email"><br>

        <button type="submit">Cadastrar</button>
    </form>

</body>
</html>