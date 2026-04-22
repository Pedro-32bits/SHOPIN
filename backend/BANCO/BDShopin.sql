-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/04/2026 às 01:24
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `shopin`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `admin`
--

CREATE TABLE `admin` (
  `cod_admin` int(11) NOT NULL,
  `login` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `admin`
--

INSERT INTO `admin` (`cod_admin`, `login`, `nome`, `email`, `senha`) VALUES
(1, 12345, 'Administrador', 'admin@sistema.com', 'admin123');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `cod_categoria` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`cod_categoria`, `nome`) VALUES
(1, 'Eletronicos');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `cod_cliente` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `CPF` varchar(14) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

CREATE TABLE `endereco` (
  `cod_endereco` int(11) NOT NULL,
  `cod_cliente` int(11) DEFAULT NULL,
  `cod_vendedor` int(11) DEFAULT NULL,
  `CEP` varchar(10) DEFAULT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `ponto_referencia` varchar(100) DEFAULT NULL,
  `num_casa` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `foto`
--

CREATE TABLE `foto` (
  `foto_PK` int(11) NOT NULL,
  `cod_produto` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `logistica`
--

CREATE TABLE `logistica` (
  `cod_logistica` int(11) NOT NULL,
  `cod_pedido` varchar(50) DEFAULT NULL,
  `cod_vendedor` int(11) DEFAULT NULL,
  `frete` varchar(50) DEFAULT NULL,
  `local_produto` varchar(100) DEFAULT NULL,
  `status_entrega` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `cod_pedido` varchar(50) NOT NULL,
  `cod_cliente` int(11) DEFAULT NULL,
  `formaPag` varchar(50) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `cupom` varchar(50) DEFAULT NULL,
  `validacao` tinyint(1) DEFAULT NULL,
  `notaF` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `possui`
--

CREATE TABLE `possui` (
  `cod_pedido` varchar(50) NOT NULL,
  `cod_produto` int(11) NOT NULL,
  `qnt` int(11) DEFAULT NULL,
  `avaliacao` decimal(3,2) DEFAULT NULL,
  `resenha` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `cod_produto` int(11) NOT NULL,
  `cod_vendedor` int(11) DEFAULT NULL,
  `cod_categoria` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `promocao` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendedor`
--

CREATE TABLE `vendedor` (
  `cod_vendedor` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `CPF` varchar(14) DEFAULT NULL,
  `CNPJ` varchar(18) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `validacao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vendedor`
--

INSERT INTO `vendedor` (`cod_vendedor`, `nome`, `email`, `senha`, `telefone`, `CPF`, `CNPJ`, `foto`, `validacao`) VALUES
(1, 'Minha Loja Tech', 'loja@tech.com', 'loja123', NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`cod_admin`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`cod_categoria`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cod_cliente`);

--
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`endereco_PK`),
  ADD KEY `fk_end_cliente` (`cod_cliente`),
  ADD KEY `fk_end_vendedor` (`cod_vendedor`);

--
-- Índices de tabela `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`foto_PK`),
  ADD KEY `cod_produto` (`cod_produto`);

--
-- Índices de tabela `logistica`
--
ALTER TABLE `logistica`
  ADD PRIMARY KEY (`cod_logistica`),
  ADD KEY `cod_pedido` (`cod_pedido`),
  ADD KEY `cod_vendedor` (`cod_vendedor`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`cod_pedido`),
  ADD KEY `cod_cliente` (`cod_cliente`);

--
-- Índices de tabela `possui`
--
ALTER TABLE `possui`
  ADD PRIMARY KEY (`cod_pedido`,`cod_produto`),
  ADD KEY `cod_produto` (`cod_produto`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`cod_produto`),
  ADD KEY `cod_vendedor` (`cod_vendedor`),
  ADD KEY `cod_categoria` (`cod_categoria`);

--
-- Índices de tabela `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`cod_vendedor`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `endereco_PK` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `fk_end_cliente` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod_cliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_end_vendedor` FOREIGN KEY (`cod_vendedor`) REFERENCES `vendedor` (`cod_vendedor`) ON DELETE CASCADE;

--
-- Restrições para tabelas `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`cod_produto`) REFERENCES `produto` (`cod_produto`);

--
-- Restrições para tabelas `logistica`
--
ALTER TABLE `logistica`
  ADD CONSTRAINT `logistica_ibfk_1` FOREIGN KEY (`cod_pedido`) REFERENCES `pedido` (`cod_pedido`),
  ADD CONSTRAINT `logistica_ibfk_2` FOREIGN KEY (`cod_vendedor`) REFERENCES `vendedor` (`cod_vendedor`);

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod_cliente`);

--
-- Restrições para tabelas `possui`
--
ALTER TABLE `possui`
  ADD CONSTRAINT `possui_ibfk_1` FOREIGN KEY (`cod_pedido`) REFERENCES `pedido` (`cod_pedido`),
  ADD CONSTRAINT `possui_ibfk_2` FOREIGN KEY (`cod_produto`) REFERENCES `produto` (`cod_produto`);

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`cod_vendedor`) REFERENCES `vendedor` (`cod_vendedor`),
  ADD CONSTRAINT `produto_ibfk_2` FOREIGN KEY (`cod_categoria`) REFERENCES `categoria` (`cod_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
