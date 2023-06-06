-- Tabela "seguradora"
CREATE TABLE seguradora (
    id_seguradora SERIAL PRIMARY KEY,
    nome VARCHAR(255),
    cnpj CHAR(14) UNIQUE NOT NULL,
    razao_social varchar(100),
    telefone VARCHAR(20),
    email VARCHAR(255),
    rua VARCHAR(100),
    numero INT,
    bairro VARCHAR(50),
    cidade VARCHAR(50),
    estado VARCHAR(50),
    cep VARCHAR(10)
);