-- Tabela "Sinistro"
CREATE TABLE sinistro (
    id_sinistro INT PRIMARY KEY,
    id_imovel INT,
    data_ocorrencia DATE,
    descricao TEXT,
    valor_prejuizo DECIMAL(10,2),
    FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel)
);