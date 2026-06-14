-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 15/06/2026 às 01:57
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

--
-- Despejando dados para a tabela `endereco`
--

INSERT INTO `endereco` (`cod_endereco`, `cod_usuario`, `CEP`, `rua`, `bairro`, `ponto_referencia`, `num_casa`) VALUES
(1, 100, '11111-11', 'Maria de Lourde Terceiro Chagas', '2 de agosto', 'proxima ao presidio ', '716'),
(2, 6, '11111-111', 'bobos', 'balão magico', 'EU ', '0');

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
(2, 5, 'img/produtos/1781234842_5_download__2_.jpg'),
(3, 6, 'img/produtos/1781318368_6_1779643022_3_download.jpg');

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

--
-- Despejando dados para a tabela `pedido`
--

INSERT INTO `pedido` (`cod_pedido`, `cod_usuario`, `formaPag`, `preco`, `cupom`, `validacao`, `notaF`) VALUES
('PED20260614234636650', 100, 'Boleto', 1079.99, NULL, 1, 'NF-PED20260614234636650');

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

--
-- Despejando dados para a tabela `possui`
--

INSERT INTO `possui` (`cod_pedido`, `cod_produto`, `qnt`, `avaliacao`, `resenha`) VALUES
('PED20260614234636650', 5, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `cod_produto` int(11) NOT NULL,
  `cod_usuario` int(11) DEFAULT NULL,
  `cod_categoria` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `promocao` decimal(10,2) DEFAULT NULL,
  `estoque` int(11) NOT NULL,
  `vendidos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produto`
--

INSERT INTO `produto` (`cod_produto`, `cod_usuario`, `cod_categoria`, `nome`, `marca`, `descricao`, `valor`, `promocao`, `estoque`, `vendidos`) VALUES
(5, 6, 20, 'guitarra peixe', 'fell good inc ', 'guitarra em formato de peixe', 1200.00, 1079.99, 0, 1),
(6, 6, 20, 'Red Moon', 'fell good inc', 'A única guitarra capaz de derrubar regimes, amizades e a afinação da banda ao mesmo tempo.\r\n\r\nCansado de guitarras comuns que apenas fazem música? Apresentamos a Red Moon, uma obra-prima inspirada em uma certa ferramenta agrícola historicamente associada a revoluções e conversas extremamente desconfortáveis em aulas de história.', 2000.00, 1990.99, 67, 0);

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
  `foto` varchar(255) DEFAULT NULL,
  `tipo` varchar(20) DEFAULT 'cliente',
  `validacao` varchar(50) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`cod_usuario`, `nome`, `email`, `senha`, `telefone`, `cpf`, `cnpj`, `foto`, `tipo`, `validacao`, `data_nascimento`) VALUES
(6, 'pedrinho', 'pedrinho.jembamole@gmail.com', 'aws', '(88) 99735-3939', '088.952.883-78', '', '', 'vendedor', NULL, NULL),
(7, 'PEDRO LUCAS FREITAS DE OLIVEIRA', 'pedro.oliveira562@aluno.ce.gov.br', '123qwe', '(12) 00000-0000', '000.000.000-00', '', '', 'vendedor', NULL, NULL),
(100, 'Luiz felipe', 'luiz@gmail.com', 'aws', '(88) 99735-3939', '08895288378', '', NULL, 'cliente', NULL, NULL);

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
  ADD KEY `cod_usuario` (`cod_usuario`);

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
  ADD KEY `cod_usuario` (`cod_usuario`),
  ADD KEY `cod_categoria` (`cod_categoria`);

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
  MODIFY `cod_endereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `foto`
--
ALTER TABLE `foto`
  MODIFY `cod_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `endereco`
--
ALTER TABLE `endereco`
  ADD CONSTRAINT `fk_endereco_usuario` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `fk_foto_produto` FOREIGN KEY (`cod_produto`) REFERENCES `produto` (`cod_produto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `possui`
--
ALTER TABLE `possui`
  ADD CONSTRAINT `fk_possui_pedido` FOREIGN KEY (`cod_pedido`) REFERENCES `pedido` (`cod_pedido`),
  ADD CONSTRAINT `fk_possui_produto` FOREIGN KEY (`cod_produto`) REFERENCES `produto` (`cod_produto`);

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_produto_categoria` FOREIGN KEY (`cod_categoria`) REFERENCES `categoria` (`cod_categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_produto_usuario` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
