-- Geração de Modelo Físico Corrigido
-- Padrão SQL ANSI

------------------------------------------------------ 
-- CATEGORIA
------------------------------------------------------ 
CREATE TABLE Categoria (
    cod_categoria INTEGER PRIMARY KEY,
    nome VARCHAR(100)
);

------------------------------------------------------ 
-- VENDEDOR
------------------------------------------------------ 
CREATE TABLE Vendedor (
    cod_vendedor INTEGER PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    senha VARCHAR(255),
    telefone VARCHAR(20),
    CPF VARCHAR(14),
    CNPJ VARCHAR(18),
    foto VARCHAR(255),
    validacao VARCHAR(50)
);

------------------------------------------------------ 
-- ENDERECO VENDEDOR
------------------------------------------------------ 
CREATE TABLE Endereco_Vendedor (
    endereco_vendedor_PK INTEGER PRIMARY KEY,
    cod_vendedor INTEGER,
    CEP VARCHAR(10),
    rua VARCHAR(100),
    bairro VARCHAR(100),
    pont_ref VARCHAR(100),
    num_casa VARCHAR(10),
    FOREIGN KEY(cod_vendedor) REFERENCES Vendedor (cod_vendedor)
);

------------------------------------------------------ 
-- CLIENTE
------------------------------------------------------ 
CREATE TABLE Cliente (
    cod_cliente INTEGER PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    senha VARCHAR(255),
    telefone VARCHAR(20),
    CPF VARCHAR(14),
    foto VARCHAR(255)
);

------------------------------------------------------ 
-- ENDERECO CLIENTE 
------------------------------------------------------ 
CREATE TABLE Endereco_Cliente (
    endereco_cliente_PK INTEGER PRIMARY KEY,
    cod_cliente INTEGER,
    CEP VARCHAR(10),
    rua VARCHAR(100),
    bairro VARCHAR(100),
    pont_referencia VARCHAR(100),
    num_casa VARCHAR(10),
    FOREIGN KEY(cod_cliente) REFERENCES Cliente (cod_cliente)
);

------------------------------------------------------ 
-- ADMIN
------------------------------------------------------ 
CREATE TABLE Admin (
    cod_admin INTEGER PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    senha VARCHAR(255),
    tipo VARCHAR(50)
);

------------------------------------------------------ 
-- PRODUTO
------------------------------------------------------ 
CREATE TABLE Produto (
    cod_produto INTEGER PRIMARY KEY,
    cod_vendedor INTEGER,
    cod_categoria INTEGER,
    nome VARCHAR(100),
    marca VARCHAR(50),
    descricao VARCHAR(500),
    valor DECIMAL(10,2),
    promocao DECIMAL(10,2),
    FOREIGN KEY(cod_vendedor) REFERENCES Vendedor (cod_vendedor),
    FOREIGN KEY(cod_categoria) REFERENCES Categoria (cod_categoria)
);

------------------------------------------------------ 
-- FOTO (Galeria do Produto)
------------------------------------------------------ 
CREATE TABLE Foto (
    foto_PK INTEGER PRIMARY KEY,
    cod_produto INTEGER,
    foto VARCHAR(255), 
    FOREIGN KEY(cod_produto) REFERENCES Produto (cod_produto)
);

------------------------------------------------------ 
-- PEDIDO
------------------------------------------------------ 
CREATE TABLE Pedido (
    cod_pedido VARCHAR(50) PRIMARY KEY,
    cod_cliente INTEGER, 
    formaPag VARCHAR(50),
    preco DECIMAL(10,2),
    cupom VARCHAR(50),
    validacao BOOLEAN,
    notaF VARCHAR(50),
    FOREIGN KEY(cod_cliente) REFERENCES Cliente (cod_cliente)
);

------------------------------------------------------ 
-- POSSUI (Itens do Pedido)
------------------------------------------------------ 
CREATE TABLE Possui (
    cod_pedido VARCHAR(50),
    cod_produto INTEGER,
    qnt INTEGER,
    avaliacao DECIMAL(3,2),
    resenha VARCHAR(250),
    PRIMARY KEY (cod_pedido, cod_produto), 
    FOREIGN KEY(cod_pedido) REFERENCES Pedido (cod_pedido),
    FOREIGN KEY(cod_produto) REFERENCES Produto (cod_produto)
);

------------------------------------------------------ 
-- LOGISTICA
------------------------------------------------------ 
CREATE TABLE Logistica (
    cod_logistica INTEGER PRIMARY KEY, 
    cod_pedido VARCHAR(50),            
    cod_vendedor INTEGER,              
    frete VARCHAR(50),
    local_produto VARCHAR(100),
    status_entrega VARCHAR(50),        
    FOREIGN KEY(cod_pedido) REFERENCES Pedido (cod_pedido),
    FOREIGN KEY(cod_vendedor) REFERENCES Vendedor (cod_vendedor)
);