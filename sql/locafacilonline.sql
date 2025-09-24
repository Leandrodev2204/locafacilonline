-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/09/2025 às 04:06
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `locafacilonline`
--

CREATE DATABASE IF NOT EXISTS locafacilonline;

USE locafacilonline;

-- --------------------------------------------------------

--
-- Estrutura para tabela `carros`
--

CREATE TABLE `carros` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `modelo` varchar(100) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `ano` int(11) NOT NULL,
  `placa` varchar(10) NOT NULL,
  `chassi` varchar(17) NOT NULL,
  `cor` varchar(30) DEFAULT NULL,
  `quilometragem` int(11) DEFAULT NULL,
  `combustivel` enum('gasolina','etanol','diesel','flex','hibrido','eletrico') DEFAULT NULL,
  `portas` int(11) DEFAULT NULL,
  `passageiros` int(11) DEFAULT NULL,
  `transmissao` enum('automatico','manual') DEFAULT NULL,
  `ar_condicionado` tinyint(1) DEFAULT 1,
  `direcao_hidraulica` tinyint(1) DEFAULT 1,
  `airbag` tinyint(1) DEFAULT 1,
  `abs` tinyint(1) DEFAULT 1,
  `imagem_principal` varchar(255) DEFAULT NULL,
  `imagens` text DEFAULT NULL,
  `status` enum('disponivel','alugado','manutencao','indisponivel') DEFAULT 'disponivel',
  `valor_diaria` decimal(10,2) NOT NULL,
  `descricao` text DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carros`
--

INSERT INTO `carros` (`id`, `categoria_id`, `modelo`, `marca`, `ano`, `placa`, `chassi`, `cor`, `quilometragem`, `combustivel`, `portas`, `passageiros`, `transmissao`, `ar_condicionado`, `direcao_hidraulica`, `airbag`, `abs`, `imagem_principal`, `imagens`, `status`, `valor_diaria`, `descricao`, `data_criacao`) VALUES
(1, 1, 'Onix 1.0', 'Chevrolet', 2023, 'ABC1D23', '9BWZZZ377VT004251', 'Branco', 15000, 'flex', 4, 5, 'manual', 1, 1, 1, 1, 'onix.png', NULL, 'disponivel', 120.00, 'Carro econômico ideal para cidade, baixo consumo de combustível', '2025-09-15 01:29:30'),
(2, 1, 'HB20 1.0', 'Hyundai', 2023, 'DEF4G56', '9BWZZZ377VT004252', 'Prata', 12000, 'flex', 4, 5, 'manual', 1, 1, 1, 1, 'hb20.webp', NULL, 'alugado', 115.00, 'Compacto com bom espaço interno e acabamento de qualidade', '2025-09-15 01:29:30'),
(3, 2, 'Corolla 2.0', 'Toyota', 2023, 'STU7V89', '9BWZZZ377VT004256', 'Prata', 10000, 'flex', 4, 5, 'automatico', 1, 1, 1, 1, 'CorollaXei2024.png', NULL, 'indisponivel', 200.00, 'Sedan confiável com excelente conforto e tecnologia', '2025-09-15 01:29:42'),
(4, 2, 'Civic 1.5', 'Honda', 2023, 'WXY1Z23', '9BWZZZ377VT004257', 'Preto', 8000, 'flex', 4, 5, 'automatico', 1, 1, 1, 1, 'civic.webp', NULL, 'disponivel', 210.00, 'Design esportivo com performance e eficiência', '2025-09-15 01:29:42'),
(5, 3, 'CR-V 2.0', 'Honda', 2023, 'NOP4Q56', '9BWZZZ377VT004261', 'Prata', 7000, 'flex', 4, 5, 'automatico', 1, 1, 1, 1, 'crv.png', NULL, 'disponivel', 280.00, 'SUV médio espaçoso com tração 4x4 e conforto', '2025-09-15 01:29:58'),
(6, 3, 'RAV4 2.0', 'Toyota', 2023, 'RST7U89', '9BWZZZ377VT004262', 'Branco', 6000, 'flex', 4, 5, 'automatico', 1, 1, 1, 1, 'rav.png', NULL, 'disponivel', 290.00, 'Robusto e confiável, ideal para família e viagens', '2025-09-15 01:29:58'),
(7, 4, 'A4 2.0', 'Audi', 2023, 'HIJ1K23', '9BWZZZ377VT004266', 'Preto', 5000, 'gasolina', 4, 5, 'automatico', 1, 1, 1, 1, 'audi_a4.webp', NULL, 'indisponivel', 450.00, 'Sedan premium com tecnologia de ponta e conforto', '2025-09-15 01:30:13'),
(8, 4, 'C180', 'Mercedes-Benz', 2023, 'LMN4O56', '9BWZZZ377VT004267', 'Prata', 4000, 'gasolina', 4, 5, 'automatico', 1, 1, 1, 1, 'c180.webp', NULL, 'indisponivel', 480.00, 'Elegância alemã com interior luxuoso', '2025-09-15 01:30:13'),
(9, 5, 'Fiorino Furgão', 'Fiat', 2023, 'BCD7E89', '9BWZZZ377VT004271', 'Branco', 25000, 'flex', 2, 2, 'manual', 1, 1, 1, 1, 'fiorino.webp', NULL, 'disponivel', 150.00, 'Utilitário compacto ideal para carga urbana', '2025-09-15 01:30:25'),
(10, 5, 'Saveiro Robust', 'Volkswagen', 2023, 'FGH1I23', '9BWZZZ377VT004272', 'Prata', 20000, 'diesel', 2, 2, 'manual', 1, 1, 1, 1, 'saveiro.png', NULL, 'disponivel', 160.00, 'Picape versátil para trabalho e carga', '2025-09-15 01:30:25');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` text DEFAULT NULL,
  `preco_diaria` decimal(10,2) NOT NULL,
  `limite_km_diario` int(11) DEFAULT NULL,
  `seguro_incluso` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`, `descricao`, `preco_diaria`, `limite_km_diario`, `seguro_incluso`) VALUES
(1, 'Econômica', 'Carros compactos e econômicos', 120.00, NULL, 1),
(2, 'Intermediário', 'Sedans confortáveis', 200.00, NULL, 1),
(3, 'SUV', 'Veículos utilitários esportivos', 280.00, NULL, 1),
(4, 'Luxo', 'Carros premium', 450.00, NULL, 1),
(5, 'Utilitário', 'Veículos para carga', 150.00, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `contatos`
--

CREATE TABLE `contatos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `assunto` varchar(150) NOT NULL,
  `mensagem` text NOT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contatos`
--

INSERT INTO `contatos` (`id`, `nome`, `email`, `assunto`, `mensagem`, `data_envio`) VALUES
(1, 'Fulano de Tal', 'fulano@detal.com', 'teste', 'teste', '2025-09-20 04:04:57'),
(2, 'Fulano de Tal', 'fulano@detal.com', 'teste2', 'testando a funcionalidade', '2025-09-20 04:13:54'),
(3, 'Fulano de Tal', 'fulano@detal.com', 'teste2', 'testando a funcionalidade', '2025-09-20 04:14:17'),
(4, 'Leandro Torres Louzeiro da Silva', 'leotorreslouzeiro@hotmail.com', '12354564', '89.89.87987867', '2025-09-20 04:23:39');

-- --------------------------------------------------------

--
-- Estrutura para tabela `manutencoes`
--

CREATE TABLE `manutencoes` (
  `id` int(11) NOT NULL,
  `carro_id` int(11) DEFAULT NULL,
  `tipo` enum('preventiva','corretiva','revisao') DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `custo` decimal(10,2) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `quilometragem` int(11) DEFAULT NULL,
  `fornecedor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamentos`
--

CREATE TABLE `pagamentos` (
  `id` int(11) NOT NULL,
  `reserva_id` int(11) DEFAULT NULL,
  `metodo` enum('cartao_credito','cartao_debito','pix','boleto') DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `status` enum('pendente','aprovado','recusado','reembolsado') DEFAULT NULL,
  `data_pagamento` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `codigo_transacao` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `carro_id` int(11) DEFAULT NULL,
  `data_reserva` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `status` enum('pendente','confirmada','em_andamento','concluida','cancelada') DEFAULT 'pendente',
  `local_retirada` varchar(100) DEFAULT NULL,
  `local_devolucao` varchar(100) DEFAULT NULL,
  `observacoes` text DEFAULT NULL,
  `seguro_adicional` tinyint(1) DEFAULT 0,
  `quilometragem_inicial` int(11) DEFAULT NULL,
  `quilometragem_final` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `reservas`
--

INSERT INTO `reservas` (`id`, `cliente_id`, `carro_id`, `data_reserva`, `data_inicio`, `data_fim`, `valor_total`, `status`, `local_retirada`, `local_devolucao`, `observacoes`, `seguro_adicional`, `quilometragem_inicial`, `quilometragem_final`) VALUES
(1, NULL, 2, '2025-09-15 01:41:24', '2025-09-15', '2025-09-20', 690.00, 'pendente', NULL, NULL, NULL, 0, NULL, NULL),
(2, NULL, 3, '2025-09-20 04:01:01', '2025-09-24', '2025-09-25', 400.00, 'pendente', NULL, NULL, NULL, 0, NULL, NULL),
(3, NULL, 7, '2025-09-20 04:11:36', '2025-09-20', '2025-09-27', 3600.00, 'pendente', NULL, NULL, NULL, 0, NULL, NULL),
(4, NULL, 8, '2025-09-20 04:22:58', '2025-09-20', '2025-09-26', 3360.00, 'pendente', NULL, NULL, NULL, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `tipo` enum('cliente','gerente','administrador') NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `endereco` text DEFAULT NULL,
  `cnh_numero` varchar(20) DEFAULT NULL,
  `cnh_validade` date DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- insere o registro do leandro
INSERT INTO `locafacilonline`.`usuarios` (`tipo`, `nome`, `email`, `senha`, `cpf`, `telefone`, `data_nascimento`, `endereco`, `cnh_numero`, `cnh_validade`, `ativo`) 
VALUES ('cliente', 'leandro', 'leandro@teste.com', '123456', '12345678912', '619999999', '2000-04-22', 'Quadra 1 Conj B', '12345879', '2026-09-22', '1');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carros`
--
ALTER TABLE `carros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `placa` (`placa`),
  ADD UNIQUE KEY `chassi` (`chassi`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `manutencoes`
--
ALTER TABLE `manutencoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carro_id` (`carro_id`);

--
-- Índices de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reserva_id` (`reserva_id`);

--
-- Índices de tabela `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `carro_id` (`carro_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carros`
--
ALTER TABLE `carros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `contatos`
--
ALTER TABLE `contatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `manutencoes`
--
ALTER TABLE `manutencoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pagamentos`
--
ALTER TABLE `pagamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carros`
--
ALTER TABLE `carros`
  ADD CONSTRAINT `carros_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Restrições para tabelas `manutencoes`
--
ALTER TABLE `manutencoes`
  ADD CONSTRAINT `manutencoes_ibfk_1` FOREIGN KEY (`carro_id`) REFERENCES `carros` (`id`);

--
-- Restrições para tabelas `pagamentos`
--
ALTER TABLE `pagamentos`
  ADD CONSTRAINT `pagamentos_ibfk_1` FOREIGN KEY (`reserva_id`) REFERENCES `reservas` (`id`);

--
-- Restrições para tabelas `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`carro_id`) REFERENCES `carros` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
