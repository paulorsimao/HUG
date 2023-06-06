-- Tabela "seguradora"
CREATE TABLE seguradora (
    id_seguradora SERIAL PRIMARY KEY,
    nome VARCHAR(255),
    cnpj CHAR(14) UNIQUE NOT NULL,
    razao_social varchar(100),
    telefone VARCHAR(20),
    email VARCHAR(255),
    id_endereco INT,
    FOREIGN KEY (id_endereco) REFERENCES endereco(id_endereco)
);