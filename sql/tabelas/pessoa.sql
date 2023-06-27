-- Tabela "pessoa"
CREATE TABLE pessoa (
    id_pessoa SERIAL PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cpf VARCHAR (14) NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(255),
    data_nasc DATE,
    rua VARCHAR(100),
    numero INT,
    bairro VARCHAR(50),
    cidade VARCHAR(50),
    estado VARCHAR(50),
    cep VARCHAR(10)
);

CREATE INDEX idx_pessoa_idade_estado ON pessoa(data_nasc, estado)
