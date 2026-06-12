-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/06/2026 às 15:10
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
(1, 'Eletronicos'),
(2, 'Alimentos e Bebidas'),
(3, 'Automotivo'),
(4, 'Bebês e Cia'),
(5, 'Beleza e Perfumaria'),
(6, 'Brinquedos e Jogos'),
(7, 'Cama, Mesa e Banho'),
(8, 'Câmeras e Filmadoras'),
(9, 'Casa e Decoração'),
(10, 'Celulares e Smartphones'),
(11, 'Climatização e Ventilação'),
(12, 'Consoles e Videogames'),
(13, 'Eletrodomésticos'),
(14, 'Eletroportáteis'),
(15, 'Esporte e Lazer'),
(16, 'Ferramentas e Jardim'),
(17, 'Fotografia e Áudio'),
(18, 'Gamer'),
(19, 'Informática e Acessórios'),
(20, 'Instrumentos Musicais'),
(21, 'Joias e Relógios'),
(22, 'Livros e Revistas'),
(23, 'Moda Feminina'),
(24, 'Moda Masculina'),
(25, 'Moda Infantil'),
(26, 'Calçados'),
(27, 'Malas e Mochilas'),
(28, 'Papelaria e Escritório'),
(29, 'Pet Shop'),
(30, 'Saúde e Bem-Estar'),
(31, 'Suplementos Alimentares'),
(32, 'TV e Vídeo'),
(33, 'Utilidades Domésticas'),
(34, 'Artigos de Festa'),
(35, 'Artesanato'),
(36, 'Áudio Portátil'),
(37, 'Automotivo - Pneus'),
(38, 'Bicicletas e Acessórios'),
(39, 'Calçados Esportivos'),
(40, 'Camping e Pesca'),
(41, 'Colecionáveis e Action Figures'),
(42, 'Construção e Reforma'),
(43, 'Cosméticos Naturais'),
(44, 'Decoração de Natal'),
(45, 'Filmes e Séries'),
(46, 'Iluminação Residencial'),
(47, 'Lingerie e Moda Íntima'),
(48, 'Material Escolar'),
(49, 'Móveis de Escritório'),
(50, 'Segurança Residencial'),
(51, 'Smart Home e Automação');
(52, 'decoração');

-- --------------------------------------------------------

--
-- Estrutura para tabela `endereco`
--

CREATE TABLE `endereco` (
  `cod_endereco` int(11) NOT NULL,
  `cod_usuario` int(11) DEFAULT NULL,
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
  `cod_foto` int(11) NOT NULL,
  `cod_produto` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `foto`
--

INSERT INTO `foto` (`cod_foto`, `cod_produto`, `foto`) VALUES
(1, 3, 'img/produtos/1779643022_3_download.jpg'),
(2, 4, 'img/produtos/1781033502_4_santa_ceia_entalhada.webp');

-- --------------------------------------------------------

--
-- Estrutura para tabela `logistica`
--

CREATE TABLE `logistica` (
  `cod_logistica` int(11) NOT NULL,
  `cod_pedido` varchar(50) DEFAULT NULL,
  `cod_usuario` int(11) DEFAULT NULL,
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
  `cod_usuario` int(11) DEFAULT NULL,
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
  `cod_categoria` int(11) DEFAULT NULL,
  `cod_usuario` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `promocao` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`cod_produto`, `cod_categoria`, `cod_usuario`, `nome`, `marca`, `descricao`, `valor`, `promocao`) VALUES
(3, 1, NULL, 'guitarra comunista', 'fell good inc ', 'a guitarra perfeita para professores de humanas ', 1922.00, 22.00),
(4, 49, 1, 'quadro santa ceia', 'madeira', 'quadro da ultima ceia de jejus com os apóstolos esculpido na madeira ', 10000.00, 0.00),
(5, 1, 2, 'Aipad-16A', 'apple', 'Processador: Apple A16 BionicTela: Liquid Retina Multi-Touch de 10,86 polegadas (2360 x 1640 pixels, 264 dpi)Armazenamento: Opções de 128 GB, 256 GB e 512 GBCâmeras: Traseira de 12 MP (4K) e frontal Center Stage de 12 MPConectividade: Wi-Fi 6 e versões Wi-Fi + CellularBateria: Duração para o dia todo (porta USB-C)', 4000.00, 3892.99),
(6, 41, 2, 'galinha', 'plastico', 'muito chique ', 10000.00, 1.99);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `cod_usuario` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(20) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT 'cliente',
  `data_nascimento` datetime DEFAULT NULL,
  `validacao` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`cod_usuario`, `nome`, `email`, `senha`, `telefone`, `cpf`, `cnpj`, `tipo`, `data_nascimento`, `validacao`) VALUES
(1, 'PEDRO LUCAS FREITAS DE OLIVEIRA', 'pedro.oliveira562@aluno.ce.gov.br', '123qwe', '(11) 11111-1111', '222.222.222-22', '', 'vendedor', NULL, NULL),
(2, 'Shopin A', 'shopin.a2k24@gmail.com', '123qwe', '(00) 00000-0000', '', '', 'vendedor', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`cod_categoria`);

--
-- Índices de tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`cod_endereco`),
  ADD KEY `cod_usuario` (`cod_usuario`);

--
-- Índices de tabela `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`cod_foto`),
  ADD KEY `cod_produto` (`cod_produto`);

--
-- Índices de tabela `logistica`
--
ALTER TABLE `logistica`
  ADD PRIMARY KEY (`cod_logistica`),
  ADD KEY `cod_pedido` (`cod_pedido`),
  ADD KEY `cod_usuario` (`cod_usuario`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`cod_pedido`),
  ADD KEY `pedido_ibfk_1` (`cod_usuario`);

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
  ADD KEY `cod_categoria` (`cod_categoria`),
  ADD KEY `produto_ibfk_1` (`cod_usuario`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `cod_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `cod_endereco` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `foto`
--
ALTER TABLE `foto`
  MODIFY `cod_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `logistica`
--
ALTER TABLE `logistica`
  MODIFY `cod_logistica` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `cod_produto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `endereco_ibfk_1` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`);

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
  ADD CONSTRAINT `logistica_ibfk_2` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`);

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`);

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
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`),
  ADD CONSTRAINT `produto_ibfk_2` FOREIGN KEY (`cod_categoria`) REFERENCES `categoria` (`cod_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
