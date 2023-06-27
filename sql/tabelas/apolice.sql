-- Tabela "Apólice"
CREATE TABLE apolice (
    id_apolice SERIAL PRIMARY KEY,
    id_imovel INT NOT NULL,
    id_corretor_pessoa INT NOT NULL,
    id_corretor_seguradora INT NOT NULL,
    data_inicio DATE NOT NULL,
    data_fim DATE NOT NULL,
    valor_cobertura DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel),
    FOREIGN KEY (id_corretor_seguradora, id_corretor_pessoa) REFERENCES corretor(id_seguradora, id_pessoa)
);

CREATE INDEX idx_fk_apolice_imovel ON apolice(id_imovel);
CREATE INDEX idx_fk_apolice_corretor ON apolice(id_seguradora, id_pessoa);
-- indice para otimização de query
CREATE INDEX idx_fim_apolice ON apolice (data_fim);
CREATE INDEX idx_inicio_apolice ON apolice (data_inicio);