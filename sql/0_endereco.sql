-- Tabela "Cliente"
CREATE TABLE endereco (
    id_endereco SERIAL PRIMARY KEY,
    rua VARCHAR(100),
    numero INT,
    bairro VARCHAR(50),
    cidade VARCHAR(50),
    estado VARCHAR(50),
    cep VARCHAR(10)
);