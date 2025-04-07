-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 07/04/2025 às 05:35
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cadastro_imoveis_data`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `imoveis`
--

CREATE TABLE `imoveis` (
  `id` int(11) NOT NULL,
  `proprietario` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `tipo` enum('residencial','comercial') NOT NULL,
  `valor` float NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `imoveis`
--

INSERT INTO `imoveis` (`id`, `proprietario`, `endereco`, `cidade`, `estado`, `tipo`, `valor`, `criado_em`) VALUES
(1, 'josiane', 'rua cristaldo 544', 'aragua', 'rs', 'comercial', 340000, '2025-04-05 23:27:58'),
(2, 'João Silva', 'Rua das Flores, 123', 'São Paulo', 'SP', 'residencial', 350000, '2025-04-06 04:07:03'),
(3, 'Maria Oliveira', 'Avenida Brasil, 456', 'Rio de Janeiro', 'RJ', 'comercial', 1200000, '2025-04-06 04:07:03'),
(4, 'Carlos Pereira', 'Rua Minas Gerais, 789', 'Belo Horizonte', 'MG', 'residencial', 450000, '2025-04-06 04:07:03'),
(5, 'Ana Costa', 'Rua Paraná, 321', 'Curitiba', 'PR', 'residencial', 280000, '2025-04-06 04:07:03'),
(6, 'Lucas Souza', 'Rua Rio Grande, 654', 'Porto Alegre', 'RS', 'comercial', 950000, '2025-04-06 04:07:03'),
(7, 'Fernanda Lima', 'Avenida Paulista, 1000', 'São Paulo', 'SP', 'comercial', 2000000, '2025-04-06 04:07:03'),
(8, 'Pedro Santos', 'Rua Bahia, 222', 'Salvador', 'BA', 'residencial', 320000, '2025-04-06 04:07:03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `sexo` enum('masculino','feminino') NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cep` varchar(20) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `nome`, `data_nascimento`, `cpf`, `sexo`, `telefone`, `email`, `endereco`, `cidade`, `estado`, `cep`, `criado_em`) VALUES
(1, 'Roberto Nascimento', '2000-12-12', '483.904.030-30', 'masculino', '51 9756-8795', 'robertonascimento@gmail.com', 'Rua Primeiro de Março 567', 'São Leopoldo', 'RS', '95403-456', '2025-04-06 04:01:28'),
(2, 'João Silva', '1990-05-15', '12345678901', 'masculino', '(11) 98765-4321', 'joao.silva@email.com', 'Rua das Flores, 123', 'São Paulo', 'SP', '01001-000', '2025-04-06 04:05:07'),
(3, 'Maria Oliveira', '1985-08-22', '98765432100', 'feminino', '(21) 99876-5432', 'maria.oliveira@email.com', 'Avenida Brasil, 456', 'Rio de Janeiro', 'RJ', '20040-001', '2025-04-06 04:05:07'),
(4, 'Carlos Pereira', '1978-03-10', '45678912302', 'masculino', '(31) 91234-5678', 'carlos.pereira@email.com', 'Rua Minas Gerais, 789', 'Belo Horizonte', 'MG', '30130-010', '2025-04-06 04:05:07'),
(5, 'Ana Costa', '1995-12-05', '78912345603', 'feminino', '(41) 92345-6789', 'ana.costa@email.com', 'Rua Paraná, 321', 'Curitiba', 'PR', '80010-020', '2025-04-06 04:05:07'),
(6, 'Lucas Souza', '2000-07-18', '32165498704', 'masculino', '(51) 93456-7890', 'lucas.souza@email.com', 'Rua Rio Grande, 654', 'Porto Alegre', 'RS', '90010-030', '2025-04-06 04:05:07');

-- --------------------------------------------------------

--
-- Estrutura para tabela `relacionamentos`
--

CREATE TABLE `relacionamentos` (
  `id` int(11) NOT NULL,
  `tipo_relacao` varchar(100) NOT NULL,
  `pessoa_id` int(11) NOT NULL,
  `outra_pessoa_id` int(11) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo` enum('admin','usuario') DEFAULT 'usuario',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `token` varchar(255) DEFAULT NULL,
  `token_expira_em` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`, `criado_em`, `token`, `token_expira_em`) VALUES
(1, 'Gabriel Lopes Rocha de Moraes', 'gabriel.lopos4@gmail.com', '$2y$10$JKl5arKQHH6h5cMoP3BpQ.aql6QG6rPYqAuE9LjWGnOKgXgJqGKR2', 'usuario', '2025-04-05 22:41:56', 'a63fcfd62f44491da1fce983988f5da4e2a5d55a7dc62cc3b2b39a748752c70805bc2b665fa94f569121212cb6e3c5510639', '2025-04-06 07:25:59');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `imoveis`
--
ALTER TABLE `imoveis`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `relacionamentos`
--
ALTER TABLE `relacionamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pessoa_id` (`pessoa_id`),
  ADD KEY `outra_pessoa_id` (`outra_pessoa_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `imoveis`
--
ALTER TABLE `imoveis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `relacionamentos`
--
ALTER TABLE `relacionamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `relacionamentos`
--
ALTER TABLE `relacionamentos`
  ADD CONSTRAINT `relacionamentos_ibfk_1` FOREIGN KEY (`pessoa_id`) REFERENCES `pessoas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `relacionamentos_ibfk_2` FOREIGN KEY (`outra_pessoa_id`) REFERENCES `pessoas` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
