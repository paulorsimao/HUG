-- Tabela "Mobília"
CREATE TABLE mobilia (
    id_mobilia SERIAL PRIMARY KEY,
    id_imovel INT NOT NULL,
    nome VARCHAR(255) NOT NULL,
    valor DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel)
);

CREATE INDEX idx_fk_mobilia_imovel ON mobilia(id_imovel);
