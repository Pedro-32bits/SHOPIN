-- Banco de dados: `shopin`

CREATE TABLE `admin` (
  `cod_admin` INT(11) NOT NULL AUTO_INCREMENT,
  `login` INT(11) DEFAULT NULL,
  `nome` VARCHAR(100) DEFAULT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `senha` VARCHAR(20) DEFAULT NULL,
  PRIMARY KEY (`cod_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `categoria` (
  `cod_categoria` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (`cod_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `cliente` (
  `cod_cliente` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) DEFAULT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `senha` VARCHAR(20) DEFAULT NULL,
  `telefone` VARCHAR(20) DEFAULT NULL,
  `CPF` VARCHAR(14) DEFAULT NULL,
  `foto` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`cod_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `vendedor` (
  `cod_vendedor` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) DEFAULT NULL,
  `email` VARCHAR(100) DEFAULT NULL,
  `senha` VARCHAR(20) DEFAULT NULL,
  `telefone` VARCHAR(20) DEFAULT NULL,
  `CPF` VARCHAR(14) DEFAULT NULL,
  `CNPJ` VARCHAR(18) DEFAULT NULL,
  `foto` VARCHAR(255) DEFAULT NULL,
  `validacao` VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (`cod_vendedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `endereco` (
  `cod_endereco` INT(11) NOT NULL AUTO_INCREMENT,
  `cod_cliente` INT(11) DEFAULT NULL,
  `cod_vendedor` INT(11) DEFAULT NULL,
  `CEP` VARCHAR(10) DEFAULT NULL,
  `rua` VARCHAR(100) DEFAULT NULL,
  `bairro` VARCHAR(100) DEFAULT NULL,
  `ponto_referencia` VARCHAR(100) DEFAULT NULL,
  `num_casa` VARCHAR(10) DEFAULT NULL,
  PRIMARY KEY (`cod_endereco`),
  FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod_cliente`) ON DELETE CASCADE,
  FOREIGN KEY (`cod_vendedor`) REFERENCES `vendedor` (`cod_vendedor`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `produto` (
  `cod_produto` INT(11) NOT NULL AUTO_INCREMENT,
  `cod_vendedor` INT(11) DEFAULT NULL,
  `cod_categoria` INT(11) DEFAULT NULL,
  `nome` VARCHAR(100) DEFAULT NULL,
  `marca` VARCHAR(50) DEFAULT NULL,
  `estoque` INT(11) DEFAULT NULL,
  `descricao` VARCHAR(500) DEFAULT NULL,
  `valor` DECIMAL(10,2) DEFAULT NULL,
  `promocao` DECIMAL(10,2) DEFAULT NULL,
  PRIMARY KEY (`cod_produto`),
  FOREIGN KEY (`cod_vendedor`) REFERENCES `vendedor` (`cod_vendedor`),
  FOREIGN KEY (`cod_categoria`) REFERENCES `categoria` (`cod_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `foto` (
  `cod_foto` INT(11) NOT NULL AUTO_INCREMENT,
  `cod_produto` INT(11) DEFAULT NULL,
  `foto` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`cod_foto`),
  FOREIGN KEY (`cod_produto`) REFERENCES `produto` (`cod_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `pedido` (
  `cod_pedido` VARCHAR(50) NOT NULL,
  `cod_cliente` INT(11) DEFAULT NULL,
  `formaPag` VARCHAR(50) DEFAULT NULL,
  `preco` DECIMAL(10,2) DEFAULT NULL,
  `cupom` VARCHAR(50) DEFAULT NULL,
  `validacao` TINYINT(1) DEFAULT NULL,
  `notaF` VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (`cod_pedido`),
  FOREIGN KEY (`cod_cliente`) REFERENCES `cliente` (`cod_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `item_pedido` (
  `cod_pedido` VARCHAR(50) NOT NULL,
  `cod_produto` INT(11) NOT NULL,
  `qnt` INT(11) DEFAULT NULL,
  `avaliacao` DECIMAL(3,2) DEFAULT NULL,
  `resenha` VARCHAR(250) DEFAULT NULL,
  PRIMARY KEY (`cod_pedido`, `cod_produto`),
  FOREIGN KEY (`cod_pedido`) REFERENCES `pedido` (`cod_pedido`),
  FOREIGN KEY (`cod_produto`) REFERENCES `produto` (`cod_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `logistica` (
  `cod_logistica` INT(11) NOT NULL AUTO_INCREMENT,
  `cod_pedido` VARCHAR(50) DEFAULT NULL,
  `cod_vendedor` INT(11) DEFAULT NULL,
  `frete` VARCHAR(50) DEFAULT NULL,
  `local_produto` VARCHAR(100) DEFAULT NULL,
  `status_entrega` VARCHAR(50) DEFAULT NULL,
  PRIMARY KEY (`cod_logistica`),
  FOREIGN KEY (`cod_pedido`) REFERENCES `pedido` (`cod_pedido`),
  FOREIGN KEY (`cod_vendedor`) REFERENCES `vendedor` (`cod_vendedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
