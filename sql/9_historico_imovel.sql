CREATE TABLE historico_imovel (
    id_historico INT IDENTITY PRIMARY KEY,
    id_imovel INT,
    tipo INT,
    area DECIMAL(10, 2),
    valor DECIMAL(10, 2),
    descricao VARCHAR(255),
    id_seguradora INT,
    rua VARCHAR(100),
    numero INT,
    bairro VARCHAR(50),
    cidade VARCHAR(50),
    estado VARCHAR(50),
    cep VARCHAR(10),
    data_alteracao DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel)
);
