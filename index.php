<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de Cadastro de Imóveis da Prefeitura de São Leopoldo. Cadastre pessoas e imóveis para gestão de IPTU.">
    <meta name="keywords" content="Cadastro, Imóveis, IPTU, Prefeitura, São Leopoldo">
    <title>Cadastro de Imóveis - Prefeitura de São Leopoldo</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Arquivo de estilos -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon -->
    <style>
        /* Estilos para a tabela ultra moderna com efeito hover */
        .tabela-moderna {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 10px;
            margin: 30px 0;
            font-family: 'Poppins', sans-serif;
        }
        
        .tabela-moderna th {
            background: linear-gradient(135deg, #2980b9, #1a5276);
            color: white;
            padding: 18px 25px;
            text-align: left;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 1px;
            font-size: 1.1em;
            box-shadow: 0 4px 15px rgba(41, 128, 185, 0.3);
        }
        
        .tabela-moderna tbody tr {
            transform: scale(0.98);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            margin-bottom: 12px;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(5px);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .tabela-moderna td {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px 25px;
            position: relative;
            border: none;
            font-size: 1em;
            color: rgba(0, 0, 0, 0);
            text-shadow: 0 0 8px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
            transition: all 0.4s ease;
        }
        
        .tabela-moderna td::before {
            content: "Passe o cursor para revelar";
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            color: #888;
            font-style: italic;
            opacity: 0.8;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }
        
        .tabela-moderna tbody tr:hover {
            transform: scale(1.01);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            z-index: 10;
        }
        
        .tabela-moderna tbody tr:hover td {
            background: linear-gradient(to right, rgba(240, 248, 255, 0.9), rgba(230, 240, 250, 0.9));
            color: #222;
            text-shadow: none;
            border-top: 1px solid rgba(41, 128, 185, 0.2);
            border-bottom: 1px solid rgba(41, 128, 185, 0.2);
        }
        
        .tabela-moderna tbody tr:hover td::before {
            opacity: 0;
        }
        
        .tabela-moderna tr td:first-child {
            border-top-left-radius: 12px;
            border-bottom-left-radius: 12px;
        }
        
        .tabela-moderna tr td:last-child {
            border-top-right-radius: 12px;
            border-bottom-right-radius: 12px;
        }
        
        /* Adiciona efeito de luz ao passar o mouse */
        .tabela-moderna tbody tr::after {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                rgba(255, 255, 255, 0),
                rgba(255, 255, 255, 0),
                rgba(255, 255, 255, 0.3),
                rgba(255, 255, 255, 0)
            );
            transform: rotate(30deg);
            opacity: 0;
            transition: transform 0.7s ease, opacity 0.6s ease;
            pointer-events: none;
        }
        
        .tabela-moderna tbody tr:hover::after {
            opacity: 1;
            transform: rotate(30deg) translate(10%, 10%);
        }
        
        /* Decoração de ícones para cada linha */
        .tabela-moderna td span.icon {
            display: inline-block;
            width: 0;
            margin-right: 0;
            opacity: 0;
            transform: translateX(-20px);
            transition: all 0.4s ease;
        }
        
        .tabela-moderna tr:hover td span.icon {
            width: 20px;
            margin-right: 10px;
            opacity: 1;
            transform: translateX(0);
        }
        
        /* Efeito de destaque para o conteúdo */
        @keyframes revealText {
            0% { clip-path: inset(0 100% 0 0); }
            100% { clip-path: inset(0 0 0 0); }
        }
        
        .tabela-moderna tbody tr:hover td .content {
            animation: revealText 0.5s forwards;
        }
    </style>
</head>
<body>
    <div id="overlay" class="hidden"></div> <!-- Sobreposição da vinheta -->

    <header role="banner">
        <h1>Bem-vindo ao Sistema de Cadastro de Imóveis</h1>
        <nav role="navigation">
            <ul>
                <li><a href="cadastros/cadastro_pessoa.php">Cadastro de Pessoa</a></li>
                <li><a href="cadastros/cadastro_imovel.php">Cadastro de Imóvel</a></li>
                <li><a href="consultas/consultar_pessoas.php">Consultar Pessoas</a></li>
                <li><a href="consultas/consultar_imoveis.php">Consultar Imóveis</a></li>
                <li><a href="login.php" class="btn-login">Acessar Sistema</a></li>
                <li><a href="cadastro.php" class="botao-cadastro">Cadastrar-se</a></li>
            </ul>
        </nav>
    </header>

    <main role="main">
        <section>
            <h2>Objetivo do Sistema</h2>
            
            <table class="tabela-moderna">
                <thead>
                    <tr>
                        <th>Informações do Sistema</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <span class="icon">📊</span>
                            <span class="content">Este sistema foi desenvolvido para o setor de IPTU da Secretaria da Fazenda da Prefeitura Municipal de São Leopoldo.</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="icon">👤</span>
                            <span class="content">Permite o cadastro de pessoas (proprietários) com validação de CPF/CNPJ para fins de gestão de IPTU.</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="icon">🏠</span>
                            <span class="content">Permite o cadastro de imóveis com geolocalização para controle e emissão de guias de IPTU.</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="icon">🔍</span>
                            <span class="content">Oferece consultas integradas de proprietários e seus respectivos imóveis com filtros avançados.</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="icon">🔒</span>
                            <span class="content">Acesso restrito com autenticação de dois fatores para garantir a segurança dos dados cadastrais.</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <footer role="contentinfo">
        <p>&copy; 2025 Prefeitura Municipal de São Leopoldo | Todos os direitos reservados</p>
        <nav>
            <ul>
                <li><a href="privacy_policy.php">Política de Privacidade</a></li>
                <li><a href="terms_of_service.php">Termos de Serviço</a></li>
            </ul>
        </nav>
    </footer>

    <script src="js/script.js"></script> <!-- Arquivo de script -->
</body>
</html>