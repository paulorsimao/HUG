-- Tabela "pessoa"
CREATE TABLE pessoa (
    id_pessoa SERIAL PRIMARY KEY,
    nome VARCHAR(255),
    telefone VARCHAR(20),
    email VARCHAR(255),
    id_endereco INT,
    FOREIGN KEY (id_endereco) REFERENCES endereco(id_endereco)
);