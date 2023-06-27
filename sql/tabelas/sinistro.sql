-- Tabela "Sinistro"
CREATE TABLE sinistro (
    id_sinistro SERIAL PRIMARY KEY,
    id_imovel INT NOT NULL,
    data_ocorrencia DATE NOT NULL,
    descricao TEXT NOT NULL,
    valor_prejuizo DECIMAL(15,2) NOT NULL,
    FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel)
);

CREATE INDEX idx_fk_sinistro_imovel ON sinistro (id_imovel);
CREATE INDEX idx_data_sinistro ON sinistro (data_ocorrencia);
